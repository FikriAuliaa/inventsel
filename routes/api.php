<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProductApiController;
use App\Http\Controllers\Api\v1\CategoryApiController;
use App\Http\Controllers\Api\v1\BorrowingApiController;

/*
|--------------------------------------------------------------------------
| API Routes - INVENTSEL
|--------------------------------------------------------------------------
*/

// 1. API PUBLIC & INTERNAL AJAX (Tanpa Auth)
Route::prefix('v1')->group(function () {
    // Route Internal AJAX untuk Dropdown Dynamic Form Peminjaman
    Route::get('categories/{category}/instances', [CategoryApiController::class, 'getAvailableInstances']);

    // Auth Endpoint untuk Eksternal App (Mobile/Third-Party)
    Route::post('auth/login', [AuthController::class, 'login']);
});

// 2. REST API PROTECTED (Menggunakan Laravel Sanctum)
Route::prefix('v1')->middleware('auth:sanctum')->group(function () {
    // Auth Logout
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', function (Request $request) {
        return response()->json(['success' => true, 'data' => $request->user()]);
    });

    // CRUD Master Barang & Logistik
    Route::apiResource('products', ProductApiController::class);

    // CRUD Kategori
    Route::apiResource('categories', CategoryApiController::class)->except(['getAvailableInstances']);

    // Transaksi Peminjaman & Pengembalian
    Route::get('borrowings', [BorrowingApiController::class, 'index']);
    Route::post('borrowings', [BorrowingApiController::class, 'store']);
    Route::get('borrowings/{id}', [BorrowingApiController::class, 'show']);
    Route::post('borrowings/{id}/return', [BorrowingApiController::class, 'processReturn']);
});