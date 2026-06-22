<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemesanan extends Model
{
    use HasFactory;

    protected $table = 'pemesanans';
    
    protected $fillable = [
        'layanan_id',
        'nama',
        'telepon',
        'alamat',
        'jumlah_karpet',
        'catatan',
        'nomor_antrian',
        'status',
        'tanggal_masuk',
        'tanggal_selesai',
    ];

    protected $casts = [
        'tanggal_masuk' => 'date',
        'tanggal_selesai' => 'date',
    ];

    // Status constants
    const STATUS_MENUNGGU  = 'menunggu';
    const STATUS_DICUCI    = 'dicuci';
    const STATUS_DIJEMUR   = 'dijemur';
    const STATUS_SELESAI   = 'selesai';
    const STATUS_DIAMBIL   = 'diambil';

    public static function statusList(): array
    {
        return [
            self::STATUS_MENUNGGU => 'Menunggu',
            self::STATUS_DICUCI   => 'Dicuci',
            self::STATUS_DIJEMUR  => 'Dijemur',
            self::STATUS_SELESAI  => 'Selesai',
            self::STATUS_DIAMBIL  => 'Diambil',
        ];
    }

    public function getStatusLabelAttribute(): string
    {
        return self::statusList()[$this->status] ?? ucfirst($this->status);
    }

    public function getStatusColorAttribute(): string
    {
        return match($this->status) {
            self::STATUS_MENUNGGU => 'warning',
            self::STATUS_DICUCI   => 'info',
            self::STATUS_DIJEMUR  => 'primary',
            self::STATUS_SELESAI  => 'success',
            self::STATUS_DIAMBIL  => 'secondary',
            default               => 'dark',
        };
    }

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }

    public function pembayaran()
    {
        return $this->hasOne(Pembayaran::class);
    }

    /**
     * Generate next queue number (5-digit, resets daily).
     */
    public static function generateNomorAntrian(): string
    {
        $today = now()->format('Y-m-d');
        $count = self::whereDate('tanggal_masuk', $today)->count() + 1;
        return str_pad($count, 5, '0', STR_PAD_LEFT);
    }
} 