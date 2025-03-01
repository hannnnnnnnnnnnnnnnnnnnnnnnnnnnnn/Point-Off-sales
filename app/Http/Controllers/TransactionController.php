<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Sales;
use App\Models\Product;
use App\Models\Report;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class TransactionController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only('exportExcel');
    }
    public function showFrontPage(Request $request)
    {
        $query = Transaction::with('product')->orderBy('created_at', 'desc');
    
        if ($request->filled('nama_barang')) {
            $query->whereHas('product', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama_barang . '%');
            });
        }
    
        if ($request->filled('tanggal')) {
            $query->whereDate('created_at', $request->tanggal);
        }
    
        $transactions = $query->paginate(10);
    
        return view('frontend.transaction', compact('transactions'));
    }
    
    public function index()
    {
        $transactions = Transaction::with('product')
            ->orderBy('date', 'desc')
            ->paginate(10);

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
            $totalPendapatanHariIni = 0;
            $today = Carbon::today()->toDateString();

            foreach ($sales as $sale) {
                $product = Product::find($sale->product_id);

                if (!$product) continue; 

                if ($product->stock < $sale->quantity) {
                    throw new \Exception("Stok untuk {$product->name} tidak mencukupi.");
                }

                $totalHarga = $sale->quantity * $product->price;
                $totalPendapatanHariIni += $totalHarga;

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

                $product->stock -= $sale->quantity;
                $product->save();
                $sale->delete();
            }

            if (!empty($transactionsToCreate)) {
                Transaction::insert($transactionsToCreate);
            }

            Report::updateOrCreate(
                ['tanggal' => $today],
                ['total_pendapatan' => DB::table('transactions')->whereDate('created_at', $today)->sum('total')]
            );
        });

        return redirect()->route('transactions.index')->with('success', 'Data transaksi berhasil diperbarui.');
    }

    // 🔥 Fitur Export ke Excel
    public function exportExcel()
    {
        $transactions = Transaction::with('product')->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Header
        $sheet->setCellValue('A1', 'ID Transaksi');
        $sheet->setCellValue('B1', 'Produk');
        $sheet->setCellValue('C1', 'Jumlah');
        $sheet->setCellValue('D1', 'Harga');
        $sheet->setCellValue('E1', 'Total');
        $sheet->setCellValue('F1', 'Tanggal');

        // Isi Data
        $row = 2;
        foreach ($transactions as $transaction) {
            $sheet->setCellValue('A' . $row, $transaction->id);
            $sheet->setCellValue('B' . $row, $transaction->product->name ?? 'N/A');
            $sheet->setCellValue('C' . $row, $transaction->quantity);
            $sheet->setCellValue('D' . $row, $transaction->price);
            $sheet->setCellValue('E' . $row, $transaction->total);
            $sheet->setCellValue('F' . $row, $transaction->date);
            $row++;
        }

        $fileName = 'transaksi.xlsx';
        $writer = new Xlsx($spreadsheet);
        $filePath = storage_path($fileName);
        $writer->save($filePath);

        return response()->download($filePath)->deleteFileAfterSend(true);
    }
}
