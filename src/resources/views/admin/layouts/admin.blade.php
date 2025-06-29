<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Modern Admin Dashboard">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    <!-- Custom fonts -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <style>
        :root {
            --primary-color: #667eea;
            --primary-dark: #5a67d8;
            --secondary-color: #764ba2;
            --success-color: #48bb78;
            --danger-color: #f56565;
            --warning-color: #ed8936;
            --info-color: #4299e1;
            --dark-color: #2d3748;
            --light-color: #f7fafc;
            --abu-color: grey;
            --sidebar-width: 280px;
            --sidebar-collapsed-width: 80px;
            --topbar-height: 70px;
            --border-radius: 12px;
            --box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            --box-shadow-lg: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
        }

        /* Sidebar Styles */
        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            width: var(--sidebar-width);
            background: white;
            backdrop-filter: blur(20px);
            border-right: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 1000;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: rgba(255, 255, 255, 0.3) transparent;
        }

        .sidebar::-webkit-scrollbar {
            width: 6px;
        }

        .sidebar::-webkit-scrollbar-track {
            background: transparent;
        }

        .sidebar::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        .sidebar.collapsed {
            width: var(--sidebar-collapsed-width);
        }

        .sidebar-brand {
            display: flex;
            align-items: center;
            padding: 1.5rem;
            text-decoration: none;
            color: var(--dark-color);
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            transition: all 0.3s ease;
        }

        .sidebar-brand:hover {
            color: var(--primary-color);
            transform: translateX(5px);
        }

        .sidebar-brand-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 12px;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .sidebar-brand-text {
            font-size: 1.25rem;
            font-weight: 700;
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .sidebar-brand-text {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar-nav {
            padding: 1rem 0;
            list-style: none;
        }

        .nav-item {
            margin: 0.25rem 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.875rem 1rem;
            color: var(--dark-color);
            text-decoration: none;
            border-radius: var(--border-radius);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
        }

        .nav-link::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transition: left 0.5s ease;
        }

        .nav-link:hover::before {
            left: 100%;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color);
            background: rgba(255, 255, 255, 0.15);
            transform: translateX(5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .nav-link i {
            width: 20px;
            margin-right: 12px;
            font-size: 1.1rem;
            text-align: center;
            flex-shrink: 0;
        }

        .nav-link span {
            white-space: nowrap;
            opacity: 1;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .nav-link span {
            opacity: 0;
            width: 0;
            overflow: hidden;
        }

        .sidebar-heading {
            color: var(--dark-color);
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            padding: 1rem 2rem 0.5rem;
            margin-top: 1rem;
            transition: opacity 0.3s ease;
        }

        .sidebar.collapsed .sidebar-heading {
            opacity: 0;
        }

        .sidebar-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin: 1rem 2rem;
            transition: margin 0.3s ease;
        }

        .sidebar.collapsed .sidebar-divider {
            margin: 1rem 1rem;
        }

        /* Main Content */
        .main-content {
            margin-left: var(--sidebar-width);
            transition: margin-left 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        .main-content.expanded {
            margin-left: var(--sidebar-collapsed-width);
        }

        /* Topbar */
        .topbar {
            height: var(--topbar-height);
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: var(--box-shadow);
            position: sticky;
            top: 0;
            z-index: 999;
        }

        .topbar-search {
            max-width: 400px;
        }

        .search-input {
            background: rgba(0, 0, 0, 0.05);
            border: none;
            border-radius: 25px;
            padding: 0.5rem 1rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            background: white;
            box-shadow: var(--box-shadow);
            transform: scale(1.02);
            outline: none;
        }

        /* Dashboard Cards */
        .dashboard-card {
            background: white;
            border-radius: var(--border-radius);
            box-shadow: var(--box-shadow);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            overflow: hidden;
            position: relative;
        }

        .dashboard-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--box-shadow-lg);
        }

        .card-icon {
            width: 60px;
            height: 60px;
            border-radius: 15px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            color: white;
            margin-bottom: 1rem;
        }

        .card-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        }

        .card-success {
            background: linear-gradient(135deg, var(--success-color), #38a169);
        }

        .card-info {
            background: linear-gradient(135deg, var(--info-color), #3182ce);
        }

        .card-warning {
            background: linear-gradient(135deg, var(--warning-color), #dd6b20);
        }

        /* Dropdown Improvements */
        .dropdown-menu {
            border: none;
            box-shadow: var(--box-shadow-lg);
            border-radius: var(--border-radius);
            padding: 0.5rem 0;
        }

        .dropdown-item {
            padding: 0.75rem 1.5rem;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background: rgba(102, 126, 234, 0.1);
            color: var(--primary-color);
        }

        /* User Profile */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid rgba(102, 126, 234, 0.2);
            transition: all 0.3s ease;
        }

        .user-avatar:hover {
            border-color: var(--primary-color);
            transform: scale(1.1);
        }

        /* Sidebar Toggle */
        .sidebar-toggle {
            background: var(--primary-color);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
        }

        .sidebar-toggle:hover {
            background: var(--primary-dark);
            transform: scale(1.05);
        }

        /* Content Container */
        .content-container {
            padding: 2rem;
            flex: 1;
        }

        /* Footer */
        .footer {
            background: white;
            border-top: 1px solid rgba(0, 0, 0, 0.05);
            padding: 1rem 2rem;
            margin-top: auto;
        }

        /* Activity Feed */
        .activity-feed {
            max-height: 400px;
            overflow-y: auto;
        }

        .activity-item {
            display: flex;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .activity-item:last-child {
            border-bottom: none;
        }

        .activity-icon {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
            flex-shrink: 0;
        }

        .activity-icon i {
            color: white;
            font-size: 0.875rem;
        }

        .activity-content {
            flex-grow: 1;
        }

        .activity-content p {
            font-size: 0.875rem;
            line-height: 1.4;
            margin-bottom: 0;
        }

        .badge-counter {
            position: absolute;
            top: -8px;
            right: -8px;
            padding: 0.25rem 0.5rem;
            font-size: 0.75rem;
            border-radius: 10px;
        }

        .icon-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .dropdown-list-image {
            position: relative;
        }

        .dropdown-list-image img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        .status-indicator {
            position: absolute;
            bottom: 0;
            right: 0;
            width: 12px;
            height: 12px;
            border-radius: 50%;
            border: 2px solid white;
        }

        .chart-container {
            position: relative;
        }

        /* Custom scrollbar for activity feed */
        .activity-feed::-webkit-scrollbar {
            width: 4px;
        }

        .activity-feed::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .activity-feed::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 2px;
        }

        /* Hover effects for quick action buttons */
        .btn-outline-primary:hover,
        .btn-outline-success:hover,
        .btn-outline-warning:hover,
        .btn-outline-info:hover {
            transform: translateY(-2px);
            box-shadow: var(--box-shadow);
        }

        /* Mobile responsive adjustments */
        @media (max-width: 768px) {
            .topbar-search {
                display: none !important;
            }

            .content-container {
                padding: 1rem;
            }

            .dashboard-card {
                margin-bottom: 1rem;
            }

            .card-body {
                padding: 1.5rem !important;
            }

            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.show {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0;
            }
        }

        /* Print styles */
        @media print {

            .sidebar,
            .topbar,
            .footer,
            .scroll-to-top {
                display: none !important;
            }

            .main-content {
                margin-left: 0 !important;
            }

            .dashboard-card {
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }

        /* Animation for page transitions */
        .page-transition {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.3s ease;
        }

        .page-transition.loaded {
            opacity: 1;
            transform: translateY(0);
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .fade-in-up {
            animation: fadeInUp 0.6s ease-out;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }
    </style>

    <!-- Custom CSS - REMOVED TO PREVENT CONFLICT WITH INLINE STYLES -->
    {{-- <link href="{{ asset('css/admin.css') }}" rel="stylesheet"> --}}
</head>

<body>
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <!-- Brand -->
        <a class="sidebar-brand" href="{{ route('admin.dashboard') }}">
            <div class="sidebar-brand-icon">
                <i class="fas fa-mountain"></i>
            </div>
            <div class="sidebar-brand-text">Panel Admin</div>
        </a>

        <!-- Navigation -->
        <ul class="sidebar-nav">
            <!-- Dashboard -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                    href="{{ route('admin.dashboard') }}">
                    <i class="fas fa-tachometer-alt"></i>
                    <span>Beranda</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Manajemen</div>

            <!-- Tourists -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.tiketmasuks.*') ? 'active' : '' }}"
                    href="{{ route('admin.tiketmasuks.index') }}">
                    <i class="fas fa-users"></i>
                    <span>Wisatawan</span>
                </a>
            </li>

            <!-- Tour Guides -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('tourguides.*') ? 'active' : '' }}"
                    href="{{ route('tourguides.index') }}">
                    <i class="fas fa-user-tie"></i>
                    <span>Pemandu Wisata</span>
                </a>
            </li>

            <!-- Order Tourguide -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}"
                    href="{{ route('admin.orders.index') }}">
                    <i class="fas fa-calendar-check"></i>
                    <span>Pemesanan Pemandu</span>
                </a>
            </li>

            <!-- Facilities -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.facilities.*') ? 'active' : '' }}"
                    href="{{ route('admin.facilities.index') }}">
                    <i class="fas fa-hotel"></i>
                    <span>Fasilitas</span>
                </a>
            </li>

            <!-- News -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.berita.*') ? 'active' : '' }}"
                    href="{{ route('admin.berita.index') }}">
                    <i class="fas fa-newspaper"></i>
                    <span>Berita</span>
                </a>
            </li>

            <!-- Gallery -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.gallery.*') ? 'active' : '' }}"
                    href="{{ route('admin.gallery.index') }}">
                    <i class="fas fa-images"></i>
                    <span>Galeri</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Produk</div>

            <!-- Honey Products -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.madu.*') ? 'active' : '' }}"
                    href="{{ route('admin.madu.index') }}">
                    <i class="fas fa-jar"></i>
                    <span>Produk Madu</span>
                </a>
            </li>

            <!-- Honey Orders -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.orders-madu.*') ? 'active' : '' }}"
                    href="{{ route('admin.orders-madu.index') }}">
                    <i class="fas fa-shopping-cart"></i>
                    <span>Pesanan Madu</span>
                </a>
            </li>

            <!-- UMKM Products -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.produkUMKM.*') ? 'active' : '' }}"
                    href="{{ route('admin.produkUMKM.index') }}">
                    <i class="fas fa-store"></i>
                    <span>Produk UMKM</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Laporan & Analitik</div>

            <!-- Sales Report -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.laporan-penjualan.*') ? 'active' : '' }}"
                    href="{{ route('admin.laporan-penjualan.index') }}">
                    <i class="fas fa-chart-line"></i>
                    <span>Laporan Penjualan</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Sistem</div>

            <!-- Users -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}"
                    href="{{ route('admin.users.index') }}">
                    <i class="fas fa-users-cog"></i>
                    <span>Pengguna</span>
                </a>
            </li>

            <!-- OAuth Management -->
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('admin.oauth.*') ? 'active' : '' }}"
                    href="{{ route('admin.oauth.index') }}">
                    <i class="fab fa-google"></i>
                    <span>Pengaturan OAuth</span>
                </a>
            </li>

            <hr class="sidebar-divider">
            <div class="sidebar-heading">Pengaturan</div>

            <!-- Profile -->
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="fas fa-user-cog"></i>
                    <span>Profil</span>
                </a>
            </li>
        </ul>
    </nav>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Topbar -->
        <nav class="navbar navbar-expand topbar px-4 py-0">
            <div class="d-flex align-items-center">
                <!-- Sidebar Toggle -->
                <button class="sidebar-toggle me-3" id="sidebarToggle">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Page Title -->
                <h1 class="h4 mb-0 text-gray-800 d-none d-md-block">
                    @yield('page-title', 'Dashboard')
                </h1>
            </div>

            <!-- Topbar Search -->
            <form class="d-none d-sm-inline-block topbar-search mx-auto">
                <div class="input-group">
                    <input type="text" class="form-control search-input" placeholder="Cari apa saja..."
                        aria-label="Search">
                    <button class="btn btn-primary" type="button">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ms-auto">
                <div class="topbar-divider d-none d-sm-block"></div>

                <!-- User Information -->
                <li class="nav-item dropdown no-arrow">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown"
                        role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="me-2 d-none d-lg-inline text-gray-600 small" style="color: black;">
                            {{ Auth::user()->name ?? 'Admin User' }}
                        </span>
                        @if (Auth::user() && Auth::user()->photo)
                            <img class="user-avatar" src="{{ asset('storage/' . Auth::user()->photo) }}"
                                alt="Profile Photo">
                        @else
                            <div class="user-avatar bg-primary d-flex align-items-center justify-content-center">
                                <i class="fas fa-user text-white"></i>
                            </div>
                        @endif
                    </a>
                    <div class="dropdown-menu dropdown-menu-end shadow" aria-labelledby="userDropdown">
                        <div class="dropdown-header text-center">
                            <strong>{{ Auth::user()->name ?? 'Admin User' }}</strong>
                            <div class="small text-muted">{{ Auth::user()->email ?? 'admin@example.com' }}</div>
                        </div>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-user fa-sm fa-fw me-2 text-gray-400"></i>
                            Profil
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-cogs fa-sm fa-fw me-2 text-gray-400"></i>
                            Pengaturan
                        </a>
                        <a class="dropdown-item" href="#">
                            <i class="fas fa-list fa-sm fa-fw me-2 text-gray-400"></i>
                            Log Aktivitas
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#" data-bs-toggle="modal"
                            data-bs-target="#logoutModal">
                            <i class="fas fa-sign-out-alt fa-sm fa-fw me-2 text-gray-400"></i>
                            Keluar
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Page Content -->
        <div class="content-container">
            <!-- Dashboard Overview Cards -->
            <div class="row mb-4">
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="card-icon card-primary me-3">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-xs fw-bold text-primary text-uppercase mb-1">
                                        Wisatawan Hari Ini
                                    </div>
                                    <div class="h4 mb-0 fw-bold text-gray-800">
                                        @php
                                            $touristsToday = 0;
                                            try {
                                                $touristsToday = \App\Models\TiketMasuk::whereDate(
                                                    'created_at',
                                                    today(),
                                                )->count();
                                            } catch (Exception $e) {
                                                // Handle error silently
                                            }
                                        @endphp
                                        {{ $touristsToday }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.tiketmasuks.index') }}" class="btn btn-primary btn-sm">
                                    <i class="fas fa-arrow-right me-1"></i>
                                    Lihat Detail
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="card-icon card-success me-3">
                                    <i class="fas fa-user-tie"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-xs fw-bold text-success text-uppercase mb-1">
                                        Pemandu Aktif
                                    </div>
                                    <div class="h4 mb-0 fw-bold text-gray-800">
                                        @php
                                            $activeGuides = 0;
                                            try {
                                                $activeGuides = \App\Models\OrderTourGuide::where(
                                                    'status',
                                                    'accepted',
                                                )->count();
                                            } catch (Exception $e) {
                                                // Handle error silently
                                            }
                                        @endphp
                                        {{ $activeGuides }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.orders.index') }}" class="btn btn-success btn-sm">
                                    <i class="fas fa-arrow-right me-1"></i>
                                    Kelola Pemandu
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="card-icon card-info me-3">
                                    <i class="fas fa-shopping-cart"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-xs fw-bold text-info text-uppercase mb-1">
                                        Pesanan Madu
                                    </div>
                                    <div class="h4 mb-0 fw-bold text-gray-800">
                                        @php
                                            $honeyOrders = 0;
                                            try {
                                                $honeyOrders = \App\Models\OrderMadu::whereDate(
                                                    'created_at',
                                                    today(),
                                                )->count();
                                            } catch (Exception $e) {
                                                // Handle error silently
                                            }
                                        @endphp
                                        {{ $honeyOrders }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.orders-madu.index') }}" class="btn btn-info btn-sm">
                                    <i class="fas fa-arrow-right me-1"></i>
                                    Lihat Pesanan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="dashboard-card">
                        <div class="card-body p-4">
                            <div class="d-flex align-items-center">
                                <div class="card-icon card-warning me-3">
                                    <i class="fas fa-chart-line"></i>
                                </div>
                                <div class="flex-grow-1">
                                    <div class="text-xs fw-bold text-warning text-uppercase mb-1">
                                        Total Pendapatan
                                    </div>
                                    <div class="h4 mb-0 fw-bold text-gray-800">
                                        @php
                                            $totalRevenue = 0;
                                            try {
                                                // Calculate total revenue from tour guide orders
                                                $tourGuideRevenue = \App\Models\OrderTourGuide::where(
                                                    'status',
                                                    'accepted',
                                                )
                                                    ->whereNotNull('final_price')
                                                    ->sum('final_price');

                                                // Calculate total revenue from honey orders
                                                $honeyRevenue = \App\Models\OrderMadu::where('status', 'accepted')->sum(
                                                    'total_harga',
                                                );

                                                $totalRevenue = $tourGuideRevenue + $honeyRevenue;
                                            } catch (Exception $e) {
                                                // Handle error silently
                                            }
                                        @endphp
                                        Rp {{ number_format($totalRevenue, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <a href="{{ route('admin.laporan-penjualan.index') }}"
                                    class="btn btn-warning btn-sm">
                                    <i class="fas fa-arrow-right me-1"></i>
                                    Lihat Laporan
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (!request()->routeIs('admin.dashboard'))
                @yield('content')
            @else
                <!-- Quick Actions -->
                <div class="row mb-4">
                    <div class="col-12">
                        <div class="dashboard-card">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-bolt me-2 text-primary"></i>
                                    Aksi Cepat
                                </h5>
                                <div class="row">
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <a href="{{ route('admin.tiketmasuks.index') }}"
                                            class="btn btn-outline-primary w-100 py-3">
                                            <i class="fas fa-plus-circle mb-2 d-block"></i>
                                            Tambah Data Pengunjung
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <a href="{{ route('tourguides.index') }}"
                                            class="btn btn-outline-success w-100 py-3">
                                            <i class="fas fa-user-plus mb-2 d-block"></i>
                                            Tambah Pemandu Wisata
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <a href="{{ route('admin.madu.index') }}"
                                            class="btn btn-outline-warning w-100 py-3">
                                            <i class="fas fa-jar mb-2 d-block"></i>
                                            Kelola Produk Madu
                                        </a>
                                    </div>
                                    <div class="col-md-3 col-sm-6 mb-3">
                                        <a href="{{ route('admin.berita.index') }}"
                                            class="btn btn-outline-info w-100 py-3">
                                            <i class="fas fa-newspaper mb-2 d-block"></i>
                                            Buat Berita
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activities & Analytics -->
                <div class="row">
                    <div class="col-lg-8 mb-4">
                        <div class="dashboard-card h-100">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-chart-area me-2 text-info"></i>
                                    Tren Pendaftaran Bulanan
                                </h5>
                                <div class="chart-container" style="height: 300px;">
                                    <canvas id="registrationChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 mb-4">
                        <div class="dashboard-card h-100">
                            <div class="card-body p-4">
                                <h5 class="card-title mb-4">
                                    <i class="fas fa-clock me-2 text-success"></i>
                                    Aktivitas Terbaru
                                </h5>
                                <div class="activity-feed">
                                    @php
                                        $recentActivities = [];
                                        try {
                                            // Get recent tourist registrations
                                            $recentTourists = \App\Models\TiketMasuk::latest()->take(2)->get();
                                            foreach ($recentTourists as $tourist) {
                                                $recentActivities[] = [
                                                    'icon' => 'fas fa-user',
                                                    'color' => 'bg-primary',
                                                    'title' => 'New tourist registered',
                                                    'time' => $tourist->created_at->diffForHumans(),
                                                ];
                                            }

                                            // Get recent honey orders
                                            $recentOrders = \App\Models\OrderMadu::latest()->take(2)->get();
                                            foreach ($recentOrders as $order) {
                                                $recentActivities[] = [
                                                    'icon' => 'fas fa-shopping-cart',
                                                    'color' => 'bg-success',
                                                    'title' => 'New honey order received',
                                                    'time' => $order->created_at->diffForHumans(),
                                                ];
                                            }

                                            // Sort by time
                                            usort($recentActivities, function ($a, $b) {
                                                return strtotime($a['time']) - strtotime($b['time']);
                                            });

                                            $recentActivities = array_slice($recentActivities, 0, 4);
                                        } catch (Exception $e) {
                                            // Default activities if error
                                            $recentActivities = [
                                                [
                                                    'icon' => 'fas fa-user',
                                                    'color' => 'bg-primary',
                                                    'title' => 'New tourist registered',
                                                    'time' => '2 minutes ago',
                                                ],
                                                [
                                                    'icon' => 'fas fa-shopping-cart',
                                                    'color' => 'bg-success',
                                                    'title' => 'Honey order completed',
                                                    'time' => '15 minutes ago',
                                                ],
                                                [
                                                    'icon' => 'fas fa-newspaper',
                                                    'color' => 'bg-info',
                                                    'title' => 'News article published',
                                                    'time' => '1 hour ago',
                                                ],
                                                [
                                                    'icon' => 'fas fa-user-tie',
                                                    'color' => 'bg-warning',
                                                    'title' => 'Tour guide booking',
                                                    'time' => '3 hours ago',
                                                ],
                                            ];
                                        }
                                    @endphp

                                    @foreach ($recentActivities as $activity)
                                        <div class="activity-item">
                                            <div class="activity-icon {{ $activity['color'] }}">
                                                <i class="{{ $activity['icon'] }}"></i>
                                            </div>
                                            <div class="activity-content">
                                                <p class="mb-1"><strong>{{ $activity['title'] }}</strong></p>
                                                <small class="text-muted">{{ $activity['time'] }}</small>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @yield('content')
            @endif
        </div>

        <!-- Footer -->
        <footer class="footer">
            <div class="container-fluid">
                <div class="d-sm-flex align-items-center justify-content-between">
                    <div class="copyright text-center text-sm-start">
                        <span>© {{ date('Y') }} OneVision. Semua hak dilindungi.</span>
                    </div>
                    <div class="footer-links text-center text-sm-end mt-2 mt-sm-0">
                        <a href="#" class="text-decoration-none me-3">Kebijakan Privasi</a>
                        <a href="#" class="text-decoration-none me-3">Syarat & Ketentuan</a>
                        <a href="#" class="text-decoration-none">Dukungan</a>
                    </div>
                </div>
            </div>
        </footer>
    </div>

    <!-- Scroll to Top Button -->
    <a class="scroll-to-top rounded" href="#page-top"
        style="
        position: fixed;
        right: 2rem;
        bottom: 2rem;
        width: 50px;
        height: 50px;
        background: var(--primary-color);
        color: white;
        border-radius: 50%;
        display: none;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        box-shadow: var(--box-shadow);
        transition: all 0.3s ease;
        z-index: 1000;
    ">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal -->
    <div class="modal fade" id="logoutModal" tabindex="-1" aria-labelledby="logoutModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0 shadow-lg">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title" id="logoutModalLabel">
                        <i class="fas fa-sign-out-alt me-2"></i>
                        Confirm Logout
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center py-4">
                    <i class="fas fa-question-circle fa-3x text-warning mb-3"></i>
                    <h6>Are you sure you want to logout?</h6>
                    <p class="text-muted">You will need to login again to access the admin panel.</p>
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button class="btn btn-secondary px-4" type="button" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i>
                        Cancel
                    </button>
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-danger px-4">
                            <i class="fas fa-sign-out-alt me-1"></i>
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Custom JavaScript - REMOVED TO PREVENT CONFLICTS WITH INLINE SCRIPT -->
    {{-- <script src="{{ asset('js/admin.js') }}"></script> --}}

    <!-- Page specific scripts -->
    @stack('scripts')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Sidebar Toggle
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');
            const sidebarToggle = document.getElementById('sidebarToggle');

            if (sidebarToggle) {
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('collapsed');
                    mainContent.classList.toggle('expanded');

                    // Store sidebar state
                    localStorage.setItem('sidebarCollapsed', sidebar.classList.contains('collapsed'));
                });
            }

            // Restore sidebar state on page load
            if (localStorage.getItem('sidebarCollapsed') === 'true') {
                sidebar.classList.add('collapsed');
                mainContent.classList.add('expanded');
            }

            // Mobile sidebar toggle (handling for small screens)
            if (window.innerWidth <= 768) {
                // When on mobile, we might want to ensure the sidebar is not collapsed but hidden
                // The CSS already handles this with transform: translateX(-100%);
                // This logic is for showing/hiding it
                sidebarToggle.addEventListener('click', function() {
                    sidebar.classList.toggle('show');
                });

                // Optional: Close sidebar when clicking outside of it on mobile
                document.addEventListener('click', function(e) {
                    // Check if the sidebar is shown and the click is outside the sidebar and not on the toggle button
                    if (sidebar.classList.contains('show') && !sidebar.contains(e.target) && !sidebarToggle
                        .contains(e.target)) {
                        sidebar.classList.remove('show');
                    }
                });
            }


            // Scroll to top button
            const scrollToTopBtn = document.querySelector('.scroll-to-top');
            if (scrollToTopBtn) {
                window.addEventListener('scroll', function() {
                    if (window.pageYOffset > 100) {
                        scrollToTopBtn.style.display = 'flex';
                    } else {
                        scrollToTopBtn.style.display = 'none';
                    }
                });

                scrollToTopBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    window.scrollTo({
                        top: 0,
                        behavior: 'smooth'
                    });
                });
            }

            // Initialize Chart (if on dashboard)
            @if (request()->routeIs('admin.dashboard'))
                const ctx = document.getElementById('registrationChart');
                if (ctx) {
                    // Get chart data - Fixed JSON structure
                    const chartLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct',
                        'Nov', 'Dec'
                    ];
                    const touristData = [12, 19, 8, 15, 22, 18, 25, 20, 16, 24, 30, 28];
                    const orderData = [8, 12, 6, 10, 15, 12, 18, 14, 11, 17, 22, 20];

                    new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: chartLabels,
                            datasets: [{
                                    label: 'Tourist Registrations',
                                    data: touristData,
                                    borderColor: 'rgb(102, 126, 234)',
                                    backgroundColor: 'rgba(102, 126, 234, 0.1)',
                                    tension: 0.4,
                                    fill: true
                                },
                                {
                                    label: 'Honey Orders',
                                    data: orderData,
                                    borderColor: 'rgb(237, 137, 54)',
                                    backgroundColor: 'rgba(237, 137, 54, 0.1)',
                                    tension: 0.4,
                                    fill: true
                                }
                            ]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            plugins: {
                                legend: {
                                    display: true,
                                    position: 'top'
                                }
                            },
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    ticks: {
                                        stepSize: 1,
                                        callback: function(value) {
                                            return Number.isInteger(value) ? value : '';
                                        }
                                    },
                                    grid: {
                                        color: 'rgba(0,0,0,0.1)'
                                    }
                                },
                                x: {
                                    grid: {
                                        display: false
                                    }
                                }
                            },
                            interaction: {
                                intersect: false,
                                mode: 'index'
                            }
                        }
                    });
                }
            @endif


            // Add fade-in animation to cards
            const cards = document.querySelectorAll('.dashboard-card');
            cards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.1}s`;
                card.classList.add('fade-in-up');
            });

            // Active nav link highlighting
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.sidebar-nav .nav-link'); // More specific selector
            navLinks.forEach(link => {
                const href = link.getAttribute('href');
                // Make sure href is not null and not just a placeholder '#'
                if (href && href !== '#' && currentPath.startsWith(href)) {
                    // A more robust check for active state, especially for index pages
                    if (href === window.location.origin + '/' || href === '/') {
                        if (currentPath === href) {
                            link.classList.add('active');
                        }
                    } else {
                        link.classList.add('active');
                    }
                }
            });
        });

        // Responsive sidebar handling on resize
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const mainContent = document.getElementById('mainContent');

            if (window.innerWidth > 768) {
                // Desktop view - restore saved state
                if (localStorage.getItem('sidebarCollapsed') === 'true') {
                    sidebar.classList.add('collapsed');
                    mainContent.classList.add('expanded');
                } else {
                    sidebar.classList.remove('collapsed');
                    mainContent.classList.remove('expanded');
                }
                sidebar.classList.remove('show'); // Ensure mobile class is removed
            } else {
                // Mobile view
                sidebar.classList.remove('collapsed');
                mainContent.classList.remove('expanded');
            }
        });
    </script>
</body>

</html>
