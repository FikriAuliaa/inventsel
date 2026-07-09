<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductInstance;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return response()->json(['success' => true, 'data' => $categories], 200);
    }

    public function getAvailableInstances($categoryId)
    {
        // Mengambil unit fisik barang yang berstatus 'Tersedia' berdasarkan kategori pilihan
        $instances = ProductInstance::with('product')
            ->where('status_ketersediaan', 'Tersedia')
            ->whereHas('product', function ($query) use ($categoryId) {
                $query->where('category_id', $categoryId);
            })->get();

        return response()->json(['success' => true, 'data' => $instances], 200);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|string|unique:categories,name']);
        $category = Category::create($request->all());
        return response()->json(['success' => true, 'data' => $category], 201);
    }

    public function show($id)
    {
        $category = Category::find($id);
        if (!$category)
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        return response()->json(['success' => true, 'data' => $category], 200);
    }

    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        if (!$category)
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        $category->update($request->all());
        return response()->json(['success' => true, 'data' => $category], 200);
    }

    public function destroy($id)
    {
        $category = Category::find($id);
        if (!$category)
            return response()->json(['success' => false, 'message' => 'Data tidak ditemukan'], 404);
        $category->delete();
        return response()->json(['success' => true, 'message' => 'Kategori berhasil dihapus'], 200);
    }
}