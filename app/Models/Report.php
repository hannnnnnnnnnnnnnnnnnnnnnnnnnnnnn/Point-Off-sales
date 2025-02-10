<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    protected $fillable = ['tanggal', 'total_pendapatan'];

    // Menambahkan ini agar timestamps otomatis
    public $timestamps = true; // Pastikan ini diset true
}

