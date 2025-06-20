@extends('layouts.app')

@section('content')
    {{-- Include AOS (Animate on Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Include Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">MADU<br>PREMIUM</div>
            <div class="hero-desc">Nikmati kelezatan dan khasiat madu murni berkualitas tinggi dari alam Indonesia yang diproduksi dengan standar terbaik.</div>
            <a href="#honey-grid" class="hero-btn">Lihat Produk</a>
        </div>
    </section>

    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. MAIN HONEY PRODUCTS GRID (with Modals) -->
        <div id="honey-grid" class="honey-container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-heading">Produk Madu Terbaik Kami</h2>
                <p class="section-subheading">Koleksi madu premium berkualitas tinggi langsung dari alam Indonesia dengan cita rasa yang autentik dan khasiat yang terjaga.</p>
            </div>

            <div class="row">
    @forelse ($madus as $madu)
        <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
            <div class="honey-card w-100" data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                <div class="honey-card-img-wrapper">
                    @if ($madu->gambar)
                        <img src="{{ asset('storage/' . $madu->gambar) }}" class="honey-card-img"
                            alt="{{ $madu->nama_madu }}">
                    @else
                        <div class="honey-placeholder">
                            <div class="placeholder-content">
                                <i class="fas fa-jar fa-3x"></i>
                                <span class="placeholder-text">No Image</span>
                            </div>
                        </div>
                    @endif
                    
                

                    <!-- Enhanced Stock Badge -->
                    @if($madu->stock <= 5 && $madu->stock > 0)
                        <div class="stock-badge limited">
                            <i class="fas fa-exclamation-triangle"></i>
                            <span>Stok Terbatas</span>
                        </div>
                    @elseif($madu->stock == 0)
                        <div class="stock-badge sold-out">
                            <i class="fas fa-times-circle"></i>
                            <span>Habis</span>
                        </div>
                    @else
                        <div class="stock-badge available">
                            <i class="fas fa-check-circle"></i>
                            <span>Tersedia</span>
                        </div>
                    @endif
                </div>

                <div class="honey-card-body">
                    <div class="honey-header">
                        <h5 class="honey-title">{{ $madu->nama_madu }}</h5>
                          <div class="honey-size">
                            <span class="size-label">Size:</span>
                            <span class="size-value">{{ $madu->ukuran }}</span>
                        </div>
                        <div class="honey-rating">
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                            </div>
                            <span class="rating-text">5.0</span>
                        </div>
                    </div>

                    <div class="honey-price">
                        <span class="current-price">Rp {{ number_format($madu->harga, 0, ',', '.') }}</span>
                        <span class="price-unit">per botol</span>
                    </div>

                    <p class="honey-description">{{ Str::limit($madu->deskripsi, 100) }}</p>

                    <div class="honey-features">
                        <span class="feature-badge natural">
                            <i class="fas fa-leaf"></i>
                            <span>100% Natural</span>
                        </span>
                        <span class="feature-badge premium">
                            <i class="fas fa-certificate"></i>
                            <span>Premium</span>
                        </span>
                    </div>

                    <div class="honey-actions">
                        <button type="button" class="btn-detail" onclick="showHoneyModal({{ $madu->id }})">
                            <span class="btn-icon">
                                <i class="fas fa-eye"></i>
                            </span>
                            <span class="btn-text">Lihat Detail</span>
                            <div class="btn-ripple"></div>
                        </button>
                        
                        @auth
                            <a href="{{ route('madu.order', $madu->id) }}" class="btn-order">
                                <span class="btn-icon">
                                    <i class="fas fa-shopping-cart"></i>
                                </span>
                                <span class="btn-text">Order Sekarang</span>
                                <div class="btn-shine"></div>
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="btn-order">
                                <span class="btn-icon">
                                    <i class="fas fa-sign-in-alt"></i>
                                </span>
                                <span class="btn-text">Login untuk Order</span>
                                <div class="btn-shine"></div>
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-jar"></i>
                </div>
                <h3 class="empty-title">Belum ada produk madu</h3>
                <p class="empty-description">Produk madu premium akan segera tersedia untuk Anda</p>
            </div>
        </div>
    @endforelse
</div>


        <!-- 3. HONEY STATS SECTION -->
        @if ($madus->count() > 0)
            <div class="honey-stats-section my-5 py-5" data-aos="fade-up">
                <div class="row text-center g-4">
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-jar"></i>
                            </div>
                            <h3 class="stat-number">{{ $madus->count() }}</h3>
                            <p class="stat-label">Produk Madu</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-leaf"></i>
                            </div>
                            <h3 class="stat-number">100%</h3>
                            <p class="stat-label">Natural</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-certificate"></i>
                            </div>
                            <h3 class="stat-number">Premium</h3>
                            <p class="stat-label">Kualitas</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="stat-number">Terjamin</h3>
                            <p class="stat-label">Keaslian</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- 4. CALL TO ACTION SECTION -->
        <div class="cta-section my-5 py-5" data-aos="fade-up">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="cta-content">
                        <h3>Butuh Informasi Lebih Lanjut?</h3>
                        <p>
                            Tim kami siap membantu Anda mendapatkan informasi lengkap tentang produk madu yang tersedia.
                            Hubungi kami untuk konsultasi gratis dan dapatkan rekomendasi madu yang sesuai dengan
                            kebutuhan kesehatan Anda.
                        </p>
                        <a href="contact" class="btn btn-dark-custom">Hubungi Kami</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="cta-image">
                        <img src="{{ asset('images/hero.jpg') }}" alt="Contact Us" class="img-fluid rounded">
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Honey Detail Modal -->
    <div class="modal fade" id="honeyDetailModal" tabindex="-1" aria-labelledby="honeyDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="honeyDetailModalLabel">Detail Produk Madu</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="honeyDetailModalBody">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat detail produk...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <div id="modalOrderButton"></div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Viewer Modal -->
    <div class="modal fade" id="imageViewerModal" tabindex="-1" aria-labelledby="imageViewerModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content bg-transparent border-0">
                <div class="modal-header border-0 pb-0">
                    <h5 class="modal-title text-white" id="imageViewerModalLabel">Lihat Gambar</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <img src="" alt="" id="imageViewerImg" class="img-fluid rounded">
                </div>
            </div>
        </div>
    </div>
    </div>
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
        const isLoggedIn = @json(auth()->check());
        const maduOrderRoute = "{{ route('madu.order', ':id') }}";
        const loginUrl = "{{ route('login') }}";

        // Honey data for JavaScript
        const honeyData = {!! json_encode(
            $madus->map(function ($madu) {
                return [
                    'id' => $madu->id,
                    'nama' => $madu->nama_madu,
                    'ukuran' => $madu->ukuran,
                    'harga' => $madu->harga,
                    'stock' => $madu->stock,
                    'deskripsi' => $madu->deskripsi,
                    'gambar' => $madu->gambar ? asset('storage/' . $madu->gambar) : null,
                    'created_at' => $madu->created_at->format('F j, Y \a\t g:i A'),
                ];
            }),
        ) !!};
            
        // Modal management
        let currentModal = null;

        // Function to clean up modals
        function cleanupModals() {
            // Remove all modal backdrops
            document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
                backdrop.remove();
            });

            // Reset body styles
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';

            // Hide all modals
            document.querySelectorAll('.modal').forEach(function(modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
                modal.setAttribute('aria-hidden', 'true');
            });

            currentModal = null;
        }

        // Show honey modal with details
        function showHoneyModal(honeyId) {
            console.log('Opening honey modal for ID:', honeyId);

            // Find honey data
            const honey = honeyData.find(function(h) {
                return h.id === honeyId;
            });

            if (!honey) {
                console.error('Honey not found:', honeyId);
                alert('Produk madu tidak ditemukan!');
                return;
            }

            const modal = document.getElementById('honeyDetailModal');
            const modalBody = document.getElementById('honeyDetailModalBody');
            const modalLabel = document.getElementById('honeyDetailModalLabel');
            const modalOrderButton = document.getElementById('modalOrderButton');

            if (!modal || !modalBody || !modalLabel) {
                console.error('Modal elements not found');
                alert('Elemen modal tidak ditemukan!');
                return;
            }

            // Set modal title
            modalLabel.textContent = honey.nama;

            // Create modal content
            const imageSection = honey.gambar ?
                '<div class="position-relative">' +
                '<img src="' + honey.gambar + '" ' +
                'class="img-fluid rounded honey-modal-img" ' +
                'alt="' + honey.nama_madu + '"' +
                'onmouseover="this.style.transform=\'scale(1.02)\'"' +
                'onmouseout="this.style.transform=\'scale(1)\'">' +
                '<div class="position-absolute top-0 end-0 m-2">' +
                '<i class="fas fa-expand"></i>' +
                '</button>' +
                '</div>' +
                '</div>' :
                '<div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px;">' +
                '<div class="text-center text-muted">' +
                '<i class="fas fa-jar fa-3x mb-2"></i>' +
                '<p>Tidak ada gambar tersedia</p>' +
                '</div>' +
                '</div>';

            // Stock status
            let stockStatus = '';
            let stockClass = '';
            if (honey.stock <= 5 && honey.stock > 0) {
                stockStatus = '⚠️ Stok Terbatas (' + honey.stock + ' tersisa)';
                stockClass = 'text-warning';
            } else if (honey.stock == 0) {
                stockStatus = '❌ Stok Habis';
                stockClass = 'text-danger';
            } else {
                stockStatus = '✅ Tersedia (' + honey.stock + ' unit)';
                stockClass = 'text-success';
            }

            modalBody.innerHTML =
                '<div class="row">' +
                '<div class="col-md-7">' +
                imageSection +
                '</div>' +
                '<div class="col-md-5">' +
                '<div class="honey-details">' +
                '<h5 class="mb-3">' +
                '<i class="fas fa-info-circle text-primary me-2"></i>' +
                'Informasi Detail' +
                '</h5>' +

                '<div class="detail-item mb-3">' +
                    '<h6 class="fw-bold mb-1">' +
                        '<i class="fas fa-jar text-secondary me-2"></i>' +
                        'Nama Produk' +
                    '</h6>' +
                    '<p class="mb-0">' + honey.nama + '</p>' +
                '</div>' +
                '<div class="detail-item mb-3">' +
                    '<h6 class="fw-bold mb-1">' +
                        '<i class="fas fa-ruler text-secondary me-2"></i>' +
                        'Ukuran' +
                    '</h6>' +
                    '<p class="mb-0">' + (honey.ukuran || 'Standard') + '</p>' +
                '</div>' +


                '<div class="detail-item mb-3">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-tag text-secondary me-2"></i>' +
                'Harga' +
                '</h6>' +
                '<p class="mb-0 fw-bold text-primary fs-5">Rp ' + new Intl.NumberFormat('id-ID').format(honey.harga) + '</p>' +
                '</div>' +

                '<div class="detail-item mb-3">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-boxes text-secondary me-2"></i>' +
                'Ketersediaan' +
                '</h6>' +
                '<p class="mb-0 fw-bold ' + stockClass + '">' + stockStatus + '</p>' +
                '</div>' +


                '<div class="detail-item">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-align-left text-secondary me-2"></i>' +
                'Deskripsi' +
                '</h6>' +
                '<p class="mb-0 text-justify">' + honey.deskripsi.replace(/\n/g, '<br>') + '</p>' +
                '</div>' +

                '<div class="honey-features mt-3">' +
                '<h6 class="fw-bold mb-2">' +
                '<i class="fas fa-star text-secondary me-2"></i>' +
                'Keunggulan' +
                '</h6>' +
                '<div class="d-flex flex-wrap gap-2">' +
                '<span class="badge bg-success"><i class="fas fa-leaf me-1"></i>100% Natural</span>' +
                '<span class="badge bg-warning"><i class="fas fa-certificate me-1"></i>Premium Quality</span>' +
                '<span class="badge bg-info"><i class="fas fa-shield-alt me-1"></i>Lab Tested</span>' +
                '<span class="badge bg-primary"><i class="fas fa-heart me-1"></i>Sehat</span>' +
                '</div>' +
                '</div>' +

                '</div>' +
                '</div>' +
                '</div>';

            // Set order button
            if (honey.stock > 0) {
    if (isLoggedIn) {
        modalOrderButton.innerHTML =
            '<a href="' + maduOrderRoute.replace(':id', honey.id) + '" class="btn btn-warning">' +
            '<i class="fas fa-shopping-cart me-2"></i>Order Sekarang' +
            '</a>';
    } else {
        modalOrderButton.innerHTML =
            '<a href="' + loginUrl + '" class="btn btn-warning">' +
            '<i class="fas fa-sign-in-alt me-2"></i>Login untuk Order' +
            '</a>';
    }
} else {
    modalOrderButton.innerHTML =
        '<button class="btn btn-secondary" disabled>' +
        '<i class="fas fa-times-circle me-2"></i>Stok Habis' +
        '</button>';
}


            // Show modal
            try {
                // Clean up any existing modals first
                cleanupModals();

                // Create and show new modal
                currentModal = new bootstrap.Modal(modal, {
                    backdrop: true,
                    keyboard: true,
                    focus: true
                });

                currentModal.show();

                console.log('Modal shown successfully');
            } catch (error) {
                console.error('Error showing modal:', error);
                alert('Error membuka detail produk. Silakan coba lagi.');
            }
        }

 
        // Document ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Honey page loaded with', honeyData.length, 'products');

            // Add event listeners for modal cleanup
            document.querySelectorAll('.modal').forEach(function(modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(cleanupModals, 100);
                });

                modal.addEventListener('show.bs.modal', function() {
                    console.log('Modal showing:', this.id);
                });

                modal.addEventListener('shown.bs.modal', function() {
                    console.log('Modal shown:', this.id);
                });
            });

            // Handle ESC key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape' && currentModal) {
                    currentModal.hide();
                }
            });

            // Smooth scrolling for hero button
            const heroBtn = document.querySelector('.hero-btn');
            if (heroBtn) {
                heroBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector('#honey-grid');
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

            // Add hover effects to honey cards
            document.querySelectorAll('.honey-card').forEach(function(card) {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Counter animation for stats
            const counters = document.querySelectorAll('.stat-number');
            const animateCounter = (counter) => {
                const target = parseInt(counter.textContent.replace(/\D/g, ''));
                if (isNaN(target)) return;
                
                const increment = target / 50;
                let current = 0;

                const timer = setInterval(() => {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = counter.textContent.replace(/\d+/, target);
                        clearInterval(timer);
                    } else {
                        counter.textContent = counter.textContent.replace(/\d+/, Math.floor(current));
                    }
                }, 30);
            };

            // Intersection Observer for counter animation
            const observerOptions = {
                threshold: 0.5,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        const counter = entry.target.querySelector('.stat-number');
                        if (counter && !counter.classList.contains('animated')) {
                            counter.classList.add('animated');
                            animateCounter(counter);
                        }
                    }
                });
            }, observerOptions);

            document.querySelectorAll('.stat-card').forEach(card => {
                observer.observe(card);
            });
        });

        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('JavaScript error:', e.error);
        });

        // Make functions globally available
        window.showHoneyModal = showHoneyModal;
        window.showImageViewer = showImageViewer;
    </script>
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
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)),
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
        /* ===== HONEY CARD STYLES ===== */
.honey-card {
    background: #ffffff;
    border-radius: 20px;
    box-shadow: 0 8px 32px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 1px solid rgba(243, 156, 18, 0.1);
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.honey-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(243, 156, 18, 0.03), rgba(230, 126, 34, 0.02));
    opacity: 0;
    transition: opacity 0.4s ease;
    z-index: 1;
    border-radius: 20px;
}

.honey-card:hover {
    transform: translateY(-12px) scale(1.02);
    box-shadow: 0 20px 60px rgba(243, 156, 18, 0.15);
    border-color: rgba(243, 156, 18, 0.3);
}

.honey-card:hover::before {
    opacity: 1;
}

/* ===== IMAGE WRAPPER ===== */
.honey-card-img-wrapper {
    position: relative;
    height: 280px;
    overflow: hidden;
    border-radius: 20px 20px 0 0;
}

.honey-card-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.6s ease;
}

.honey-card:hover .honey-card-img {
    transform: scale(1.1);
}

.honey-placeholder {
    height: 100%;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    display: flex;
    align-items: center;
    justify-content: center;
    color: #6c757d;
}

.placeholder-content {
    text-align: center;
    animation: placeholderPulse 2s ease-in-out infinite;
}

.placeholder-content i {
    display: block;
    margin-bottom: 1rem;
    font-size: 3rem;
}

.placeholder-text {
    font-size: 1.1rem;
    font-weight: 600;
}

@keyframes placeholderPulse {
    0%, 100% { opacity: 0.5; transform: scale(1); }
    50% { opacity: 1; transform: scale(1.05); }
}
.honey-size {
    margin-bottom: 1rem;
    padding: 0.5rem 0;
    border-bottom: 1px solid #f0f0f0;
}

.size-label {
    font-weight: 600;
    color: #666;
    margin-right: 0.5rem;
}

.size-value {
    color: #333;
    font-weight: 500;
}

.feature-badge.size {
    background: linear-gradient(135deg, #6366f1, #8b5cf6);
    color: white;
}

/* ===== OVERLAY EFFECTS ===== */
.honey-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(243, 156, 18, 0.9), rgba(230, 126, 34, 0.9));
    display: flex;
    align-items: center;
    justify-content: center;
    opacity: 0;
    transition: all 0.4s ease;
    backdrop-filter: blur(5px);
}

.honey-card:hover .honey-overlay {
    opacity: 1;
}

.honey-overlay-content {
    text-align: center;
    color: white;
    transform: translateY(20px);
    transition: transform 0.4s ease;
}

.honey-card:hover .honey-overlay-content {
    transform: translateY(0);
}

.overlay-icon {
    width: 60px;
    height: 60px;
    background: rgba(255, 255, 255, 0.2);
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 1rem;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.3);
    transition: all 0.3s ease;
}

.overlay-icon i {
    font-size: 1.5rem;
}

.honey-card:hover .overlay-icon {
    transform: scale(1.1);
    background: rgba(255, 255, 255, 0.3);
}

.overlay-text {
    font-size: 1.1rem;
    font-weight: 600;
    margin: 0;
    text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
}

/* ===== STOCK BADGES ===== */
.stock-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    padding: 0.5rem 1rem;
    border-radius: 25px;
    font-size: 0.8rem;
    font-weight: 700;
    color: white;
    display: flex;
    align-items: center;
    gap: 0.4rem;
    z-index: 3;
    backdrop-filter: blur(10px);
    border: 2px solid rgba(255, 255, 255, 0.2);
    text-shadow: 0 1px 2px rgba(0, 0, 0, 0.3);
}

.stock-badge.available {
    background: linear-gradient(135deg, #27ae60, #2ecc71);
    animation: availablePulse 2s ease-in-out infinite;
}

.stock-badge.limited {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    animation: limitedPulse 1.5s ease-in-out infinite;
}

.stock-badge.sold-out {
    background: linear-gradient(135deg, #e74c3c, #c0392b);
    animation: soldOutShake 3s ease-in-out infinite;
}

@keyframes availablePulse {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.05); }
}

@keyframes limitedPulse {
    0%, 100% { 
        transform: scale(1); 
        box-shadow: 0 0 0 0 rgba(243, 156, 18, 0.7); 
    }
    50% { 
        transform: scale(1.1); 
        box-shadow: 0 0 0 10px rgba(243, 156, 18, 0); 
    }
}

@keyframes soldOutShake {
    0%, 100% { transform: translateX(0); }
    10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
    20%, 40%, 60%, 80% { transform: translateX(2px); }
}

/* ===== CARD BODY ===== */
.honey-card-body {
    padding: 2rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
    position: relative;
    z-index: 2;
}

.honey-header {
    margin-bottom: 1.5rem;
}

.honey-title {
    font-size: 1.5rem;
    font-weight: 800;
    color: #2c3e50;
    margin-bottom: 0.8rem;
    line-height: 1.3;
    transition: color 0.3s ease;
}

.honey-card:hover .honey-title {
    color: #f39c12;
}

.honey-rating {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.stars {
    display: flex;
    gap: 0.2rem;
}

.stars i {
    color: #f39c12;
    font-size: 0.9rem;
    transition: all 0.2s ease;
}

.stars i:hover {
    transform: scale(1.2);
    filter: drop-shadow(0 0 5px rgba(243, 156, 18, 0.6));
}

.rating-text {
    font-size: 0.9rem;
    color: #7f8c8d;
    font-weight: 600;
}

/* ===== PRICE SECTION ===== */
.honey-price {
    margin-bottom: 1.5rem;
    padding: 1rem;
    background: rgba(243, 156, 18, 0.05);
    border-radius: 12px;
    border-left: 4px solid #f39c12;
}

.current-price {
    display: block;
    font-size: 1.8rem;
    font-weight: 900;
    background: linear-gradient(135deg, #f39c12, #e67e22, #d35400);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    margin-bottom: 0.3rem;
}

.price-unit {
    font-size: 0.9rem;
    color: #95a5a6;
    font-weight: 500;
}

/* ===== DESCRIPTION ===== */
.honey-description {
    color: #7f8c8d;
    line-height: 1.6;
    font-size: 0.95rem;
    margin-bottom: 1.5rem;
    flex-grow: 1;
}

/* ===== FEATURES ===== */
.honey-features {
    display: flex;
    flex-wrap: wrap;
    gap: 0.8rem;
    margin-bottom: 2rem;
}

.feature-badge {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    transition: all 0.3s ease;
    border: 2px solid transparent;
}

.feature-badge.natural {
    background: linear-gradient(135deg, rgba(46, 204, 113, 0.1), rgba(39, 174, 96, 0.1));
    color: #27ae60;
    border-color: rgba(39, 174, 96, 0.2);
}

.feature-badge.premium {
    background: linear-gradient(135deg, rgba(243, 156, 18, 0.1), rgba(230, 126, 34, 0.1));
    color: #f39c12;
    border-color: rgba(243, 156, 18, 0.2);
}

.feature-badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
}

.feature-badge.natural:hover {
    background: linear-gradient(135deg, rgba(46, 204, 113, 0.2), rgba(39, 174, 96, 0.2));
    border-color: rgba(39, 174, 96, 0.4);
}

.feature-badge.premium:hover {
    background: linear-gradient(135deg, rgba(243, 156, 18, 0.2), rgba(230, 126, 34, 0.2));
    border-color: rgba(243, 156, 18, 0.4);
}

/* ===== ACTION BUTTONS ===== */
.honey-actions {
    display: flex;
    flex-direction: column;
    gap: 1rem;
    margin-top: auto;
}

.btn-detail,
.btn-order {
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.8rem;
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 1rem;
    text-decoration: none;
    cursor: pointer;
    overflow: hidden;
    transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    z-index: 1;
}

.btn-detail {
    background: linear-gradient(135deg, #34495e, #2c3e50);
    color: white;
    border: 2px solid transparent;
}

.btn-detail:hover {
    background: linear-gradient(135deg, #2c3e50, #1a252f);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(52, 73, 94, 0.3);
    color: white;
}

.btn-order {
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
    border: 2px solid transparent;
}

.btn-order:hover {
    background: linear-gradient(135deg, #e67e22, #d35400);
    transform: translateY(-3px);
    box-shadow: 0 10px 25px rgba(243, 156, 18, 0.4);
    color: white;
}

.btn-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 20px;
    height: 20px;
    position: relative;
    z-index: 2;
}

.btn-text {
    position: relative;
    z-index: 2;
    font-weight: 700;
}

/* ===== BUTTON EFFECTS ===== */
.btn-ripple {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.btn-detail:active .btn-ripple {
    width: 300px;
    height: 300px;
}

.btn-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.4), transparent);
    transition: left 0.8s ease;
    z-index: 1;
}

.btn-order:hover .btn-shine {
    left: 100%;
}

/* ===== EMPTY STATE ===== */
.empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: linear-gradient(135deg, #f8f9fa, #e9ecef);
    border-radius: 25px;
    margin: 2rem 0;
    border: 2px dashed #dee2e6;
}

.empty-icon {
    width: 120px;
    height: 120px;
    background: linear-gradient(135deg, rgba(243, 156, 18, 0.1), rgba(230, 126, 34, 0.1));
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 0 auto 2rem;
    animation: emptyFloat 3s ease-in-out infinite;
}

.empty-icon i {
    font-size: 3rem;
    color: #f39c12;
}

@keyframes emptyFloat {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-15px); }
}

.empty-title {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
}

.empty-description {
    font-size: 1.1rem;
    color: #7f8c8d;
    max-width: 400px;
    margin: 0 auto;
    line-height: 1.6;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 992px) {
    .honey-card-img-wrapper {
        height: 250px;
    }
    
    .honey-card-body {
        padding: 1.5rem;
    }
    
    .honey-title {
        font-size: 1.3rem;
    }
    
    .current-price {
        font-size: 1.6rem;
    }
}

@media (max-width: 768px) {
    .honey-card-img-wrapper {
        height: 220px;
    }
    
    .honey-card-body {
        padding: 1.2rem;
    }
    
    .honey-title {
        font-size: 1.2rem;
    }
    
    .current-price {
        font-size: 1.4rem;
    }
    
    .honey-features {
        gap: 0.5rem;
    }
    
    .feature-badge {
        font-size: 0.75rem;
        padding: 0.4rem 0.8rem;
    }
    
    .btn-detail,
    .btn-order {
        padding: 0.8rem 1.2rem;
        font-size: 0.9rem;
    }
}

@media (max-width: 576px) {
    .honey-card {
        border-radius: 15px;
    }
    
    .honey-card-img-wrapper {
        height: 200px;
        border-radius: 15px 15px 0 0;
    }
    
    .honey-card-body {
        padding: 1rem;
    }
    
    .honey-price {
        padding: 0.8rem;
    }
    
    .current-price {
        font-size: 1.3rem;
    }
    
    .honey-actions {
        gap: 0.8rem;
    }
    
    .btn-detail,
    .btn-order {
        padding: 0.7rem 1rem;
        font-size: 0.85rem;
        gap: 0.5rem;
    }
    
    .stock-badge {
        top: 10px;
        right: 10px;
        padding: 0.4rem 0.8rem;
        font-size: 0.75rem;
    }
}

/* ===== LOADING STATES ===== */
.honey-card.loading {
    pointer-events: none;
    opacity: 0.7;
}

.honey-card.loading::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    margin: -20px 0 0 -20px;
    border: 3px solid #f3f3f3;
    border-top: 3px solid #f39c12;
    border-radius: 50%;
    animation: spin 1s linear infinite;
    z-index: 10;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

/* ===== ACCESSIBILITY IMPROVEMENTS ===== */
.honey-card:focus-visible,
.btn-detail:focus-visible,
.btn-order:focus-visible {
    outline: 3px solid rgba(243, 156, 18, 0.6);
    outline-offset: 4px;
}

/* ===== PRINT STYLES ===== */
@media print {
    .honey-overlay,
    .stock-badge,
    .honey-actions {
        display: none !important;
    }
    
    .honey-card {
        box-shadow: none;
        border: 2px solid #e2e8f0;
        break-inside: avoid;
        margin-bottom: 2rem;
    }
    
    .honey-card-img {
        filter: grayscale(100%);
    }
}

/* ===== HIGH CONTRAST MODE ===== */
@media (prefers-contrast: high) {
    .honey-card {
        border: 3px solid #000;
    }
    
    .honey-title {
        color: #000;
    }
    
    .honey-description {
        color: #333;
    }
}

/* ===== REDUCED MOTION ===== */
@media (prefers-reduced-motion: reduce) {
    .honey-card,
    .honey-card-img,
    .honey-overlay,
    .honey-overlay-content,
    .overlay-icon,
    .feature-badge,
    .btn-detail,
    .btn-order,
    .stock-badge {
        animation: none !important;
        transition: none !important;
    }
    
    .honey-card:hover {
        transform: none;
    }
}

/* ===== DARK MODE SUPPORT ===== */
@media (prefers-color-scheme: dark) {
    .honey-card {
        background: #2c3e50;
        border-color: rgba(243, 156, 18, 0.2);
    }
    
    .honey-title {
        color: #ecf0f1;
    }
    
    .honey-description {
        color: #bdc3c7;
    }
    
    .honey-price {
        background: rgba(243, 156, 18, 0.1);
    }
    
    .price-unit {
        color: #95a5a6;
    }
    
    .rating-text {
        color: #95a5a6;
    }
}

/* ===== ANIMATION DELAYS FOR STAGGERED EFFECT ===== */
.honey-card:nth-child(1) { animation-delay: 0ms; }
.honey-card:nth-child(2) { animation-delay: 150ms; }
.honey-card:nth-child(3) { animation-delay: 300ms; }
.honey-card:nth-child(4) { animation-delay: 450ms; }
.honey-card:nth-child(5) { animation-delay: 600ms; }
.honey-card:nth-child(6) { animation-delay: 750ms; }

/* ===== HOVER EFFECTS FOR BETTER UX ===== */
.honey-card:hover .stars i {
    animation: starTwinkle 0.6s ease-in-out;
}

@keyframes starTwinkle {
    0%, 100% { transform: scale(1); }
    50% { transform: scale(1.2) rotate(10deg); }
}

.honey-card:hover .feature-badge {
    transform: translateY(-2px);
}

.honey-card:hover .current-price {
    animation: priceGlow 1s ease-in-out;
}

@keyframes priceGlow {
    0%, 100% { filter: brightness(1); }
    50% { filter: brightness(1.2) drop-shadow(0 0 10px rgba(243, 156, 18, 0.5)); }
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

        .btn-dark-custom:active {
            background-color: #e9ecef;
            color: #212529;
            transform: scale(0.98);
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.1);
        }

        .btn-dark-custom:focus {
            box-shadow: 0 0 0 0.2rem rgba(33, 37, 41, 0.25);
            outline: none;
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

        /* === 2. MAIN HONEY PRODUCTS GRID === */
        .honey-container {
            margin-top: -80px;
            position: relative;
            z-index: 2;
            background: #f8f9fa;
            padding: 4rem 2rem;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .honey-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            height: 100%;
            position: relative;
        }

        .honey-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .honey-card-img-wrapper {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .honey-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .honey-card:hover .honey-card-img {
            transform: scale(1.1);
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* === PRINT STYLES === */
        @media print {
            .hero-section,
            .honey-overlay,
            .stock-badge,
            .btn {
                display: none !important;
            }
            
            .honey-card {
                box-shadow: none;
                border: 1px solid #ddd;
                break-inside: avoid;
                margin-bottom: 1rem;
            }
            
            .honey-card-img {
                filter: grayscale(100%);
            }
        }

        /* === HIGH CONTRAST MODE === */
        @media (prefers-contrast: high) {
            .honey-card {
                border: 2px solid #000;
            }
            
            .card-title {
                color: #000;
            }
            
            .card-text {
                color: #333;
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
            
            .honey-card:hover {
                transform: none;
            }
        }

        /* === DARK MODE SUPPORT === */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #1a1a1a;
                color: #ffffff;
            }
            
            .honey-card {
                background: #2d2d2d;
                color: #ffffff;
            }
            
            .card-title {
                color: #ffffff;
            }
            
            .card-text {
                color: #cccccc;
            }
            
            .modal-content {
                background: #2d2d2d;
                color: #ffffff;
            }
            
            .modal-header {
                background: #3d3d3d;
                border-bottom-color: #555;
            }
            
            .modal-footer {
                background: #3d3d3d;
                border-top-color: #555;
            }
        }

        /* === CUSTOM SCROLLBAR === */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #e67e22, #d35400);
        }

        /* === SELECTION STYLES === */
        ::selection {
            background: rgba(243, 156, 18, 0.3);
            color: #2c3e50;
        }

        ::-moz-selection {
            background: rgba(243, 156, 18, 0.3);
            color: #2c3e50;
        }

        /* === FOCUS INDICATORS === */
        .honey-card:focus-visible {
            outline: 3px solid rgba(243, 156, 18, 0.6);
            outline-offset: 4px;
        }

        .btn:focus-visible {
            outline: 3px solid rgba(0, 123, 255, 0.5);
            outline-offset: 2px;
        }
         /* === 4. CALL TO ACTION SECTION === */
        .cta-section {
            background-color: #fff;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .cta-content h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
            color: #212529;
        }

        .cta-content p {
            font-size: 1rem;
            line-height: 1.7;
            color: #555;
            margin-bottom: 1.5rem;
        }

        .cta-image img {
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .cta-image img:hover {
            transform: scale(1.02);
        }

        /* === MODAL STYLES === */
        .modal-content {
            border-radius: 15px;
            border: none;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-bottom: 1px solid #dee2e6;
            padding: 1.5rem;
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border-radius: 15px 15px 0 0;
        }

        .modal-header .modal-title {
            font-weight: 700;
            color: #212529;
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-radius: 0 0 15px 15px;
        }

        /* Facility modal specific styles */
        .facility-modal-img {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            width: 100%;
            object-fit: cover;
        }

        .facility-details {
            padding-left: 1rem;
        }

        .detail-item {
            padding: 0.75rem 0;
            border-bottom: 1px solid #f1f3f4;
        }

        .detail-item:last-child {
            border-bottom: none;
        }

        .detail-item h6 {
            color: #495057;
            font-size: 0.9rem;
            margin-bottom: 0.25rem;
        }

        .detail-item p {
            color: #6c757d;
            font-size: 0.95rem;
            line-height: 1.5;
        }

        /* Image viewer modal styles */
        #imageViewerModal .modal-content {
            background: transparent !important;
            border: none !important;
            box-shadow: none !important;
        }

        #imageViewerModal .modal-body {
            padding: 1rem;
        }

        #imageViewerModal img {
            max-height: 80vh;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
        }

        /* === TOOLTIP STYLES === */
        .tooltip {
            font-size: 0.875rem;
        }

        .tooltip-inner {
            background: #2c3e50;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
        }

        .tooltip.bs-tooltip-top .tooltip-arrow::before {
            border-top-color: #2c3e50;
        }

        .tooltip.bs-tooltip-bottom .tooltip-arrow::before {
            border-bottom-color: #2c3e50;
        }

        .tooltip.bs-tooltip-start .tooltip-arrow::before {
            border-left-color: #2c3e50;
        }

        .tooltip.bs-tooltip-end .tooltip-arrow::before {
            border-right-color: #2c3e50;
        }

        /* === BADGE ANIMATIONS === */
        .feature-badge {
            animation: fadeInScale 0.6s ease-out;
            animation-fill-mode: both;
        }

        .feature-badge:nth-child(1) { animation-delay: 0.1s; }
        .feature-badge:nth-child(2) { animation-delay: 0.2s; }
        .feature-badge:nth-child(3) { animation-delay: 0.3s; }
        .feature-badge:nth-child(4) { animation-delay: 0.4s; }

        @keyframes fadeInScale {
            0% {
                opacity: 0;
                transform: scale(0.8);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* === CARD ENTRANCE ANIMATIONS === */
        .honey-card {
            opacity: 0;
            transform: translateY(30px);
            animation: cardEntrance 0.8s ease-out forwards;
        }

        .honey-card:nth-child(1) { animation-delay: 0.1s; }
        .honey-card:nth-child(2) { animation-delay: 0.2s; }
        .honey-card:nth-child(3) { animation-delay: 0.3s; }
        .honey-card:nth-child(4) { animation-delay: 0.4s; }
        .honey-card:nth-child(5) { animation-delay: 0.5s; }
        .honey-card:nth-child(6) { animation-delay: 0.6s; }

        @keyframes cardEntrance {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === FLOATING ELEMENTS === */
        .floating-element {
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {
            0%, 100% {
                transform: translateY(0px);
            }
            50% {
                transform: translateY(-20px);
            }
        }

        /* === SHIMMER EFFECT === */
        .shimmer {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }

        @keyframes shimmer {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        /* === NOTIFICATION STYLES === */
        .notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: white;
            border-radius: 10px;
            padding: 1rem 1.5rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 9999;
            transform: translateX(400px);
            transition: transform 0.5s ease;
        }

        .notification.show {
            transform: translateX(0);
        }

        .notification.success {
            border-left: 4px solid #28a745;
        }

        .notification.error {
            border-left: 4px solid #dc3545;
        }

        .notification.warning {
            border-left: 4px solid #ffc107;
        }

        .notification.info {
            border-left: 4px solid #17a2b8;
        }

        /* === SKELETON LOADING === */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: -200% 0;
            }
            100% {
                background-position: 200% 0;
            }
        }

        .skeleton-card {
            background: white;
            border-radius: 15px;
            padding: 1rem;
            margin-bottom: 1rem;
        }

        .skeleton-img {
            height: 200px;
            background: #f0f0f0;
            border-radius: 10px;
            margin-bottom: 1rem;
        }

        .skeleton-text {
            height: 20px;
            background: #f0f0f0;
            border-radius: 4px;
            margin-bottom: 0.5rem;
        }

        .skeleton-text.short {
            width: 60%;
        }

        .skeleton-text.medium {
            width: 80%;
        }

        /* === PERFORMANCE OPTIMIZATIONS === */
        .honey-card-img {
            will-change: transform;
        }

        .btn-dark-custom {
            will-change: transform, box-shadow;
        }

        /* === CONTAINER QUERIES (Future-proofing) === */
        @container (min-width: 400px) {
            .honey-card {
                padding: 1.5rem;
            }
        }

        /* === UTILITY CLASSES === */
        .text-gradient {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .shadow-soft {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .shadow-medium {
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
        }

        .shadow-strong {
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .border-radius-lg {
            border-radius: 15px;
        }

        .border-radius-xl {
            border-radius: 20px;
        }

        /* === ANIMATION UTILITIES === */
        .animate-bounce {
            animation: bounce 1s infinite;
        }

        .animate-pulse {
            animation: pulse 2s infinite;
        }

        .animate-spin {
            animation: spin 1s linear infinite;
        }

        .animate-ping {
            animation: ping 1s cubic-bezier(0, 0, 0.2, 1) infinite;
        }

        @keyframes bounce {
            0%, 100% {
                transform: translateY(-25%);
                animation-timing-function: cubic-bezier(0.8, 0, 1, 1);
            }
            50% {
                transform: translateY(0);
                animation-timing-function: cubic-bezier(0, 0, 0.2, 1);
            }
        }

        @keyframes ping {
            75%, 100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* === LAYOUT UTILITIES === */
        .flex-center {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .flex-between {
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .flex-column-center {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
         /* === 3. Honey STATS SECTION === */
        .honey-stats-section {
            background: linear-gradient(135deg, #759da0 0%, #193344 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            color: white;
        }

        .stat-card {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
        }

        .stat-label {
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
        }

        /* === SPACING UTILITIES === */
        .gap-xs { gap: 0.25rem; }
        .gap-sm { gap: 0.5rem; }
        .gap-md { gap: 1rem; }
        .gap-lg { gap: 1.5rem; }
        .gap-xl { gap: 2rem; }

        /* === COLOR UTILITIES === */
        .text-honey { color: #f39c12; }
        .text-honey-dark { color: #e67e22; }
        .bg-honey { background-color: #f39c12; }
        .bg-honey-dark { background-color: #e67e22; }
        .bg-honey-light { background-color: rgba(243, 156, 18, 0.1); }

        /* === BORDER UTILITIES === */
        .border-honey { border-color: #f39c12; }
        .border-honey-dark { border-color: #e67e22; }

        /* === FINAL RESPONSIVE ADJUSTMENTS === */
        @media (max-width: 1400px) {
            .hero-content {
                padding-left: 200px;
            }
        }

        @media (max-width: 1200px) {
            .hero-content {
                padding-left: 150px;
            }
            
            .hero-title {
                font-size: 60px;
                letter-spacing: 20px;
            }
        }

        @media (max-width: 992px) {
            .hero-content {
                padding-left: 100px;
            }
            
            .hero-title {
                font-size: 50px;
                letter-spacing: 15px;
            }
        }

        @media (max-width: 768px) {
            .hero-content {
                padding-left: 50px;
                text-align: center;
            }
            
            .hero-title {
                font-size: 40px;
                letter-spacing: 10px;
            }
        }

        @media (max-width: 576px) {
            .hero-content {
                padding-left: 30px;
                padding-right: 30px;
            }
            
            .hero-title {
                font-size: 30px;
                letter-spacing: 5px;
            }
            
            .hero-desc {
                font-size: 14px;
            }
        }
    </style>
    
@endsection


