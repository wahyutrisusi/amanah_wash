@extends('admin.layouts.app')

@section('title', 'Karpet Menumpuk — Belum Diambil')

@section('content')

<div class="alert alert-warning d-flex align-items-center gap-3 mb-4">
    <i class="fas fa-exclamation-triangle fa-2x"></i>
    <div>
        <strong>Perhatian!</strong> Berikut adalah karpet yang sudah selesai dicuci namun <strong>belum diambil</strong> oleh pelanggan.
        Segera hubungi pelanggan untuk pengambilan.
    </div>
</div>

<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold">
            <i class="fas fa-layer-group me-2 text-warning"></i>Karpet Selesai — Belum Diambil
        </h6>
        <span class="badge bg-warning text-dark">{{ $pemesanans->count() }} pesanan</span>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Antrian</th>
                        <th>Nama Pelanggan</th>
                        <th>No. HP</th>
                        <th>Jumlah Karpet</th>
                        <th>Tanggal Selesai</th>
                        <th>Lama Menunggu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesanans as $p)
                    @php
                        $hariMenunggu = $p->tanggal_selesai
                            ? now()->diffInDays($p->tanggal_selesai)
                            : null;
                    @endphp
                    <tr class="{{ $hariMenunggu >= 3 ? 'table-danger' : ($hariMenunggu >= 1 ? 'table-warning' : '') }}">
                        <td><span class="fw-bold text-primary">#{{ $p->nomor_antrian }}</span></td>
                        <td>
                            <div class="fw-semibold">{{ $p->nama }}</div>
                            <small class="text-muted">{{ $p->layanan->nama }}</small>
                        </td>
                        <td>{{ $p->telepon }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                <i class="fas fa-layer-group me-1"></i>{{ $p->jumlah_karpet }} karpet
                            </span>
                        </td>
                        <td>
                            @if($p->tanggal_selesai)
                                {{ $p->tanggal_selesai->format('d M Y') }}
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            @if($hariMenunggu !== null)
                                <span class="badge {{ $hariMenunggu >= 3 ? 'bg-danger' : ($hariMenunggu >= 1 ? 'bg-warning text-dark' : 'bg-success') }}">
                                    {{ $hariMenunggu }} hari
                                </span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            {{-- Hubungi via WhatsApp --}}
                            @php
                                $noWa = preg_replace('/^0/', '62', $p->telepon);
                                $pesan = urlencode("Halo {$p->nama}, karpet Anda (#{$p->nomor_antrian}) sudah selesai dicuci dan siap diambil. Terima kasih.");
                            @endphp
                            <a href="https://wa.me/{{ $noWa }}?text={{ $pesan }}"
                               target="_blank" class="btn btn-sm btn-success" title="Hubungi via WhatsApp">
                                <i class="fab fa-whatsapp me-1"></i>Hubungi
                            </a>

                            {{-- Tandai Diambil --}}
                            <form action="{{ route('admin.pemesanan.update-status', $p) }}" method="POST" class="d-inline">
                                @csrf @method('PATCH')
                                <input type="hidden" name="status" value="diambil">
                                <button type="submit" class="btn btn-sm btn-outline-secondary ms-1"
                                        onclick="return confirm('Tandai karpet ini sudah diambil?')">
                                    <i class="fas fa-box me-1"></i>Diambil
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-check-circle fa-2x text-success mb-2 d-block"></i>
                            Tidak ada karpet yang menumpuk. Semua sudah diambil!
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
