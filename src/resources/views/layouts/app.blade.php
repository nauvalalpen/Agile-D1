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
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" defer></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Additional Styles -->
    @yield('styles')

    <style>
        .notification-badge {
            position: absolute;
            top: 0;
            right: 0;
            padding: 0.25rem 0.5rem;
            border-radius: 50%;
            font-size: 0.75rem;
        }

        .notification-icon {
            position: relative;
            padding-right: 0.5rem;
        }
    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ $title ?? 'oneVision' }}
                </a>
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link mx-1" href="{{ url('tourguides/') }}">
                            Map
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link mx-1" href="{{ url('tourguides/') }}">
                            Weather
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link mx-1" href="{{ url('tourguides/') }}">
                            Facility
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link mx-1" href="{{ url('tourguides/') }}">
                            Gallery
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link mx-1" href="{{ url('tourguides/') }}">
                            News
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link mx-1" href="{{ url('tourguides/') }}">
                            Contact Us
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Our Service
                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ url('tourguides/') }}">Tour Guide</a>
                            <a class="dropdown-item" href="#">Honey Product</a>
                            {{-- <div class="dropdown-divider"></div> --}}
                            <a class="dropdown-item" href="#">UMKM Product</a>
                        </div>
                    </li>
                </ul>


                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    {{-- <ul class="navbar-nav me-auto">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('tourguides.index') }}">{{ __('Tour Guides') }}</a>
                            </li>

                            @if (Auth::user()->role === 'admin')
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('admin.orders.index') }}">{{ __('Manage Orders') }}</a>
                                </li>
                            @endif
                        @endauth
                    </ul> --}}

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <!-- Notification Icon -->
                            @php
                                $unreadNotifications = DB::table('order_tour_guides')
                                    ->where('user_id', Auth::id())
                                    ->whereIn('status', ['accepted', 'rejected'])
                                    ->where('is_read', false)
                                    ->count();
                            @endphp

                            <li class="nav-item dropdown">
                                <a id="notificationDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="notification-icon">
                                        <i class="fas fa-bell"></i>
                                        @if ($unreadNotifications > 0)
                                            <span class="notification-badge bg-danger">{{ $unreadNotifications }}</span>
                                        @endif
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                                    <h6 class="dropdown-header">Notifications</h6>

                                    @php
                                        $notifications = DB::table('order_tour_guides')
                                            ->join('tourguides', 'order_tour_guides.tourguide_id', '=', 'tourguides.id')
                                            ->select('order_tour_guides.*', 'tourguides.nama as tourguide_name')
                                            ->where('order_tour_guides.user_id', Auth::id())
                                            ->whereIn('order_tour_guides.status', ['accepted', 'rejected'])
                                            ->orderBy('order_tour_guides.updated_at', 'desc')
                                            ->limit(5)
                                            ->get();
                                    @endphp

                                    @if (count($notifications) > 0)
                                        @foreach ($notifications as $notification)
                                            <a class="dropdown-item {{ $notification->is_read ? '' : 'fw-bold' }}"
                                                href="{{ route('order-history.show', $notification->id) }}">
                                                Your order with {{ $notification->tourguide_name }} has been
                                                @if ($notification->status == 'accepted')
                                                    <span class="text-success">accepted</span>
                                                @elseif($notification->status == 'rejected')
                                                    <span class="text-danger">rejected</span>
                                                @endif
                                                <div class="small text-muted">
                                                    {{ \Carbon\Carbon::parse($notification->updated_at)->diffForHumans() }}
                                                </div>
                                            </a>
                                        @endforeach
                                        <div class="dropdown-divider"></div>
                                    @else
                                        <div class="dropdown-item">No notifications</div>
                                        <div class="dropdown-divider"></div>
                                    @endif

                                    <a class="dropdown-item text-center" href="{{ route('order-history.index') }}">
                                        View All
                                    </a>
                                </div>
                            </li>

                            <!-- Order History Link -->
                            <li class="nav-item">
                                <a class="nav-link"
                                    href="{{ route('order-history.index') }}">{{ __('Order History') }}</a>
                            </li>

                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    style="z-index: 1050;" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown"
                                    style="z-index: 1051;">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- Bootstrap 5 JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Bootstrap 4 JavaScript -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
