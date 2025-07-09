@extends('layouts.app')

@section('content')
    {{-- Reading Progress Bar --}}
    <div class="reading-progress" id="readingProgress"></div>

    {{-- Main Content --}}
    <main class="detail-main-content">
        {{-- Back Button --}}
        <div class="detail-back-container">
            <a href="{{ url('/beritas') }}" class="detail-btn-back">
                <i class="fas fa-arrow-left"></i>
                <span>Kembali</span>
            </a>
        </div>

        {{-- Article Container --}}
        <div class="detail-article-container">
            {{-- Article Card --}}
            <div class="detail-article-card">
                {{-- Article Image --}}
                <div class="detail-article-image-wrapper">
                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" class="detail-article-image">
                </div>

                {{-- Article Content --}}
                <div class="detail-article-content">
                    <h1 class="detail-article-title">{{ $berita->judul }}</h1>

                    <div class="detail-article-meta">
                        <span class="detail-meta-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}</span>
                        </span>
                        <span class="detail-meta-separator">•</span>
                        <span class="detail-meta-item">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>{{ $berita->sumber ?? 'Air Terjun Lubuk Hitam' }}</span>
                        </span>
                    </div>

                    <div class="detail-article-body">
                        {!! nl2br(e($berita->deskripsi)) !!}
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Floating Back Button --}}
    <div class="detail-floating-back" id="floatingBack">
        <a href="{{ url('/beritas') }}" class="detail-floating-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>

    <style>
        /* Main Content Container */
        .detail-main-content {
            padding-top: 100px;
            min-height: 100vh;
            background: linear-gradient(135deg, rgba(240, 253, 244, 0.3) 0%, rgba(220, 252, 231, 0.2) 100%);
        }

        /* Back Button Container */
        .detail-back-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px 20px 20px;
        }

        .detail-btn-back {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            padding: 14px 24px;
            background: linear-gradient(135deg, #0a1f0f 0%, #1a3d2e 30%, #2d5a3d 70%, #228B22 100%);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 6px 20px rgba(34, 139, 34, 0.25);
            border: 1px solid rgba(255, 255, 255, 0.1);
            position: relative;
            overflow: hidden;
        }

        .detail-btn-back::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
            transition: left 0.5s;
        }

        .detail-btn-back:hover::before {
            left: 100%;
        }

        .detail-btn-back:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(34, 139, 34, 0.35);
            color: white;
            text-decoration: none;
        }

        .detail-btn-back i {
            font-size: 16px;
            transition: transform 0.3s ease;
        }

        .detail-btn-back:hover i {
            transform: translateX(-3px);
        }

        /* Article Container */
        .detail-article-container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 0 20px 60px 20px;
        }

        /* Reading Progress Bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 4px;
            background: linear-gradient(135deg, #0a1f0f 0%, #1a3d2e 30%, #2d5a3d 70%, #228B22 100%);
            z-index: 9999;
            transition: width 0.2s ease;
            box-shadow: 0 2px 10px rgba(34, 139, 34, 0.3);
        }

        /* Article Card */
        .detail-article-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.3);
            border-radius: 25px;
            box-shadow: 0 25px 70px rgba(10, 31, 15, 0.15);
            overflow: hidden;
            transition: all 0.4s ease;
        }

        .detail-article-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 90px rgba(10, 31, 15, 0.2);
        }

        /* Article Image - Fixed to show full image without cropping */
        .detail-article-image-wrapper {
            position: relative;
            width: 100%;
            /* Remove fixed height to allow natural image proportions */
            min-height: 300px;
            max-height: 500px;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
        }

        .detail-article-image {
            width: 100%;
            height: auto;
            /* Changed from object-fit: cover to contain to show full image */
            object-fit: contain;
            object-position: center;
            max-height: 500px;
        }

        .detail-article-badge {
            position: absolute;
            top: 25px;
            right: 25px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(15px);
            color: #228B22;
            padding: 12px 20px;
            border-radius: 25px;
            font-size: 14px;
            font-weight: 700;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(34, 139, 34, 0.2);
        }

        /* Article Content */
        .detail-article-content {
            padding: 50px 45px;
        }

        .detail-article-title {
            font-size: 2.8rem;
            font-weight: 800;
            background: linear-gradient(135deg, #0a1f0f 0%, #1a3d2e 30%, #2d5a3d 70%, #228B22 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 25px;
            line-height: 1.2;
        }

        .detail-article-meta {
            display: flex;
            align-items: center;
            gap: 20px;
            margin-bottom: 35px;
            padding: 20px 25px;
            background: rgba(34, 139, 34, 0.08);
            border-radius: 20px;
            border-left: 5px solid #228B22;
            flex-wrap: wrap;
        }

        .detail-meta-item {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #2d5a3d;
            font-size: 15px;
            font-weight: 600;
        }

        .detail-meta-item i {
            color: #228B22;
            font-size: 16px;
        }

        .detail-meta-separator {
            color: #90EE90;
            font-weight: bold;
            font-size: 18px;
        }

        .detail-article-body {
            font-size: 1.15rem;
            line-height: 1.8;
            color: #1a3d2e;
            text-align: justify;
            font-weight: 400;
        }

        /* Floating Back Button */
        .detail-floating-back {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.4s ease;
        }

        .detail-floating-back.show {
            opacity: 1;
            visibility: visible;
        }

        .detail-floating-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #228B22, #90EE90);
            color: white;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.3);
            transition: all 0.4s ease;
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .detail-floating-btn:hover {
            transform: scale(1.15) rotate(-5deg);
            box-shadow: 0 15px 35px rgba(34, 139, 34, 0.4);
            color: white;
            text-decoration: none;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .detail-main-content {
                padding-top: 80px;
            }

            .detail-back-container,
            .detail-article-container {
                padding-left: 15px;
                padding-right: 15px;
            }

            .detail-btn-back {
                padding: 12px 20px;
                font-size: 14px;
                gap: 8px;
            }

            .detail-article-image-wrapper {
                min-height: 200px;
                max-height: 350px;
            }

            .detail-article-image {
                max-height: 350px;
            }

            .detail-article-content {
                padding: 35px 30px;
            }

            .detail-article-title {
                font-size: 2.2rem;
            }

            .detail-article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 12px;
                padding: 18px 20px;
            }

            .detail-article-body {
                font-size: 1.05rem;
            }

            .detail-floating-back {
                bottom: 25px;
                right: 25px;
            }

            .detail-floating-btn {
                width: 55px;
                height: 55px;
            }
        }

        @media (max-width: 576px) {
            .detail-main-content {
                padding-top: 70px;
            }

            .detail-back-container,
            .detail-article-container {
                padding-left: 10px;
                padding-right: 10px;
            }

            .detail-btn-back {
                padding: 10px 18px;
                font-size: 13px;
                gap: 6px;
            }

            .detail-article-image-wrapper {
                min-height: 180px;
                max-height: 280px;
            }

            .detail-article-image {
                max-height: 280px;
            }

            .detail-article-content {
                padding: 30px 25px;
            }

            .detail-article-title {
                font-size: 1.8rem;
            }

            .detail-article-badge {
                top: 20px;
                right: 20px;
                padding: 10px 16px;
                font-size: 13px;
            }

            .detail-article-body {
                font-size: 1rem;
            }

            .detail-floating-back {
                bottom: 20px;
                right: 20px;
            }

            .detail-floating-btn {
                width: 50px;
                height: 50px;
            }
        }

        /* Animations */
        @keyframes slideInFromTop {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInFromBottom {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .detail-btn-back {
            animation: slideInFromTop 0.6s ease-out;
        }

        .detail-article-card {
            animation: slideInFromBottom 0.8s ease-out;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const floatingBack = document.getElementById('floatingBack');
            const readingProgress = document.getElementById('readingProgress');

            function updateReadingProgress() {
                const windowHeight = window.innerHeight;
                const documentHeight = document.documentElement.scrollHeight - windowHeight;
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                const progress = Math.min((scrollTop / documentHeight) * 100, 100);
                readingProgress.style.width = progress + '%';
            }

            function handleScroll() {
                const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                updateReadingProgress();

                if (scrollTop > 400) {
                    floatingBack.classList.add('show');
                } else {
                    floatingBack.classList.remove('show');
                }
            }

            updateReadingProgress();
            window.addEventListener('scroll', handleScroll, {
                passive: true
            });

                      // Keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    window.location.href = '/beritas';
                }
                if (e.key === 'b' && (e.ctrlKey || e.metaKey)) {
                    e.preventDefault();
                    window.location.href = '/beritas';
                }
            });
        });
    </script>
@endsection

