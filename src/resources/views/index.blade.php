@extends('layouts.app')

@section('content')
    @php
        // Fetch real data from database
        $tourGuides = \App\Models\Tourguide::take(6)->get(); // Uncomment this line
        $facilities = \App\Models\Facility::take(6)->get();
        $galleries = \App\Models\Gallery::take(8)->get();
        $beritas = \App\Models\Berita::latest()->take(3)->get();
        $madus = \App\Models\Madu::take(4)->get();
        $produkUMKMs = \App\Models\ProdukUMKM::take(4)->get();

        // Get statistics
        $totalTourGuides = \App\Models\Tourguide::count(); // Uncomment this line
        $totalFacilities = \App\Models\Facility::count();
        $totalGalleries = \App\Models\Gallery::count();
        $totalNews = \App\Models\Berita::count();
    @endphp

    <style>
        :root {
            /* Modern Dark Green & White Color Palette */
            --dark-forest: #0a1f0f;
            --deep-green: #1a3d2e;
            --forest-green: #2d5a3d;
            --emerald-green: #228B22;
            --light-green: #90EE90;
            --pure-white: #ffffff;
            --off-white: #f8fffe;
            --glass-white: rgba(255, 255, 255, 0.1);
            --glass-dark: rgba(10, 31, 15, 0.9);

            /* Advanced Gradients */
            --hero-gradient: linear-gradient(135deg, #0a1f0f 0%, #1a3d2e 30%, #2d5a3d 70%, #228B22 100%);
            --glass-gradient: linear-gradient(135deg, rgba(255, 255, 255, 0.15) 0%, rgba(255, 255, 255, 0.05) 100%);
            --accent-gradient: linear-gradient(90deg, #228B22, #90EE90, #228B22);

            /* Modern Shadows & Effects */
            --shadow-hero: 0 25px 80px rgba(10, 31, 15, 0.6);
            --shadow-glass: 0 15px 35px rgba(0, 0, 0, 0.1);
            --glow-green: 0 0 40px rgba(34, 139, 34, 0.4);
            --glow-white: 0 0 30px rgba(255, 255, 255, 0.3);

            /* Animations */
            --transition-smooth: all 0.6s cubic-bezier(0.25, 0.8, 0.25, 1);
            --transition-bounce: all 0.8s cubic-bezier(0.68, -0.55, 0.265, 1.55);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            line-height: 1.6;
            overflow-x: hidden;
        }

        /* ===== MODERN DARK HERO SECTION ===== */
        .hero-dark-modern {
            position: relative;
            min-height: 100vh;
            background: var(--hero-gradient);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            color: var(--pure-white);
        }

        /* Animated Background Canvas */
        .hero-canvas {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
        }

        /* Floating Particles */
        .hero-particles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 2;
        }

        .particle {
            position: absolute;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            pointer-events: none;
            animation: float-up 15s infinite linear;
        }

        .particle.green {
            background: rgba(34, 139, 34, 0.2);
        }

        /* Geometric Overlay */
        .hero-geometric {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background:
                radial-gradient(circle at 25% 25%, rgba(34, 139, 34, 0.1) 0%, transparent 50%),
                radial-gradient(circle at 75% 75%, rgba(255, 255, 255, 0.05) 0%, transparent 50%),
                conic-gradient(from 0deg at 50% 50%, transparent 0deg, rgba(144, 238, 144, 0.1) 90deg, transparent 180deg);
            z-index: 3;
            animation: rotate-slow 60s infinite linear;
        }

        /* Hero Content Grid */
        .hero-content-grid {
            position: relative;
            z-index: 10;
            max-width: 1400px;
            width: 100%;
            padding: 0 2rem;
            display: grid;
            grid-template-columns: 1.2fr 0.8fr;
            gap: 5rem;
            align-items: center;
        }

        /* Enhanced Tour Guide Cards */
        .guide-card-enhanced {
            background: var(--glass-bg);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            border-radius: var(--border-radius);
            padding: 2rem;
            box-shadow: var(--shadow-glow);
            transition: var(--transition);
            position: relative;
            overflow: hidden;
        }

        .guide-card-enhanced::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(135deg, #fbbf24, #f59e0b);
            transform: scaleX(0);
            transition: var(--transition);
        }

        .guide-card-enhanced:hover::before {
            transform: scaleX(1);
        }

        .guide-card-enhanced:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: 0 25px 50px rgba(34, 139, 34, 0.4);
        }

        .guide-avatar {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid rgba(34, 139, 34, 0.3);
            margin: 0 auto 1rem;
            display: block;
            transition: var(--transition);
        }

        .guide-card-enhanced:hover .guide-avatar {
            transform: scale(1.1);
            border-color: rgba(34, 139, 34, 0.6);
        }

        .guide-rating {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
            margin-bottom: 1rem;
        }

        .guide-rating .star {
            color: #fbbf24;
            font-size: 1.2rem;
        }

        .guide-specialties {
            display: flex;
            flex-wrap: wrap;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .specialty-tag {
            background: rgba(34, 139, 34, 0.1);
            color: #2d5a3d;
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 500;
            border: 1px solid rgba(34, 139, 34, 0.2);
        }

        .guide-photo {
            position: relative;
            overflow: hidden;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }

        .guide-image {
            width: 100%;
            height: 200px;
            object-fit: cover;
            border-radius: 15px;
            transition: transform 0.3s ease;
        }

        .guide-image:hover {
            transform: scale(1.05);
        }

        .guide-details {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
            margin-bottom: 1rem;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-size: 0.9rem;
            color: #2d5016;
            /* Warna hijau gelap seperti di footer */
        }

        .detail-row i {
            width: 16px;
            text-align: center;
            color: #28a745;
            /* Warna hijau untuk icon */
            font-size: 0.85rem;
        }

        .detail-row a {
            color: #2d5016;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .detail-row a:hover {
            color: #1a2e0a;
            text-decoration: underline;
        }

        .detail-description {
            margin-top: 0.5rem;
            padding-top: 0.75rem;
            border-top: 1px solid rgba(45, 80, 22, 0.2);
        }

        .detail-description p {
            margin: 0;
            font-size: 0.85rem;
            color: #2d5016;
            line-height: 1.5;
            text-align: justify;
            opacity: 0.8;
        }

        .price-section {
            padding: 0.75rem 0;
            border-top: 1px solid rgba(45, 80, 22, 0.2);
            text-align: center;
        }

        .price-display {
            font-size: 1.2rem;
            font-weight: 700;
            color: #28a745;
            /* Warna hijau untuk harga */
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .card-actions {
            display: flex;
            gap: 0.75rem;
            margin-top: 1.5rem;
            padding-top: 1rem;
            border-top: 1px solid rgba(45, 80, 22, 0.2);
        }

        .btn-glass {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            backdrop-filter: blur(10px);
        }

        .btn-details {
            background: rgba(45, 80, 22, 0.1);
            color: #2d5016;
            border: 1px solid rgba(45, 80, 22, 0.3);
        }

        .btn-details:hover {
            background: rgba(45, 80, 22, 0.2);
            color: #1a2e0a;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(45, 80, 22, 0.2);
        }

        .btn-glass-primary {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: #ffffff;
            border: 1px solid #28a745;
        }

        .btn-glass-primary:hover {
            background: linear-gradient(135deg, #20c997, #28a745);
            color: #ffffff;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(40, 167, 69, 0.3);
        }

        /* Untuk card title */
        .card-title-glass {
            color: #1a2e0a;
            /* Hijau sangat gelap */
            font-weight: 700;
        }

        /* Untuk section header */
        .section-title-glass {
            color: #1a2e0a;
        }

        .section-description-glass {
            color: #2d5016;
            opacity: 0.9;
        }

        .detail-row {
            color: rgba(0, 100, 0, 0.8);
            /* Hijau gelap dengan transparansi */
        }

        .detail-row i {
            color: #006400;
            /* Hijau gelap untuk icon */
        }

        .detail-row a {
            color: #006400;
        }

        .detail-row a:hover {
            color: #004d00;
        }

        .detail-description p {
            color: rgba(0, 100, 0, 0.7);
        }

        .price-display {
            color: #006400;
            font-weight: 800;
        }

        .btn-details {
            background: rgba(0, 100, 0, 0.1);
            color: #006400;
            border: 1px solid rgba(0, 100, 0, 0.3);
        }

        .btn-details:hover {
            background: rgba(0, 100, 0, 0.2);
            color: #004d00;
        }

        .btn-glass-primary {
            background: linear-gradient(135deg, #006400, #228B22);
            color: white;
        }

        .btn-glass-primary:hover {
            background: linear-gradient(135deg, #228B22, #006400);
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .card-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .detail-row {
                font-size: 0.85rem;
            }

            .price-display {
                font-size: 1.1rem;
            }

            .guide-image {
                height: 180px;
            }
        }


        /* Responsive Design */
        @media (max-width: 768px) {
            .card-actions {
                flex-direction: column;
                gap: 0.5rem;
            }

            .detail-row {
                font-size: 0.85rem;
            }

            .price-display {
                font-size: 1.1rem;
            }

            .guide-image {
                height: 180px;
            }
        }


        /* Left Content Section */
        .hero-text-section {
            animation: slideInLeft 1.2s ease-out;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            background: var(--glass-gradient);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            padding: 0.75rem 1.5rem;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 2rem;
            box-shadow: var(--shadow-glass);
            animation: badge-glow 3s ease-in-out infinite;
        }

        .hero-title-modern {
            font-size: clamp(3rem, 7vw, 6rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, #90EE90 50%, #ffffff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 2px 4px 8px rgba(0, 0, 0, 0.3);
            letter-spacing: -0.02em;
            position: relative;
        }

        .hero-title-modern::after {
            content: '';
            position: absolute;
            bottom: -10px;
            left: 0;
            width: 100px;
            height: 4px;
            background: var(--accent-gradient);
            border-radius: 2px;
            animation: title-underline 2s ease-out 0.5s both;
        }

        .hero-subtitle {
            font-size: clamp(1.2rem, 2.5vw, 1.6rem);
            font-weight: 300;
            line-height: 1.7;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 3rem;
            max-width: 600px;
        }

        /* Hero Actions */
        .hero-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .btn-hero-primary {
            background: var(--pure-white);
            color: var(--dark-forest);
            padding: 1.2rem 2.5rem;
            border-radius: 60px;
            font-weight: 700;
            font-size: 1.1rem;
            text-decoration: none;
            transition: var(--transition-bounce);
            box-shadow: var(--glow-white);
            position: relative;
            overflow: hidden;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-hero-primary::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(34, 139, 34, 0.2), transparent);
            transition: left 0.6s ease;
        }

        .btn-hero-primary:hover {
            transform: translateY(-5px) scale(1.05);
            box-shadow: 0 20px 40px rgba(255, 255, 255, 0.3);
            color: var(--dark-forest);
        }

        .btn-hero-primary:hover::before {
            left: 100%;
        }

        .btn-hero-secondary {
            background: transparent;
            color: var(--pure-white);
            padding: 1.2rem 2.5rem;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-radius: 60px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            position: relative;
            overflow: hidden;
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
        }

        .btn-hero-secondary::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255, 255, 255, 0.1);
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 0.4s ease;
        }

        .btn-hero-secondary:hover {
            transform: translateY(-3px);
            border-color: var(--pure-white);
            color: var(--pure-white);
            box-shadow: var(--glow-white);
        }

        .btn-hero-secondary:hover::before {
            transform: scaleX(1);
        }


        /* Hero Stats */
        .hero-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            margin-top: 2rem;
        }

        .hero-stat-item {
            text-align: center;
            padding: 1.5rem;
            background: var(--glass-gradient);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 20px;
            transition: var(--transition-smooth);
        }

        .hero-stat-item:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-glass);
            border-color: rgba(255, 255, 255, 0.3);
        }

        .hero-stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            display: block;
            margin-bottom: 0.5rem;
            background: linear-gradient(135deg, #ffffff, #90EE90);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .hero-stat-label {
            font-size: 0.9rem;
            opacity: 0.8;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 500;
        }

        /* Right Content Section */
        .hero-visual-section {
            position: relative;
            animation: slideInRight 1.2s ease-out;
        }

        .hero-image-container {
            position: relative;
            width: 100%;
            height: 500px;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow-hero);
            background: var(--glass-gradient);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .hero-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition-smooth);
        }

        .hero-image-container:hover .hero-image {
            transform: scale(1.1);
        }

        /* .hero-image-overlay {
                                                                            position: absolute;
                                                                            top: 0;
                                                                            left: 0;
                                                                            right: 0;
                                                                            bottom: 0;
                                                                            background: linear-gradient(135deg, rgba(10, 31, 15, 0.3), rgba(34, 139, 34, 0.2));
                                                                            display: flex;
                                                                            align-items: center;
                                                                            justify-content: center;
                                                                            opacity: 0;
                                                                            transition: var(--transition-smooth);
                                                                        } */

        .hero-image-container:hover .hero-image-overlay {
            opacity: 1;
        }



        /* Floating Elements */
        .hero-floating-elements {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
            z-index: 5;
        }

        .floating-element {
            position: absolute;
            background: var(--glass-gradient);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 20px;
            padding: 1rem;
            animation: float-element 6s ease-in-out infinite;
            font-size: 0.9rem;
            font-weight: 500;
            text-align: center;
        }

        .floating-element.element-1 {
            top: 20%;
            right: 10%;
            animation-delay: 0s;
        }

        .floating-element.element-2 {
            bottom: 30%;
            left: 5%;
            animation-delay: 2s;
        }

        .floating-element.element-3 {
            top: 60%;
            right: 20%;
            animation-delay: 4s;
        }

        /* Scroll Indicator */
        .hero-scroll-indicator {
            position: absolute;
            bottom: 2rem;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;

        }

        .scroll-mouse {
            width: 30px;
            height: 50px;
            border: 2px solid rgba(255, 255, 255, 0.6);
            border-radius: 15px;
            position: relative;
            animation: mouse-bounce 2s infinite;
        }

        .scroll-mouse::before {
            content: '';
            position: absolute;
            top: 8px;
            left: 50%;
            transform: translateX(-50%);
            width: 4px;
            height: 8px;
            background: var(--pure-white);
            border-radius: 2px;
            animation: scroll-wheel 2s infinite;
        }

        /* ===== ANIMATIONS ===== */
        @keyframes float-up {
            0% {
                transform: translateY(100vh) rotate(0deg);
                opacity: 0;
            }

            10% {
                opacity: 1;
            }

            90% {
                opacity: 1;
            }

            100% {
                transform: translateY(-100px) rotate(360deg);
                opacity: 0;
            }
        }

        @keyframes rotate-slow {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(100px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes badge-glow {

            0%,
            100% {
                box-shadow: var(--shadow-glass);
            }

            50% {
                box-shadow: var(--glow-green);
            }
        }

        @keyframes title-underline {
            from {
                width: 0;
                opacity: 0;
            }

            to {
                width: 100px;
                opacity: 1;
            }
        }

        @keyframes float-element {

            0%,
            100% {
                transform: translateY(0px) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }

        @keyframes mouse-bounce {

            0%,
            100% {
                transform: translateX(-50%) translateY(0);
            }

            50% {
                transform: translateX(-50%) translateY(-10px);
            }
        }

        @keyframes scroll-wheel {
            0% {
                opacity: 1;
                transform: translateX(-50%) translateY(0);
            }

            100% {
                opacity: 0;
                transform: translateX(-50%) translateY(15px);
            }
        }

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1024px) {
            .hero-content-grid {
                grid-template-columns: 1fr;
                gap: 3rem;
                text-align: center;
            }

            .hero-image-container {
                height: 400px;
            }

            .hero-stats {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 768px) {
            .hero-content-grid {
                padding: 0 1rem;
            }

            .hero-title-modern {
                font-size: 3rem;
            }

            .hero-actions {
                flex-direction: column;
                align-items: center;
            }

            .btn-hero-primary,
            .btn-hero-secondary {
                width: 100%;
                max-width: 300px;
                justify-content: center;
            }

            .hero-stats {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .hero-image-container {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .hero-title-modern {
                font-size: 2.5rem;
            }

            .hero-subtitle {
                font-size: 1.1rem;
            }

            .floating-element {
                display: none;
            }
        }

        /* ===== GLASS SECTIONS STYLES ===== */
        .glass-section {
            padding: 8rem 0;
            position: relative;
        }

        .glass-bg-primary {
            background: linear-gradient(135deg, #f8fffe 0%, #f0fff0 50%, #e6ffe6 100%);
        }

        .glass-bg-secondary {
            background: linear-gradient(135deg, #e6ffe6 0%, #ccffcc 50%, #b3ffb3 100%);
        }

        .section-header-glass {
            text-align: center;
            margin-bottom: 5rem;
            position: relative;
        }

        .section-title-glass {
            font-size: clamp(2rem, 4vw, 3.5rem);
            font-weight: 700;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #0a1f0f 0%, #228B22 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .section-title-glass::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 4px;
            background: var(--accent-gradient);
            border-radius: 2px;
            box-shadow: var(--glow-green);
        }

        .section-description-glass {
            font-size: 1.2rem;
            color: var(--deep-green);
            max-width: 700px;
            margin: 0 auto;
            line-height: 1.8;
        }

        .glass-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2.5rem;
            margin-top: 4rem;
        }

        .glass-card {
            background: var(--glass-gradient);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 25px;
            padding: 2.5rem;
            box-shadow: var(--shadow-glass);
            transition: var(--transition-smooth);
            position: relative;
            overflow: hidden;
        }

        .glass-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: var(--accent-gradient);
            transform: scaleX(0);
            transition: var(--transition-smooth);
        }

        .glass-card:hover {
            transform: translateY(-15px) scale(1.02);
            box-shadow: var(--shadow-hero);
            border-color: rgba(34, 139, 34, 0.4);
        }

        .glass-card:hover::before {
            transform: scaleX(1);
        }

        .scroll-reveal {
            opacity: 0;
            transform: translateY(50px);
            transition: all 0.8s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .scroll-reveal.revealed {
            opacity: 1;
            transform: translateY(0);
        }

        .card-title-glass {
            font-size: 1.6rem;
            font-weight: 600;
            color: var(--dark-forest);
            margin-bottom: 1rem;
        }

        .card-description-glass {
            color: var(--deep-green);
            line-height: 1.7;
            margin-bottom: 2rem;
        }

        .btn-glass {
            padding: 1rem 2.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            transition: var(--transition-smooth);
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            margin: 0.5rem;
            position: relative;
            overflow: hidden;
            border: none;
            cursor: pointer;
        }

        .btn-glass-primary {
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            color: white;
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.4);
        }

        .btn-glass-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(34, 139, 34, 0.6);
            color: white;
        }

        .guide-details {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .detail-row {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            font-size: 0.85rem;
        }

        .detail-row i {
            width: 16px;
            text-align: center;
            color: var(--primary-color);
        }

        .detail-row a {
            color: var(--dark-color);
            text-decoration: none;
        }

        .detail-row a:hover {
            color: var(--primary-color);
            text-decoration: underline;
        }

        .price-row .price-text {
            font-weight: 600;
            color: var(--primary-color);
        }

        .detail-description {
            margin-top: 0.5rem;
            padding-top: 0.5rem;
            border-top: 1px solid rgba(0, 0, 0, 0.1);
        }

        .detail-description p {
            margin: 0;
            font-size: 0.8rem;
            color: var(--secondary-color);
            line-height: 1.4;
        }
    </style>

    <!-- Modern Dark Hero Section -->
    <section class="hero-dark-modern" id="hero-section">
        <!-- Animated Canvas Background -->
        <canvas class="hero-canvas" id="hero-canvas"></canvas>


        <!-- Geometric Overlay -->
        <div class="hero-geometric"></div>



        <!-- Hero Content -->
        <div class="hero-content-grid">
            <!-- Left Content -->
            <div class="hero-text-section">
                {{-- <div class="hero-badge">
                    <span>Surga Tersembunyi di Indonesia</span>
                </div> --}}

                <h1 class="hero-title-modern">
                    Keindahan<br>
                    <span
                        style="background: linear-gradient(135deg, #90EE90 0%, #ffffff 50%, #90EE90 100%); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Lubuk
                        Hitam</span>
                </h1>

                <p class="hero-subtitle">
                    Rasakan keindahan menakjubkan dari air terjun yang mengalir deras, alam yang masih asli,
                    dan petualangan tak terlupakan di salah satu destinasi alam paling spektakuler di Sumatera Barat.
                </p>

                <div class="hero-actions">
                    <a href="{{ route('minimap.index') }}" class="btn-hero-primary" id="primary-cta">
                        <span>Mulai Perjalanan</span>
                    </a>
                    <a href="{{ url('gallery/') }}" class="btn-hero-secondary" id="secondary-cta">
                        <span>Eksplor Keindahan</span>
                    </a>
                </div>

                {{-- <div class="hero-stats">
                    <div class="hero-stat-item">
                        <span class="hero-stat-number" data-count="{{ $totalTourGuides }}">0</span>
                        <span class="hero-stat-label">Tour Guides</span>
                    </div>
                    <div class="hero-stat-item">
                        <span class="hero-stat-number" data-count="{{ $totalFacilities }}">0</span>
                        <span class="hero-stat-label">Fasilitas</span>
                    </div>
                    <div class="hero-stat-item">
                        <span class="hero-stat-number" data-count="{{ $totalGalleries }}">0</span>
                        <span class="hero-stat-label">Galeri</span>
                    </div>
                    <div class="hero-stat-item">
                        <span class="hero-stat-number" data-count="{{ $totalNews }}">0</span>
                        <span class="hero-stat-label">Berita</span>
                    </div>
                </div> --}}
            </div>

            <!-- Right Content -->
            <div class="hero-visual-section">
                <div class="hero-image-container" id="hero-image-container">
                    <img src="{{ asset('images/hero.jpg') }}" alt="Lubuk Hitam Waterfall" class="hero-image"
                        id="hero-image">
                </div>
            </div>
        </div>
        </div>

        <!-- Scroll Indicator -->
        <div class="hero-scroll-indicator" id="scroll-indicator">
            {{-- <div class="scroll-mouse"></div> --}}
        </div>
    </section>

    <!-- Amazing JavaScript -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('🌟 Lubuk Hitam Modern Hero Loading...');

            // ===== CANVAS ANIMATION =====
            const canvas = document.getElementById('hero-canvas');
            const ctx = canvas.getContext('2d');

            function resizeCanvas() {
                canvas.width = window.innerWidth;
                canvas.height = window.innerHeight;
            }

            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            // Animated background waves
            let waveOffset = 0;

            function drawWaves() {
                ctx.clearRect(0, 0, canvas.width, canvas.height);

                // Create gradient
                const gradient = ctx.createLinearGradient(0, 0, canvas.width, canvas.height);
                gradient.addColorStop(0, 'rgba(34, 139, 34, 0.1)');
                gradient.addColorStop(0.5, 'rgba(144, 238, 144, 0.05)');
                gradient.addColorStop(1, 'rgba(255, 255, 255, 0.02)');

                ctx.fillStyle = gradient;
                ctx.beginPath();

                for (let x = 0; x <= canvas.width; x += 10) {
                    const y = Math.sin((x + waveOffset) * 0.01) * 50 + canvas.height * 0.7;
                    if (x === 0) {
                        ctx.moveTo(x, y);
                    } else {
                        ctx.lineTo(x, y);
                    }
                }

                ctx.lineTo(canvas.width, canvas.height);
                ctx.lineTo(0, canvas.height);
                ctx.closePath();
                ctx.fill();

                waveOffset += 2;
                requestAnimationFrame(drawWaves);
            }

            drawWaves();

            // ===== PARTICLE SYSTEM =====
            const particlesContainer = document.getElementById('particles-container');
            const particleCount = 50;

            function createParticle() {
                const particle = document.createElement('div');
                particle.className = Math.random() > 0.5 ? 'particle' : 'particle green';

                const size = Math.random() * 4 + 2;
                particle.style.width = size + 'px';
                particle.style.height = size + 'px';
                particle.style.left = Math.random() * 100 + '%';
                particle.style.animationDuration = (Math.random() * 10 + 10) + 's';
                particle.style.animationDelay = Math.random() * 5 + 's';

                particlesContainer.appendChild(particle);

                setTimeout(() => {
                    if (particle.parentNode) {
                        particle.parentNode.removeChild(particle);
                    }
                }, 20000);
            }

            // Create initial particles
            for (let i = 0; i < particleCount; i++) {
                setTimeout(() => createParticle(), i * 200);
            }

            // Continuously create new particles
            setInterval(createParticle, 1000);

            // ===== COUNTER ANIMATION =====
            function animateCounter(element) {
                const target = parseInt(element.getAttribute('data-count'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    element.textContent = Math.floor(current);
                }, 16);
            }

            // Enhanced tour guide card interactions
            document.querySelectorAll('.guide-card-enhanced').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    const avatar = this.querySelector('.guide-avatar');
                    const specialties = this.querySelectorAll('.specialty-tag');

                    if (avatar) {
                        avatar.style.transform = 'scale(1.1) rotate(5deg)';
                    }

                    specialties.forEach((tag, index) => {
                        setTimeout(() => {
                            tag.style.transform = 'translateY(-2px)';
                            tag.style.boxShadow =
                                '0 5px 15px rgba(34, 139, 34, 0.2)';
                        }, index * 50);
                    });
                });

                card.addEventListener('mouseleave', function() {
                    const avatar = this.querySelector('.guide-avatar');
                    const specialties = this.querySelectorAll('.specialty-tag');

                    if (avatar) {
                        avatar.style.transform = 'scale(1) rotate(0deg)';
                    }

                    specialties.forEach(tag => {
                        tag.style.transform = 'translateY(0)';
                        tag.style.boxShadow = 'none';
                    });
                });
            });

            // Tour guide booking functionality
            document.querySelectorAll('[href*="tourguides.book"]').forEach(bookBtn => {
                bookBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const guideName = this.closest('.glass-card').querySelector('.card-title-glass')
                        .textContent;

                    showNotification(`Booking request for ${guideName} has been initiated!`,
                        'success');

                    // You can add actual booking logic here
                    setTimeout(() => {
                        window.location.href = this.href;
                    }, 1000);
                });
            });

            // ===== SCROLL REVEAL ANIMATION =====
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');

                        // Trigger counter animation for statistics
                        const statNumbers = entry.target.querySelectorAll('.hero-stat-number');
                        statNumbers.forEach(statNumber => {
                            if (!statNumber.classList.contains('animated')) {
                                animateCounter(statNumber);
                                statNumber.classList.add('animated');
                            }
                        });
                    }
                });
            }, observerOptions);

            // Observe hero stats
            document.querySelectorAll('.hero-stat-item').forEach(el => {
                observer.observe(el);
            });

            // ===== INTERACTIVE ELEMENTS =====

            // Primary CTA Button Effects
            const primaryCTA = document.getElementById('primary-cta');
            primaryCTA.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-5px) scale(1.05)';
                this.style.boxShadow = '0 20px 40px rgba(255, 255, 255, 0.3)';
            });

            primaryCTA.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0) scale(1)';
                this.style.boxShadow = '0 0 30px rgba(255, 255, 255, 0.3)';
            });

            // Secondary CTA Button Effects
            const secondaryCTA = document.getElementById('secondary-cta');
            secondaryCTA.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-3px)';
                this.style.borderColor = '#ffffff';
                this.style.boxShadow = '0 0 30px rgba(255, 255, 255, 0.3)';
            });

            secondaryCTA.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
                this.style.borderColor = 'rgba(255, 255, 255, 0.3)';
                this.style.boxShadow = 'none';
            });

            // ===== HERO IMAGE INTERACTIONS =====
            const heroImageContainer = document.getElementById('hero-image-container');
            const heroImage = document.getElementById('hero-image');
            const playButton = document.getElementById('play-button');

            heroImageContainer.addEventListener('mouseenter', function() {
                heroImage.style.transform = 'scale(1.1)';
            });

            heroImageContainer.addEventListener('mouseleave', function() {
                heroImage.style.transform = 'scale(1)';
            });

            playButton.addEventListener('click', function() {
                // Add ripple effect
                const ripple = document.createElement('div');
                ripple.style.cssText = `
            position: absolute;
            width: 100px;
            height: 100px;
            background: rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            transform: scale(0);
            animation: ripple-effect 0.6s linear;
            top: 50%;
            left: 50%;
            margin-top: -50px;
            margin-left: -50px;
            pointer-events: none;
        `;

                this.appendChild(ripple);

                setTimeout(() => {
                    ripple.remove();
                }, 600);

                // Simulate video play
                showNotification('Video player would open here!', 'info');
            });

            // ===== SCROLL INDICATOR =====
            const scrollIndicator = document.getElementById('scroll-indicator');
            scrollIndicator.addEventListener('click', function() {
                const nextSection = document.querySelector('.glass-section');
                if (nextSection) {
                    nextSection.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });

            // Hide scroll indicator when scrolled
            window.addEventListener('scroll', function() {
                const scrolled = window.pageYOffset;
                const heroHeight = document.getElementById('hero-section').offsetHeight;

                if (scrolled > heroHeight * 0.3) {
                    scrollIndicator.style.opacity = '0';
                    scrollIndicator.style.transform = 'translateX(-50%) translateY(20px)';
                } else {
                    scrollIndicator.style.opacity = '1';
                    scrollIndicator.style.transform = 'translateX(-50%) translateY(0)';
                }
            });

            window.addEventListener('scroll', requestTick);

            // ===== FLOATING ELEMENTS INTERACTION =====
            const floatingElements = document.querySelectorAll('.floating-element');
            floatingElements.forEach(element => {
                element.addEventListener('mouseenter', function() {
                    this.style.transform = 'scale(1.1) translateY(-10px)';
                    this.style.boxShadow = '0 15px 35px rgba(255, 255, 255, 0.2)';
                });

                element.addEventListener('mouseleave', function() {
                    this.style.transform = 'scale(1) translateY(0)';
                    this.style.boxShadow = '0 15px 35px rgba(0, 0, 0, 0.1)';
                });
            });

            // ===== MOUSE MOVEMENT EFFECTS =====
            document.addEventListener('mousemove', function(e) {
                const mouseX = e.clientX / window.innerWidth;
                const mouseY = e.clientY / window.innerHeight;

                // Move floating elements based on mouse position
                floatingElements.forEach((element, index) => {
                    const speed = 0.02 + (index * 0.01);
                    const x = (mouseX - 0.5) * 20 * speed;
                    const y = (mouseY - 0.5) * 20 * speed;

                    element.style.transform += ` translate(${x}px, ${y}px)`;
                });

                // Subtle parallax for hero content
                const heroContent = document.querySelector('.hero-content-grid');
                if (heroContent) {
                    const x = (mouseX - 0.5) * 10;
                    const y = (mouseY - 0.5) * 10;
                    heroContent.style.transform += ` translate(${x}px, ${y}px)`;
                }
            });

            // ===== PERFORMANCE OPTIMIZATIONS =====

            // Reduce animations on low-end devices
            const isLowEndDevice = navigator.hardwareConcurrency < 4 || navigator.deviceMemory < 4;

            if (isLowEndDevice) {
                // Disable heavy animations
                document.documentElement.style.setProperty('--transition-smooth', 'all 0.2s ease');
                document.documentElement.style.setProperty('--transition-bounce', 'all 0.3s ease');

                // Reduce particle count
                particlesContainer.style.display = 'none';

                // Disable parallax
                window.removeEventListener('scroll', requestTick);
            }

            // ===== UTILITY FUNCTIONS =====

            // Notification system
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                notification.style.cssText = `
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 10000;
            padding: 1rem 1.5rem;
            background: ${type === 'success' ? 'linear-gradient(135deg, #228B22, #2d5a3d)' : 'linear-gradient(135deg, #1a3d2e, #0a1f0f)'};
            color: white;
            border-radius: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            font-weight: 500;
            max-width: 300px;
            animation: slideInRight 0.3s ease-out;
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        `;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOutRight 0.3s ease-out';
                    setTimeout(() => notification.remove(), 300);
                }, 4000);
            }

            // ===== LOADING STATES =====
            window.addEventListener('load', function() {
                document.body.classList.add('loaded');

                // Trigger hero animations
                setTimeout(() => {
                    document.querySelector('.hero-text-section').style.opacity = '1';
                    document.querySelector('.hero-visual-section').style.opacity = '1';
                }, 100);

                showNotification('Selamat Datang Di Website Wisata Air Terjun Lubuk Hitam! ', 'success');
            });

            // ===== NETWORK STATUS MONITORING =====
            window.addEventListener('online', function() {
                showNotification('Connection restored! All features are now available.', 'success');
            });

            window.addEventListener('offline', function() {
                showNotification('You are offline. Some features may not work properly.', 'info');
            });

            // ===== KEYBOARD NAVIGATION =====
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Enter' || e.key === ' ') {
                    if (e.target.classList.contains('btn-hero-primary') ||
                        e.target.classList.contains('btn-hero-secondary')) {
                        e.target.click();
                    }
                }

                if (e.key === 'ArrowDown') {
                    scrollIndicator.click();
                }
            });

            console.log('✅ Lubuk Hitam Modern Hero Loaded Successfully!');
        });

        // ===== ADDITIONAL CSS ANIMATIONS =====
        const additionalStyles = document.createElement('style');
        additionalStyles.textContent = `
    @keyframes ripple-effect {
        to {
            transform: scale(4);
            opacity: 0;
        }
    }
    
    @keyframes slideInRight {
        from {
            transform: translateX(100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }
    
    @keyframes slideOutRight {
        from {
            transform: translateX(0);
            opacity: 1;
        }
        to {
            transform: translateX(100%);
            opacity: 0;
        }
    }
    
    /* Smooth transitions for all interactive elements */
    .hero-stat-item,
    .floating-element,
    .btn-hero-primary,
    .btn-hero-secondary {
        transition: var(--transition-smooth);
    }
    
    /* Loading state */
    body:not(.loaded) .hero-text-section,
    body:not(.loaded) .hero-visual-section {
        opacity: 0;
    }
    
    /* Focus states for accessibility */
    .btn-hero-primary:focus,
    .btn-hero-secondary:focus {
        outline: 2px solid rgba(255, 255, 255, 0.5);
        outline-offset: 2px;
    }
    
    /* High contrast mode support */
    @media (prefers-contrast: high) {
        .hero-dark-modern {
            background: #000000 !important;
        }
        
        .hero-title-modern,
        .hero-subtitle {
            color: #ffffff !important;
            -webkit-text-fill-color: #ffffff !important;
        }
        
        .glass-card,
        .hero-stat-item {
            background: #ffffff !important;
            border: 2px solid #000000 !important;
            color: #000000 !important;
        }
    }
    
    /* Reduced motion support */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
        
        .hero-canvas,
        .hero-particles,
        .hero-geometric {
            display: none !important;
        }
    }
    
    /* Print styles */
    @media print {
        .hero-dark-modern {
            background: #ffffff !important;
            color: #000000 !important;
        }
        
        .hero-canvas,
        .hero-particles,
        .hero-geometric,
        .floating-element {
            display: none !important;
        }
        
        .btn-hero-primary,
        .btn-hero-secondary {
            border: 1px solid #000000 !important;
            background: #ffffff !important;
            color: #000000 !important;
        }
    }
`;

        document.head.appendChild(additionalStyles);
    </script>

    <!-- Statistics Section with Modern Design -->
    <section class="glass-section glass-bg-primary">
        <div class="container">
            <div class="section-header-glass scroll-reveal">
                <h2 class="section-title-glass">Kilasan Data Menakjubkan</h2>
                <p class="section-description-glass">
                    Temukan apa yang membuat Lubuk Hitam menjadi destinasi luar biasa melalui statistik kami yang
                    mengesankan
                </p>
            </div>

            <div class="glass-grid" style="grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));">
                <div class="glass-card scroll-reveal text-center">
                    <div style="font-size: 3.5rem; font-weight: 800; margin-bottom: 0.5rem; background: linear-gradient(135deg, #228B22, #90EE90); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                        data-count="{{ $totalTourGuides }}">0</div>
                    <div
                        style="font-size: 1.1rem; color: #1a3d2e; font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">
                        Pemandu Wisata Terbaik</div>
                    <p style="margin-top: 1rem; color: #2d5a3d; font-size: 0.9rem;">Nikmati pengalaman perjalanan yang
                        menyenangkan dan aman bersama pemandu ahli kami.</p>
                </div>
                <div class="glass-card scroll-reveal text-center">
                    <div style="font-size: 3.5rem; font-weight: 800; margin-bottom: 0.5rem; background: linear-gradient(135deg, #228B22, #90EE90); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                        data-count="{{ $totalFacilities }}">0</div>
                    <div
                        style="font-size: 1.1rem; color: #1a3d2e; font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">
                        Fasilitas Terbaik</div>
                    <p style="margin-top: 1rem; color: #2d5a3d; font-size: 0.9rem;">Fasilitas lengkap dan nyaman yang
                        mendukung petualangan Anda.</p>
                </div>

                <div class="glass-card scroll-reveal text-center">
                    <div style="font-size: 3.5rem; font-weight: 800; margin-bottom: 0.5rem; background: linear-gradient(135deg, #228B22, #90EE90); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                        data-count="{{ $totalGalleries }}">0</div>
                    <div
                        style="font-size: 1.1rem; color: #1a3d2e; font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">
                        Foto Menakjubkan</div>
                    <p style="margin-top: 1rem; color: #2d5a3d; font-size: 0.9rem;">Tangkap momen terbaik dalam keindahan
                        alam Lubuk Hitam.</p>
                </div>

                <div class="glass-card scroll-reveal text-center">
                    <div style="font-size: 3.5rem; font-weight: 800; margin-bottom: 0.5rem; background: linear-gradient(135deg, #228B22, #90EE90); -webkit-background-clip: text; -webkit-text-fill-color: transparent;"
                        data-count="{{ $totalNews }}">0</div>
                    <div
                        style="font-size: 1.1rem; color: #1a3d2e; font-weight: 500; text-transform: uppercase; letter-spacing: 1px;">
                        Informasi Terbaru</div>
                    <p style="margin-top: 1rem; color: #2d5a3d; font-size: 0.9rem;">Berita dan pembaruan terkini tentang
                        destinasi kami.</p>
                </div>
            </div>
        </div>

    </section>
    =
    <!-- Tour Guides Section -->
    <section class="glass-section">
        <div class="container">
            <div class="section-header-glass scroll-reveal">
                <h2 class="section-title-glass">Pemandu Wisata Profesional</h2>
                <p class="section-description-glass">
                    Temui pemandu lokal berpengalaman kami yang akan memandu Anda dengan aman menjelajahi keajaiban Lubuk
                    Hitam
                </p>
            </div>

            @if ($tourGuides && $tourGuides->count() > 0)
                <div class="glass-grid">
                    @foreach ($tourGuides as $index => $guide)
                        <div class="glass-card scroll-reveal" style="animation-delay: {{ $index * 0.1 }}s;">
                            <!-- Guide Photo -->
                            @if ($guide->foto)
                                <div class="guide-photo mb-3">
                                    <img src="{{ asset('storage/' . $guide->foto) }}" alt="{{ $guide->nama }}"
                                        class="guide-image">
                                </div>
                            @endif

                            <!-- Guide Info -->
                            <h3 class="card-title-glass">{{ $guide->nama }}</h3>

                            <div class="card-description-glass">
                                <div class="guide-details">
                                    <!-- Address -->
                                    @if ($guide->alamat)
                                        <div class="detail-row">
                                            <i class="fas fa-map-marker-alt"></i>
                                            <span>{{ $guide->alamat }}</span>
                                        </div>
                                    @endif

                                    <!-- Phone -->
                                    @if ($guide->nohp)
                                        <div class="detail-row">
                                            <i class="fas fa-phone"></i>
                                            <a href="tel:{{ $guide->nohp }}">{{ $guide->nohp }}</a>
                                        </div>
                                    @endif

                                    <!-- Description -->
                                    @if ($guide->deskripsi)
                                        <div class="detail-description">
                                            <p>{{ Str::limit($guide->deskripsi, 120) }}</p>
                                        </div>
                                    @endif
                                </div>

                                <!-- Price Display -->
                                <div class="price-section mt-3">
                                    <span class="price-display">
                                        @if ($guide->price_range)
                                            {{ $guide->price_range }}/hari
                                        @elseif($guide->harga)
                                            Rp {{ number_format($guide->harga, 0, ',', '.') }}/hari
                                        @else
                                            Harga belum tersedia
                                        @endif
                                    </span>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="card-actions">
                                <a href="{{ route('tourguides.order', $guide->id) }}" class="btn-glass btn-details">
                                    <i class="fas fa-eye me-1"></i>
                                    Lihat Detail
                                </a>
                                <a href="{{ route('tourguides.order', $guide->id) }}" class="btn-glass btn-glass-primary">
                                    <i class="fas fa-calendar-check me-1"></i>
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <div class="glass-card mx-auto" style="max-width: 500px;">
                        <div style="font-size: 4rem; margin-bottom: 1.5rem; opacity: 0.5;">👨‍🏫</div>
                        <h3 class="card-title-glass">Pemandu Wisata Segera Hadir</h3>
                        <p class="card-description-glass">
                            Pemandu profesional kami akan segera tersedia untuk meningkatkan pengalaman Anda di Lubuk Hitam.
                        </p>
                    </div>
                </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ route('tourguides.index') }}" class="btn-glass btn-glass-primary">
                    <i class="fas fa-users me-2"></i>
                    Lihat Semua Pemandu
                </a>
            </div>
        </div>
    </section>


    <!-- Facilities Section -->
    <section class="glass-section">
        <div class="container">
            <div class="section-header-glass scroll-reveal">
                <h2 class="section-title-glass">Fasilitas Unggulan Kami</h2>
                <p class="section-description-glass">
                    Rasakan kenyamanan dan kemudahan dengan fasilitas terbaik yang kami sediakan untuk melengkapi pengalaman
                    Anda di Lubuk Hitam.
                </p>
            </div>

            @if ($facilities->count() > 0)
                <div class="glass-grid">
                    @foreach ($facilities as $index => $facility)
                        <div class="glass-card scroll-reveal" style="animation-delay: {{ $index * 0.1 }}s;">
                            @if ($facility->foto)
                                <div style="margin-bottom: 1.5rem; border-radius: 15px; overflow: hidden; height: 200px;">
                                    <img src="{{ asset('storage/' . $facility->foto) }}"
                                        alt="{{ $facility->nama_fasilitas }}"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                </div>
                            @endif

                            <h3 class="card-title-glass">{{ $facility->nama_fasilitas }}</h3>
                            <p class="card-description-glass">
                                {{ $facility->deskripsi ?? 'Fasilitas ini dirancang khusus untuk menunjang kenyamanan Anda selama berkunjung.' }}
                            </p>

                            @if ($facility->lokasi || $facility->status)
                                <div
                                    style="margin-top: 1.5rem; padding-top: 1.5rem; border-top: 1px solid rgba(34, 139, 34, 0.1);">
                                    @if ($facility->lokasi)
                                        <div style="margin-bottom: 0.5rem; font-size: 0.9rem; color: #2d5a3d;">
                                            <strong>Location:</strong> {{ $facility->lokasi }}
                                        </div>
                                    @endif

                                    @if ($facility->status)
                                        <div>
                                            <span
                                                style="background: linear-gradient(135deg, #228B22, #90EE90); color: white; padding: 0.25rem 0.75rem; border-radius: 20px; font-size: 0.8rem; font-weight: 500;">
                                                {{ $facility->status }}
                                            </span>
                                        </div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <div class="glass-card mx-auto" style="max-width: 500px;">
                        <h3 class="card-title-glass">FFasilitas Akan Segera Tersedia</h3>
                        <p class="card-description-glass">Kami sedang menyiapkan berbagai fasilitas menarik untuk mendukung
                            pengalaman Anda di Lubuk Hitam.</p>
                    </div>
                </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ url('facilities/') }}" class="btn-glass btn-glass-primary">
                    Jelajahi Semua Fasilitas
                </a>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="glass-section glass-bg-secondary">
        <div class="container">
            <div class="section-header-glass scroll-reveal">
                <h2 class="section-title-glass">Jelajahi Galeri</h2>
                <p class="section-description-glass">
                    Nikmati keindahan Lubuk Hitam melalui koleksi foto pilihan yang memukau
                </p>
            </div>

            @if ($galleries->count() > 0)
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr)); gap: 2rem; margin-top: 4rem;">
                    @foreach ($galleries as $gallery)
                        <div class="scroll-reveal"
                            style="position: relative; border-radius: 20px; overflow: hidden; cursor: pointer; transition: transform 0.3s ease; box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);">
                            <img src="{{ asset('storage/' . $gallery->foto) }}" alt="{{ $gallery->judul }}"
                                style="width: 100%; height: 250px; object-fit: cover; transition: transform 0.3s ease;">
                            <div
                                style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(135deg, rgba(10, 31, 15, 0.7), rgba(34, 139, 34, 0.5)); display: flex; flex-direction: column; align-items: center; justify-content: center; opacity: 0; transition: opacity 0.3s ease; color: white; text-align: center; padding: 1.5rem;">
                                <h4 style="font-size: 1.2rem; font-weight: 600; margin-bottom: 0.5rem;">
                                    {{ $gallery->judul }}</h4>
                                <p style="font-size: 0.9rem; opacity: 0.9;">
                                    {{ Str::limit($gallery->deskripsi ?? 'Panorama menakjubkan dari Lubuk Hitam', 60) }}
                                </p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <div class="glass-card mx-auto" style="max-width: 500px;">
                        <h3 class="card-title-glass">Galeri Segera Hadir</h3>
                        <p class="card-description-glass">Koleksi foto keindahan Lubuk Hitam akan segera tersedia untuk
                            Anda nikmati.</p>
                    </div>
                </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ url('gallery/') }}" class="btn-glass btn-glass-primary">
                    Lihat Selengkapnya
                </a>
            </div>
        </div>
    </section>

    <!-- Local Products Section -->
    <section class="glass-section">
        <div class="container">
            <div class="section-header-glass scroll-reveal">
                <h2 class="section-title-glass">Produk Unggulan Warga</h2>
                <p class="section-description-glass">
                    Dukung usaha warga lokal dengan menikmati produk-produk khas dari Lubuk Hitam.
            </div>

            <div class="row">
                <!-- Honey Products -->
                <div class="col-lg-6 mb-5">
                    <div class="scroll-reveal">
                        <h3
                            style="font-size: 2rem; font-weight: 600; margin-bottom: 2rem; text-align: center; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                            Madu Hutan Alami
                        </h3>

                        @if ($madus->count() > 0)
                            <div
                                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                                @foreach ($madus as $madu)
                                    <div class="glass-card scroll-reveal" style="overflow: hidden;">
                                        @if ($madu->gambar)
                                            <div
                                                style="margin-bottom: 1.5rem; border-radius: 15px; overflow: hidden; height: 200px;">
                                                <img src="{{ asset('storage/' . $madu->gambar) }}"
                                                    alt="{{ $madu->nama_madu }}"
                                                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                            </div>
                                        @else
                                            <div
                                                style="height: 200px; background: linear-gradient(135deg, #fbbf24, #f59e0b); color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 600; margin-bottom: 1.5rem; border-radius: 15px;">
                                                Madu
                                            </div>
                                        @endif
                                        <h4 class="card-title-glass">{{ $madu->nama_madu }}</h4>
                                        <div
                                            style="font-size: 1.2rem; font-weight: 700; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 1rem;">
                                            Rp {{ number_format($madu->harga, 0, ',', '.') }}
                                        </div>
                                        <p style="color: #64748b; line-height: 1.6; margin-bottom: 1.5rem;">
                                            {{ Str::limit($madu->deskripsi ?? 'Pure natural honey from local beekeepers', 80) }}
                                        </p>
                                        <a href="{{ route('madu.order', $madu->id) }}"
                                            class="btn-glass btn-glass-primary"
                                            style="width: 100%; justify-content: center;">
                                            Pesan Sekarang
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center">
                                <div class="glass-card">
                                    <h5 class="card-title-glass">Madu Segera Tersedia</h5>
                                    <p class="card-description-glass">Kami sedang menyiapkan madu hutan terbaik untuk Anda.
                                    </p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- UMKM Products -->
                <div class="col-lg-6 mb-5">
                    <div class="scroll-reveal">
                        <h3
                            style="font-size: 2rem; font-weight: 600; margin-bottom: 2rem; text-align: center; background: linear-gradient(135deg, #228B22, #90EE90); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">
                            Produk UMKM
                        </h3>

                        @if ($produkUMKMs->count() > 0)
                            <div
                                style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 2rem;">
                                @foreach ($produkUMKMs as $produk)
                                    <div class="glass-card scroll-reveal" style="overflow: hidden;">
                                        @if ($produk->foto)
                                            <div
                                                style="margin-bottom: 1.5rem; border-radius: 15px; overflow: hidden; height: 200px;">
                                                <img src="{{ asset('storage/' . $produk->foto) }}"
                                                    alt="{{ $produk->nama_produk }}"
                                                    style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                            </div>
                                        @else
                                            <div
                                                style="height: 200px; background: linear-gradient(135deg, #228B22, #90EE90); color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 600; margin-bottom: 1.5rem; border-radius: 15px;">
                                                UMKM
                                            </div>
                                        @endif
                                        <h4 class="card-title-glass">{{ $produk->nama }}</h4>
                                        <div
                                            style="font-size: 1.2rem; font-weight: 700; background: linear-gradient(135deg, #228B22, #90EE90); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 1rem;">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </div>
                                        <p style="color: #64748b; line-height: 1.6; margin-bottom: 1.5rem;">
                                            {{ Str::limit($produk->deskripsi ?? 'Handcrafted product from local community', 80) }}
                                        </p>
                                        <a href="{{ route('produkUMKM.index') }}" class="btn-glass btn-glass-primary"
                                            style="width: 100%; justify-content: center;">
                                            Info Lebih Lanjut
                                        </a>
                                    </div>
                                @endforeach
                            </div>
                        @else
                            <div class="text-center">
                                <div class="glass-card">
                                    <h5 class="card-title-glass">Produk UMKM Belum Tersedia</h5>
                                    <p class="card-description-glass">Daftar produk UMKM sedang dalam proses kurasi.</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Latest News Section -->
    <section class="glass-section glass-bg-primary">
        <div class="container">
            <div class="section-header-glass scroll-reveal">
                <h2 class="section-title-glass">Berita & Informasi Terbaru</h2>
                <p class="section-description-glass">
                    Ikuti perkembangan terbaru dan cerita menarik seputar Lubuk Hitam
                </p>
            </div>

            @if ($beritas->count() > 0)
                <div class="glass-grid">
                    @foreach ($beritas as $index => $berita)
                        <div class="glass-card scroll-reveal"
                            style="animation-delay: {{ $index * 0.2 }}s; overflow: hidden; position: relative;">
                            <!-- Shimmer effect overlay -->
                            <div
                                style="position: absolute; top: 0; left: 0; right: 0; height: 100%; background: linear-gradient(45deg, transparent 30%, rgba(255, 255, 255, 0.1) 50%, transparent 70%); transform: translateX(-100%); transition: transform 0.6s ease; z-index: 1;">
                            </div>

                            @if ($berita->foto)
                                <div style="margin-bottom: 1.5rem; border-radius: 15px; overflow: hidden; height: 220px;">
                                    <img src="{{ asset('storage/' . $berita->foto) }}" alt="{{ $berita->judul }}"
                                        style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
                                </div>
                            @else
                                <div
                                    style="height: 220px; background: linear-gradient(135deg, #228B22, #90EE90); color: white; display: flex; align-items: center; justify-content: center; font-size: 2rem; font-weight: 600; margin-bottom: 1.5rem; border-radius: 15px;">
                                    Berita
                                </div>
                            @endif

                            <div style="position: relative; z-index: 2;">
                                <h4 class="card-title-glass">{{ $berita->judul }}</h4>
                                <div style="color: #2d5a3d; font-size: 0.9rem; margin-bottom: 1rem; font-weight: 500;">
                                    {{ \Carbon\Carbon::parse($berita->created_at)->format('F d, Y') }}
                                </div>
                                <p class="card-description-glass">
                                    {{ Str::limit($berita->deskripsi ?? 'Read more about this news update.', 120) }}</p>

                                <a href="{{ route('berita.detail', $berita->id) }}" class="btn-glass btn-glass-primary">
                                    Baca Selengkapnya
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center">
                    <div class="glass-card mx-auto" style="max-width: 500px;">
                        <h3 class="card-title-glass">Berita Segera Hadir</h3>
                        <p class="card-description-glass">Informasi terbaru tentang Air Terjun Lubuk Hitam akan kami
                            bagikan segera, ditunggu ya!
                        </p>
                    </div>
                </div>
            @endif

            <div class="text-center mt-5">
                <a href="{{ url('beritas/') }}" class="btn-glass btn-glass-primary">
                    Lihat Semua Berita
                </a>
            </div>
        </div>
    </section>

    <!-- Interactive Services Section -->
    <section class="glass-section">
        <div class="container">
            <div class="section-header-glass scroll-reveal">
                <h2 class="section-title-glass">Rencanakan Kunjungan Anda</h2>
                <p class="section-description-glass">
                    Dapatkan info penting supaya kunjungan ke Lubuk Hitam makin mudah dan menyenangkan
                </p>
            </div>

            <div class="glass-grid" style="grid-template-columns: repeat(2, 1fr); gap: 2rem;">
                <!-- Weather Card -->
                <div class="glass-card scroll-reveal text-center"
                    style="position: relative; overflow: hidden; display: flex; flex-direction: column; min-height: 500px;">
                    <div style="flex-shrink: 0;">
                        <div
                            style="font-size: 4rem; margin-bottom: 1.5rem; background: linear-gradient(135deg, #3b82f6, #06b6d4); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800;">
                            Cuaca
                        </div>
                        <h3 class="card-title-glass">Info Cuaca Terbaru</h3>
                        <p class="card-description-glass">
                            Cek update cuaca secara langsung, termasuk suhu, kelembapan, dan kondisi angin untuk persiapan
                            kunjungan Anda.
                        </p>
                    </div>

                    <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="row mt-3 mb-4">
                            <div class="col-4">
                                <div style="font-size: 1.2rem; font-weight: 600; color: #3b82f6;">Suhu</div>
                                <small style="color: #64748b;">Terbaru</small>
                            </div>
                            <div class="col-4">
                                <div style="font-size: 1.2rem; font-weight: 600; color: #06b6d4;">Kelembapan</div>
                                <small style="color: #64748b;">Tingkat Kenyamanan</small>
                            </div>
                            <div class="col-4">
                                <div style="font-size: 1.2rem; font-weight: 600; color: #10b981;">Angin</div>
                                <small style="color: #64748b;">Kondisi Terkini</small>
                            </div>
                        </div>

                        <div style="margin-top: auto;">
                            <a href="{{ url('weather') }}" class="btn-glass btn-glass-primary"
                                style="width: 100%; justify-content: center; padding: 1rem 1.5rem; font-size: 1rem;">
                                <i class="fas fa-cloud-sun me-2"></i>
                                Cek Cuaca
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Entrance Ticket Rates Card -->
                <div class="glass-card scroll-reveal text-center"
                    style="position: relative; overflow: hidden; display: flex; flex-direction: column; min-height: 500px;">
                    <div style="flex-shrink: 0;">
                        <div
                            style="font-size: 4rem; margin-bottom: 1.5rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800;">
                            💳
                        </div>
                        <h3 class="card-title-glass">Tiket Masuk</h3>
                        <p class="card-description-glass">
                            Informasi harga tiket masuk ke kawasan wisata Air Terjun Lubuk Hitam yang terjangkau untuk semua
                            kalangan.
                        </p>
                    </div>

                    <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <!-- Price Display -->
                        <div class="mt-3 mb-3"
                            style="background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(251, 191, 36, 0.1)); border-radius: 15px; padding: 1.5rem; border: 2px solid rgba(245, 158, 11, 0.2);">
                            <div
                                style="font-size: 2.2rem; font-weight: 800; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; margin-bottom: 0.5rem;">
                                Rp 8.000,-
                            </div>
                            <div style="font-size: 1.1rem; color: #92400e; font-weight: 600;">
                                Per Orang
                            </div>
                            <div style="font-size: 0.9rem; color: #a16207; margin-top: 0.5rem;">
                                Berlaku untuk semua usia
                            </div>
                        </div>

                        <!-- Additional Info -->
                        <div class="row mt-2 mb-3">
                            <div class="col-4">
                                <div style="font-size: 1rem; font-weight: 600; color: #f59e0b;">Terjangkau</div>
                                <small style="color: #64748b;">Harga Ramah</small>
                            </div>
                            <div class="col-4">
                                <div style="font-size: 1rem; font-weight: 600; color: #fbbf24;">Semua Usia</div>
                                <small style="color: #64748b;">Keluarga</small>
                            </div>
                            <div class="col-4">
                                <div style="font-size: 1rem; font-weight: 600; color: #d97706;">Akses Penuh</div>
                                <small style="color: #64748b;">Fasilitas</small>
                            </div>
                        </div>

                        <!-- Important Notes -->
                        <div
                            style="background: rgba(34, 139, 34, 0.1); border-radius: 10px; padding: 1rem; margin-bottom: 1rem; border-left: 4px solid #228B22;">
                            <div style="font-size: 0.9rem; color: #1a5f1a; font-weight: 500;">
                                <i class="fas fa-info-circle me-2"></i>
                                Tiket sudah termasuk akses ke area air terjun dan fasilitas umum
                            </div>
                        </div>

                        <div style="margin-top: auto;">
                            <a href="{{ route('minimap.index') }}" class="btn-glass btn-glass-primary"
                                style="width: 100%; justify-content: center; padding: 1rem 1.5rem; font-size: 1rem;">
                                <i class="fas fa-ticket-alt me-2"></i>
                                Rencanakan Kunjungan
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Interactive Map Card -->
                <div class="glass-card scroll-reveal text-center"
                    style="position: relative; overflow: hidden; display: flex; flex-direction: column; min-height: 500px;">
                    <div style="flex-shrink: 0;">
                        <div
                            style="font-size: 4rem; margin-bottom: 1.5rem; background: linear-gradient(135deg, #228B22, #90EE90); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800;">
                            Peta
                        </div>
                        <h3 class="card-title-glass">Peta Interaktif</h3>
                        <p class="card-description-glass">
                            Temukan jalur, tempat menarik, dan fasilitas penting dengan mudah lewat peta interaktif ini.
                        </p>
                    </div>

                    <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="row mt-3 mb-4">
                            <div class="col-3">
                                <div style="font-size: 1rem; font-weight: 600;">Jalur</div>
                                <small style="color: #64748b;">Rute Perjalanan</small>
                            </div>
                            <div class="col-3">
                                <div style="font-size: 1rem; font-weight: 600;">Tempat</div>
                                <small style="color: #64748b;">Spot Menarik</small>
                            </div>
                            <div class="col-3">
                                <div style="font-size: 1rem; font-weight: 600;">Fasilitas</div>
                                <small style="color: #64748b;">Layanan</small>
                            </div>
                            <div class="col-3">
                                <div style="font-size: 1rem; font-weight: 600;">Pemandangan</div>
                                <small style="color: #64748b;">Galeri</small>
                            </div>
                        </div>

                        <div style="margin-top: auto;">
                            <a href="{{ route('minimap.index') }}" class="btn-glass btn-glass-primary"
                                style="width: 100%; justify-content: center; padding: 1rem 1.5rem; font-size: 1rem;">
                                <i class="fas fa-map-marked-alt me-2"></i>
                                Buka Peta
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Contact & Support Card -->
                <div class="glass-card scroll-reveal text-center"
                    style="position: relative; overflow: hidden; display: flex; flex-direction: column; min-height: 500px;">
                    <div style="flex-shrink: 0;">
                        <div
                            style="font-size: 4rem; margin-bottom: 1.5rem; background: linear-gradient(135deg, #f59e0b, #fbbf24); -webkit-background-clip: text; -webkit-text-fill-color: transparent; font-weight: 800;">
                            Bantuan
                        </div>
                        <h3 class="card-title-glass">Kontak & Dukungan</h3>
                        <p class="card-description-glass">
                            Hubungi kami kapan saja untuk bantuan, reservasi, atau info seputar kunjungan Anda.
                        </p>
                    </div>

                    <div style="flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="mt-3 mb-4">
                            <div
                                style="margin-bottom: 1rem; padding: 0.75rem; background: rgba(245, 158, 11, 0.1); border-radius: 10px; border-left: 3px solid #f59e0b;">
                                <div style="font-size: 1rem; font-weight: 600; color: #f59e0b;">
                                    <i class="fas fa-clock me-2"></i>
                                    24/7 Layanan
                                </div>
                            </div>
                            <div
                                style="margin-bottom: 1rem; padding: 0.75rem; background: rgba(245, 158, 11, 0.1); border-radius: 10px; border-left: 3px solid #fbbf24;">
                                <div style="font-size: 1rem; font-weight: 600; color: #fbbf24;">
                                    <i class="fas fa-calendar-check me-2"></i>
                                    Bantuan Reservasi
                                </div>
                            </div>
                            <div
                                style="padding: 0.75rem; background: rgba(245, 158, 11, 0.1); border-radius: 10px; border-left: 3px solid #d97706;">
                                <div style="font-size: 1rem; font-weight: 600; color: #d97706;">
                                    <i class="fas fa-info-circle me-2"></i>
                                    Informasi Lokal
                                </div>
                            </div>
                        </div>

                        <div style="margin-top: auto;">
                            <a href="{{ url('contact') }}" class="btn-glass btn-glass-primary"
                                style="width: 100%; justify-content: center; padding: 1rem 1.5rem; font-size: 1rem;">
                                <i class="fas fa-phone me-2"></i>
                                Hubungi Kami
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Responsive Adjustments -->
            <style>
                @media (max-width: 768px) {
                    .glass-grid[style*="repeat(2, 1fr)"] {
                        grid-template-columns: 1fr !important;
                        gap: 1.5rem !important;
                    }

                    .glass-card[style*="min-height: 500px"] {
                        min-height: auto !important;
                    }
                }
            </style>

        </div>
    </section>

    <!-- Call to Action Section -->
    <section
        style="position: relative; padding: 8rem 0; background: linear-gradient(135deg, rgba(10, 31, 15, 0.95) 0%, rgba(26, 61, 46, 0.9) 50%, rgba(45, 90, 61, 0.95) 100%), url('https://www.itrip.id/wp-content/uploads/2022/04/Alamat-Air-Terjun-Lubuk-Hitam-.jpg') center/cover fixed; color: white; text-align: center; overflow: hidden;">
        <!-- Animated background elements -->
        <div
            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: radial-gradient(circle at 20% 80%, rgba(144, 238, 144, 0.2) 0%, transparent 50%), radial-gradient(circle at 80% 20%, rgba(34, 139, 34, 0.2) 0%, transparent 50%); animation: float 15s ease-in-out infinite;">
        </div>

        <div class="container">
            <div class="scroll-reveal"
                style="position: relative; z-index: 2; max-width: 800px; margin: 0 auto; padding: 3rem; background: rgba(255, 255, 255, 0.1); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 25px; box-shadow: 0 25px 80px rgba(10, 31, 15, 0.6);">
                <h2
                    style="font-size: clamp(2rem, 4vw, 3.5rem); font-weight: 800; margin-bottom: 1.5rem; line-height: 1.2;">
                    Siap untuk Petualangan Alammu?
                </h2>
                <p style="font-size: 1.3rem; margin-bottom: 3rem; opacity: 0.95; line-height: 1.6;">
                    Bergabunglah dengan ribuan pecinta alam yang telah menemukan keajaiban Air Terjun Lubuk Hitam.
                    Pesan pemandu, jelajahi fasilitas, dan ciptakan kenangan tak terlupakan di surga alam ini.
                </p>
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 1rem;">
                    <a href="{{ url('tourguides/') }}" class="btn-glass btn-glass-primary">
                        Pesan Tour Guide
                    </a>
                    <a href="{{ route('minimap.index') }}" class="btn-glass btn-details" style="color: white;">
                        Rencanakan Rute Kamu
                    </a>
                    <a href="{{ url('contact') }}" class="btn-glass btn-glass-details" style="color: white;">
                        Dapatkan Informasi
                    </a>
                </div>
            </div>
        </div>
    </section>
    @include('layouts.footer')
    <script>
        // Additional JavaScript for enhanced interactions
        document.addEventListener('DOMContentLoaded', function() {
            // Enhanced scroll reveal for all sections
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('revealed');

                        // Trigger counter animation for statistics
                        const statNumbers = entry.target.querySelectorAll('[data-count]');
                        statNumbers.forEach(statNumber => {
                            if (!statNumber.classList.contains('animated')) {
                                animateCounter(statNumber);
                                statNumber.classList.add('animated');
                            }
                        });

                        // Trigger shimmer effect for news cards
                        const shimmerOverlay = entry.target.querySelector(
                            'div[style*="translateX(-100%)"]');
                        if (shimmerOverlay) {
                            setTimeout(() => {
                                shimmerOverlay.style.transform = 'translateX(100%)';
                            }, 500);
                        }
                    }
                });
            }, observerOptions);

            // Observe all scroll-reveal elements
            document.querySelectorAll('.scroll-reveal').forEach(el => {
                observer.observe(el);
            });

            // Enhanced counter animation
            function animateCounter(element) {
                const target = parseInt(element.getAttribute('data-count'));
                const duration = 2000;
                const step = target / (duration / 16);
                let current = 0;

                const timer = setInterval(() => {
                    current += step;
                    if (current >= target) {
                        current = target;
                        clearInterval(timer);
                    }
                    element.textContent = Math.floor(current);
                }, 16);
            }

            // Gallery hover effects
            document.querySelectorAll('.glass-section img').forEach(img => {
                const container = img.closest('div[style*="position: relative"]');
                if (container) {
                    const overlay = container.querySelector('div[style*="position: absolute"]');

                    container.addEventListener('mouseenter', function() {
                        img.style.transform = 'scale(1.1)';
                        if (overlay) {
                            overlay.style.opacity = '1';
                        }
                        this.style.transform = 'translateY(-5px) scale(1.02)';
                    });

                    container.addEventListener('mouseleave', function() {
                        img.style.transform = 'scale(1)';
                        if (overlay) {
                            overlay.style.opacity = '0';
                        }
                        this.style.transform = 'translateY(0) scale(1)';
                    });
                }
            });

            // Enhanced button interactions
            document.querySelectorAll('.btn-glass').forEach(button => {
                button.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.05)';
                    this.style.boxShadow = '0 15px 35px rgba(34, 139, 34, 0.4)';
                });

                button.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0) scale(1)';
                    this.style.boxShadow = '0 8px 25px rgba(34, 139, 34, 0.2)';
                });

                // Ripple effect on click
                button.addEventListener('click', function(e) {
                    const ripple = document.createElement('span');
                    const rect = this.getBoundingClientRect();
                    const size = Math.max(rect.width, rect.height);
                    const x = e.clientX - rect.left - size / 2;
                    const y = e.clientY - rect.top - size / 2;

                    ripple.style.cssText = `
                position: absolute;
                width: ${size}px;
                height: ${size}px;
                left: ${x}px;
                top: ${y}px;
                background: rgba(255, 255, 255, 0.3);
                border-radius: 50%;
                transform: scale(0);
                animation: ripple-effect 0.6s linear;
                pointer-events: none;
                z-index: 10;
            `;

                    this.style.position = 'relative';
                    this.appendChild(ripple);

                    setTimeout(() => {
                        ripple.remove();
                    }, 600);
                });
            });

            // Smooth scrolling for internal links
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

            // Lazy loading optimization
            if ('IntersectionObserver' in window) {
                const imageObserver = new IntersectionObserver((entries, observer) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            const img = entry.target;
                            if (img.dataset.src) {
                                img.src = img.dataset.src;
                                img.classList.remove('loading');
                                observer.unobserve(img);
                            }
                        }
                    });
                });

                document.querySelectorAll('img[data-src]').forEach(img => {
                    img.classList.add('loading');
                    imageObserver.observe(img);
                });
            }

            // Performance monitoring
            const performanceObserver = new PerformanceObserver((list) => {
                list.getEntries().forEach((entry) => {
                    if (entry.entryType === 'navigation') {
                        console.log('Page Load Time:', entry.loadEventEnd - entry.loadEventStart,
                            'ms');
                    }
                });
            });

            if ('PerformanceObserver' in window) {
                performanceObserver.observe({
                    entryTypes: ['navigation']
                });
            }

            // Accessibility enhancements
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Tab') {
                    document.body.classList.add('keyboard-navigation');
                }
            });

            document.addEventListener('mousedown', function() {
                document.body.classList.remove('keyboard-navigation');
            });

            // Error handling for images
            document.querySelectorAll('img').forEach(img => {
                img.addEventListener('error', function() {
                    const placeholder = document.createElement('div');
                    placeholder.style.cssText = `
                width: 100%;
                height: ${this.offsetHeight || 200}px;
                background: linear-gradient(135deg, #f8fffe, #e6ffe6);
                border-radius: 15px;
                display: flex;
                align-items: center;
                justify-content: center;
                color: #64748b;
                font-size: 1rem;
                font-weight: 500;
                border: 2px dashed #cccccc;
            `;
                    placeholder.textContent = 'Image not available';
                    this.parentNode.replaceChild(placeholder, this);
                });
            });

            // Network status monitoring
            function updateNetworkStatus() {
                const status = navigator.onLine ? 'online' : 'offline';
                document.body.setAttribute('data-network-status', status);

                if (!navigator.onLine) {
                    showNotification('You are offline. Some features may not work properly.', 'warning');
                }
            }

            window.addEventListener('online', updateNetworkStatus);
            window.addEventListener('offline', updateNetworkStatus);
            updateNetworkStatus();

            // Simple notification system
            function showNotification(message, type = 'info') {
                const notification = document.createElement('div');
                const bgColor = type === 'success' ? 'linear-gradient(135deg, #228B22, #2d5a3d)' :
                    type === 'warning' ? 'linear-gradient(135deg, #f59e0b, #fbbf24)' :
                    'linear-gradient(135deg, #1a3d2e, #0a1f0f)';

                notification.style.cssText = `
            position: fixed;
            top: 80px;
            right: 20px;
            z-index: 10000;
            padding: 1rem 1.5rem;
            background: ${bgColor};
            color: white;
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            font-weight: 500;
            max-width: 350px;
            animation: slideInRight 0.4s cubic-bezier(0.25, 0.8, 0.25, 1);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        `;
                notification.textContent = message;

                document.body.appendChild(notification);

                setTimeout(() => {
                    notification.style.animation = 'slideOutRight 0.4s cubic-bezier(0.25, 0.8, 0.25, 1)';
                    setTimeout(() => notification.remove(), 400);
                }, 4000);
            }

            // Initialize on page load
            window.addEventListener('load', function() {
                document.body.classList.add('loaded');
                showNotification('Selamat Datang di Wisata Air Terjun Lubuk Hitam! ', 'success');

                // Preload critical images
                const criticalImages = [
                    'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80'
                ];

                criticalImages.forEach(src => {
                    const img = new Image();
                    img.src = src;
                });
            });

            console.log('✅ Lubuk Hitam Modern Homepage Loaded Successfully!');
        });

        // Additional CSS for enhanced animations
        const enhancedStyles = document.createElement('style');
        enhancedStyles.textContent = `
    /* Keyboard navigation styles */
    .keyboard-navigation *:focus {
        outline: 2px solid rgba(34, 139, 34, 0.8) !important;
        outline-offset: 2px !important;
    }
    
    /* Loading states */
    img.loading {
        background: linear-gradient(90deg, #f0fff0 25%, #e6ffe6 50%, #f0fff0 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }
    
    /* Network status indicators */
    body[data-network-status="offline"] .btn-glass {
        opacity: 0.7;
        pointer-events: none;
    }
    
    body[data-network-status="offline"]::before {
        content: "You are currently offline";
        position: fixed;
        top: 0;
        left: 0;
        right: 0;
        background: linear-gradient(135deg, #f59e0b, #fbbf24);
        color: white;
        text-align: center;
        padding: 0.5rem;
        font-size: 0.9rem;
        font-weight: 500;
        z-index: 10001;
    }
    
    /* Enhanced hover effects */
    .glass-card:hover img {
        transform: scale(1.05);
    }
    
    /* Smooth transitions for all elements */
    * {
        transition: transform 0.3s cubic-bezier(0.25, 0.8, 0.25, 1),
                   opacity 0.3s ease,
                   box-shadow 0.3s ease;
    }
    
    /* Custom scrollbar for webkit browsers */
    ::-webkit-scrollbar {
        width: 8px;
    }
    
    ::-webkit-scrollbar-track {
        background: #f0fff0;
    }
    
    ::-webkit-scrollbar-thumb {
        background: linear-gradient(135deg, #228B22, #90EE90);
        border-radius: 4px;
    }
    
    ::-webkit-scrollbar-thumb:hover {
        background: linear-gradient(135deg, #1a3d2e, #228B22);
    }
    
    /* Print optimizations */
    @media print {
        .hero-dark-modern,
        .glass-section {
            background: white !important;
            color: black !important;
        }
        
        .btn-glass {
            border: 1px solid black !important;
            background: white !important;
            color: black !important;
        }
        
        .glass-card {
            border: 1px solid #cccccc !important;
            box-shadow: none !important;
        }
    }
    
    /* High contrast mode */
    @media (prefers-contrast: high) {
        .glass-card,
        .hero-stat-item {
            background: white !important;
            border: 2px solid black !important;
            color: black !important;
        }
        
        .section-title-glass,
        .card-title-glass {
            color: black !important;
            -webkit-text-fill-color: black !important;
        }
    }
    
    /* Reduced motion preferences */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
`;

        document.head.appendChild(enhancedStyles);
    </script>

@endsection
