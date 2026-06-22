<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Amanah Wash</title>  
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    @yield('additional_css')
    <style>
        .navbar {
            background-color: rgba(10, 95, 134, 0.85) !important;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }
        
        .navbar-brand img {
        border-radius: 5px; /* Agar logo lebih rapi */
        }

        .navbar-nav .nav-link {
        color: white !important; 
        }

        .navbar-nav .nav-link:hover,
        .navbar-nav .nav-link.active {
        color: #ffc107 !important; /* Warna kuning saat aktif */
        }

        .navbar .dropdown-menu {
        background-color: #002147;
        }

        .navbar .dropdown-menu .dropdown-item {
        color: white;
        }

        .navbar .dropdown-menu .dropdown-item:hover {
        background-color: #ffc107;
        color: black;
        }

        .navbar-nav .nav-link i {
        font-size: 18px; 
        }

        .navbar-nav .nav-link.text-warning {
        font-weight: bold;
        }

        .navbar-nav .ms-3 .nav-link {
        padding: 0 10px;
        }
        footer {
            background-color:rgb(13, 39, 65) !important;    
        }
        
        @yield('custom_css')
        
        .whatsapp-float {
            position: fixed;
            bottom: 30px;
            right: 30px;
            background: #25d366;
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50px;
            text-align: center;
            font-size: 24px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
            display: flex;
            align-items: center;
            justify-content: center;
            text-decoration: none;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .whatsapp-float:hover {
            background: #128C7E;
            color: white;
            transform: translateY(-5px);
        }
        
        .whatsapp-float .tooltip-text {
            position: absolute;
            right: 70px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 14px;
            visibility: hidden;
            opacity: 0;
            transition: all 0.3s;
            white-space: nowrap;
        }
        
        .whatsapp-float:hover .tooltip-text {
            visibility: visible;
            opacity: 1;
        }
        
        .dropdown:hover .dropdown-menu {
            display: block;
        }
    </style>
</head>
<body>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark shadow fixed-top">
    <div class="container">
        <!-- Logo -->
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ route('beranda') }}">
            <img src="https://static.vecteezy.com/system/resources/previews/026/721/193/original/washing-machine-and-laundry-laundry-sticker-png.png" 
                alt="Logo" style="height: 40px;">
            <span class="ms-2">CUCI KARPET</span>
        </a>

        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Menu Utama -->
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('beranda') ? 'active' : '' }}" href="{{ route('beranda') }}">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}" href="{{ route('layanan') }}">Layanan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('pemesanan*') ? 'active' : '' }}" href="{{ route('pemesanan') }}">
                        <i class="fas fa-search me-1"></i>Cek Pesanan
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('galeri') ? 'active' : '' }}" href="{{ route('galeri') }}">Galeri</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('kontak') ? 'active' : '' }}" href="{{ route('kontak') }}">Kontak</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('blog') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a>
                </li>
                <!-- Ikon Sosial Media -->
                <li class="nav-item ms-2">
                    <a class="nav-link" href="https://www.instagram.com/wahyutr_i/"><i class="fab fa-instagram"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="https://www.facebook.com/wahyu.tri.7"><i class="fab fa-facebook"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

    <!-- Content -->
    @yield('content')

    <!-- WhatsApp Float Button -->
    <a href="https://wa.me/6289528424676?text=Halo%20Amanah%20Wash%2C%20saya%20ingin%20bertanya%20tentang%20layanan%20cuci%20motor" 
       class="whatsapp-float" target="_blank">
        <i class="fab fa-whatsapp"></i>
        <span class="tooltip-text">Chat dengan kami!</span>
    </a>

    <!-- Footer -->
    <footer class="text-white py-5">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h3 class="h5 mb-3">Hubungi Kami</h3>
                    <p><i class="fas fa-phone me-2"></i>089528424676</p>
                    <p><i class="fas fa-envelope me-2"></i>info@amanahwash.com</p>
                    <p><i class="fas fa-map-marker-alt me-2"></i>Jl.Sutojayan, kec.pakisaji, Kab.Malang</p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">Jam Operasional</h3>
                    <p><i class="fas fa-clock me-2"></i>Senin - Jumat: 08.00 - 17.00</p>
                    <p><i class="fas fa-clock me-2"></i>Sabtu - Minggu: 08.00 - 17.00</p>
                </div>
                <div class="col-md-4">
                    <h3 class="h5 mb-3">Ikuti Kami</h3>
                    <div class="d-flex gap-3">
                        <a href="https://www.instagram.com/wahyutr_i/" class="text-white"><i class="fab fa-instagram fa-2x"></i></a>
                        <a href="https://www.facebook.com/wahyu.tri.7" class="text-white"><i class="fab fa-facebook fa-2x"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-twitter fa-2x"></i></a>
                    </div>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p class="mb-0">&copy; 2024 Amanah Wash. All rights reserved. Wahyu.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Tawk.to Live Chat Script -->
    <script type="text/javascript">
    var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
    (function(){
        var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
        s1.async=true;
        s1.src='https://embed.tawk.to/YOUR_TAWK_TO_ID/default';
        s1.charset='UTF-8';
        s1.setAttribute('crossorigin','*');
        s0.parentNode.insertBefore(s1,s0);
    })();
    </script>
    
    @yield('additional_scripts')
</body>
</html>