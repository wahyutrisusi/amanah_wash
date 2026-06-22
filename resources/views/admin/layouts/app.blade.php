<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Admin Cuci Karpet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --sidebar-bg: linear-gradient(180deg, #1a3a5c 0%, #0d6efd 100%);
            --sidebar-width: 240px;
        }
        body { background: #f0f4f8; }
        .sidebar {
            width: var(--sidebar-width);
            min-height: 100vh;
            background: var(--sidebar-bg);
            position: fixed;
            top: 0; left: 0;
            z-index: 100;
            box-shadow: 2px 0 10px rgba(0,0,0,.2);
        }
        .sidebar-brand {
            padding: 20px 16px 12px;
            border-bottom: 1px solid rgba(255,255,255,.15);
        }
        .sidebar-brand h5 { color: #fff; font-weight: 700; margin: 0; }
        .sidebar-brand small { color: rgba(255,255,255,.6); font-size: 11px; }
        .sidebar .nav-link {
            color: rgba(255,255,255,.8);
            padding: 10px 16px;
            border-radius: 8px;
            margin: 2px 8px;
            font-size: 14px;
            font-weight: 500;
            transition: all .2s;
        }
        .sidebar .nav-link:hover,
        .sidebar .nav-link.active {
            color: #fff;
            background: rgba(255,255,255,.18);
        }
        .sidebar .nav-link i { width: 20px; }
        .sidebar .nav-section {
            color: rgba(255,255,255,.4);
            font-size: 10px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 12px 24px 4px;
        }
        .main-content {
            margin-left: var(--sidebar-width);
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e2e8f0;
            padding: 12px 24px;
            position: sticky;
            top: 0;
            z-index: 99;
        }
        .page-content { padding: 24px; }
        .stat-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,.08);
            transition: transform .2s;
        }
        .stat-card:hover { transform: translateY(-3px); }
        .stat-icon {
            width: 52px; height: 52px;
            border-radius: 12px;
            display: flex; align-items: center; justify-content: center;
            font-size: 22px;
        }
        .table th { font-size: 12px; font-weight: 600; text-transform: uppercase; letter-spacing: .5px; color: #64748b; }
        .badge-status { font-size: 12px; padding: 5px 10px; border-radius: 20px; font-weight: 500; }
    </style>
    @yield('additional_css')
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="sidebar-brand">
            <h5><i class="fas fa-soap me-2"></i>Cuci Karpet</h5>
            <small>Panel Admin</small>
        </div>
        <ul class="nav flex-column mt-2">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                   href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt me-2"></i>Dashboard
                </a>
            </li>

            <div class="nav-section">Pesanan</div>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pemesanan.create') ? 'active' : '' }}"
                   href="{{ route('admin.pemesanan.create') }}">
                    <i class="fas fa-plus-circle me-2"></i>Input Pesanan
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.pemesanan.index') ? 'active' : '' }}"
                   href="{{ route('admin.pemesanan.index') }}">
                    <i class="fas fa-list-ol me-2"></i>Antrian / Proses
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.karpet-menumpuk') ? 'active' : '' }}"
                   href="{{ route('admin.karpet-menumpuk') }}">
                    <i class="fas fa-layer-group me-2"></i>Karpet Menumpuk
                </a>
            </li>

            <div class="nav-section">Keuangan</div>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.transaksi.*') ? 'active' : '' }}"
                   href="{{ route('admin.transaksi.index') }}">
                    <i class="fas fa-money-bill-wave me-2"></i>Transaksi
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.laporan.*') ? 'active' : '' }}"
                   href="{{ route('admin.laporan.index') }}">
                    <i class="fas fa-chart-bar me-2"></i>Laporan
                </a>
            </li>

            <div class="nav-section">Pengaturan</div>
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.layanan.*') ? 'active' : '' }}"
                   href="{{ route('admin.layanan.index') }}">
                    <i class="fas fa-concierge-bell me-2"></i>Layanan
                </a>
            </li>
        </ul>
    </div>

    <!-- Main Content -->
    <div class="main-content">
        <!-- Topbar -->
        <div class="topbar d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-semibold text-secondary">@yield('title')</h6>
            <div class="dropdown">
                <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-user-circle me-1"></i>{{ Auth::user()->name }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <form action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Page Content -->
        <div class="page-content">
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif
            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            @yield('content')
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('additional_scripts')
</body>
</html>
