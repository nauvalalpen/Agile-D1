@extends('layouts.app')

@section('content')
    {{-- Include AOS (Animate on Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Include Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">PEMANDU<br>WISATA</div>
            <div class="hero-desc"> Jelajahi destinasi menakjubkan bersama pemandu wisata profesional dan berpengalaman yang akan membuat perjalanan Anda tak terlupakan.</div>
            <a href="#tourguides-grid" class="hero-btn">Lihat Pemandu</a>
        </div>
    </section>

    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. MAIN TOUR GUIDES SECTION -->
        <div id="tourguides-grid" class="tourguides-container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-heading">Temui Pemandu Wisata Terbaik Kami</h2>
                <p class="section-subheading">Pemandu lokal yang antusias dan siap berbagi pengetahuan serta menciptakan pengalaman tak terlupakan untuk Anda</p>
            </div>

            <!-- Filter and Search Section -->
            <div class="filter-search-section mb-5" data-aos="fade-up" data-aos-delay="200">
                <div class="row align-items-center g-3">
                    <div class="col-lg-12">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchGuides" placeholder="Cari pemandu berdasarkan nama atau lokasi... ">
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
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
                    </div> --}}
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
                    <div class="guide-card" data-aos="zoom-in" data-aos-delay="{{ ($index % 3) * 150 }}"
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
                                <span class="skill-tag">Tur Alami</span>
                                <span class="skill-tag">Fotografi</span>
                                <span class="skill-tag">Sejarah</span>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="guide-card-footer">
                            <div class="guide-stats">
                                <div class="stat">
                                    <i class="fas fa-users"></i>
                                    <span>127 Tur</span>
                                </div>
                                <div class="stat">
                                    <i class="fas fa-language"></i>
                                    <span>3 Bahasa</span>
                                </div>
                            </div>

                            <div class="guide-actions">
                                <button class="btn-action" id="btn-view-profile"
                                    onclick="viewGuideProfile({{ $tourguide->id }})">
                                    <i class="fas fa-eye"></i>
                                    Lihat Profil
                                </button>
                                @auth
                                    <a href="{{ route('tourguides.order', $tourguide->id) }}" class="btn-action"
                                        id="btn-book-now">
                                        <i class="fas fa-calendar-check"></i>
                                        Pesan Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="btn-action" id="btn-book-now">
                                        <i class="fas fa-sign-in-alt"></i>
                                        Silakan Masuk untuk Memesan
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
                        <h3>Belum Ada Pemandu Wisata Tersedia</h3>
                        <p>Saat ini kami sedang memperbarui daftar pemandu. Silakan kembali lagi nanti!</p>
                        <a href="{{ url('/') }}" class="btn-action btn-primary">
                            <i class="fas fa-home"></i>
                             Kembali ke Beranda
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

        <!-- 3. FEATURES SECTION -->
        <div class="features-section my-5 py-5" data-aos="fade-up">
            <div class="text-center mb-5">
                <h2 class="section-heading">Mengapa Memilih Pemandu Kami?</h2>
                <p class="section-subheading">Layanan profesional dengan keahlian lokal</p>
            </div>
            <div class="row g-4">
                <div class="col-lg-4" data-aos="fade-right" data-aos-delay="200">
                    <div class="feature-card">
                        <div class="feature-icon" id="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h3>Pemandu Terverifikasi</h3>
                        <p>Semua pemandu kami telah diverifikasi secara profesional dan memiliki pengetahuan lokal yang mendalam.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon" id="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Dukungan 24/7</h3>
                        <p>Layanan pelanggan tersedia 24 jam untuk memastikan pengalaman tur Anda berjalan lancar.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="600">
                    <div class="feature-card">
                        <div class="feature-icon" id="feature-icon">
                            <i class="fas fa-money-bill-wave"></i>
                        </div>
                        <h3>Harga Terbaik</h3>
                        <p>Harga bersaing tanpa biaya tersembunyi. Dapatkan nilai terbaik untuk setiap perjalanan Anda.</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. CTA SECTION -->
        <div class="cta-section my-5 py-5" data-aos="fade-up" id="cta-section">
            <div class="cta-content text-center">
                <h2 class="cta-title">Siap untuk Petualangan Selanjutnya?</h2>
                <p class="cta-description">
                     Bergabunglah bersama ribuan wisatawan puas yang telah menjelajahi tempat-tempat menakjubkan bersama pemandu kami.
                </p>
                <a href="#tourguides-grid" class="btn-cta">
                    <i class="fas fa-rocket"></i>
                    Mulai Jelajah
                </a>
            </div>
        </div>

    </div>

    <!-- Guide Profile Modal -->
    <div class="modal fade" id="guideProfileModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Profil Pemandu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="guideProfileContent">
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                        <p>Memuat profil pemandu...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });

        // Tour guides data for JavaScript
        const tourguideData = {!! json_encode(
            $tourguides->map(function ($tourguide) {
                return [
                    'id' => $tourguide->id,
                    'nama' => $tourguide->nama,
                    'nohp' => $tourguide->nohp,
                    'alamat' => $tourguide->alamat,
                    'deskripsi' => $tourguide->deskripsi,
                    'foto' => $tourguide->foto ? asset('storage/' . $tourguide->foto) : null,
                    'price_range' => $tourguide->price_range ?? '500k',
                ];
            }),
        ) !!};

        // Search functionality
        document.addEventListener('DOMContentLoaded', function() {
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

                    toggleEmptyState(visibleCount === 0 && searchTerm !== '');
                });
            }

            // Filter functionality
            const filterButtons = document.querySelectorAll('.filter-btn');

            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const filter = this.dataset.filter;
                    let visibleCount = 0;

                    guideCards.forEach(card => {
                        let isVisible = true;

                        switch (filter) {
                            case 'premium':
                                const price = card.dataset.price || '';
                                isVisible = price.includes('1000k') || price.includes(
                                    '800k');
                                break;
                            case 'available':
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

                    if (searchInput) {
                        searchInput.value = '';
                    }

                    toggleEmptyState(visibleCount === 0);
                });
            });

            // Smooth scrolling for hero button
            const heroBtn = document.querySelector('.hero-btn');
            if (heroBtn) {
                heroBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector('#tourguides-grid');
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

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
                        <button class="btn-dark-custom" onclick="clearFilters()">
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
                if (searchInput) {
                    searchInput.value = '';
                }

                filterButtons.forEach(btn => btn.classList.remove('active'));
                document.querySelector('.filter-btn[data-filter="all"]').classList.add('active');

                guideCards.forEach(card => {
                    card.style.display = 'block';
                    card.style.animation = 'fadeInUp 0.6s ease-out';
                });

                toggleEmptyState(false);
            };

            // Guide profile modal functionality
            window.viewGuideProfile = function(guideId) {
                const modal = new bootstrap.Modal(document.getElementById('guideProfileModal'));
                const modalContent = document.getElementById('guideProfileContent');

                modalContent.innerHTML = `
                    <div class="loading-spinner">
                        <div class="spinner"></div>
                        <p>Loading guide profile...</p>
                    </div>
                `;

                modal.show();

                // Find guide data
                const guide = tourguideData.find(g => g.id === guideId);

                setTimeout(() => {
                    if (guide) {
                        modalContent.innerHTML = `
                            <div class="guide-profile-content">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="profile-image-wrapper">
                                            ${guide.foto ? 
                                                `<img src="${guide.foto}" alt="${guide.nama}" class="img-fluid rounded">` :
                                                `<div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 200px;">
                                                                                                                                                                    <i class="fas fa-user fa-3x text-muted"></i>
                                                                                                                                                                </div>`
                                            }
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <h3>${guide.nama}</h3>
                                        <div class="profile-details">
                                            <p><strong>Phone:</strong> ${guide.nohp}</p>
                                            <p><strong>Location:</strong> ${guide.alamat}</p>
                                            <p><strong>Price Range:</strong> ${guide.price_range}</p>
                                            <p><strong>Experience:</strong> 5+ years</p>
                                            <p><strong>Languages:</strong> English, Indonesian</p>
                                            <p><strong>Rating:</strong> ⭐⭐⭐⭐⭐ (4.8/5)</p>
                                        </div>
                                        <div class="profile-description">
                                            <h5>About</h5>
                                            <p>${guide.deskripsi}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        `;
                    }
                }, 1000);
            };

            // Add hover effects to guide cards
            document.querySelectorAll('.guide-card').forEach(function(card) {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });
    </script>

    @include('layouts.footer')
@endsection

@section('styles')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* === 1. HERO SECTION (MATCHING GALERI.BLADE.PHP) === */
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

        /* === UTILITY & HEADINGS === */
        .section-heading {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 2.5rem;
            color: #212529;
        }

        .section-subheading {
            font-size: 1.1rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
        }

        /* === 2. MAIN TOUR GUIDES SECTION (MATCHING GALERI LAYOUT) === */
        .tourguides-container {
            margin-top: -80px;
            position: relative;
            z-index: 2;
            background: #f8f9fa;
            padding: 4rem 2rem;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        /* === FILTER & SEARCH SECTION === */
        .filter-search-section {
            background: #fff;
            padding: 2rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            border: none;
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
            color: #6c757d;
            z-index: 2;
        }

        .search-box input {
            width: 100%;
            padding: 1rem 1rem 1rem 3rem;
            border: 2px solid #e9ecef;
            border-radius: 50px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }

        .search-box input:focus {
            outline: none;
            border-color: #212529;
            box-shadow: 0 0 0 3px rgba(33, 37, 41, 0.1);
            background: white;
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
            border: 2px solid #e9ecef;
            background: white;
            color: #6c757d;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s ease;
            cursor: pointer;
            font-size: 0.9rem;
        }

        .filter-btn:hover,
        .filter-btn.active {
            background: #212529;
            color: white;
            border-color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* === GUIDES GRID === */
        .guides-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
            margin-bottom: 4rem;
        }

        .guide-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .guide-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .guide-card-header {
            position: relative;
            height: 250px;
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
            transition: transform 0.4s ease;
        }

        .guide-card:hover .guide-image {
            transform: scale(1.05);
        }

        .guide-image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #212529;
            font-size: 0.9rem;
        }

        .guide-rating i {
            color: #ffc107;
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
            color: #28a745;
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
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            font-size: 0.9rem;
        }

        .guide-card-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .guide-info {
            margin-bottom: 1rem;
        }

        .guide-name {
            font-size: 1.25rem;
            font-weight: 700;
            color: #212529;
            margin-bottom: 0.75rem;
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
            color: #6c757d;
            font-size: 0.875rem;
        }

        .detail-item i {
            width: 16px;
            color: #212529;
        }

        .guide-description {
            margin-bottom: 1rem;
            flex-grow: 1;
        }

        .guide-description p {
            color: #6c757d;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        .guide-skills {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .skill-tag {
            background: #f8f9fa;
            color: #212529;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            border: 1px solid #e9ec
        }

        .guide-card-footer {
            padding: 0 1.5rem 1.5rem;
            margin-top: auto;
        }

        .guide-stats {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 10px;
        }

        .stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.875rem;
            color: #6c757d;
        }

        .stat i {
            color: #212529;
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
            padding: 0.75rem 1rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 0.875rem;
            border: none;
            cursor: pointer;
            text-align: center;
        }

        .btn-action.btn-primary {
            background: #212529;
            color: white;
        }

        .btn-action.btn-primary:hover {
            background: #000;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: white;
        }

        .btn-action.btn-secondary {
            background: white;
            color: #6c757d;
            border: 2px solid #e9ecef;
        }

        .btn-action.btn-secondary:hover {
            background: #f8f9fa;
            color: #212529;
            transform: translateY(-2px);
            border-color: #212529;
        }

        /* === UNIFIED BUTTON STYLES (MATCHING GALERI) === */
        .btn-dark-custom {
            padding: 12px 35px;
            background-color: #212529;
            color: #fff;
            border: 2px solid #212529;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .btn-dark-custom:hover {
            background-color: #fff;
            color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* === EMPTY STATE === */
        .empty-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 15px;
            border: 2px dashed #e9ecef;
        }

        .empty-icon {
            width: 120px;
            height: 120px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
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
            color: #212529;
            margin-bottom: 1rem;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 2rem;
        }

        /* === 3. FEATURES SECTION === */
        .features-section {
            background: white;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .feature-card {
            background: #f8f9fa;
            padding: 2rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            height: 100%;
            border: 1px solid #e9ecef;
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            background: white;
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #212529, #495057);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 2rem;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1rem;
            color: #212529;
        }

        .feature-card p {
            color: #6c757d;
            line-height: 1.6;
            font-size: 0.95rem;
        }

        /* === 4. CTA SECTION === */
        .cta-section {
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            /* color: #006400; */
            border-radius: 20px;
            color: white;
        }

        .cta-content {
            padding: 3rem 2rem;
        }

        .cta-title {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-description {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: white;
            color: #212529;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            font-size: 1rem;
        }

        .btn-cta:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(255, 255, 255, 0.2);
            color: #212529;
        }

        /* === PAGINATION === */
        .pagination-wrapper {
            display: flex;
            justify-content: center;
            margin-top: 3rem;
        }

        /* === MODAL STYLES === */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid #e9ecef;
            padding: 1.5rem;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .loading-spinner {
            text-align: center;
            padding: 3rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e9ecef;
            border-top: 4px solid #212529;
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

        .guide-profile-content .profile-details p {
            margin-bottom: 0.5rem;
            color: #6c757d;
        }

        .guide-profile-content .profile-description h5 {
            color: #212529;
            margin-bottom: 1rem;
            margin-top: 1.5rem;
        }

        /* === ALERT STYLES === */
        .alert-modern {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 1200px) {
            .guides-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
                letter-spacing: 0.2rem;
            }

            .hero-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .tourguides-container {
                margin-top: -40px;
                padding: 2rem 1rem;
            }

            .filter-search-section {
                padding: 1.5rem;
            }

            .filter-buttons {
                justify-content: center;
                margin-top: 1rem;
            }

            .filter-btn {
                flex: 1;
                justify-content: center;
                min-width: 100px;
                font-size: 0.8rem;
                padding: 0.6rem 1rem;
            }

            .guides-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .guide-card-header {
                height: 220px;
            }

            .guide-card-body {
                padding: 1.25rem;
            }

            .guide-card-footer {
                padding: 0 1.25rem 1.25rem;
            }

            .guide-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .features-section {
                padding: 2rem;
            }

            .feature-card {
                padding: 1.5rem;
            }

            .cta-content {
                padding: 2.5rem 1.5rem;
            }

            .cta-title {
                font-size: 1.75rem;
            }

            .section-heading {
                font-size: 2rem;
            }

            .section-subheading {
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                height: 70vh;
                min-height: 400px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .hero-desc {
                font-size: 14px;
            }

            .guides-grid {
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

            .filter-search-section {
                padding: 1rem;
            }

            .search-box input {
                padding: 0.875rem 0.875rem 0.875rem 2.5rem;
            }

            .filter-buttons {
                gap: 0.25rem;
            }

            .filter-btn {
                padding: 0.5rem 0.75rem;
                font-size: 0.75rem;
            }

            .section-heading {
                font-size: 1.75rem;
            }

            .btn-action {
                padding: 0.6rem 0.875rem;
                font-size: 0.8rem;
            }

            .cta-title {
                font-size: 1.5rem;
            }

            .cta-description {
                font-size: 1rem;
            }

            .feature-icon {
                width: 60px;
                height: 60px;
                font-size: 1.5rem;
            }

            .feature-card h3 {
                font-size: 1.1rem;
            }

            .feature-card p {
                font-size: 0.9rem;
            }
        }

        /* === ANIMATION ENHANCEMENTS === */
        .guide-card {
            animation: fadeInUp 0.6s ease-out;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === ACCESSIBILITY IMPROVEMENTS === */
        .btn-action:focus,
        .filter-btn:focus,
        .search-box input:focus,
        .btn-dark-custom:focus {
            outline: 2px solid #212529;
            outline-offset: 2px;
        }

        /* === PERFORMANCE OPTIMIZATIONS === */
        .guide-image {
            will-change: transform;
        }

        .guide-card {
            will-change: transform, box-shadow;
        }

        /* === PRINT STYLES === */
        @media print {

            .hero-section,
            .cta-section,
            .filter-search-section {
                display: none;
            }

            .guide-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ccc;
            }
        }

        /* === SMOOTH TRANSITIONS === */
        * {
            transition: transform 0.3s ease, box-shadow 0.3s ease, background-color 0.3s ease;
        }

        /* === LOADING STATES === */
        .btn-action.loading {
            opacity: 0.7;
            pointer-events: none;
        }

        .btn-action.loading::after {
            content: '';
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 0.5rem;
        }

        /* === ADDITIONAL IMPROVEMENTS === */
        .guide-card-body {
            min-height: 200px;
        }

        .guide-name {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .guide-description p {
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* === HOVER EFFECTS === */
        .guide-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(33, 37, 41, 0.05), rgba(73, 80, 87, 0.05));
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 15px;
            z-index: 1;
        }

        .guide-card:hover::before {
            opacity: 1;
        }

        .guide-card>* {
            position: relative;
            z-index: 2;
        }

        /* === SKELETON LOADING === */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .skeleton-card {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .skeleton-header {
            height: 250px;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .skeleton-title {
            height: 20px;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }

        .skeleton-text {
            height: 16px;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }

        .skeleton-text.short {
            width: 60%;
        }

        /* === NOTIFICATION STYLES === */
        .notification {
            position: fixed;
            top: 100px;
            right: 20px;
            z-index: 1050;
            min-width: 300px;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            animation: slideInRight 0.3s ease-out;
        }

        .notification-success {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            color: #065f46;
            border-left: 4px solid #10b981;
        }

        .notification-warning {
            background: linear-gradient(135deg, #fef3c7, #fde68a);
            color: #92400e;
            border-left: 4px solid #f59e0b;
        }

        .notification-info {
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            color: #1e40af;
            border-left: 4px solid #3b82f6;
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

        @keyframes slideOutRight {
            from {
                transform: translateX(0);
                opacity: 1;
            }

            to {
                transform: translateX(100%);
                opacity: 0;
            }
        }

        /* === SKIP LINK === */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 6px;
            background: #212529;
            color: white;
            padding: 8px;
            text-decoration: none;
            border-radius: 4px;
            z-index: 1000;
            transition: top 0.3s;
        }

        .skip-link:focus {
            top: 6px;
        }

        /* === MOBILE OPTIMIZATIONS === */
        @media (max-width: 480px) {
            .hero-content {
                padding-left: 20px;
                padding-right: 20px;
            }

            .hero-title {
                font-size: 2rem;
                letter-spacing: 0.1rem;
            }

            .tourguides-container {
                margin-top: -30px;
                padding: 1.5rem 0.5rem;
            }

            .filter-search-section {
                padding: 1rem;
                margin: 0 -0.5rem;
            }

            .search-box input {
                font-size: 16px;
                /* Prevents zoom on iOS */
            }

            .guide-card {
                margin: 0 0.5rem;
            }

            .features-section,
            .cta-section {
                margin: 0 -0.5rem;
                border-radius: 15px;
            }

            .btn-action {
                min-height: 44px;
                /* Touch target size */
            }

            .filter-btn {
                min-height: 44px;
            }
        }

        /* === HIGH CONTRAST MODE === */
        @media (prefers-contrast: high) {
            .guide-card {
                border: 2px solid #000;
            }

            .btn-action.btn-primary {
                background: #000;
                border: 2px solid #000;
            }

            .btn-action.btn-secondary {
                border: 2px solid #000;
            }
        }

        /* === REDUCED MOTION === */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .guide-card:hover {
                transform: none;
            }

            .btn-action:hover {
                transform: none;
            }
        }

        /* === FOCUS VISIBLE === */
        .guide-card:focus-visible,
        .btn-action:focus-visible,
        .filter-btn:focus-visible {
            outline: 3px solid #4285f4;
            outline-offset: 2px;
        }

        /* === CUSTOM SCROLLBAR === */
        .tourguides-container::-webkit-scrollbar {
            width: 8px;
        }

        .tourguides-container::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .tourguides-container::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .tourguides-container::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* === FINAL TOUCHES === */
        .guide-card-footer .btn-action:last-child {
            margin-right: 0;
        }

        .guide-skills .skill-tag:last-child {
            margin-right: 0;
        }

        .filter-buttons .filter-btn:last-child {
            margin-right: 0;
        }

        /* === ERROR STATES === */
        .error-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #dc3545;
        }

        .error-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .error-state h3 {
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .error-state p {
            color: #6c757d;
            margin-bottom: 2rem;
        }

        /* === SUCCESS STATES === */
        .success-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #28a745;
        }

        .success-state i {
            font-size: 3rem;
            margin-bottom: 1rem;
        }

        .success-state h3 {
            color: #28a745;
            margin-bottom: 1rem;
        }

        .success-state p {
            color: #6c757d;
            margin-bottom: 2rem;
        }

        #btn-book-now {
            color: white;
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.4);
        }

        #btn-view-profile {
            background: rgba(0, 100, 0, 0.1);
            color: #006400;
        }

        #feature-icon {
            background: rgba(0, 100, 0, 0.1);
            color: #006400;
        }

        #cta-section {
            /* background: rgba(0, 100, 0, 0.1); */
            /* color: #006400; */
        }
    </style>
@endsection

@push('scripts')
    <script>
        // Additional JavaScript functionality
        document.addEventListener('DOMContentLoaded', function() {
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

            // Show notification function
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

                document.body.appendChild(notification);

                // Auto remove after 5 seconds
                setTimeout(() => {
                    if (notification.parentElement) {
                        notification.style.animation = 'slideOutRight 0.3s ease-in forwards';
                        setTimeout(() => notification.remove(), 300);
                    }
                }, 5000);
            }

            // Initialize tooltips and popovers if Bootstrap is available
            if (typeof bootstrap !== 'undefined') {
                // Initialize tooltips
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Initialize popovers
                const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
                popoverTriggerList.map(function(popoverTriggerEl) {
                    return new bootstrap.Popover(popoverTriggerEl);
                });
            }

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

            // Memory cleanup on page unload
            window.addEventListener('beforeunload', function() {
                if (imageObserver) imageObserver.disconnect();
            });

            console.log('Tour Guides page initialized successfully');
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
    </script>
@endpush
