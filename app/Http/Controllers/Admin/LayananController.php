<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;

class LayananController extends Controller
{
    public function index()
    {
        $layanans = Layanan::orderBy('nama')->get();
        return view('admin.layanan.index', compact('layanans'));
    }

    public function create()
    {
        return view('admin.layanan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'             => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'harga_per_karpet' => 'required|numeric|min:0',
        ]);

        Layanan::create($request->only('nama', 'deskripsi', 'harga_per_karpet', 'is_active'));

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil ditambahkan.');
    }

    public function edit(Layanan $layanan)
    {
        return view('admin.layanan.edit', compact('layanan'));
    }

    public function update(Request $request, Layanan $layanan)
    {
        $request->validate([
            'nama'             => 'required|string|max:255',
            'deskripsi'        => 'nullable|string',
            'harga_per_karpet' => 'required|numeric|min:0',
        ]);

        $layanan->update($request->only('nama', 'deskripsi', 'harga_per_karpet', 'is_active'));

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil diperbarui.');
    }

    public function destroy(Layanan $layanan)
    {
        $layanan->delete();
        return redirect()->route('admin.layanan.index')
            ->with('success', 'Layanan berhasil dihapus.');
    }
}
