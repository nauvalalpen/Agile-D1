<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

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
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --secondary-color: #64748b;
            --accent-color: #f59e0b;
            --dark-color: #0f172a;
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

        /* Modern Navbar Styles */
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
        }

        .modern-navbar.scrolled {
            background: rgba(255, 255, 255, 0.98);
            box-shadow: var(--shadow-md);
        }

        .navbar-brand {
            font-weight: 800;
            font-size: 1.5rem;
            color: var(--dark-color) !important;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand:hover {
            color: var(--primary-color) !important;
            transform: scale(1.05);
        }

        .navbar-nav {
            gap: 0.5rem;
        }

        .nav-link {
            font-weight: 500;
            color: var(--secondary-color) !important;
            padding: 0.75rem 1rem !important;
            border-radius: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            text-decoration: none;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--primary-color) !important;
            background-color: rgba(37, 99, 235, 0.1);
            transform: translateY(-1px);
        }

        .nav-link i {
            margin-right: 0.5rem;
            font-size: 0.9rem;
        }

        /* Dropdown Styles */
        .dropdown-menu {
            border: none;
            box-shadow: var(--shadow-xl);
            border-radius: 0.75rem;
            padding: 0.5rem;
            margin-top: 0.5rem;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
        }

        .dropdown-item {
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 500;
            color: var(--secondary-color);
            transition: all 0.3s ease;
        }

        .dropdown-item:hover {
            background-color: rgba(37, 99, 235, 0.1);
            color: var(--primary-color);
            transform: translateX(4px);
        }

        .dropdown-item i {
            margin-right: 0.75rem;
            width: 1rem;
            text-align: center;
        }

        /* Notification Styles */
        .notification-wrapper {
            position: relative;
        }

        .notification-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            font-size: 0.7rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 2px solid white;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0.7);
            }

            70% {
                box-shadow: 0 0 0 10px rgba(239, 68, 68, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(239, 68, 68, 0);
            }
        }

        .notification-dropdown {
            width: 350px;
            max-height: 400px;
            overflow-y: auto;
        }

        .notification-item {
            padding: 1rem;
            border-bottom: 1px solid var(--border-color);
            transition: all 0.3s ease;
        }

        .notification-item:hover {
            background-color: var(--light-color);
        }

        .notification-item.unread {
            background-color: rgba(37, 99, 235, 0.05);
            border-left: 3px solid var(--primary-color);
        }

        /* Mobile Menu Toggle */
        .navbar-toggler {
            border: none;
            padding: 0.5rem;
            border-radius: 0.5rem;
            transition: all 0.3s ease;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        .navbar-toggler-icon {
            background-image: none;
            width: 24px;
            height: 2px;
            background-color: var(--dark-color);
            border-radius: 2px;
            position: relative;
            transition: all 0.3s ease;
        }

        .navbar-toggler-icon::before,
        .navbar-toggler-icon::after {
            content: '';
            position: absolute;
            width: 24px;
            height: 2px;
            background-color: var(--dark-color);
            border-radius: 2px;
            transition: all 0.3s ease;
        }

        .navbar-toggler-icon::before {
            top: -8px;
        }

        .navbar-toggler-icon::after {
            top: 8px;
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

        /* User Avatar */
        .user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 600;
            font-size: 0.8rem;
            margin-right: 0.5rem;
        }

        /* Modern Buttons */
        .btn-modern {
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            border: none;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-modern-primary {
            background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
            color: white;
        }

        .btn-modern-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        .btn-modern-outline {
            background: transparent;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
        }

        .btn-modern-outline:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        /* Body padding for fixed navbar */
        body {
            padding-top: 80px;
        }

        /* Responsive Design */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                -webkit-backdrop-filter: blur(20px);
                border-radius: 0.75rem;
                padding: 1rem;
                margin-top: 1rem;
                box-shadow: var(--shadow-lg);
            }

            .notification-dropdown {
                width: 300px;
            }

            body {
                padding-top: 70px;
            }
        }

        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.25rem;
            }

            .notification-dropdown {
                width: 280px;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
        }

        /* Loading animation */
        .loading-spinner {
            width: 20px;
            height: 20px;
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
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg modern-navbar">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
                    <i class="fas fa-eye me-2"></i>
                    {{ $title ?? 'oneVision' }}
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
                                <i class="fas fa-map-marked-alt"></i>Map
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('weather') ? 'active' : '' }}"
                                href="{{ url('weather') }}">
                                <i class="fas fa-cloud-sun"></i>Weather
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('facilities/*') ? 'active' : '' }}"
                                href="{{ url('facilities/') }}">
                                <i class="fas fa-building"></i>Facility
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('gallery/*') ? 'active' : '' }}"
                                href="{{ url('gallery/') }}">
                                <i class="fas fa-images"></i>Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('beritas/*') ? 'active' : '' }}"
                                href="{{ url('beritas/') }}">
                                <i class="fas fa-newspaper"></i>News
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                                href="{{ url('contact') }}">
                                <i class="fas fa-envelope"></i>Contact Us
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-concierge-bell"></i>Our Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ url('tourguides/') }}">
                                        <i class="fas fa-user-tie"></i>Tour Guide
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('madu.index') }}">
                                        <i class="fas fa-jar"></i>Honey Product
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('produkUMKM.index') }}">
                                        <i class="fas fa-store"></i>UMKM Product
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>

                    <!-- Right Navigation -->
                    <ul class="navbar-nav ms-auto align-items-center">
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">
                                    <i class="fas fa-sign-in-alt"></i>{{ __('Login') }}
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-modern btn-modern-primary" href="{{ route('register') }}">
                                    <i class="fas fa-user-plus"></i>{{ __('Register') }}
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

                            <li class="nav-item dropdown me-3">
                                <a class="nav-link notification-wrapper" href="#" id="notificationDropdown"
                                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fas fa-bell fs-5"></i>
                                    @if ($totalUnreadNotifications > 0)
                                        <span class="notification-badge">{{ $totalUnreadNotifications }}</span>
                                    @endif
                                </a>

                                <div class="dropdown-menu notification-dropdown" aria-labelledby="notificationDropdown">
                                    <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                                        <h6 class="mb-0 fw-bold">Notifications</h6>
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
                                                        <div class="flex-shrink-0 me-3">
                                                            @if ($notification->order_type == 'tour_guide')
                                                                <div class="bg-primary rounded-circle p-2">
                                                                    <i class="fas fa-user-tie text-white"></i>
                                                                </div>
                                                            @else
                                                                <div class="bg-warning rounded-circle p-2">
                                                                    <i class="fas fa-jar text-white"></i>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1 fw-medium">
                                                                @if ($notification->order_type == 'tour_guide')
                                                                    Tour guide request
                                                                @else
                                                                    Honey order
                                                                @endif
                                                                <span
                                                                    class="fw-bold">{{ $notification->item_name }}</span>
                                                            </p>
                                                            <p class="mb-1 small">
                                                                Status:
                                                                @if ($notification->status == 'accepted')
                                                                    <span class="text-success fw-medium">
                                                                        <i class="fas fa-check-circle"></i> Accepted
                                                                    </span>
                                                                @elseif($notification->status == 'rejected')
                                                                    <span class="text-danger fw-medium">
                                                                        <i class="fas fa-times-circle"></i> Rejected
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
                                            <div class="text-center py-4">
                                                <i class="fas fa-bell-slash text-muted fs-2 mb-2"></i>
                                                <p class="text-muted mb-0">No notifications</p>
                                            </div>
                                        @endif
                                    </div>

                                    @if (count($notifications) > 0)
                                        <div class="border-top p-2">
                                            <a class="btn btn-sm btn-outline-primary w-100"
                                                href="{{ route('order-history.index') }}">
                                                <i class="fas fa-history"></i> View All History
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </li>

                            <!-- Order History -->
                            <li class="nav-item me-3">
                                <a class="nav-link" href="{{ route('order-history.index') }}">
                                    <i class="fas fa-history"></i>{{ __('Order History') }}
                                </a>
                            </li>

                            <!-- User Menu -->
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle d-flex align-items-center" href="#"
                                    id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <span class="d-none d-md-inline">{{ Auth::user()->name }}</span>
                                </a>

                                <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                    <li>
                                        <div class="dropdown-header">
                                            <div class="d-flex align-items-center">
                                                <div class="user-avatar me-2">
                                                    {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                                </div>
                                                <div>
                                                    <div class="fw-bold">{{ Auth::user()->name }}</div>
                                                    <small class="text-muted">{{ Auth::user()->email }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-user"></i>Profile Settings
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('order-history.index') }}">
                                            <i class="fas fa-shopping-bag"></i>My Orders
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#">
                                            <i class="fas fa-cog"></i>Account Settings
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fas fa-sign-out-alt"></i>{{ __('Logout') }}
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
            // Navbar scroll effect
            const navbar = document.querySelector('.modern-navbar');
            let lastScrollTop = 0;

            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 50) {
                    navbar.classList.add('scrolled');
                } else {
                    navbar.classList.remove('scrolled');
                }

                // Hide navbar on scroll down, show on scroll up
                if (scrollTop > lastScrollTop && scrollTop > 100) {
                    navbar.style.transform = 'translateY(-100%)';
                } else {
                    navbar.style.transform = 'translateY(0)';
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
                    menu.style.transform = 'translateY(-10px)';

                    setTimeout(() => {
                        menu.style.transition = 'all 0.3s cubic-bezier(0.4, 0, 0.2, 1)';
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
        });

        // Utility functions
        function showLoading(element) {
            const originalContent = element.innerHTML;
            element.innerHTML = '<span class="loading-spinner me-2"></span>Loading...';
            element.disabled = true;

            return function hideLoading() {
                element.innerHTML = originalContent;
                element.disabled = false;
            };
        }

        // Global notification function
        function showNotification(message, type = 'info') {
            // You can implement toast notifications here
            console.log(`${type.toUpperCase()}: ${message}`);
        }
    </script>

    @stack('scripts')
</body>

</html>
