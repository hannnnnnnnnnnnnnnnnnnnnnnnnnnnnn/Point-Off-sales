<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function showFrontPage()
    {
        // Mengurutkan transaksi berdasarkan tanggal terbaru dan menggunakan pagination
        $transactions = Transaction::with('product')
            ->orderBy('date', 'desc')
            ->orderBy('created_at', 'desc') // Mengurutkan berdasarkan tanggal dibuat
            ->paginate(10);

        return view('frontend.transaction', compact('transactions'));
    }

    public function index()
    {
        // Gunakan pagination agar lebih konsisten
        $transactions = Transaction::with('product')
            ->orderBy('date', 'desc') // Mengurutkan berdasarkan tanggal terbaru
            ->paginate(10); // Menampilkan 10 transaksi per halaman

        return view('transactions.index', compact('transactions'));
    }

    public function store(Request $request)
    {
        $sales = Sales::all();
    
        if ($sales->isEmpty()) {
            return redirect()->route('transactions.index')->with('warning', 'Tidak ada data penjualan yang diproses.');
        }
    
        DB::transaction(function () use ($sales) {
            $transactionsToCreate = [];
            $totalPendapatanHariIni = 0; // Untuk menghitung total pendapatan hari ini
            $today = Carbon::today()->toDateString(); // Ambil tanggal hari ini
    
            foreach ($sales as $sale) {
                $product = Product::find($sale->product_id);
    
                // Skip jika produk tidak ditemukan
                if (!$product) continue;
    
                $totalHarga = $sale->quantity * $product->price;
                $totalPendapatanHariIni += $totalHarga; // Tambahkan ke total hari ini
    
                $transactionsToCreate[] = [
                    'product_id' => $sale->product_id,
                    'sale_id' => $sale->id,
                    'quantity' => $sale->quantity,
                    'price' => $product->price,
                    'total' => $totalHarga,
                    'date' => now(),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
    
                // Hapus sales setelah dipindahkan ke transaksi
                $sale->delete();
            }
    
            // Batch insert transaksi
            if (!empty($transactionsToCreate)) {
                Transaction::insert($transactionsToCreate);
            }
    
            // **UPDATE atau BUAT rekap di tabel `Report`**
            Report::updateOrCreate(
                ['tanggal' => $today],
                ['total_pendapatan' => DB::table('transactions')->whereDate('created_at', $today)->sum('total')]
            );
        });
    
        return redirect()->route('transactions.index')->with('success', 'Data transaksi berhasil diperbarui.');
    }
    
}
