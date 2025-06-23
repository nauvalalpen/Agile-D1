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
    <!-- Add this in the <head> section -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">

    <!-- Additional Styles -->
    @yield('styles')

<style>
    :root {
        --primary-color: #067a30;
        --primary-dark: #1a3d2e;
        --secondary-color: #64748b;
        --accent-color: #f59e0b;
        --dark-color: #0f172a;
        --light-color: #f8fafc;
        --border-color: #e2e8f0;
        --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
        --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
        --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        
        /* Glass effect variables */
        --glass-bg: rgba(255, 255, 255, 0.1);
        --glass-border: rgba(255, 255, 255, 0.2);
        --glass-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

body,
html {
    margin: 0;
    padding: 0;
    font-family: 'Inter', 'Nunito', sans-serif;
    line-height: 1.6;
    background: #ffffff;
    min-height: 100vh;
    overflow-x: hidden;
}

body {
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: cover;
    position: relative;
}

body::before {
    content: '';
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: #ffffff;
    z-index: -1;
    pointer-events: none;
}


    /* Glass Effect Styles */
    .glass-navbar {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border-bottom: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        z-index: 1030;
        padding: 0.75rem 0;
    }

    .navbar-brand {
    font-weight: 700;
    font-size: 1.5rem;
    color: var(--primary-dark) !important; /* #22c55e - dark green */
    text-decoration: none;
    transition: all 0.3s ease;
    padding: 0.5rem 0;
    display: flex;
    align-items: center;
}

    .navbar-brand:hover {
    color: var(--primary-color) !important; /* #4ade80 - lighter green on hover */
    transform: scale(1.05);
}

    .navbar-nav {
        gap: 0.5rem;
    }

    .nav-link {
    font-weight: 500;
    color: var(--primary-dark) !important; /* #22c55e - dark green */
    padding: 0.75rem 1rem !important;
    border-radius: 0.5rem;
    transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    position: relative;
    text-decoration: none;
    font-size: 0.95rem;
    display: flex;
    align-items: center;
    white-space: nowrap;
}

   .nav-link:hover,
    .nav-link.active {
        color: var(--primary-color) !important; /* #4ade80 - lighter green on hover/active */
        background: rgba(74, 222, 128, 0.1); /* light green background */
        transform: translateY(-2px);
    }
    


    .dropdown-menu {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        border-radius: 0.75rem;
        padding: 0.5rem;
        margin-top: 0.5rem;
        min-width: 200px;
    }

   .dropdown-item {
    padding: 0.75rem 1rem;
    border-radius: 0.5rem;
    font-weight: 500;
    color: var(--primary-dark); /* #22c55e - dark green */
    transition: all 0.3s ease;
    font-size: 0.9rem;
    display: flex;
    align-items: center;
}
.dropdown-item:hover {
    background: rgba(74, 222, 128, 0.1); /* light green background */
    color: var(--primary-color); /* #4ade80 - lighter green on hover */
    transform: translateX(5px);
}

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
        width: 18px;
        height: 18px;
        font-size: 0.65rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 2px solid rgba(255, 255, 255, 0.3);
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
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .notification-item:hover {
        background: rgba(255, 255, 255, 0.05);
    }

    .notification-item.unread {
        background: rgba(37, 99, 235, 0.1);
        border-left: 3px solid #2563eb;
    }

    .navbar-toggler {
        border: none;
        padding: 0.5rem;
        border-radius: 0.5rem;
        transition: all 0.3s ease;
        width: 40px;
        height: 40px;
        background: rgba(255, 255, 255, 0.1);
    }

    .navbar-toggler:focus {
        box-shadow: none;
    }

    .navbar-toggler-icon {
        background-image: none;
        width: 24px;
        height: 3px;
        background-color: rgba(255, 255, 255, 0.8);
        border-radius: 2px;
        position: relative;
        transition: all 0.3s ease;
    }

    .navbar-toggler-icon::before,
    .navbar-toggler-icon::after {
        content: '';
        position: absolute;
        width: 24px;
        height: 3px;
        background-color: rgba(255, 255, 255, 0.8);
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

    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        display: flex;
        align-items: center;
        justify-content: center;
        color: rgba(255, 255, 255, 0.9);
        font-weight: 600;
        font-size: 0.8rem;
        margin-right: 0.5rem;
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .btn-glass {
        padding: 0.75rem 1.5rem;
        border-radius: 0.5rem;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.9rem;
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }

    .btn-glass-primary {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        color: rgba(255, 255, 255, 0.95);
    }

    .btn-glass-primary:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2));
        color: #1a3d2e;
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    .btn-glass-outline {
        background: transparent;
        color: rgba(255, 255, 255, 0.8);
        border: 1.5px solid rgba(255, 255, 255, 0.3);
    }

    .btn-glass-outline:hover {
        background: rgba(255, 255, 255, 0.1);
        color: rgba(255, 255, 255, 1);
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
    }

    body {
        padding-top: 80px;
    }

    /* Responsive Design */
    @media (max-width: 991.98px) {
        .navbar-collapse {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-radius: 0.75rem;
            padding: 1rem;
            margin-top: 0.75rem;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .notification-dropdown {
            width: 320px;
        }

        body {
            padding-top: 70px;
        }

        .navbar-nav .nav-item {
            margin-bottom: 0.5rem;
        }
    }

    @media (max-width: 576px) {
        .navbar-brand {
            font-size: 1.25rem;
        }

        .notification-dropdown {
            width: 280px;
        }

        .nav-link {
            font-size: 0.9rem;
            padding: 0.6rem 0.8rem !important;
        }

        .btn-glass {
            padding: 0.6rem 1.2rem;
            font-size: 0.85rem;
        }

        body {
            padding-top: 65px;
        }
    }

    html {
        scroll-behavior: smooth;
    }

    .loading-spinner {
        width: 18px;
        height: 18px;
        border: 2px solid rgba(255, 255, 255, 0.3);
        border-top: 2px solid rgba(255, 255, 255, 0.8);
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

    /* Additional styling to match index.blade.php */
    .notification-item .d-flex .flex-shrink-0>div {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
    }

    .dropdown-header {
        padding: 0.75rem 1rem;
        font-size: 0.85rem;
        font-weight: 600;
        color: rgba(255, 255, 255, 0.7);
    }

    .notification-list {
        max-height: 320px;
        overflow-y: auto;
    }

    .notification-list::-webkit-scrollbar {
        width: 6px;
    }

    .notification-list::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 3px;
    }
        .notification-list::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 3px;
    }

    .notification-list::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    .dropdown-menu[aria-labelledby="userDropdown"] {
        min-width: 220px;
    }

    .notification-item p {
        margin-bottom: 0.5rem;
        line-height: 1.5;
        color: rgba(255, 255, 255, 0.9);
    }

    .notification-item small {
        font-size: 0.8rem;
        color: rgba(255, 255, 255, 0.6);
    }

    .badge.bg-primary {
        font-size: 0.7rem;
        padding: 0.3rem 0.5rem;
        background: linear-gradient(135deg, #2563eb, #1d4ed8) !important;
    }

    .navbar-nav .nav-item:hover .nav-link {
        background: rgba(255, 255, 255, 0.05);
    }

    .nav-link:focus,
    .dropdown-item:focus,
    .btn-glass:focus,
    .navbar-toggler:focus {
        outline: 2px solid rgba(255, 255, 255, 0.5);
        outline-offset: 2px;
    }

    @media (max-width: 991.98px) {
        .navbar-nav {
            gap: 0.25rem;
        }

        .navbar-nav .nav-link {
            border-radius: 0.375rem;
            margin-bottom: 0.25rem;
        }
    }

    .dropdown-menu[aria-labelledby="servicesDropdown"] {
        min-width: 180px;
    }

    .nav-link,
    .dropdown-item,
    .btn-glass,
    .notification-item {
        transition: all 0.3s ease-in-out;
    }

    .notification-item .fw-bold {
        overflow: hidden;
        text-overflow: ellipsis;
        white-space: nowrap;
        max-width: 200px;
        color: rgba(255, 255, 255, 0.95);
    }

    .dropdown-divider {
        margin: 0.5rem 0;
        border-color: rgba(255, 255, 255, 0.1);
    }

    .dropdown-header .d-flex {
        align-items: center;
    }

    .dropdown-header .user-avatar {
        margin-right: 0.75rem;
    }

    .navbar-nav.ms-auto {
        align-items: center;
        gap: 0.75rem;
    }

    @media (max-width: 991.98px) {
        .navbar-nav .nav-item.dropdown .dropdown-menu {
            position: static;
            float: none;
            width: auto;
            margin-top: 0;
            background-color: transparent;
            border: 0;
            box-shadow: none;
            padding-left: 1.5rem;
        }

        .navbar-nav .nav-item.dropdown .dropdown-item {
            color: rgba(255, 255, 255, 0.8);
            padding: 0.5rem 0.75rem;
        }
    }

    .notification-list .text-center {
        padding: 2rem 1.5rem;
    }

    .notification-list .text-center i {
        font-size: 2rem;
        margin-bottom: 1rem;
        color: rgba(255, 255, 255, 0.4);
    }

    .notification-dropdown .btn-sm {
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
    }

    .alert {
        padding: 1rem 1.25rem;
        font-size: 0.9rem;
    }

    .ripple {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        transform: scale(0);
        animation: ripple-animation 0.6s linear;
        pointer-events: none;
    }

    @keyframes ripple-animation {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }

    .btn-glass,
    .nav-link,
    .dropdown-item {
        position: relative;
        overflow: hidden;
    }

    .toast-notification {
        min-width: 320px;
        font-size: 0.9rem;
    }

    .glass-navbar {
        z-index: 1030;
    }

    .dropdown-menu {
        z-index: 1031;
    }

    .toast-notification {
        z-index: 1040;
    }

    @media (max-width: 480px) {
        .glass-navbar {
            padding: 0.5rem 0;
        }

        .navbar-brand {
            font-size: 1.1rem;
        }

        .nav-link {
            font-size: 0.8rem;
            padding: 0.5rem 0.75rem !important;
        }

        .user-avatar {
            width: 28px;
            height: 28px;
            font-size: 0.75rem;
        }

        body {
            padding-top: 60px;
        }
    }

    /* Enhanced glass effects */
    .glass-navbar::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        pointer-events: none;
    }

    /* Micro-interactions for better UX */
    .nav-link::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 2px;
        background: rgba(255, 255, 255, 0.6);
        transition: all 0.3s ease;
        transform: translateX(-50%);
    }

    .nav-link.active::after,
    .nav-link:hover::after {
        width: 80%;
    }

    /* Enhanced dropdown menu styling */
    .dropdown-menu::before {
        content: '';
        position: absolute;
        top: -8px;
        left: 20px;
        width: 0;
        height: 0;
        border-left: 8px solid transparent;
        border-right: 8px solid transparent;
        border-bottom: 8px solid rgba(255, 255, 255, 0.1);
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
        background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.1) 75%);
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
    .btn-glass:focus-visible {
        outline: 2px solid rgba(255, 255, 255, 0.6);
        outline-offset: 2px;
        border-radius: 0.5rem;
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
        .glass-navbar {
            background: rgba(0, 0, 0, 0.9) !important;
            border-bottom: 2px solid #ffffff;
        }

        .nav-link,
        .dropdown-item {
            color: #ffffff !important;
        }

        .nav-link:hover,
        .nav-link.active {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
    }

    /* Print styles */
    @media print {
        .glass-navbar {
            display: none !important;
        }

        body {
            padding-top: 0 !important;
            background: white !important;
        }
    }

    /* Ensure proper touch targets on mobile */
    @media (max-width: 767.98px) {
        .nav-link,
        .dropdown-item,
        .btn-glass {
            min-height: 48px;
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
</style>


</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg glass-navbar">
            <div class="container">
                <!-- Brand -->
                <a class="navbar-brand" href="{{ url('/') }}">
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
                                Map
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('weather') ? 'active' : '' }}"
                                href="{{ url('weather') }}">
                                Weather
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('facilities/*') ? 'active' : '' }}"
                                href="{{ url('facilities/') }}">
                                Facility
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('gallery/*') ? 'active' : '' }}"
                                href="{{ url('gallery/') }}">
                                Gallery
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('beritas/*') ? 'active' : '' }}"
                                href="{{ url('beritas/') }}">
                                News
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('contact') ? 'active' : '' }}"
                                href="{{ url('contact') }}">
                                Contact
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="servicesDropdown" role="button"
                                data-bs-toggle="dropdown" aria-expanded="false">
                                Services
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="servicesDropdown">
                                <li>
                                    <a class="dropdown-item" href="{{ url('tourguides/') }}">
                                        Tour Guide
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('madu.index') }}">
                                        Honey Product
                                    </a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('produkUMKM.index') }}">
                                        UMKM Product
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
                                    Login
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-glass btn-glass-primary" href="{{ route('register') }}">
                                    Register
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
                                    Notifications
                                    @if ($totalUnreadNotifications > 0)
                                        <span class="notification-badge">{{ $totalUnreadNotifications }}</span>
                                    @endif
                                </a>

                                <div class="dropdown-menu notification-dropdown" aria-labelledby="notificationDropdown">
                                    <div class="d-flex justify-content-between align-items-center px-3 py-2 border-bottom">
                                        <h6 class="mb-0 fw-bold" style="color: rgba(255, 255, 255, 0.9);">Notifications</h6>
                                        @if ($totalUnreadNotifications > 0)
                                            <span class="badge bg-primary rounded-pill">{{ $totalUnreadNotifications }}</span>
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
                                                                <div style="background: linear-gradient(135deg, #2563eb, #1d4ed8); border-radius: 50%; padding: 0.5rem;">
                                                                    <span style="color: white; font-size: 0.8rem;">TG</span>
                                                                </div>
                                                            @else
                                                                <div style="background: linear-gradient(135deg, #f59e0b, #d97706); border-radius: 50%; padding: 0.5rem;">
                                                                    <span style="color: white; font-size: 0.8rem;">HN</span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        <div class="flex-grow-1">
                                                            <p class="mb-1 fw-medium">
                                                                @if ($notification->order_type == 'tour_guide')
                                                                    Tour guide
                                                                @else
                                                                    Honey order
                                                                @endif
                                                                <span class="fw-bold">{{ Str::limit($notification->item_name, 15) }}</span>
                                                            </p>
                                                            <p class="mb-1 small">
                                                                                                                               @if ($notification->status == 'accepted')
                                                                    <span style="color: #10b981; font-weight: 500;">
                                                                        ✓ Accepted
                                                                    </span>
                                                                @elseif($notification->status == 'rejected')
                                                                    <span style="color: #ef4444; font-weight: 500;">
                                                                        ✗ Rejected
                                                                    </span>
                                                                @endif
                                                            </p>
                                                            <small style="color: rgba(255, 255, 255, 0.6);">
                                                                {{ \Carbon\Carbon::parse($notification->updated_at)->diffForHumans() }}
                                                            </small>
                                                        </div>
                                                    </div>
                                                </a>
                                            @endforeach
                                        @else
                                            <div class="text-center py-3">
                                                <div style="font-size: 2rem; margin-bottom: 1rem; opacity: 0.4;">🔔</div>
                                                <p style="color: rgba(255, 255, 255, 0.6); margin: 0; font-size: 0.9rem;">No notifications</p>
                                            </div>
                                        @endif
                                    </div>

                                    @if (count($notifications) > 0)
                                        <div class="border-top p-2" style="border-color: rgba(255, 255, 255, 0.1) !important;">
                                            <a class="btn btn-sm btn-glass-outline w-100"
                                                href="{{ route('order-history.index') }}">
                                                View All
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            </li>

                            <!-- Order History -->
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('order-history.index') }}">
                                    History
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
                                                    <div class="fw-bold" style="color: rgba(255, 255, 255, 0.9);">{{ Str::limit(Auth::user()->name, 20) }}</div>
                                                    <small style="color: rgba(255, 255, 255, 0.6);">{{ Str::limit(Auth::user()->email, 25) }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('order-history.index') }}">
                                            My Orders
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('settings.index') }}">
                                            Settings
                                        </a>
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <a class="dropdown-item" style="color: #ef4444;" href="{{ route('logout') }}"
                                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            Logout
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
            // Glass navbar scroll effect
            const navbar = document.querySelector('.glass-navbar');
            let lastScrollTop = 0;

            window.addEventListener('scroll', function() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                if (scrollTop > 50) {
                    navbar.style.background = 'rgba(255, 255, 255, 0.15)';
                    navbar.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.2)';
                } else {
                    navbar.style.background = 'rgba(255, 255, 255, 0.1)';
                    navbar.style.boxShadow = '0 8px 32px rgba(0, 0, 0, 0.1)';
                }

                // Hide navbar on scroll down, show on scroll up (for mobile)
                if (window.innerWidth <= 768) {
                    if (scrollTop > lastScrollTop && scrollTop > 100) {
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

            // Add ripple effect to clickable elements
            document.querySelectorAll('.nav-link, .dropdown-item, .btn-glass').forEach(element => {
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
                    }, 600);
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
                        this.style.backgroundColor = 'rgba(255, 255, 255, 0.1)';
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
                        const dropdown = bootstrap.Dropdown.getInstance(menu.previousElementSibling);
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
            // Create glass toast notification
            const toast = document.createElement('div');
            toast.className = `alert position-fixed toast-notification`;
            toast.style.cssText = `
                top: 90px;
                right: 20px;
                z-index: 1040;
                min-width: 320px;
                animation: slideInRight 0.4s ease-out;
                background: rgba(255, 255, 255, 0.1);
                backdrop-filter: blur(20px);
                border: 1px solid rgba(255, 255, 255, 0.2);
                border-radius: 0.75rem;
                color: rgba(255, 255, 255, 0.9);
                box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            `;
            toast.innerHTML = `
                <div class="d-flex align-items-center">
                    <span style="margin-right: 0.75rem;">${type === 'success' ? '✓' : 'ℹ'}</span>
                    <span>${message}</span>
                    <button type="button" class="btn-close ms-auto" onclick="this.parentElement.parentElement.remove()" style="filter: invert(1); opacity: 0.7;"></button>
                </div>
            `;

            document.body.appendChild(toast);

            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.animation = 'slideOutRight 0.4s ease-out';
                    setTimeout(() => toast.remove(), 400);
                }
            }, 5000);
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

            .toast-notification .btn-close:hover {
                opacity: 1 !important;
            }

            /* Enhanced mobile menu animation */
            @media (max-width: 991.98px) {
                .navbar-collapse {
                    animation: slideDown 0.4s ease-out;
                }

                                @keyframes slideDown {
                    from {
                        opacity: 0;
                        transform: translateY(-15px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }

                .navbar-nav .nav-item {
                    animation: fadeInUp 0.4s ease-out;
                    animation-fill-mode: both;
                }

                .navbar-nav .nav-item:nth-child(1) { animation-delay: 0.1s; }
                .navbar-nav .nav-item:nth-child(2) { animation-delay: 0.15s; }
                .navbar-nav .nav-item:nth-child(3) { animation-delay: 0.2s; }
                .navbar-nav .nav-item:nth-child(4) { animation-delay: 0.25s; }
                .navbar-nav .nav-item:nth-child(5) { animation-delay: 0.3s; }
                .navbar-nav .nav-item:nth-child(6) { animation-delay: 0.35s; }
                .navbar-nav .nav-item:nth-child(7) { animation-delay: 0.4s; }
                .navbar-nav .nav-item:nth-child(8) { animation-delay: 0.45s; }

                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(15px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
            }

            /* Loading skeleton for better perceived performance */
            .skeleton {
                background: linear-gradient(90deg, rgba(255, 255, 255, 0.1) 25%, rgba(255, 255, 255, 0.2) 50%, rgba(255, 255, 255, 0.1) 75%);
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
            .btn-glass:focus-visible {
                outline: 2px solid rgba(255, 255, 255, 0.6);
                outline-offset: 2px;
                border-radius: 0.5rem;
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
                .glass-navbar {
                    background: rgba(0, 0, 0, 0.9) !important;
                    border-bottom: 2px solid #ffffff;
                }

                .nav-link,
                .dropdown-item {
                    color: #ffffff !important;
                }

                .nav-link:hover,
                .nav-link.active {
                    background-color: #ffffff !important;
                    color: #000000 !important;
                }
            }

            /* Print styles */
            @media print {
                .glass-navbar {
                    display: none !important;
                }

                body {
                    padding-top: 0 !important;
                    background: white !important;
                }
            }

            /* Ensure proper touch targets on mobile */
            @media (max-width: 767.98px) {
                .nav-link,
                .dropdown-item,
                .btn-glass {
                    min-height: 48px;
                    display: flex;
                    align-items: center;
                }
            }

            /* Optimize for very small screens */
            @media (max-width: 360px) {
                .navbar-brand {
                    font-size: 1rem;
                }

                .nav-link {
                    font-size: 0.8rem;
                    padding: 0.5rem 0.75rem !important;
                }

                .user-avatar {
                    width: 26px;
                    height: 26px;
                    font-size: 0.7rem;
                }

                .notification-badge {
                    width: 16px;
                    height: 16px;
                    font-size: 0.6rem;
                }
            }

            /* Glass effect enhancements */
            .glass-navbar::before {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
                pointer-events: none;
            }

            /* Smooth transitions for all interactive elements */
            .nav-link,
            .dropdown-item,
            .btn-glass,
            .notification-item {
                transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }

            /* Enhanced hover effects */
            .nav-link:hover::after {
                content: '';
                position: absolute;
                bottom: 0;
                left: 50%;
                width: 60%;
                height: 2px;
                background: rgba(255, 255, 255, 0.6);
                transform: translateX(-50%);
                border-radius: 1px;
            }

            /* Notification badge enhanced animation */
            .notification-badge {
                animation: pulse 2s infinite, bounce 0.6s ease-out;
            }

            @keyframes bounce {
                0%, 20%, 53%, 80%, 100% {
                    transform: translate3d(0,0,0);
                }
                40%, 43% {
                    transform: translate3d(0, -8px, 0);
                }
                70% {
                    transform: translate3d(0, -4px, 0);
                }
                90% {
                    transform: translate3d(0, -2px, 0);
                }
            }

            /* Enhanced dropdown menu styling */
            .dropdown-menu::before {
                content: '';
                position: absolute;
                top: -8px;
                left: 20px;
                width: 0;
                height: 0;
                border-left: 8px solid transparent;
                border-right: 8px solid transparent;
                border-bottom: 8px solid rgba(255, 255, 255, 0.1);
            }

            /* Improved scrollbar for notification list */
            .notification-list::-webkit-scrollbar {
                width: 4px;
            }

            .notification-list::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.05);
                border-radius: 2px;
            }

            .notification-list::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.3);
                border-radius: 2px;
            }

            .notification-list::-webkit-scrollbar-thumb:hover {
                background: rgba(255, 255, 255, 0.5);
            }
        `;
        document.head.appendChild(toastStyles);

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

        // Enhanced scroll behavior
        let ticking = false;
        function updateNavbar() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
            const navbar = document.querySelector('.glass-navbar');
            
            if (scrollTop > 50) {
                navbar.style.background = 'rgba(255, 255, 255, 0.15)';
                navbar.style.borderBottom = '1px solid rgba(255, 255, 255, 0.3)';
            } else {
                navbar.style.background = 'rgba(255, 255, 255, 0.1)';
                navbar.style.borderBottom = '1px solid rgba(255, 255, 255, 0.2)';
            }
            
            ticking = false;
        }

        function requestTick() {
            if (!ticking) {
                requestAnimationFrame(updateNavbar);
                ticking = true;
            }
        }

        window.addEventListener('scroll', requestTick);

        // Intersection Observer for animations
        if ('IntersectionObserver' in window) {
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }
                });
            }, observerOptions);

            // Observe elements that should animate on scroll
            document.querySelectorAll('.animate-on-scroll').forEach(el => {
                el.style.opacity = '0';
                el.style.transform = 'translateY(20px)';
                el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
                observer.observe(el);
            });
        }
    </script>

    @stack('scripts')
</body>

</html>


