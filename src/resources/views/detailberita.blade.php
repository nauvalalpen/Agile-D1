@extends('layouts.app')

@section('content')
    {{-- Reading Progress Bar --}}
    <div class="reading-progress" id="readingProgress"></div>

    {{-- Main Container --}}
    <div class="container py-5">
        {{-- Back Button --}}
        <div class="mb-4">
            <a href="{{ url('/beritas') }}" class="btn-back">
                <i class="fas fa-arrow-left me-2"></i>
                Back to News
            </a>
        </div>

        {{-- Article Card --}}
        <div class="article-card">
            {{-- Article Image --}}
            <div class="article-image-wrapper">
                <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}" class="article-image">
                <div class="article-badge">
                    <i class="fas fa-newspaper me-2"></i>
                    News Article
                </div>
            </div>

            {{-- Article Content --}}
            <div class="article-content">
                <h1 class="article-title">{{ $berita->judul }}</h1>
                
                <div class="article-meta">
                    <span class="meta-item">
                        <i class="fas fa-calendar-alt me-2"></i>
                        {{ \Carbon\Carbon::parse($berita->tanggal)->format('d M Y') }}
                    </span>
                    <span class="meta-separator">•</span>
                    <span class="meta-item">
                        <i class="fas fa-map-marker-alt me-2"></i>
                        {{ $berita->sumber ?? 'Air Terjun Lubuk Hitam' }}
                    </span>
                </div>

                <div class="article-body">
                    {!! nl2br(e($berita->deskripsi)) !!}
                </div>
            </div>
        </div>
    </div>

    {{-- Floating Back Button --}}
    <div class="floating-back" id="floatingBack">
        <a href="{{ url('/beritas') }}" class="floating-btn">
            <i class="fas fa-arrow-left"></i>
        </a>
    </div>

    <style>
        /* Reading Progress Bar */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 3px;
            background: linear-gradient(90deg, #667eea, #764ba2, #f093fb);
            z-index: 1000;
            transition: width 0.2s ease;
        }

        /* Container */
        .container {
            max-width: 800px;
        }

        /* Back Button */
        .btn-back {
            display: inline-flex;
            align-items: center;
            padding: 12px 24px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
        }

        .btn-back:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Article Card */
        .article-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.05);
        }

        /* Article Image */
        .article-image-wrapper {
            position: relative;
            height: 400px;
            overflow: hidden;
        }

        .article-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        .article-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            color: #667eea;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 600;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        /* Article Content */
        .article-content {
            padding: 40px;
        }

        .article-title {
            font-size: 2.5rem;
            font-weight: 800;
            color: #1a202c;
            margin-bottom: 20px;
            line-height: 1.2;
        }

        .article-meta {
            display: flex;
            align-items: center;
            gap: 15px;
            margin-bottom: 30px;
            padding: 15px 20px;
            background: #f8fafc;
            border-radius: 15px;
            border-left: 4px solid #667eea;
            flex-wrap: wrap;
        }

        .meta-item {
            display: flex;
            align-items: center;
            color: #64748b;
            font-size: 14px;
            font-weight: 500;
        }

        .meta-item i {
            color: #667eea;
        }

        .meta-separator {
            color: #cbd5e0;
            font-weight: bold;
        }

        .article-body {
            font-size: 1.1rem;
            line-height: 1.8;
            color: #2d3748;
            text-align: justify;
        }

        /* Floating Back Button */
        .floating-back {
            position: fixed;
            bottom: 30px;
            right: 30px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .floating-back.show {
            opacity: 1;
            visibility: visible;
        }

        .floating-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            color: white;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.3);
            transition: all 0.3s ease;
        }

        .floating-btn:hover {
            transform: scale(1.1);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.4);
            color: white;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .article-image-wrapper {
                height: 250px;
            }

            .article-content {
                padding: 30px 20px;
            }

            .article-title {
                font-size: 1.8rem;
            }

            .article-meta {
                flex-direction: column;
                align-items: flex-start;
                gap: 10px;
            }

            .article-body {
                font-size: 1rem;
            }

            .floating-back {
                bottom: 20px;
                right: 20px;
            }

            .floating-btn {
                width: 45px;
                height: 45px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0 15px;
            }

            .article-image-wrapper {
                height: 200px;
            }

            .article-content {
                padding: 25px 15px;
            }

            .article-title {
                font-size: 1.5rem;
            }

            .article-badge {
                top: 15px;
                right: 15px;
                padding: 6px 12px;
                font-size: 12px;
            }
        }

        /* Smooth scrolling */
        html {
            scroll-behavior: smooth;
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
                
                if (scrollTop > 300) {
                    floatingBack.classList.add('show');
                } else {
                    floatingBack.classList.remove('show');
                }
            }

            updateReadingProgress();
            window.addEventListener('scroll', handleScroll, { passive: true });

            // Keyboard shortcut
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    window.location.href = '/beritas';
                }
            });
        });
    </script>
@endsection
