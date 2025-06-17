@extends('layouts.app')

@section('content')

    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">RECAP<br>NEWS</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="/beritas" class="hero-btn">More info</a>
        </div>
    </section>

    <div class="product-page-container">
        <div class="container py-5">
            <div class="page-header text-center">
                <h1 class="page-title">UMKM PRODUCTS</h1>
                <p class="page-subtitle">Discover authentic and quality products from our local partners.</p>
            </div>

            @if ($produkUMKM->isNotEmpty())
                <div class="row g-4 g-lg-5">
                    @foreach ($produkUMKM as $produk)
                        <div class="col-lg-6">
                            {{-- Horizontal Product Card --}}
                            <div class="product-card-horizontal">
                                <div class="row g-0 h-100">
                                    {{-- Image Column --}}
                                    <div class="col-md-5 product-image-wrapper">
                                        <div class="price-tag">Rp {{ number_format($produk->harga, 0, ',', '.') }}</div>
                                        @if ($produk->foto)
                                            <img src="{{ asset('storage/' . $produk->foto) }}" class="product-image"
                                                alt="{{ $produk->nama }}">
                                        @else
                                            <div class="product-image-placeholder">
                                                <i class="fas fa-store fa-3x"></i>
                                            </div>
                                        @endif
                                    </div>

                                    {{-- Details Column --}}
                                    <div class="col-md-7 d-flex flex-column p-4">
                                        <h3 class="product-title">{{ $produk->nama }}</h3>

                                        <div class="product-info-box flex-grow-1">
                                            <p class="product-description">{{ Str::limit($produk->deskripsi, 150) }}</p>
                                        </div>

                                        <button class="btn btn-outline-primary mt-3" data-bs-toggle="modal"
                                            data-bs-target="#productModal{{ $produk->id }}">
                                            View Details <i class="fas fa-arrow-right ms-2"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                @if ($produkUMKM->hasPages())
                    <div class="d-flex justify-content-center mt-5">
                        {{ $produkUMKM->links() }}
                    </div>
                @endif
            @else
                <div class="text-center py-5">
                    <div class="card p-5 border-dashed">
                        <i class="fas fa-box-open fa-4x text-muted mb-3"></i>
                        <h3 class="fw-bold">No Products Found</h3>
                        <p class="text-muted">Please check back later for new and exciting UMKM products.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- Product Detail Modals (Styling enhanced via CSS) -->
    @foreach ($produkUMKM as $produk)
        <div class="modal fade" id="productModal{{ $produk->id }}" tabindex="-1"
            aria-labelledby="productModalLabel{{ $produk->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="productModalLabel{{ $produk->id }}">
                            {{ $produk->nama }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body p-4">
                        <div class="row g-4">
                            <div class="col-md-6">
                                @if ($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded shadow-sm"
                                        alt="{{ $produk->nama }}">
                                @else
                                    <div class="product-image-placeholder modal-placeholder">
                                        <i class="fas fa-store fa-5x"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 d-flex flex-column">
                                <h3 class="fw-bold text-primary mb-3">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </h3>
                                <h6 class="fw-bold mb-2">Description</h6>
                                <p class="text-muted mb-4">{{ $produk->deskripsi }}</p>

                                <div class="mt-auto">
                                    <a href="#" class="btn btn-primary btn-lg w-100">
                                        <i class="fab fa-whatsapp me-2"></i> Contact Seller
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach


    @include('layouts.footer')


    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;700&family=Manrope:wght@700;800&display=swap');

        :root {
            --font-heading: 'Manrope', sans-serif;
            --font-body: 'Inter', sans-serif;
            --color-primary: #0d6efd;
            --color-text: #333;
            --color-text-muted: #6c757d;
            --color-background: #f8f9fa;
            --card-background: #ffffff;
            --info-box-background: #f1f3f5;
            --card-shadow: 0 4px 6px rgba(0, 0, 0, 0.04);
            --card-shadow-hover: 0 10px 25px rgba(0, 0, 0, 0.08);
            --border-radius: 12px;
            --transition: all 0.3s ease;
        }

        .product-page-container {
            background-color: var(--color-background);
            font-family: var(--font-body);
        }

        .page-header {
            margin-bottom: 4rem;
        }

        .page-title {
            font-family: var(--font-heading);
            font-weight: 800;
            font-size: 2.75rem;
            color: var(--color-text);
            letter-spacing: -1px;
        }

        .page-subtitle {
            font-size: 1.1rem;
            color: var(--color-text-muted);
            max-width: 500px;
            margin: 0.5rem auto 0;
        }

        /* Horizontal Product Card */
        .product-card-horizontal {
            background-color: var(--card-background);
            border-radius: var(--border-radius);
            box-shadow: var(--card-shadow);
            transition: var(--transition);
            overflow: hidden;
            border: 1px solid #e9ecef;
            height: 100%;
        }

        .product-card-horizontal:hover {
            transform: translateY(-6px);
            box-shadow: var(--card-shadow-hover);
        }

        .product-image-wrapper {
            position: relative;
            padding: 1rem;
        }

        .product-image {
            width: 100%;
            height: 100%;
            min-height: 220px;
            object-fit: cover;
            border-radius: calc(var(--border-radius) - 4px);
        }

        .product-image-placeholder {
            width: 100%;
            height: 100%;
            min-height: 220px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e9ecef;
            color: #adb5bd;
            border-radius: calc(var(--border-radius) - 4px);
        }

        .price-tag {
            position: absolute;
            top: 1.5rem;
            left: 1.5rem;
            background-color: rgba(0, 0, 0, 0.65);
            color: #fff;
            padding: 6px 12px;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 700;
            backdrop-filter: blur(4px);
            z-index: 1;
        }

        .product-title {
            font-family: var(--font-heading);
            font-weight: 700;
            font-size: 1.4rem;
            color: var(--color-text);
            margin-bottom: 1rem;
        }

        .product-info-box {
            background-color: var(--info-box-background);
            border-radius: 8px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .product-description {
            font-size: 0.95rem;
            line-height: 1.6;
            color: var(--color-text-muted);
            margin: 0;
        }

        .product-card-horizontal .btn {
            font-weight: 500;
            transition: var(--transition);
        }

        .product-card-horizontal .btn i {
            transition: transform 0.2s ease-in-out;
        }

        .product-card-horizontal .btn:hover i {
            transform: translateX(4px);
        }

        /* Modal Styling */
        .modal-content {
            border-radius: var(--border-radius);
            border: none;
        }

        .modal-header .modal-title {
            font-family: var(--font-heading);
            font-weight: 700;
        }

        .modal-placeholder {
            height: 100%;
        }

        /* Pagination Styling */
        .pagination .page-link {
            color: var(--color-primary);
            border-radius: 50px !important;
            /* Use important to override bootstrap */
            margin: 0 4px;
            border: 1px solid #dee2e6;
            transition: var(--transition);
        }

        .pagination .page-link:hover {
            background-color: #e9ecef;
            color: var(--color-primary);
        }

        .pagination .page-item.active .page-link {
            background-color: var(--color-primary);
            border-color: var(--color-primary);
            color: #fff;
            box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3);
        }

        .pagination .page-item.disabled .page-link {
            color: #adb5bd;
        }

        /* Empty State */
        .border-dashed {
            border: 2px dashed #e0e0e0;
            border-radius: var(--border-radius);
            background-color: #fff;
        }

        /* Responsive adjustments */
        @media (max-width: 767px) {
            .product-image-wrapper {
                padding: 1rem 1rem 0 1rem;
                /* Adjust padding for stacked view */
            }

            .product-card-horizontal .p-4 {
                padding-top: 1.5rem !important;
            }
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
            padding-left: 295px;
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
