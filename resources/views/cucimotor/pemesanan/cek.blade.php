@extends('layouts.app')

@section('title', 'Cek Pemesanan')

@section('custom_css')
    .status-badge {
        padding: 8px 15px;
        border-radius: 20px;
        font-weight: 500;
    }
    .status-pending {
        background-color: #fef3c7;
        color: #92400e;
    }
    .status-confirmed {
        background-color: #dbeafe;
        color: #1e40af;
    }
    .status-completed {
        background-color: #dcfce7;
        color: #166534;
    }
    .status-cancelled {
        background-color: #fee2e2;
        color: #991b1b;
    }
@endsection

@section('content')
    <!-- Header Section -->
    <section class="bg-primary text-white py-5 mt-5">
        <div class="container py-5">
            <h1 class="display-4 fw-bold">Detail Pemesanan</h1>
            <p class="lead">Cek status pemesanan Anda</p>
        </div>
    </section>

    <!-- Tambahkan di bawah header section -->
    @if(session('success'))
    <div class="container mt-4">
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <p class="mb-0 mt-2"><small>Simpan kode pemesanan ini untuk mengecek status pesanan Anda.</small></p>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <!-- Tambahkan setelah header section -->
    @if(session('error'))
    <div class="container mt-4">
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    </div>
    @endif

    <!-- Detail Pemesanan Section -->
    <section class="py-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="text-center mb-4">
                                <h4>Kode Pemesanan: #{{ str_pad($pemesanan->id, 5, '0', STR_PAD_LEFT) }}</h4>
                                <span class="status-badge status-{{ $pemesanan->status }}">
                                    {{ ucfirst($pemesanan->status) }}
                                </span>
                            </div>

                            <div class="row mb-4">
                                <div class="col-md-6">
                                    <h5 class="mb-3">Informasi Pelanggan</h5>
                                    <p class="mb-1"><strong>Nama:</strong> {{ $pemesanan->nama }}</p>
                                    <p class="mb-1"><strong>Telepon:</strong> {{ $pemesanan->telepon }}</p>
                                    <p class="mb-1"><strong>Alamat:</strong> {{ $pemesanan->alamat}}</p>
                                    <p class="mb-1"><strong>Tanggal:</strong> {{ $pemesanan->tanggal->format('d M Y') }}</p>
                                    <p class="mb-1"><strong>Waktu:</strong> {{ $pemesanan->waktu }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="mb-3">Detail Layanan</h5>
                                    <p class="mb-1"><strong>Layanan:</strong> {{ $pemesanan->layanan->nama }}</p>
                                    <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($pemesanan->layanan->harga, 0, ',', '.') }}</p>
                                    @if($pemesanan->catatan)
                                        <p class="mb-1"><strong>Catatan:</strong> {{ $pemesanan->catatan }}</p>
                                    @endif
                                </div>
                            </div>

                            <div class="timeline mb-4">
                                <h5 class="mb-3">Status Pemesanan</h5>
                                <div class="d-flex justify-content-between">
                                    <div class="text-center">
                                        <div class="@if($pemesanan->status != 'cancelled') bg-primary @else bg-secondary @endif text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                            <i class="fas fa-clipboard-check"></i>
                                        </div>
                                        <p class="small mb-0">Dipesan</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="@if($pemesanan->status == 'confirmed' || $pemesanan->status == 'completed') bg-primary @else bg-secondary @endif text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                            <i class="fas fa-check"></i>
                                        </div>
                                        <p class="small mb-0">Dikonfirmasi</p>
                                    </div>
                                    <div class="text-center">
                                        <div class="@if($pemesanan->status == 'completed') bg-primary @else bg-secondary @endif text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-2" style="width: 40px; height: 40px;">
                                            <i class="fas fa-flag-checkered"></i>
                                        </div>
                                        <p class="small mb-0">Selesai</p>
                                    </div>
                                </div>
                            </div>

                            <div class="text-center">
                                <a href="{{ route('pemesanan') }}" class="btn btn-outline-primary">
                                    <i class="fas fa-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection 