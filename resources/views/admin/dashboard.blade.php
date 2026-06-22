@extends('admin.layouts.app')

@section('title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div class="row g-3 mb-4">
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-inbox"></i>
                </div>
                <div>
                    <div class="text-muted small">Karpet Masuk Hari Ini</div>
                    <div class="fs-3 fw-bold">{{ $karpet_masuk_hari_ini }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-check-double"></i>
                </div>
                <div>
                    <div class="text-muted small">Pesanan Selesai</div>
                    <div class="fs-3 fw-bold">{{ $pesanan_selesai }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-warning bg-opacity-10 text-warning">
                    <i class="fas fa-layer-group"></i>
                </div>
                <div>
                    <div class="text-muted small">Karpet Belum Diambil</div>
                    <div class="fs-3 fw-bold">{{ $karpet_belum_diambil }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-sm-6 col-xl-3">
        <div class="card stat-card h-100">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-info bg-opacity-10 text-info">
                    <i class="fas fa-money-bill-wave"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Pendapatan</div>
                    <div class="fs-4 fw-bold">Rp {{ number_format($total_pendapatan, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Status Summary --}}
<div class="row g-3 mb-4">
    @php
        $statusList = \App\Models\Pemesanan::statusList();
        $colors = ['menunggu'=>'warning','dicuci'=>'info','dijemur'=>'primary','selesai'=>'success','diambil'=>'secondary'];
    @endphp
    @foreach($statusList as $key => $label)
    <div class="col">
        <div class="card border-0 shadow-sm text-center py-3">
            <div class="fw-bold fs-4 text-{{ $colors[$key] ?? 'dark' }}">
                {{ $status_counts[$key] ?? 0 }}
            </div>
            <div class="text-muted small">{{ $label }}</div>
        </div>
    </div>
    @endforeach
</div>

{{-- Latest Orders --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white d-flex justify-content-between align-items-center py-3">
        <h6 class="mb-0 fw-semibold">Pesanan Terbaru</h6>
        <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-sm btn-outline-primary">
            Lihat Semua
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover mb-0">
                <thead class="table-light">
                    <tr>
                        <th>No. Antrian</th>
                        <th>Pelanggan</th>
                        <th>Layanan</th>
                        <th>Jumlah Karpet</th>
                        <th>Tanggal Masuk</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($latest_pemesanans as $p)
                    <tr>
                        <td><span class="fw-bold text-primary">#{{ $p->nomor_antrian }}</span></td>
                        <td>
                            <div class="fw-semibold">{{ $p->nama }}</div>
                            <small class="text-muted">{{ $p->telepon }}</small>
                        </td>
                        <td>{{ $p->layanan->nama }}</td>
                        <td><span class="badge bg-light text-dark border">{{ $p->jumlah_karpet }} karpet</span></td>
                        <td>{{ $p->tanggal_masuk->format('d M Y') }}</td>
                        <td>
                            <span class="badge badge-status bg-{{ $p->status_color }}">
                                {{ $p->status_label }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada pesanan.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
