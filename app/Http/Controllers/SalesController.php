<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use Illuminate\Support\Facades\DB;

class SalesController extends Controller
{
    public function showFrontPage()
    {
        $products = Product::all();
        $transactions = Transaction::with('product')->orderBy('date', 'desc')->get();
        
        return view('frontend.sale', compact('products', 'transactions'));
    }

    public function index()
    {
        $products = Product::all();
        $transactions = Transaction::with('product')->orderBy('date', 'desc')->get();
        
        return view('sales.index', compact('products', 'transactions'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|array',
            'product_id.*' => 'exists:products,id',
            'quantity' => 'required|array',
            'quantity.*' => 'integer|min:1'
        ]);

        DB::beginTransaction();
        try {
            foreach ($request->product_id as $index => $product_id) {
                $quantity = $request->quantity[$index];
                $product = Product::findOrFail($product_id);

                // Cek stok sebelum melakukan transaksi
                if ($product->stock < $quantity) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Stok tidak mencukupi untuk {$product->name}");
                }

                // Simpan transaksi
                $transaction = Transaction::create([
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'total' => $quantity * $product->price,
                    'date' => now()->format('Y-m-d'),
                    'day' => now()->day,
                ]);

                // Debugging untuk cek apakah transaksi berhasil dibuat
                if (!$transaction) {
                    DB::rollBack();
                    return redirect()->back()->with('error', "Gagal menyimpan transaksi untuk {$product->name}");
                }

                // Kurangi stok barang dengan cara yang lebih aman
                $product->stock -= $quantity;
                $product->save(); // Simpan perubahan stok

                // Debugging stok (hapus jika sudah tidak diperlukan)
                // dd($product->stock, $quantity);
            }

            DB::commit();

            $isFrontend = $request->input('isFrontend', false);

            if ($isFrontend) {
                return redirect()->route('frontend.sale')->with('success', 'Transaksi berhasil! Barang telah diproses.');
            } else {
                return redirect()->route('sales.index')->with('success', 'Transaksi berhasil! Barang telah diproses.');
            }

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
}
