<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    {
        // Menghitung total keseluruhan pendapatan
        $totalKeseluruhan = Report::sum('total_pendapatan');

        // Menghitung jumlah total produk
        $totalProducts = Product::count();

        // Menghitung jumlah total transaksi
        $totalTransactions = Transaction::count();


        // Mengirim data ke view
        return view('admin.dashboard', compact('totalKeseluruhan', 'totalProducts', 'totalTransactions',));
    }
}
