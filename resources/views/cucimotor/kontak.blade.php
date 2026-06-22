@extends('layouts.app')

@section('title', 'Kontak')

@section('custom_css')
    .hero-section {
        background: linear-gradient(rgba(27, 87, 102, 0.86), rgba(132, 205, 214, 0.71)), url('https://i2.wp.com/diajengwitri.id/wp-content/uploads/2019/06/Modifikasi-Motor-di-Moladin.png');
        background-size: cover;
        background-position: center;
        height: 60vh;
        display: flex;
        align-items: center;
    }
    .contact-info-card {
        transition: transform 0.3s;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .contact-info-card:hover {
        transform: translateY(-5px);
    }
    .map-container {
        height: 400px;
        border-radius: 15px;
        overflow: hidden;
    }
    .contact-info-card {
        transition: transform 0.3s;
        border: none;
        border-radius: 15px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
@endsection

@section('content')
    <!-- Header Section -->
    <section class="hero-section text-white">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 text-white">
                    <h1 class="display-4 fw-bold mb-4">Hubungi Kami</h1>
                    <p class="lead mb-4">Kami siap melayani pertanyaan dan kebutuhan Anda</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Info Section -->
    <section class="py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="contact-info-card card h-100 p-4">
                        <div class="text-center">
                            <i class="fas fa-map-marker-alt fa-3x text-primary mb-3"></i>
                            <h4>Alamat</h4>
                            <p>Jl. Contoh No. 123<br>Kota, Provinsi 12345</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card card h-100 p-4">
                        <div class="text-center">
                            <i class="fas fa-phone fa-3x text-primary mb-3"></i>
                            <h4>Telepon</h4>
                            <p>+62 812-3456-7890<br>+62 898-7654-3210</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="contact-info-card card h-100 p-4">
                        <div class="text-center">
                            <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                            <h4>Email</h4>
                            <p>info@cucimotor.com<br>cs@cucimotor.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2 class="mb-4">Kirim Pesan</h2>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Nama Lengkap</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Subjek</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea class="form-control" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-paper-plane me-2"></i>Kirim Pesan
                        </button>
                    </form>
                </div>
                <div class="col-md-6">
                    <h2 class="mb-4">Lokasi Kami</h2>
                    <div class="map-container rounded overflow-hidden">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3950.4632882834287!2d112.61195139999999!3d-8.071607099999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e789da8a6f55679%3A0x6e8eb610eedf445b!2sCuci%20Motor%20AMANAH!5e0!3m2!1sid!2sid!4v1710947900!5m2!1sid!2sid"
                            width="100%" 
                            height="450" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                    <div class="mt-4">
                        <h5><i class="fas fa-map-marker-alt text-primary me-2"></i>Lokasi Kami</h5>
                        <p>Jl. Raya Sutojayan, Sutojan, Kec. Pakis, Kabupaten Malang, Jawa Timur 65151</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Media Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center mb-5">Ikuti Kami di Media Sosial</h2>
            <div class="row justify-content-center text-center g-4">
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <i class="fab fa-instagram fa-3x text-primary mb-3"></i>
                        <h5>Instagram</h5>
                        <p class="text-muted">@cucimotor.id</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <i class="fab fa-facebook fa-3x text-primary mb-3"></i>
                        <h5>Facebook</h5>
                        <p class="text-muted">Cuci Motor Premium</p>
                    </a>
                </div>
                <div class="col-md-3">
                    <a href="#" class="text-decoration-none">
                        <i class="fab fa-twitter fa-3x text-primary mb-3"></i>
                        <h5>Twitter</h5>
                        <p class="text-muted">@cucimotor_id</p>
                    </a>
                </div>
            </div>
        </div>
    </section>
@endsection 