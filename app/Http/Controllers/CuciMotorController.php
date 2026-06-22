<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pemesanan;
use App\Models\Layanan;

class CuciMotorController extends Controller
{
    public function index()
    {
        return view('cucimotor.beranda');
    }

    public function layanan()
    {
        $layanan = Layanan::where('is_active', true)->get();
        return view('cucimotor.layanan', compact('layanan'));
    }

    public function pemesanan()
    {
        $layanans = Layanan::where('is_active', true)->get();
        return view('cucimotor.pemesanan', compact('layanans'));
    }

    public function storePemesanan(Request $request)
    {
        $rules = [
            'nama' => 'required|string|max:255',
            'telepon' => 'required|string|max:20',
            'layanan_id' => 'required|exists:layanans,id',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu' => 'required',
            'catatan' => 'nullable|string'
        ];

        // Tambahkan validasi alamat jika layanan adalah karpet
        $layanan = Layanan::find($request->layanan_id);
        if ($layanan && $layanan->kategori == 'karpet') {
            $rules['alamat'] = 'required|string';
            $rules['kota'] = 'required|string';
            $rules['kode_pos'] = 'required|string';
        }

        $request->validate($rules);

        $pemesanan = Pemesanan::create([
            'nama' => $request->nama,
            'telepon' => $request->telepon,
            'layanan_id' => $request->layanan_id,
            'tanggal' => $request->tanggal,
            'waktu' => $request->waktu,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'kode_pos' => $request->kode_pos,
            'catatan' => $request->catatan,
            'status' => 'pending',
            'total' => $layanan->harga
        ]);

        return redirect()->route('pemesanan.pembayaran', $pemesanan->id);
    }

    public function galeri()
    {
        return view('cucimotor.galeri');
    }

    public function kontak()
    {
        return view('cucimotor.kontak');
    }

    public function blog()
    {
        return view('cucimotor.blog');
    }

    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->update($request->all());

        return redirect()->route('admin.layanan.index')->with('success', 'Layanan berhasil diperbarui.');
    }

    public function pembayaran($id)
    {
        try {
            $pemesanan = Pemesanan::with('layanan')->findOrFail($id);
            return view('cucimotor.pemesanan.pembayaran', compact('pemesanan'));
        } catch (\Exception $e) {
            return redirect()->route('pemesanan')
                ->with('error', 'Pemesanan tidak ditemukan');
        }
    }
} 