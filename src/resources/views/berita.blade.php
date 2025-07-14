@extends('layouts.app')

@section('content')
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">DAFTAR<br>BERITA</div>
            <div class="hero-desc">Ikuti perkembangan, cerita, dan fakta terbaru dari Lubuk Hitam.</div>
            <a href="#beritas-grid" class="hero-btn">Lihat Berita</a>
        </div>
    </section>


    <div id="beritas-grid" class="beritas-container">
        <div class="container py-5">
            <!-- HOT TOPICS -->
            <h2 class="section-title mb-4" data-aos="fade-up">
                Sedang Tren
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
                            <span class="btn-text">Baca Selengkapnya</span>
                            <span class="btn-arrow">→</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- LATEST NEWS -->
            <div class="latest-news-section">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 class="section-title mb-0" data-aos="fade-up">
                        </i>Kilas Berita
                    </h3>
                </div>


                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4" id="latest-news-grid">
                    @foreach ($beritas as $index => $berita)
                        <div class="col news-item" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}"
                            data-category="recent">
                            <div>
                                <div class="news-image-container">
                                    <a href="{{ route('berita.detail', $berita->id) }}" class="d-block overflow-hidden">
                                        <img src="{{ asset('storage/' . $berita->foto) }}" alt="News Image"
                                            class="card-img-top news-img">
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('berita.detail', $berita->id) }}"
                                        class="text-decoration-none text-dark">
                                        <h6 class="card-title fw-bold news-title">
                                            {{ \Illuminate\Support\Str::limit($berita->judul, 60) }}
                                        </h6>
                                    </a>
                                    <p class="news-excerpt">
                                        {{ \Illuminate\Support\Str::limit(strip_tags($berita->deskripsi), 80) }}
                                    </p>
                                    <div class="news-footer">
                                        <small class="text-muted news-meta">
                                            <i class="fas fa-calendar-alt me-1"></i>
                                            {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
                                            <span class="mx-2">•</span>
                                            <i class="fas fa-map-marker-alt me-1"></i>
                                            {{ $berita->sumber ?? 'Air Terjun Lubuk Hitam' }}
                                        </small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
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

            body {
                font-family: 'Poppins', sans-serif;
                background-color: #f8f9fa;
            }

            /* === 1. HERO SECTION === */
            .hero-section {
                position: relative;
                background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)),
                    url('/images/hero.jpg') no-repeat center center/cover;
                height: 95vh;
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
                font-weight: 900;
                line-height: 1.1;
                margin-bottom: 20px;
                letter-spacing: 30px;
                text-transform: uppercase;
                text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
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
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
            }

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
                background: linear-gradient(135deg, #28a745, #20c997);
                border-radius: 2px;
            }

            .news-icon {
                background: linear-gradient(135deg, #0a1f0f 0%, #1a3d2e 30%, #2d5a3d 70%, #228B22 100%);
                -webkit-background-clip: text;
                -webkit-text-fill-color: transparent;
                background-clip: text;
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

                0%,
                100% {
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


            /* LATEST NEWS STYLES */
            .latest-news-section {
                margin-top: 4rem;
            }



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
                background: linear-gradient(135deg, rgba(20, 68, 4, 0.03), rgba(51, 192, 95, 0.03));
                opacity: 0;
                transition: opacity 0.3s ease;
                z-index: 1;
                border-radius: 1.5rem;
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
                color: #04221e;
            }

            .news-excerpt {
                font-size: 0.95rem;
                color: #6c757d;
                line-height: 1.6;
                margin-bottom: 1.5rem;
            }

            .news-footer {
                display: flex;
                justify-content: space-between;
                align-items: center;
                margin-top: auto;
            }

            .news-meta {
                font-size: 0.9rem;
                color: #6c757d;
                display: flex;
                align-items: center;
                gap: 0.25rem;
            }

            .news-meta i {
                color: #1e671e;
            }

            .news-actions {
                display: flex;
                gap: 0.5rem;
            }

            .action-btn {
                width: 35px;
                height: 35px;
                border: none;
                background: #f8f9fa;
                color: #6c757d;
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                transition: all 0.3s ease;
                cursor: pointer;
            }

            .action-btn:hover {
                background: #278049;
                color: white;
                transform: scale(1.1);
            }

            /* BUTTONS */
            .btn-read-more {
                display: inline-flex;
                align-items: center;
                justify-content: center;
                padding: 15px 35px;
                background: linear-gradient(135deg, #006400, #228B22);
                color: #fff;
                font-weight: 700;
                font-size: 1.1rem;
                border: none;
                border-radius: 50px;
                text-decoration: none;
                transition: all 0.4s ease;
                box-shadow: 0 10px 30px rgba(66, 255, 154, 0.3);
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
                background: linear-gradient(135deg, #006400, #228B22);
                transition: left 0.4s ease;
                z-index: -1;
            }

            .btn-read-more:hover::before {
                left: 0;
            }

            .btn-read-more:hover {
                transform: translateY(-3px);
                box-shadow: 0 15px 40px rgba(28, 83, 76, 0.4);
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


            /* ANIMATIONS */
            .ripple {
                position: absolute;
                border-radius: 50%;
                background: rgba(66, 255, 154, 0.3);
                transform: scale(0);
                animation: rippleEffect 0.6s linear;
                pointer-events: none;
                z-index: 1000;
            }

            @keyframes rippleEffect {
                to {
                    transform: scale(4);
                    opacity: 0;
                }
            }

            .news-card.loading {
                opacity: 0.7;
                pointer-events: none;
            }

            .news-card.loading::after {
                content: '';
                position: absolute;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.4), transparent);
                animation: shimmer 1.5s infinite;
                z-index: 10;
            }

            @keyframes shimmer {
                0% {
                    transform: translateX(-100%);
                }

                100% {
                    transform: translateX(100%);
                }
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

                .hot-topic-stats {
                    gap: 1rem;
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

            }

            /* For large tablets and smaller laptops */
            @media (max-width: 1200px) {
                .hero-content {
                    /* Start reducing the large padding earlier */
                    padding: 0 3rem 0 10rem;
                }
            }

            /* For tablets */
            @media (max-width: 992px) {
                .hero-section {
                    justify-content: center;
                    /* Center the content block */
                    text-align: center;
                    /* Center the text inside the block */
                    height: 75vh;
                }

                .hero-content {
                    /* Remove fixed padding, use responsive padding */
                    padding: 0 2rem;
                }

                .hero-title {
                    font-size: 60px;
                    letter-spacing: 15px;
                }

                .hero-desc {
                    /* Allow description to center properly */
                    margin-left: auto;
                    margin-right: auto;
                }
            }

            /* For small tablets and large phones */
            @media (max-width: 768px) {
                .hero-section {
                    height: 70vh;
                }

                .hero-title {
                    font-size: 48px;
                    letter-spacing: 10px;
                    line-height: 1.2;
                }

                .hero-desc {
                    font-size: 15px;
                }

                .hero-btn {
                    padding: 10px 25px;
                    font-size: 13px;
                }
            }

            /* For mobile phones */
            @media (max-width: 576px) {
                .hero-section {
                    height: 65vh;
                    /* Reduce height for small screens */
                }

                .hero-content {
                    padding: 0 1rem;
                }

                .hero-title {
                    font-size: 36px;
                    letter-spacing: 5px;
                }
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

                // HOT TOPIC INTERACTIONS
                const hotTopicWrapper = document.querySelector('.hot-topic-img-wrapper');

                if (hotTopicWrapper) {
                    hotTopicWrapper.addEventListener('mouseenter', function() {
                        this.style.transform = 'scale(1.02) translateY(-5px)';
                        this.style.boxShadow = '0 25px 60px rgba(0, 0, 0, 0.2)';
                    });

                    hotTopicWrapper.addEventListener('mouseleave', function() {
                        this.style.transform = 'scale(1) translateY(0)';
                        this.style.boxShadow = '0 10px 30px rgba(0, 0, 0, 0.1)';
                    });

                    hotTopicWrapper.addEventListener('click', function(e) {
                        if (e.target.tagName !== 'A') {
                            const ripple = document.createElement('span');
                            const rect = this.getBoundingClientRect();
                            const size = Math.max(rect.width, rect.height);
                            const x = e.clientX - rect.left - size / 2;
                            const y = e.clientY - rect.top - size / 2;

                            ripple.className = 'ripple';
                            ripple.style.width = size + 'px';
                            ripple.style.height = size + 'px';
                            ripple.style.left = x + 'px';
                            ripple.style.top = y + 'px';

                            this.appendChild(ripple);

                            setTimeout(() => {
                                ripple.remove();
                            }, 600);
                        }
                    });
                }

                // LATEST NEWS INTERACTIONS
                const newsCards = document.querySelectorAll('.news-card');

                newsCards.forEach((card, index) => {
                    // Enhanced hover effects
                    card.addEventListener('mouseenter', function() {
                        this.style.transform = 'translateY(-12px) scale(1.02)';
                        this.style.boxShadow = '0 25px 50px rgba(0, 0, 0, 0.15)';
                    });

                    card.addEventListener('mouseleave', function() {
                        this.style.transform = 'translateY(0) scale(1)';
                        this.style.boxShadow = '0 5px 20px rgba(0, 0, 0, 0.08)';
                    });

                    // Add ripple effect
                    card.addEventListener('click', function(e) {
                        if (!e.target.closest('a') && !e.target.closest('.action-btn')) {
                            const ripple = document.createElement('span');
                            const rect = this.getBoundingClientRect();
                            const size = Math.max(rect.width, rect.height);
                            const x = e.clientX - rect.left - size / 2;
                            const y = e.clientY - rect.top - size / 2;

                            ripple.className = 'ripple';
                            ripple.style.width = size + 'px';
                            ripple.style.height = size + 'px';
                            ripple.style.left = x + 'px';
                            ripple.style.top = y + 'px';

                            this.appendChild(ripple);

                            setTimeout(() => {
                                ripple.remove();
                            }, 600);
                        }
                    });

                    // Staggered loading animation
                    card.classList.add('loading');
                    setTimeout(() => {
                        card.classList.remove('loading');
                    }, 200 * index);
                });




                // SCROLL ANIMATIONS
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

                // Apply scroll animations
                newsCards.forEach(card => {
                    card.style.opacity = '0';
                    card.style.transform = 'translateY(30px)';
                    card.style.transition = 'all 0.6s ease';
                    scrollObserver.observe(card);
                });

                // KEYBOARD NAVIGATION
                document.addEventListener('keydown', function(e) {
                    if (e.key === 'ArrowRight' || e.key === 'ArrowLeft') {
                        const focusedCard = document.activeElement.closest('.news-card');
                        if (focusedCard) {
                            const allCards = Array.from(newsCards);
                            const currentIndex = allCards.indexOf(focusedCard);
                            let nextIndex;

                            if (e.key === 'ArrowRight') {
                                nextIndex = (currentIndex + 1) % allCards.length;
                            } else {
                                nextIndex = (currentIndex - 1 + allCards.length) % allCards.length;
                            }

                            allCards[nextIndex].focus();
                            e.preventDefault();
                        }
                    }
                });

                // Add focus styles for accessibility
                newsCards.forEach(card => {
                    card.setAttribute('tabindex', '0');
                    card.addEventListener('focus', function() {
                        this.style.outline = '3px solid #667eea';
                        this.style.outlineOffset = '2px';
                    });

                    card.addEventListener('blur', function() {
                        this.style.outline = 'none';
                    });
                });

                // Hot topic focus
                if (hotTopicWrapper) {
                    hotTopicWrapper.setAttribute('tabindex', '0');
                    hotTopicWrapper.addEventListener('focus', function() {
                        this.style.outline = '3px solid #ff6b6b';
                        this.style.outlineOffset = '2px';
                    });

                    hotTopicWrapper.addEventListener('blur', function() {
                        this.style.outline = 'none';
                    });
                }

                // PERFORMANCE OPTIMIZATIONS
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

                // IMAGE LAZY LOADING
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
                    });
                });

                // TOAST NOTIFICATION FUNCTION
                function showToast(message) {
                    const toast = document.createElement('div');
                    toast.className = 'toast-notification';
                    toast.textContent = message;
                    toast.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    background: linear-gradient(135deg, #667eea, #764ba2);
                    color: white;
                    padding: 12px 24px;
                    border-radius: 25px;
                    font-weight: 600;
                    z-index: 10000;
                    animation: slideInRight 0.3s ease;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
                `;

                    document.body.appendChild(toast);

                    setTimeout(() => {
                        toast.style.animation = 'slideOutRight 0.3s ease';
                        setTimeout(() => toast.remove(), 300);
                    }, 3000);
                }

                // ADD ANIMATION KEYFRAMES
                const animationStyles = document.createElement('style');
                animationStyles.textContent = `
                @keyframes fadeInUp {
                    from {
                        opacity: 0;
                        transform: translateY(30px);
                    }
                    to {
                        opacity: 1;
                        transform: translateY(0);
                    }
                }
                
                @keyframes heartBeat {
                    0% { transform: scale(1); }
                    14% { transform: scale(1.3); }
                    28% { transform: scale(1); }
                    42% { transform: scale(1.3); }
                    70% { transform: scale(1); }
                }
                
                @keyframes pulse {
                    0% { transform: scale(1); }
                    50% { transform: scale(1.1); }
                    100% { transform: scale(1); }
                }
                
                @keyframes slideInRight {
                    from { transform: translateX(100%); }
                    to { transform: translateX(0); }
                }
                
                @keyframes slideOutRight {
                    from { transform: translateX(0); }
                    to { transform: translateX(100%); }
                }
            `;
                document.head.appendChild(animationStyles);

                console.log('News page interactions initialized successfully!');
            });
        </script>
    @endsection
