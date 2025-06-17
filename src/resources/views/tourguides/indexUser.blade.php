@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="text-center mb-5">
                    <h1 class="display-5 fw-bold">Explore Our Tour Guides</h1>
                    <p class="lead text-muted">Find the perfect guide for your next adventure.</p>
                </div>

                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="row">
                    @forelse ($tourguides as $tourguide)
                        <div class="col-md-6 col-lg-4 mb-4">
                            <div class="card tourguide-card h-100 shadow-sm border-0">
                                @if ($tourguide->foto)
                                    <img src="{{ asset('storage/' . $tourguide->foto) }}"
                                        class="card-img-top tourguide-card-img" alt="{{ $tourguide->nama }}">
                                @else
                                    <img src="{{ asset('images/default-profile.jpg') }}"
                                        class="card-img-top tourguide-card-img" alt="Default Profile">
                                @endif

                                <div class="card-body d-flex flex-column">
                                    <h4 class="card-title fw-bold">{{ $tourguide->nama }}</h4>
                                    <p class="card-text text-muted">{{ $tourguide->deskripsi }}</p>

                                    <ul class="list-group list-group-flush my-3">
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-map-marker-alt fa-fw me-3 text-primary"></i>
                                            <span>{{ $tourguide->alamat }}</span>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-phone fa-fw me-3 text-primary"></i>
                                            <span>{{ $tourguide->nohp }}</span>
                                        </li>
                                        <li class="list-group-item d-flex align-items-center">
                                            <i class="fas fa-dollar-sign fa-fw me-3 text-primary"></i>
                                            <span class="fw-bold">{{ $tourguide->price_range }}</span>
                                        </li>
                                    </ul>

                                    <div class="mt-auto">
                                        @auth
                                            <a href="{{ route('tourguides.order', $tourguide->id) }}"
                                                class="btn btn-success btn-lg w-100">
                                                <i class="fas fa-calendar-check me-2"></i>Order Now
                                            </a>
                                        @else
                                            <div class="alert alert-warning text-center small p-2">
                                                Please log in to order a tour guide.
                                            </div>
                                            <a href="{{ route('login') }}" class="btn btn-primary w-100">
                                                <i class="fas fa-sign-in-alt me-2"></i>Login to Order
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="alert alert-info text-center">
                                <h3>No Tour Guides Available</h3>
                                <p>Please check back later, we're always adding new guides to our platform.</p>
                            </div>
                        </div>
                    @endforelse
                </div>

                @if (isset($tourguides) && method_exists($tourguides, 'links'))
                    <div class="d-flex justify-content-center mt-4">
                        {{ $tourguides->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .tourguide-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border-radius: 15px !important;
            overflow: hidden;
        }

        .tourguide-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
        }

        .tourguide-card-img {
            height: 250px;
            object-fit: cover;
        }

        .list-group-item {
            padding-left: 0;
            padding-right: 0;
            border: 0;
        }

        .fa-fw.me-3 {
            width: 1.25em;
            /* Font Awesome fixed-width */
            margin-right: 1rem !important;
        }
    </style>
@endsection
