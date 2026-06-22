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
        'deskripsi',
        'harga_per_karpet',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'harga_per_karpet' => 'decimal:2',
    ];

    public function pemesanans()
    {
        return $this->hasMany(Pemesanan::class);
    }
} 