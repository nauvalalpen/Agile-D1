@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">HONEY<br>PRODUCT</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="/honey" class="hero-btn">More info</a>
        </div>
    </section>
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-4">Honey Products</h1>
                <p class="text-center lead">Discover our premium honey products from Desa Wisata Kampung Budaya Polowijen
                </p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse ($madus as $madu)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($madu->gambar)
                            <img src="{{ asset('storage/' . $madu->gambar) }}" class="card-img-top"
                                alt="{{ $madu->nama_madu }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center py-5">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $madu->nama_madu }}</h5>
                            <p class="card-text text-muted">{{ $madu->ukuran }}</p>
                            <p class="card-text">{{ Str::limit($madu->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0 text-primary">Rp {{ number_format($madu->harga, 0, ',', '.') }}</span>
                                <span
                                    class="badge bg-{{ $madu->stock > 10 ? 'success' : ($madu->stock > 0 ? 'warning' : 'danger') }}">
                                    {{ $madu->stock > 0 ? 'Stock: ' . $madu->stock : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $madu->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Modal -->
                <div class="modal fade" id="detailModal{{ $madu->id }}" tabindex="-1"
                    aria-labelledby="detailModalLabel{{ $madu->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $madu->id }}">{{ $madu->nama_madu }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($madu->gambar)
                                            <img src="{{ asset('storage/' . $madu->gambar) }}" class="img-fluid rounded"
                                                alt="{{ $madu->nama_madu }}">
                                        @else
                                            <div class="bg-light text-center py-5 rounded">
                                                <i class="fas fa-image fa-5x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h4>{{ $madu->nama_madu }}</h4>
                                        <p class="text-muted">Size: {{ $madu->ukuran }}</p>
                                        <p class="h5 text-primary mb-3">Rp {{ number_format($madu->harga, 0, ',', '.') }}
                                        </p>
                                        <p>{{ $madu->deskripsi }}</p>

                                        <div class="d-flex align-items-center mb-3">
                                            <span class="me-2">Availability:</span>
                                            <span
                                                class="badge bg-{{ $madu->stock > 10 ? 'success' : ($madu->stock > 0 ? 'warning' : 'danger') }}">
                                                {{ $madu->stock > 0 ? 'In Stock (' . $madu->stock . ' available)' : 'Out of Stock' }}
                                            </span>
                                        </div>

                                        @if ($madu->stock > 0)
                                            @auth
                                                <a href="{{ route('madu.order', $madu->id) }}" class="btn btn-primary">
                                                    Order Now
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                                    Login to Order
                                                </a>
                                            @endauth
                                        @else
                                            <button class="btn btn-secondary" disabled>Out of Stock</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4 class="alert-heading">No Honey Products Available</h4>
                        <p>We're currently updating our inventory. Please check back later.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>

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

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Comprehensive fix for modal backdrop issues
            const fixModalBackdrop = () => {
                // Remove all backdrop elements
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });

                // Reset body styles
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            };

            // Add event listeners to all modal close buttons
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(fixModalBackdrop, 500);
                });
            });

            // Add event listeners to all modals for when they're hidden
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(fixModalBackdrop, 500);
                });

                // Also handle the case where the modal is closed by clicking outside
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        setTimeout(fixModalBackdrop, 500);
                    }
                });
            });

            // Handle ESC key press
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    setTimeout(fixModalBackdrop, 500);
                }
            });

            // Additional safety measure: periodically check for orphaned backdrops
            setInterval(function() {
                if (!document.querySelector('.modal.show') && document.querySelector('.modal-backdrop')) {
                    fixModalBackdrop();
                }
            }, 2000);
        });
    </script>
@endsection
