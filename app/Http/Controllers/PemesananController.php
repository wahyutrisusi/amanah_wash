<?php

namespace App\Http\Controllers;

use App\Models\Pemesanan;
use App\Models\Layanan;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index()
    {
        $pemesanans = Pemesanan::with('layanan')
            ->orderBy('created_at', 'desc')
            ->paginate(10);
            
        return view('cucimotor.pemesanan.index', compact('pemesanans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'layanan_id' => 'required|exists:layanans,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu' => 'required',
            'catatan' => 'nullable|string'
        ]);

        $pemesanan = Pemesanan::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'layanan_id' => $request->layanan_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'catatan' => $request->catatan,
            'status' => 'pending'
        ]);

        return redirect()->route('pemesanan.cek', $pemesanan->id)
            ->with('success', 'Pemesanan berhasil dibuat!');
    }

    public function cek($id)
    {
        try {
            $pemesanan = Pemesanan::with('layanan')->findOrFail($id);
            return view('cucimotor.pemesanan.cek', compact('pemesanan'));
        } catch (\Exception $e) {
            return redirect()->route('pemesanan')
                ->with('error', 'Pemesanan tidak ditemukan');
        }
    }

    public function cekStatus(Request $request)
    {
        $request->validate([
            'kode_pemesanan' => 'required|numeric'
        ], [
            'kode_pemesanan.required' => 'Kode pemesanan harus diisi',
            'kode_pemesanan.numeric' => 'Kode pemesanan harus berupa angka'
        ]);

        $pemesanan = Pemesanan::find($request->kode_pemesanan);

        if (!$pemesanan) {
            return redirect()->back()
                ->with('error', 'Kode pemesanan tidak ditemukan')
                ->withInput();
        }

        return redirect()->route('pemesanan.cek', $pemesanan->id);
    }
} 