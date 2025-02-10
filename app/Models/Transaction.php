<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'sale_id', 'quantity', 'price', 'total', 'date'];

    protected $dates = ['date']; // Pastikan date bisa diformat

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function getFormattedDateAttribute()
    {
        return Carbon::parse($this->date)->format('d-m-Y'); // Format sesuai tampilan
    }
    
    public function getFormattedDayAttribute()
    {
        return Carbon::parse($this->date)->translatedFormat('l'); // Hari dalam bahasa lokal
    }
    
    public function getYearAttribute()
    {
        return Carbon::parse($this->date)->format('Y'); // Tahun saja
    }    
}

