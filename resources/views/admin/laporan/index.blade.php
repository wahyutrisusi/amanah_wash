@extends('admin.layouts.app')

@section('title', 'Laporan Harian')

@section('content')

{{-- Date Picker --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Pilih Tanggal</label>
                <input type="date" name="tanggal" class="form-control form-control-sm"
                       value="{{ $tanggal }}" max="{{ now()->toDateString() }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-chart-bar me-1"></i>Tampilkan
                </button>
            </div>
            <div class="col-auto ms-auto">
                <span class="text-muted small">
                    Laporan untuk: <strong>{{ \Carbon\Carbon::parse($tanggal)->translatedFormat('l, d F Y') }}</strong>
                </span>
            </div>
        </form>
    </div>
</div>

{{-- Summary Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-soap"></i>
                </div>
                <div>
                    <div class="text-muted small">Karpet Dicuci Hari Ini</div>
                    <div class="fs-3 fw-bold">{{ $karpet_dicuci }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div>
                    <div class="text-muted small">Pendapatan Hari Ini</div>
                    <div class="fs-4 fw-bold text-success">Rp {{ number_format($pendapatan, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div>
                    <div class="text-muted small">Karpet Belum Diambil</div>
                    <div class="fs-3 fw-bold">{{ $belum_diambil->sum('jumlah_karpet') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    {{-- Pesanan Hari Ini --}}
    <div class="col-lg-7">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3">
                <h6 class="mb-0 fw-semibold">
                    <i class="fas fa-list me-2 text-primary"></i>
                    Pesanan Masuk — {{ \Carbon\Carbon::parse($tanggal)->format('d M Y') }}
                </h6>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>No. Antrian</th>
                                <th>Pelanggan</th>
                                <th>Jumlah Karpet</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Bayar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($pesanan_hari_ini as $p)
                            <tr>
                                <td><span class="fw-bold text-primary">#{{ $p->nomor_antrian }}</span></td>
                                <td>
                                    <div class="fw-semibold">{{ $p->nama }}</div>
                                    <small class="text-muted">{{ $p->telepon }}</small>
                                </td>
                                <td>{{ $p->jumlah_karpet }}</td>
                                <td>
                                    @if($p->pembayaran)
                                        Rp {{ number_format($p->pembayaran->total_harga, 0, ',', '.') }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-{{ $p->status_color }}">{{ $p->status_label }}</span>
                                </td>
                                <td>
                                    @if($p->pembayaran)
                                        <span class="badge {{ $p->pembayaran->status_pembayaran == 'lunas' ? 'bg-success' : 'bg-danger' }}">
                                            {{ $p->pembayaran->status_pembayaran == 'lunas' ? 'Lunas' : 'Belum' }}
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    Tidak ada pesanan pada tanggal ini.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        @if($pesanan_hari_ini->count() > 0)
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="2" class="fw-semibold">Total</td>
                                <td class="fw-semibold">{{ $pesanan_hari_ini->sum('jumlah_karpet') }} karpet</td>
                                <td class="fw-semibold text-success">
                                    Rp {{ number_format($pesanan_hari_ini->sum(fn($p) => optional($p->pembayaran)->total_harga ?? 0), 0, ',', '.') }}
                                </td>
                                <td colspan="2"></td>
                            </tr>
                        </tfoot>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Karpet Belum Diambil --}}
    <div class="col-lg-5">
        <div class="card border-0 shadow-sm">
            <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                <h6 class="mb-0 fw-semibold">
                    <i class="fas fa-layer-group me-2 text-warning"></i>Karpet Belum Diambil
                </h6>
                <a href="{{ route('admin.karpet-menumpuk') }}" class="btn btn-sm btn-outline-warning">
                    Lihat Semua
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Pelanggan</th>
                                <th>No. HP</th>
                                <th>Selesai</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($belum_diambil as $p)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $p->nama }}</div>
                                    <small class="text-muted">{{ $p->jumlah_karpet }} karpet</small>
                                </td>
                                <td>{{ $p->telepon }}</td>
                                <td>
                                    @if($p->tanggal_selesai)
                                        {{ $p->tanggal_selesai->format('d M') }}
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center text-muted py-4">
                                    <i class="fas fa-check-circle text-success me-1"></i>Semua sudah diambil
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
