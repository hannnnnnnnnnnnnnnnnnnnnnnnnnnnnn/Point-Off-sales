<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\Report;
use Carbon\Carbon;

class RekapController extends Controller
{
    public function showFrontPage()
    {
        $today = Carbon::today()->toDateString();
    
        // Hitung total pendapatan hari ini
        $totalPendapatan = Transaction::whereDate('created_at', $today)->sum('total');
    
        // Update atau buat laporan harian baru
        Report::updateOrCreate(
            ['tanggal' => $today],
            ['total_pendapatan' => $totalPendapatan]
        );
    
        // Ambil data terbaru
        $rekap = Report::latest('tanggal')->get(); // Ambil laporan terbaru
        $totalKeseluruhan = Report::sum('total_pendapatan');
    
        return view('frontend.rekap', compact('rekap', 'totalKeseluruhan'));
    }

    public function index()
    {
        $today = Carbon::today()->toDateString();
    
        // Hitung total pendapatan hari ini
        $totalPendapatan = Transaction::whereDate('created_at', $today)->sum('total');
    
        // Update atau buat laporan harian baru
        Report::updateOrCreate(
            ['tanggal' => $today],
            ['total_pendapatan' => $totalPendapatan]
        );
    
        // Ambil data terbaru
        $rekap = Report::latest('tanggal')->get(); // Ambil laporan terbaru
        $totalKeseluruhan = Report::sum('total_pendapatan');
    
        return view('rekap.index', compact('rekap', 'totalKeseluruhan'));
    }
}
