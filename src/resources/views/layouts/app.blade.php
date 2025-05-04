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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
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
                        <a class="nav-link mx-1" href="{{ url('weather') }}">
                            Weather
                        </a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link mx-1" href="{{ url('facilities/') }}">
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
                        <a class="nav-link mx-1" href="{{ url('contact') }}">
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
                            <a class="dropdown-item" href="{{ route('madu.index') }}">Honey Product</a>
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
                                <a id="notificationDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <span class="notification-icon">
                                        <i class="fas fa-bell"></i>
                                        @if ($totalUnreadNotifications > 0)
                                            <span
                                                class="notification-badge bg-danger">{{ $totalUnreadNotifications }}</span>
                                        @endif
                                    </span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="notificationDropdown">
                                    <h6 class="dropdown-header">Notifications</h6>

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

                                    @if (count($notifications) > 0)
                                        @foreach ($notifications as $notification)
                                            <a class="dropdown-item {{ $notification->is_read ? '' : 'fw-bold' }}"
                                                href="{{ route('order-history.show', ['id' => $notification->id, 'type' => $notification->order_type]) }}">
                                                @if ($notification->order_type == 'tour_guide')
                                                    Your tour guide request with {{ $notification->item_name }} has been
                                                @else
                                                    Your honey order for {{ $notification->item_name }} has been
                                                @endif

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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous">
    </script>
</body>

</html>
