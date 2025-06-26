@extends('layouts.app')

@section('styles')
    <style>
        .minimap-container {
            position: relative;
            max-width: 100%;
            margin: 0 auto;
            border: 2px solid #28a745;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            height: 600px;
            background: #f8f9fa;
        }

        .minimap-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            display: block;
            cursor: grab;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform-origin: center center;
            user-select: none;
        }

        .minimap-image:active {
            cursor: grabbing;
        }

        .minimap-image.dragging {
            cursor: grabbing !important;
        }

        .minimap-image.active {
            cursor: grab;
        }

        .minimap-controls {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 10;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .control-btn {
            width: 45px;
            height: 45px;
            background: rgba(40, 167, 69, 0.9);
            border: none;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
            cursor: pointer;
        }

        .control-btn:hover {
            background: #28a745;
            transform: scale(1.05);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .zoom-level {
            position: absolute;
            bottom: 20px;
            left: 20px;
            background: rgba(40, 167, 69, 0.9);
            color: white;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 0.9rem;
            font-weight: 600;
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .minimap-legend {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 4rem;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(40, 167, 69, 0.2);
        }

        .legend-title {
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #28a745;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .legend-item {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: #f8f9fa;
            border-radius: 12px;
            transition: all 0.3s ease;
            border-left: 4px solid #28a745;
            margin-bottom: 0.5rem;
        }

        .legend-item:hover {
            background: #e8f5e8;
            transform: translateX(5px);
        }

        .legend-color {
            width: 24px;
            height: 24px;
            border-radius: 8px;
            margin-right: 1rem;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
            flex-shrink: 0;
        }

        .legend-text {
            font-weight: 600;
            color: #495057;
            font-size: 0.95rem;
        }

        /* Card Styles with Green Theme */
        .card {
            border-radius: 20px;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            border: none;
            overflow: hidden;
            transition: all 0.3s ease;
            margin-bottom: 3rem;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .card-header {
            background: linear-gradient(135deg, #28a745 0%, #20c997 100%);
            color: white;
            padding: 1.5rem 2rem;
            border: none;
            position: relative;
        }

        .card-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, #28a745, #20c997, #17a2b8, #32cd32);
        }

        .card-title {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 0;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .action-buttons {
            display: flex;
            gap: 0.75rem;
            flex-wrap: wrap;
        }

        .btn-custom {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            border-radius: 25px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-reset {
            background: linear-gradient(135deg, #32cd32 0%, #228b22 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            color: white;
        }

        .btn-fullscreen {
            background: linear-gradient(135deg, #20c997 0%, #17a2b8 100%);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .btn-fullscreen:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
            color: white;
        }

        /* Info Cards with Green Theme */
        .info-card {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 1.25rem;
            border-left: 4px solid #28a745;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            background: #e8f5e8;
            transform: translateX(5px);
        }

        .info-card h6 {
            font-weight: 600;
            margin-bottom: 0.75rem;
            color: #28a745;
        }

        .info-card ul li {
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            color: #495057;
        }

        .info-card ul li i {
            color: #28a745;
        }

        /* Container spacing for footer */
        .main-container {
            margin-bottom: 5rem;
        }

        /* HERO SECTION STYLES */
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
            transition: height 0.3s ease;
        }

        .hero-content {
            width: 100%;
            max-width: 1140px;
            padding: 0 30px 0 350px;
            opacity: 0;
            transform: translateY(30px);
            animation: fadeInUp 1.2s ease forwards;
            animation-delay: 0.3s;
            transition: padding 0.3s ease;
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
            transition: all 0.3s ease;
        }

        .hero-desc {
            font-size: 16px;
            margin-bottom: 28px;
            line-height: 1.6;
            color: #ddd;
            max-width: 500px;
            margin-left: 0;
            margin-right: 0;
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

        /* Visual feedback styles */
        .minimap-container.active {
            border-color: #20c997 !important;
            box-shadow: 0 4px 15px rgba(32, 201, 151, 0.3) !important;
        }

        .minimap-container {
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        .minimap-image {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), cursor 0.2s ease;
        }

        /* Instruction overlay */
        .instruction-overlay {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background: rgba(40, 167, 69, 0.9);
            color: white;
            padding: 1rem 2rem;
            border-radius: 10px;
            text-align: center;
            font-weight: 600;
            z-index: 5;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            pointer-events: none;
        }

        .minimap-container:hover .instruction-overlay {
            opacity: 1;
            visibility: visible;
        }

        .minimap-container.active .instruction-overlay {
            opacity: 0;
            visibility: hidden;
        }

        /* Responsive adjustments */
        @media (max-width: 1200px) {
            .hero-content {
                padding: 0 3rem 0 10rem;
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

            .minimap-controls {
                top: 10px;
                right: 10px;
            }

            .control-btn {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .zoom-level {
                bottom: 10px;
                left: 10px;
                font-size: 0.8rem;
                padding: 6px 12px;
            }

            .minimap-container {
                height: 400px;
            }

            .card-header {
                padding: 1rem;
                text-align: center;
            }

            .card-title {
                font-size: 1.25rem;
                justify-content: center;
                margin-bottom: 1rem;
            }

            .action-buttons {
                justify-content: center;
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

            .minimap-container {
                height: 350px;
            }

            .minimap-legend {
                padding: 1.5rem;
                margin: 1rem 10px 4rem 10px;
            }
        }

        /* Additional styles from original */
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

        .hot-topic-img-wrapper {
            height: 500px;
            position: relative;
            cursor: pointer;
            transition: transform 0.3s ease;
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

        .news-img {
            height: 250px;
            width: 100%;
            object-fit: cover;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
            transition: transform 0.3s ease;
        }

        .hover-shadow:hover .news-img {
            transform: scale(1.05);
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

        .btn-read-more {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 12px 30px;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #fff;
            font-weight: 600;
            font-size: 1.05rem;
            border: none;
            border-radius: 50px;
            text-decoration: none;
            transition: all 0.3s ease-in-out;
            box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3);
            gap: 0.5rem;
        }

        .btn-read-more:hover {
            background: linear-gradient(135deg, #218838, #1e7e34);
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
    </style>
@endsection

@section('content')
    {{-- Hero Section --}}
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">NAVIGASI<br>DIGITAL</div>
            <div class="hero-desc">Temukan arah dan lokasi wisata dengan mudah melalui panduan digital kami.</div>
            <a href="/minimap" class="hero-btn">Selengkapnya</a>
        </div>
    </section>

    {{-- Main Content --}}
    <div class="container mt-4 main-container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0">
                            <i class="fas fa-compass"></i>
                            {{ $minimapData['title'] ?? 'Peta Navigasi Digital' }}
                        </h4>
                        <div class="action-buttons">
                            <button class="btn-custom btn-reset" onclick="resetZoom()">
                                <i class="fas fa-home"></i> Atur Ulang Tampilan
                            </button>
                            <a href="{{ route('minimap.fullscreen') }}" class="btn-custom btn-fullscreen" target="_blank">
                                <i class="fas fa-expand"></i> Layar Penuh
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            {{ $minimapData['description'] ?? 'Klik pada gambar untuk mengaktifkan, lalu gunakan tombol zoom untuk memperbesar atau memperkecil. Klik dan seret untuk menggeser peta.' }}
                        </p>

                        <div class="minimap-container" id="minimapContainer">
                            <div class="minimap-controls">
                                <button class="control-btn" onclick="zoomIn()" title="Perbesar">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="control-btn" onclick="zoomOut()" title="Perkecil">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                            <img src="{{ asset('images/minimap/oneVision-Minimap.jpg') }}" alt="Peta Navigasi Digital"
                                class="minimap-image" id="minimapImage" draggable="false">

                            <div class="zoom-level" id="zoomLevel">
                                Zoom: 100%
                            </div>

                            <div class="instruction-overlay" id="instructionOverlay">
                                <i class="fas fa-mouse-pointer mb-2" style="font-size: 1.5rem;"></i><br>
                                Klik untuk mengaktifkan peta
                            </div>
                        </div>

                        <div class="minimap-legend">
                            <h6 class="legend-title mb-3">
                                <i class="fas fa-map-signs"></i>
                                Keterangan Peta
                            </h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #28a745;"></div>
                                        <span class="legend-text">Objek Wisata</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #007bff;"></div>
                                        <span class="legend-text">Fasilitas Umum</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #ffc107;"></div>
                                        <span class="legend-text">Area Pemandu Wisata</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #dc3545;"></div>
                                        <span class="legend-text">Lokasi Penting</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Additional Info --}}
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h6 class="mb-2">
                                        <i class="fas fa-info-circle me-1"></i>
                                        Tips Navigasi
                                    </h6>
                                    <ul class="list-unstyled small mb-0">
                                        <li><i class="fas fa-mouse-pointer me-1"></i> Klik gambar terlebih dahulu untuk mengaktifkan
                                        </li>
                                        <li><i class="fas fa-search-plus me-1"></i> Gunakan tombol zoom untuk memperbesar atau memperkecil</li>
                                        <li><i class="fas fa-hand-paper me-1"></i>  Klik dan seret untuk menggeser peta</li>
                                        <li><i class="fas fa-mobile-alt me-1"></i> Sentuh dan cubit pada perangkat mobile</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="info-card">
                                    <h6 class="mb-2">
                                        <i class="fas fa-lightbulb me-1"></i>
                                        Fitur Tambahan
                                    </h6>
                                    <ul class="list-unstyled small mb-0">
                                        <li><i class="fas fa-home me-1"></i> Atur ulang untuk kembali ke tampilan awal</li>
                                        <li><i class="fas fa-expand me-1"></i> Mode layar penuh untuk detail maksimal</li>
                                        <li><i class="fas fa-mobile-alt me-1"></i>  Responsif di semua perangkat</li>
                                        <li><i class="fas fa-eye me-1"></i> Zoom hingga 300% untuk melihat detail lebih jelas</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentZoom = 1;
        let isDragging = false;
        let isImageActive = false;
        let startX, startY;
        let currentTranslateX = 0;
        let currentTranslateY = 0;

        const minimapImage = document.getElementById('minimapImage');
        const minimapContainer = document.getElementById('minimapContainer');
        const zoomLevel = document.getElementById('zoomLevel');
        const instructionOverlay = document.getElementById('instructionOverlay');

        function updateZoomDisplay() {
            zoomLevel.textContent = `Zoom: ${Math.round(currentZoom * 100)}%`;

            // Visual feedback
            zoomLevel.style.transform = 'scale(1.1)';
            setTimeout(() => {
                zoomLevel.style.transform = 'scale(1)';
            }, 200);
        }

        function updateImageTransform() {
            minimapImage.style.transform =
            `scale(${currentZoom}) translate(${currentTranslateX}px, ${currentTranslateY}px)`;
        }

        function zoomIn() {
            if (currentZoom < 3) {
                currentZoom += 0.25;
                updateImageTransform();
                updateZoomDisplay();

                // Activate image if not already active
                if (!isImageActive) {
                    activateImage();
                }
            }
        }

        function zoomOut() {
            if (currentZoom > 0.5) {
                currentZoom -= 0.25;
                updateImageTransform();
                updateZoomDisplay();

                // Activate image if not already active
                if (!isImageActive) {
                    activateImage();
                }
            }
        }

        function resetZoom() {
            currentZoom = 1;
            currentTranslateX = 0;
            currentTranslateY = 0;
            updateImageTransform();
            deactivateImage();
            updateZoomDisplay();
        }

        function activateImage() {
            isImageActive = true;
            minimapContainer.classList.add('active');
            minimapImage.classList.add('active');
            instructionOverlay.style.opacity = '0';
            instructionOverlay.style.visibility = 'hidden';
        }

        function deactivateImage() {
            isImageActive = false;
            minimapContainer.classList.remove('active');
            minimapImage.classList.remove('active');
            isDragging = false;
        }

        // Image click to activate
        minimapImage.addEventListener('click', function(e) {
            e.preventDefault();
            e.stopPropagation();

            if (!isImageActive) {
                activateImage();
            }
        });

        // Mouse events for dragging
        minimapImage.addEventListener('mousedown', function(e) {
            if (!isImageActive) return;

            // Don't interfere with control buttons
            if (e.target.closest('.minimap-controls')) {
                return;
            }

            isDragging = true;
            minimapImage.classList.add('dragging');

            startX = e.clientX - currentTranslateX;
            startY = e.clientY - currentTranslateY;

            e.preventDefault();
        });

        document.addEventListener('mousemove', function(e) {
            if (!isDragging || !isImageActive) return;

            e.preventDefault();

            currentTranslateX = e.clientX - startX;
            currentTranslateY = e.clientY - startY;

            updateImageTransform();
        });

        document.addEventListener('mouseup', function() {
            if (isDragging) {
                isDragging = false;
                minimapImage.classList.remove('dragging');
            }
        });

        // Double-click to zoom
        minimapImage.addEventListener('dblclick', function(e) {
            e.preventDefault();

            if (!isImageActive) {
                activateImage();
            }

            zoomIn();
        });

        // Touch support for mobile
        let touchStartDistance = 0;
        let touchStartZoom = 1;
        let touchStartX = 0;
        let touchStartY = 0;
        let lastTapTime = 0;

        minimapImage.addEventListener('touchstart', function(e) {
            const currentTime = new Date().getTime();
            const tapLength = currentTime - lastTapTime;

            if (!isImageActive) {
                // Activate on first touch
                activateImage();
                lastTapTime = currentTime;
                return;
            }

            if (e.touches.length === 1) {
                touchStartX = e.touches[0].clientX - currentTranslateX;
                touchStartY = e.touches[0].clientY - currentTranslateY;

                // Double tap detection
                if (tapLength < 500 && tapLength > 0) {
                    e.preventDefault();
                    zoomIn();
                }
                lastTapTime = currentTime;

            } else if (e.touches.length === 2) {
                e.preventDefault();
                touchStartDistance = Math.hypot(
                    e.touches[0].clientX - e.touches[1].clientX,
                    e.touches[0].clientY - e.touches[1].clientY
                );
                touchStartZoom = currentZoom;
            }
        });

        minimapImage.addEventListener('touchmove', function(e) {
            if (!isImageActive) return;

            if (e.touches.length === 1) {
                e.preventDefault();
                currentTranslateX = e.touches[0].clientX - touchStartX;
                currentTranslateY = e.touches[0].clientY - touchStartY;
                updateImageTransform();

            } else if (e.touches.length === 2) {
                e.preventDefault();
                const touchDistance = Math.hypot(
                    e.touches[0].clientX - e.touches[1].clientX,
                    e.touches[0].clientY - e.touches[1].clientY
                );
                const scale = touchDistance / touchStartDistance;
                const newZoom = Math.min(3, Math.max(0.5, touchStartZoom * scale));

                if (Math.abs(newZoom - currentZoom) > 0.05) {
                    currentZoom = newZoom;
                    updateImageTransform();
                    updateZoomDisplay();
                }
            }
        });

        minimapImage.addEventListener('touchend', function(e) {
            touchStartDistance = 0;
            touchStartZoom = currentZoom;
        });

        // Prevent context menu
        minimapContainer.addEventListener('contextmenu', function(e) {
            e.preventDefault();
        });

        // Prevent text selection while dragging
        minimapContainer.addEventListener('selectstart', function(e) {
            if (isDragging) {
                e.preventDefault();
            }
        });

        // Keyboard shortcuts (only when image is active)
        document.addEventListener('keydown', function(e) {
            if (!isImageActive) return;

            const containerRect = minimapContainer.getBoundingClientRect();
            const isVisible = containerRect.top < window.innerHeight && containerRect.bottom > 0;

            if (!isVisible) return;

            switch (e.key) {
                case '+':
                case '=':
                    e.preventDefault();
                    zoomIn();
                    break;
                case '-':
                    e.preventDefault();
                    zoomOut();
                    break;
                case '0':
                    e.preventDefault();
                    resetZoom();
                    break;
                case 'Escape':
                    e.preventDefault();
                    deactivateImage();
                    break;
            }
        });

        // Click outside to deactivate
        document.addEventListener('click', function(e) {
            if (!minimapContainer.contains(e.target)) {
                deactivateImage();
            }
        });

        // IMPORTANT: Only prevent wheel events on the image when it's active
        minimapContainer.addEventListener('wheel', function(e) {
            // Only prevent default if the image is active and we're hovering over it
            if (isImageActive && e.target === minimapImage) {
                e.preventDefault();
            }
            // Otherwise, let the page scroll normally
        });

        // Add visual feedback for controls
        document.querySelectorAll('.control-btn').forEach(btn => {
            btn.addEventListener('mousedown', () => {
                btn.style.transform = 'scale(0.95)';
            });

            btn.addEventListener('mouseup', () => {
                btn.style.transform = 'scale(1.05)';
                setTimeout(() => {
                    btn.style.transform = 'scale(1)';
                }, 150);
            });

            btn.addEventListener('mouseleave', () => {
                btn.style.transform = 'scale(1)';
            });
        });

        // Image load handler
        minimapImage.addEventListener('load', () => {
            console.log('Minimap loaded successfully');
            updateZoomDisplay();
        });

        // Error handling
        minimapImage.addEventListener('error', () => {
            console.error('Failed to load minimap image');
            minimapContainer.innerHTML = `
                <div style="display: flex; align-items: center; justify-content: center; height: 100%; color: #28a745;">
                    <div style="text-align: center;">
                        <i class="fas fa-exclamation-triangle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                        <h4>Failed to Load Map</h4>
                        <p>Please refresh the page to try again.</p>
                        <button onclick="location.reload()" class="btn-custom btn-reset">
                            <i class="fas fa-redo"></i> Refresh
                        </button>
                    </div>
                </div>
            `;
        });

        // Handle window resize
        let resizeTimeout;
        window.addEventListener('resize', function() {
            clearTimeout(resizeTimeout);
            resizeTimeout = setTimeout(() => {
                if (window.innerWidth !== window.previousWidth) {
                    resetZoom();
                    window.previousWidth = window.innerWidth;
                }
            }, 250);
        });

        window.previousWidth = window.innerWidth;

        // Add focus handling for accessibility
        minimapContainer.setAttribute('tabindex', '0');

        minimapContainer.addEventListener('focus', function() {
            this.style.outline = '2px solid #28a745';
            this.style.outlineOffset = '2px';
        });

        minimapContainer.addEventListener('blur', function() {
            this.style.outline = 'none';
        });

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

        // Initialize
        updateZoomDisplay();

        // Add loading state
        minimapImage.style.opacity = '0';
        minimapImage.addEventListener('load', function() {
            this.style.opacity = '1';
        });

        console.log('Enhanced minimap with proper scroll handling and drag functionality initialized successfully');
    </script>

    @include('layouts.footer')
@endsection
