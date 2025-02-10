<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Sales extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'quantity', 'price', 'total', 'date'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class);
    }

    // Atur agar tanggal otomatis saat data disimpan
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($sale) {
            $sale->date = Carbon::now();
        });
    }
}
