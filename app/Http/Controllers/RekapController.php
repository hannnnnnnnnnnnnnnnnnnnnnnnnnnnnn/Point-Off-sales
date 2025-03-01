<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Report;
use Carbon\Carbon;

class RekapController extends Controller
{
    public function showFrontPage(Request $request)
    {
        $today = Carbon::today()->toDateString();

        // Hitung total pendapatan hari ini
        $totalPendapatan = Transaction::whereDate('created_at', $today)->sum('total');

        // Update atau buat laporan harian baru
        Report::updateOrCreate(
            ['tanggal' => $today],
            ['total_pendapatan' => $totalPendapatan]
        );

        // Query untuk pencarian
        $query = Report::query();

        // Pencarian berdasarkan nama barang
        if ($request->filled('nama_barang')) {
            $query->whereHas('transactions.product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama_barang . '%');
            });
        }

        // Pencarian berdasarkan tanggal
        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        // Ambil data terbaru
        $rekap = $query->latest('tanggal')->get();
        $totalKeseluruhan = Report::sum('total_pendapatan');

        return view('frontend.rekap', compact('rekap', 'totalKeseluruhan'));
    }

    public function index(Request $request)
    {
        $query = Transaction::with('product'); // Pastikan relasi produk dimuat
    
        // Filter berdasarkan tanggal (gunakan created_at)
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
    
        // Filter berdasarkan nama barang
        if ($request->filled('nama_barang')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'LIKE', '%' . $request->nama_barang . '%');
            });
        }
    
        $rekap = $query->latest('created_at')->get();
        $totalKeseluruhan = Transaction::sum('total');
    
        return view('rekap.index', compact('rekap', 'totalKeseluruhan'));
    }
    
}
