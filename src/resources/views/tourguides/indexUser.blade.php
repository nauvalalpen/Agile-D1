@extends('layouts.app')

@section('content')
    {{-- <!-- Hero Section with Parallax Effect -->
    <section class="hero-section" id="heroSection">
        <div class="hero-overlay"></div>
        <div class="hero-particles"></div>
        <div class="hero-content" data-aos="fade-up" data-aos-duration="1000">
            <div class="hero-badge" data-aos="zoom-in" data-aos-delay="200">
                <i class="fas fa-star"></i>
                <span>Premium Service</span>
            </div>
            <h1 class="hero-title" data-aos="fade-up" data-aos-delay="400">
                PROFESSIONAL<br>
                <span class="gradient-text">TOUR GUIDES</span>
            </h1>
            <p class="hero-description" data-aos="fade-up" data-aos-delay="600">
                Discover hidden gems and create unforgettable memories with our expert local guides
            </p>
            <div class="hero-actions" data-aos="fade-up" data-aos-delay="800">
                <a href="#tourGuides" class="btn-hero-primary">
                    <i class="fas fa-compass"></i>
                    Explore Guides
                </a>
                <a href="#features" class="btn-hero-secondary">
                    <i class="fas fa-play"></i>
                    Watch Video
                </a>
            </div>
            <div class="hero-stats" data-aos="fade-up" data-aos-delay="1000">
                <div class="stat-item">
                    <span class="stat-number">{{ $tourguides->count() }}+</span>
                    <span class="stat-label">Expert Guides</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">500+</span>
                    <span class="stat-label">Happy Clients</span>
                </div>
                <div class="stat-item">
                    <span class="stat-number">50+</span>
                    <span class="stat-label">Destinations</span>
                </div>
            </div>
        </div>
        <div class="scroll-indicator" data-aos="bounce" data-aos-delay="1200">
            <div class="scroll-arrow"></div>
        </div>
    </section> --}}
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">TOUR<br>GUIDES</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="/tourguides" class="hero-btn">More info</a>
        </div>
    </section>

    <!-- Features Section -->
    {{-- <section class="features-section" id="features">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 mb-4" data-aos="fade-right" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Verified Guides</h3>
                        <p>All our guides are professionally verified and certified with extensive local knowledge.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>24/7 Support</h3>
                        <p>Round-the-clock customer support to ensure your tour experience is seamless.</p>
                    </div>
                </div>
                <div class="col-lg-4 mb-4" data-aos="fade-left" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Best Prices</h3>
                        <p>Competitive pricing with no hidden fees. Get the best value for your money.</p>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Main Tour Guides Section -->
    <section class="tour-guides-section" id="tourGuides">
        <div class="container">
            <!-- Section Header -->
            <div class="section-header text-center mb-5" data-aos="fade-up">
                <div class="section-badge">
                    <i class="fas fa-users"></i>
                    <span>Our Team</span>
                </div>
                <h2 class="section-title">Meet Our Expert Tour Guides</h2>
                <p class="section-subtitle">
                    Passionate locals ready to share their knowledge and create amazing experiences for you
                </p>
                <div class="section-divider"></div>
            </div>

            <!-- Filter and Search -->
            <div class="filter-section mb-5" data-aos="fade-up" data-aos-delay="200">
                <div class="row align-items-center">
                    <div class="col-lg-6 mb-3">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchGuides" placeholder="Search guides by name or location...">
                        </div>
                    </div>
                    <div class="col-lg-6 mb-3">
                        <div class="filter-buttons">
                            <button class="filter-btn active" data-filter="all">
                                <i class="fas fa-globe"></i>
                                All Guides
                            </button>
                            <button class="filter-btn" data-filter="premium">
                                <i class="fas fa-crown"></i>
                                Premium
                            </button>
                            <button class="filter-btn" data-filter="available">
                                <i class="fas fa-check-circle"></i>
                                Available
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Status Messages -->
            @if (session('status'))
                <div class="alert alert-success alert-modern" role="alert" data-aos="fade-down">
                    <i class="fas fa-check-circle"></i>
                    {{ session('status') }}
                </div>
            @endif

            <!-- Tour Guides Grid -->
            <div class="guides-grid" id="guidesGrid">
                @forelse ($tourguides as $index => $tourguide)
                    <div class="guide-card" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 200 }}"
                        data-name="{{ strtolower($tourguide->nama) }}" data-location="{{ strtolower($tourguide->alamat) }}"
                        data-price="{{ $tourguide->price_range ?? '500k' }}">

                        <!-- Card Header with Image -->
                        <div class="guide-card-header">
                            <div class="guide-image-wrapper">
                                @if ($tourguide->foto)
                                    <img src="{{ asset('storage/' . $tourguide->foto) }}" alt="{{ $tourguide->nama }}"
                                        class="guide-image" loading="lazy">
                                @else
                                    <div class="guide-image-placeholder">
                                        <i class="fas fa-user"></i>
                                    </div>
                                @endif
                                <div class="guide-overlay">
                                    <div class="guide-rating">
                                        <i class="fas fa-star"></i>
                                        <span>4.8</span>
                                    </div>
                                    <div class="guide-status online">
                                        <i class="fas fa-circle"></i>
                                        <span>Online</span>
                                    </div>
                                </div>
                            </div>

                            <!-- Price Badge -->
                            <div class="price-badge">
                                <i class="fas fa-tag"></i>
                                <span>{{ $tourguide->price_range ?? '500k' }}</span>
                            </div>
                        </div>

                        <!-- Card Body -->
                        <div class="guide-card-body">
                            <div class="guide-info">
                                <h3 class="guide-name">{{ $tourguide->nama }}</h3>
                                <div class="guide-details">
                                    <div class="detail-item">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $tourguide->nohp }}</span>
                                    </div>
                                    <div class="detail-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $tourguide->alamat }}</span>
                                    </div>
                                </div>
                            </div>

                            <div class="guide-description">
                                <p>{{ Str::limit($tourguide->deskripsi, 100) }}</p>
                            </div>

                            <!-- Skills/Specialties -->
                            <div class="guide-skills">
                                <span class="skill-tag">Nature Tours</span>
                                <span class="skill-tag">Photography</span>
                                <span class="skill-tag">History</span>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="guide-card-footer">
                            <div class="guide-stats">
                                <div class="stat">
                                    <i class="fas fa-users"></i>
                                    <span>127 Tours</span>
                                </div>
                                <div class="stat">
                                    <i class="fas fa-language"></i>
                                    <span>3 Languages</span>
                                </div>
                            </div>

                            <div class="guide-actions">
                                <button class="btn-action btn-secondary" onclick="viewGuideProfile({{ $tourguide->id }})">
                                    <i class="fas fa-eye"></i>
                                    View Profile
                                </button>
                                @auth
                                    <a href="{{ route('tourguides.order', $tourguide->id) }}" class="btn-action btn-primary">
                                        <i class="fas fa-calendar-check"></i>
                                        Book Now
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-action btn-primary">
                                        <i class="fas fa-sign-in-alt"></i>
                                        Login to Book
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" data-aos="fade-up">
                        <div class="empty-icon">
                            <i class="fas fa-user-friends"></i>
                        </div>
                        <h3>No Tour Guides Available</h3>
                        <p>We're currently updating our guide roster. Please check back soon!</p>
                        <a href="{{ url('/') }}" class="btn-action btn-primary">
                            <i class="fas fa-home"></i>
                            Back to Home
                        </a>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if (isset($tourguides) && method_exists($tourguides, 'links'))
                <div class="pagination-wrapper" data-aos="fade-up">
                    {{ $tourguides->links('custom.pagination') }}
                </div>
            @endif
        </div>
    </section>

    <!-- CTA Section -->
    {{-- <section class="cta-section" data-aos="fade-up">
        <div class="container">
            <div class="cta-content">
                <div class="row align-items-center">
                    <div class="col-lg-8">
                        <h2 class="cta-title">Ready for Your Next Adventure?</h2>
                        <p class="cta-description">
                            Join thousands of satisfied travelers who have discovered amazing places with our guides.
                        </p>
                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a href="#tourGuides" class="btn-cta">
                            <i class="fas fa-rocket"></i>
                            Start Exploring
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <!-- Guide Profile Modal -->
    <div class="modal fade" id="guideProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Guide Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="guideProfileContent">
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                        <p>Loading guide profile...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('layouts.footer')
@endsection

@section('styles')
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <style>
        :root {
            --primary-color: #2563eb;
            --primary-dark: #1d4ed8;
            --primary-light: #3b82f6;
            --secondary-color: #64748b;
            --accent-color: #f59e0b;
            --success-color: #10b981;
            --danger-color: #ef4444;
            --warning-color: #f59e0b;
            --dark-color: #0f172a;
            --light-color: #f8fafc;
            --border-color: #e2e8f0;
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow-md: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --shadow-xl: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            --shadow-2xl: 0 25px 50px -12px rgb(0 0 0 / 0.25);
            --border-radius: 0.75rem;
            --border-radius-lg: 1rem;
            --transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--dark-color);
            overflow-x: hidden;
        }

        /* ===== HERO SECTION ===== */
        .hero-section {
            position: relative;
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(102, 126, 234, 0.9) 0%, rgba(118, 75, 162, 0.9) 100%);
            z-index: 1;
        }

        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image:
                radial-gradient(circle at 20% 80%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 255, 255, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 40% 40%, rgba(255, 255, 255, 0.05) 0%, transparent 50%);
            animation: float 20s ease-in-out infinite;
            z-index: 1;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            33% {
                transform: translateY(-30px) rotate(120deg);
            }

            66% {
                transform: translateY(-60px) rotate(240deg);
            }
        }

        .hero-content {
            position: relative;
            z-index: 2;
            text-align: center;
            color: white;
            max-width: 800px;
            padding: 0 2rem;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(3rem, 8vw, 6rem);
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            text-shadow: 0 4px 20px rgba(0, 0, 0, 0.3);
        }

        .gradient-text {
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description {
            font-size: 1.25rem;
            margin-bottom: 3rem;
            opacity: 0.9;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 4rem;
        }

        .btn-hero-primary,
        .btn-hero-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1rem;
        }

        .btn-hero-primary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-hero-primary:hover {
            background: white;
            color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
        }

        .btn-hero-secondary {
            background: transparent;
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.5);
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
            transform: translateY(-2px);
        }

        .hero-stats {
            display: flex;
            justify-content: center;
            gap: 3rem;
            flex-wrap: wrap;
        }

        .stat-item {
            text-align: center;
        }

        .stat-number {
            display: block;
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--accent-color);
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
        }

        .stat-label {
            font-size: 0.875rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 2;
            cursor: pointer;
        }

        .scroll-arrow {
            width: 2px;
            height: 30px;
            background: white;
            position: relative;
            animation: scroll-bounce 2s infinite;
        }

        .scroll-arrow::after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: -3px;
            width: 8px;
            height: 8px;
            border-right: 2px solid white;
            border-bottom: 2px solid white;
            transform: rotate(45deg);
        }

        @keyframes scroll-bounce {

            0%,
            100% {
                transform: translateY(0);
                opacity: 1;
            }

            50% {
                transform: translateY(10px);
                opacity: 0.5;
            }
        }

        /* ===== FEATURES SECTION ===== */
        .features-section {
            padding: 6rem 0;
            background: var(--light-color);
        }

        .feature-card {
            background: white;
            padding: 3rem 2rem;
            border-radius: var(--border-radius-lg);
            text-align: center;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            height: 100%;
            border: 1px solid var(--border-color);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-xl);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: white;
            font-size: 2rem;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: var(--dark-color);
        }

        .feature-card p {
            color: var(--secondary-color);
            line-height: 1.7;
        }

        /* ===== SECTION HEADER ===== */
        .section-header {
            margin-bottom: 4rem;
        }

        .section-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gradient-primary);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1rem;
        }

        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .section-subtitle {
            font-size: 1.125rem;
            color: var(--secondary-color);
            max-width: 600px;
            margin: 0 auto 2rem;
        }

        .section-divider {
            width: 80px;
            height: 4px;
            background: var(--gradient-primary);
            border-radius: 2px;
            margin: 0 auto;
        }

        /* ===== TOUR GUIDES SECTION ===== */
        .tour-guides-section {
            padding: 6rem 0;
            background: white;
        }

        /* ===== FILTER SECTION ===== */
        .filter-section {
            background: var(--light-color);
            padding: 2rem;
            border-radius: var(--border-radius-lg);
            border: 1px solid var(--border-color);
        }

        .search-box {
            position: relative;
            width: 100%;
        }

        .search-box i {
            position: absolute;
            left: 1rem;
            top: 50%;
            transform: translateY(-50%);
            color: var(--secondary-color);
            z-index: 2;
        }

        .search-box input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid var(--border-color);
            border-radius: var(--border-radius);
            font-size: 1rem;
            transition: var(--transition);
            background: white;
        }

        .search-box input:focus {
            outline: none;
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .filter-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: flex-end;
        }

        .filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border: 2px solid var(--border-color);
            background: white;
            color: var(--secondary-color);
            border-radius: var(--border-radius);
            font-weight: 500;
            transition: var(--transition);
            cursor: pointer;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: var(--primary-color);
            color: white;
            border-color: var(--primary-color);
            transform: translateY(-2px);
            box-shadow: var(--shadow-md);
        }

        /* ===== GUIDES GRID ===== */
        .guides-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .guide-card {
            background: white;
            border-radius: var(--border-radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-md);
            transition: var(--transition);
            border: 1px solid var(--border-color);
            position: relative;
        }

        .guide-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-2xl);
        }

        .guide-card-header {
            position: relative;
            height: 280px;
            overflow: hidden;
        }

        .guide-image-wrapper {
            position: relative;
            width: 100%;
            height: 100%;
        }

        .guide-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .guide-card:hover .guide-image {
            transform: scale(1.1);
        }

        .guide-image-placeholder {
            width: 100%;
            height: 100%;
            background: var(--gradient-primary);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 4rem;
        }

        .guide-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.1) 0%, rgba(0, 0, 0, 0.7) 100%);
            display: flex;
            justify-content: space-between;
            align-items: flex-end;
            padding: 1.5rem;
        }

        .guide-rating {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            background: rgba(255, 255, 255, 0.9);
            padding: 0.5rem 0.75rem;
            border-radius: 50px;
            font-weight: 600;
            color: var(--dark-color);
        }

        .guide-rating i {
            color: var(--accent-color);
        }

        .guide-status {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .guide-status.online i {
            color: var(--success-color);
            animation: pulse-dot 2s infinite;
        }

        @keyframes pulse-dot {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .price-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            background: var(--gradient-accent);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: var(--shadow-md);
        }

        .guide-card-body {
            padding: 2rem;
        }

        .guide-info {
            margin-bottom: 1.5rem;
        }

        .guide-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .guide-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: var(--secondary-color);
            font-size: 0.875rem;
        }

        .detail-item i {
            width: 16px;
            color: var(--primary-color);
        }

        .guide-description {
            margin-bottom: 1.5rem;
        }

        .guide-description p {
            color: var(--secondary-color);
            line-height: 1.6;
        }

        .guide-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
        }

        .skill-tag {
            background: var(--light-color);
            color: var(--primary-color);
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            border: 1px solid var(--border-color);
        }

        .guide-card-footer {
            padding: 0 2rem 2rem;
        }

        .guide-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1.5rem;
            padding: 1rem;
            background: var(--light-color);
            border-radius: var(--border-radius);
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: var(--secondary-color);
        }

        .stat i {
            color: var(--primary-color);
        }

        .guide-actions {
            display: flex;
            gap: 0.75rem;
        }

        .btn-action {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
        }

        .btn-action.btn-primary {
            background: var(--gradient-primary);
            color: white;
        }

        .btn-action.btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
            color: white;
        }

        .btn-action.btn-secondary {
            background: white;
            color: var(--secondary-color);
            border: 2px solid var(--border-color);
        }

        .btn-action.btn-secondary:hover {
            background: var(--light-color);
            color: var(--dark-color);
            transform: translateY(-2px);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: var(--light-color);
            border-radius: var(--border-radius-lg);
            border: 2px dashed var(--border-color);
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            color: white;
            font-size: 3rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: var(--secondary-color);
            margin-bottom: 2rem;
        }

        /* ===== CTA SECTION ===== */
        .cta-section {
            padding: 6rem 0;
            background: var(--gradient-primary);
            color: white;
        }

        .cta-content {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            padding: 4rem;
            border-radius: var(--border-radius-lg);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .cta-title {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.125rem;
            opacity: 0.9;
            margin-bottom: 0;
        }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            color: var(--primary-color);
            padding: 1rem 2rem;
            border-radius: var(--border-radius);
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1rem;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-xl);
            color: var(--primary-color);
        }

        /* ===== PAGINATION ===== */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        /* ===== MODAL STYLES ===== */
        .modal-content {
            border-radius: var(--border-radius-lg);
            border: none;
            box-shadow: var(--shadow-2xl);
        }

        .modal-header {
            border-bottom: 1px solid var(--border-color);
            padding: 1.5rem 2rem;
        }

        .modal-body {
            padding: 2rem;
        }

        .loading-spinner {
            text-align: center;
            padding: 3rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid var(--border-color);
            border-top: 4px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 0 auto 1rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* ===== ALERT STYLES ===== */
        .alert-modern {
            border: none;
            border-radius: var(--border-radius);
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-md);
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-left: 4px solid var(--success-color);
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1200px) {
            .guides-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn-hero-primary,
            .btn-hero-secondary {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .hero-stats {
                gap: 2rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .features-section,
            .tour-guides-section {
                padding: 4rem 0;
            }

            .feature-card {
                padding: 2rem 1.5rem;
            }

            .guides-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .guide-card-header {
                height: 250px;
            }

            .guide-card-body {
                padding: 1.5rem;
            }

            .guide-card-footer {
                padding: 0 1.5rem 1.5rem;
            }

            .guide-actions {
                flex-direction: column;
            }

            .filter-buttons {
                justify-content: center;
            }

            .filter-btn {
                flex: 1;
                justify-content: center;
                min-width: 120px;
            }

            .cta-content {
                padding: 2rem;
                text-align: center;
            }

            .cta-title {
                font-size: 2rem;
            }

            .section-title {
                font-size: 2.5rem;
            }
        }

        @media (max-width: 480px) {
            .hero-content {
                padding: 0 1rem;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-description {
                font-size: 1rem;
            }

            .guides-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .guide-card-header {
                height: 200px;
            }

            .guide-card-body,
            .guide-card-footer {
                padding: 1rem;
            }

            .guide-card-footer {
                padding-top: 0;
            }

            .filter-section {
                padding: 1rem;
            }

            .search-box input {
                padding: 0.875rem 0.875rem 0.875rem 2.5rem;
            }

            .filter-buttons {
                gap: 0.25rem;
            }

            .filter-btn {
                padding: 0.5rem 1rem;
                font-size: 0.875rem;
            }

            .section-header {
                margin-bottom: 2rem;
            }

            .section-title {
                font-size: 2rem;
            }

            .section-subtitle {
                font-size: 1rem;
            }
        }

        /* ===== ANIMATION ENHANCEMENTS ===== */
        .guide-card {
            animation: fadeInUp 0.6s ease-out;
        }

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

        /* ===== ACCESSIBILITY IMPROVEMENTS ===== */
        .btn-action:focus,
        .filter-btn:focus,
        .search-box input:focus {
            outline: 2px solid var(--primary-color);
            outline-offset: 2px;
        }

        /* ===== DARK MODE SUPPORT ===== */
        @media (prefers-color-scheme: dark) {
            :root {
                --dark-color: #f8fafc;
                --light-color: #1e293b;
                --border-color: #334155;
                --secondary-color: #94a3b8;
            }

            body {
                background: #0f172a;
                color: var(--dark-color);
            }

            .guide-card,
            .feature-card,
            .filter-section {
                background: #1e293b;
                border-color: var(--border-color);
            }

            .search-box input {
                background: #334155;
                color: var(--dark-color);
                border-color: var(--border-color);
            }

            .filter-btn {
                background: #334155;
                border-color: var(--border-color);
                color: var(--secondary-color);
            }
        }

        /* ===== PERFORMANCE OPTIMIZATIONS ===== */
        .guide-image {
            will-change: transform;
        }

        .guide-card {
            will-change: transform, box-shadow;
        }

        /* ===== PRINT STYLES ===== */
        @media print {

            .hero-section,
            .cta-section,
            .filter-section {
                display: none;
            }

            .guide-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ccc;
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

@push('scripts')
    <!-- AOS Animation Library -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize AOS
            AOS.init({
                duration: 800,
                once: true,
                offset: 100,
                easing: 'ease-out-cubic'
            });

            // Search functionality
            const searchInput = document.getElementById('searchGuides');
            const guideCards = document.querySelectorAll('.guide-card');
            const guidesGrid = document.getElementById('guidesGrid');

            if (searchInput) {
                searchInput.addEventListener('input', function() {
                    const searchTerm = this.value.toLowerCase().trim();
                    let visibleCount = 0;

                    guideCards.forEach(card => {
                        const name = card.dataset.name || '';
                        const location = card.dataset.location || '';
                        const isVisible = name.includes(searchTerm) || location.includes(
                            searchTerm);

                        if (isVisible) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeInUp 0.6s ease-out';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Show/hide empty state
                    toggleEmptyState(visibleCount === 0 && searchTerm !== '');
                });
            }

            // Filter functionality
            const filterButtons = document.querySelectorAll('.filter-btn');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Update active state
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.dataset.filter;
                    let visibleCount = 0;

                    guideCards.forEach(card => {
                        let isVisible = true;

                        switch (filter) {
                            case 'premium':
                                // Show cards with higher price ranges
                                const price = card.dataset.price || '';
                                isVisible = price.includes('1000k') || price.includes(
                                    '800k');
                                break;
                            case 'available':
                                // Show all cards (simulate availability)
                                isVisible = true;
                                break;
                            case 'all':
                            default:
                                isVisible = true;
                                break;
                        }

                        if (isVisible) {
                            card.style.display = 'block';
                            card.style.animation = 'fadeInUp 0.6s ease-out';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Clear search when filtering
                    if (searchInput) {
                        searchInput.value = '';
                    }

                    toggleEmptyState(visibleCount === 0);
                });
            });

            // Smooth scrolling for hero buttons
            const heroButtons = document.querySelectorAll('.btn-hero-primary, .btn-hero-secondary');
            heroButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    const href = this.getAttribute('href');
                    if (href && href.startsWith('#')) {
                        e.preventDefault();
                        const target = document.querySelector(href);
                        if (target) {
                            target.scrollIntoView({
                                behavior: 'smooth',
                                block: 'start'
                            });
                        }
                    }
                });
            });

            // Scroll indicator functionality
            const scrollIndicator = document.querySelector('.scroll-indicator');
            if (scrollIndicator) {
                scrollIndicator.addEventListener('click', function() {
                    const featuresSection = document.getElementById('features');
                    if (featuresSection) {
                        featuresSection.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

            // Parallax effect for hero section
            const heroSection = document.getElementById('heroSection');
            const heroContent = document.querySelector('.hero-content');

            if (heroSection && heroContent) {
                window.addEventListener('scroll', function() {
                    const scrolled = window.pageYOffset;
                    const rate = scrolled * -0.5;

                    if (scrolled < heroSection.offsetHeight) {
                        heroContent.style.transform = `translateY(${rate}px)`;
                    }
                });
            }

            // Intersection Observer for animations
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                    }
                });
            }, observerOptions);

            // Observe elements for animation
            document.querySelectorAll('.guide-card, .feature-card').forEach(el => {
                observer.observe(el);
            });

            // Loading states for buttons
            document.querySelectorAll('.btn-action').forEach(button => {
                button.addEventListener('click', function() {
                    if (this.href && !this.href.includes('#')) {
                        const originalText = this.innerHTML;
                        this.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Loading...';
                        this.style.pointerEvents = 'none';

                        // Reset after 2 seconds if still on page
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.style.pointerEvents = 'auto';
                        }, 2000);
                    }
                });
            });

            // Guide profile modal functionality
            window.viewGuideProfile = function(guideId) {
                const modal = new bootstrap.Modal(document.getElementById('guideProfileModal'));
                const modalContent = document.getElementById('guideProfileContent');

                // Show loading state
                modalContent.innerHTML = `
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                        <p>Loading guide profile...</p>
                    </div>
                `;

                modal.show();

                // Simulate API call (replace with actual API call)
                setTimeout(() => {
                    const guideCard = document.querySelector(`[data-guide-id="${guideId}"]`);
                    const guideName = guideCard ? guideCard.querySelector('.guide-name').textContent :
                        'Guide';

                    modalContent.innerHTML = `
                        <div class="guide-profile-content">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="profile-image-wrapper">
                                        <img src="/images/default-profile.jpg" alt="${guideName}" class="img-fluid rounded">
                                    </div>
                                </div>
                                <div class="col-md-8">
                                    <h3>${guideName}</h3>
                                    <div class="profile-details">
                                        <p><strong>Experience:</strong> 5+ years</p>
                                        <p><strong>Languages:</strong> English, Indonesian, Mandarin</p>
                                        <p><strong>Specialties:</strong> Nature tours, Cultural experiences, Photography</p>
                                        <p><strong>Rating:</strong> ⭐⭐⭐⭐⭐ (4.8/5)</p>
                                    </div>
                                    <div class="profile-description">
                                        <h5>About</h5>
                                        <p>Passionate local guide with extensive knowledge of hidden gems and cultural insights. Specializes in creating personalized experiences that showcase the authentic beauty of our region.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;
                }, 1000);
            };

            // Empty state toggle function
            function toggleEmptyState(show) {
                let emptyState = document.querySelector('.empty-state');

                if (show && !emptyState) {
                    emptyState = document.createElement('div');
                    emptyState.className = 'empty-state';
                    emptyState.innerHTML = `
                        <div class="empty-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>No Guides Found</h3>
                        <p>Try adjusting your search or filter criteria.</p>
                        <button class="btn-action btn-primary" onclick="clearFilters()">
                            <i class="fas fa-refresh"></i>
                            Clear Filters
                        </button>
                    `;
                    guidesGrid.appendChild(emptyState);
                } else if (!show && emptyState) {
                    emptyState.remove();
                }
            }

            // Clear filters function
            window.clearFilters = function() {
                // Reset search
                if (searchInput) {
                    searchInput.value = '';
                }

                // Reset filters
                filterButtons.forEach(btn => btn.classList.remove('active'));
                document.querySelector('.filter-btn[data-filter="all"]').classList.add('active');

                // Show all cards
                guideCards.forEach(card => {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.6s ease-out';
                });

                // Hide empty state
                toggleEmptyState(false);
            };

            // Lazy loading for images
            const imageObserver = new IntersectionObserver((entries, observer) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const img = entry.target;
                        if (img.dataset.src) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                            observer.unobserve(img);
                        }
                    }
                });
            });

            document.querySelectorAll('img[data-src]').forEach(img => {
                imageObserver.observe(img);
            });

            // Keyboard navigation support
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    // Close modals
                    const openModal = document.querySelector('.modal.show');
                    if (openModal) {
                        const modal = bootstrap.Modal.getInstance(openModal);
                        if (modal) modal.hide();
                    }
                }

                if (e.key === '/' && !e.ctrlKey && !e.metaKey) {
                    e.preventDefault();
                    if (searchInput) {
                        searchInput.focus();
                    }
                }
            });

            // Performance optimization: Debounce scroll events
            let scrollTimeout;
            window.addEventListener('scroll', function() {
                if (scrollTimeout) {
                    clearTimeout(scrollTimeout);
                }

                scrollTimeout = setTimeout(function() {
                    // Update scroll-based animations
                    updateScrollAnimations();
                }, 16); // ~60fps
            });

            function updateScrollAnimations() {
                const scrolled = window.pageYOffset;

                // Update hero parallax
                if (heroContent && scrolled < window.innerHeight) {
                    const rate = scrolled * -0.3;
                    heroContent.style.transform = `translateY(${rate}px)`;
                }

                // Update scroll indicator opacity
                if (scrollIndicator) {
                    const opacity = Math.max(0, 1 - (scrolled / window.innerHeight));
                    scrollIndicator.style.opacity = opacity;
                }
            }

            // Touch gestures for mobile
            let touchStartX = 0;
            let touchStartY = 0;

            document.addEventListener('touchstart', function(e) {
                touchStartX = e.touches[0].clientX;
                touchStartY = e.touches[0].clientY;
            });

            document.addEventListener('touchend', function(e) {
                if (!touchStartX || !touchStartY) return;

                const touchEndX = e.changedTouches[0].clientX;
                const touchEndY = e.changedTouches[0].clientY;

                const diffX = touchStartX - touchEndX;
                const diffY = touchStartY - touchEndY;

                // Horizontal swipe detection
                if (Math.abs(diffX) > Math.abs(diffY) && Math.abs(diffX) > 50) {
                    if (diffX > 0) {
                        // Swipe left - next filter
                        const activeFilter = document.querySelector('.filter-btn.active');
                        const nextFilter = activeFilter.nextElementSibling;
                        if (nextFilter && nextFilter.classList.contains('filter-btn')) {
                            nextFilter.click();
                        }
                    } else {
                        // Swipe right - previous filter
                        const activeFilter = document.querySelector('.filter-btn.active');
                        const prevFilter = activeFilter.previousElementSibling;
                        if (prevFilter && prevFilter.classList.contains('filter-btn')) {
                            prevFilter.click();
                        }
                    }
                }

                touchStartX = 0;
                touchStartY = 0;
            });

            // Analytics tracking (if needed)
            function trackEvent(action, category, label) {
                if (typeof gtag !== 'undefined') {
                    gtag('event', action, {
                        event_category: category,
                        event_label: label
                    });
                }
            }

            // Track user interactions
            document.querySelectorAll('.btn-action').forEach(button => {
                button.addEventListener('click', function() {
                    const action = this.textContent.trim();
                    trackEvent('click', 'tour_guide', action);
                });
            });

            // Error handling for images
            document.querySelectorAll('.guide-image').forEach(img => {
                img.addEventListener('error', function() {
                    this.src = '/images/default-profile.jpg';
                    this.alt = 'Default Profile';
                });
            });

            // Preload critical resources
            const criticalImages = [
                '/images/default-profile.jpg',
                '/images/hero.jpg'
            ];

            criticalImages.forEach(src => {
                const link = document.createElement('link');
                link.rel = 'preload';
                link.as = 'image';
                link.href = src;
                document.head.appendChild(link);
            });

            // Service Worker registration (if available)
            if ('serviceWorker' in navigator) {
                window.addEventListener('load', function() {
                    navigator.serviceWorker.register('/sw.js')
                        .then(function(registration) {
                            console.log('SW registered: ', registration);
                        })
                        .catch(function(registrationError) {
                            console.log('SW registration failed: ', registrationError);
                        });
                });
            }

            // Network status monitoring
            window.addEventListener('online', function() {
                showNotification('Connection restored', 'success');
            });

            window.addEventListener('offline', function() {
                showNotification('You are offline. Some features may not work.', 'warning');
            });

            // Notification system
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `notification notification-${type}`;
                notification.innerHTML = `
                    <div class="notification-content">
                        <i class="fas fa-${type === 'success' ? 'check-circle' : type === 'warning' ? 'exclamation-triangle' : 'info-circle'}"></i>
                        <span>${message}</span>
                        <button class="notification-close" onclick="this.parentElement.parentElement.remove()">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                `;

                // Add notification styles if not already added
                if (!document.querySelector('#notification-styles')) {
                    const styles = document.createElement('style');
                    styles.id = 'notification-styles';
                    styles.textContent = `
                        .notification {
                            position: fixed;
                            top: 100px;
                            right: 20px;
                            z-index: 1050;
                            min-width: 300px;
                            padding: 1rem;
                            border-radius: var(--border-radius);
                            box-shadow: var(--shadow-xl);
                            animation: slideInRight 0.3s ease-out;
                        }
                        
                        .notification-success {
                            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
                            color: #065f46;
                            border-left: 4px solid var(--success-color);
                        }
                        
                        .notification-warning {
                            background: linear-gradient(135deg, #fef3c7, #fde68a);
                            color: #92400e;
                            border-left: 4px solid var(--warning-color);
                        }
                        
                        .notification-info {
                            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
                            color: #1e40af;
                            border-left: 4px solid var(--primary-color);
                        }
                        
                        .notification-content {
                            display: flex;
                            align-items: center;
                            gap: 0.75rem;
                        }
                        
                        .notification-close {
                            background: none;
                            border: none;
                            color: inherit;
                            cursor: pointer;
                            padding: 0.25rem;
                            margin-left: auto;
                            opacity: 0.7;
                            transition: opacity 0.2s;
                        }
                        
                        .notification-close:hover {
                            opacity: 1;
                        }
                        
                        @keyframes slideInRight {
                            from {
                                transform: translateX(100%);
                                opacity: 0;
                            }
                            to {
                                transform: translateX(0);
                                opacity: 1;
                            }
                        }
                    `;
                    document.head.appendChild(styles);
                }

                document.body.appendChild(notification);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.style.animation = 'slideOutRight 0.3s ease-in forwards';
                        setTimeout(() => notification.remove(), 300);
                    }
                }, 5000);
            }

            // Initialize tooltips (if Bootstrap tooltips are available)
            if (typeof bootstrap !== 'undefined' && bootstrap.Tooltip) {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            // Initialize popovers (if Bootstrap popovers are available)
            if (typeof bootstrap !== 'undefined' && bootstrap.Popover) {
                const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                popoverTriggerList.map(function(popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl);
                });
            }

            // Accessibility improvements
            document.addEventListener('keydown', function(e) {
                // Skip to main content
                if (e.altKey && e.key === 's') {
                    e.preventDefault();
                    const mainContent = document.getElementById('tourGuides');
                    if (mainContent) {
                        mainContent.focus();
                        mainContent.scrollIntoView({
                            behavior: 'smooth'
                        });
                    }
                }

                // Focus search with Ctrl+F or Cmd+F
                if ((e.ctrlKey || e.metaKey) && e.key === 'f') {
                    e.preventDefault();
                    if (searchInput) {
                        searchInput.focus();
                        searchInput.select();
                    }
                }
            });

            // Add skip link for accessibility
            const skipLink = document.createElement('a');
            skipLink.href = '#tourGuides';
            skipLink.textContent = 'Skip to main content';
            skipLink.className = 'skip-link';
            skipLink.style.cssText = `
                position: absolute;
                top: -40px;
                left: 6px;
                background: var(--primary-color);
                color: white;
                padding: 8px;
                text-decoration: none;
                border-radius: 4px;
                z-index: 1000;
                transition: top 0.3s;
            `;

            skipLink.addEventListener('focus', function() {
                this.style.top = '6px';
            });

            skipLink.addEventListener('blur', function() {
                this.style.top = '-40px';
            });

            document.body.insertBefore(skipLink, document.body.firstChild);

            // Performance monitoring
            if ('performance' in window) {
                window.addEventListener('load', function() {
                    setTimeout(function() {
                        const perfData = performance.getEntriesByType('navigation')[0];
                        if (perfData) {
                            console.log('Page load time:', perfData.loadEventEnd - perfData
                                .loadEventStart, 'ms');
                        }
                    }, 0);
                });
            }

            // Memory cleanup on page unload
            window.addEventListener('beforeunload', function() {
                // Clear intervals and timeouts
                if (scrollTimeout) clearTimeout(scrollTimeout);

                // Disconnect observers
                if (observer) observer.disconnect();
                if (imageObserver) imageObserver.disconnect();

                // Remove event listeners
                window.removeEventListener('scroll', updateScrollAnimations);
                window.removeEventListener('resize', handleResize);
            });

            // Handle window resize
            function handleResize() {
                // Recalculate animations on resize
                if (window.innerWidth < 768) {
                    // Mobile optimizations
                    document.body.classList.add('mobile-view');
                } else {
                    document.body.classList.remove('mobile-view');
                }
            }

            window.addEventListener('resize', handleResize);
            handleResize(); // Initial call

            // Initialize page
            console.log('Tour Guides page initialized successfully');

            // Show welcome message for first-time visitors
            if (!localStorage.getItem('tourguides_visited')) {
                setTimeout(() => {
                    showNotification('Welcome! Use the search and filters to find your perfect guide.',
                        'info');
                    localStorage.setItem('tourguides_visited', 'true');
                }, 2000);
            }

            // Add loading states to all interactive elements
            document.querySelectorAll('button, a[href]').forEach(element => {
                element.addEventListener('click', function() {
                    if (!this.classList.contains('no-loading')) {
                        this.style.opacity = '0.7';
                        this.style.pointerEvents = 'none';

                        setTimeout(() => {
                            this.style.opacity = '1';
                            this.style.pointerEvents = 'auto';
                        }, 1000);
                    }
                });
            });

            // Smooth reveal animations for cards
            const revealCards = () => {
                const cards = document.querySelectorAll('.guide-card:not(.revealed)');
                cards.forEach((card, index) => {
                    const rect = card.getBoundingClientRect();
                    if (rect.top < window.innerHeight - 100) {
                        setTimeout(() => {
                            card.classList.add('revealed');
                            card.style.opacity = '1';
                            card.style.transform = 'translateY(0)';
                        }, index * 100);
                    }
                });
            };

            // Initial reveal
            revealCards();

            // Reveal on scroll
            window.addEventListener('scroll', revealCards);

            // Add initial styles for reveal animation
            document.querySelectorAll('.guide-card').forEach(card => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(30px)';
                card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            });
        });

        // Global utility functions
        window.utils = {
            debounce: function(func, wait) {
                let timeout;
                return function executedFunction(...args) {
                    const later = () => {
                        clearTimeout(timeout);
                        func(...args);
                    };
                    clearTimeout(timeout);
                    timeout = setTimeout(later, wait);
                };
            },

            throttle: function(func, limit) {
                let inThrottle;
                return function() {
                    const args = arguments;
                    const context = this;
                    if (!inThrottle) {
                        func.apply(context, args);
                        inThrottle = true;
                        setTimeout(() => inThrottle = false, limit);
                    }
                };
            },

            formatPrice: function(price) {
                return new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    minimumFractionDigits: 0
                }).format(price);
            },

            formatDate: function(date) {
                return new Intl.DateTimeFormat('id-ID', {
                    year: 'numeric',
                    month: 'long',
                    day: 'numeric'
                }).format(new Date(date));
            }
        };

        // Export functions for external use
        window.tourGuideApp = {
            searchGuides: function(term) {
                const searchInput = document.getElementById('searchGuides');
                if (searchInput) {
                    searchInput.value = term;
                    searchInput.dispatchEvent(new Event('input'));
                }
            },

            filterGuides: function(filter) {
                const filterBtn = document.querySelector(`[data-filter="${filter}"]`);
                if (filterBtn) {
                    filterBtn.click();
                }
            },

            clearAll: function() {
                if (typeof clearFilters === 'function') {
                    clearFilters();
                }
            }
        };
    </script>
@endpush
