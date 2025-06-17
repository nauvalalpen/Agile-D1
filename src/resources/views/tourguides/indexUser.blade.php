@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">TOUR<br>GUIDE</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="/tourguides" class="hero-btn">More info</a>
        </div>
    </section>

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
    @include('layouts.footer')
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

    <style>
        /* Fonts */
        h2.section-title,
        h3.section-title,
        h4.hot-topic-title,
        h6.news-title {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            letter-spacing: 0.02em;
        }

        p.hot-topic-desc,
        small,
        a.read-more-link {
            font-family: 'Poppins', sans-serif;
        }

        /* HOT TOPIC */
        .hot-topic-img-wrapper {
            height: 500px;
            /* diperbesar dari 400px */
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .hot-topic-img-wrapper:hover {
            transform: scale(1.03);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.35);
        }

        .hot-topic-img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 1.25rem;
            transition: transform 0.3s ease;
        }

        .hot-topic-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 2rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);
            border-bottom-left-radius: 1.25rem;
            border-bottom-right-radius: 1.25rem;
        }

        .hot-topic-title {
            font-size: 2rem;
            /* lebih besar */
            margin-bottom: 0.5rem;
            color: #fff;
        }

        .hot-topic-meta {
            font-size: 1rem;
            color: #ddd;
        }

        .hot-topic-desc {
            font-size: 1.2rem;
            line-height: 1.6;
            color: #eee;
            margin-top: 0.5rem;
        }

        .btn-read-more {
            margin-top: 1rem;
            font-size: 1.1rem;
            padding: 0.75rem 1.75rem;
        }

        /* LATEST NEWS */
        .card {
            border-radius: 1rem;
            transition: box-shadow 0.3s ease;
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .news-img {
            height: 250px;
            /* diperbesar */
            width: 100%;
            object-fit: cover;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            transition: transform 0.3s ease;
        }

        .hover-shadow:hover .news-img {
            transform: scale(1.05);
        }

        .card-body {
            padding: 1.25rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
        }

        .news-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: #222;
            flex-grow: 1;
        }

        .news-meta {
            font-size: 0.95rem;
            color: #777;
            margin-top: auto;
            font-style: italic;
        }

        /* RESPONSIVE - Skala turun bertahap */
        @media (max-width: 992px) {
            .hot-topic-img-wrapper {
                height: 400px;
            }

            .news-img {
                height: 200px;
            }

            .news-title {
                font-size: 1.1rem;
            }
        }

        @media (max-width: 768px) {
            .hot-topic-img-wrapper {
                height: 300px;
            }

            .news-img {
                height: 160px;
            }

            .hot-topic-title {
                font-size: 1.5rem;
            }

            .hot-topic-desc {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .news-img {
                height: 140px;
            }

            .news-title {
                font-size: 1rem;
            }
        }

        /* ==== BUTTON "READ MORE" ==== */
        .btn-read-more {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 30px;
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            color: #fff;
            font-weight: 600;
            font-size: 1.05rem;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
            gap: 0.5rem;
        }

        .btn-read-more:hover {
            background: linear-gradient(135deg, #0046b3, #003580);
            transform: translateY(-3px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        .btn-arrow {
            transition: transform 0.3s ease;
            font-weight: bold;
            font-size: 1.2rem;
        }

        .btn-read-more:hover .btn-arrow {
            transform: translateX(6px);
        }


        /* content   */
        body,
        html {
            margin: 0;
            padding: 0;
            font-family: 'Helvetica Neue', sans-serif;
        }

        .hero-section {
            position: relative;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2)),
                url('/images/hero.jpg') no-repeat center center/cover;
            height: 80vh;
            color: white;
            display: flex;
            align-items: center;
            justify-content: flex-start;
            overflow: hidden;
        }

        .hero-content {
            width: 100%;
            max-width: 1140px;
            padding-left: 400px;
            padding-right: 30px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.3s;
        }

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }


        .hero-title {
            font-size: 80px;
            /* besar dan dominan */
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: 30px;
            /* jarak antar huruf */
            text-transform: uppercase;
        }

        .hero-desc {
            font-size: 16px;
            margin-bottom: 28px;
            line-height: 1.6;
            color: #ddd;
            max-width: 500px;
        }

        .hero-btn {
            display: inline-block;
            padding: 12px 30px;
            background-color: transparent;
            border: 2px solid white;
            color: white;
            text-decoration: none;
            font-weight: 600;
            border-radius: 25px;
            transition: all 0.3s ease-in-out;
            font-size: 14px;
            letter-spacing: 1.5px;
        }

        .hero-btn:hover {
            background-color: white;
            color: black;
        }
    </style>
@endsection
