<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\ProductInstance;
use App\Models\BorrowingDetail;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use App\Exports\BorrowingExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;

class BorrowingController extends Controller
{
    public function index(Request $request)
    {
        $query = Borrowing::with(['user', 'borrowingDetails.productInstance.product']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->whereHas('user', function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $sortOrder = $request->get('order', 'desc');
        $query->orderBy('tanggal_pinjam', $sortOrder);

        $borrowings = $query->paginate(10)->withQueryString();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $categories = Category::all();
        $users = User::all();
        return view('borrowings.create', compact('categories', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'waktu_pinjam' => 'required|date',
            'instance_ids' => 'required|array',
            'instance_ids.*' => 'exists:product_instances,id'
        ]);

        $borrowing = Borrowing::create([
            'user_id' => $request->user_id,
            'tanggal_pinjam' => $request->waktu_pinjam,
            'status' => 'Dipinjam'
        ]);

        foreach ($request->instance_ids as $instanceId) {
            BorrowingDetail::create([
                'borrowing_id' => $borrowing->id,
                'product_instance_id' => $instanceId
            ]);

            ProductInstance::where('id', $instanceId)->update(['status_ketersediaan' => 'Dipinjam']);
        }

        return redirect()->route('borrowings.index')->with('success', 'Transaksi log peminjaman berhasil dicatat.');
    }

    public function returnForm($id)
    {
        $borrowing = Borrowing::with('borrowingDetails')->findOrFail($id);

        if ($borrowing->status === 'Dipinjam') {
            $borrowing->update([
                'tanggal_kembali' => now(),
                'status' => 'Dikembalikan'
            ]);

            foreach ($borrowing->borrowingDetails as $detail) {
                ProductInstance::where('id', $detail->product_instance_id)->update(['status_ketersediaan' => 'Tersedia']);
            }
        }

        return redirect()->route('borrowings.index')->with('success', 'Unit barang telah berhasil diproses kembali.');
    }

    public function exportExcel()
    {
        return Excel::download(new BorrowingExport, 'laporan-peminjaman-' . date('Y-m-d') . '.xlsx');
    }

    public function exportPdf()
    {
        $borrowings = Borrowing::with(['user', 'borrowingDetails.productInstance.product'])->get();
        $pdf = Pdf::loadView('borrowings.pdf', compact('borrowings'));
        return $pdf->download('laporan-peminjaman-' . date('Y-m-d') . '.pdf');
    }
}