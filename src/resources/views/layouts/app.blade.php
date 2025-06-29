<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'oneVision' }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Additional Styles -->
    @yield('styles')

    <style>
        :root {
            --primary-color: #0a1f0f;
            --primary-dark: #1a3d2e;
            --secondary-color: #2f5842;
            --accent-color: #f59e0b;
            --dark-color: #071d0e;
            --light-color: #f8fafc;
            --border-color: #e2e8f0;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        body {
            font-family: 'Inter', 'Nunito', sans-serif;
            line-height: 1.6;
        }

        /* Responsive Content */
        .main-content {
            min-height: calc(100vh - 200px);
            padding: 2rem 0;
        }

        /* Responsive Cards */
        .card {
            margin-bottom: 1.5rem;
            border: none;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 0.75rem;
        }

        .card-body {
            padding: 1.5rem;
        }

        /* Responsive Buttons */
        .btn {
            border-radius: 0.5rem;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }

        /* Mobile Responsive Styles */
        @media (max-width: 576px) {
            .container {
                padding: 0 1rem;
            }

            .main-content {
                padding: 1rem 0;
            }

            .card-body {
                padding: 1rem;
            }

            .btn {
                padding: 0.5rem 1rem;
                font-size: 0.9rem;
            }

            .navbar-brand {
                font-size: 1.2rem;
            }

            h1 {
                font-size: 1.8rem;
            }

            h2 {
                font-size: 1.5rem;
            }

            h3 {
                font-size: 1.3rem;
            }
        }

        /* Tablet Responsive Styles */
        @media (max-width: 768px) {
            .navbar-nav {
                text-align: center;
                margin-top: 1rem;
            }

            .navbar-nav .nav-link {
                padding: 0.5rem 1rem;
            }

            .main-content {
                padding: 1.5rem 0;
            }
        }

        /* Large Tablet/Small Desktop */
        @media (max-width: 992px) {
            .container {
                max-width: 100%;
                padding: 0 2rem;
            }
        }

        /* Utility Classes for Responsive */
        .text-responsive {
            font-size: clamp(0.9rem, 2.5vw, 1.1rem);
        }

        .title-responsive {
            font-size: clamp(1.5rem, 4vw, 2.5rem);
        }

        /* Responsive Images */
        img {
            max-width: 100%;
            height: auto;
        }

        /* Responsive Tables */
        .table-responsive {
            overflow-x: auto;
        }

        @media (max-width: 768px) {
            .table-responsive table {
                font-size: 0.8rem;
            }
        }

        /* Compact Modern Navbar Styles */
        .modern-navbar {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
            padding: 0.5rem 0;
            /* Reduced padding for compact design */
            min-height: 60px;
            /* Fixed compact height */
        }

        .modern-navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-md);
            min-height: 55px;
            /* Even more compact when scrolled */
        }

        /* Compact Brand */
        .navbar-brand {
            font-weight: 700;
            font-size: 1.25rem;
            /* Reduced size */
            color: var(--dark-color) !important;
            text-decoration: none;
            transition: all 0.3s ease;
            padding: 0.25rem 0;
            /* Minimal padding */
            display: flex;
            align-items: center;
        }

        .navbar-brand i {
            font-size: 1.1rem;
            /* Smaller icon */
            margin-right: 0.5rem;
        }

        .navbar-brand:hover {
            color: var(--primary-color) !important;
            transform: scale(1.02);
        }

        /* Compact Navigation */
        .navbar-nav {
            gap: 0.25rem;
            /* Reduced gap */
        }

        .nav-link {
            font-weight: 500;
            color: var(--secondary-color) !important;
            padding: 0.4rem 0.75rem !important;
            /* Compact padding */
            border-radius: 0.375rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            text-decoration: none;
            font-size: 0.875rem;
            /* Smaller font */
            display: flex;
            align-items: center;
            white-space: nowrap;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
            background-color: rgba(10, 100, 40, 0.08);
            transform: translateY(-1px);
        }

        .nav-link i {
            font-size: 0.8rem;
            /* Smaller icons */
            margin-right: 0.4rem;
            width: 14px;
            /* Fixed width for alignment */
            text-align: center;
        }

        /* Compact Dropdown */
        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-xl);
            border-radius: 0.5rem;
            padding: 0.375rem;
            margin-top: 0.25rem;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            min-width: 180px;
            /* Compact width */
        }

        .dropdown-item {
            padding: 0.5rem 0.75rem;
            /* Compact padding */
            border-radius: 0.375rem;
            font-weight: 500;
            color: var(--secondary-color);
            transition: all 0.3s ease;
            font-size: 0.875rem;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background-color: rgba(37, 99, 235, 0.08);
            color: var(--primary-color);
            transform: translateX(2px);
        }

        .dropdown-item i {
            margin-right: 0.5rem;
            width: 14px;
            text-align: center;
            font-size: 0.8rem;
        }

        /* Compact Notification Styles */
        .notification-wrapper {
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: 0px;
            right: 0px;
            background: linear-gradient(90deg, #228B22, #90EE90, #228B22);
            color: white;
            border-radius: 50%;
            width: 16px;
            /* Smaller badge */
            height: 16px;
            font-size: 0.6rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1.5px solid white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(39, 146, 75, 0.7);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(239, 68, 68, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        .notification-dropdown {
            width: 320px;
            /* Compact width */
            max-height: 350px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 0.75rem;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
            font-size: 0.875rem;
        }

        .notification-item:hover {
            background-color: var(--light-color);
        }

        .notification-item.unread {
            background-color: rgba(37, 99, 235, 0.05);
            border-left: 2px solid var(--primary-color);
        }

        /* Compact Mobile Toggle */
        .navbar-toggler {
            border: none;
            padding: 0.375rem;
            border-radius: 0.375rem;
            transition: all 0.3s ease;
            width: 36px;
            /* Compact size */
            height: 36px;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: none;
            width: 20px;
            /* Smaller hamburger */
            height: 2px;
            background-color: var(--dark-color);
            border-radius: 1px;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 2px;
            background-color: var(--dark-color);
            border-radius: 1px;
            transition: all 0.3s ease;
        }

        .navbar-toggler-icon::before {
            top: -6px;
        }

        .navbar-toggler-icon::after {
            top: 6px;
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon {
            background-color: transparent;
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::before {
            transform: rotate(45deg);
            top: 0;
        }

        .navbar-toggler[aria-expanded="true"] .navbar-toggler-icon::after {
            transform: rotate(-45deg);
            top: 0;
        }

        /* Compact User Avatar */
        .user-avatar {
            width: 28px;
            /* Smaller avatar */
            height: 28px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.75rem;
            margin-right: 0.4rem;
        }

        /* Compact Buttons */
        .btn-modern {
            padding: 0.4rem 1rem;
            /* Compact padding */
            border-radius: 0.375rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.375rem;
            font-size: 0.875rem;
        }

        .btn-modern-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .btn-modern-primary:hover {
            transform: translateY(-1px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        .btn-modern-outline {
            background: transparent;
            color: var(--primary-color);
            border: 1.5px solid var(--primary-color);
        }

        .btn-modern-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-1px);
            box-shadow: var(--shadow-lg);
        }

        /* Compact body padding */
        body {
            padding-top: 65px;
            /* Reduced padding */
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-radius: 0.5rem;
                padding: 0.75rem;
                margin-top: 0.5rem;
                box-shadow: var(--shadow-lg);
            }

            .notification-dropdown {
                width: 280px;
            }

            body {
                padding-top: 60px;
            }

            /* Stack mobile menu items more compactly */
            .navbar-nav .nav-item {
                margin-bottom: 0.25rem;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.1rem;
            }

            .notification-dropdown {
                width: 260px;
            }

            .nav-link {
                font-size: 0.8rem;
                padding: 0.35rem 0.6rem !important;
            }

            .btn-modern {
                padding: 0.35rem 0.8rem;
                font-size: 0.8rem;
            }

            body {
                padding-top: 55px;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Loading animation */
        .loading-spinner {
            width: 16px;
            /* Smaller spinner */
            height: 16px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Compact notification content */
        .notification-item .d-flex .flex-shrink-0>div {
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .notification-item .d-flex .flex-shrink-0 i {
            font-size: 0.8rem;
        }

        /* Ensure dropdown headers are compact */
        .dropdown-header {
            padding: 0.5rem 0.75rem;
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--secondary-color);
        }

        /* Compact notification list styling */
        .notification-list {
            max-height: 280px;
            overflow-y: auto;
        }

        .notification-list::-webkit-scrollbar {
            width: 4px;
        }

        .notification-list::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 2px;
        }

        .notification-list::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 2px;
        }

        .notification-list::-webkit-scrollbar-thumb:hover {
            background: var(--primary-dark);
        }

        /* Compact user dropdown styling */
        .dropdown-menu[aria-labelledby="userDropdown"] {
            min-width: 200px;
        }

        /* Ensure all text is properly sized */
        .notification-item p {
            margin-bottom: 0.25rem;
            line-height: 1.4;
        }

        .notification-item small {
            font-size: 0.75rem;
        }

        /* Compact badge in notification dropdown */
        .badge.bg-primary {
            font-size: 0.65rem;
            padding: 0.25rem 0.4rem;
        }

        /* Hover effects for better UX */
        .navbar-nav .nav-item:hover .nav-link {
            background-color: rgba(37, 99, 235, 0.05);
        }

        /* Focus states for accessibility */
        .nav-link:focus,
        .dropdown-item:focus,
        .btn-modern:focus,
        .navbar-toggler:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* Ensure proper spacing in mobile view */
        @media (max-width: 991.98px) {
            .navbar-nav {
                gap: 0.125rem;
            }

            .navbar-nav .nav-link {
                border-radius: 0.25rem;
                margin-bottom: 0.125rem;
            }
        }

        /* Compact services dropdown */
        .dropdown-menu[aria-labelledby="servicesDropdown"] {
            min-width: 160px;
        }

        /* Ensure icons are properly aligned */
        .nav-link i,
        .dropdown-item i {
            flex-shrink: 0;
        }

        /* Compact notification icon */
        .nav-link .fas.fa-bell {
            font-size: 0.9rem;
        }

        /* Smooth transitions for all interactive elements */
        .nav-link,
        .dropdown-item,
        .btn-modern,
        .social-link,
        .notification-item {
            transition: all 0.2s ease-in-out;
        }

        /* Ensure proper text truncation in compact view */
        .notification-item .fw-bold {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 180px;
        }

        /* Compact divider styling */
        .dropdown-divider {
            margin: 0.25rem 0;
        }

        /* Ensure proper alignment of user info in dropdown */
        .dropdown-header .d-flex {
            align-items: center;
        }

        .dropdown-header .user-avatar {
            margin-right: 0.5rem;
        }

        /* Compact button group styling */
        .navbar-nav.ms-auto {
            align-items: center;
            gap: 0.5rem;
        }

        /* Ensure proper mobile menu item spacing */
        @media (max-width: 991.98px) {
            .navbar-nav .nav-item.dropdown .dropdown-menu {
                position: static;
                float: none;
                width: auto;
                margin-top: 0;
                background-color: transparent;
                border: 0;
                box-shadow: none;
                padding-left: 1rem;
            }

            .navbar-nav .nav-item.dropdown .dropdown-item {
                color: var(--secondary-color);
                padding: 0.25rem 0.5rem;
            }
        }

        /* Compact notification empty state */
        .notification-list .text-center {
            padding: 1.5rem 1rem;
        }

        .notification-list .text-center i {
            font-size: 1.5rem;
            margin-bottom: 0.5rem;
        }

        /* Ensure proper button sizing in notification dropdown */
        .notification-dropdown .btn-sm {
            padding: 0.375rem 0.75rem;
            font-size: 0.8rem;
        }

        /* Compact alert styling for notifications */
        .alert {
            padding: 0.75rem 1rem;
            font-size: 0.875rem;
        }

        /* Ensure proper icon sizing in alerts */
        .alert i {
            font-size: 0.9rem;
        }

        /* Compact ripple effect */
        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.4s linear;
            pointer-events: none;
        }

        @keyframes ripple-animation {
            to {
                transform: scale(3);
                opacity: 0;
            }
        }

        /* Ensure buttons have relative positioning for ripple effect */
        .btn-modern,
        .nav-link,
        .dropdown-item {
            position: relative;
            overflow: hidden;
        }

        /* Compact toast notifications */
        .toast-notification {
            min-width: 280px;
            font-size: 0.875rem;
        }

        /* Ensure proper z-index stacking */
        .modern-navbar {
            z-index: 1030;
        }

        .dropdown-menu {
            z-index: 1031;
        }

        .toast-notification {
            z-index: 1040;
        }

        /* Compact search functionality (if needed) */
        .navbar-search {
            max-width: 200px;
        }

        .navbar-search .form-control {
            padding: 0.375rem 0.75rem;
            font-size: 0.875rem;
            border-radius: 0.375rem;
        }

        /* Ensure proper mobile responsiveness */
        @media (max-width: 480px) {
            .modern-navbar {
                padding: 0.375rem 0;
                min-height: 50px;
            }

            .navbar-brand {
                font-size: 1rem;
            }

            .nav-link {
                font-size: 0.75rem;
                padding: 0.3rem 0.5rem !important;
            }

            .user-avatar {
                width: 24px;
                height: 24px;
                font-size: 0.7rem;
            }

            body {
                padding-top: 50px;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg modern-navbar">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-eye"></i>
                    {{ $title ?? 'Air Terjun Lubuk Hitam' }}
                </a>

                <!-- Mobile Toggle -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Navigation -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('minimap.*') ? 'active' : '' }}"
                                href="{{ route('minimap.index') }}">
                                <i class="fas fa-map-marked-alt"></i>Peta
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('weather') ? 'active' : '' }}"
                                href="{{ url('weather') }}">
                                <i class="fas fa-cloud-sun"></i>Cuaca
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('facilities/*') ? 'active' : '' }}"
                                href="{{ url('facilities/') }}">
                                <i class="fas fa-building"></i>Fasilitas
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('gallery/*') ? 'active' : '' }}"
                                href="{{ url('gallery/') }}">
                                <i class="fas fa-images"></i>Galeri
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('beritas/*') ? 'active' : '' }}"
                                href="{{ url('beritas/') }}">
                                <i class="fas fa-newspaper"></i>Berita
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                                href="{{ url('contact') }}">
                                <i class="fas fa-envelope"></i>Kontak
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-concierge-bell"></i>Layanan
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ url('tourguides/') }}">
                                        <i class="fas fa-user-tie"></i>Pemandu Wisata
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('madu.index') }}">
                                        <i class="fas fa-jar"></i>Madu
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('produkUMKM.index') }}">
                                        <i class="fas fa-store"></i>Produk UMKM
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Navigation -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i>Masuk
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-modern btn-modern-primary" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i>Daftar
                                </a>
                            </li>
                        @else
                            <!-- Notifications -->
                            @php
                                $unreadTourGuideNotifications = DB::table('order_tour_guides')
                                    ->where('user_id', Auth::id())
                                    ->whereIn('status', ['accepted', 'rejected'])
                                    ->where('is_read', false)
                                    ->count();

                                $unreadHoneyNotifications = DB::table('order_madus')
                                    ->where('user_id', Auth::id())
                                    ->whereIn('status', ['accepted', 'rejected'])
                                    ->where('is_read', false)
                                    ->count();

                                $totalUnreadNotifications = $unreadTourGuideNotifications + $unreadHoneyNotifications;
                            @endphp

                            <li class="nav-item dropdown">
                                <a class="nav-link notification-wrapper" href="#" id="notificationDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell"></i>
                                    @if ($totalUnreadNotifications > 0)
                                        <span class="notification-badge">{{ $totalUnreadNotifications }}</span>
                                    @endif
                                </a>

                                <div class="dropdown-menu notification-dropdown" aria-labelledby="notificationDropdown">
                                    <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                                        <h6 class="mb-0 fw-bold">Notifikasi</h6>
                                        @if ($totalUnreadNotifications > 0)
                                            <span
                                                class="badge bg-primary rounded-pill">{{ $totalUnreadNotifications }}</span>
                                        @endif
                                    </div>

                                    @php
                                        $tourGuideNotifications = DB::table('order_tour_guides')
                                            ->join('tourguides', 'order_tour_guides.tourguide_id', '=', 'tourguides.id')
                                            ->select(
                                                'order_tour_guides.id',
                                                'order_tour_guides.status',
                                                'order_tour_guides.is_read',
                                                'order_tour_guides.updated_at',
                                                'tourguides.nama as item_name',
                                                DB::raw("'tour_guide' as order_type"),
                                            )
                                            ->where('order_tour_guides.user_id', Auth::id())
                                            ->whereIn('order_tour_guides.status', ['accepted', 'rejected']);

                                        $honeyNotifications = DB::table('order_madus')
                                            ->join('madus', 'order_madus.madu_id', '=', 'madus.id')
                                            ->select(
                                                'order_madus.id',
                                                'order_madus.status',
                                                'order_madus.is_read',
                                                'order_madus.updated_at',
                                                'madus.nama_madu as item_name',
                                                DB::raw("'honey' as order_type"),
                                            )
                                            ->where('order_madus.user_id', Auth::id())
                                            ->whereIn('order_madus.status', ['accepted', 'rejected']);

                                        $notifications = $tourGuideNotifications
                                            ->union($honeyNotifications)
                                            ->orderBy('updated_at', 'desc')
                                            ->limit(5)
                                            ->get();
                                    @endphp

                                    <div class="notification-list">
                                        @if (count($notifications) > 0)
                                            @foreach ($notifications as $notification)
                                                <a class="notification-item {{ $notification->is_read ? '' : 'unread' }}"
                                                    href="{{ route('order-history.show', ['id' => $notification->id, 'type' => $notification->order_type]) }}">
                                                    <div class="d-flex">
                                                        <div class="flex-shrink-0 me-2">
                                                            @if ($notification->order_type == 'tour_guide')
                                                                <div class="bg-primary rounded-circle p-1">
                                                                    <i class="fas fa-user-tie text-white"></i>
                                                                </div>
                                                            @else
                                                                <div class="bg-warning rounded-circle p-1">
                                                                    <i class="fas fa-jar text-white"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1 fw-medium">
                                                                @if ($notification->order_type == 'tour_guide')
                                                                    Pemandu Wisata
                                                                @else
                                                                    Madu
                                                                @endif
                                                                <span
                                                                    class="fw-bold">{{ Str::limit($notification->item_name, 15) }}</span>
                                                            </p>
                                                            <p class="mb-1 small">
                                                                @if ($notification->status == 'accepted')
                                                                    <span class="text-success fw-medium">
                                                                        <i class="fas fa-check-circle"></i> Diterima
                                                                    </span>
                                                                @elseif($notification->status == 'rejected')
                                                                    <span class="text-danger fw-medium">
                                                                        <i class="fas fa-times-circle"></i> Ditolak
                                                                    </span>
                                                                @endif
                                                            </p>
                                                            <small class="text-muted">
                                                                <i class="fas fa-clock"></i>
                                                                {{ \Carbon\Carbon::parse($notification->updated_at)->diffForHumans() }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <div class="text-center py-3">
                                                <i class="fas fa-bell-slash text-muted fs-4 mb-2"></i>
                                                <p class="text-muted mb-0 small">Tidak Ada Notifikasi</p>
                                            </div>
                                        @endif
                                    </div>

                                    @if (count($notifications) > 0)
                                        <div class="border-top p-2">
                                            <a class="btn btn-sm btn-outline-primary w-100"
                                                href="{{ route('order-history.index') }}">
                                                <i class="fas fa-history"></i> Lihat Semuanya
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </li>

                            <!-- Order History -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order-history.index') }}">
                                    <i class="fas fa-history"></i>Riwayat
                                </a>
                            </li>

                            <!-- User Menu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="d-none d-md-inline">{{ Str::limit(Auth::user()->name, 12) }}</span>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li>
                                        <div class="dropdown-header">
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold">{{ Str::limit(Auth::user()->name, 20) }}</div>
                                                    <small
                                                        class="text-muted">{{ Str::limit(Auth::user()->email, 25) }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('order-history.index') }}">
                                            <i class="fas fa-shopping-bag"></i>Pesanan Saya
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('settings.index') }}">
                                            <i class="fas fa-cog"></i>Pengaturan
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>Keluar
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            @yield('content')
        </main>

        <!-- Logout Form -->
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Compact navbar scroll effect
            const navbar = document.querySelector('.modern-navbar');
            let lastScrollTop = 0;

            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 30) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                // Hide navbar on scroll down, show on scroll up (for mobile)
                if (window.innerWidth <= 768) {
                    if (scrollTop > lastScrollTop && scrollTop > 80) {
                        navbar.style.transform = 'translateY(-100%)';
                    } else {
                        navbar.style.transform = 'translateY(0)';
                    }
                }

                lastScrollTop = scrollTop;
            });

            // Active link highlighting
            const currentPath = window.location.pathname;
            const navLinks = document.querySelectorAll('.nav-link');

            navLinks.forEach(link => {
                if (link.getAttribute('href') === currentPath) {
                    link.classList.add('active');
                }
            });

            // Notification handling
            document.querySelectorAll('.notification-item').forEach(function(item) {
                item.addEventListener('click', function() {
                    // Mark as read visually
                    this.classList.remove('unread');

                    // Update notification count
                    const badge = document.querySelector('.notification-badge');
                    if (badge) {
                        let count = parseInt(badge.textContent);
                        count = Math.max(0, count - 1);

                        if (count === 0) {
                            badge.style.display = 'none';
                        } else {
                            badge.textContent = count;
                        }
                    }
                });
            });

            // Smooth dropdown animations
            const dropdowns = document.querySelectorAll('.dropdown');
            dropdowns.forEach(dropdown => {
                const menu = dropdown.querySelector('.dropdown-menu');

                dropdown.addEventListener('show.bs.dropdown', function() {
                    menu.style.opacity = '0';
                    menu.style.transform = 'translateY(-8px)';

                    setTimeout(() => {
                        menu.style.transition = 'all 0.2s cubic-bezier(0.4, 0, 0.2, 1)';
                        menu.style.opacity = '1';
                        menu.style.transform = 'translateY(0)';
                    }, 10);
                });
            });

            // Mobile menu close on link click
            const navbarCollapse = document.querySelector('.navbar-collapse');
            const navLinks = document.querySelectorAll('.navbar-nav .nav-link');

            navLinks.forEach(link => {
                link.addEventListener('click', () => {
                    if (window.innerWidth < 992) {
                        const bsCollapse = new bootstrap.Collapse(navbarCollapse, {
                            toggle: false
                        });
                        bsCollapse.hide();
                    }
                });
            });

            // Add ripple effect to clickable elements
            document.querySelectorAll('.nav-link, .dropdown-item, .btn-modern').forEach(element => {
                element.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.width = ripple.style.height = size + 'px';
                    ripple.style.left = x + 'px';
                    ripple.style.top = y + 'px';
                    ripple.classList.add('ripple');

                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 400);
                });
            });

            // Notification auto-refresh (optional)
            @if (auth()->check())
                setInterval(function() {
                    // You can implement AJAX call here to refresh notifications
                    // without page reload if needed
                }, 60000); // Check every minute
            @endif

            // Handle flash messages for notifications
            @if (session('notification_read'))
                setTimeout(function() {
                    window.location.reload();
                }, 100);
            @endif

            // Optimize for touch devices
            if ('ontouchstart' in window) {
                document.querySelectorAll('.nav-link, .dropdown-item').forEach(element => {
                    element.addEventListener('touchstart', function() {
                        this.style.backgroundColor = 'rgba(37, 99, 235, 0.1)';
                    });

                    element.addEventListener('touchend', function() {
                        setTimeout(() => {
                            this.style.backgroundColor = '';
                        }, 150);
                    });
                });
            }

            // Keyboard navigation support
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    // Close all open dropdowns
                    document.querySelectorAll('.dropdown-menu.show').forEach(menu => {
                        const dropdown = bootstrap.Dropdown.getInstance(menu
                            .previousElementSibling);
                        if (dropdown) dropdown.hide();
                    });
                }
            });

            // Preload critical resources
            const criticalLinks = [
                "{{ route('order-history.index') }}",
                "{{ url('gallery/') }}",
                "{{ route('minimap.index') }}"
            ];

            criticalLinks.forEach(link => {
                const linkElement = document.createElement('link');
                linkElement.rel = 'prefetch';
                linkElement.href = link;
                document.head.appendChild(linkElement);
            });
        });

        // Utility functions
        function showLoading(element) {
            const originalContent = element.innerHTML;
            element.innerHTML = '<span class="loading-spinner me-1"></span>Loading...';
            element.disabled = true;

            return function hideLoading() {
                element.innerHTML = originalContent;
                element.disabled = false;
            };
        }

        // Global notification function
        function showNotification(message, type = 'info') {
            // Create compact toast notification
            const toast = document.createElement('div');
            toast.className = `alert alert-${type === 'success' ? 'success' : 'info'} position-fixed toast-notification`;
            toast.style.cssText = `
                top: 70px;
                right: 15px;
                z-index: 1040;
                min-width: 280px;
                animation: slideInRight 0.3s ease-out;
                font-size: 0.875rem;
            `;
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'info-circle'} me-2"></i>
                    <span>${message}</span>
                    <button type="button" class="btn-close btn-close-sm ms-auto" onclick="this.parentElement.parentElement.remove()"></button>
                </div>
            `;

            document.body.appendChild(toast);

            // Auto remove after 4 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.animation = 'slideOutRight 0.3s ease-out';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 4000);
        }

        // Performance optimization
        window.addEventListener('load', function() {
            // Remove loading states
            document.body.classList.add('loaded');

            // Initialize intersection observer for lazy loading
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            observer.unobserve(img);
                        }
                    });
                });

                document.querySelectorAll('img[data-src]').forEach(img => {
                    imageObserver.observe(img);
                });
            }
        });
        // Add CSS animations for toast notifications
        const toastStyles = document.createElement('style');
        toastStyles.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(100%);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }

            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(100%);
                    opacity: 0;
                }
            }

            .toast-notification {
                border-radius: 0.5rem;
                box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
                border: none;
            }

            .toast-notification .btn-close-sm {
                font-size: 0.7rem;
                padding: 0.25rem;
            }

            /* Smooth loading state */
            body:not(.loaded) {
                overflow: hidden;
            }

            body.loaded {
                overflow: visible;
            }

            /* Lazy loading placeholder */
            img.lazy {
                background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
            }

            @keyframes loading {
                0% {
                    background-position: 200% 0;
                }
                100% {
                    background-position: -200% 0;
                }
            }

            /* Enhanced focus indicators for better accessibility */
            .nav-link:focus-visible,
            .dropdown-item:focus-visible,
            .btn-modern:focus-visible {
                outline: 2px solid var(--primary-color);
                outline-offset: 2px;
                border-radius: 0.375rem;
            }

            /* Reduce motion for users who prefer it */
            @media (prefers-reduced-motion: reduce) {
                *,
                *::before,
                *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
            }

            /* High contrast mode improvements */
            @media (prefers-contrast: high) {
                .modern-navbar {
                    background: #ffffff;
                    border-bottom: 2px solid #000000;
                }

                .nav-link,
                .dropdown-item {
                    color: #000000 !important;
                }

                .nav-link:hover,
                .nav-link.active {
                    background-color: #000000 !important;
                    color: #ffffff !important;
                }
            }

            /* Print styles */
            @media print {
                .modern-navbar {
                    display: none !important;
                }

                body {
                    padding-top: 0 !important;
                }
            }

            /* Dark mode support (system preference) */
            @media (prefers-color-scheme: dark) {
                .modern-navbar {
                    background: rgba(15, 23, 42, 0.95);
                    border-bottom-color: rgba(255, 255, 255, 0.1);
                }

                .nav-link {
                    color: rgba(255, 255, 255, 0.8) !important;
                }

                .nav-link:hover,
                .nav-link.active {
                    color: #3b82f6 !important;
                    background-color: rgba(59, 130, 246, 0.1);
                }

                .dropdown-menu {
                    background: rgba(15, 23, 42, 0.98);
                    border: 1px solid rgba(255, 255, 255, 0.1);
                }

                .dropdown-item {
                    color: rgba(255, 255, 255, 0.8);
                }

                .dropdown-item:hover {
                    background-color: rgba(59, 130, 246, 0.1);
                    color: #3b82f6;
                }
            }

            /* Compact scrollbar for notification dropdown */
            .notification-list::-webkit-scrollbar {
                width: 3px;
            }

            .notification-list::-webkit-scrollbar-track {
                background: rgba(0, 0, 0, 0.05);
                border-radius: 1.5px;
            }

            .notification-list::-webkit-scrollbar-thumb {
                background: var(--primary-color);
                border-radius: 1.5px;
            }

            .notification-list::-webkit-scrollbar-thumb:hover {
                background: var(--primary-dark);
            }

            /* Micro-interactions for better UX */
            .nav-link::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 0;
                height: 2px;
                background: var(--primary-color);
                transition: all 0.3s ease;
                transform: translateX(-50%);
            }

            .nav-link.active::after,
            .nav-link:hover::after {
                width: 80%;
            }

            /* Notification badge pulse animation */
            .notification-badge {
                animation: pulse 2s infinite;
            }

            @keyframes pulse {
                0% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
                }
                70% {
                    transform: scale(1.05);
                    box-shadow: 0 0 0 6px rgba(239, 68, 68, 0);
                }
                100% {
                    transform: scale(1);
                    box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
                }
            }

            /* Smooth state transitions */
            .navbar-toggler-icon,
            .navbar-toggler-icon::before,
            .navbar-toggler-icon::after {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Enhanced mobile menu */
            @media (max-width: 991.98px) {
                .navbar-collapse {
                    animation: slideDown 0.3s ease-out;
                }

                @keyframes slideDown {
                    from {
                        opacity: 0;
                        transform: translateY(-10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .navbar-nav .nav-item {
                    animation: fadeInUp 0.3s ease-out;
                    animation-fill-mode: both;
                }

                .navbar-nav .nav-item:nth-child(1) { animation-delay: 0.1s; }
                .navbar-nav .nav-item:nth-child(2) { animation-delay: 0.15s; }
                .navbar-nav .nav-item:nth-child(3) { animation-delay: 0.2s; }
                .navbar-nav .nav-item:nth-child(4) { animation-delay: 0.25s; }
                .navbar-nav .nav-item:nth-child(5) { animation-delay: 0.3s; }
                .navbar-nav .nav-item:nth-child(6) { animation-delay: 0.35s; }
                .navbar-nav .nav-item:nth-child(7) { animation-delay: 0.4s; }

                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(10px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            }

            /* Loading skeleton for better perceived performance */
            .skeleton {
                background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
                background-size: 200% 100%;
                animation: loading 1.5s infinite;
            }

            /* Ensure proper touch targets on mobile */
            @media (max-width: 767.98px) {
                .nav-link,
                .dropdown-item,
                .btn-modern {
                    min-height: 44px;
                    display: flex;
                    align-items: center;
                }
            }

            /* Optimize for very small screens */
            @media (max-width: 360px) {
                .navbar-brand {
                    font-size: 0.95rem;
                }

                .nav-link {
                    font-size: 0.7rem;
                    padding: 0.25rem 0.4rem !important;
                }

                .user-avatar {
                    width: 22px;
                    height: 22px;
                    font-size: 0.65rem;
                }

                .notification-badge {
                    width: 14px;
                    height: 14px;
                    font-size: 0.55rem;
                }
            }
        `;
        document.head.appendChild(toastStyles);

        // Service Worker registration for PWA capabilities (optional)
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', function() {
                navigator.serviceWorker.register('/sw.js')
                    .then(function(registration) {
                        console.log('SW registered: ', registration);
                    })
                    .catch(function(registrationError) {
                        console.log('SW registration failed: ', registrationError);
                    });
            });
        }

        // Network status monitoring
        window.addEventListener('online', function() {
            showNotification('Connection restored', 'success');
        });

        window.addEventListener('offline', function() {
            showNotification('Connection lost. Some features may not work.', 'warning');
        });

        // Memory cleanup on page unload
        window.addEventListener('beforeunload', function() {
            // Clear any intervals or timeouts
            // Remove event listeners if needed
            // Clean up any resources
        });
    </script>

    @stack('scripts')
</body>

</html>
