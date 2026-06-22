@extends('layouts.app')

@section('title', 'Beranda')

@section('custom_css')
        .hero-section {
            background: linear-gradient(rgba(27, 87, 102, 0.86), rgba(132, 205, 214, 0.71)), url('https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png');
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            align-items: center;
        }
        .feature-card {
            transition: transform 0.3s;
        }
        .feature-card:hover {
            transform: translateY(-10px);
        }
        .service-highlight {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        .service-highlight:hover {
            transform: translateY(-5px);
        }
        .service-highlight img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }
        .service-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(0,0,0,0.8));
            padding: 20px;
            color: white;
        }
        .price-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: rgba(40, 80, 99, 0.9);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-weight: 500;
        }
@endsection

@section('content')
    <!-- Hero Section -->
        <section class="hero-section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-8 text-white">
                        <h1 class="display-4 fw-bold mb-4">Layanan Cuci Motor & Karpet</h1>
                        <p class="lead mb-4">Kami menyediakan layanan cuci motor dan karpet profesional dengan hasil maksimal dan harga terjangkau.</p>
                        <a href="{{ route('pemesanan') }}" class="btn btn-primary btn-lg px-5 py-3">
                            <i class="fas fa-calendar-check me-2"></i>Pesan Sekarang
                        </a>
                    </div>
                </div>
            </div>
        </section>

    <!-- Layanan Unggulan -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-2">Layanan Unggulan</h2>
            <p class="text-center text-muted mb-5">Pilihan layanan terbaik untuk kendaraan Anda</p>
            
            <div class="row g-4">
                <!-- Cuci Motor Premium -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-highlight shadow">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" alt="Cuci Motor Premium">
                        <span class="price-badge">Rp 35.000</span>
                        <div class="service-overlay">
                            <h5 class="mb-2">Cuci Motor Premium</h5>
                            <p class="mb-0 small">Includes deep cleaning, wax coating & engine cleaning</p>
                            <a href="{{ route('pemesanan') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-calendar-check me-1"></i>Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Detailing Motor -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-highlight shadow">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" alt="Detailing Motor">
                        <span class="price-badge">Rp 20.000</span>
                        <div class="service-overlay">
                            <h5 class="mb-2">Detailing Motor</h5>
                            <p class="mb-0 small">Full detailing dengan coating & paint protection</p>
                            <a href="{{ route('pemesanan') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-calendar-check me-1"></i>Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Cuci Karpet Premium -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-highlight shadow">
                        <img src="https://kflaundry.com/wp-content/uploads/2020/07/Cuci-Karpet-KF-Laundry-Mampang-Jakarta-Selatan.png" alt="Cuci Karpet Premium">
                        <span class="price-badge">Rp 30.000</span>
                        <div class="service-overlay">
                            <h5 class="mb-2">Cuci Karpet Premium</h5>
                            <p class="mb-0 small">Deep cleaning dengan vacuum & sterilisasi</p>
                            <a href="{{ route('pemesanan') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-calendar-check me-1"></i>Pesan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Poles Motor -->
                <div class="col-md-6 col-lg-3">
                    <div class="service-highlight shadow">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" alt="Poles Motor">
                        <span class="price-badge">Rp 20.000</span>
                        <div class="service-overlay">
                            <h5 class="mb-2">cuci karpet besar</h5>
                            <p class="mb-0 small">Poles body & mesin hingga mengkilap maksimal</p>
                            <a href="{{ route('pemesanan') }}" class="btn btn-sm btn-primary mt-2">
                                <i class="fas fa-calendar-check me-1"></i>Pesan
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center mt-5">
                <a href="{{ route('layanan') }}" class="btn btn-outline-primary">
                    <i class="fas fa-th-list me-2"></i>Lihat Semua Layanan
                </a>
            </div>
        </div>
    </section>

    <!-- Keunggulan -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5 fw-bold">Mengapa Memilih Kami?</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card h-100 feature-card border-0 shadow">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-award text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h3 class="h4 card-title">Kualitas Terbaik</h3>
                            <p class="card-text">Menggunakan peralatan dan bahan pembersih premium untuk hasil maksimal</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card border-0 shadow">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-tags text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h3 class="h4 card-title">Harga Terjangkau</h3>
                            <p class="card-text">Harga bersaing dengan kualitas premium yang tidak mengecewakan</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card h-100 feature-card border-0 shadow">
                        <div class="card-body text-center p-4">
                            <i class="fas fa-bolt text-primary mb-3" style="font-size: 2.5rem;"></i>
                            <h3 class="h4 card-title">Pelayanan Cepat</h3>
                            <p class="card-text">Proses pengerjaan cepat dengan hasil yang tetap maksimal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimoni Pelanggan -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-2">Testimoni Pelanggan</h2>
            <p class="text-center text-muted mb-5">Apa kata mereka tentang layanan kami</p>

            <div class="row g-4">
                <!-- Testimoni 1 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://ui-avatars.com/api/?name=Ahmad+Sudrajat&background=random" 
                                     class="rounded-circle me-3" width="60" height="60" 
                                     alt="Testimonial">
                                <div>
                                    <h5 class="mb-0">Ahmad Sudrajat</h5>
                                    <small class="text-muted">Pelanggan Reguler</small>
                                </div>
                            </div>
                            <div class="text-warning mb-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text mb-0">"Pelayanannya sangat ramah dan profesional. Hasil cucian motornya sangat bersih dan mengkilap. Recommended banget!"</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 2 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=random" 
                                     class="rounded-circle me-3" width="60" height="60" 
                                     alt="Testimonial">
                                <div>
                                    <h5 class="mb-0">Jibral ramadani laili</h5>
                                    <small class="text-muted">Pelanggan Karpet</small>
                                </div>
                            </div>
                            <div class="text-warning mb-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="card-text mb-0">"Karpet jadi bersih seperti baru, noda-noda bandel hilang semua. Pengerjaan cepat dan hasilnya memuaskan."</p>
                        </div>
                    </div>
                </div>

                <!-- Testimoni 3 -->
                <div class="col-md-4">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center mb-3">
                                <img src="https://ui-avatars.com/api/?name=Budi+Santoso&background=random" 
                                     class="rounded-circle me-3" width="60" height="60" 
                                     alt="Testimonial">
                                <div>
                                    <h5 class="mb-0">Budi Prastio</h5>
                                    <small class="text-muted">Pelanggan Premium</small>
                                </div>
                            </div>
                            <div class="text-warning mb-3">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="card-text mb-0">"Paket premium worth it banget! Motor jadi bersih mengkilap dan wangi. Staff-nya juga ramah dan profesional."</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Button -->
            <div class="text-center mt-5">
                <a href="{{ route('pemesanan') }}" class="btn btn-primary btn-lg">
                    <i class="fas fa-calendar-check me-2"></i>Pesan Sekarang
                </a>
            </div>
        </div>
    </section>
@endsection

@section('additional_scripts')
<script>
    // Animasi sederhana untuk card testimoni
    document.addEventListener('DOMContentLoaded', function() {
        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            setTimeout(() => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
                card.style.transition = 'all 0.5s ease';
                
                setTimeout(() => {
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 200);
            }, 0);
        });
    });
</script>
@endsection 