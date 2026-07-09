<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\AuthController;
use App\Http\Controllers\Api\v1\ProductApiController;
use App\Http\Controllers\Api\v1\CategoryApiController;
use App\Http\Controllers\Api\v1\BorrowingApiController;

Route::prefix('v1')->group(function () {
    Route::post('auth/login', [AuthController::class, 'login']);
    Route::post('auth/register', [AuthController::class, 'register']);
});

Route::prefix('v1')->middleware('auth:sanctum')->name('api.')->group(function () {
    Route::post('auth/logout', [AuthController::class, 'logout']);
    Route::get('auth/me', function (Request $request) {
        return response()->json([
            'success' => true,
            'message' => 'User profile retrieved successfully',
            'data' => $request->user()
        ]);
    });

    Route::apiResource('products', ProductApiController::class);
    Route::apiResource('categories', CategoryApiController::class)->except(['getAvailableInstances']);

    Route::get('borrowings', [BorrowingApiController::class, 'index']);
    Route::post('borrowings', [BorrowingApiController::class, 'store']);
    Route::get('borrowings/{id}', [BorrowingApiController::class, 'show']);
    Route::post('borrowings/{id}/return', [BorrowingApiController::class, 'processReturn']);
});