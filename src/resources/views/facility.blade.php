@extends('layouts.app')

@section('content')
    {{-- Include AOS (Animate on Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Include Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">FASILITAS<br>UNGGULAN</div>
            <div class="hero-desc">Jelajahi beragam fasilitas modern dan lengkap yang kami sediakan untuk menunjang aktivitas
                dan kenyamanan Anda.</div>
            <a href="#facilities-grid" class="hero-btn">Lihat Fasilitas</a>
        </div>
    </section>

    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. MAIN FACILITIES GRID (with Modals) -->
        <div id="facilities-grid" class="facilities-container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-heading">Fasilitas Terbaik Kami</h2>
                <p class="section-subheading">Nikmati berbagai fasilitas berkualitas tinggi yang dirancang khusus untuk
                    memberikan pengalaman terbaik bagi Anda.</p>
            </div>

            <div class="row">
                @forelse ($facilities as $facility)
                    <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                        <div class="facility-card w-100" data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                            <div class="facility-card-img-wrapper">
                                @if ($facility->foto)
                                    <img src="{{ asset('storage/' . $facility->foto) }}" class="facility-card-img"
                                        alt="{{ $facility->nama_fasilitas }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-building fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="facility-overlay">
                                    <div class="facility-overlay-content">
                                        <i class="fas fa-eye fa-2x mb-2"></i>
                                        <p class="mb-0">Lihat Detail</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $facility->nama_fasilitas }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    <i class="fas fa-map-marker-alt me-2"></i>{{ $facility->lokasi }}
                                </h6>
                                <p class="card-text">{{ Str::limit($facility->deskripsi, 100) }}</p>
                                <div class="mt-auto">
                                    <button type="button" class="btn btn-dark-custom w-100"
                                        onclick="showFacilityModal({{ $facility->id }})">
                                        Lihat Detail
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <div class="empty-state">
                            <i class="fas fa-building fa-4x text-muted mb-3"></i>
                            <h3>Belum Ada Fasilitas</h3>
                            <p class="text-muted">Fasilitas akan segera hadir. Silakan periksa kembali nanti.</p>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 3. FACILITIES STATS SECTION -->
        @if ($facilities->count() > 0)
            <div class="facilities-stats-section my-5 py-5" data-aos="fade-up">
                <div class="row text-center g-4">
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-building"></i>
                            </div>
                            <h3 class="stat-number">{{ $facilities->count() }}</h3>
                            <p class="stat-label">Total Fasilitas</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <h3 class="stat-number">{{ $facilities->pluck('lokasi')->unique()->count() }}</h3>
                            <p class="stat-label">Lokasi Berbeda</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-star"></i>
                            </div>
                            <h3 class="stat-number">2/4</h3>
                            <p class="stat-label">Akses Tersedia</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-shield-alt"></i>
                            </div>
                            <h3 class="stat-number">100%</h3>
                            <p class="stat-label">Aman & Nyaman</p>
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
                            Tim kami siap membantu Anda mendapatkan informasi lengkap tentang fasilitas yang tersedia.
                            Hubungi kami untuk konsultasi gratis dan dapatkan rekomendasi fasilitas yang sesuai dengan
                            kebutuhan Anda.
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

    <!-- Facility Detail Modal -->
    <div class="modal fade" id="facilityDetailModal" tabindex="-1" aria-labelledby="facilityDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="facilityDetailModalLabel">Detail Fasilitas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="facilityDetailModalBody">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <p class="mt-2">Memuat detail fasilitas...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });

        // Facility data for JavaScript
        const facilityData = {!! json_encode(
            $facilities->map(function ($facility) {
                return [
                    'id' => $facility->id,
                    'nama_fasilitas' => $facility->nama_fasilitas,
                    'lokasi' => $facility->lokasi,
                    'deskripsi' => $facility->deskripsi,
                    'foto' => $facility->foto ? asset('storage/' . $facility->foto) : null,
                    'created_at' => $facility->created_at->format('F j, Y \a\t g:i A'),
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

        // Show facility modal with details
        function showFacilityModal(facilityId) {
            console.log('Opening facility modal for ID:', facilityId);

            // Find facility data
            const facility = facilityData.find(function(f) {
                return f.id === facilityId;
            });

            if (!facility) {
                console.error('Facility not found:', facilityId);
                alert('Fasilitas tidak ditemukan!');
                return;
            }

            const modal = document.getElementById('facilityDetailModal');
            const modalBody = document.getElementById('facilityDetailModalBody');
            const modalLabel = document.getElementById('facilityDetailModalLabel');

            if (!modal || !modalBody || !modalLabel) {
                console.error('Modal elements not found');
                alert('Elemen modal tidak ditemukan!');
                return;
            }

            // Set modal title
            modalLabel.textContent = facility.nama_fasilitas;

            // Create modal content
            const imageSection = facility.foto ?
                '<div class="position-relative">' +
                '<img src="' + facility.foto + '" ' +
                'class="img-fluid rounded facility-modal-img" ' +
                'alt="' + facility.nama_fasilitas + '"' +
                'onclick="showImageViewer(\'' + facility.foto + '\', \'' + facility.nama_fasilitas + '\')"' +
                'style="cursor: pointer; transition: transform 0.3s ease;"' +
                'onmouseover="this.style.transform=\'scale(1.02)\'"' +
                'onmouseout="this.style.transform=\'scale(1)\'">' +
                '<div class="position-absolute top-0 end-0 m-2">' +
                '<button class="btn btn-sm btn-light rounded-circle" ' +
                'onclick="showImageViewer(\'' + facility.foto + '\', \'' + facility.nama_fasilitas + '\')"' +
                'title="Lihat ukuran penuh">' +
                '<i class="fas fa-expand"></i>' +
                '</button>' +
                '</div>' +
                '</div>' :
                '<div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px;">' +
                '<div class="text-center text-muted">' +
                '<i class="fas fa-building fa-3x mb-2"></i>' +
                '<p>Tidak ada gambar tersedia</p>' +
                '</div>' +
                '</div>';

            modalBody.innerHTML =
                '<div class="row">' +
                '<div class="col-md-7">' +
                imageSection +
                '</div>' +
                '<div class="col-md-5">' +
                '<div class="facility-details">' +
                '<h5 class="mb-3">' +
                '<i class="fas fa-info-circle text-primary me-2"></i>' +
                'Informasi Detail' +
                '</h5>' +

                '<div class="detail-item mb-3">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-building text-secondary me-2"></i>' +
                'Nama Fasilitas' +
                '</h6>' +
                '<p class="mb-0">' + facility.nama_fasilitas + '</p>' +
                '</div>' +

                '<div class="detail-item mb-3">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-map-marker-alt text-secondary me-2"></i>' +
                'Lokasi' +
                '</h6>' +
                '<p class="mb-0">' + facility.lokasi + '</p>' +
                '</div>' +

                '<div class="detail-item mb-3">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-clock text-secondary me-2"></i>' +
                'Ditambahkan' +
                '</h6>' +
                '<p class="mb-0">' + facility.created_at + '</p>' +
                '</div>' +

                '<div class="detail-item">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-align-left text-secondary me-2"></i>' +
                'Deskripsi' +
                '</h6>' +
                '<p class="mb-0 text-justify">' + facility.deskripsi.replace(/\n/g, '<br>') + '</p>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

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
                alert('Error membuka detail fasilitas. Silakan coba lagi.');
            }
        }

        // Show image viewer modal
        function showImageViewer(imageSrc, imageTitle) {
            console.log('Opening image viewer for:', imageTitle);

            const modal = document.getElementById('imageViewerModal');
            const modalImg = document.getElementById('imageViewerImg');
            const modalLabel = document.getElementById('imageViewerModalLabel');

            if (!modal || !modalImg || !modalLabel) {
                console.error('Image viewer modal elements not found');
                return;
            }

            modalImg.src = imageSrc;
            modalImg.alt = imageTitle;
            modalLabel.textContent = imageTitle;

            try {
                const imageModal = new bootstrap.Modal(modal, {
                    backdrop: true,
                    keyboard: true,
                    focus: true
                });

                imageModal.show();
            } catch (error) {
                console.error('Error showing image viewer:', error);
            }
        }

        // Document ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Facility page loaded with', facilityData.length, 'facilities');

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
                    const target = document.querySelector('#facilities-grid');
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

            // Add hover effects to facility cards
            document.querySelectorAll('.facility-card').forEach(function(card) {
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
        window.showFacilityModal = showFacilityModal;
        window.showImageViewer = showImageViewer;
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

        /* === 2. MAIN FACILITIES GRID === */
        .facilities-container {
            margin-top: -80px;
            position: relative;
            z-index: 2;
            background: #f8f9fa;
            padding: 4rem 2rem;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .facility-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            height: 100%;
            position: relative;
        }

        .facility-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .facility-card-img-wrapper {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .facility-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .facility-card:hover .facility-card-img {
            transform: scale(1.1);
        }

        .facility-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.7);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
            color: white;
            text-align: center;
        }

        .facility-card:hover .facility-overlay {
            opacity: 1;
        }

        .facility-overlay-content {
            transform: translateY(20px);
            transition: transform 0.3s ease;
        }

        .facility-card:hover .facility-overlay-content {
            transform: translateY(0);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
            font-size: 1.25rem;
        }

        .card-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
            font-weight: 500;
        }

        .card-text {
            color: #495057;
            line-height: 1.6;
            flex-grow: 1;
            margin-bottom: 1rem;
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

        /* === EMPTY STATE === */
        .empty-state {
            background: #fff;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        }

        .empty-state h3 {
            color: #212529;
            margin-bottom: 1rem;
        }

        /* === 3. FACILITIES STATS SECTION === */
        .facilities-stats-section {
            background: linear-gradient(135deg, #92c1f0 0%, #0099ff 100%);
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

        /* === MODAL Z-INDEX FIXES === */
        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1050 !important;
        }

        .modal.show {
            display: block !important;
        }

        /* === LOADING SPINNER === */
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
                letter-spacing: 0.2rem;
            }

            .hero-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .facilities-container {
                margin-top: -40px;
                padding: 2rem 1rem;
            }

            .cta-section {
                padding: 2rem;
            }

            .facilities-stats-section {
                padding: 2rem 1rem;
            }

            .cta-content h3 {
                font-size: 1.5rem;
            }

            .section-heading {
                font-size: 2rem;
            }

            .modal-dialog {
                margin: 1rem;
            }

            .facility-details {
                padding-left: 0;
                margin-top: 1rem;
            }

            .btn-dark-custom {
                padding: 10px 25px;
                font-size: 0.9rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-card {
                padding: 1rem;
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

            .facility-card-img-wrapper {
                height: 180px;
            }

            .btn-dark-custom {
                padding: 8px 20px;
                font-size: 0.85rem;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .facilities-stats-section {
                padding: 1.5rem 1rem;
            }

            .cta-section {
                padding: 1.5rem;
            }
        }

        /* === ACCESSIBILITY IMPROVEMENTS === */
        .btn:focus,
        .btn-close:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        /* === SMOOTH TRANSITIONS === */
        * {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* === FIX FOR MODAL BACKDROP ISSUES === */
        body.modal-open {
            overflow: hidden !important;
            padding-right: 0 !important;
        }

        .modal-open .modal {
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* === BUTTON CONSISTENCY === */
        .btn-secondary {
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        /* === ADDITIONAL ANIMATIONS === */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .stat-icon:hover {
            animation: pulse 1s infinite;
        }

        /* === GRADIENT BACKGROUNDS === */
        .gradient-bg-1 {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }

        .gradient-bg-2 {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }

        .gradient-bg-3 {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
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
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* === HOVER EFFECTS === */
        .facility-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
            z-index: 1;
        }

        .facility-card:hover::before {
            transform: translateX(100%);
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
            border: 2px solid #f3f3f3;
            border-top: 2px solid #3498db;
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

        /* === PRINT STYLES === */
        @media print {

            .hero-section,
            .modal,
            .btn {
                display: none !important;
            }

            .facility-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }
        }

        /* === HIGH CONTRAST MODE === */
        @media (prefers-contrast: high) {
            .facility-card {
                border: 2px solid #000;
            }

            .btn-dark-custom {
                border: 3px solid #000;
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
        }
    </style>
@endsection
