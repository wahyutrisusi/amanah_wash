<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';
    
    protected $fillable = [
        'pemesanan_id',
        'total_harga',
        'status_pembayaran',
        'metode_pembayaran',
        'tanggal_bayar',
        'catatan',
    ];

    protected $casts = [
        'tanggal_bayar' => 'datetime',
        'total_harga'   => 'decimal:2',
    ];

    const STATUS_BELUM_BAYAR = 'belum_bayar';
    const STATUS_LUNAS       = 'lunas';

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
} 