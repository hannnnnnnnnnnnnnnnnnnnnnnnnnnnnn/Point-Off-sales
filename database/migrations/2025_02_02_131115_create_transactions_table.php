<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('product_id')->constrained()->onDelete('cascade');  // Relasi dengan tabel produk
            $table->unsignedBigInteger('sale_id')->nullable();
            $table->integer('quantity');  // Jumlah produk yang terjual
            $table->decimal('price', 10, 2);  // Harga per produk
            $table->decimal('total', 10, 2);  // Total harga transaksi
            $table->string('date'); // Format "04-02-2025" (dd-mm-yyyy)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('transactions');
    }
}
