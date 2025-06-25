@extends('layouts.app')

@section('content')
    {{-- Include AOS (Animate on Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Include Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">GALLERY<br>WISATA</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="#gallery-grid" class="hero-btn">More info</a>
        </div>
    </section>

    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. MAIN GALLERY GRID (with Modals) -->
        <div id="gallery-grid" class="gallery-container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-heading">Explore Our Gallery</h2>
                <p class="section-subheading">Click on any item to view more details and see the full picture.</p>
            </div>

            <div class="row">
                @forelse ($galleries as $gallery)
                    <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                        <div class="gallery-card w-100" data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                            <div class="gallery-card-img-wrapper">
                                @if ($gallery->foto)
                                    <img src="{{ asset('storage/' . $gallery->foto) }}" class="gallery-card-img"
                                        alt="{{ $gallery->judul }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $gallery->judul }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ \Carbon\Carbon::parse($gallery->tanggal)->format('d M Y') }}
                                </h6>
                                <p class="card-text">{{ Str::limit($gallery->deskripsi, 100) }}</p>
                                <div class="mt-auto">
                                    <button type="button" class="btn btn-custom w-100" id="btn-view-details"
                                        onclick="showGalleryModal({{ $gallery->id }})">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <h3>No gallery items available at the moment.</h3>
                        <p class="text-muted">Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 3. HERO TOUR GUIDE SECTION -->
        <div class="hero-tour-section my-5 py-5" data-aos="fade-up">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="hero-tour-text">
                        <h3>Experience Adventure with<br>Our Best Tour Guides</h3>
                        <p>
                            From painting sessions to outdoor escapades, our experiences promise unforgettable moments of
                            inspiration and rejuvenation. Venture into nature's embrace on our thrilling hiking adventures
                            or chase the thundering roar of cascading waterfalls.
                        </p>
                        <a href="{{ route('tourguides.index') }}" class="btn btn-custom w-70" id="btn-view-details">Find a
                            Guide</a>
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
                    <h2 class="section-heading">More Visuals</h2>
                    <p class="section-subheading">A glimpse into the stunning scenery awaiting you.</p>
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
                        <p class="mt-2">Loading gallery details...</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Image Viewer Modal -->
    <div class="modal fade" id="imageViewerModal" tabindex="-1" aria-labelledby="imageViewerModalLabel" aria-hidden="true">
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

        // Show gallery modal with details
        function showGalleryModal(galleryId) {
            console.log('Opening gallery modal for ID:', galleryId);

            // Find gallery data
            const gallery = galleryData.find(function(g) {
                return g.id === galleryId;
            });

            if (!gallery) {
                console.error('Gallery not found:', galleryId);
                alert('Gallery not found!');
                return;
            }

            const modal = document.getElementById('galleryDetailModal');
            const modalBody = document.getElementById('galleryDetailModalBody');
            const modalLabel = document.getElementById('galleryDetailModalLabel');

            if (!modal || !modalBody || !modalLabel) {
                console.error('Modal elements not found');
                alert('Modal elements not found!');
                return;
            }

            // Set modal title
            modalLabel.textContent = gallery.judul;

            // Create modal content
            const imageSection = gallery.foto ?
                '<div class="position-relative">' +
                '<img src="' + gallery.foto + '" ' +
                'class="img-fluid rounded gallery-modal-img" ' +
                'alt="' + gallery.judul + '"' +
                'onclick="showImageViewer(\'' + gallery.foto + '\', \'' + gallery.judul + '\')"' +
                'style="cursor: pointer; transition: transform 0.3s ease;"' +
                'onmouseover="this.style.transform=\'scale(1.02)\'"' +
                'onmouseout="this.style.transform=\'scale(1)\'">' +
                '<div class="position-absolute top-0 end-0 m-2">' +
                '<button class="btn btn-sm btn-light rounded-circle" ' +
                'onclick="showImageViewer(\'' + gallery.foto + '\', \'' + gallery.judul + '\')"' +
                'title="View full size">' +
                '<i class="fas fa-expand"></i>' +
                '</button>' +
                '</div>' +
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
                alert('Error opening gallery details. Please try again.');
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
            console.log('Gallery page loaded with', galleryData.length, 'galleries');

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
                    const target = document.querySelector('#gallery-grid');
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

            // Add hover effects to gallery cards
            document.querySelectorAll('.gallery-card').forEach(function(card) {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });
        });

        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('JavaScript error:', e.error);
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

        /* === 1. HERO SECTION (FIXED TO MATCH BERITA PAGE) === */
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

        /* === 2. MAIN GALLERY GRID === */
        .gallery-container {
            margin-top: -80px;
            position: relative;
            z-index: 2;
            background: #f8f9fa;
            padding: 4rem 2rem;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .gallery-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            height: 100%;
        }

        .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .gallery-card-img-wrapper {
            height: 220px;
            overflow: hidden;
            position: relative;
        }

        .gallery-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-card:hover .gallery-card-img {
            transform: scale(1.1);
        }

        .card-body {
            padding: 1.5rem;
        }

        .card-title {
            font-weight: 600;
            color: #212529;
            margin-bottom: 0.5rem;
        }

        .card-subtitle {
            font-size: 0.9rem;
            color: #6c757d;
        }

        .card-text {
            color: #495057;
            line-height: 1.6;
            flex-grow: 1;
        }

        /* === UNIFIED BUTTON STYLES (View Details & Find a Guide) === */
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

        /* Gallery modal specific styles */
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

        /* === 4. SCROLLING GALLERY === */
        .scrolling-gallery-section {
            overflow: hidden;
            margin-top: 4rem;
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

            .gallery-container {
                margin-top: -40px;
                padding: 2rem 1rem;
            }

            .hero-tour-section {
                padding: 2rem;
            }

            .hero-tour-text h3 {
                font-size: 1.5rem;
            }

            .section-heading {
                font-size: 2rem;
            }

            .modal-dialog {
                margin: 1rem;
            }

            .gallery-details {
                padding-left: 0;
                margin-top: 1rem;
            }

            .btn-dark-custom {
                padding: 10px 25px;
                font-size: 0.9rem;
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

            .gallery-card-img-wrapper {
                height: 180px;
            }

            .scroll-card {
                width: 200px;
                height: 260px;
            }

            .btn-dark-custom {
                padding: 8px 20px;
                font-size: 0.85rem;
            }
        }

        /* === LOADING SPINNER === */
        .spinner-border {
            width: 3rem;
            height: 3rem;
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

        #btn-view-details {
            border-radius: 50px;
            color: white;
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.4);
        }

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
@endsection
