@extends('layouts.app')

@section('title', 'Galeri')

@section('additional_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endsection

@section('custom_css')
    .hero-section {
        background: linear-gradient(rgba(27, 87, 102, 0.86), rgba(132, 205, 214, 0.71)), url('https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png');
        background-size: cover;
        background-position: center;
        height: 60vh;
        display: flex;
        align-items: center;
    }
    .gallery-item {
        transition: transform 0.3s;
        margin-bottom: 30px;
    }
    .gallery-item:hover {
        transform: scale(1.03);
    }
    .service-card {
        transition: transform 0.5s;
    }
    .service-card:hover {
        transform: translateY(-5px);
    }
    .testimonial-card {
        border-radius: 15px;
        border: none;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
@endsection

@section('content')
    <!-- Header Section -->
    <section class="hero-section text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">Galeri Kami</h1>
            <p class="lead">Lihat hasil kerja terbaik kami dalam melayani pelanggan</p>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Hasil Kerja Kami</h2>
            <div class="row g-4">
                <!-- Motor Section -->
                <div class="col-md-4">
                    <a href="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" data-lightbox="gallery" class="gallery-item">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" class="img-fluid rounded shadow" alt="Motor Sebelum-Sesudah">
                        <div class="mt-2">
                            <h5>Cuci Motor Premium</h5>
                            <p class="text-muted">Hasil cucian mengkilap</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" data-lightbox="gallery" class="gallery-item">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" class="img-fluid rounded shadow" alt="Motor Sebelum-Sesudah">
                        <div class="mt-2">
                            <h5>Detailing Motor</h5>
                            <p class="text-muted">Perawatan menyeluruh</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" data-lightbox="gallery" class="gallery-item">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" class="img-fluid rounded shadow" alt="Motor Sebelum-Sesudah">
                        <div class="mt-2">
                            <h5>Poles Motor</h5>
                            <p class="text-muted">Hasil maksimal</p>
                        </div>
                    </a>
                </div>

                <!-- Karpet Section -->
                <div class="col-md-4">
                    <a href="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" data-lightbox="gallery" class="gallery-item">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" class="img-fluid rounded shadow" alt="Karpet Sebelum-Sesudah">
                        <div class="mt-2">
                            <h5>Cuci Karpet Besar</h5>
                            <p class="text-muted">Bersih hingga ke serat</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" data-lightbox="gallery" class="gallery-item">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" class="img-fluid rounded shadow" alt="Karpet Sebelum-Sesudah">
                        <div class="mt-2">
                            <h5>Cuci Karpet Premium</h5>
                            <p class="text-muted">Hasil maksimal</p>
                        </div>
                    </a>
                </div>
                <div class="col-md-4">
                    <a href="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" data-lightbox="gallery" class="gallery-item">
                        <img src="https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png" class="img-fluid rounded shadow" alt="Karpet Sebelum-Sesudah">
                        <div class="mt-2">
                            <h5>Deep Cleaning Karpet</h5>
                            <p class="text-muted">Pembersihan mendalam</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonial Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center mb-5">Testimoni Pelanggan</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card testimonial-card p-4">
                        <div class="text-warning mb-3">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="card-text">"Hasil cucian motornya sangat memuaskan, pelayanannya ramah dan cepat."</p>
                        <div class="d-flex align-items-center mt-3">
                            <img src="https://ui-avatars.com/api/?name=Ahmad+Sudrajat&background=random" class="rounded-circle" width="50" height="50" alt="Testimonial">
                            <div class="ms-3">
                                <h6 class="mb-0">Ahmad Sudrajat</h6>
                                <small class="text-muted">Pelanggan Reguler</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Tambahkan testimonial lainnya di sini -->
            </div>
        </div>
    </section>
@endsection

@section('additional_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
@endsection