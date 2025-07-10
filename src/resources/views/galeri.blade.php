@extends('layouts.app')

@section('content')
    {{-- Include AOS (Animate on Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Include Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">GALERI<br>WISATA</div>
            <div class="hero-desc"> Nikmati keindahan alam yang menakjubkan di salah satu destinasi wisata alam terbaik di
                Sumatera Barat.</div>
            <a href="#gallery-grid" class="hero-btn">Lihat Galeri</a>
        </div>
    </section>

    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. MAIN GALLERY GRID (with Overlay Details) -->
        <div id="gallery-grid" class="modern-gallery-section">
            <div class="gallery-header" data-aos="fade-up">
                <h2 class="gallery-title">Keindahan Alam</h2>
                <p class="gallery-subtitle">Temukan pesona alam melalui koleksi foto menakjubkan yang memukau mata dan
                    menyentuh jiwa</p>
            </div>

            <div class="modern-gallery-grid">
                @forelse ($galleries as $gallery)
                    <div class="gallery-card" data-aos="fade-up" data-aos-delay="{{ ($loop->index % 6) * 100 }}">

                        <div class="card-image-container">
                            @if ($gallery->foto)
                                <img src="{{ asset('storage/' . $gallery->foto) }}" class="card-image"
                                    alt="{{ $gallery->judul }}" loading="lazy">
                            @else
                                <div class="image-placeholder">
                                    <i class="fas fa-mountain-sun"></i>
                                    <span>Coming Soon</span>
                                </div>
                            @endif

                            <!-- Overlay with Details -->
                            <div class="card-overlay">
                                <div class="overlay-background"></div>

                                <div class="overlay-content">
                                    <!-- Top Section - Category & Date -->
                                    <div class="overlay-header">
                                        <span class="overlay-category">
                                            <i class="fas fa-tag"></i>
                                            {{ $gallery->kategori ?? 'Nature' }}
                                        </span>
                                        <span class="overlay-date">
                                            <i class="fas fa-calendar"></i>
                                            {{ \Carbon\Carbon::parse($gallery->tanggal)->format('M Y') }}
                                        </span>
                                    </div>

                                    <!-- Middle Section - Title & Description -->
                                    <div class="overlay-body">
                                        <h3 class="overlay-title">{{ $gallery->judul }}</h3>
                                        <p class="overlay-description">{{ Str::limit($gallery->deskripsi, 120) }}</p>
                                    </div>

                                    <!-- Bottom Section - Actions -->
                                    <div class="overlay-actions">

                                        <button class="overlay-btn secondary"
                                            onclick="showImageViewer('{{ asset('storage/' . $gallery->foto) }}', '{{ $gallery->judul }}')"
                                            title="View Full Size">
                                            <i class="fas fa-expand"></i>
                                            <span>Perbesar</span>
                                        </button>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>
                @empty
                    <div class="empty-gallery-state" data-aos="fade-up">
                        <div class="empty-icon">
                            <i class="fas fa-images"></i>
                        </div>
                        <h3>Galeri Sedang Dipersiapkan</h3>
                        <p>Koleksi foto menakjubkan akan segera hadir untuk memanjakan mata Anda</p>
                        <button class="notify-button">
                            <i class="fas fa-bell"></i>
                            Beritahu Saya
                        </button>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 3. HERO TOUR GUIDE SECTION -->
        <div class="hero-tour-section my-5 py-5" data-aos="fade-up">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="hero-tour-text">
                        <h3>Rasakan Petualangan Bersama<br>Pemandu Wisata Terbaik Kami</h3>
                        <p>
                            Dari sesi melukis hingga petualangan luar ruangan, setiap pengalaman kami menjanjikan momen tak
                            terlupakan yang penuh inspirasi dan penyegaran. Jelajahi alam melalui pendakian seru atau kejar
                            gemuruh derasnya air terjun yang menakjubkan.
                        </p>
                        <a href="{{ route('tourguides.index') }}" class="btn btn-custom w-70" id="btn-view-details"> Temukan
                            Pemandu</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-tour-img">
                        <img src="{{ asset('images/explore-bg.jpg') }}" alt="Tour Guide">
                    </div>
                </div>
            </div>
        </div>

        <!-- 4. SCROLLABLE GALLERY -->
        @if ($galleries->count() > 0)
            <div class="scrolling-gallery-section" data-aos="fade-up">
                <div class="text-center mb-5">
                    <h2 class="section-heading">Potret Keindahan Lainnya</h2>
                    <p class="section-subheading">Sekilas keindahan alam yang menanti untuk Anda jelajahi.</p>
                </div>
                <div class="scroll-gallery">
                    <div class="scroll-track">
                        @foreach ($galleries->concat($galleries) as $gallery)
                            @if ($gallery->foto)
                                <div class="scroll-card">
                                    <img src="{{ asset('storage/' . $gallery->foto) }}" alt="{{ $gallery->judul }}">
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

    </div>

    <!-- Gallery Detail Modal -->
    <div class="modal fade" id="galleryDetailModal" tabindex="-1" aria-labelledby="galleryDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="galleryDetailModalLabel">Gallery Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="galleryDetailModalBody">
                    <div class="text-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                    <h5 class="modal-title text-white" id="imageViewerModalLabel">Image Viewer</h5>
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

        // Gallery data for JavaScript
        const galleryData = {!! json_encode(
            $galleries->map(function ($gallery) {
                return [
                    'id' => $gallery->id,
                    'judul' => $gallery->judul,
                    'deskripsi' => $gallery->deskripsi,
                    'foto' => $gallery->foto ? asset('storage/' . $gallery->foto) : null,
                    'tanggal' => $gallery->tanggal ? \Carbon\Carbon::parse($gallery->tanggal)->format('F j, Y') : 'N/A',
                    'created_at' => $gallery->created_at->format('F j, Y \a\t g:i A'),
                ];
            }),
        ) !!};

        // Modal management
        let currentModal = null;

        // Function to clean up modals
        function cleanupModals() {
            document.querySelectorAll('.modal-backdrop').forEach(function(backdrop) {
                backdrop.remove();
            });
            document.body.classList.remove('modal-open');
            document.body.style.overflow = '';
            document.body.style.paddingRight = '';
            document.querySelectorAll('.modal').forEach(function(modal) {
                modal.classList.remove('show');
                modal.style.display = 'none';
                modal.setAttribute('aria-hidden', 'true');
            });
            currentModal = null;
        }

        // Show gallery modal with details
        function showGalleryModal(galleryId) {
            const gallery = galleryData.find(function(g) {
                return g.id === galleryId;
            });

            if (!gallery) {
                alert('Gallery not found!');
                return;
            }

            const modal = document.getElementById('galleryDetailModal');
            const modalBody = document.getElementById('galleryDetailModalBody');
            const modalLabel = document.getElementById('galleryDetailModalLabel');

            modalLabel.textContent = gallery.judul;

            const imageSection = gallery.foto ?
                '<div class="position-relative">' +
                '<img src="' + gallery.foto + '" ' +
                'class="img-fluid rounded gallery-modal-img" ' +
                'alt="' + gallery.judul + '"' +
                'onclick="showImageViewer(\'' + gallery.foto + '\', \'' + gallery.judul + '\')"' +
                'style="cursor: pointer; transition: transform 0.3s ease;"' +
                'onmouseover="this.style.transform=\'scale(1.02)\'"' +
                'onmouseout="this.style.transform=\'scale(1)\'">' +
                '</div>' :
                '<div class="bg-light d-flex align-items-center justify-content-center rounded" style="height: 300px;">' +
                '<div class="text-center text-muted">' +
                '<i class="fas fa-image fa-3x mb-2"></i>' +
                '<p>No image available</p>' +
                '</div>' +
                '</div>';

            modalBody.innerHTML =
                '<div class="row">' +
                '<div class="col-md-7">' +
                imageSection +
                '</div>' +
                '<div class="col-md-5">' +
                '<div class="gallery-details">' +
                '<h5 class="mb-3">' +
                '<i class="fas fa-info-circle text-primary me-2"></i>' +
                'Details' +
                '</h5>' +
                '<div class="detail-item mb-3">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-heading text-secondary me-2"></i>' +
                'Title' +
                '</h6>' +
                '<p class="mb-0">' + gallery.judul + '</p>' +
                '</div>' +
                '<div class="detail-item mb-3">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-calendar-alt text-secondary me-2"></i>' +
                'Date' +
                '</h6>' +
                '<p class="mb-0">' + gallery.tanggal + '</p>' +
                '</div>' +
                '<div class="detail-item mb-3">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-clock text-secondary me-2"></i>' +
                'Added' +
                '</h6>' +
                '<p class="mb-0">' + gallery.created_at + '</p>' +
                '</div>' +
                '<div class="detail-item">' +
                '<h6 class="fw-bold mb-1">' +
                '<i class="fas fa-align-left text-secondary me-2"></i>' +
                'Description' +
                '</h6>' +
                '<p class="mb-0 text-justify">' + gallery.deskripsi.replace(/\n/g, '<br>') + '</p>' +
                '</div>' +
                '</div>' +
                '</div>' +
                '</div>';

            try {
                cleanupModals();
                currentModal = new bootstrap.Modal(modal, {
                    backdrop: true,
                    keyboard: true,
                    focus: true
                });
                currentModal.show();
            } catch (error) {
                console.error('Error showing modal:', error);
                alert('Error opening gallery details. Please try again.');
            }
        }

        // Show image viewer modal
        function showImageViewer(imageSrc, imageTitle) {
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
            // Add event listeners for modal cleanup
            document.querySelectorAll('.modal').forEach(function(modal) {
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(cleanupModals, 100);
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
                    const target = document.querySelector('#gallery-grid');
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }
        });

        // Make functions globally available
        window.showGalleryModal = showGalleryModal;
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
            background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2)),
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

        /* === 2. MODERN GALLERY SECTION WITH OVERLAY DETAILS === */
        .modern-gallery-section {
            padding: 5rem 0;
            background: linear-gradient(135deg, #fafbfc 0%, #f1f3f4 100%);
            position: relative;
        }

        .modern-gallery-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(34, 139, 34, 0.03) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(34, 139, 34, 0.03) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Gallery Header */
        .gallery-header {
            text-align: center;
            margin-bottom: 4rem;
            position: relative;
            z-index: 2;
        }

        .header-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: rgba(34, 139, 34, 0.1);
            color: #228B22;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 1.5rem;
            border: 1px solid rgba(34, 139, 34, 0.2);
        }

        .gallery-title {
            font-size: 3.5rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 1rem;
            letter-spacing: -0.02em;
            position: relative;
        }

        .gallery-title::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 4px;
            background: linear-gradient(135deg, #228B22, #32CD32);
            border-radius: 2px;
        }

        .gallery-subtitle {
            font-size: 1.1rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
            line-height: 1.6;
        }

        /* Modern Gallery Grid */
        .modern-gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(380px, 1fr));
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            position: relative;
            z-index: 2;
        }

        /* Gallery Card with Overlay */
        .gallery-card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            position: relative;
            border: 1px solid rgba(0, 0, 0, 0.05);
            cursor: pointer;
        }

        .gallery-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 40px rgba(0, 0, 0, 0.15);
        }

        /* Card Image Container */
        .card-image-container {
            position: relative;
            height: 300px;
            overflow: hidden;
        }

        .card-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .gallery-card:hover .card-image {
            transform: scale(1.1);
        }

        .image-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: #adb5bd;
            font-size: 1.1rem;
            font-weight: 500;
        }

        .image-placeholder i {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
        }

        /* Card Overlay - The Main Feature */
        .card-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s cubic-bezier(0.25, 0.46, 0.45, 0.94);
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            padding: 1.5rem;
            z-index: 10;
        }

        .gallery-card:hover .card-overlay {
            opacity: 1;
            visibility: visible;
        }

        .overlay-background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg,
                    rgba(0, 0, 0, 0.7) 0%,
                    rgba(34, 139, 34, 0.8) 50%,
                    rgba(0, 0, 0, 0.9) 100%);
            backdrop-filter: blur(2px);
            z-index: -1;
        }

        .overlay-content {
            display: flex;
            flex-direction: column;
            height: 100%;
            justify-content: space-between;
            position: relative;
            z-index: 2;
        }

        /* Overlay Header */
        .overlay-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 1rem;
        }

        .overlay-category,
        .overlay-date {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            padding: 0.4rem 0.8rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .overlay-category {
            background: rgba(255, 255, 255, 0.9);
            color: #228B22;
        }

        /* Overlay Body */
        .overlay-body {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
            text-align: center;
            margin: 1rem 0;
        }

        .overlay-title {
            color: white;
            font-size: 1.4rem;
            font-weight: 700;
            margin-bottom: 0.8rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.5);
            line-height: 1.3;
        }

        .overlay-description {
            color: rgba(255, 255, 255, 0.9);
            font-size: 0.95rem;
            line-height: 1.5;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.5);
            margin: 0;
        }

        /* Overlay Actions */
        .overlay-actions {
            display: flex;
            gap: 0.8rem;
            justify-content: center;
            margin-top: auto;
        }

        .overlay-btn {
            background: rgba(255, 255, 255, 0.9);
            border: none;
            border-radius: 25px;
            padding: 0.6rem 1.2rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .overlay-btn.primary {
            background: rgba(34, 139, 34, 0.9);
            color: white;
            flex: 1;
            justify-content: center;
        }

        .overlay-btn.primary:hover {
            background: rgba(34, 139, 34, 1);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(34, 139, 34, 0.4);
        }

        .overlay-btn.secondary {
            color: #228B22;
            padding: 0.6rem;
            min-width: 45px;
            justify-content: center;
        }

        .overlay-btn.secondary:hover {
            background: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        /* Click Indicator */
        .click-indicator {
            position: absolute;
            bottom: 1rem;
            left: 50%;
            transform: translateX(-50%);
            color: rgba(255, 255, 255, 0.8);
            font-size: 0.8rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            opacity: 0;
            animation: fadeInOut 2s ease-in-out infinite;
        }

        .click-ripple {
            width: 8px;
            height: 8px;
            background: white;
            border-radius: 50%;
            animation: ripple 2s ease-in-out infinite;
        }

        @keyframes fadeInOut {

            0%,
            100% {
                opacity: 0;
            }

            50% {
                opacity: 1;
            }
        }

        @keyframes ripple {
            0% {
                transform: scale(1);
                opacity: 1;
            }

            100% {
                transform: scale(2);
                opacity: 0;
            }
        }

        /* Empty State */
        .empty-gallery-state {
            grid-column: 1 / -1;
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .empty-icon {
            font-size: 4rem;
            color: #228B22;
            margin-bottom: 1.5rem;
            opacity: 0.8;
        }

        .empty-gallery-state h3 {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .empty-gallery-state p {
            color: #6c757d;
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .notify-button {
            background: #228B22;
            color: white;
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .notify-button:hover {
            background: #1e6b1e;
            transform: translateY(-2px);
        }

        /* === 3. HERO TOUR GUIDE SECTION === */
        .hero-tour-section {
            background-color: #fff;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .hero-tour-img img {
            max-width: 100%;
            border-radius: 16px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
        }

        .hero-tour-text h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
            color: #212529;
        }

        .hero-tour-text p {
            font-size: 1rem;
            line-height: 1.7;
            color: #555;
            margin-bottom: 1.5rem;
        }

        #btn-view-details {
            border-radius: 50px;
            color: white;
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.4);
            padding: 12px 35px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        #btn-view-details:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(34, 139, 34, 0.5);
            color: white;
        }

        /* === 4. SCROLLING GALLERY === */
        .scrolling-gallery-section {
            overflow: hidden;
            margin-top: 4rem;
        }

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

        .scroll-gallery {
            display: flex;
            overflow: hidden;
            -webkit-mask-image: linear-gradient(to right, transparent, #000 10%, #000 90%, transparent);
            mask-image: linear-gradient(to right, transparent, #000 10%, #000 90%, transparent);
        }

        .scroll-track {
            display: flex;
            gap: 20px;
            animation: scroll 40s linear infinite;
        }

        .scroll-card {
            flex: 0 0 auto;
            width: 250px;
            height: 320px;
            border-radius: 14px;
            overflow: hidden;
            transition: transform 0.3s ease;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }

        .scroll-card:hover {
            transform: scale(1.05);
        }

        .scroll-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
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
        }

        .modal-body {
            padding: 1.5rem;
        }

        .modal-footer {
            border-top: 1px solid #dee2e6;
            padding: 1rem 1.5rem;
        }

        .gallery-modal-img {
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            max-height: 400px;
            width: 100%;
            object-fit: cover;
        }

        .gallery-details {
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

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 1200px) {
            .hero-content {
                padding: 0 3rem 0 10rem;
            }

            .modern-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 1.5rem;
            }
        }

        @media (max-width: 992px) {
            .hero-section {
                justify-content: center;
                text-align: center;
                height: 75vh;
            }

            .hero-content {
                padding: 0 2rem;
            }

            .hero-title {
                font-size: 60px;
                letter-spacing: 15px;
            }

            .hero-desc {
                margin-left: auto;
                margin-right: auto;
            }

            .gallery-title {
                font-size: 2.8rem;
            }

            .modern-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            }

            .hero-tour-section {
                padding: 2rem;
            }

            .hero-tour-text h3 {
                font-size: 1.5rem;
            }
        }

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

            .modern-gallery-section {
                padding: 3rem 0;
            }

            .gallery-header {
                margin-bottom: 3rem;
            }

            .gallery-title {
                font-size: 2.2rem;
            }

            .modern-gallery-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 1.2rem;
            }

            .card-image-container {
                height: 250px;
            }

            .card-overlay {
                padding: 1.2rem;
            }

            .overlay-title {
                font-size: 1.2rem;
            }

            .overlay-description {
                font-size: 0.9rem;
            }

            .overlay-btn {
                font-size: 0.8rem;
                padding: 0.5rem 1rem;
            }

            .overlay-btn.secondary {
                padding: 0.5rem;
                min-width: 40px;
            }

            .modal-dialog {
                margin: 1rem;
            }

            .gallery-details {
                padding-left: 0;
                margin-top: 1rem;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                height: 65vh;
            }

            .hero-content {
                padding: 0 1rem;
            }

            .hero-title {
                font-size: 36px;
                letter-spacing: 5px;
            }

            .modern-gallery-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .gallery-title {
                font-size: 1.8rem;
            }

            .card-image-container {
                height: 220px;
            }

            .card-overlay {
                padding: 1rem;
            }

            .overlay-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.5rem;
            }

            .overlay-actions {
                flex-direction: column;
                gap: 0.6rem;
            }

            .overlay-btn.primary,
            .overlay-btn.secondary {
                width: 100%;
                justify-content: center;
            }

            .scroll-card {
                width: 200px;
                height: 260px;
            }

            .click-indicator {
                font-size: 0.75rem;
            }
        }

        /* === LOADING ANIMATIONS === */
        .gallery-card {
            opacity: 0;
            animation: fadeInUp 0.6s ease forwards;
        }

        .gallery-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .gallery-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .gallery-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .gallery-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .gallery-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .gallery-card:nth-child(6) {
            animation-delay: 0.6s;
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

        /* === ACCESSIBILITY === */
        .gallery-card:focus {
            outline: 3px solid rgba(34, 139, 34, 0.5);
            outline-offset: 2px;
        }

        .overlay-btn:focus {
            outline: 2px solid rgba(255, 255, 255, 0.8);
            outline-offset: 2px;
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

        /* === BODY MODAL FIXES === */
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

        /* === LOADING SPINNER === */
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        /* === SMOOTH TRANSITIONS === */
        * {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* === PERFORMANCE OPTIMIZATIONS === */
        .card-image,
        .card-overlay {
            will-change: transform, opacity;
        }

        .overlay-background {
            will-change: opacity;
        }

        /* === REDUCED MOTION SUPPORT === */
        @media (prefers-reduced-motion: reduce) {

            .gallery-card,
            .overlay-btn,
            .card-image,
            .card-overlay {
                animation: none !important;
                transition: none !important;
            }

            .gallery-card:hover {
                transform: none;
            }

            .click-indicator,
            .click-ripple {
                animation: none !important;
            }
        }

        /* === ENHANCED HOVER EFFECTS === */
        .gallery-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(34, 139, 34, 0.1), transparent);
            opacity: 0;
            transition: opacity 0.3s ease;
            pointer-events: none;
            border-radius: 16px;
            z-index: 1;
        }

        .gallery-card:hover::before {
            opacity: 1;
        }

        /* === OVERLAY ENTRANCE ANIMATIONS === */
        .overlay-header {
            transform: translateY(-20px);
            opacity: 0;
            transition: all 0.4s ease 0.1s;
        }

        .overlay-body {
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.4s ease 0.2s;
        }

        .overlay-actions {
            transform: translateY(20px);
            opacity: 0;
            transition: all 0.4s ease 0.3s;
        }

        .gallery-card:hover .overlay-header,
        .gallery-card:hover .overlay-body,
        .gallery-card:hover .overlay-actions {
            transform: translateY(0);
            opacity: 1;
        }

        /* === ENHANCED VISUAL EFFECTS === */
        .gallery-card {
            position: relative;
            overflow: hidden;
        }

        .gallery-card::after {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg,
                    transparent,
                    rgba(255, 255, 255, 0.2),
                    transparent);
            transition: left 0.6s ease;
            pointer-events: none;
            z-index: 5;
        }

        .gallery-card:hover::after {
            left: 100%;
        }

        /* === CATEGORY BADGE STYLES === */
        .overlay-category i {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.7;
            }
        }

        /* === BUTTON RIPPLE EFFECT === */
        .overlay-btn {
            position: relative;
            overflow: hidden;
        }

        .overlay-btn::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.3s ease, height 0.3s ease;
        }

        .overlay-btn:hover::before {
            width: 100px;
            height: 100px;
        }

        /* === IMPROVED EMPTY STATE === */
        .empty-gallery-state {
            position: relative;
            overflow: hidden;
        }

        .empty-gallery-state::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg,
                    transparent 30%,
                    rgba(34, 139, 34, 0.05) 50%,
                    transparent 70%);
            animation: shimmer 3s ease-in-out infinite;
        }

        @keyframes shimmer {
            0% {
                transform: translateX(-100%);
            }

            100% {
                transform: translateX(100%);
            }
        }

        /* === ENHANCED SCROLLING GALLERY === */
        .scroll-card {
            position: relative;
        }

        .scroll-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(to bottom,
                    transparent 60%,
                    rgba(0, 0, 0, 0.8) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
            border-radius: 14px;
        }

        .scroll-card:hover::before {
            opacity: 1;
        }

        /* === FINAL RESPONSIVE ADJUSTMENTS === */
        @media (max-width: 480px) {
            .modern-gallery-section {
                padding: 2rem 0;
            }

            .gallery-header {
                margin-bottom: 2rem;
            }

            .header-badge {
                font-size: 0.8rem;
                padding: 0.4rem 1rem;
            }

            .gallery-title {
                font-size: 1.6rem;
            }

            .gallery-subtitle {
                font-size: 0.95rem;
            }

            .card-image-container {
                height: 200px;
            }

            .overlay-title {
                font-size: 1.1rem;
            }

            .overlay-description {
                font-size: 0.85rem;
            }

            .overlay-btn {
                font-size: 0.75rem;
                padding: 0.4rem 0.8rem;
            }

            .empty-gallery-state {
                padding: 3rem 1rem;
            }

            .empty-icon {
                font-size: 3rem;
            }

            .empty-gallery-state h3 {
                font-size: 1.3rem;
            }

            .notify-button {
                padding: 0.6rem 1.5rem;
                font-size: 0.9rem;
            }
        }

        /* === PRINT STYLES === */
        @media print {

            .hero-section,
            .hero-tour-section,
            .scrolling-gallery-section {
                display: none;
            }

            .modern-gallery-section {
                background: white;
                padding: 1rem 0;
            }

            .gallery-card {
                break-inside: avoid;
                box-shadow: none;
                border: 1px solid #ddd;
            }

            .card-overlay {
                display: none;
            }
        }

        /* === HIGH CONTRAST MODE === */
        @media (prefers-contrast: high) {
            .gallery-card {
                border: 2px solid #000;
            }

            .overlay-background {
                background: rgba(0, 0, 0, 0.9);
            }

            .overlay-btn {
                border: 2px solid currentColor;
            }
        }

        /* === DARK MODE SUPPORT === */
        @media (prefers-color-scheme: dark) {
            .modern-gallery-section {
                background: linear-gradient(135deg, #fefffe 0%, #fdfffd 50%, #fcfffc 100%);
            }

            .gallery-card {
                background: #333;
                border-color: #444;
            }

            .gallery-title {
                color: #212529;
            }

            .gallery-subtitle {
                color: #6c757d;
            }

            .header-badge {
                background: rgba(34, 139, 34, 0.3);
                color: #90EE90;
                border-color: rgba(34, 139, 34, 0.5);
            }

            .empty-gallery-state {
                background: #333;
                color: #fff;
            }

            .empty-gallery-state h3 {
                color: #fff;
            }

            .empty-gallery-state p {
                color: #ccc;
            }
        }
    </style>
@endsection
