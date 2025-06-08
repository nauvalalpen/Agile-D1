
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- HOT TOPICS -->
    <h2 class="section-title mb-4">Hot Topics</h2>
    <div class="row g-4 mb-5 align-items-stretch">
        <div class="col-lg-8">
            <div class="position-relative hot-topic-img-wrapper rounded-4 overflow-hidden shadow-sm">
                <a href="{{ route('berita.detail', $hotTopic->id) }}" class="d-block h-100">
                    <img src="{{ asset('storage/' . $hotTopic->foto) }}" alt="Hot Topic Image" class="img-fluid w-100 hot-topic-img">
                    <div class="hot-topic-overlay p-4 text-white">
                        <h4 class="hot-topic-title">{{ \Illuminate\Support\Str::limit($hotTopic->judul) }}</h4>
                        <small class="hot-topic-meta">{{ \Carbon\Carbon::parse($hotTopic->tanggal)->format('d M Y') }} • {{ $hotTopic->sumber ?? 'Air Terjun Lubuk Hitam' }}</small>
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
                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="News Image" class="card-img-top news-img">
                </a>
                <div class="card-body px-0">
                    <a href="{{ route('berita.detail', $berita->id) }}" class="text-decoration-none text-dark">
                        <h6 class="card-title fw-bold news-title">{{ \Illuminate\Support\Str::limit($berita->judul, 60) }}</h6>
                    </a>
                    <small class="text-muted news-meta">
                        {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }} &nbsp; • &nbsp; {{ $berita->sumber ?? 'Air Terjun Lubuk Hitam' }}
                    </small>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>

<style>
    /* Fonts */
    h2.section-title, h3.section-title, h4.hot-topic-title, h6.news-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    p.hot-topic-desc, small, a.read-more-link {
        font-family: 'Poppins', sans-serif;
    }

    /* Hot Topic Image */
    .hot-topic-img-wrapper {
        height: 400px;
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease;
    }
    .hot-topic-img-wrapper:hover {
        transform: scale(1.03);
        box-shadow: 0 15px 30px rgba(0,0,0,0.3);
    }
    .hot-topic-img {
        height: 100%;
        object-fit: cover;
        border-radius: 1rem;
        transition: transform 0.3s ease;
    }

    .hot-topic-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        background: linear-gradient(to top, rgba(0,0,0,0.75), transparent);
        border-bottom-left-radius: 1rem;
        border-bottom-right-radius: 1rem;
    }

    .hot-topic-title {
        font-size: 1.5rem;
        margin-bottom: 0.3rem;
        color: #fff;
    }

    .hot-topic-meta {
        font-size: 0.9rem;
        opacity: 0.85;
    }

    .hot-topic-desc {
        line-height: 1.5;
        font-size: 1.1rem;
        margin-bottom: 1rem;
    }

    .btn-read-more {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        gap: 0.35rem;
        padding: 0.5rem 1.25rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        font-size: 1rem;
        color: #0d6efd;
        border: 2px solid #0d6efd;
        border-radius: 30px;
        background-color: transparent;
        text-decoration: none;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 0 0 rgba(13, 110, 253, 0);
    }

    .btn-read-more:hover,
    .btn-read-more:focus {
        color: #fff;
        background-color: #0d6efd;
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.4);
        text-decoration: none;
    }

    .btn-arrow {
        display: inline-block;
        transition: transform 0.3s ease;
        font-weight: 700;
        font-size: 1.1rem;
    }

    .btn-read-more:hover .btn-arrow {
        transform: translateX(5px);
    }


    /* Latest News Cards */
    .card {
        border-radius: 0.75rem;
        transition: box-shadow 0.3s ease;
    }
    .hover-shadow:hover {
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }

    .news-img {
        height: 180px;
        object-fit: cover;
        border-top-left-radius: 0.75rem;
        border-top-right-radius: 0.75rem;
        transition: transform 0.3s ease;
    }
    .hover-shadow:hover .news-img {
        transform: scale(1.05);
    }

    .card-body {
        padding-left: 0;
        padding-right: 0;
    }

    .news-title {
        font-size: 1rem;
        margin-top: 0.5rem;
        color: #222;
        transition: color 0.3s ease;
    }
    .news-title:hover {
        color: #0d6efd;
    }

    .news-meta {
        font-family: 'Poppins', sans-serif;
        font-size: 0.85rem;
        color: #666;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .hot-topic-img-wrapper {
            height: 250px;
        }

        .news-img {
            height: 150px !important;
        }
    }
</style>
@endsection
