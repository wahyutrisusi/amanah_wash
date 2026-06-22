<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with('layanan')
            ->latest()
            ->paginate(10);
            
        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,completed,cancelled'
        ]);

        $pemesanan->update([
            'status' => $request->status
        ]);

        return redirect()->back()->with('success', 'Status pemesanan berhasil diperbarui');
    }
} 