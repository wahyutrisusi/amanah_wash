<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Pembayaran;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();

        // Karpet masuk hari ini
        $karpet_masuk_hari_ini = Pemesanan::whereDate('tanggal_masuk', $today)
            ->sum('jumlah_karpet');

        // Pesanan selesai (status selesai atau diambil)
        $pesanan_selesai = Pemesanan::whereIn('status', ['selesai', 'diambil'])->count();

        // Karpet sudah selesai tapi belum diambil
        $karpet_belum_diambil = Pemesanan::where('status', 'selesai')->sum('jumlah_karpet');

        // Total pendapatan (dari pembayaran lunas)
        $total_pendapatan = Pembayaran::where('status_pembayaran', 'lunas')->sum('total_harga');

        // Pesanan terbaru
        $latest_pemesanans = Pemesanan::with('layanan')
            ->latest()
            ->take(5)
            ->get();

        // Ringkasan per status
        $status_counts = Pemesanan::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        return view('admin.dashboard', compact(
            'karpet_masuk_hari_ini',
            'pesanan_selesai',
            'karpet_belum_diambil',
            'total_pendapatan',
            'latest_pemesanans',
            'status_counts'
        ));
    }
}
