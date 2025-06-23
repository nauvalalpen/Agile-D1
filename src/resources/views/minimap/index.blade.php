@extends('layouts.app')

@section('styles')
    <style>
        .minimap-container {
            position: relative;
            max-width: 100%;
            margin: 0 auto;
            border: 2px solid #dee2e6;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .minimap-image {
            width: 100%;
            height: auto;
            display: block;
            cursor: grab;
            transition: transform 0.3s ease;
        }

        .minimap-image:active {
            cursor: grabbing;
        }

        .minimap-controls {
            position: absolute;
            top: 10px;
            right: 10px;
            z-index: 10;
        }

        .minimap-controls .btn {
            margin: 2px;
            opacity: 0.8;
        }

        .minimap-controls .btn:hover {
            opacity: 1;
        }

        .zoom-level {
            position: absolute;
            bottom: 10px;
            left: 10px;
            background: rgba(0, 0, 0, 0.7);
            color: white;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 12px;
        }

        .minimap-legend {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 6px;
            padding: 10px;
            margin-top: 15px;
        }

        .legend-item {
            display: flex;
            align-items: center;
            margin-bottom: 5px;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 3px;
            margin-right: 8px;
        }
    </style>
@endsection

@section('content')
    {{-- First Section of page as static --}}
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">DIGITAL<br>NAVIGATION</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="/minimap" class="hero-btn">More info</a>
        </div>
    </section>
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">{{ $minimapData['title'] ?? 'Digital Minimap' }}</h4>
                        <div>
                            <button class="btn btn-outline-primary btn-sm" onclick="resetZoom()">
                                <i class="fas fa-home"></i> Reset View
                            </button>
                            <a href="{{ route('minimap.fullscreen') }}" class="btn btn-primary btn-sm" target="_blank">
                                <i class="fas fa-expand"></i> Fullscreen
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <p class="text-muted">
                            {{ $minimapData['description'] ?? 'Use mouse wheel to zoom, click and drag to pan around the map.' }}
                        </p>

                        <div class="minimap-container" id="minimapContainer">
                            <div class="minimap-controls">
                                <button class="btn btn-light btn-sm" onclick="zoomIn()">
                                    <i class="fas fa-plus"></i>
                                </button>
                                <button class="btn btn-light btn-sm" onclick="zoomOut()">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                            <img src="{{ asset('images/minimap/oneVision-Minimap.jpg') }}" alt="Digital Navigation Map"
                                class="minimap-image" id="minimapImage" draggable="false">

                            <div class="zoom-level" id="zoomLevel">
                                Zoom: 100%
                            </div>
                        </div>

                        <div class="minimap-legend">
                            <h6 class="mb-3">Map Legend</h6>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #28a745;"></div>
                                        <span>Tourist Attractions</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #007bff;"></div>
                                        <span>Facilities</span>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #ffc107;"></div>
                                        <span>Tour Guide Areas</span>
                                    </div>
                                    <div class="legend-item">
                                        <div class="legend-color" style="background-color: #dc3545;"></div>
                                        <span>Important Locations</span>
                                    </div>
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
        let startX, startY, scrollLeft, scrollTop;

        const minimapImage = document.getElementById('minimapImage');
        const minimapContainer = document.getElementById('minimapContainer');
        const zoomLevel = document.getElementById('zoomLevel');

        function updateZoomDisplay() {
            zoomLevel.textContent = `Zoom: ${Math.round(currentZoom * 100)}%`;
        }

        function zoomIn() {
            if (currentZoom < 3) {
                currentZoom += 0.25;
                minimapImage.style.transform = `scale(${currentZoom})`;
                updateZoomDisplay();
            }
        }

        function zoomOut() {
            if (currentZoom > 0.5) {
                currentZoom -= 0.25;
                minimapImage.style.transform = `scale(${currentZoom})`;
                updateZoomDisplay();
            }
        }

        function resetZoom() {
            currentZoom = 1;
            minimapImage.style.transform = `scale(${currentZoom})`;
            minimapContainer.scrollLeft = 0;
            minimapContainer.scrollTop = 0;
            updateZoomDisplay();
        }

        // Enhanced pan functionality
        minimapContainer.addEventListener('mousedown', (e) => {
            isDragging = true;
            minimapContainer.style.cursor = 'grabbing';
            startX = e.pageX - minimapContainer.offsetLeft;
            startY = e.pageY - minimapContainer.offsetTop;
            scrollLeft = minimapContainer.scrollLeft;
            scrollTop = minimapContainer.scrollTop;
        });

        minimapContainer.addEventListener('mouseleave', () => {
            isDragging = false;
            minimapContainer.style.cursor = 'grab';
        });

        minimapContainer.addEventListener('mouseup', () => {
            isDragging = false;
            minimapContainer.style.cursor = 'grab';
        });

        minimapContainer.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();
            const x = e.pageX - minimapContainer.offsetLeft;
            const y = e.pageY - minimapContainer.offsetTop;
            const walkX = (x - startX) * 2;
            const walkY = (y - startY) * 2;
            minimapContainer.scrollLeft = scrollLeft - walkX;
            minimapContainer.scrollTop = scrollTop - walkY;
        });

        // Enhanced zoom with mouse wheel
        minimapContainer.addEventListener('wheel', (e) => {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        });

        // Double-click to zoom
        minimapContainer.addEventListener('dblclick', (e) => {
            e.preventDefault();
            zoomIn();
        });

        // Initialize
        updateZoomDisplay();
    </script>

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
    @include('layouts.footer')
@endsection
