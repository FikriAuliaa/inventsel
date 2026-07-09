<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::with(['category', 'instances']);

        if ($request->has('search')) {
            $query->where('nama_barang', 'like', '%' . $request->search . '%')
                ->orWhere('kode_barang', 'like', '%' . $request->search . '%');
        }

        return response()->json(['success' => true, 'data' => $query->get()], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'kode_barang' => 'required|string|unique:products,kode_barang',
            'category_id' => 'required|exists:categories,id',
            'lokasi_penyimpanan' => 'required|string',
            'stok' => 'required|integer|min:0',
        ]);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        $product = Product::create($data);
        return response()->json(['success' => true, 'data' => $product], 201);
    }

    public function show($id)
    {
        $product = Product::with(['category', 'instances'])->find($id);
        if (!$product)
            return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan'], 404);
        return response()->json(['success' => true, 'data' => $product], 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan'], 404);

        $data = $request->all();
        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        $product->update($data);
        return response()->json(['success' => true, 'data' => $product], 200);
    }

    public function destroy($id)
    {
        $product = Product::find($id);
        if (!$product)
            return response()->json(['success' => false, 'message' => 'Barang tidak ditemukan'], 404);

        if ($product->gambar) {
            Storage::disk('public')->delete($product->gambar);
        }

        $product->delete();
        return response()->json(['success' => true, 'message' => 'Barang berhasil dihapus'], 200);
    }
}