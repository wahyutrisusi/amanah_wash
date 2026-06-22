@extends('admin.layouts.app')

@section('title', 'Antrian & Proses Karpet')

@section('content')

{{-- Filter & Actions --}}
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body py-3">
        <form method="GET" class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label small fw-semibold">Cari Pelanggan / No. Antrian</label>
                <input type="text" name="search" class="form-control form-control-sm"
                       value="{{ request('search') }}" placeholder="Nama, telepon, atau nomor antrian...">
            </div>
            <div class="col-md-3">
                <label class="form-label small fw-semibold">Filter Status</label>
                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>
                    @foreach(\App\Models\Pemesanan::statusList() as $key => $label)
                        <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-sm btn-primary">
                    <i class="fas fa-search me-1"></i>Filter
                </button>
                <a href="{{ route('admin.pemesanan.index') }}" class="btn btn-sm btn-outline-secondary ms-1">Reset</a>
            </div>
            <div class="col-auto ms-auto">
                <a href="{{ route('admin.pemesanan.create') }}" class="btn btn-sm btn-success">
                    <i class="fas fa-plus me-1"></i>Input Pesanan
                </a>
            </div>
        </form>
    </div>
</div>

{{-- Status Tabs --}}
@php
    $statusColors = ['menunggu'=>'warning','dicuci'=>'info','dijemur'=>'primary','selesai'=>'success','diambil'=>'secondary'];
    $statusIcons  = ['menunggu'=>'fa-clock','dicuci'=>'fa-tint','dijemur'=>'fa-sun','selesai'=>'fa-check-circle','diambil'=>'fa-box'];
@endphp

{{-- Table --}}
<div class="card border-0 shadow-sm">
    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
        <h6 class="mb-0 fw-semibold">Daftar Pesanan</h6>
        <span class="badge bg-primary">{{ $pemesanans->total() }} pesanan</span>
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
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pemesanans as $p)
                    <tr>
                        <td>
                            <span class="fw-bold text-primary fs-6">#{{ $p->nomor_antrian }}</span>
                        </td>
                        <td>
                            <div class="fw-semibold">{{ $p->nama }}</div>
                            <small class="text-muted"><i class="fas fa-phone me-1"></i>{{ $p->telepon }}</small>
                            @if($p->catatan)
                                <br><small class="text-warning"><i class="fas fa-sticky-note me-1"></i>{{ Str::limit($p->catatan, 40) }}</small>
                            @endif
                        </td>
                        <td>{{ $p->layanan->nama }}</td>
                        <td>
                            <span class="badge bg-light text-dark border fw-semibold">
                                <i class="fas fa-layer-group me-1"></i>{{ $p->jumlah_karpet }}
                            </span>
                        </td>
                        <td>
                            {{ $p->tanggal_masuk->format('d M Y') }}
                            @if($p->tanggal_selesai)
                                <br><small class="text-success"><i class="fas fa-flag-checkered me-1"></i>Selesai: {{ $p->tanggal_selesai->format('d M Y') }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge badge-status bg-{{ $p->status_color }}">
                                <i class="fas {{ $statusIcons[$p->status] ?? 'fa-circle' }} me-1"></i>
                                {{ $p->status_label }}
                            </span>
                        </td>
                        <td>
                            {{-- Update Status Dropdown --}}
                            <div class="dropdown d-inline-block">
                                <button class="btn btn-sm btn-outline-primary dropdown-toggle" data-bs-toggle="dropdown">
                                    Update Status
                                </button>
                                <ul class="dropdown-menu">
                                    @foreach(\App\Models\Pemesanan::statusList() as $key => $label)
                                    <li>
                                        <form action="{{ route('admin.pemesanan.update-status', $p) }}" method="POST">
                                            @csrf @method('PATCH')
                                            <input type="hidden" name="status" value="{{ $key }}">
                                            <button type="submit"
                                                    class="dropdown-item {{ $p->status == $key ? 'fw-bold text-primary' : '' }}">
                                                <i class="fas {{ $statusIcons[$key] }} me-2 text-{{ $statusColors[$key] }}"></i>
                                                {{ $label }}
                                                @if($p->status == $key) <i class="fas fa-check ms-1 text-primary"></i> @endif
                                            </button>
                                        </form>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <a href="{{ route('admin.pemesanan.show', $p) }}"
                               class="btn btn-sm btn-outline-secondary ms-1" title="Detail">
                                <i class="fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-5">
                            <i class="fas fa-inbox fa-2x mb-2 d-block"></i>
                            Tidak ada pesanan ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($pemesanans->hasPages())
    <div class="card-footer bg-white">
        {{ $pemesanans->links() }}
    </div>
    @endif
</div>

@endsection
