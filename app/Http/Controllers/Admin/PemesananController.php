<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pemesanan;
use App\Models\Layanan;
use App\Models\Pembayaran;
use Illuminate\Http\Request;

class PemesananController extends Controller
{
    public function index(Request $request)
    {
        $query = Pemesanan::with(['layanan', 'pembayaran'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhere('telepon', 'like', "%{$search}%")
                  ->orWhere('nomor_antrian', 'like', "%{$search}%");
            });
        }

        $pemesanans = $query->paginate(15)->withQueryString();

        return view('admin.pemesanan.index', compact('pemesanans'));
    }

    public function create()
    {
        $layanans = Layanan::where('is_active', true)->get();
        return view('admin.pemesanan.create', compact('layanans'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama'          => 'required|string|max:255',
            'telepon'       => 'required|string|max:20',
            'alamat'        => 'nullable|string',
            'layanan_id'    => 'required|exists:layanans,id',
            'jumlah_karpet' => 'required|integer|min:1|max:100',
            'catatan'       => 'nullable|string',
            'tanggal_masuk' => 'required|date',
        ]);

        $layanan = Layanan::findOrFail($validated['layanan_id']);
        $totalHarga = $layanan->harga_per_karpet * $validated['jumlah_karpet'];

        $pemesanan = Pemesanan::create([
            ...$validated,
            'nomor_antrian' => Pemesanan::generateNomorAntrian(),
            'status'        => Pemesanan::STATUS_MENUNGGU,
        ]);

        // Buat record pembayaran otomatis
        Pembayaran::create([
            'pemesanan_id'     => $pemesanan->id,
            'total_harga'      => $totalHarga,
            'status_pembayaran'=> Pembayaran::STATUS_BELUM_BAYAR,
        ]);

        return redirect()->route('admin.pemesanan.index')
            ->with('success', "Pesanan #{$pemesanan->nomor_antrian} berhasil dibuat.");
    }

    public function show(Pemesanan $pemesanan)
    {
        $pemesanan->load(['layanan', 'pembayaran']);
        return view('admin.pemesanan.show', compact('pemesanan'));
    }

    public function updateStatus(Request $request, Pemesanan $pemesanan)
    {
        $request->validate([
            'status' => 'required|in:menunggu,dicuci,dijemur,selesai,diambil',
        ]);

        $data = ['status' => $request->status];

        // Catat tanggal selesai saat status berubah ke selesai
        if ($request->status === Pemesanan::STATUS_SELESAI && !$pemesanan->tanggal_selesai) {
            $data['tanggal_selesai'] = now()->toDateString();
        }

        $pemesanan->update($data);

        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui.');
    }

    public function karpetMenumpuk()
    {
        // Karpet sudah selesai tapi belum diambil
        $pemesanans = Pemesanan::with(['layanan', 'pembayaran'])
            ->where('status', Pemesanan::STATUS_SELESAI)
            ->orderBy('tanggal_selesai')
            ->get();

        return view('admin.pemesanan.karpet-menumpuk', compact('pemesanans'));
    }

    public function transaksi(Request $request)
    {
        $query = Pembayaran::with(['pemesanan.layanan'])->latest();

        if ($request->filled('status')) {
            $query->where('status_pembayaran', $request->status);
        }

        $pembayarans = $query->paginate(15)->withQueryString();

        $total_lunas    = Pembayaran::where('status_pembayaran', 'lunas')->sum('total_harga');
        $total_belum    = Pembayaran::where('status_pembayaran', 'belum_bayar')->sum('total_harga');

        return view('admin.transaksi.index', compact('pembayarans', 'total_lunas', 'total_belum'));
    }

    public function updatePembayaran(Request $request, Pembayaran $pembayaran)
    {
        $request->validate([
            'status_pembayaran' => 'required|in:belum_bayar,lunas',
            'metode_pembayaran' => 'nullable|string|max:100',
        ]);

        $data = [
            'status_pembayaran' => $request->status_pembayaran,
            'metode_pembayaran' => $request->metode_pembayaran,
        ];

        if ($request->status_pembayaran === 'lunas') {
            $data['tanggal_bayar'] = now();
        }

        $pembayaran->update($data);

        return redirect()->back()->with('success', 'Status pembayaran berhasil diperbarui.');
    }

    public function laporan(Request $request)
    {
        $tanggal = $request->get('tanggal', now()->toDateString());

        $karpet_dicuci = Pemesanan::whereDate('tanggal_masuk', $tanggal)->sum('jumlah_karpet');

        $pendapatan = Pembayaran::whereHas('pemesanan', function ($q) use ($tanggal) {
            $q->whereDate('tanggal_masuk', $tanggal);
        })->where('status_pembayaran', 'lunas')->sum('total_harga');

        $belum_diambil = Pemesanan::where('status', Pemesanan::STATUS_SELESAI)
            ->with(['layanan', 'pembayaran'])
            ->get();

        $pesanan_hari_ini = Pemesanan::with(['layanan', 'pembayaran'])
            ->whereDate('tanggal_masuk', $tanggal)
            ->get();

        return view('admin.laporan.index', compact(
            'tanggal',
            'karpet_dicuci',
            'pendapatan',
            'belum_diambil',
            'pesanan_hari_ini'
        ));
    }
}
