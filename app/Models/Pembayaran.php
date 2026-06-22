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
        'jumlah',
        'metode_pembayaran',
        'channel_pembayaran',
        'nomor_virtual_account',
        'qr_code',
        'snap_token',
        'status',
        'expired_at',
        'paid_at'
    ];

    protected $casts = [
        'expired_at' => 'datetime',
        'paid_at' => 'datetime'
    ];

    public function pemesanan()
    {
        return $this->belongsTo(Pemesanan::class);
    }
} 