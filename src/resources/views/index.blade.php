@extends('layouts.app')

@section('title', 'Welcome - ONEVISION')

@section('content')
    <!-- Include AOS (Animate on Scroll) Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- 1. HERO SECTION -->
    <section class="hero-section-modern position-relative overflow-hidden">
        <div class="hero-particles"></div>
        <div class="hero-overlay"></div>

        <div class="container-fluid h-100">
            <div class="row h-100 align-items-center">
                <div class="col-lg-6 hero-content-left" data-aos="fade-right" data-aos-duration="1000">
                    <div class="hero-badge" data-aos="zoom-in" data-aos-delay="200">
                        <i class="fas fa-star"></i>
                        <span>Premium Destination</span>
                    </div>
                    <h1 class="hero-title-modern" data-aos="fade-up" data-aos-delay="400">
                        Discover the Magic of
                        <span class="gradient-text">AIR TERJUN LUBUK HITAM</span>
                    </h1>
                    <p class="hero-description-modern" data-aos="fade-up" data-aos-delay="600">
                        Experience the breathtaking beauty of West Sumatra's hidden gem. Immerse yourself in pristine
                        nature,
                        crystal-clear waters, and unforgettable adventures that will create memories to last a lifetime.
                    </p>
                    <div class="hero-actions-modern" data-aos="fade-up" data-aos-delay="800">
                        <a href="{{ route('login') }}" class="btn-hero-primary">
                            <i class="fas fa-compass"></i>
                            Start Your Journey
                        </a>
                        <a href="#explore-section" class="btn-hero-secondary">
                            <i class="fas fa-play"></i>
                            Explore More
                        </a>
                    </div>
                    <div class="hero-stats-modern" data-aos="fade-up" data-aos-delay="1000">
                        <div class="stat-item-modern">
                            <span class="stat-number-modern" data-count="1000">0</span>
                            <span class="stat-label-modern">Happy Visitors</span>
                        </div>
                        <div class="stat-item-modern">
                            <span class="stat-number-modern" data-count="{{ $tourGuides->count() }}">0</span>
                            <span class="stat-label-modern">Expert Guides</span>
                        </div>
                        <div class="stat-item-modern">
                            <span class="stat-number-modern" data-count="50">0</span>
                            <span class="stat-label-modern">Facilities</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 hero-content-right" data-aos="fade-left" data-aos-delay="600">
                    <div class="hero-image-wrapper">
                        <div class="hero-floating-card" data-aos="zoom-in" data-aos-delay="1200">
                            <div class="floating-card-content">
                                <div class="floating-card-icon">
                                    <i class="fas fa-map-marker-alt"></i>
                                </div>
                                <div class="floating-card-text">
                                    <h6>Beautiful Location</h6>
                                    <p>West Sumatra, Indonesia</p>
                                </div>
                            </div>
                        </div>
                        <img src="{{ asset('images/waterfall.jpg') }}" alt="Air Terjun Lubuk Hitam" class="hero-main-image">
                    </div>
                </div>
            </div>
        </div>

        <div class="scroll-indicator-modern" data-aos="bounce" data-aos-delay="1400">
            <div class="scroll-arrow-modern"></div>
        </div>
    </section>

    <!-- 2. EXPLORE SECTION -->
    <section id="explore-section" class="explore-section-modern py-5">
        <div class="container">
            <div class="section-header-modern text-center mb-5" data-aos="fade-up">
                <div class="section-badge-modern">
                    <i class="fas fa-mountain"></i>
                    <span>Explore Nature</span>
                </div>
                <h2 class="section-title-modern">Discover Amazing Places</h2>
                <p class="section-subtitle-modern">
                    Uncover the hidden treasures and breathtaking landscapes that make Air Terjun Lubuk Hitam
                    a truly magical destination for nature lovers and adventure seekers.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-8" data-aos="fade-right" data-aos-delay="200">
                    <div class="explore-main-card">
                        <div class="explore-main-image">
                            <img src="{{ asset('images/explore-bg.jpg') }}" alt="Main Attraction" class="img-fluid">
                            <div class="explore-main-overlay">
                                <div class="explore-main-content">
                                    <h3>The Majestic Waterfall</h3>
                                    <p>Experience the power and beauty of cascading waters surrounded by lush tropical
                                        forest.</p>
                                    <a href="{{ route('login') }}" class="btn-explore-main">
                                        <i class="fas fa-arrow-right"></i>
                                        Explore Now
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="row g-3">
                        <div class="col-12" data-aos="fade-left" data-aos-delay="300">
                            <div class="explore-sub-card">
                                <img src="{{ asset('images/pos1.jpeg') }}" alt="Azure Haven" class="img-fluid">
                                <div class="explore-sub-overlay">
                                    <h5>Azure Haven</h5>
                                    <p>Crystal clear pools</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-left" data-aos-delay="400">
                            <div class="explore-sub-card">
                                <img src="{{ asset('images/mushalla.jpg') }}" alt="Serene Sanctuary" class="img-fluid">
                                <div class="explore-sub-overlay">
                                    <h5>Serene Sanctuary</h5>
                                    <p>Peaceful meditation spots</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-12" data-aos="fade-left" data-aos-delay="500">
                            <div class="explore-sub-card">
                                <img src="{{ asset('images/toilet.jpg') }}" alt="Verdant Vista" class="img-fluid">
                                <div class="explore-sub-overlay">
                                    <h5>Modern Facilities</h5>
                                    <p>Comfort in nature</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. FACILITIES SECTION -->
    <section class="facilities-section-modern py-5 bg-light">
        <div class="container">
            <div class="section-header-modern text-center mb-5" data-aos="fade-up">
                <div class="section-badge-modern">
                    <i class="fas fa-cogs"></i>
                    <span>Our Facilities</span>
                </div>
                <h2 class="section-title-modern">World-Class Amenities</h2>
                <p class="section-subtitle-modern">
                    Enjoy premium facilities designed to enhance your experience and ensure maximum comfort during your
                    visit.
                </p>
            </div>

            <div class="row g-4">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="facility-card-modern">
                        <div class="facility-icon-modern">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h5 class="facility-title-modern">Competitive Prices</h5>
                        <p class="facility-description-modern">
                            Affordable packages and transparent pricing with no hidden costs.
                            Get the best value for your adventure experience.
                        </p>
                        <div class="facility-features">
                            <span class="feature-tag">Budget Friendly</span>
                            <span class="feature-tag">No Hidden Fees</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="facility-card-modern">
                        <div class="facility-icon-modern">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h5 class="facility-title-modern">Secure & Safe</h5>
                        <p class="facility-description-modern">
                            Your safety is our priority. Professional guides, safety equipment,
                            and emergency protocols ensure a worry-free experience.
                        </p>
                        <div class="facility-features">
                            <span class="feature-tag">24/7 Security</span>
                            <span class="feature-tag">Safety First</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="facility-card-modern">
                        <div class="facility-icon-modern">
                            <i class="fas fa-sync-alt"></i>
                        </div>
                        <h5 class="facility-title-modern">Seamless Experience</h5>
                        <p class="facility-description-modern">
                            From booking to departure, enjoy a smooth and hassle-free journey
                            with our dedicated customer service team.
                        </p>
                        <div class="facility-features">
                            <span class="feature-tag">Easy Booking</span>
                            <span class="feature-tag">24/7 Support</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. TOUR GUIDE SECTION -->
    <section class="tourguide-section-modern py-5">
        <div class="container">
            <div class="section-header-modern text-center mb-5" data-aos="fade-up">
                <div class="section-badge-modern">
                    <i class="fas fa-users"></i>
                    <span>Expert Guides</span>
                </div>
                <h2 class="section-title-modern">Meet Our Professional Tour Guides</h2>
                <p class="section-subtitle-modern">
                    Our experienced and certified guides are passionate locals who know every hidden gem and story of this
                    beautiful region.
                </p>
            </div>

            <div class="row g-4 mb-5">
                @foreach ($tourGuides->take(3) as $index => $guide)
                    <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                        <div class="guide-card-modern">
                            <div class="guide-image-wrapper-modern">
                                <img src="{{ asset('storage/' . $guide->foto) }}" alt="{{ $guide->nama }}"
                                    class="guide-image-modern">
                                <div class="guide-overlay-modern">
                                    <div class="guide-rating-modern">
                                        <i class="fas fa-star"></i>
                                        <span>4.9</span>
                                    </div>
                                    <div class="guide-status-modern">
                                        <i class="fas fa-circle"></i>
                                        <span>Available</span>
                                    </div>
                                </div>
                            </div>
                            <div class="guide-content-modern">
                                <h5 class="guide-name-modern">{{ $guide->nama }}</h5>
                                <div class="guide-details-modern">
                                    <div class="guide-detail-item">
                                        <i class="fas fa-phone"></i>
                                        <span>{{ $guide->nohp }}</span>
                                    </div>
                                    <div class="guide-detail-item">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span>{{ $guide->alamat }}</span>
                                    </div>
                                </div>
                                <div class="guide-price-modern">
                                    <span class="price-label">Starting from</span>
                                    <span class="price-value">{{ $guide->price_range ?? 'Rp 500K' }}</span>
                                </div>
                                <div class="guide-skills-modern">
                                    <span class="skill-tag">Nature Expert</span>
                                    <span class="skill-tag">Photography</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center" data-aos="fade-up" data-aos-delay="600">
                <a href="{{ route('tourguides.index') }}" class="btn-view-all-modern">
                    <i class="fas fa-users me-2"></i>
                    View All Guides
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- 5. UMKM & HONEY PRODUCTS SECTION -->
    <section class="products-section-modern py-5 bg-light">
        <div class="container">
            <div class="section-header-modern text-center mb-5" data-aos="fade-up">
                <div class="section-badge-modern">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Local Products</span>
                </div>
                <h2 class="section-title-modern">Authentic Local Products</h2>
                <p class="section-subtitle-modern">
                    Discover and support local businesses with our curated selection of authentic honey an Discover and
                    support local businesses with our curated selection of authentic honey and UMKM products.
                </p>
            </div>

            <div class="row g-4 mb-5">
                <!-- Honey Products -->
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="product-category-card-modern honey-card">
                        <div class="product-category-image">
                            <img src="{{ asset('images/honey-bg.jpg') }}" alt="Honey Products" class="img-fluid">
                            <div class="product-category-overlay">
                                <div class="product-category-content">
                                    <div class="product-category-icon">
                                        <i class="fas fa-jar"></i>
                                    </div>
                                    <h4>Premium Honey</h4>
                                    <p>Pure, natural honey harvested from local beekeepers with traditional methods.</p>
                                    <div class="product-features-modern">
                                        <span class="product-feature">100% Natural</span>
                                        <span class="product-feature">Locally Sourced</span>
                                        <span class="product-feature">Premium Quality</span>
                                    </div>
                                    <a href="{{ route('madu.index') }}" class="btn-product-category">
                                        <i class="fas fa-shopping-cart"></i>
                                        Shop Honey
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- UMKM Products -->
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="300">
                    <div class="product-category-card-modern umkm-card">
                        <div class="product-category-image">
                            <img src="{{ asset('images/umkm-bg.jpg') }}" alt="UMKM Products" class="img-fluid">
                            <div class="product-category-overlay">
                                <div class="product-category-content">
                                    <div class="product-category-icon">
                                        <i class="fas fa-store"></i>
                                    </div>
                                    <h4>UMKM Products</h4>
                                    <p>Support local entrepreneurs with handcrafted products and traditional specialties.
                                    </p>
                                    <div class="product-features-modern">
                                        <span class="product-feature">Handcrafted</span>
                                        <span class="product-feature">Local Business</span>
                                        <span class="product-feature">Authentic</span>
                                    </div>
                                    <a href="{{ route('produkUMKM.index') }}" class="btn-product-category">
                                        <i class="fas fa-handshake"></i>
                                        Support Local
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Highlights -->
            <div class="product-highlights-modern" data-aos="fade-up" data-aos-delay="400">
                <div class="row g-4">
                    <div class="col-md-3 col-6">
                        <div class="highlight-item-modern">
                            <div class="highlight-icon-modern">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h6>Organic</h6>
                            <p>100% Natural</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="highlight-item-modern">
                            <div class="highlight-icon-modern">
                                <i class="fas fa-heart"></i>
                            </div>
                            <h6>Healthy</h6>
                            <p>Good for You</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="highlight-item-modern">
                            <div class="highlight-icon-modern">
                                <i class="fas fa-shipping-fast"></i>
                            </div>
                            <h6>Fast Delivery</h6>
                            <p>Quick & Safe</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="highlight-item-modern">
                            <div class="highlight-icon-modern">
                                <i class="fas fa-medal"></i>
                            </div>
                            <h6>Quality</h6>
                            <p>Premium Grade</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 6. NEWS & GALLERY SECTION -->
    <section class="news-gallery-section-modern py-5">
        <div class="container">
            <div class="row g-5">
                <!-- News Section -->
                <div class="col-lg-6">
                    <div class="section-header-modern mb-4" data-aos="fade-right">
                        <div class="section-badge-modern">
                            <i class="fas fa-newspaper"></i>
                            <span>Latest News</span>
                        </div>
                        <h3 class="section-title-modern">Stay Updated</h3>
                        <p class="section-subtitle-modern">
                            Get the latest news and updates about events, activities, and developments.
                        </p>
                    </div>

                    <div class="news-cards-modern">
                        @if (isset($beritas) && $beritas->count() > 0)
                            @foreach ($beritas->take(3) as $berita)
                                <div class="news-card-modern" data-aos="fade-right"
                                    data-aos-delay="{{ $loop->index * 100 }}">
                                    <div class="news-image-modern">
                                        @if ($berita->foto)
                                            <img src="{{ asset('storage/' . $berita->foto) }}"
                                                alt="{{ $berita->judul }}">
                                        @else
                                            <img src="{{ asset('images/default-news.jpg') }}"
                                                alt="{{ $berita->judul }}">
                                        @endif
                                        <div class="news-date-modern">
                                            <span class="date-day">{{ date('d', strtotime($berita->created_at)) }}</span>
                                            <span
                                                class="date-month">{{ date('M', strtotime($berita->created_at)) }}</span>
                                        </div>
                                    </div>
                                    <div class="news-content-modern">
                                        <h6 class="news-title-modern">{{ Str::limit($berita->judul, 60) }}</h6>
                                        <p class="news-excerpt-modern">{{ Str::limit($berita->konten, 100) }}</p>
                                        <div class="news-meta-modern">
                                            <span class="news-author">Admin</span>
                                            <span>{{ $berita->created_at->diffForHumans() }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="news-card-modern" data-aos="fade-right">
                                <div class="news-image-modern">
                                    <img src="{{ asset('images/default-news.jpg') }}" alt="Sample News">
                                    <div class="news-date-modern">
                                        <span class="date-day">15</span>
                                        <span class="date-month">Dec</span>
                                    </div>
                                </div>
                                <div class="news-content-modern">
                                    <h6 class="news-title-modern">Welcome to Our Tourism Platform</h6>
                                    <p class="news-excerpt-modern">Discover amazing destinations and experiences with our
                                        comprehensive tourism services.</p>
                                    <div class="news-meta-modern">
                                        <span class="news-author">Admin</span>
                                        <span>2 days ago</span>
                                    </div>
                                </div>
                            </div>
                            <div class="news-card-modern" data-aos="fade-right" data-aos-delay="100">
                                <div class="news-image-modern">
                                    <img src="{{ asset('images/default-news.jpg') }}" alt="Sample News">
                                    <div class="news-date-modern">
                                        <span class="date-day">12</span>
                                        <span class="date-month">Dec</span>
                                    </div>
                                </div>
                                <div class="news-content-modern">
                                    <h6 class="news-title-modern">Explore Local Culture</h6>
                                    <p class="news-excerpt-modern">Immerse yourself in the rich cultural heritage of our
                                        beautiful destinations.</p>
                                    <div class="news-meta-modern">
                                        <span class="news-author">Admin</span>
                                        <span>5 days ago</span>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="300">
                        @if (isset($beritas) && $beritas->count() > 0)
                            <a href="{{ route('beritas.index') }}" class="btn-view-all-modern">
                                <i class="fas fa-newspaper"></i>
                                <span>View All News</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="#" class="btn-view-all-modern">
                                <i class="fas fa-newspaper"></i>
                                <span>Coming Soon</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>

                </div>

                <!-- Gallery Section -->
                <div class="col-lg-6">
                    <div class="section-header-modern mb-4" data-aos="fade-left">
                        <div class="section-badge-modern">
                            <i class="fas fa-images"></i>
                            <span>Gallery</span>
                        </div>
                        <h3 class="section-title-modern">Visual Journey</h3>
                        <p class="section-subtitle-modern">
                            Explore stunning visuals and capture the beauty of our destination.
                        </p>
                    </div>

                    <div class="gallery-grid-modern">
                        @if (isset($galleries) && $galleries->count() > 0)
                            @foreach ($galleries->take(6) as $gallery)
                                <div class="gallery-item-modern" data-aos="zoom-in"
                                    data-aos-delay="{{ $loop->index * 50 }}">
                                    @if ($gallery->foto)
                                        <img src="{{ asset('storage/' . $gallery->foto) }}" alt="{{ $gallery->judul }}">
                                    @else
                                        <img src="{{ asset('images/default-gallery.jpg') }}"
                                            alt="{{ $gallery->judul }}">
                                    @endif
                                    <div class="gallery-overlay-modern">
                                        <div class="gallery-overlay-content">
                                            <i class="fas fa-search-plus"></i>
                                            <h6>{{ Str::limit($gallery->judul, 30) }}</h6>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="gallery-item-modern" data-aos="zoom-in">
                                <img src="{{ asset('images/default-gallery.jpg') }}" alt="Sample Gallery">
                                <div class="gallery-overlay-modern">
                                    <div class="gallery-overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                        <h6>Beautiful Landscape</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item-modern" data-aos="zoom-in" data-aos-delay="50">
                                <img src="{{ asset('images/default-gallery.jpg') }}" alt="Sample Gallery">
                                <div class="gallery-overlay-modern">
                                    <div class="gallery-overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                        <h6>Cultural Heritage</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item-modern" data-aos="zoom-in" data-aos-delay="100">
                                <img src="{{ asset('images/default-gallery.jpg') }}" alt="Sample Gallery">
                                <div class="gallery-overlay-modern">
                                    <div class="gallery-overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                        <h6>Adventure Tours</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item-modern" data-aos="zoom-in" data-aos-delay="150">
                                <img src="{{ asset('images/default-gallery.jpg') }}" alt="Sample Gallery">
                                <div class="gallery-overlay-modern">
                                    <div class="gallery-overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                        <h6>Local Cuisine</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item-modern" data-aos="zoom-in" data-aos-delay="200">
                                <img src="{{ asset('images/default-gallery.jpg') }}" alt="Sample Gallery">
                                <div class="gallery-overlay-modern">
                                    <div class="gallery-overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                        <h6>Natural Wonders</h6>
                                    </div>
                                </div>
                            </div>
                            <div class="gallery-item-modern" data-aos="zoom-in" data-aos-delay="250">
                                <img src="{{ asset('images/default-gallery.jpg') }}" alt="Sample Gallery">
                                <div class="gallery-overlay-modern">
                                    <div class="gallery-overlay-content">
                                        <i class="fas fa-search-plus"></i>
                                        <h6>Traditional Arts</h6>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>


                    <div class="text-center mt-4" data-aos="fade-up" data-aos-delay="300">
                        @if (isset($galleries) && $galleries->count() > 0)
                            <a href="{{ route('galeri.index') }}" class="btn-view-all-modern">
                                <i class="fas fa-images"></i>
                                <span>View All Gallery</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @else
                            <a href="#" class="btn-view-all-modern">
                                <i class="fas fa-images"></i>
                                <span>Coming Soon</span>
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @endif
                    </div>

                </div>
            </div>
        </div>
    </section>

    <!-- 7. TESTIMONIALS SECTION -->
    <section class="testimonials-section-modern py-5 bg-light">
        <div class="container">
            <div class="section-header-modern text-center mb-5" data-aos="fade-up">
                <div class="section-badge-modern">
                    <i class="fas fa-quote-left"></i>
                    <span>Testimonials</span>
                </div>
                <h2 class="section-title-modern">What Our Visitors Say</h2>
                <p class="section-subtitle-modern">
                    Read authentic reviews from travelers who have experienced the magic of Air Terjun Lubuk Hitam.
                </p>
            </div>

            <div class="testimonials-carousel-modern" data-aos="fade-up" data-aos-delay="200">
                <div class="row g-4">
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-card-modern">
                            <div class="testimonial-rating-modern">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="testimonial-text-modern">
                                "An absolutely breathtaking experience! The waterfall is stunning and the guides were
                                incredibly knowledgeable.
                                This place exceeded all my expectations."
                            </p>
                            <div class="testimonial-author-modern">
                                <div class="author-avatar-modern">
                                    <img src="{{ asset('images/avatar1.jpg') }}" alt="Sarah Johnson">
                                </div>
                                <div class="author-info-modern">
                                    <h6>Sarah Johnson</h6>
                                    <span>Travel Blogger</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-card-modern">
                            <div class="testimonial-rating-modern">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="testimonial-text-modern">
                                "Perfect for families! The facilities are excellent and the staff is very friendly.
                                My kids loved every moment of our adventure here."
                            </p>
                            <div class="testimonial-author-modern">
                                <div class="author-avatar-modern">
                                    <img src="{{ asset('images/avatar2.jpg') }}" alt="Michael Chen">
                                </div>
                                <div class="author-info-modern">
                                    <h6>Michael Chen</h6>
                                    <span>Family Traveler</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="testimonial-card-modern">
                            <div class="testimonial-rating-modern">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <p class="testimonial-text-modern">
                                "The natural beauty here is unmatched. Great for photography and the local honey is amazing!
                                Will definitely come back again."
                            </p>
                            <div class="testimonial-author-modern">
                                <div class="author-avatar-modern">
                                    <img src="{{ asset('images/avatar3.jpg') }}" alt="Emma Rodriguez">
                                </div>
                                <div class="author-info-modern">
                                    <h6>Emma Rodriguez</h6>
                                    <span>Nature Photographer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 8. CTA SECTION -->
    <section class="cta-section-modern py-5">
        <div class="container">
            <div class="cta-content-modern text-center" data-aos="zoom-in">
                <div class="cta-icon-modern">
                    <i class="fas fa-mountain"></i>
                </div>
                <h2 class="cta-title-modern">Ready for Your Adventure?</h2>
                <p class="cta-description-modern">
                    Join thousands of satisfied visitors who have discovered the magic of Air Terjun Lubuk Hitam.
                    Book your unforgettable experience today!
                </p>
                <div class="cta-actions-modern">
                    <a href="{{ route('register') }}" class="btn-cta-primary">
                        <i class="fas fa-user-plus"></i>
                        Get Started Now
                    </a>
                    <a href="{{ route('login') }}" class="btn-cta-secondary">
                        <i class="fas fa-sign-in-alt"></i>
                        Sign In
                    </a>
                </div>
                <div class="cta-features-modern">
                    <div class="cta-feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Instant Booking</span>
                    </div>
                    <div class="cta-feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>Best Price Guarantee</span>
                    </div>
                    <div class="cta-feature-item">
                        <i class="fas fa-check-circle"></i>
                        <span>24/7 Support</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('layouts.footer')

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });

        // Counter Animation
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number-modern[data-count]');

            counters.forEach(counter => {
                const target = parseInt(counter.getAttribute('data-count'));
                const increment = target / 50;
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 30);
            });
        }

        // Intersection Observer for counter animation
        const observerOptions = {
            threshold: 0.5,
            rootMargin: '0px 0px -100px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const counters = entry.target.querySelectorAll('.stat-number-modern[data-count]');
                    if (counters.length > 0 && !entry.target.classList.contains('animated')) {
                        entry.target.classList.add('animated');
                        animateCounters();
                    }
                }
            });
        }, observerOptions);

        // Observe hero stats section
        document.addEventListener('DOMContentLoaded', function() {
            const heroStats = document.querySelector('.hero-stats-modern');
            if (heroStats) {
                observer.observe(heroStats);
            }

            // Smooth scrolling for anchor links
            document.querySelectorAll('a[href^="#"]').forEach(anchor => {
                anchor.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            });

            // Parallax effect for hero section
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const parallax = document.querySelector('.hero-section-modern');
                const speed = scrolled * 0.5;

                if (parallax) {
                    parallax.style.transform = `translateY(${speed}px)`;
                }
            });

            // Floating animation for hero cards
            const floatingCards = document.querySelectorAll('.hero-floating-card');
            floatingCards.forEach(card => {
                setInterval(() => {
                    card.style.transform = `translateY(${Math.sin(Date.now() * 0.001) * 10}px)`;
                }, 16);
            });

            // Gallery item hover effects
            const galleryItems = document.querySelectorAll('.gallery-item-modern');
            galleryItems.forEach(item => {
                item.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.05)';
                });

                item.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1)';
                });
            });

            // Testimonial card animations
            const testimonialCards = document.querySelectorAll('.testimonial-card-modern');
            testimonialCards.forEach((card, index) => {
                card.style.animationDelay = `${index * 0.2}s`;
            });
        });

        // Particle animation for hero background
        function createParticles() {
            const particlesContainer = document.querySelector('.hero-particles');
            if (!particlesContainer) return;

            for (let i = 0; i < 50; i++) {
                const particle = document.createElement('div');
                particle.className = 'particle';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDelay = Math.random() * 20 + 's';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                particlesContainer.appendChild(particle);
            }
        }

        // Initialize particles when page loads
        window.addEventListener('load', createParticles);
    </script>
@endsection

@section('styles')
    <style>
        /* === GLOBAL STYLES === */
        :root {
            --primary-color: #2563eb;
            --secondary-color: #f59e0b;
            --accent-color: #10b981;
            --dark-color: #1f2937;
            --light-color: #f8fafc;
            --text-color: #374151;
            --text-muted: #6b7280;
            --border-color: #e5e7eb;
            --shadow-light: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            --shadow-heavy: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            --gradient-primary: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --gradient-secondary: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --gradient-accent: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            overflow-x: hidden;
        }

        /* === HERO SECTION === */
        .hero-section-modern {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            position: relative;
            display: flex;
            align-items: center;
            overflow: hidden;
        }

        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }

        .particle {
            position: absolute;
            width: 4px;
            height: 4px;
            background: rgba(255, 255, 255, 0.5);
            border-radius: 50%;
            animation: float 15s infinite linear;
        }

        @keyframes float {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        .hero-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.3);
            z-index: 2;
        }

        .hero-content-left,
        .hero-content-right {
            position: relative;
            z-index: 3;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.5rem 1rem;
            border-radius: 50px;
            color: white;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .hero-title-modern {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2.5rem, 5vw, 4rem);
            font-weight: 800;
            color: white;
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .gradient-text {
            background: linear-gradient(45deg, #fbbf24, #f59e0b);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-description-modern {
            font-size: 1.125rem;
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.7;
            margin-bottom: 2rem;
            max-width: 500px;
        }

        .hero-actions-modern {
            display: flex;
            gap: 1rem;
            margin-bottom: 3rem;
            flex-wrap: wrap;
        }

        .btn-hero-primary,
        .btn-hero-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-hero-primary {
            background: var(--gradient-secondary);
            color: white;
            box-shadow: var(--shadow-medium);
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-heavy);
            color: white;
        }

        .btn-hero-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-hero-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-3px);
        }

        .hero-stats-modern {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .stat-item-modern {
            text-align: center;
        }

        .stat-number-modern {
            display: block;
            font-size: 2rem;
            font-weight: 800;
            color: white;
            font-family: 'Playfair Display', serif;
        }

        .stat-label-modern {
            font-size: 0.875rem;
            color: rgba(255, 255, 255, 0.8);
            font-weight: 500;
        }

        .hero-image-wrapper {
            position: relative;
            height: 600px;
            border-radius: 20px;
            overflow: hidden;
        }

        .hero-main-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 20px;
            box-shadow: var(--shadow-heavy);
        }

        .hero-floating-card {
            position: absolute;
            bottom: 2rem;
            left: 2rem;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow-medium);
            max-width: 250px;
        }

        .floating-card-content {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .floating-card-icon {
            width: 50px;
            height: 50px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
        }

        .floating-card-text h6 {
            margin: 0;
            font-weight: 600;
            color: var(--dark-color);
        }

        .floating-card-text p {
            margin: 0;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .scroll-indicator-modern {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
        }

        .scroll-arrow-modern {
            width: 30px;
            height: 30px;
            border: 2px solid white;
            border-top: none;
            border-left: none;
            transform: rotate(45deg);
            animation: bounce 2s infinite;
        }

        @keyframes bounce {

            0%,
            20%,
            50%,
            80%,
            100% {
                transform: translateY(0) rotate(45deg);
            }

            40% {
                transform: translateY(-10px) rotate(45deg);
            }

            60% {
                transform: translateY(-5px) rotate(45deg);
            }
        }

        /* === SECTION HEADERS === */
        .section-header-modern {
            margin-bottom: 3rem;
        }

        .section-badge-modern {
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

        .section-title-modern {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .section-subtitle-modern {
            font-size: 1.125rem;
            color: var(--text-muted);
            line-height: 1.7;
            max-width: 600px;
            margin: 0 auto;
        }

        /* === EXPLORE SECTION === */
        .explore-section-modern {
            padding: 5rem 0;
            background: var(--light-color);
        }

        .explore-main-card {
            height: 100%;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
        }

        .explore-main-image {
            height: 500px;
            position: relative;
            overflow: hidden;
            border-radius: 20px;
        }

        .explore-main-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .explore-main-card:hover .explore-main-image img {
            transform: scale(1.1);
        }

        .explore-main-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.3));
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .explore-main-card:hover .explore-main-overlay {
            opacity: 1;
        }

        .explore-main-content {
            text-align: center;
            color: white;
            padding: 2rem;
        }

        .explore-main-content h3 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .explore-main-content p {
            font-size: 1.125rem;
            margin-bottom: 1.5rem;
            opacity: 0.9;
        }

        .btn-explore-main {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gradient-secondary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-explore-main:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            color: white;
        }

        .explore-sub-card {
            height: 150px;
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .explore-sub-card:hover {
            transform: translateY(-5px);
        }

        .explore-sub-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .explore-sub-card:hover img {
            transform: scale(1.1);
        }

        .explore-sub-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            background: linear-gradient(transparent, rgba(0, 0, 0, 0.8));
            color: white;
            padding: 1rem;
        }

        .explore-sub-overlay h5 {
            font-size: 1rem;
            font-weight: 600;
            margin-bottom: 0.25rem;
        }

        .explore-sub-overlay p {
            font-size: 0.875rem;
            margin: 0;
            opacity: 0.9;
        }

        /* === FACILITIES SECTION === */
        .facilities-section-modern {
            padding: 5rem 0;
        }

        .facility-card-modern {
            background: white;
            padding: 2.5rem 2rem;
            border-radius: 20px;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .facility-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-medium);
        }

        .facility-icon-modern {
            width: 80px;
            height: 80px;
            background: var(--gradient-primary);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            color: white;
        }

        .facility-title-modern {
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .facility-description-modern {
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 1.5rem;
        }

        .facility-features {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .feature-tag {
            background: var(--gradient-accent);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* === TOUR GUIDE SECTION === */
        .tourguide-section-modern {
            padding: 5rem 0;
            background: var(--light-color);
        }

        .guide-card-modern {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
            height: 100%;
        }

        .guide-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-medium);
        }

        .guide-image-wrapper-modern {
            position: relative;
            height: 250px;
            overflow: hidden;
        }

        .guide-image-modern {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .guide-card-modern:hover .guide-image-modern {
            transform: scale(1.1);
        }

        .guide-overlay-modern {
            position: absolute;
            top: 1rem;
            right: 1rem;
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .guide-rating-modern,
        .guide-status-modern {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            padding: 0.5rem 0.75rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .guide-rating-modern {
            color: var(--secondary-color);
        }

        .guide-status-modern {
            color: var(--accent-color);
        }

        .guide-status-modern i {
            font-size: 0.5rem;
            animation: pulse 2s infinite;
        }

        .guide-content-modern {
            padding: 1.5rem;
        }

        .guide-name-modern {
            font-family: 'Playfair Display', serif;
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 1rem;
        }

        .guide-details-modern {
            margin-bottom: 1rem;
        }

        .guide-detail-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        .guide-detail-item i {
            width: 16px;
            color: var(--primary-color);
        }

        .guide-price-modern {
            background: var(--light-color);
            padding: 0.75rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            text-align: center;
        }

        .price-label {
            display: block;
            font-size: 0.75rem;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .price-value {
            font-size: 1.125rem;
            font-weight: 700;
            color: var(--primary-color);
        }

        .guide-skills-modern {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .skill-tag {
            background: var(--gradient-primary);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        /* === PRODUCTS SECTION === */
        .products-section-modern {
            padding: 5rem 0;
        }

        .product-category-card-modern {
            height: 400px;
            border-radius: 20px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
        }

        .product-category-card-modern:hover {
            transform: translateY(-10px);
        }

        .product-category-image {
            height: 100%;
            position: relative;
            overflow: hidden;
        }

        .product-category-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .product-category-card-modern:hover .product-category-image img {
            transform: scale(1.1);
        }

        .product-category-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.4));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            padding: 2rem;
        }

        .product-category-icon {
            width: 80px;
            height: 80px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            font-size: 2rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .product-category-content h4 {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .product-category-content p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
            opacity: 0.9;
            line-height: 1.6;
        }

        .product-features-modern {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            flex-wrap: wrap;
            margin-bottom: 1.5rem;
        }

        .product-feature {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 500;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-product-category {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gradient-secondary);
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-product-category:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            color: white;
        }

        .product-highlights-modern {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: var(--shadow-light);
        }

        .highlight-item-modern {
            text-align: center;
            padding: 1rem;
        }

        .highlight-icon-modern {
            width: 60px;
            height: 60px;
            background: var(--gradient-accent);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
            color: white;
        }

        .highlight-item-modern h6 {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .highlight-item-modern p {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin: 0;
        }

        /* === NEWS & GALLERY SECTION === */
        .news-gallery-section-modern {
            padding: 5rem 0;
            background: var(--light-color);
        }

        .news-cards-modern {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .news-card-modern {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
        }

        .news-card-modern:hover {
            transform: translateX(10px);
            box-shadow: var(--shadow-medium);
        }

        .news-image-modern {
            position: relative;
            width: 100px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .news-image-modern img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .news-date-modern {
            position: absolute;
            top: 0.5rem;
            right: 0.5rem;
            background: var(--gradient-primary);
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 8px;
            font-size: 0.75rem;
            font-weight: 600;
            text-align: center;
            line-height: 1.2;
        }

        .date-day {
            display: block;
            font-size: 0.875rem;
        }

        .date-month {
            display: block;
            font-size: 0.625rem;
            opacity: 0.8;
        }

        .news-content-modern {
            flex: 1;
        }

        .news-title-modern {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
            font-size: 1rem;
            line-height: 1.4;
        }

        .news-excerpt-modern {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            line-height: 1.5;
        }

        .news-meta-modern {
            display: flex;
            gap: 1rem;
            font-size: 0.75rem;
            color: var(--text-muted);
        }

        .news-author {
            font-weight: 500;
        }

        .gallery-grid-modern {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1rem;
            height: 400px;
        }

        .gallery-item-modern {
            border-radius: 15px;
            overflow: hidden;
            position: relative;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .gallery-item-modern:nth-child(1) {
            grid-row: span 2;
        }

        .gallery-item-modern:nth-child(4) {
            grid-row: span 2;
        }

        .gallery-item-modern img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .gallery-item-modern:hover img {
            transform: scale(1.1);
        }

        .gallery-overlay-modern {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            color: white;
            text-align: center;
        }

        .gallery-item-modern:hover .gallery-overlay-modern {
            opacity: 1;
        }

        .gallery-overlay-content i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .gallery-overlay-content h6 {
            font-weight: 600;
            margin: 0;
        }

        /* === TESTIMONIALS SECTION === */
        .testimonials-section-modern {
            padding: 5rem 0;
        }

        .testimonial-card-modern {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: var(--shadow-light);
            transition: all 0.3s ease;
            height: 100%;
            text-align: center;
            border: 1px solid var(--border-color);
        }

        .testimonial-card-modern:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-medium);
        }

        .testimonial-rating-modern {
            color: var(--secondary-color);
            margin-bottom: 1.5rem;
            font-size: 1.25rem;
        }

        .testimonial-text-modern {
            font-style: italic;
            color: var(--text-muted);
            line-height: 1.7;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .testimonial-author-modern {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
        }

        .author-avatar-modern {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--border-color);
        }

        .author-avatar-modern img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-info-modern h6 {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.25rem;
        }

        .author-info-modern span {
            font-size: 0.875rem;
            color: var(--text-muted);
        }

        /* === CTA SECTION === */
        .cta-section-modern {
            padding: 5rem 0;
            background: var(--gradient-primary);
            color: white;
            text-align: center;
        }

        .cta-content-modern {
            max-width: 800px;
            margin: 0 auto;
        }

        .cta-icon-modern {
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 3rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
        }

        .cta-title-modern {
            font-family: 'Playfair Display', serif;
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
            line-height: 1.3;
        }

        .cta-description-modern {
            font-size: 1.125rem;
            line-height: 1.7;
            margin-bottom: 2.5rem;
            opacity: 0.9;
        }

        .cta-actions-modern {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-bottom: 2.5rem;
            flex-wrap: wrap;
        }

        .btn-cta-primary,
        .btn-cta-secondary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-cta-primary {
            background: white;
            color: var(--primary-color);
            box-shadow: var(--shadow-medium);
        }

        .btn-cta-primary:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-heavy);
            color: var(--primary-color);
        }

        .btn-cta-secondary {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
        }

        .btn-cta-secondary:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
            transform: translateY(-3px);
        }

        .cta-features-modern {
            display: flex;
            gap: 2rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .cta-feature-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .cta-feature-item i {
            color: var(--accent-color);
        }

        /* === VIEW ALL BUTTONS === */
        .btn-view-all-modern {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--gradient-primary);
            color: white;
            padding: 1rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
        }

        .btn-view-all-modern:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            color: white;
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 1200px) {
            .hero-content-left {
                padding-right: 2rem;
            }

            .hero-image-wrapper {
                height: 500px;
            }
        }

        @media (max-width: 992px) {
            .hero-section-modern {
                min-height: auto;
                padding: 5rem 0;
            }

            .hero-content-right {
                margin-top: 3rem;
            }

            .hero-image-wrapper {
                height: 400px;
            }

            .hero-floating-card {
                position: static;
                margin-top: 1rem;
                max-width: none;
            }

            .gallery-grid-modern {
                grid-template-columns: repeat(2, 1fr);
                height: 300px;
            }

            .explore-main-image {
                height: 300px;
            }

            .explore-sub-card {
                height: 120px;
            }
        }

        @media (max-width: 768px) {
            .hero-title-modern {
                font-size: 2.5rem;
            }

            .hero-actions-modern {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-stats-modern {
                justify-content: center;
                gap: 1rem;
            }

            .section-title-modern {
                font-size: 2rem;
            }

            .facility-card-modern,
            .testimonial-card-modern {
                padding: 2rem 1.5rem;
            }

            .gallery-grid-modern {
                grid-template-columns: 1fr;
                height: auto;
                gap: 0.5rem;
            }

            .gallery-item-modern {
                height: 200px;
            }

            .gallery-item-modern:nth-child(1),
            .gallery-item-modern:nth-child(4) {
                grid-row: span 1;
            }

            .news-card-modern {
                flex-direction: column;
                text-align: center;
            }

            .news-image-modern {
                width: 100%;
                height: 150px;
            }

            .cta-actions-modern {
                flex-direction: column;
                align-items: stretch;
            }

            .cta-features-modern {
                flex-direction: column;
                align-items: center;
                gap: 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section-modern {
                padding: 3rem 0;
            }

            .hero-title-modern {
                font-size: 2rem;
            }

            .hero-description-modern {
                font-size: 1rem;
            }

            .section-header-modern {
                margin-bottom: 2rem;
            }

            .section-title-modern {
                font-size: 1.75rem;
            }

            .section-subtitle-modern {
                font-size: 1rem;
            }

            .facility-card-modern,
            .testimonial-card-modern {
                padding: 1.5rem 1rem;
            }

            .facility-icon-modern {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .facility-title-modern {
                font-size: 1.25rem;
            }

            .guide-content-modern {
                padding: 1rem;
            }

            .product-category-card-modern {
                height: 300px;
            }

            .product-category-content {
                padding: 1.5rem;
            }

            .product-category-content h4 {
                font-size: 1.5rem;
            }

            .testimonial-card-modern {
                padding: 1.5rem;
            }

            .cta-icon-modern {
                width: 80px;
                height: 80px;
                font-size: 2rem;
            }

            .cta-title-modern {
                font-size: 1.75rem;
            }

            .cta-description-modern {
                font-size: 1rem;
            }
        }

        /* === ANIMATIONS === */
        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
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

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        /* === ACCESSIBILITY === */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* === DARK MODE SUPPORT === */
        @media (prefers-color-scheme: dark) {
            :root {
                --light-color: #1f2937;
                --text-color: #f9fafb;
                --text-muted: #d1d5db;
                --border-color: #374151;
            }
        }

        /* === PRINT STYLES === */
        @media print {

            .hero-section-modern,
            .cta-section-modern {
                background: white !important;
                color: black !important;
            }

            .btn-hero-primary,
            .btn-hero-secondary,
            .btn-cta-primary,
            .btn-cta-secondary,
            .btn-view-all-modern {
                display: none !important;
            }

            .facility-card-modern,
            .testimonial-card-modern,
            .guide-card-modern {
                break-inside: avoid;
                box-shadow: none !important;
                border: 1px solid #ddd !important;
            }
        }

        /* === CUSTOM SCROLLBAR === */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--light-color);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-color);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #1d4ed8;
        }

        /* === LOADING STATES === */
        .loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid var(--border-color);
            border-top: 2px solid var(--primary-color);
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* === FOCUS STYLES === */
        .btn-hero-primary:focus,
        .btn-hero-secondary:focus,
        .btn-cta-primary:focus,
        .btn-cta-secondary:focus,
        .btn-view-all-modern:focus {
            outline: 2px solid var(--secondary-color);
            outline-offset: 2px;
        }

        /* === HIGH CONTRAST MODE === */
        @media (prefers-contrast: high) {

            .facility-card-modern,
            .testimonial-card-modern,
            .guide-card-modern {
                border: 2px solid var(--dark-color);
            }

            .btn-hero-primary,
            .btn-cta-primary {
                border: 2px solid var(--dark-color);
            }
        }

        /* === TOUCH DEVICE OPTIMIZATIONS === */
        @media (hover: none) and (pointer: coarse) {

            .facility-card-modern:hover,
            .testimonial-card-modern:hover,
            .guide-card-modern:hover {
                transform: none;
            }

            .btn-hero-primary,
            .btn-hero-secondary,
            .btn-cta-primary,
            .btn-cta-secondary {
                min-height: 44px;
                min-width: 44px;
            }
        }

        /* === PERFORMANCE OPTIMIZATIONS === */
        .hero-main-image,
        .explore-main-image img,
        .guide-image-modern,
        .gallery-item-modern img {
            will-change: transform;
        }

        .facility-card-modern,
        .testimonial-card-modern,
        .guide-card-modern {
            will-change: transform, box-shadow;
        }

        /* === SKELETON LOADING === */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        .skeleton-text {
            height: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 4px;
        }

        .skeleton-title {
            height: 1.5rem;
            width: 70%;
            margin-bottom: 1rem;
            border-radius: 4px;
        }

        .skeleton-image {
            height: 200px;
            border-radius: 15px;
        }

        /* === UTILITY CLASSES === */
        .text-gradient {
            background: var(--gradient-primary);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .bg-gradient-primary {
            background: var(--gradient-primary);
        }

        .bg-gradient-secondary {
            background: var(--gradient-secondary);
        }

        .bg-gradient-accent {
            background: var(--gradient-accent);
        }

        .shadow-light {
            box-shadow: var(--shadow-light);
        }

        .shadow-medium {
            box-shadow: var(--shadow-medium);
        }

        .shadow-heavy {
            box-shadow: var(--shadow-heavy);
        }

        .border-radius-modern {
            border-radius: 20px;
        }

        .border-radius-small {
            border-radius: 10px;
        }

        .backdrop-blur {
            backdrop-filter: blur(10px);
        }

        /* === COMPONENT VARIATIONS === */
        .facility-card-modern.featured {
            background: var(--gradient-primary);
            color: white;
        }

        .facility-card-modern.featured .facility-icon-modern {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
        }

        .facility-card-modern.featured .facility-title-modern,
        .facility-card-modern.featured .facility-description-modern {
            color: white;
        }

        .guide-card-modern.premium {
            border: 2px solid var(--secondary-color);
            position: relative;
            overflow: visible;
        }

        .guide-card-modern.premium::before {
            content: 'Premium';
            position: absolute;
            top: -10px;
            left: 20px;
            background: var(--secondary-color);
            color: white;
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.75rem;
            font-weight: 600;
            z-index: 1;
        }

        .testimonial-card-modern.highlighted {
            background: var(--gradient-accent);
            color: white;
        }

        .testimonial-card-modern.highlighted .testimonial-text-modern {
            color: rgba(255, 255, 255, 0.9);
        }

        /* === MICRO-INTERACTIONS === */
        .facility-icon-modern {
            transition: all 0.3s ease;
        }

        .facility-card-modern:hover .facility-icon-modern {
            transform: scale(1.1) rotate(5deg);
        }

        .guide-rating-modern {
            transition: all 0.3s ease;
        }

        .guide-card-modern:hover .guide-rating-modern {
            transform: scale(1.1);
        }

        .testimonial-rating-modern i {
            transition: all 0.2s ease;
        }

        .testimonial-card-modern:hover .testimonial-rating-modern i {
            transform: scale(1.2);
        }

        /* === ADVANCED ANIMATIONS === */
        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-50px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.8);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        @keyframes rotateIn {
            from {
                opacity: 0;
                transform: rotate(-180deg) scale(0.8);
            }

            to {
                opacity: 1;
                transform: rotate(0deg) scale(1);
            }
        }

        /* === ENHANCED HOVER EFFECTS === */
        .facility-card-modern::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
            z-index: 1;
            pointer-events: none;
        }

        .facility-card-modern:hover::before {
            left: 100%;
        }

        .guide-card-modern::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%);
            opacity: 0;
            transition: opacity 0.3s;
            pointer-events: none;
        }

        .guide-card-modern:hover::after {
            opacity: 1;
        }

        /* === FLOATING ELEMENTS === */
        .floating-element {
            animation: float-gentle 6s ease-in-out infinite;
        }

        @keyframes float-gentle {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .floating-element-delayed {
            animation: float-gentle 6s ease-in-out infinite;
            animation-delay: 2s;
        }

        /* === GRADIENT BORDERS === */
        .gradient-border {
            position: relative;
            background: white;
            border-radius: 20px;
        }

        .gradient-border::before {
            content: '';
            position: absolute;
            inset: 0;
            padding: 2px;
            background: var(--gradient-primary);
            border-radius: inherit;
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
        }

        /* === GLASS MORPHISM EFFECTS === */
        .glass-card {
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.37);
        }

        .glass-card-dark {
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.18);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        /* === NEON EFFECTS === */
        .neon-glow {
            box-shadow:
                0 0 5px var(--primary-color),
                0 0 10px var(--primary-color),
                0 0 15px var(--primary-color),
                0 0 20px var(--primary-color);
        }

        .neon-text {
            text-shadow:
                0 0 5px var(--primary-color),
                0 0 10px var(--primary-color),
                0 0 15px var(--primary-color),
                0 0 20px var(--primary-color);
        }

        /* === PARALLAX LAYERS === */
        .parallax-layer {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }

        .parallax-back {
            transform: translateZ(-1px) scale(2);
        }

        .parallax-mid {
            transform: translateZ(-0.5px) scale(1.5);
        }

        .parallax-front {
            transform: translateZ(0);
        }

        /* === CUSTOM PROPERTIES FOR DYNAMIC THEMING === */
        .theme-blue {
            --primary-color: #3b82f6;
            --secondary-color: #f59e0b;
            --accent-color: #10b981;
        }

        .theme-purple {
            --primary-color: #8b5cf6;
            --secondary-color: #f59e0b;
            --accent-color: #06d6a0;
        }

        .theme-green {
            --primary-color: #10b981;
            --secondary-color: #f59e0b;
            --accent-color: #3b82f6;
        }

        /* === ENHANCED RESPONSIVE BREAKPOINTS === */
        @media (max-width: 480px) {
            .hero-badge {
                font-size: 0.75rem;
                padding: 0.375rem 0.75rem;
            }

            .section-badge-modern {
                font-size: 0.75rem;
                padding: 0.375rem 0.75rem;
            }

            .btn-hero-primary,
            .btn-hero-secondary {
                padding: 0.75rem 1.5rem;
                font-size: 0.875rem;
            }

            .facility-icon-modern {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }

            .product-category-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }

        @media (max-width: 360px) {
            .hero-title-modern {
                font-size: 1.75rem;
            }

            .section-title-modern {
                font-size: 1.5rem;
            }

            .facility-card-modern,
            .testimonial-card-modern {
                padding: 1rem 0.75rem;
            }

            .cta-icon-modern {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }
        }
    </style>
@endsection
