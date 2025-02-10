<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showFrontPage()
    {
        $products = Product::all();
        return view('frontend.product', compact('products'));
    }

    public function index()
    {
        $products = Product::all();
        return view('products.index', compact('products'));
    }

    public function create()
    {
        return view('products.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        Product::create([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan.');
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'stock' => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        // Update produk
        $product->update([
            'name' => $request->name,
            'stock' => $request->stock,
            'price' => $request->price,
        ]);

        // Menggunakan parameter isFrontend untuk menentukan sumber
        $isFrontend = $request->input('isFrontend', false);

        if ($isFrontend) {
            // Jika permintaan datang dari frontend
            return redirect()->route('frontend.product')->with('success', 'Produk berhasil diperbarui.');
        } else {
            // Jika permintaan datang dari backend
            return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui.');
        }
    }
}
