@extends('layouts.app')

@section('title', 'Layanan')

@section('custom_css')
    .hero-section {
        background: linear-gradient(rgba(27, 87, 102, 0.86), rgba(132, 205, 214, 0.71)), url('https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png');
        background-size: cover;
        background-position: center;
        height: 60vh;
        display: flex;
        align-items: center;
    }
    .service-card {
        transition: transform 0.5s;
    }
    .service-card:hover {
        transform: translateY(-5px);
    }
    .price-tag {
        background:rgb(95, 152, 228);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        display: inline-block;
    }
@endsection

@section('content')
    <!-- Header Section -->
    <section class="hero-section text-white">
        <div class="container">
            <h1 class="display-4 fw-bold mb-4">Layanan Kami</h1>
            <p class="lead mb-4">Berbagai pilihan layanan premium untuk kendaraan dan karpet Anda</p>
        </div>
    </section>

    <!-- Layanan Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                @foreach($layanan as $item)
                <div class="col-md-6">
                    <div class="card h-100 service-card border-0 shadow">
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h3 class="card-title h4">{{ $item->nama }}</h3>
                                <span class="price-tag">Rp {{ number_format($item->harga_per_karpet, 0, ',', '.') }}/karpet</span>
                            </div>
                            <p class="card-text">{{ $item->deskripsi }}</p>
                            <a href="{{ route('pemesanan') }}" class="btn btn-primary">
                                <i class="fas fa-calendar-check me-2"></i>Cek Pesanan
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Proses Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Proses Pencucian</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-clipboard-list fa-2x"></i>
                        </div>
                        <h4>Pemesanan</h4>
                        <p>Pilih layanan dan jadwal yang diinginkan</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-soap fa-2x"></i>
                        </div>
                        <h4>Pencucian</h4>
                        <p>Proses pencucian dengan peralatan premium</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </div>
                        <h4>Pengecekan</h4>
                        <p>Quality control hasil pencucian</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-center">
                        <div class="bg-primary text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 80px; height: 80px;">
                            <i class="fas fa-smile fa-2x"></i>
                        </div>
                        <h4>Selesai</h4>
                        <p>Siap digunakan kembali</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection