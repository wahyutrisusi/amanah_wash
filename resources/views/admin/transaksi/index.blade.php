@extends('admin.layouts.app')

@section('title', 'Transaksi Pembayaran')

@section('content')

{{-- Summary Cards --}}
<div class="row g-3 mb-4">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-success bg-opacity-10 text-success">
                    <i class="fas fa-check-circle"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Lunas</div>
                    <div class="fs-5 fw-bold text-success">Rp {{ number_format($total_lunas, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-danger bg-opacity-10 text-danger">
                    <i class="fas fa-clock"></i>
                </div>
                <div>
                    <div class="text-muted small">Belum Dibayar</div>
                    <div class="fs-5 fw-bold text-danger">Rp {{ number_format($total_belum, 0, ',', '.') }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card border-0 shadow-sm">
            <div class="card-body d-flex align-items-center gap-3">
                <div class="stat-icon bg-primary bg-opacity-10 text-primary">
                    <i class="fas fa-receipt"></i>
                </div>
                <div>
                    <div class="text-muted small">Total Transaksi</div>
                    <div class="fs-5 fw-bold">{{ $pembayarans->total() }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Filter --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Filter Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua</option>
                    <option value="belum_bayar" {{ request('status') == 'belum_bayar' ? 'selected' : '' }}>Belum Bayar</option>
                    <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>Lunas</option>
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-filter me-1"></i>Filter
                </button>
                <a href="{{ route('admin.transaksi.index') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
            </div>
        </form>
    </div>
</div>

{{-- Table --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3">
        <h6 class="mb-0 fw-semibold">Riwayat Pembayaran</h6>
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
                        <th>Total Harga</th>
                        <th>Status Bayar</th>
                        <th>Metode</th>
                        <th>Tanggal Bayar</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pembayarans as $bayar)
                    <tr>
                        <td>
                            <a href="{{ route('admin.pemesanan.show', $bayar->pemesanan) }}" class="fw-bold text-primary">
                                #{{ $bayar->pemesanan->nomor_antrian }}
                            </a>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $bayar->pemesanan->nama }}</div>
                            <small class="text-muted">{{ $bayar->pemesanan->telepon }}</small>
                        </td>
                        <td>{{ $bayar->pemesanan->layanan->nama }}</td>
                        <td>
                            <span class="badge bg-light text-dark border">
                                {{ $bayar->pemesanan->jumlah_karpet }} karpet
                            </span>
                        </td>
                        <td class="fw-semibold">Rp {{ number_format($bayar->total_harga, 0, ',', '.') }}</td>
                        <td>
                            <span class="badge {{ $bayar->status_pembayaran == 'lunas' ? 'bg-success' : 'bg-danger' }}">
                                {{ $bayar->status_pembayaran == 'lunas' ? 'Lunas' : 'Belum Bayar' }}
                            </span>
                        </td>
                        <td>{{ $bayar->metode_pembayaran ?? '—' }}</td>
                        <td>
                            {{ $bayar->tanggal_bayar ? $bayar->tanggal_bayar->format('d M Y') : '—' }}
                        </td>
                        <td>
                            @if($bayar->status_pembayaran != 'lunas')
                            <div class="dropdown">
                                <button class="btn btn-sm btn-outline-success dropdown-toggle" data-bs-toggle="dropdown">
                                    Tandai Lunas
                                </button>
                                <div class="dropdown-menu p-3" style="min-width:200px">
                                    <form action="{{ route('admin.transaksi.update-status', $bayar) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status_pembayaran" value="lunas">
                                        <select name="metode_pembayaran" class="form-select form-select-sm mb-2">
                                            <option value="">Pilih Metode</option>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Transfer Bank">Transfer Bank</option>
                                            <option value="QRIS">QRIS</option>
                                            <option value="GoPay">GoPay</option>
                                            <option value="OVO">OVO</option>
                                        </select>
                                        <button type="submit" class="btn btn-sm btn-success w-100">
                                            <i class="fas fa-check me-1"></i>Konfirmasi
                                        </button>
                                    </form>
                                </div>
                            </div>
                            @else
                            <span class="text-muted small">—</span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="9" class="text-center text-muted py-5">
                            <i class="fas fa-receipt fa-2x mb-2 d-block"></i>
                            Tidak ada data transaksi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pembayarans->hasPages())
    <div class="card-footer bg-white">
        {{ $pembayarans->links() }}
    </div>
    @endif
</div>

@endsection
