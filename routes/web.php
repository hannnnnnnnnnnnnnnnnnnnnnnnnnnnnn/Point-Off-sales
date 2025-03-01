<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
*/

Route::get('/', function () {
    return redirect('/login');
});

// Route untuk kasir
Route::middleware(['auth', 'kasir'])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});

// Route untuk admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    
    // Manajemen User (CRUD User)
    Route::resource('users', UserController::class)->except(['show']);

    // Export transaksi (hanya untuk admin)
    Route::get('/export-transaksi', [TransactionController::class, 'exportExcel'])->name('export.transaksi');
});

// Routes yang bisa diakses oleh semua user yang sudah login (Admin & Kasir)
Route::middleware('auth')->group(function () {
    // Manajemen Produk & Penjualan
    Route::resource('products', ProductController::class);
    Route::resource('sales', SalesController::class);
    Route::resource('transactions', TransactionController::class);

    // Profil User
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Tambahan: Route transaksi frontend dengan pencarian
    Route::get('/frontend/transaction', [TransactionController::class, 'showFrontPage'])->name('frontend.transaction');
    Route::get('/frontend/transaction/search', [TransactionController::class, 'search'])->name('frontend.transaction.search');

    // Tampilan frontend untuk produk & penjualan
    Route::get('/frontend/products', [ProductController::class, 'showFrontPage'])->name('frontend.product');
    Route::get('/frontend/sale', [SalesController::class, 'showFrontPage'])->name('frontend.sale');

    // Rekapitulasi transaksi
    Route::get('/rekap', [RekapController::class, 'index'])->name('rekap');
    Route::get('/frontend/rekap', [RekapController::class, 'showFrontPage'])->name('frontend.rekap');
});

require __DIR__.'/auth.php';
