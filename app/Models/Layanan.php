<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Layanan extends Model
{
    use HasFactory;

    protected $table = 'layanans';
    
    protected $fillable = [
        'nama',
        'harga',
        'deskripsi',
        'harga_karpet',
        'biaya_jemput',
        'biaya_antar'
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
} 