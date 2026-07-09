<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all();
        $query = Product::with('category');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama_barang', 'like', "%{$search}%")
                    ->orWhere('kode_barang', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $sortField = $request->get('sort', 'created_at');
        $sortOrder = $request->get('order', 'desc');

        if (in_array($sortField, ['nama_barang', 'stok', 'created_at'])) {
            $query->orderBy($sortField, $sortOrder);
        }

        $products = $query->paginate(10)->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:products,kode_barang',
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        Product::create($data);

        return redirect()->route('products.index')->with('success', 'Katalog barang berhasil ditambahkan.');
    }

    public function show($id)
    {
        $product = Product::with(['category', 'instances'])->findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'lokasi_penyimpanan' => 'required|string|max:255',
            'kode_barang' => 'required|string|unique:products,kode_barang,' . $product->id,
            'stok' => 'required|integer|min:0',
            'gambar' => 'nullable|image|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('gambar')) {
            if ($product->gambar) {
                \Storage::disk('public')->delete($product->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('products', 'public');
        }

        $product->update($data);

        return redirect()->route('products.index')->with('success', 'Katalog barang berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->gambar) {
            \Storage::disk('public')->delete($product->gambar);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Katalog barang berhasil dihapus.');
    }
}