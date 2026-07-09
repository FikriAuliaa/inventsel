<?php

namespace App\Http\Controllers;

use App\Models\ProductInstance;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductInstanceController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'kode_unik' => 'required|string|unique:product_instances,kode_unik',
            'kondisi_barang' => 'required|in:Baik,Rusak Ringan,Rusak Berat',
        ]);

        $product->instances()->create([
            'kode_unik' => $request->kode_unik,
            'kondisi_barang' => $request->kondisi_barang,
            'status_ketersediaan' => 'Tersedia',
        ]);

        $product->increment('stok');

        return back()->with('success', 'Unit spesifik berhasil ditambahkan. Stok bertambah otomatis.');
    }

    public function destroy(ProductInstance $instance)
    {
        $product = $instance->product;

        if ($instance->status_ketersediaan === 'Dipinjam') {
            return back()->with('error', 'Gagal: Unit yang sedang dipinjam tidak dapat dihapus.');
        }

        $instance->delete();

        $product->decrement('stok');

        return back()->with('success', 'Unit spesifik berhasil dihapus. Stok berkurang otomatis.');
    }
}