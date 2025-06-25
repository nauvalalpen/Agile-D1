<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullscreen Digital Minimap - Navigation System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-gradient: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            --secondary-gradient: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            --success-gradient: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
            --warning-gradient: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
            --danger-gradient: linear-gradient(135deg, #fa709a 0%, #fee140 100%);
            --shadow-light: 0 4px 15px rgba(0, 0, 0, 0.1);
            --shadow-medium: 0 8px 25px rgba(0, 0, 0, 0.15);
            --shadow-heavy: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
            background: linear-gradient(135deg, #0c0c0c 0%, #1a1a1a 100%);
            color: white;
            user-select: none;
        }

        .fullscreen-minimap {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: auto;
            cursor: grab;
            display: flex;
            align-items: center;
            justify-content: center;
            background: radial-gradient(circle at center, #1a1a1a 0%, #0c0c0c 100%);
        }

        .fullscreen-minimap:active {
            cursor: grabbing;
        }

        .fullscreen-image {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 8px;
            box-shadow: var(--shadow-heavy);
        }

        /* Enhanced Control Panel */
        .control-panel {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 12px;
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 16px;
            padding: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: var(--shadow-medium);
        }

        .control-btn {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.15);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            color: white;
            cursor: pointer;
            transition: all 0.3s ease;
            backdrop-filter: blur(10px);
        }

        .control-btn:hover {
            background: rgba(255, 255, 255, 0.25);
            transform: scale(1.05);
            box-shadow: var(--shadow-light);
        }

        .control-btn:active {
            transform: scale(0.95);
        }

        .control-btn.zoom-in:hover {
            background: var(--success-gradient);
            border-color: transparent;
        }

        .control-btn.zoom-out:hover {
            background: var(--warning-gradient);
            border-color: transparent;
        }

        .control-btn.reset:hover {
            background: var(--primary-gradient);
            border-color: transparent;
        }

        .control-btn.close:hover {
            background: var(--danger-gradient);
            border-color: transparent;
        }

        /* Enhanced Info Panel */
        .info-panel {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.8);
            backdrop-filter: blur(20px);
            color: white;
            padding: 20px 24px;
            border-radius: 16px;
            font-size: 14px;
            border: 1px solid rgba(255, 255, 255, 0.1);
            box-shadow: var(--shadow-medium);
            min-width: 280px;
        }

        .zoom-display {
            display: flex;
            align-items: center;
            gap: 8px;
            font-weight: 600;
            font-size: 16px;
            margin-bottom: 8px;
            color: #4facfe;
        }

        .controls-hint {
            display: flex;
            flex-direction: column;
            gap: 4px;
            opacity: 0.8;
            font-size: 12px;
        }

        .hint-item {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hint-icon {
            width: 16px;
            text-align: center;
            opacity: 0.6;
        }

        /* Close Button */
        .close-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
            background: var(--danger-gradient);
            border: none;
            color: white;
            padding: 12px 20px;
            border-radius: 25px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: var(--shadow-light);
            backdrop-filter: blur(10px);
        }

        .close-btn:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-medium);
            background: linear-gradient(135deg, #ff6b6b 0%, #ee5a24 100%);
        }

        /* Loading Animation */
        .loading-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.8);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 9999;
        }

        .loading-spinner {
            width: 50px;
            height: 50px;
            border: 4px solid rgba(255, 255, 255, 0.3);
            border-top: 4px solid #4facfe;
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

        /* Responsive Design */
        @media (max-width: 768px) {
            .control-panel {
                top: 10px;
                right: 10px;
                padding: 12px;
                gap: 8px;
            }

            .control-btn {
                width: 45px;
                height: 45px;
                font-size: 1.1rem;
            }

            .info-panel {
                bottom: 10px;
                left: 10px;
                padding: 16px 20px;
                min-width: 250px;
                font-size: 13px;
            }

            .close-btn {
                top: 10px;
                left: 10px;
                padding: 10px 16px;
                font-size: 14px;
            }
        }

        @media (max-width: 480px) {
            .control-panel {
                flex-direction: row;
                top: auto;
                bottom: 80px;
                right: 50%;
                transform: translateX(50%);
                padding: 8px 12px;
            }

            .control-btn {
                width: 40px;
                height: 40px;
                font-size: 1rem;
            }

            .info-panel {
                bottom: 10px;
                left: 10px;
                right: 10px;
                min-width: auto;
                text-align: center;
            }

            .zoom-display {
                justify-content: center;
            }

            .controls-hint {
                display: none;
            }
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb {
            background: var(--primary-gradient);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--secondary-gradient);
        }

        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }

        .fullscreen-image {
            transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        /* Auto-hide controls */
        .controls-hidden .control-panel,
        .controls-hidden .info-panel,
        .controls-hidden .close-btn {
            opacity: 0.3;
        }
    </style>
</head>

<body>
    <!-- Loading Overlay -->
    <div class="loading-overlay" id="loadingOverlay">
        <div class="text-center">
            <div class="loading-spinner mb-3"></div>
            <p>Memuat peta digital...</p>
        </div>
    </div>

    <!-- Main Container -->
    <div class="fullscreen-minimap" id="fullscreenContainer">
        <!-- Close Button -->
        <button class="btn btn-danger close-btn" onclick="window.close()">
            <i class="fas fa-times"></i> Close
        </button>

        <!-- Control Panel -->
        <div class="control-panel">
            <button class="control-btn zoom-in" onclick="zoomIn()" title="Zoom In">
                <i class="fas fa-plus"></i>
            </button>

            <button class="control-btn zoom-out" onclick="zoomOut()" title="Zoom Out">
                <i class="fas fa-minus"></i>
            </button>

            <button class="control-btn reset" onclick="resetView()" title="Reset View">
                <i class="fas fa-home"></i>
            </button>
        </div>

        <!-- Main Image -->
        <img src="{{ asset('images/minimap/oneVision-Minimap.jpg') }}" alt="Fullscreen Navigation Map"
            class="fullscreen-image" id="fullscreenImage" draggable="false" loading="eager">

        <!-- Info Panel -->
        <div class="info-panel" id="infoPanel">
            <div class="zoom-display" id="zoomDisplay">
                <i class="fas fa-search-plus"></i>
                <span>Zoom: 100%</span>
            </div>
            <div class="controls-hint">
                <div class="hint-item">
                    <i class="fas fa-mouse hint-icon"></i>
                    <span>Klik dan drag untuk menggeser</span>
                </div>
                <div class="hint-item">
                    <i class="fas fa-hand-paper hint-icon"></i>
                    <span>Gunakan tombol untuk zoom</span>
                </div>
                <div class="hint-item">
                    <i class="fas fa-mobile-alt hint-icon"></i>
                    <span>Pinch untuk zoom di mobile</span>
                </div>
            </div>
        </div>
    </div>

    <script>
        let zoom = 1;
        let isDragging = false;
        let startX, startY, scrollLeft, scrollTop;
        let isLoading = false;

        const container = document.getElementById('fullscreenContainer');
        const image = document.getElementById('fullscreenImage');
        const zoomDisplay = document.getElementById('zoomDisplay');
        const loadingOverlay = document.getElementById('loadingOverlay');

        // Show/Hide loading
        function showLoading() {
            if (!isLoading) {
                isLoading = true;
                loadingOverlay.style.display = 'flex';
                setTimeout(hideLoading, 600);
            }
        }

        function hideLoading() {
            isLoading = false;
            loadingOverlay.style.display = 'none';
        }

        // Update zoom display with enhanced visual feedback
        function updateZoomDisplay() {
            const percentage = Math.round(zoom * 100);
            const icon = zoom > 1 ? 'fa-search-plus' : zoom < 1 ? 'fa-search-minus' : 'fa-search';

            zoomDisplay.innerHTML = `
                <i class="fas ${icon}"></i>
                <span>Zoom: ${percentage}%</span>
            `;

            // Add visual feedback
            zoomDisplay.style.transform = 'scale(1.1)';
            zoomDisplay.style.color = '#4facfe';

            setTimeout(() => {
                zoomDisplay.style.transform = 'scale(1)';
                zoomDisplay.style.color = '#4facfe';
            }, 200);
        }

        // Enhanced zoom functions
        function zoomIn() {
            if (zoom < 5) {
                showLoading();
                zoom += 0.25;
                image.style.transform = `scale(${zoom})`;
                updateZoomDisplay();

                // Add active state to button
                const btn = document.querySelector('.zoom-in');
                btn.style.transform = 'scale(0.9)';
                setTimeout(() => btn.style.transform = 'scale(1)', 150);
            }
        }

        function zoomOut() {
            if (zoom > 0.25) {
                showLoading();
                zoom -= 0.25;
                image.style.transform = `scale(${zoom})`;
                updateZoomDisplay();

                // Add active state to button
                const btn = document.querySelector('.zoom-out');
                btn.style.transform = 'scale(0.9)';
                setTimeout(() => btn.style.transform = 'scale(1)', 150);
            }
        }

        function resetView() {
            showLoading();
            zoom = 1;
            image.style.transform = `scale(${zoom})`;
            container.scrollLeft = 0;
            container.scrollTop = 0;
            updateZoomDisplay();

            // Add active state to button
            const btn = document.querySelector('.reset');
            btn.style.transform = 'scale(0.9)';
            setTimeout(() => btn.style.transform = 'scale(1)', 150);
        }

        // Close fullscreen
        function closeFullscreen() {
            if (window.opener) {
                window.close();
            } else {
                // Fallback for browsers that don't allow window.close()
                window.history.back();
            }
        }

        // Enhanced pan functionality
        container.addEventListener('mousedown', (e) => {
            if (e.target === image || e.target === container) {
                isDragging = true;
                container.style.cursor = 'grabbing';
                startX = e.pageX - container.offsetLeft;
                startY = e.pageY - container.offsetTop;
                scrollLeft = container.scrollLeft;
                scrollTop = container.scrollTop;

                // Visual feedback
                image.style.filter = 'brightness(0.9)';
            }
        });

        container.addEventListener('mouseleave', () => {
            isDragging = false;
            container.style.cursor = 'grab';
            image.style.filter = 'brightness(1)';
        });

        container.addEventListener('mouseup', () => {
            isDragging = false;
            container.style.cursor = 'grab';
            image.style.filter = 'brightness(1)';
        });

        container.addEventListener('mousemove', (e) => {
            if (!isDragging) return;
            e.preventDefault();

            const x = e.pageX - container.offsetLeft;
            const y = e.pageY - container.offsetTop;
            const walkX = (x - startX) * 2;
            const walkY = (y - startY) * 2;
            container.scrollLeft = scrollLeft - walkX;
            container.scrollTop = scrollTop - walkY;
        });

        // Double-click to zoom
        container.addEventListener('dblclick', (e) => {
            e.preventDefault();
            zoomIn();
        });

        // Touch support for mobile devices
        let touchStartDistance = 0;
        let touchStartZoom = 1;
        let touchStartTime = 0;

        container.addEventListener('touchstart', (e) => {
            touchStartTime = Date.now();

            if (e.touches.length === 2) {
                e.preventDefault();
                touchStartDistance = Math.hypot(
                    e.touches[0].pageX - e.touches[1].pageX,
                    e.touches[0].pageY - e.touches[1].pageY
                );
                touchStartZoom = zoom;
            }
        });

        container.addEventListener('touchmove', (e) => {
            if (e.touches.length === 2) {
                e.preventDefault();
                const touchDistance = Math.hypot(
                    e.touches[0].pageX - e.touches[1].pageX,
                    e.touches[0].pageY - e.touches[1].pageY
                );
                const scale = touchDistance / touchStartDistance;
                const newZoom = Math.min(5, Math.max(0.25, touchStartZoom * scale));

                if (Math.abs(newZoom - zoom) > 0.1) {
                    zoom = newZoom;
                    image.style.transform = `scale(${zoom})`;
                    updateZoomDisplay();
                }
            }
        });

        // Double tap to zoom on mobile
        container.addEventListener('touchend', (e) => {
            const touchEndTime = Date.now();
            const touchDuration = touchEndTime - touchStartTime;

            if (touchDuration < 300 && e.changedTouches.length === 1) {
                // This is a tap, check for double tap
                if (container.lastTapTime && (touchEndTime - container.lastTapTime) < 300) {
                    e.preventDefault();
                    zoomIn();
                    container.lastTapTime = null;
                } else {
                    container.lastTapTime = touchEndTime;
                }
            }
        });

        // Performance optimization - throttle functions
        function throttle(func, wait) {
            let timeout;
            return function executedFunction(...args) {
                const later = () => {
                    clearTimeout(timeout);
                    func(...args);
                };
                clearTimeout(timeout);
                timeout = setTimeout(later, wait);
            };
        }

        // Optimized resize handler
        const throttledResize = throttle(() => {
            // Adjust image size on window resize
            const containerRect = container.getBoundingClientRect();
            const imageRect = image.getBoundingClientRect();

            // Center image if it's smaller than container
            if (imageRect.width < containerRect.width) {
                container.scrollLeft = 0;
            }
            if (imageRect.height < containerRect.height) {
                container.scrollTop = 0;
            }
        }, 250);

        window.addEventListener('resize', throttledResize);

        // Image load handlers
        image.addEventListener('load', () => {
            hideLoading();
            console.log('Minimap loaded successfully');
        });

        image.addEventListener('error', () => {
            hideLoading();
            console.error('Failed to load minimap image');

            // Show error message
            const errorMsg = document.createElement('div');
            errorMsg.innerHTML = `
                <div style="text-align: center; color: #ff6b6b; padding: 2rem;">
                    <i class="fas fa-exclamation-triangle" style="font-size: 3rem; margin-bottom: 1rem;"></i>
                    <h3>Gagal Memuat Peta</h3>
                    <p>Terjadi kesalahan saat memuat gambar peta digital.</p>
                    <button onclick="location.reload()" style="
                        background: var(--primary-gradient);
                        color: white;
                        border: none;
                        padding: 10px 20px;
                        border-radius: 20px;
                        cursor: pointer;
                        margin-top: 1rem;
                    ">
                        <i class="fas fa-redo"></i> Coba Lagi
                    </button>
                </div>
            `;
            container.appendChild(errorMsg);
        });

        // Context menu prevention (optional)
        container.addEventListener('contextmenu', (e) => {
            e.preventDefault();
        });

        // Prevent text selection
        container.addEventListener('selectstart', (e) => {
            e.preventDefault();
        });

        // Auto-hide controls after inactivity
        let inactivityTimer;
        let controlsVisible = true;

        function resetInactivityTimer() {
            clearTimeout(inactivityTimer);

            if (!controlsVisible) {
                showControls();
            }

            inactivityTimer = setTimeout(() => {
                hideControls();
            }, 4000);
        }

        function showControls() {
            controlsVisible = true;
            document.body.classList.remove('controls-hidden');
        }

        function hideControls() {
            controlsVisible = false;
            document.body.classList.add('controls-hidden');
        }

        // Mouse movement detection for auto-hide
        container.addEventListener('mousemove', resetInactivityTimer);
        container.addEventListener('mousedown', resetInactivityTimer);
        document.addEventListener('keydown', resetInactivityTimer);

        // Touch events for mobile
        container.addEventListener('touchstart', resetInactivityTimer);
        container.addEventListener('touchmove', resetInactivityTimer);

        // Prevent controls from hiding when hovering over them
        document.querySelector('.control-panel').addEventListener('mouseenter', () => {
            clearTimeout(inactivityTimer);
        });

        document.querySelector('.control-panel').addEventListener('mouseleave', resetInactivityTimer);

        document.querySelector('.info-panel').addEventListener('mouseenter', () => {
            clearTimeout(inactivityTimer);
        });

        document.querySelector('.info-panel').addEventListener('mouseleave', resetInactivityTimer);

        // Accessibility improvements
        document.addEventListener('keydown', (e) => {
            // Arrow keys for panning
            const panStep = 50;
            switch (e.key) {
                case 'ArrowUp':
                    e.preventDefault();
                    container.scrollTop -= panStep;
                    resetInactivityTimer();
                    break;
                case 'ArrowDown':
                    e.preventDefault();
                    container.scrollTop += panStep;
                    resetInactivityTimer();
                    break;
                case 'ArrowLeft':
                    e.preventDefault();
                    container.scrollLeft -= panStep;
                    resetInactivityTimer();
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    container.scrollLeft += panStep;
                    resetInactivityTimer();
                    break;
                case 'Escape':
                    e.preventDefault();
                    closeFullscreen();
                    break;
            }
        });

        // Add focus indicators for keyboard navigation
        document.querySelectorAll('.control-btn, .close-btn').forEach(btn => {
            btn.addEventListener('focus', () => {
                btn.style.outline = '2px solid #4facfe';
                btn.style.outlineOffset = '2px';
            });

            btn.addEventListener('blur', () => {
                btn.style.outline = 'none';
            });
        });

        // Enhanced error handling
        window.addEventListener('error', (e) => {
            console.error('Fullscreen minimap error:', e.error);
            hideLoading();
        });

        // Memory cleanup on page unload
        window.addEventListener('beforeunload', () => {
            // Clear timers
            clearTimeout(inactivityTimer);

            // Remove event listeners
            window.removeEventListener('resize', throttledResize);
        });

        // Add visual feedback for touch interactions
        if ('ontouchstart' in window) {
            container.addEventListener('touchstart', () => {
                image.style.filter = 'brightness(0.95)';
            });

            container.addEventListener('touchend', () => {
                image.style.filter = 'brightness(1)';
            });
        }

        // Initialize
        updateZoomDisplay();
        resetInactivityTimer();

        // Show initial loading
        showLoading();

        // Smooth entrance animation
        setTimeout(() => {
            document.body.style.opacity = '1';
            image.style.opacity = '1';
        }, 100);

        console.log('Fullscreen Digital Minimap initialized successfully');
    </script>
</body>

</html>
