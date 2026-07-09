<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductInstanceController;
use App\Http\Controllers\BorrowingController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware(['role:Admin,Staff'])->group(function () {
        Route::resource('categories', CategoryController::class)->except(['show']);

        Route::resource('products', ProductController::class);

        Route::post('products/{product}/instances', [ProductInstanceController::class, 'store'])->name('instances.store');
        Route::delete('instances/{instance}', [ProductInstanceController::class, 'destroy'])->name('instances.destroy');

        Route::resource('borrowings', BorrowingController::class)->only(['index', 'create', 'store']);
        Route::get('borrowings/{borrowing}/return', [BorrowingController::class, 'returnForm'])->name('borrowings.return');
        Route::post('borrowings/{borrowing}/return', [BorrowingController::class, 'processReturn'])->name('borrowings.processReturn');
    });

    Route::middleware(['role:Admin'])->group(function () {
        Route::resource('users', UserController::class)->except(['show']);
    });

    Route::middleware(['auth'])->group(function () {
        Route::get('/borrowings/export/excel', [BorrowingController::class, 'exportExcel'])->name('borrowings.export.excel');
        Route::get('/borrowings/export/pdf', [BorrowingController::class, 'exportPdf'])->name('borrowings.export.pdf');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';