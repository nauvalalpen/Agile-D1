@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">UMKM<br>PRODUCT</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="/honey" class="hero-btn">More info</a>
        </div>
    </section>
    <div class="container-fluid py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-white mb-3">Produk UMKM</h1>
                <p class="lead text-white-50">Discover authentic local products from our community</p>
            </div>
        </div>
    </div>

    <div class="container py-5">
        @if ($produkUMKM->count() > 0)
            <div class="row g-4">
                @foreach ($produkUMKM as $produk)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 product-card">
                            <div class="position-relative overflow-hidden">
                                @if ($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}" class="card-img-top product-image"
                                        alt="{{ $produk->nama }}" style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                        style="height: 250px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary rounded-pill">UMKM</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark mb-2">{{ $produk->nama }}</h5>
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit($produk->deskripsi, 100) }}</p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="text-primary fw-bold mb-0">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </h4>
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#productModal{{ $produk->id }}">
                                            <i class="fas fa-eye"></i> View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $produkUMKM->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                <h3 class="text-muted">No Products Available</h3>
                <p class="text-muted">Check back later for new UMKM products.</p>
            </div>
        @endif
    </div>

    <!-- Product Detail Modals -->
    @foreach ($produkUMKM as $produk)
        <div class="modal fade" id="productModal{{ $produk->id }}" tabindex="-1"
            aria-labelledby="productModalLabel{{ $produk->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="productModalLabel{{ $produk->id }}">
                            {{ $produk->nama }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded"
                                        alt="{{ $produk->nama }}">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="height: 300px;">
                                        <i class="fas fa-image fa-5x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold text-primary mb-3">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </h4>
                                <h6 class="fw-bold mb-2">Description:</h6>
                                <p class="text-muted">{{ $produk->deskripsi }}</p>

                                <div class="mt-4">
                                    <button class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-shopping-cart"></i> Contact Seller
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .product-image {
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
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

    @include('layouts.footer')
@endsection
