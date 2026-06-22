@extends('layouts.app')

@section('title', 'Beranda')

@section('custom_css')
    .hero-section {
        background: linear-gradient(rgba(15, 60, 90, 0.82), rgba(20, 120, 150, 0.75)),
                    url('https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1600') center/cover no-repeat;
        min-height: 100vh;
        display: flex;
        align-items: center;
    }
    .feature-card { transition: transform 0.3s; }
    .feature-card:hover { transform: translateY(-8px); }
    .service-highlight {
        position: relative;
        overflow: hidden;
        border-radius: 14px;
        transition: all 0.3s ease;
        box-shadow: 0 4px 16px rgba(0,0,0,.12);
    }
    .service-highlight:hover { transform: translateY(-6px); box-shadow: 0 8px 24px rgba(0,0,0,.18); }
    .service-highlight img { width: 100%; height: 220px; object-fit: cover; }
    .service-overlay {
        position: absolute; bottom: 0; left: 0; right: 0;
        background: linear-gradient(transparent, rgba(10,50,80,.85));
        padding: 20px; color: #fff;
    }
    .price-badge {
        position: absolute; top: 12px; right: 12px;
        background: rgba(13,110,253,.9); color: #fff;
        padding: 4px 14px; border-radius: 20px; font-weight: 600; font-size: 13px;
    }
    .step-circle {
        width: 56px; height: 56px; border-radius: 50%;
        background: #0d6efd; color: #fff;
        display: flex; align-items: center; justify-content: center;
        font-size: 22px; margin: 0 auto 12px;
    }
@endsection

@section('content')

{{-- Hero --}}
<section class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7 text-white">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2">
                    <i class="fas fa-soap me-1"></i> Layanan Cuci Karpet Profesional
                </span>
                <h1 class="display-4 fw-bold mb-3">Karpet Bersih,<br>Rumah Nyaman</h1>
                <p class="lead mb-4 opacity-90">
                    Kami hadir untuk membersihkan karpet Anda dengan peralatan modern dan bahan ramah lingkungan.
                    Hasil bersih, wangi, dan siap pakai.
                </p>
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('pemesanan') }}" class="btn btn-primary btn-lg px-5 py-3">
                        <i class="fas fa-search me-2"></i>Cek Status Pesanan
                    </a>
                    <a href="{{ route('layanan') }}" class="btn btn-outline-light btn-lg px-4 py-3">
                        <i class="fas fa-list me-2"></i>Lihat Layanan
                    </a>
                </div>
                <div class="mt-4 d-flex gap-4 text-white-50 small">
                    <span><i class="fas fa-check-circle text-success me-1"></i>Antar Jemput</span>
                    <span><i class="fas fa-check-circle text-success me-1"></i>Notifikasi WhatsApp</span>
                    <span><i class="fas fa-check-circle text-success me-1"></i>Hasil Terjamin</span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Cara Kerja --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-2">Cara Kerja Kami</h2>
        <p class="text-center text-muted mb-5">Proses mudah, hasil memuaskan</p>
        <div class="row g-4 text-center">
            <div class="col-md-3">
                <div class="step-circle"><i class="fas fa-phone-alt"></i></div>
                <h5 class="fw-semibold">1. Hubungi Kami</h5>
                <p class="text-muted small">Hubungi via WhatsApp atau datang langsung ke toko kami.</p>
            </div>
            <div class="col-md-3">
                <div class="step-circle"><i class="fas fa-truck"></i></div>
                <h5 class="fw-semibold">2. Antar Karpet</h5>
                <p class="text-muted small">Antar karpet ke toko atau kami jemput ke lokasi Anda.</p>
            </div>
            <div class="col-md-3">
                <div class="step-circle"><i class="fas fa-soap"></i></div>
                <h5 class="fw-semibold">3. Proses Cuci</h5>
                <p class="text-muted small">Karpet dicuci, dijemur, dan dirapikan oleh tim profesional kami.</p>
            </div>
            <div class="col-md-3">
                <div class="step-circle"><i class="fas fa-box-open"></i></div>
                <h5 class="fw-semibold">4. Ambil / Diantar</h5>
                <p class="text-muted small">Ambil sendiri atau kami antar kembali ke rumah Anda.</p>
            </div>
        </div>
    </div>
</section>

{{-- Layanan Unggulan --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-2">Layanan Unggulan</h2>
        <p class="text-center text-muted mb-5">Pilihan layanan cuci karpet terbaik untuk rumah Anda</p>

        <div class="row g-4">
            <div class="col-md-6 col-lg-3">
                <div class="service-highlight">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=400" alt="Cuci Karpet Reguler">
                    <span class="price-badge">Rp 25.000/karpet</span>
                    <div class="service-overlay">
                        <h5 class="mb-1">Cuci Karpet Reguler</h5>
                        <p class="mb-2 small opacity-90">Cocok untuk karpet tipis & sedang sehari-hari.</p>
                        <a href="{{ route('pemesanan') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-search me-1"></i>Cek Pesanan
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-highlight">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=400" alt="Cuci Karpet Premium">
                    <span class="price-badge">Rp 45.000/karpet</span>
                    <div class="service-overlay">
                        <h5 class="mb-1">Cuci Karpet Premium</h5>
                        <p class="mb-2 small opacity-90">Untuk karpet tebal & berbulu dengan bahan khusus.</p>
                        <a href="{{ route('pemesanan') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-search me-1"></i>Cek Pesanan
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-highlight">
                    <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=400" alt="Cuci Karpet Besar">
                    <span class="price-badge">Rp 75.000/karpet</span>
                    <div class="service-overlay">
                        <h5 class="mb-1">Cuci Karpet Besar</h5>
                        <p class="mb-2 small opacity-90">Karpet ukuran besar (>3m²) dengan pengeringan ekstra.</p>
                        <a href="{{ route('pemesanan') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-search me-1"></i>Cek Pesanan
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="service-highlight">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=400" alt="Cuci Karpet Express">
                    <span class="price-badge">Hubungi Kami</span>
                    <div class="service-overlay">
                        <h5 class="mb-1">Layanan Express</h5>
                        <p class="mb-2 small opacity-90">Selesai dalam 1 hari untuk kebutuhan mendesak.</p>
                        <a href="{{ route('kontak') }}" class="btn btn-sm btn-warning text-dark">
                            <i class="fas fa-phone me-1"></i>Hubungi
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <a href="{{ route('layanan') }}" class="btn btn-outline-primary px-5">
                <i class="fas fa-th-list me-2"></i>Lihat Semua Layanan
            </a>
        </div>
    </div>
</section>

{{-- Keunggulan --}}
<section class="py-5 bg-light">
    <div class="container">
        <h2 class="text-center fw-bold mb-5">Mengapa Memilih Kami?</h2>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 feature-card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-award text-primary mb-3" style="font-size:2.5rem"></i>
                        <h5 class="fw-semibold">Kualitas Terjamin</h5>
                        <p class="text-muted">Menggunakan mesin cuci karpet profesional dan deterjen ramah lingkungan untuk hasil bersih maksimal.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-bell text-primary mb-3" style="font-size:2.5rem"></i>
                        <h5 class="fw-semibold">Notifikasi Real-time</h5>
                        <p class="text-muted">Anda akan mendapat notifikasi WhatsApp saat karpet selesai dicuci dan siap diambil.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 feature-card border-0 shadow-sm">
                    <div class="card-body text-center p-4">
                        <i class="fas fa-tags text-primary mb-3" style="font-size:2.5rem"></i>
                        <h5 class="fw-semibold">Harga Transparan</h5>
                        <p class="text-muted">Harga per karpet yang jelas, tidak ada biaya tersembunyi. Bayar sesuai jumlah karpet Anda.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Cek Status Pesanan CTA --}}
<section class="py-5" style="background: linear-gradient(135deg, #0d6efd, #0a4fa0);">
    <div class="container text-center text-white">
        <h2 class="fw-bold mb-3">Sudah Menitipkan Karpet?</h2>
        <p class="lead mb-4 opacity-90">Cek status karpet Anda kapan saja menggunakan nomor antrian.</p>
        <a href="{{ route('pemesanan') }}" class="btn btn-light btn-lg px-5 py-3 fw-semibold">
            <i class="fas fa-search me-2"></i>Cek Status Pesanan
        </a>
    </div>
</section>

{{-- Testimoni --}}
<section class="py-5">
    <div class="container">
        <h2 class="text-center fw-bold mb-2">Testimoni Pelanggan</h2>
        <p class="text-center text-muted mb-5">Apa kata mereka tentang layanan kami</p>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://ui-avatars.com/api/?name=Ahmad+Sudrajat&background=0d6efd&color=fff"
                                 class="rounded-circle me-3" width="52" height="52" alt="Ahmad">
                            <div>
                                <h6 class="mb-0 fw-semibold">Ahmad Sudrajat</h6>
                                <small class="text-muted">Pelanggan Reguler</small>
                            </div>
                        </div>
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted mb-0 small">"Karpet ruang tamu saya yang sudah bertahun-tahun kotor akhirnya bersih seperti baru. Pelayanannya cepat dan ramah!"</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=198754&color=fff"
                                 class="rounded-circle me-3" width="52" height="52" alt="Siti">
                            <div>
                                <h6 class="mb-0 fw-semibold">Siti Aminah</h6>
                                <small class="text-muted">Pelanggan Karpet Premium</small>
                            </div>
                        </div>
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                        </div>
                        <p class="text-muted mb-0 small">"Karpet bulu tebal saya dicuci bersih, noda bandel hilang semua. Dapat notifikasi WhatsApp saat selesai, sangat membantu!"</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center mb-3">
                            <img src="https://ui-avatars.com/api/?name=Budi+Prastio&background=dc3545&color=fff"
                                 class="rounded-circle me-3" width="52" height="52" alt="Budi">
                            <div>
                                <h6 class="mb-0 fw-semibold">Budi Prastio</h6>
                                <small class="text-muted">Pelanggan Setia</small>
                            </div>
                        </div>
                        <div class="text-warning mb-2">
                            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                            <i class="fas fa-star"></i><i class="fas fa-star"></i>
                        </div>
                        <p class="text-muted mb-0 small">"Sudah langganan 2 tahun. Harga per karpet jelas, tidak ada biaya tambahan. Hasilnya selalu memuaskan!"</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
