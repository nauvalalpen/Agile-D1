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
            <div class="hero-desc"> Jelajahi destinasi menakjubkan bersama pemandu wisata profesional dan berpengalaman yang
                akan membuat perjalanan Anda tak terlupakan.</div>
            <a href="#tourguides-grid" class="hero-btn">Lihat Pemandu</a>
        </div>
    </section>

    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. MAIN TOUR GUIDES SECTION -->
        <div id="tourguides-grid" class="tourguides-container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-heading">Temui Pemandu Wisata Terbaik Kami</h2>
                <p class="section-subheading">Pemandu lokal yang antusias dan siap berbagi pengetahuan serta menciptakan
                    pengalaman tak terlupakan untuk Anda</p>
            </div>

            <!-- Filter and Search Section -->
            <div class="filter-search-section mb-5" data-aos="fade-up" data-aos-delay="200">
                <div class="row align-items-center g-3">
                    <div class="col-lg-12">
                        <div class="search-box">
                            <i class="fas fa-search"></i>
                            <input type="text" id="searchGuides"
                                placeholder="Cari pemandu berdasarkan nama atau lokasi... ">
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
                                    <div class="guide-status online">
                                        <i class="fas fa-circle"></i>
                                        <span>Tersedia</span>
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

                        </div>

                        <!-- Card Footer -->
                        <div class="guide-card-footer">
                            <div class="guide-actions">
                                <button class="btn-action" id="btn-view-profile"
                                    onclick="viewGuideProfile({{ $tourguide->id }})">
                                    Selengkapnya
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
                        <h3>Pemandu Berpengalaman</h3>
                        <p>Semua pemandu kami telah diverifikasi secara profesional dan memiliki pengetahuan lokal yang
                            mendalam terkait lokasi.</p>
                    </div>
                </div>
                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
                    <div class="feature-card">
                        <div class="feature-icon" id="feature-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3>Dukungan Penuh</h3>
                        <p>Layanan pelanggan tersedia selama jam operasional untuk memastikan pengalaman tur Anda berjalan
                            lancar.</p>
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
                    Bergabunglah bersama ribuan wisatawan puas yang telah menikmati air terjun menakjubkan bersama pemandu
                    kami.
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
                let emptyState = document.querySelector('.empty-state.search-empty');

                if (show && !emptyState) {
                    emptyState = document.createElement('div');
                    emptyState.className = 'empty-state search-empty';
                    emptyState.innerHTML = `
                        <div class="empty-icon">
                            <i class="fas fa-search"></i>
                        </div>
                        <h3>Tidak Ada Pemandu Ditemukan</h3>
                        <p>Coba sesuaikan kriteria pencarian Anda.</p>
                        <button class="btn-dark-custom" onclick="clearSearch()">
                            <i class="fas fa-refresh"></i>
                            Hapus Pencarian
                        </button>
                    `;
                    guidesGrid.appendChild(emptyState);
                } else if (!show && emptyState) {
                    emptyState.remove();
                }
            }

            // Clear search function
            window.clearSearch = function() {
                const searchInput = document.getElementById('searchGuides');
                if (searchInput) {
                    searchInput.value = '';
                    const guideCards = document.querySelectorAll('.guide-card');
                    guideCards.forEach(card => {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.6s ease-out';
                    });
                    toggleEmptyState(false);
                }
            };

            // Guide profile modal functionality
            window.viewGuideProfile = function(guideId) {
                try {
                    const modal = new bootstrap.Modal(document.getElementById('guideProfileModal'));
                    const modalContent = document.getElementById('guideProfileContent');

                    modalContent.innerHTML = `
                        <div class="spinner"></div>
                    `;

                    modal.show();

                    // Find guide data
                    const guide = tourguideData.find(g => g.id === guideId);

                    setTimeout(() => {
                        if (guide) {
                            modalContent.innerHTML = `
                                <div class="guide-profile-content">
                                    <!-- Profile Header -->
                                    <div class="profile-header">
                                        <div class="profile-background-pattern"></div>
                                        <div class="container">
                                            <div class="row align-items-center">
                                                <div class="col-md-4 text-center">
                                                    <div class="profile-image-container">
                                                        ${guide.foto ? 
                                                            `<img src="${guide.foto}" alt="${guide.nama}" class="profile-image">
                                                                 <div class="profile-verified-badge">
                                                                     <i class="fas fa-check"></i>
                                                                 </div>` :
                                                            `<div class="profile-image-placeholder">
                                                                     <i class="fas fa-user"></i>
                                                                 </div>
                                                                 <div class="profile-verified-badge">
                                                                     <i class="fas fa-check"></i>
                                                                 </div>`
                                                        }
                                                        <div class="profile-status-badge">
                                                            <i class="fas fa-circle"></i>
                                                            <span>Tersedia</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="profile-info">
                                                        <h1 class="profile-name">${guide.nama}</h1>
                                                        <p class="about-text">${guide.deskripsi}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Profile Body -->
                                    <div class="profile-body">
                                        <div class="container">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <!-- Contact Information -->
                                                    <div class="info-card">
                                                        <div class="info-card-header">
                                                            <h3 class="info-card-title">
                                                                <i class="fas fa-address-card"></i>
                                                                Tentang Pemandu
                                                            </h3>
                                                        </div>
                                                        <div class="info-card-body">
                                                                <div class="contact-item">
                                                                    <div class="contact-icon">
                                                                        <i class="fas fa-phone"></i>
                                                                    </div>
                                                                    <div class="contact-details">
                                                                        <span class="contact-label">Telepon</span>
                                                                        <span class="contact-value">${guide.nohp}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="contact-item">
                                                                    <div class="contact-icon">
                                                                        <i class="fas fa-map-marker-alt"></i>
                                                                    </div>
                                                                    <div class="contact-details">
                                                                        <span class="contact-label">Lokasi</span>
                                                                        <span class="contact-value">${guide.alamat}</span>
                                                                    </div>
                                                                </div>
                                                                <div class="contact-item">
                                                                    <div class="contact-icon">
                                                                        <i class="fas fa-tag"></i>
                                                                    </div>
                                                                    <div class="contact-details">
                                                                        <span class="contact-label">Harga</span>
                                                                        <span class="contact-value">${guide.price_range} <sub>/sesi</sub></span>
                                                                    </div>  
                                                                </div>
                                                                <button class="price-book-btn" onclick="bookGuide(${guide.id})">
                                                                    <i class="fas fa-calendar-check"></i>
                                                                    Pesan Sekarang
                                                                </button>
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            `;
                        } else {
                            modalContent.innerHTML = `
                                <div class="error-state">
                                    <div class="error-icon">
                                        <i class="fas fa-exclamation-triangle"></i>
                                    </div>
                                    <h3>Data Tidak Ditemukan</h3>
                                    <p>Maaf, informasi pemandu tidak dapat dimuat saat ini.</p>
                                    <button class="btn-retry" onclick="viewGuideProfile(${guideId})">
                                        <i class="fas fa-refresh"></i>
                                        Coba Lagi
                                    </button>
                                </div>
                            `;
                        }
                    }, 1000);

                } catch (error) {
                    console.error('Error opening guide profile:', error);
                }
            };

            window.bookGuide = function(guideId) {
                // Check if user is authenticated
                @auth
                window.location.href = `${window.location.origin}/tourguides/${guideId}/order`;
            @else
                alert('Silakan login terlebih dahulu untuk melakukan pemesanan');
                window.location.href = `${window.location.origin}/login`;
            @endauth
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

        /* === 1. HERO SECTION === */
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

        /* === 2. MAIN TOUR GUIDES SECTION === */
        .tourguides-container {
            margin-top: 0;
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

        .guide-card-footer {
            padding: 0 1.5rem 1.5rem;
            margin-top: auto;
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

        /* === UNIFIED BUTTON STYLES === */
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
            padding: 1.0rem;
        }

        .modal-body {
            padding: 0;
        }

        .loading-spinner {
            text-align: center;
            padding: 2rem;
        }

        .spinner {
            width: 40px;
            height: 40px;
            border: 4px solid #e9ecef;
            border-top: 4px solid #212529;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin: 1rem auto 2rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* === MODAL PROFILE STYLES === */
        .guide-profile-content {
            color: white;
            border-radius: 0px;
            overflow: hidden;
            padding: 0rem;
        }

        .profile-header {
            background: linear-gradient(135deg, #084d08 0%, #386246 100%);
            padding: 2rem 0;
            position: relative;
        }

        .profile-background-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="75" cy="75" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="50" cy="10" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="10" cy="50" r="1" fill="rgba(255,255,255,0.1)"/><circle cx="90" cy="30" r="1" fill="rgba(255,255,255,0.1)"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>') repeat;
            opacity: 0.3;
        }

        .profile-image-container {
            position: relative;
            display: inline-block;
        }

        .profile-image,
        .profile-image-placeholder {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            border: 4px solid rgba(255, 255, 255, 0.3);
            object-fit: cover;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 3rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .profile-verified-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background: #28a745;
            color: white;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            border: 2px solid white;
        }

        .profile-status-badge {
            position: absolute;
            bottom: 10px;
            right: 10px;
            background: rgba(255, 255, 255, 0.9);
            color: #28a745;
            padding: 0.25rem 0.75rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .profile-status-badge i {
            animation: pulse-dot 2s infinite;
        }

        .profile-name {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
        }

        .profile-title {
            font-size: 1.1rem;
            color: rgba(255, 255, 255, 0.8);
            margin-bottom: 1.5rem;
        }

        .profile-body {
            padding: 2rem 0;
        }

        .info-card {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            padding-bottom: 0rem !important;
            margin: 1rem;
            margin-bottom: 0rem !important;
            color: black;
        }

        .info-card-header {
            padding: 0rem 1.5rem 0;
        }

        .info-card-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: black;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0;
        }

        .info-card-body {
            padding: 1rem;
            margin-top: 0;
        }

        .about-text {
            color: rgba(255, 255, 255, 0.9);
            line-height: 1.6;
            margin-bottom: 0rem;
        }

        .price-book-btn {
            width: 100%;
            padding: 1rem;
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            color: white;
            border: none;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 0rem !important;
            margin-top: 1rem;
        }

        .price-book-btn:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            color: #084d08;
        }

        .contact-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .contact-icon {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: black;
            font-size: 1.2rem;
        }

        .contact-details {
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .contact-label {
            font-size: 0.875rem;
            color: black(255, 255, 255, 0.7);
            margin-bottom: 0.25rem;
        }

        .contact-value {
            font-weight: 600;
            color: black;
        }

        .contact-action {
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .contact-action:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: scale(1.1);
        }

        .profile-footer {
            background: rgba(0, 0, 0, 0.2);
            padding: 2rem 0;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }

        .action-buttons-container {
            text-align: center;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-contact,
        .btn-book-modal {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }

        .btn-contact {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .btn-contact:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        .btn-book-modal {
            background: rgba(255, 255, 255, 0.9);
            color: #228B22;
        }

        .btn-book-modal:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
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

        /* === ERROR STATES === */
        .error-state {
            text-align: center;
            padding: 3rem 2rem;
            color: #dc3545;
        }

        .error-state .error-icon {
            width: 80px;
            height: 80px;
            background: rgba(220, 53, 69, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: #dc3545;
            font-size: 2rem;
        }

        .error-state h3 {
            color: #dc3545;
            margin-bottom: 1rem;
        }

        .error-state p {
            color: #6c757d;
            margin-bottom: 2rem;
        }

        .btn-retry {
            background: #dc3545;
            color: white;
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-retry:hover {
            background: #c82333;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* === CUSTOM STYLES === */
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

            /* Modal responsive */
            .profile-name {
                font-size: 2rem;
            }

            .profile-quick-stats {
                gap: 1rem;
            }

            .action-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-contact,
            .btn-whatsapp,
            .btn-book-modal {
                width: 100%;
                max-width: 300px;
            }

            .profile-badges-container {
                justify-content: center;
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

            /* Modal mobile styles */
            .modal-dialog {
                margin: 0.5rem;
            }

            .profile-header {
                padding: 2rem 0;
            }

            .profile-name {
                font-size: 1.75rem;
            }

            .profile-image,
            .profile-image-placeholder {
                width: 120px;
                height: 120px;
            }

            .profile-quick-stats {
                flex-direction: column;
                gap: 0.5rem;
                text-align: center;
            }

            .specialties-grid {
                justify-content: center;
            }

            .contact-item {
                flex-direction: column;
                text-align: center;
                gap: 0.75rem;
            }

            .contact-details {
                align-items: center;
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
        .btn-action:focus-visible {
            outline: 3px solid #4285f4;
            outline-offset: 2px;
        }

        /* === FINAL TOUCHES === */
        .guide-card-footer .btn-action:last-child {
            margin-right: 0;
        }

        .guide-skills .skill-tag:last-child {
            margin-right: 0;
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

            // Network status monitoring
            window.addEventListener('online', function() {
                showNotification('Koneksi dipulihkan', 'success');
            });

            window.addEventListener('offline', function() {
                showNotification('Anda sedang offline. Beberapa fitur mungkin tidak berfungsi.', 'warning');
            });

            // Show notification function
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.className = `alert alert-${type === 'success' ? 'success' : 'warning'} alert-modern`;
                notification.style.cssText = `
                    position: fixed;
                    top: 20px;
                    right: 20px;
                    z-index: 1050;
                    min-width: 300px;
                    animation: slideInRight 0.3s ease-out;
                `;
                notification.innerHTML = `
                    <i class="fas fa-${type === 'success' ? 'check-circle' : 'exclamation-triangle'}"></i>
                    <span>${message}</span>
                    <button type="button" class="btn-close ms-auto" onclick="this.parentElement.remove()"></button>
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

            // Initialize tooltips if Bootstrap is available
            if (typeof bootstrap !== 'undefined') {
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });
            }

            // Lazy loading for images
            if ('IntersectionObserver' in window) {
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
            }

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

        // Additional CSS animations
        const additionalStyles = `
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

            .modal-dialog-centered {
                display: flex;
                align-items: center;
                min-height: calc(100% - 1rem);
            }

            .modal-lg {
                max-width: 900px;
            }

            @media (max-width: 768px) {
                .modal-lg {
                    max-width: 95%;
                    margin: 1rem auto;
                }
            }

            /* Custom scrollbar for modal */
            .modal-body::-webkit-scrollbar {
                width: 6px;
            }

            .modal-body::-webkit-scrollbar-track {
                background: rgba(255, 255, 255, 0.1);
                border-radius: 3px;
            }

            .modal-body::-webkit-scrollbar-thumb {
                background: rgba(255, 255, 255, 0.3);
                border-radius: 3px;
            }

            .modal-body::-webkit-scrollbar-thumb:hover {
                background: rgba(255, 255, 255, 0.5);
            }

            /* Loading state improvements */
            .loading-spinner p {
                color: #6c757d;
                margin-top: 1rem;
                font-weight: 500;
            }

            /* Enhanced button hover effects */
            .btn-action,
            .btn-contact,
            .btn-whatsapp,
            .btn-book-modal {
                position: relative;
                overflow: hidden;
            }

            .btn-action::before,
            .btn-contact::before,
            .btn-whatsapp::before,
            .btn-book-modal::before {
                content: '';
                position: absolute;
                top: 0;
                left: -100%;
                width: 100%;
                height: 100%;
                background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
                transition: left 0.5s;
            }

            .btn-action:hover::before,
            .btn-contact:hover::before,
            .btn-whatsapp:hover::before,
            .btn-book-modal:hover::before {
                left: 100%;
            }

            /* Improved focus states */
            .btn-action:focus-visible,
            .btn-contact:focus-visible,
            .btn-whatsapp:focus-visible,
            .btn-book-modal:focus-visible {
                outline: 2px solid #fff;
                outline-offset: 2px;
            }

            /* Enhanced card animations */
            .guide-card {
                transform-origin: center bottom;
            }

            .guide-card:hover {
                animation: cardHover 0.3s ease-out forwards;
            }

            @keyframes cardHover {
                0% {
                    transform: translateY(0) scale(1);
                }
                50% {
                    transform: translateY(-3px) scale(1.02);
                }
                100% {
                    transform: translateY(-5px) scale(1);
                }
            }

            /* Skeleton loading animation */
            .skeleton-loading {
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

            /* Improved modal backdrop */
            .modal-backdrop {
                background-color: rgba(0, 0, 0, 0.7);
                backdrop-filter: blur(5px);
            }

            /* Enhanced error state */
            .error-state {
                animation: errorShake 0.5s ease-in-out;
            }

            @keyframes errorShake {
                0%, 100% { transform: translateX(0); }
                25% { transform: translateX(-5px); }
                75% { transform: translateX(5px); }
            }

            /* Improved success state */
            .success-state {
                animation: successPulse 0.6s ease-in-out;
            }

            @keyframes successPulse {
                0% { transform: scale(1); }
                50% { transform: scale(1.05); }
                100% { transform: scale(1); }
            }

            /* Enhanced rating stars */
            .rating-stars i {
                transition: all 0.2s ease;
            }

            .rating-stars:hover i {
                transform: scale(1.1);
            }

            /* Improved badge animations */
            .profile-badge {
                transition: all 0.3s ease;
            }

            .profile-badge:hover {
                transform: translateY(-2px);
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            }

            /* Enhanced contact item hover */
            .contact-item {
                transition: all 0.3s ease;
            }

            .contact-item:hover {
                background: rgba(255, 255, 255, 0.2);
                transform: translateX(5px);
            }

            /* Improved specialty tag hover */
            .specialty-tag {
                transition: all 0.3s ease;
            }

            .specialty-tag:hover {
                background: rgba(255, 255, 255, 0.3);
                transform: scale(1.05);
            }

            /* Enhanced price features */
            .price-feature {
                transition: all 0.3s ease;
            }

            .price-feature:hover {
                background: rgba(255, 255, 255, 0.1);
                padding: 0.5rem;
                border-radius: 5px;
                margin: 0.25rem 0;
            }

            /* Improved quick stats hover */
            .quick-stat {
                transition: all 0.3s ease;
                cursor: default;
            }

            .quick-stat:hover {
                transform: scale(1.1);
            }

            /* Enhanced profile image hover */
            .profile-image-container {
                transition: all 0.3s ease;
            }

            .profile-image-container:hover {
                transform: scale(1.05);
            }

            .profile-image-container:hover .profile-image,
            .profile-image-container:hover .profile-image-placeholder {
                border-color: rgba(255, 255, 255, 0.8);
            }
        `;

        // Inject additional styles
        const styleSheet = document.createElement('style');
        styleSheet.textContent = additionalStyles;
        document.head.appendChild(styleSheet);

        // Enhanced search functionality with debouncing
        if (document.getElementById('searchGuides')) {
            const debouncedSearch = utils.debounce(function(searchTerm) {
                const guideCards = document.querySelectorAll('.guide-card');
                let visibleCount = 0;

                guideCards.forEach(card => {
                    const name = card.dataset.name || '';
                    const location = card.dataset.location || '';
                    const isVisible = name.includes(searchTerm.toLowerCase()) ||
                        location.includes(searchTerm.toLowerCase());

                    if (isVisible) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.6s ease-out';
                        visibleCount++;
                    } else {
                        card.style.display = 'none';
                    }
                });

                // Update empty state
                const emptyState = document.querySelector('.empty-state');
                if (visibleCount === 0 && searchTerm.trim() !== '') {
                    if (!emptyState) {
                        const guidesGrid = document.getElementById('guidesGrid');
                        const newEmptyState = document.createElement('div');
                        newEmptyState.className = 'empty-state';
                        newEmptyState.innerHTML = `
                            <div class="empty-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <h3>Tidak Ada Pemandu Ditemukan</h3>
                            <p>Coba sesuaikan kata kunci pencarian Anda.</p>
                            <button class="btn-dark-custom" onclick="clearSearch()">
                                <i class="fas fa-refresh"></i>
                                Hapus Pencarian
                            </button>
                        `;
                        guidesGrid.appendChild(newEmptyState);
                    }
                } else if (emptyState && (visibleCount > 0 || searchTerm.trim() === '')) {
                    emptyState.remove();
                }
            }, 300);

            document.getElementById('searchGuides').addEventListener('input', function() {
                debouncedSearch(this.value);
            });
        }

        // Enhanced modal functionality
        document.addEventListener('show.bs.modal', function(event) {
            if (event.target.id === 'guideProfileModal') {
                document.body.style.overflow = 'hidden';
            }
        });

        document.addEventListener('hidden.bs.modal', function(event) {
            if (event.target.id === 'guideProfileModal') {
                document.body.style.overflow = '';
            }
        });

        // Keyboard navigation for modal
        document.addEventListener('keydown', function(event) {
            const modal = document.querySelector('.modal.show');
            if (modal && event.key === 'Escape') {
                const modalInstance = bootstrap.Modal.getInstance(modal);
                if (modalInstance) {
                    modalInstance.hide();
                }
            }
        });

        // Enhanced error handling
        window.addEventListener('error', function(event) {
            console.error('JavaScript error:', event.error);
            // Could show user-friendly error message here
        });

        // Progressive enhancement for older browsers
        if (!window.IntersectionObserver) {
            // Fallback for browsers without IntersectionObserver
            document.querySelectorAll('img[data-src]').forEach(img => {
                img.src = img.dataset.src;
                img.classList.remove('lazy');
            });
        }

        // Service Worker registration for PWA capabilities
        if ('serviceWorker' in navigator && 'PushManager' in window) {
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
    </script>
@endpush
