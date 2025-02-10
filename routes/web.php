<?php

use App\Models\Customer;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\TransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('welcome');


Route::resource('products', ProductController::class);
Route::resource('sales', SalesController::class);
Route::resource('transactions', TransactionController::class);

Route::get('/frontend/products', [ProductController::class, 'showFrontPage'])->name('frontend.product');
// Route untuk riwayat transaksi di frontend
Route::get('/frontend/transaction', [TransactionController::class, 'showFrontPage'])->name('frontend.transaction');

Route::get('/frontend/sale', [SalesController::class, 'showFrontPage'])->name('frontend.sale');

Route::post('/sales', [SalesController::class, 'store'])->name('sales.store');

Route::get('/rekap', [RekapController::class, 'index'])->name('rekap');

Route::get('/frontend/rekap', [RekapController::class, 'showFrontPage'])->name('frontend.rekap');




