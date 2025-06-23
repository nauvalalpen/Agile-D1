@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">RECAP<br>NEWS</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="/beritas" class="hero-btn">More info</a>
        </div>
    </section>
    <div class="container py-5">
        <!-- HOT TOPICS -->
        <h2 class="section-title mb-4">Hot Topics</h2>
        <div class="row g-4 mb-5 align-items-stretch">
            <div class="col-lg-8">
                <div class="position-relative hot-topic-img-wrapper rounded-4 overflow-hidden shadow-sm">
                    <a href="{{ route('berita.detail', $hotTopic->id) }}" class="d-block h-100">
                        <img src="{{ asset('storage/' . $hotTopic->foto) }}" alt="Hot Topic Image"
                            class="img-fluid w-100 hot-topic-img">
                        <div class="hot-topic-overlay p-4 text-white">
                            <h4 class="hot-topic-title">{{ \Illuminate\Support\Str::limit($hotTopic->judul) }}</h4>
                            <small class="hot-topic-meta">{{ \Carbon\Carbon::parse($hotTopic->tanggal)->format('d M Y') }} •
                                {{ $hotTopic->sumber ?? 'Air Terjun Lubuk Hitam' }}</small>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column justify-content-center">
                <p class="hot-topic-desc text-secondary fs-5">
                    <strong>{{ \Illuminate\Support\Str::words(strip_tags($hotTopic->deskripsi), 40, '...') }}</strong>
                </p>
                <a href="{{ route('berita.detail', $hotTopic->id) }}" class="btn-read-more mt-center">read more
                    <span class="btn-arrow">→</span>
                </a>
            </div>
        </div>

        <!-- LATEST NEWS -->
        <h3 class="section-title mb-4">Latest News</h3>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
            @foreach ($beritas as $berita)
                <div class="col">
                    <div class="card border-0 h-100 shadow-sm hover-shadow rounded-3">
                        <a href="{{ route('berita.detail', $berita->id) }}" class="d-block overflow-hidden rounded-top">
                            <img src="{{ asset('storage/' . $berita->foto) }}" alt="News Image"
                                class="card-img-top news-img">
                        </a>
                        <div class="card-body px-0">
                            <a href="{{ route('berita.detail', $berita->id) }}" class="text-decoration-none text-dark">
                                <h6 class="card-title fw-bold news-title">
                                    {{ \Illuminate\Support\Str::limit($berita->judul, 60) }}</h6>
                            </a>
                            <small class="text-muted news-meta">
                                {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }} &nbsp; • &nbsp;
                                {{ $berita->sumber ?? 'Air Terjun Lubuk Hitam' }}
                            </small>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    @include('layouts.footer')


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
            padding-left: 350px;
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
