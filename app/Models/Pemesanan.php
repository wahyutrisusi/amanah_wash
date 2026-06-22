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
        'tanggal',
        'waktu',
        'alamat',
        'kecamatan',
        'kota',
        'kode_pos',
        'patokan',
        'catatan',
        'status',
        'cuci_karpet',
        'metode_pengambilan',
        'metode_pengembalian',
        'notifikasi_wa',
        'status_pengerjaan',
        'estimasi_selesai'
    ];

    protected $casts = [
        'tanggal' => 'date',
        'waktu' => 'datetime',
        'estimasi_selesai' => 'datetime',
        'cuci_karpet' => 'boolean',
        'notifikasi_wa' => 'boolean'
    ];

    public function layanan()
    {
        return $this->belongsTo(Layanan::class);
    }
} 