<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Layanan;

class DashboardController extends Controller
{
    public function index()
    {
        $total_pemesanan = Pemesanan::count();
        $pending_pemesanan = Pemesanan::where('status', 'pending')->count();
        $completed_pemesanan = Pemesanan::where('status', 'completed')->count();
        $total_layanan = Layanan::count();
        
        $latest_pemesanans = Pemesanan::with('layanan')
            ->latest()
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'total_pemesanan',
            'pending_pemesanan',
            'completed_pemesanan',
            'total_layanan',
            'latest_pemesanans'
        ));
    }
} 