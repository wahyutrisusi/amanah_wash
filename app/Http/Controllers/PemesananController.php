<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    /**
     * Tampilkan form cek pesanan.
     */
    public function cekForm()
    {
        return view('cucimotor.cek-pesanan');
    }

    /**
     * Proses pencarian pesanan berdasarkan nomor antrian.
     */
    public function cekStatus(Request $request)
    {
        $request->validate([
            'nomor_antrian' => 'required|string',
        ], [
            'nomor_antrian.required' => 'Nomor antrian harus diisi.',
        ]);

        $nomor = ltrim($request->nomor_antrian, '0') ?: '0';

        // Cari berdasarkan nomor antrian atau ID
        $pemesanan = Pemesanan::where('nomor_antrian', $request->nomor_antrian)
            ->orWhere('id', is_numeric($nomor) ? (int)$nomor : 0)
            ->with('layanan')
            ->first();

        if (!$pemesanan) {
            return redirect()->back()
                ->with('error', 'Nomor antrian tidak ditemukan. Pastikan nomor yang Anda masukkan benar.')
                ->withInput();
        }

        return redirect()->route('pemesanan.cek', $pemesanan->id);
    }

    /**
     * Tampilkan detail & status pesanan.
     */
    public function cek($id)
    {
        $pemesanan = Pemesanan::with('layanan')->findOrFail($id);
        return view('cucimotor.pemesanan.cek', compact('pemesanan'));
    }
}
