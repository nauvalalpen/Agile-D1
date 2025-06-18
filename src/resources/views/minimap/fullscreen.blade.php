<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fullscreen Digital Minimap</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            margin: 0;
            padding: 0;
            overflow: hidden;
            background: #000;
        }

        .fullscreen-minimap {
            position: relative;
            width: 100vw;
            height: 100vh;
            overflow: auto;
            cursor: grab;
        }

        .fullscreen-minimap:active {
            cursor: grabbing;
        }

        .fullscreen-image {
            width: 100%;
            height: 100%;
            object-fit: contain;
            transition: transform 0.3s ease;
        }

        .fullscreen-controls {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1000;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .fullscreen-info {
            position: fixed;
            bottom: 20px;
            left: 20px;
            background: rgba(0, 0, 0, 0.8);
            color: white;
            padding: 10px 15px;
            border-radius: 6px;
            font-size: 14px;
        }

        .close-btn {
            position: fixed;
            top: 20px;
            left: 20px;
            z-index: 1000;
        }
    </style>
</head>

<body>
    <div class="fullscreen-minimap" id="fullscreenContainer">
        <button class="btn btn-danger close-btn" onclick="window.close()">
            <i class="fas fa-times"></i> Close
        </button>

        <div class="fullscreen-controls">
            <button class="btn btn-light" onclick="zoomIn()">
                <i class="fas fa-plus"></i>
            </button>
            <button class="btn btn-light" onclick="zoomOut()">
                <i class="fas fa-minus"></i>
            </button>
            <button class="btn btn-light" onclick="resetView()">
                <i class="fas fa-home"></i>
            </button>
        </div>

        <img src="{{ asset('images/minimap/oneVision-Minimap.jpg') }}" alt="Fullscreen Navigation Map"
            class="fullscreen-image" id="fullscreenImage" draggable="false">

        <div class="fullscreen-info" id="fullscreenInfo">
            <div>Zoom: <span id="zoomDisplay">100%</span></div>
            <div><small>Use mouse wheel to zoom • Click and drag to pan</small></div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-fontawesome-kit.js"></script>
    <script>
        let zoom = 1;
        let isDragging = false;
        let startX, startY, scrollLeft, scrollTop;

        const container = document.getElementById('fullscreenContainer');
        const image = document.getElementById('fullscreenImage');
        const zoomDisplay = document.getElementById('zoomDisplay');

        function updateZoomDisplay() {
            zoomDisplay.textContent = `${Math.round(zoom * 100)}%`;
        }

        function zoomIn() {
            if (zoom < 5) {
                zoom += 0.25;
                image.style.transform = `scale(${zoom})`;
                updateZoomDisplay();
            }
        }

        function zoomOut() {
            if (zoom > 0.25) {
                zoom -= 0.25;
                image.style.transform = `scale(${zoom})`;
                updateZoomDisplay();
            }
        }

        function resetView() {
            zoom = 1;
            image.style.transform = `scale(${zoom})`;
            container.scrollLeft = 0;
            container.scrollTop = 0;
            updateZoomDisplay();
        }

        // Pan functionality
        container.addEventListener('mousedown', (e) => {
            isDragging = true;
            container.style.cursor = 'grabbing';
            startX = e.pageX - container.offsetLeft;
            startY = e.pageY - container.offsetTop;
            scrollLeft = container.scrollLeft;
            scrollTop = container.scrollTop;
        });

        container.addEventListener('mouseleave', () => {
            isDragging = false;
            container.style.cursor = 'grab';
        });

        container.addEventListener('mouseup', () => {
            isDragging = false;
            container.style.cursor = 'grab';
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

        // Zoom with mouse wheel
        container.addEventListener('wheel', (e) => {
            e.preventDefault();
            if (e.deltaY < 0) {
                zoomIn();
            } else {
                zoomOut();
            }
        });

        // Keyboard shortcuts
        document.addEventListener('keydown', (e) => {
            switch (e.key) {
                case 'Escape':
                    window.close();
                    break;
                case '+':
                case '=':
                    zoomIn();
                    break;
                case '-':
                    zoomOut();
                    break;
                case '0':
                    resetView();
                    break;
            }
        });

        // Initialize
        updateZoomDisplay();
    </script>
</body>

</html>
