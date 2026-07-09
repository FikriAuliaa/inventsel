<?php

namespace App\Http\Controllers;

use App\Models\ProductInstance;
use App\Models\Borrowing;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBarang = ProductInstance::count();
        $barangTersedia = ProductInstance::where('status_ketersediaan', 'Tersedia')->count();
        $barangDipinjam = ProductInstance::where('status_ketersediaan', 'Dipinjam')->count();

        // Deteksi secara dinamis jenis database yang sedang aktif (MySQL atau PostgreSQL)
        $driver = DB::getDriverName();
        $monthQuery = $driver === 'pgsql'
            ? 'EXTRACT(MONTH FROM tanggal_pinjam) as month'
            : 'MONTH(tanggal_pinjam) as month';

        $borrowingsPerMonth = Borrowing::select(
            DB::raw($monthQuery),
            DB::raw('COUNT(*) as count')
        )
            ->whereYear('tanggal_pinjam', Carbon::now()->year)
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $chartData = array_fill(1, 12, 0);

        foreach ($borrowingsPerMonth as $data) {
            $monthIndex = (int) $data->month;
            $chartData[$monthIndex] = $data->count;
        }

        $chartData = array_values($chartData);

        return view('dashboard', compact('totalBarang', 'barangTersedia', 'barangDipinjam', 'chartData'));
    }
}