@extends('layouts.app')

@section('title', 'Galeri')

@section('additional_css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css" rel="stylesheet">
@endsection

@section('custom_css')
    .galeri-hero {
        background: linear-gradient(135deg, #0f3c5a 0%, #1a7a8a 100%);
        padding: 120px 0 70px;
    }
    .filter-btn {
        border-radius: 30px;
        padding: 8px 22px;
        font-weight: 500;
        font-size: 14px;
        transition: all .25s;
    }
    .filter-btn.active, .filter-btn:hover {
        background: #0d6efd;
        color: #fff;
        border-color: #0d6efd;
    }
    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 14px;
        display: block;
        cursor: pointer;
    }
    .gallery-item img {
        width: 100%;
        height: 240px;
        object-fit: cover;
        transition: transform .4s ease;
        display: block;
    }
    .gallery-item:hover img { transform: scale(1.08); }
    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(transparent 40%, rgba(10,40,70,.88));
        opacity: 0;
        transition: opacity .35s;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 20px;
    }
    .gallery-item:hover .gallery-overlay { opacity: 1; }
    .gallery-overlay .zoom-icon {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -60%);
        width: 48px; height: 48px;
        background: rgba(255,255,255,.2);
        border: 2px solid rgba(255,255,255,.6);
        border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: #fff; font-size: 18px;
        transition: transform .3s;
    }
    .gallery-item:hover .zoom-icon { transform: translate(-50%, -50%); }
    .gallery-tag {
        font-size: 11px;
        font-weight: 700;
        letter-spacing: .8px;
        text-transform: uppercase;
        color: rgba(255,255,255,.7);
        margin-bottom: 4px;
    }
    .gallery-title {
        color: #fff;
        font-size: 15px;
        font-weight: 600;
        margin: 0;
    }
    .stat-box {
        background: rgba(255,255,255,.1);
        border: 1px solid rgba(255,255,255,.2);
        border-radius: 12px;
        padding: 20px;
        text-align: center;
        color: #fff;
    }
    .testimonial-card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 4px 20px rgba(0,0,0,.08);
        transition: transform .3s;
    }
    .testimonial-card:hover { transform: translateY(-4px); }
@endsection

@section('content')

{{-- Hero --}}
<section class="galeri-hero text-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <span class="badge bg-warning text-dark mb-3 px-3 py-2">
                    <i class="fas fa-images me-1"></i> Galeri Hasil Kerja
                </span>
                <h1 class="display-4 fw-bold mb-3">Lihat Hasilnya<br>Sendiri</h1>
                <p class="lead opacity-90 mb-4">
                    Setiap karpet yang kami cuci mendapat perlakuan terbaik. Berikut dokumentasi hasil kerja nyata dari tim kami.
                </p>
            </div>
            <div class="col-lg-5">
                <div class="row g-3">
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="fs-2 fw-bold">500+</div>
                            <div class="small opacity-75">Karpet Dicuci</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="fs-2 fw-bold">200+</div>
                            <div class="small opacity-75">Pelanggan Puas</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="fs-2 fw-bold">3+</div>
                            <div class="small opacity-75">Tahun Pengalaman</div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="stat-box">
                            <div class="fs-2 fw-bold">100%</div>
                            <div class="small opacity-75">Kepuasan Dijamin</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Gallery --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold mb-2">Hasil Cuci Karpet Kami</h2>
            <p class="text-muted mb-4">Dokumentasi nyata sebelum &amp; sesudah pencucian</p>
            {{-- Filter Buttons --}}
            <div class="d-flex justify-content-center flex-wrap gap-2 mb-5">
                <button class="btn btn-primary filter-btn active" data-filter="all">Semua</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="reguler">Karpet Reguler</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="premium">Karpet Premium</button>
                <button class="btn btn-outline-primary filter-btn" data-filter="besar">Karpet Besar</button>
            </div>
        </div>

        <div class="row g-4" id="gallery-grid">

            {{-- Reguler --}}
            <div class="col-sm-6 col-lg-4 gallery-col" data-category="reguler">
                <a href="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=1200"
                   data-lightbox="galeri" data-title="Cuci Karpet Reguler — Bersih Maksimal"
                   class="gallery-item shadow-sm">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600" alt="Cuci Karpet Reguler">
                    <div class="gallery-overlay">
                        <div class="zoom-icon"><i class="fas fa-search-plus"></i></div>
                        <div class="gallery-tag">Karpet Reguler</div>
                        <p class="gallery-title">Hasil Bersih Sempurna</p>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-4 gallery-col" data-category="reguler">
                <a href="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=1200"
                   data-lightbox="galeri" data-title="Noda Hilang Total"
                   class="gallery-item shadow-sm">
                    <img src="https://images.unsplash.com/photo-1586023492125-27b2c045efd7?w=600" alt="Noda Hilang">
                    <div class="gallery-overlay">
                        <div class="zoom-icon"><i class="fas fa-search-plus"></i></div>
                        <div class="gallery-tag">Karpet Reguler</div>
                        <p class="gallery-title">Noda Bandel Hilang Total</p>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-4 gallery-col" data-category="premium">
                <a href="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=1200"
                   data-lightbox="galeri" data-title="Karpet Premium — Bulu Tebal"
                   class="gallery-item shadow-sm">
                    <img src="https://images.unsplash.com/photo-1555041469-a586c61ea9bc?w=600" alt="Karpet Premium">
                    <div class="gallery-overlay">
                        <div class="zoom-icon"><i class="fas fa-search-plus"></i></div>
                        <div class="gallery-tag">Karpet Premium</div>
                        <p class="gallery-title">Bulu Tebal Kembali Halus</p>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-4 gallery-col" data-category="premium">
                <a href="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=1200"
                   data-lightbox="galeri" data-title="Karpet Premium Ruang Tamu"
                   class="gallery-item shadow-sm">
                    <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?w=600" alt="Karpet Ruang Tamu">
                    <div class="gallery-overlay">
                        <div class="zoom-icon"><i class="fas fa-search-plus"></i></div>
                        <div class="gallery-tag">Karpet Premium</div>
                        <p class="gallery-title">Karpet Ruang Tamu Mewah</p>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-4 gallery-col" data-category="besar">
                <a href="https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=1200"
                   data-lightbox="galeri" data-title="Karpet Ukuran Besar"
                   class="gallery-item shadow-sm">
                    <img src="https://images.unsplash.com/photo-1567538096630-e0c55bd6374c?w=600" alt="Karpet Besar">
                    <div class="gallery-overlay">
                        <div class="zoom-icon"><i class="fas fa-search-plus"></i></div>
                        <div class="gallery-tag">Karpet Besar</div>
                        <p class="gallery-title">Area Besar Tetap Bersih</p>
                    </div>
                </a>
            </div>

            <div class="col-sm-6 col-lg-4 gallery-col" data-category="besar">
                <a href="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=1200"
                   data-lightbox="galeri" data-title="Karpet Kantor Besar"
                   class="gallery-item shadow-sm">
                    <img src="https://images.unsplash.com/photo-1631049307264-da0ec9d70304?w=600" alt="Karpet Kantor">
                    <div class="gallery-overlay">
                        <div class="zoom-icon"><i class="fas fa-search-plus"></i></div>
                        <div class="gallery-tag">Karpet Besar</div>
                        <p class="gallery-title">Karpet Kantor Kinclong</p>
                    </div>
                </a>
            </div>

        </div>
    </div>
</section>

{{-- Before After --}}
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Sebelum &amp; Sesudah</h2>
            <p class="text-muted">Lihat perbedaan nyata hasil pencucian kami</p>
        </div>
        <div class="row g-4 align-items-center">
            <div class="col-md-5">
                <div class="position-relative rounded-3 overflow-hidden shadow">
                    <img src="https://images.unsplash.com/photo-1558618047-3b8c8de0e96a?w=600"
                         class="img-fluid w-100" style="height:280px;object-fit:cover" alt="Sebelum">
                    <span class="position-absolute top-0 start-0 m-3 badge bg-danger fs-6 px-3">
                        <i class="fas fa-times-circle me-1"></i>Sebelum
                    </span>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="rounded-circle bg-primary text-white d-inline-flex align-items-center justify-content-center shadow"
                     style="width:60px;height:60px;font-size:22px">
                    <i class="fas fa-arrow-right"></i>
                </div>
            </div>
            <div class="col-md-5">
                <div class="position-relative rounded-3 overflow-hidden shadow">
                    <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=600"
                         class="img-fluid w-100" style="height:280px;object-fit:cover" alt="Sesudah">
                    <span class="position-absolute top-0 start-0 m-3 badge bg-success fs-6 px-3">
                        <i class="fas fa-check-circle me-1"></i>Sesudah
                    </span>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Testimoni --}}
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-2">Kata Pelanggan Kami</h2>
            <p class="text-muted">Kepuasan mereka adalah prioritas kami</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card testimonial-card p-4 h-100">
                    <div class="text-warning mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-muted mb-4">"Karpet ruang tamu saya yang sudah kotor bertahun-tahun langsung bersih seperti baru. Noda kopi dan debu hilang semua!"</p>
                    <div class="d-flex align-items-center mt-auto">
                        <img src="https://ui-avatars.com/api/?name=Ahmad+Sudrajat&background=0d6efd&color=fff"
                             class="rounded-circle me-3" width="48" height="48" alt="Ahmad">
                        <div>
                            <div class="fw-semibold">Ahmad Sudrajat</div>
                            <small class="text-muted">Pelanggan Reguler</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card testimonial-card p-4 h-100">
                    <div class="text-warning mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    </div>
                    <p class="text-muted mb-4">"Karpet bulu tebal saya ditangani dengan sangat baik. Hasilnya lembut dan wangi. Akan terus berlangganan di sini!"</p>
                    <div class="d-flex align-items-center mt-auto">
                        <img src="https://ui-avatars.com/api/?name=Siti+Aminah&background=198754&color=fff"
                             class="rounded-circle me-3" width="48" height="48" alt="Siti">
                        <div>
                            <div class="fw-semibold">Siti Aminah</div>
                            <small class="text-muted">Pelanggan Premium</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card testimonial-card p-4 h-100">
                    <div class="text-warning mb-3">
                        <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
                        <i class="fas fa-star"></i><i class="fas fa-star"></i>
                    </div>
                    <p class="text-muted mb-4">"Pelayanan cepat dan ramah. Karpet kantor ukuran besar selesai tepat waktu dan hasilnya memuaskan sekali!"</p>
                    <div class="d-flex align-items-center mt-auto">
                        <img src="https://ui-avatars.com/api/?name=Budi+Prastio&background=dc3545&color=fff"
                             class="rounded-circle me-3" width="48" height="48" alt="Budi">
                        <div>
                            <div class="fw-semibold">Budi Prastio</div>
                            <small class="text-muted">Pelanggan Setia</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- CTA --}}
<section class="py-5" style="background: linear-gradient(135deg, #0d6efd, #0a4fa0);">
    <div class="container text-center text-white">
        <h2 class="fw-bold mb-3">Siap Titipkan Karpet Anda?</h2>
        <p class="lead opacity-90 mb-4">Hubungi kami sekarang atau cek status pesanan karpet Anda.</p>
        <div class="d-flex justify-content-center gap-3 flex-wrap">
            <a href="{{ route('kontak') }}" class="btn btn-warning btn-lg px-5 fw-semibold">
                <i class="fas fa-phone me-2"></i>Hubungi Kami
            </a>
            <a href="{{ route('pemesanan') }}" class="btn btn-outline-light btn-lg px-5">
                <i class="fas fa-search me-2"></i>Cek Pesanan
            </a>
        </div>
    </div>
</section>

@endsection

@section('additional_scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/js/lightbox.min.js"></script>
    <script>
        // Filter gallery
        document.querySelectorAll('.filter-btn').forEach(btn => {
            btn.addEventListener('click', function () {
                document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
                this.classList.add('active');

                const filter = this.dataset.filter;
                document.querySelectorAll('.gallery-col').forEach(col => {
                    if (filter === 'all' || col.dataset.category === filter) {
                        col.style.display = '';
                        col.style.animation = 'fadeIn .4s ease';
                    } else {
                        col.style.display = 'none';
                    }
                });
            });
        });

        lightbox.option({ resizeDuration: 200, wrapAround: true, albumLabel: 'Foto %1 dari %2' });
    </script>
    <style>
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }
    </style>
@endsection
