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
@endsection
