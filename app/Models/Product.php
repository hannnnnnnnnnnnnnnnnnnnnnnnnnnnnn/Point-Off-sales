<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'stock', 'price'];

    public function sales()
    {
        return $this->hasMany(Sales::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

      // Method untuk mengurangi stok produk
      public function decreaseStock($quantity)
      {
          if ($this->stock >= $quantity) {
              $this->decrement('stock', $quantity);
          }
      }
      
  
      // Method untuk menambah stok produk
      public function increaseStock($quantity)
      {
          $this->increment('stock', $quantity);
      }
}
