@extends('layouts.app')

@section('title', 'Blog')

@section('custom_css')
    .hero-section {
        background: linear-gradient(rgba(27, 87, 102, 0.86), rgba(132, 205, 214, 0.71)), url('https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png');
        background-size: cover;
        background-position: center;
        height: 60vh;
        display: flex;
        align-items: center;    
    }
    .blog-card {
        transition: transform 0.3s;
        border: none;
        border-radius: 15px;
        overflow: hidden;
    }
    .blog-card:hover {
        transform: translateY(-5px);
    }
    .blog-image {
        height: 200px;
        object-fit: cover;
    }
    .blog-category {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0,123,255,0.9);
        color: white;
        padding: 5px 15px;
        border-radius: 20px;
        font-size: 0.8rem;
    }
@endsection

@section('content')
    <!-- Header Section -->
    <section class="hero-section text-white">
        <div class="container">
            <h1 class="display-4 fw-bold">Blog & Tips</h1>
            <p class="lead">Informasi dan tips seputar perawatan kendaraan dan karpet Anda</p>
        </div>
    </section>

    <!-- Blog Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <!-- Blog Post 1 -->
                <div class="col-md-4">
                    <div class="card blog-card shadow">
                        <img src='https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png' class="blog-image" alt="Tips Cuci Motor">
                        <span class="blog-category">Tips & Trik</span>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="far fa-calendar me-2"></i>
                                <small class="text-muted">22 Mar 2024</small>
                                <i class="far fa-user ms-3 me-2"></i>
                                <small class="text-muted">Admin</small>
                            </div>
                            <h5 class="card-title">7 Tips Merawat Motor Agar Tetap Mengkilap</h5>
                            <p class="card-text">Pelajari cara merawat motor agar selalu terlihat bersih dan mengkilap seperti baru...</p>
                            <a href="#" class="btn btn-outline-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 2 -->
                <div class="col-md-4">
                    <div class="card blog-card shadow">
                        <img src='https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png' class="blog-image" alt="Merawat Karpet">
                        <span class="blog-category">Perawatan</span>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="far fa-calendar me-2"></i>
                                <small class="text-muted">20 Mar 2024</small>
                                <i class="far fa-user ms-3 me-2"></i>
                                <small class="text-muted">Admin</small>
                            </div>
                            <h5 class="card-title">Cara Merawat Karpet Agar Tahan Lama</h5>
                            <p class="card-text">Karpet yang terawat dengan baik bisa bertahan lebih lama. Berikut tips merawatnya...</p>
                            <a href="#" class="btn btn-outline-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>

                <!-- Blog Post 3 -->
                <div class="col-md-4">
                    <div class="card blog-card shadow">
                        <img src='https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png' class="blog-image" alt="Cuci Motor Sendiri">
                        <span class="blog-category">Tutorial</span>
                        <div class="card-body">
                            <div class="d-flex align-items-center mb-3">
                                <i class="far fa-calendar me-2"></i>
                                <small class="text-muted">18 Mar 2024</small>
                                <i class="far fa-user ms-3 me-2"></i>
                                <small class="text-muted">Admin</small>
                            </div>
                            <h5 class="card-title">Panduan Mencuci Motor yang Benar</h5>
                            <p class="card-text">Mencuci motor sendiri? Pastikan Anda melakukannya dengan cara yang tepat...</p>
                            <a href="#" class="btn btn-outline-primary">Baca Selengkapnya</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="row mt-5">
                <div class="col-12">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center">
                            <li class="page-item disabled">
                                <a class="page-link" href="#" tabindex="-1">Previous</a>
                            </li>
                            <li class="page-item active"><a class="page-link" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#">Next</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </section>

    <!-- Subscribe Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-md-6">
                    <h2 class="mb-4">Berlangganan Newsletter</h2>
                    <p class="text-muted mb-4">Dapatkan tips dan informasi terbaru seputar perawatan kendaraan dan karpet Anda</p>
                    <form class="d-flex gap-2">
                        <input type="email" class="form-control" placeholder="Masukkan email Anda">
                        <button type="submit" class="btn btn-primary">Subscribe</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection 