@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">RECAP<br>NEWS</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="#beritas-grid" class="hero-btn">Baca Selengkapnya</a>
        </div>
    </section>

    <div class="container py-5">
        <!-- HOT TOPICS -->
        <h2 class="section-title mb-4" data-aos="fade-up">
            Hot Topics
        </h2>
        <div class="row g-4 mb-5 align-items-stretch">
            <div class="col-lg-8" data-aos="fade-right">
                <div class="position-relative hot-topic-img-wrapper rounded-4 overflow-hidden shadow-sm">
                    <a href="{{ route('berita.detail', $hotTopic->id) }}" class="d-block h-100">
                        <img src="{{ asset('storage/' . $hotTopic->foto) }}" alt="Hot Topic Image"
                            class="img-fluid w-100 hot-topic-img">
                        <div class="hot-topic-overlay p-4 text-white">
                            <h4 class="hot-topic-title">{{ \Illuminate\Support\Str::limit($hotTopic->judul, 80) }}</h4>
                            <small class="hot-topic-meta">
                                <i class="fas fa-calendar-alt me-2"></i>
                                {{ \Carbon\Carbon::parse($hotTopic->tanggal)->format('d M Y') }} 
                                <span class="mx-2">•</span>
                                <i class="fas fa-map-marker-alt me-1"></i>
                                {{ $hotTopic->sumber ?? 'Air Terjun Lubuk Hitam' }}
                            </small>
                        </div>
                        <div class="hot-topic-gradient"></div>
                    </a>
                </div>
            </div>
            <div class="col-lg-4 d-flex flex-column justify-content-center" data-aos="fade-left">
                <div class="hot-topic-content">
                    <p class="hot-topic-desc text-secondary fs-5">
                        <strong>{{ \Illuminate\Support\Str::words(strip_tags($hotTopic->deskripsi), 40, '...') }}</strong>
                    </p>
                    <a href="{{ route('berita.detail', $hotTopic->id) }}" class="btn-read-more">
                        <span class="btn-text">Read Full Story</span>
                        <span class="btn-arrow">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- LATEST NEWS -->
        <div class="latest-news-section">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3 class="section-title mb-0" data-aos="fade-up">
                   Latest News
                </h3>
                <div class="news-navigation" data-aos="fade-left">
                    <button class="nav-arrow nav-prev" id="prevBtn" title="Previous news">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <span class="news-counter">
                        <span id="currentPage">1</span> / <span id="totalPages">{{ ceil(count($beritas) / 4) }}</span>
                    </span>
                    <button class="nav-arrow nav-next" id="nextBtn" title="Next news">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
            
            <div class="news-carousel-container" id="newsCarouselContainer">
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="latest-news-grid">
                    @foreach ($beritas as $index => $berita)
                        <div class="col news-item {{ $index >= 4 ? 'hidden' : '' }}" data-aos="fade-up" data-aos-delay="{{ ($index % 4) * 100 }}" data-index="{{ $index }}">
                            <div class="card border-0 h-100 shadow-sm news-card">
                                <div class="news-image-container">
                                    <a href="{{ route('berita.detail', $berita->id) }}" class="d-block overflow-hidden">
                                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="News Image"
                                            class="card-img-top news-img">
                                        <div class="news-overlay">
                                            <i class="fas fa-eye view-icon"></i>
                                            <span class="view-text">Read More</span>
                                        </div>
                                    </a>
                                    <div class="news-category-badge">News</div>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('berita.detail', $berita->id) }}" class="text-decoration-none text-dark">
                                        <h6 class="card-title fw-bold news-title">
                                            {{ \Illuminate\Support\Str::limit($berita->judul, 60) }}
                                        </h6>
                                    </a>
                                    <p class="news-excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->deskripsi), 80) }}
                                    </p>
<div class="news-footer">
    <div class="news-meta">
        <div class="date-info">
            <i class="fas fa-calendar-alt"></i>
            <span>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
        </div>
        <div class="location-info">
            <i class="fas fa-map-marker-alt"></i>
            <span>{{ $berita->sumber ?? 'Air Terjun Lubuk Hitam' }}</span>
        </div>
    </div>
</div>


                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')

    <!-- AOS Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <style>
        /* Enhanced Fonts */
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap');

        /* Section Titles */
        .section-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            color: #2c3e50;
            position: relative;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .section-title::after {
            content: '';
            flex: 1;
            height: 3px;
            background: linear-gradient(135deg, #b3596d, #293069);
            border-radius: 2px;
        }

        .hot-icon, .news-icon {
            font-size: 2rem;
            background: linear-gradient(135deg, #ff6b6b, #ff8e53);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .news-icon {
            background: linear-gradient(135deg, #667eea, #764ba2);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* NEWS NAVIGATION ARROWS */
        .news-navigation {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .nav-arrow {
            width: 45px;
            height: 45px;
            border: 2px solid #667eea;
            background: transparent;
            color: #667eea;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .nav-arrow::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea, #764ba2);
            transition: left 0.3s ease;
            z-index: -1;
        }

        .nav-arrow:hover {
            color: white;
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        .nav-arrow:hover::before {
            left: 0;
        }

        .nav-arrow:active {
            transform: scale(0.95);
        }

        .nav-arrow:disabled {
            opacity: 0.4;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }

        .nav-arrow:disabled:hover {
            color: #667eea;
            background: transparent;
        }

        .nav-arrow:disabled:hover::before {
            left: -100%;
        }

        .nav-arrow i {
            font-size: 1.2rem;
            transition: transform 0.3s ease;
        }

        .nav-arrow:hover i {
            transform: translateX(2px);
        }

        .nav-prev:hover i {
            transform: translateX(-2px);
        }

        .news-counter {
            font-weight: 600;
            color: #495057;
            font-size: 1rem;
            min-width: 60px;
            text-align: center;
            padding: 8px 16px;
            background: #f8f9fa;
            border-radius: 20px;
            border: 1px solid #e9ecef;
        }

        /* NEWS CAROUSEL */
        .news-carousel-container {
            position: relative;
            overflow: hidden;
        }

        .news-item {
            transition: all 0.5s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .news-item.hidden {
            display: none;
        }

        .news-item.slide-out-left {
            opacity: 0;
            transform: translateX(-100%);
        }

        .news-item.slide-out-right {
            opacity: 0;
            transform: translateX(100%);
        }

        .news-item.slide-in-left {
            opacity: 1;
            transform: translateX(0);
            animation: slideInLeft 0.5s ease;
        }

        .news-item.slide-in-right {
            opacity: 1;
            transform: translateX(0);
            animation: slideInRight 0.5s ease;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100%);
            }
            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* HOT TOPIC STYLES */
        .hot-topic-img-wrapper {
            height: 500px;
            position: relative;
            cursor: pointer;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            overflow: hidden;
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .hot-topic-img-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, rgba(255, 107, 107, 0.1), rgba(102, 126, 234, 0.1));
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 2;
            border-radius: 1.5rem;
        }

        .hot-topic-img-wrapper:hover::before {
            opacity: 1;
        }

        .hot-topic-img-wrapper:hover {
            transform: scale(1.02) translateY(-5px);
            box-shadow: 0 25px 60px rgba(0, 0, 0, 0.2);
        }

        .hot-topic-img {
            height: 100%;
            width: 100%;
            object-fit: cover;
            border-radius: 1.5rem;
            transition: transform 0.5s ease;
        }

        .hot-topic-img-wrapper:hover .hot-topic-img {
            transform: scale(1.05);
        }

        .hot-topic-gradient {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.3), transparent 50%, rgba(0, 0, 0, 0.7));
            z-index: 1;
            border-radius: 1.5rem;
        }

        @keyframes hotPulse {
            0%, 100% { 
                transform: scale(1); 
                box-shadow: 0 8px 25px rgba(255, 107, 107, 0.4); 
            }
            50% { 
                transform: scale(1.05); 
                box-shadow: 0 12px 35px rgba(255, 107, 107, 0.6); 
            }
        }

        .hot-topic-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            padding: 2.5rem;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.9), rgba(0, 0, 0, 0.3), transparent);
            z-index: 3;
            transition: all 0.4s ease;
            border-radius: 0 0 1.5rem 1.5rem;
        }

        .hot-topic-title {
            font-size: 2.3rem;
            font-weight: 800;
            margin-bottom: 1rem;
            color: #fff;
            text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
            line-height: 1.2;
            transition: all 0.3s ease;
        }

        .hot-topic-img-wrapper:hover .hot-topic-title {
            transform: translateY(-8px);
            text-shadow: 3px 3px 12px rgba(0, 0, 0, 0.8);
        }

        .hot-topic-meta {
            font-size: 1.1rem;
            color: #e0e0e0;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .hot-topic-img-wrapper:hover .hot-topic-meta {
            color: #fff;
            transform: translateY(-5px);
        }

        .hot-topic-content {
            padding: 2rem;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .hot-topic-desc {
            font-size: 1.2rem;
            line-height: 1.7;
            color: #495057;
            margin-bottom: 1.5rem;
        }

        .hot-topic-stats {
            display: flex;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .stat-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #6c757d;
            font-weight: 600;
        }

        .stat-item i {
            color: #667eea;
            font-size: 1.1rem;
        }

        .stat-number {
            font-weight: 700;
            color: #495057;
        }

        /* NEWS CARD STYLES */
        .news-card {
            border-radius: 1.5rem;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            height: 100%;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
            background: #fff;
            border: 1px solid rgba(0, 0, 0, 0.05);
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .news-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.03), rgba(220, 53, 69, 0.03));
            opacity: 0;
            transition: opacity 0.3s ease;
            z-index: 1;
            border-radius: 1.5rem;
        }

        .news-card:hover::before {
            opacity: 1;
        }

        .news-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.15);
            border-color: rgba(102, 126, 234, 0.2);
        }

        .news-image-container {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem 1.5rem 0 0;
        }

        .news-img {
            height: 250px;
            width: 100%;
            object-fit: cover;
            transition: all 0.5s ease;
        }

        .news-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.8);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: all 0.4s ease;
            gap: 0.5rem;
        }

        .news-card:hover .news-overlay {
            opacity: 1;
        }

        .view-icon {
            color: white;
            font-size: 3rem;
            transform: scale(0.7);
            transition: transform 0.3s ease;
        }

        .view-text {
            color: white;
            font-weight: 600;
            font-size: 1.1rem;
            transform: translateY(10px);
            transition: transform 0.3s ease;
        }

        .news-card:hover .view-icon {
            transform: scale(1);
        }

        .news-card:hover .view-text {
            transform: translateY(0);
        }

        .news-card:hover .news-img {
            transform: scale(1.1);
        }

        .news-category-badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            padding: 5px 12px;
            border-radius: 15px;
            font-size: 0.8rem;
            font-weight: 600;
            z-index: 2;
        }

        .card-body {
            padding: 1.8rem;
            display: flex;
            flex-direction: column;
            flex-grow: 1;
            position: relative;
            z-index: 2;
        }

        .news-title {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #2c3e50;
            flex-grow: 1;
            transition: color 0.3s ease;
            line-height: 1.4;
        }

        .news-card:hover .news-title {
            color: #667eea;
        }

        .news-excerpt {
            font-size: 0.95rem;
            color: #6c757d;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }
.news-footer {
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid #f0f0f0;
}

.news-meta {
    font-size: 0.85rem;
    color: #6c757d;
    display: flex;
    flex-direction: column;
    gap: 0.5rem;
}

.date-info, .location-info {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.25rem 0;
}

.date-info i, .location-info i {
    width: 16px;
    height: 16px;
    display: flex;
    align-items: center;
    justify-content: center;
    background: linear-gradient(135deg, #667eea, #764ba2);
    color: white;
    border-radius: 50%;
    font-size: 0.7rem;
    flex-shrink: 0;
}

.date-info span, .location-info span {
    font-weight: 500;
    color: #495057;
}

.date-info {
    color: #667eea;
}

.location-info {
    color: #28a745;
}


        /* BUTTONS */
        .btn-read-more {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 15px 35px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: #fff;
            font-weight: 700;
            font-size: 1.1rem;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.4s ease;
            box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
            gap: 1rem;
            position: relative;
            overflow: hidden;
        }

        .btn-read-more::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #764ba2, #667eea);
            transition: left 0.4s ease;
            z-index: -1;
        }

        .btn-read-more:hover::before {
            left: 0;
        }

        .btn-read-more:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 40px rgba(102, 126, 234, 0.4);
            color: white;
        }

        .btn-arrow {
            transition: transform 0.3s ease;
            font-weight: bold;
            font-size: 1.3rem;
        }

        .btn-read-more:hover .btn-arrow {
            transform: translateX(8px);
        }

        .btn-load-more {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 30px;
            background: transparent;
            border: 2px solid #667eea;
            color: #667eea;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            gap: 0.5rem;
            cursor: pointer;
        }

        .btn-load-more:hover {
            background: #667eea;
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }

        /* RESPONSIVE DESIGN */
        @media (max-width: 992px) {
            .section-title {
                font-size: 2rem;
            }
            
            .hot-topic-img-wrapper {
                height: 400px;
            }
            
            .hot-topic-title {
                font-size: 1.8rem;
            }
            
            .news-img {
                height: 200px;
            }

            .nav-arrow {
                width: 40px;
                height: 40px;
            }
        }

        @media (max-width: 768px) {
            .section-title {
                font-size: 1.8rem;
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }
            
            .section-title::after {
                width: 100px;
                margin: 0 auto;
            }
            
            .hot-topic-img-wrapper {
                height: 300px;
            }
            
            .hot-topic-title {
                font-size: 1.5rem;
            }
            
            .hot-topic-overlay {
                padding: 1.5rem;
            }
            
            .hot-topic-content {
                padding: 1.5rem;
                margin-top: 2rem;
            }
            
            .news-navigation {
                gap: 0.5rem;
            }

            .nav-arrow {
                width: 35px;
                height: 35px;
            }

            .news-counter {
                font-size: 0.9rem;
                padding: 6px 12px;
            }
        }

        @media (max-width: 576px) {
            .section-title {
                font-size: 1.5rem;
            }
            
            .hot-topic-img-wrapper {
                height: 250px;
            }
            
            .hot-topic-title {
                font-size: 1.3rem;
            }
            
            .news-img {
                height: 180px;
            }
            
            .card-body {
                padding: 1.2rem;
            }
            
            .news-title {
                font-size: 1.1rem;
            }

            .news-navigation {
                flex-direction: column;
                gap: 0.5rem;
            }
        }

        /* Hero Section Styles */
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
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: 30px;
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

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 10000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .loading-overlay.active {
            opacity: 1;
            visibility: visible;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid #f3f3f3;
            border-top: 4px solid #667eea;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true,
                offset: 100
            });

            // News Navigation Variables
            const prevBtn = document.getElementById('prevBtn');
            const nextBtn = document.getElementById('nextBtn');
            const currentPageSpan = document.getElementById('currentPage');
            const totalPagesSpan = document.getElementById('totalPages');
            const newsItems = document.querySelectorAll('.news-item');
            const itemsPerPage = 4;
            let currentPage = 1;
            const totalPages = Math.ceil(newsItems.length / itemsPerPage);

            // Update total pages display
            totalPagesSpan.textContent = totalPages;

            // Show loading overlay
            function showLoading() {
                const loadingOverlay = document.createElement('div');
                loadingOverlay.className = 'loading-overlay active';
                loadingOverlay.innerHTML = '<div class="loading-spinner"></div>';
                document.body.appendChild(loadingOverlay);
                
                setTimeout(() => {
                    loadingOverlay.remove();
                }, 800);
            }

            // Update news display
            function updateNewsDisplay(direction = 'next') {
                // Add loading effect
                showLoading();
                
                // Hide current items with animation
                const currentItems = Array.from(newsItems).slice(
                    (currentPage - 1) * itemsPerPage,
                    currentPage * itemsPerPage
                );

                currentItems.forEach((item, index) => {
                    setTimeout(() => {
                        item.classList.add(direction === 'next' ? 'slide-out-left' : 'slide-out-right');
                        setTimeout(() => {
                            item.classList.add('hidden');
                            item.classList.remove('slide-out-left', 'slide-out-right');
                        }, 300);
                    }, index * 50);
                });

                // Show new items after delay
                setTimeout(() => {
                    const newItems = Array.from(newsItems).slice(
                        (currentPage - 1) * itemsPerPage,
                        currentPage * itemsPerPage
                    );

                    newItems.forEach((item, index) => {
                        setTimeout(() => {
                            item.classList.remove('hidden');
                            item.classList.add(direction === 'next' ? 'slide-in-right' : 'slide-in-left');
                            
                            setTimeout(() => {
                                item.classList.remove('slide-in-left', 'slide-in-right');
                            }, 500);
                        }, index * 100);
                    });

                    // Update page counter
                    currentPageSpan.textContent = currentPage;
                    
                    // Update button states
                    updateButtonStates();
                    
                    // Show success feedback
                    showNavigationFeedback(direction, currentPage);
                }, 400);
            }

            // Update button states
            function updateButtonStates() {
                prevBtn.disabled = currentPage === 1;
                nextBtn.disabled = currentPage === totalPages;
                
                // Update cursor styles
                prevBtn.style.cursor = currentPage === 1 ? 'not-allowed' : 'pointer';
                nextBtn.style.cursor = currentPage === totalPages ? 'not-allowed' : 'pointer';
            }

            // Navigation event listeners
            prevBtn.addEventListener('click', function() {
                if (currentPage > 1) {
                    currentPage--;
                    updateNewsDisplay('prev');
                } else {
                    // Shake animation for disabled state
                    this.style.animation = 'shake 0.5s ease';
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 500);
                }
            });

            nextBtn.addEventListener('click', function() {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateNewsDisplay('next');
                } else {
                    // Shake animation for disabled state
                    this.style.animation = 'shake 0.5s ease';
                    setTimeout(() => {
                        this.style.animation = '';
                    }, 500);
                }
            });

            // Initialize display
            function initializeDisplay() {
                // Hide all items except first page
                newsItems.forEach((item, index) => {
                    if (index >= itemsPerPage) {
                        item.classList.add('hidden');
                    }
                });
                updateButtonStates();
            }

            // Keyboard navigation
            document.addEventListener('keydown', function(e) {
                if (e.key === 'ArrowLeft' && currentPage > 1) {
                    prevBtn.click();
                } else if (e.key === 'ArrowRight' && currentPage < totalPages) {
                    nextBtn.click();
                }
            });

            // Touch/swipe support for mobile
            let startX = 0;
            let endX = 0;

            const newsGrid = document.getElementById('latest-news-grid');
            
            newsGrid.addEventListener('touchstart', function(e) {
                startX = e.touches[0].clientX;
            });

            newsGrid.addEventListener('touchend', function(e) {
                endX = e.changedTouches[0].clientX;
                handleSwipe();
            });

            function handleSwipe() {
                const swipeThreshold = 50;
                const diff = startX - endX;

                if (Math.abs(diff) > swipeThreshold) {
                    if (diff > 0 && currentPage < totalPages) {
                        // Swipe left - next page
                        nextBtn.click();
                    } else if (diff < 0 && currentPage > 1) {
                        // Swipe right - previous page
                        prevBtn.click();
                    }
                }
            }

            // Enhanced hover effects for navigation arrows
            [prevBtn, nextBtn].forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    if (!this.disabled) {
                        this.style.transform = 'scale(1.1) rotate(5deg)';
                    }
                });

                btn.addEventListener('mouseleave', function() {
                    if (!this.disabled) {
                        this.style.transform = 'scale(1) rotate(0deg)';
                    }
                });
            });

            // News card interactions
            const newsCards = document.querySelectorAll('.news-card');
            
            newsCards.forEach((card, index) => {
                // Enhanced hover effects
                card.addEventListener('mouseenter', function() {
                    this.style.cursor = 'pointer';
                    this.style.transform = 'translateY(-12px) scale(1.02)';
                    this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.15)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.08)';
                });

                // Click ripple effect
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('a')) {
                        createRipple(e, this);
                    }
                });
            });

            // Hot topic interactions
            const hotTopicWrapper = document.querySelector('.hot-topic-img-wrapper');
            
            if (hotTopicWrapper) {
                hotTopicWrapper.addEventListener('mouseenter', function() {
                    this.style.cursor = 'pointer';
                });

                hotTopicWrapper.addEventListener('click', function(e) {
                    if (!e.target.closest('a')) {
                        createRipple(e, this);
                    }
                });
            }

            // Load More Button functionality
            const loadMoreBtn = document.getElementById('loadMoreBtn');
            let loadedPages = 1;
            
            if (loadMoreBtn) {
                loadMoreBtn.addEventListener('click', function() {
                    const loadText = this.querySelector('.load-text');
                    const loadSpinner = this.querySelector('.load-spinner');
                    
                    loadText.style.display = 'none';
                    loadSpinner.style.display = 'inline-block';
                    this.disabled = true;
                    this.style.cursor = 'wait';
                    
                    // Simulate loading (replace with actual AJAX call)
                    setTimeout(() => {
                        loadedPages++;
                        
                        // Reset button state
                        loadText.style.display = 'inline-block';
                        loadSpinner.style.display = 'none';
                        this.disabled = false;
                        this.style.cursor = 'pointer';
                        
                        // Hide button after 3 loads (example)
                        if (loadedPages >= 3) {
                            this.style.display = 'none';
                            showToast('All news loaded! 📰');
                        } else {
                            showToast('New content loaded! ✨');
                        }
                    }, 2000);
                });
            }

            // Utility functions
            function createRipple(e, element) {
                const ripple = document.createElement('span');
                const rect = element.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = e.clientX - rect.left - size / 2;
                const y = e.clientY - rect.top - size / 2;
                
                ripple.className = 'ripple';
                ripple.style.cssText = `
                    position: absolute;
                    border-radius: 50%;
                    background: rgba(102, 126, 234, 0.3);
                    transform: scale(0);
                    animation: rippleEffect 0.6s linear;
                    pointer-events: none;
                    z-index: 1000;
                    width: ${size}px;
                    height: ${size}px;
                    left: ${x}px;
                    top: ${y}px;
                `;
                
                element.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 600);
            }

            function showNavigationFeedback(direction, page) {
                const feedback = document.createElement('div');
                feedback.className = 'navigation-feedback';
                feedback.innerHTML = `
                    <i class="fas fa-arrow-${direction === 'next' ? 'right' : 'left'}"></i>
                    <span>Page ${page} of ${totalPages}</span>
                `;
                feedback.style.cssText = `
                    position: fixed;
                    top: 50%;
                    ${direction === 'next' ? 'right: 20px' : 'left: 20px'};
                    transform: translateY(-50%);
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    color: white;
                    padding: 12px 20px;
                    border-radius: 25px;
                    font-weight: 600;
                    z-index: 10000;
                    display: flex;
                    align-items: center;
                    gap: 8px;
                    animation: slideIn${direction === 'next' ? 'Right' : 'Left'} 0.3s ease;
                    box-shadow: 0 10px 30px rgba(102, 126, 234, 0.3);
                `;
                
                document.body.appendChild(feedback);
                
                setTimeout(() => {
                    feedback.style.animation = `slideOut${direction === 'next' ? 'Right' : 'Left'} 0.3s ease`;
                    setTimeout(() => feedback.remove(), 300);
                }, 2000);
            }

            function showToast(message) {
                const toast = document.createElement('div');
                toast.className = 'toast-notification';
                toast.textContent = message;
                toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #28a745, #20c997);
                    color: white;
                    padding: 12px 24px;
                    border-radius: 25px;
                    font-weight: 600;
                    z-index: 10000;
                    animation: slideInRight 0.3s ease;
                    box-shadow: 0 10px 30px rgba(40, 167, 69, 0.3);
                `;
                
                document.body.appendChild(toast);
                
                setTimeout(() => {
                    toast.style.animation = 'slideOutRight 0.3s ease';
                    setTimeout(() => toast.remove(), 300);
                }, 3000);
            }

            // Add animation keyframes
            const animationStyles = document.createElement('style');
            animationStyles.textContent = `
                @keyframes rippleEffect {
                    to {
                        transform: scale(4);
                        opacity: 0;
                    }
                }
                
                @keyframes shake {
                    0%, 100% { transform: translateX(0); }
                    10%, 30%, 50%, 70%, 90% { transform: translateX(-5px); }
                    20%, 40%, 60%, 80% { transform: translateX(5px); }
                }
                
                @keyframes slideInRight {
                    from { transform: translateX(100%); }
                    to { transform: translateX(0); }
                }
                
                @keyframes slideOutRight {
                    from { transform: translateX(0); }
                    to { transform: translateX(100%); }
                }
                
                @keyframes slideOutLeft {
                    from { transform: translateX(0); }
                    to { transform: translateX(-100%); }
                }
            `;
            document.head.appendChild(animationStyles);

            // Initialize the display
            initializeDisplay();

            // Add accessibility features
            newsCards.forEach(card => {
                card.setAttribute('tabindex', '0');
                card.setAttribute('role', 'article');
                card.addEventListener('focus', function() {
                    this.style.outline = '3px solid #667eea';
                    this.style.outlineOffset = '2px';
                });
                
                card.addEventListener('blur', function() {
                    this.style.outline = 'none';
                });

                card.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        const link = this.querySelector('a');
                        if (link) {
                            link.click();
                        }
                    }
                });
            });

            // Add ARIA labels for navigation
            prevBtn.setAttribute('aria-label', 'Previous page of news');
            nextBtn.setAttribute('aria-label', 'Next page of news');
            
            // Add focus styles for navigation buttons
            [prevBtn, nextBtn].forEach(btn => {
                btn.addEventListener('focus', function() {
                    this.style.outline = '3px solid #667eea';
                    this.style.outlineOffset = '2px';
                });
                
                btn.addEventListener('blur', function() {
                    this.style.outline = 'none';
                });
            });

            // Hot topic accessibility
            if (hotTopicWrapper) {
                hotTopicWrapper.setAttribute('tabindex', '0');
                hotTopicWrapper.setAttribute('role', 'article');
                hotTopicWrapper.addEventListener('focus', function() {
                    this.style.outline = '3px solid #ff6b6b';
                    this.style.outlineOffset = '2px';
                });
                
                hotTopicWrapper.addEventListener('blur', function() {
                    this.style.outline = 'none';
                });

                hotTopicWrapper.addEventListener('keydown', function(e) {
                    if (e.key === 'Enter' || e.key === ' ') {
                        e.preventDefault();
                        const link = this.querySelector('a');
                        if (link) {
                            link.click();
                        }
                    }
                });
            }

            // Image lazy loading with error handling
            const images = document.querySelectorAll('.news-img, .hot-topic-img');
            const imageObserver = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        img.style.opacity = '1';
                        imageObserver.unobserve(img);
                    }
                });
            });

            images.forEach(img => {
                img.style.opacity = '0';
                img.style.transition = 'opacity 0.3s ease';
                imageObserver.observe(img);
                
                img.addEventListener('load', function() {
                    this.style.opacity = '1';
                });
                
                img.addEventListener('error', function() {
                    this.src = '/images/placeholder-news.jpg';
                    this.alt = 'Image not available';
                    this.style.opacity = '1';
                });
            });

            // Scroll animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const scrollObserver = new IntersectionObserver((entries) => {
                entries.forEach((entry, index) => {
                    if (entry.isIntersecting) {
                        setTimeout(() => {
                            entry.target.style.opacity = '1';
                            entry.target.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            }, observerOptions);

            // Performance optimizations
            let ticking = false;
            
            function updateScrollEffects() {
                // Add any scroll-based effects here
                ticking = false;
            }
            
            window.addEventListener('scroll', function() {
                if (!ticking) {
                    requestAnimationFrame(updateScrollEffects);
                    ticking = true;
                }
            });

            // Add skip link for accessibility
            const skipLink = document.createElement('a');
            skipLink.href = '#latest-news-grid';
            skipLink.textContent = 'Skip to news content';
            skipLink.className = 'skip-link';
            skipLink.style.cssText = `
                position: absolute;
                top: -40px;
                left: 6px;
                background: #667eea;
                color: white;
                padding: 8px;
                text-decoration: none;
                border-radius: 4px;
                z-index: 10000;
                transition: top 0.3s ease;
            `;
            
            skipLink.addEventListener('focus', function() {
                this.style.top = '6px';
            });
            
            skipLink.addEventListener('blur', function() {
                this.style.top = '-40px';
            });
            
            document.body.insertBefore(skipLink, document.body.firstChild);

            // Console log for debugging
            console.log('Enhanced news page with arrow navigation initialized successfully!');
            console.log(`Total news items: ${newsItems.length}`);
            console.log(`Items per page: ${itemsPerPage}`);
            console.log(`Total pages: ${totalPages}`);
        });
    </script>
@endsection

