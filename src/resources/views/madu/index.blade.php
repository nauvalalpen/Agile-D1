@extends('layouts.app')

@section('content')
    <style>
        /* Updated color scheme - #1a3d2e (dominant) and #f59e0b */
        :root {
            --hero-primary: #1a3d2e;
            --hero-secondary: #2d4a3a;
            --hero-accent: #f59e0b;
            --hero-light: #f0fdf4;
            --hero-border: #d1fae5;
            --hero-accent-light: #fef3c7;
        }

        /* === 1. HERO SECTION === */
        .hero-section {
            position: relative;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)),
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
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
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
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        @keyframes honeyButtonsSlide {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes ripple-animation {
            to {
                transform: scale(3);
                opacity: 0;
            }
        }

        .ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.3);
            transform: scale(0);
            animation: ripple-animation 0.4s linear;
            pointer-events: none;
        }

        .btn-honey-primary {
            background: linear-gradient(135deg, var(--hero-primary), var(--hero-secondary));
            border: none;
            color: white;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            border-radius: 0.75rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 4px 15px rgba(26, 61, 46, 0.3);
        }

        .btn-honey-primary:hover {
            background: linear-gradient(135deg, var(--hero-secondary), var(--hero-primary));
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(26, 61, 46, 0.4);
            color: white;
        }

        /* Products Section */
        .honey-products-section {
            padding: 4rem 0;
            background: linear-gradient(180deg, var(--hero-light) 0%, rgba(255, 255, 255, 1) 100%);
            min-height: 100vh;
        }

        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--hero-primary);
            margin-bottom: 1rem;
            position: relative;
        }

        .section-title h2::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, var(--hero-primary), var(--hero-accent));
            border-radius: 2px;
        }

        .section-title p {
            font-size: 1.1rem;
            color: var(--hero-secondary);
            opacity: 0.8;
            max-width: 600px;
            margin: 0 auto;
        }

        /* Enhanced Honey Grid Styles */
        .honey-container {
            margin-bottom: 2rem;
        }

        .section-heading {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--hero-primary);
            margin-bottom: 1rem;
            position: relative;
            text-align: center;
        }

        .section-heading::after {
            content: '';
            position: absolute;
            bottom: -0.5rem;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: linear-gradient(135deg, var(--hero-primary), var(--hero-accent));
            border-radius: 2px;
        }

        .section-subheading {
            font-size: 1.1rem;
            color: var(--hero-secondary);
            opacity: 0.8;
            max-width: 600px;
            margin: 0 auto;
            text-align: center;
        }

        /* Product Cards */
        .honey-card {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid var(--hero-border);
            border-radius: 1rem;
            overflow: hidden;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .honey-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
            border-color: var(--hero-primary);
        }

        .honey-card-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 250px;
            flex-shrink: 0;
        }

        .honey-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.3s ease;
        }

        .honey-card:hover .honey-card-img {
            transform: scale(1.05);
        }

        .honey-placeholder {
            width: 100%;
            height: 100%;
            background: var(--hero-light);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--hero-secondary);
        }

        .placeholder-content {
            text-align: center;
        }

        .placeholder-content i {
            color: var(--hero-primary);
            opacity: 0.5;
        }

        .placeholder-text {
            display: block;
            margin-top: 0.5rem;
            font-size: 0.9rem;
            color: var(--hero-secondary);
            opacity: 0.7;
        }

        /* Stock Badges */
        .stock-badge {
            position: absolute;
            top: 1rem;
            right: 1rem;
            padding: 0.5rem 1rem;
            border-radius: 2rem;
            font-size: 0.8rem;
            font-weight: 600;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            display: flex;
            align-items: center;
            gap: 0.25rem;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
        }

        .stock-badge.available {
            background: linear-gradient(135deg, var(--hero-primary), var(--hero-secondary));
            color: white;
        }

        .stock-badge.limited {
            background: linear-gradient(135deg, var(--hero-accent), #d97706);
            color: white;
        }

        .stock-badge.sold-out {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        /* Card Body */
        .honey-card-body {
            padding: 1.5rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        .honey-header {
            margin-bottom: 1rem;
        }

        .honey-title {
            font-size: 1.3rem;
            font-weight: 600;
            color: var(--hero-primary);
            margin-bottom: 0.5rem;
            line-height: 1.3;
        }

        .honey-size {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 0.5rem;
        }

        .size-label {
            font-size: 0.9rem;
            color: var(--hero-secondary);
        }

        .size-value {
            font-weight: 600;
            color: var(--hero-primary);
        }

        .honey-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stars {
            color: var(--hero-accent);
        }

        .rating-text {
            font-size: 0.9rem;
            color: var(--hero-secondary);
            font-weight: 600;
        }

        .honey-price {
            margin-bottom: 1rem;
        }

        .current-price {
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--hero-accent);
        }

        .price-unit {
            font-size: 0.9rem;
            color: var(--hero-secondary);
            margin-left: 0.5rem;
        }

        .honey-description {
            color: var(--hero-secondary);
            opacity: 0.8;
            margin-bottom: 1rem;
            line-height: 1.5;
            font-size: 0.95rem;
            flex-grow: 1;
        }

        .honey-features {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1.5rem;
            flex-wrap: wrap;
        }

        .feature-badge {
            display: flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 1rem;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .feature-badge.natural {
            background: rgba(245, 158, 11, 0.1);
            color: var(--hero-accent);
            border: 1px solid rgba(245, 158, 11, 0.2);
        }

        .feature-badge.premium {
            background: rgba(26, 61, 46, 0.1);
            color: var(--hero-primary);
            border: 1px solid rgba(26, 61, 46, 0.2);
        }

        /* Action Buttons */
        .honey-actions {
            display: flex;
            gap: 0.5rem;
            flex-direction: column;
            margin-top: auto;
        }

        .btn-detail {
            background: rgba(26, 61, 46, 0.1);
            border: 1px solid var(--hero-border);
            color: var(--hero-primary);
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
            cursor: pointer;
        }

        .btn-detail:hover {
            background: var(--hero-primary);
            color: white;
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            text-decoration: none;
        }

        .btn-order {
            background: linear-gradient(135deg, var(--hero-accent), #d97706);
            border: none;
            color: white;
            padding: 0.75rem 1rem;
            border-radius: 0.5rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .btn-order:hover {
            background: linear-gradient(135deg, #d97706, var(--hero-accent));
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            color: white;
            text-decoration: none;
        }

        .btn-detail,
        .btn-order {
            position: relative;
            overflow: hidden;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
            background: var(--hero-light);
            border-radius: 1rem;
            border: 2px dashed var(--hero-border);
        }

        .empty-icon {
            font-size: 3rem;
            color: var(--hero-secondary);
            margin-bottom: 1rem;
            opacity: 0.5;
        }

        .empty-title {
            color: var(--hero-primary);
            margin-bottom: 0.5rem;
            font-size: 1.5rem;
            font-weight: 600;
        }

        .empty-description {
            color: var(--hero-secondary);
            opacity: 0.8;
        }

        /* Modal Styles */
        .modal-content {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1);
        }

        .modal-header {
            border-bottom: 1px solid var(--hero-border);
            padding: 1.5rem;
        }

        .modal-title {
            color: var(--hero-primary);
            font-weight: 600;
        }

        .honey-modal-content {
            padding: 0;
        }

        .honey-modal-image {
            margin-bottom: 0;
        }

        .honey-modal-image img {
            border-radius: 0.75rem;
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            width: 100%;
            height: auto;
            object-fit: cover;
            max-height: 400px;
        }

        .honey-modal-details {
            padding: 0;
        }

        .honey-modal-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--hero-primary);
            margin-bottom: 1rem;
        }

        .honey-modal-price {
            margin-bottom: 1rem;
        }

        .honey-modal-price .current-price {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--hero-accent);
        }

        .honey-modal-price .price-unit {
            font-size: 1rem;
            color: var(--hero-secondary);
            margin-left: 0.5rem;
        }

        .honey-modal-info .info-item {
            margin-bottom: 0.5rem;
            font-size: 1rem;
        }

        .honey-modal-info .info-item strong {
            color: var(--hero-primary);
        }

        .stock-status.available {
            color: var(--hero-primary);
            font-weight: 600;
        }

        .stock-status.limited {
            color: var(--hero-accent);
            font-weight: 600;
        }

        .stock-status.sold-out {
            color: #ef4444;
            font-weight: 600;
        }

        .honey-modal-description h5 {
            color: var(--hero-primary);
            font-weight: 600;
            margin-bottom: 0.75rem;
        }

        .honey-modal-description p {
            color: var(--hero-secondary);
            line-height: 1.6;
        }

        .honey-modal-actions .btn {
            background: linear-gradient(135deg, var(--hero-accent), #d97706);
            border: none;
            color: white;
            padding: 0.75rem 1.5rem;
            border-radius: 0.5rem;
            font-weight: 600;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .honey-modal-actions .btn:hover {
            background: linear-gradient(135deg, #d97706, var(--hero-accent));
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            color: white;
            text-decoration: none;
        }

        /* Loading Spinner */
        .spinner-border {
            width: 2rem;
            height: 2rem;
            border-width: 0.25em;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .section-title h2 {
                font-size: 2rem;
            }

            .honey-actions {
                flex-direction: column;
            }

            .honey-modal-details {
                margin-top: 1.5rem;
                padding: 0;
            }

            .honey-modal-title {
                font-size: 1.3rem;
            }

            .honey-modal-price .current-price {
                font-size: 1.3rem;
            }

            .honey-card-img-wrapper {
                height: 200px;
            }

            .honey-title {
                font-size: 1.2rem;
            }

            .current-price {
                font-size: 1.2rem;
            }
        }

        @media (max-width: 576px) {
            .section-title h2 {
                font-size: 1.8rem;
            }

            .honey-products-section {
                padding: 2rem 0;
            }

            .honey-card-body {
                padding: 1rem;
            }

            .honey-features {
                flex-direction: column;
                align-items: flex-start;
            }

            .feature-badge {
                align-self: flex-start;
            }
        }

        /* About Section Styles */
        .honey-about-section {
            padding: 4rem 0;
            background: linear-gradient(135deg, rgba(254, 243, 199, 0.1) 0%, rgba(255, 255, 255, 0.9) 100%);
        }

        .honey-about-title {
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--honey-accent);
            margin-bottom: 1.5rem;
        }

        .honey-about-description {
            font-size: 1.1rem;
            color: var(--honey-dark);
            opacity: 0.8;
            line-height: 1.6;
            margin-bottom: 2rem;
        }

        .honey-features {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .honey-feature-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            font-size: 1rem;
            font-weight: 500;
            color: var(--honey-dark);
        }

        .honey-feature-item i {
            color: var(--honey-primary);
            font-size: 1.2rem;
        }

        .honey-about-image img {
            border-radius: 1rem;
            box-shadow: 0 8px 30px rgba(245, 158, 11, 0.2);
        }


        /* Animation for cards on load */
        .honey-card {
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 0.6s ease forwards;
        }

        .honey-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .honey-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .honey-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .honey-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .honey-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .honey-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        /* For large tablets and smaller laptops */
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

        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">PRODUK<br>MADU</div>
            <div class="hero-desc">Nikmati kelezatan dan khasiat madu murni berkualitas tinggi dari alam Indonesia yang
                diproduksi dengan standar terbaik.</div>
            <a href="#honey-grid" class="hero-btn">Lihat Produk</a>
        </div>
    </section>
    <div id="honey-grid" class="beritas-container">
        <!-- Honey Products Section -->
        <section class="honey-products-section">
            <div class="container">
                <div class="section-title">
                    <h2>Produk Madu</h2>
                    <p>Madu murni dan alami yang diperoleh dari peternak lebah lokal dengan jaminan kualitas dan keaslian.
                    </p>
                </div>

                <div class="row">
                    @forelse($madus as $madu)
                        <div class="col-lg-4 col-md-6 mb-4">
                            <div class="honey-card">
                                <div class="honey-card-img-wrapper">
                                    @if ($madu->gambar)
                                        <img src="{{ asset('storage/' . $madu->gambar) }}" alt="{{ $madu->nama_madu }}"
                                            class="honey-card-img" loading="lazy">
                                    @else
                                        <div class="honey-placeholder">
                                            <div class="placeholder-content">
                                                <i class="fas fa-jar fa-3x"></i>
                                                <span class="placeholder-text">No Image Available</span>
                                            </div>
                                        </div>
                                    @endif

                                    @if ($madu->stock > 5)
                                        <div class="stock-badge available">
                                            <i class="fas fa-check-circle"></i>
                                            Tersedia
                                        </div>
                                    @elseif($madu->stock > 0)
                                        <div class="stock-badge limited">
                                            <i class="fas fa-exclamation-triangle"></i>
                                            Terbatas
                                        </div>
                                    @else
                                        <div class="stock-badge sold-out">
                                            <i class="fas fa-times-circle"></i>
                                            Tidak Tersedia
                                        </div>
                                    @endif
                                </div>

                                <div class="honey-card-body">
                                    <div class="honey-header">
                                        <h3 class="honey-title">{{ $madu->nama_madu }}</h3>
                                        <div class="honey-size">
                                            <span class="size-label">Ukuran:</span>
                                            <span class="size-value">{{ $madu->ukuran }}</span>
                                        </div>
                                        <div class="honey-rating">
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                            </div>
                                            <span class="rating-text">5.0</span>
                                        </div>
                                    </div>

                                    <div class="honey-price">
                                        <span class="current-price">Rp {{ number_format($madu->harga, 0, ',', '.') }}</span>
                                        <span class="price-unit">per botol</span>
                                    </div>

                                    <p class="honey-description">{{ Str::limit($madu->deskripsi, 100) }}</p>

                                    <div class="honey-features">
                                        <span class="feature-badge natural  d-block text-center">
                                            <i class="fas fa-leaf"></i>
                                            100% Natural
                                        </span>
                                        <span class="feature-badge premium  d-block text-center">
                                            <i class="fas fa-award"></i>
                                            Premium
                                        </span>
                                    </div>

                                    <div class="honey-actions">
                                        <button class="btn-detail" onclick="showHoneyModal({{ $madu->id }})">
                                            <i class="fas fa-info-circle"></i>
                                            Lebih Lengkap
                                        </button>
                                        @auth
                                            @if ($madu->stock > 0)
                                                <a href="{{ route('madu.order', $madu->id) }}" class="btn-order">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    Pesan Sekarang
                                                </a>
                                            @else
                                                <button class="btn-order" disabled style="opacity: 0.5; cursor: not-allowed;">
                                                    <i class="fas fa-times-circle"></i>
                                                    Stok Sudah Habis
                                                </button>
                                            @endif
                                        @else
                                            <a href="{{ route('login') }}" class="btn-order">
                                                <i class="fas fa-sign-in-alt"></i>
                                                Login untuk Memesan
                                            </a>
                                        @endauth
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="col-12">
                            <div class="empty-state">
                                <div class="empty-icon">
                                    <i class="fas fa-jar"></i>
                                </div>
                                <h3 class="empty-title">Tidak Ada Produk Madu Tersedia</h3>
                                <p class="empty-description">Saat ini belum ada produk madu yang tersedia. Silakan kembali
                                    lagi nanti untuk melihat koleksi madu premium kami.</p>
                            </div>
                        </div>
                    @endforelse
                </div>
            </div>
            <div class="container">
                <div class="card border-0 shadow-lg rounded-4 p-4 bg-light">
                    <div class="row align-items-center">
                        <!-- Bagian Konten Teks -->
                        <div class="col-lg-6 mb-4 mb-lg-0">
                            <div class="honey-about-content">
                                <h2 class="honey-about-title mb-3" style="color: #1a3d2e;">Mengapa Memilih Madu Kami?</h2>

                                <p class="honey-about-description text-muted">
                                    Madu kami diperoleh langsung dari peternak lebah lokal yang menerapkan metode
                                    tradisional dan berkelanjutan.
                                    Setiap toples berisi madu murni tanpa proses tambahan, sehingga tetap mempertahankan
                                    seluruh nutrisi dan rasa alaminya.
                                </p>
                                <div class="honey-features mt-4">
                                    <div class="honey-feature-item d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span>100% Murni & Alami</span>
                                    </div>
                                    <div class="honey-feature-item d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span>Tanpa Bahan Tambahan Buatan</span>
                                    </div>
                                    <div class="honey-feature-item d-flex align-items-center mb-2">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span>Dipanen Secara Berkelanjutan</span>
                                    </div>
                                    <div class="honey-feature-item d-flex align-items-center">
                                        <i class="fas fa-check-circle text-success me-2"></i>
                                        <span>Kualitas Terjamin</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Bagian Gambar -->
                        <div class="col-lg-6">
                            <div class="honey-about-image text-center">
                                <img src="{{ asset('images/image.png') }}" alt="Tentang Madu Kami"
                                    class="img-fluid rounded shadow-sm">
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </section>

        <!-- Honey Details Modal -->
        <div class="modal fade" id="honeyModal" tabindex="-1" aria-labelledby="honeyModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="honeyModalLabel">Detail Produk Madu</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="honeyModalContent">
                        <!-- Content will be loaded here -->
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footer')
        <script>
            // Honey data for modal
            const honeyData = @json($madus);

            function showHoneyModal(honeyId) {
                const modal = new bootstrap.Modal(document.getElementById('honeyModal'));
                const modalContent = document.getElementById('honeyModalContent');

                // Show loading state
                modalContent.innerHTML = `
        <div class="text-center py-4">
            <div class="spinner-border" style="color: var(--hero-primary);" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2 text-muted">Loading product details...</p>
        </div>
    `;

                modal.show();

                // Find honey data
                const honey = honeyData.find(item => item.id === honeyId);

                if (honey) {
                    setTimeout(() => {
                        modalContent.innerHTML = `
                <div class="row g-0">
                    <div class="col-md-6">
                        <div class="honey-modal-image">
                            <img src="${honey.gambar ? '/storage/' + honey.gambar : '/images/honey-placeholder.jpg'}" 
                                 alt="${honey.nama_madu}" class="img-fluid">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="honey-modal-details p-4">
                            <h3 class="honey-modal-title">${honey.nama_madu}</h3>
                            <div class="honey-modal-price mb-3">
                                <span class="current-price">Rp ${new Intl.NumberFormat('id-ID').format(honey.harga)}</span>
                                <span class="price-unit">per botol</span>
                            </div>
                            <div class="honey-modal-info mb-3">
                                <div class="info-item">
                                    <strong>Ukuran:</strong> ${honey.ukuran}
                                </div>
                                <div class="info-item">
                                    <strong>Stok:</strong> 
                                    <span class="stock-status ${honey.stock > 5 ? 'available' : honey.stock > 0 ? 'limited' : 'sold-out'}">
                                        ${honey.stock > 0 ? honey.stock + ' Tersedia' : 'Tidak Tersedia'}
                                    </span>
                                </div>
                            </div>
                            <div class="honey-modal-description mb-4">
                                <h5>Deskripsi</h5>
                                <p>${honey.deskripsi}</p>
                            </div>
                            <div class="honey-modal-actions">
                                @auth
                                    ${honey.stock > 0 ? 
                                        `<a href="{{ route('madu.order', $madu->id) }}" class="btn-order">
                                                                                                                    <i class="fas fa-shopping-cart me-2"></i>
                                                                                                                    Pesan Sekarang
                                                                                                                </a>` :
                                        `<button class="btn btn-lg w-100" disabled style="opacity: 0.5; cursor: not-allowed;">
                                                                                                                    <i class="fas fa-times-circle me-2"></i>
                                                                                                                    Tidak Tersedia
                                                                                                                </button>`
                                    }
                                @else
                                    <a href="{{ route('login') }}" class="btn btn-lg w-100">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        Login to Order
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                </div>
            `;
                    }, 500);
                } else {
                    setTimeout(() => {
                        modalContent.innerHTML = `
                <div class="text-center py-4">
                    <div class="text-danger mb-3">
                        <i class="fas fa-exclamation-triangle fa-3x"></i>
                    </div>
                    <h5 class="text-danger">Product Not Found</h5>
                    <p class="text-muted">Unable to load product details. Please try again later.</p>
                </div>
            `;
                    }, 500);
                }
            }

            // Add ripple effect to buttons
            document.addEventListener('DOMContentLoaded', function() {
                // Initialize tooltips if any
                const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
                const tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                    return new bootstrap.Tooltip(tooltipTriggerEl);
                });

                // Add ripple effect to buttons
                document.querySelectorAll('.btn-detail, .btn-order').forEach(button => {
                    button.addEventListener('click', function(e) {
                        // Don't add ripple if button is disabled
                        if (this.disabled) return;

                        const ripple = document.createElement('span');
                        const rect = this.getBoundingClientRect();
                        const size = Math.max(rect.width, rect.height);
                        const x = e.clientX - rect.left - size / 2;
                        const y = e.clientY - rect.top - size / 2;

                        ripple.style.width = ripple.style.height = size + 'px';
                        ripple.style.left = x + 'px';
                        ripple.style.top = y + 'px';
                        ripple.classList.add('ripple');

                        this.appendChild(ripple);

                        setTimeout(() => {
                            if (ripple.parentNode) {
                                ripple.remove();
                            }
                        }, 400);
                    });
                });

                // Lazy loading for images
                if ('IntersectionObserver' in window) {
                    const imageObserver = new IntersectionObserver((entries, observer) => {
                        entries.forEach(entry => {
                            if (entry.isIntersecting) {
                                const img = entry.target;
                                if (img.dataset.src) {
                                    img.src = img.dataset.src;
                                    img.classList.remove('lazy');
                                    observer.unobserve(img);
                                }
                            }
                        });
                    });

                    document.querySelectorAll('img[data-src]').forEach(img => {
                        imageObserver.observe(img);
                    });
                }

                // Add smooth scroll behavior for any anchor links
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

                // Add loading state to order buttons
                document.querySelectorAll('.btn-order').forEach(button => {
                    if (!button.disabled && button.href) {
                        button.addEventListener('click', function(e) {
                            // Add loading state
                            const originalContent = this.innerHTML;
                            this.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Processing...';
                            this.style.pointerEvents = 'none';

                            // Reset after a short delay if still on page
                            setTimeout(() => {
                                if (this.innerHTML.includes('Processing...')) {
                                    this.innerHTML = originalContent;
                                    this.style.pointerEvents = 'auto';
                                }
                            }, 3000);
                        });
                    }
                });

                // Handle modal cleanup
                const honeyModal = document.getElementById('honeyModal');
                if (honeyModal) {
                    honeyModal.addEventListener('hidden.bs.modal', function() {
                        const modalContent = document.getElementById('honeyModalContent');
                        modalContent.innerHTML = '';
                    });
                }

                // Add error handling for images
                document.querySelectorAll('.honey-card-img').forEach(img => {
                    img.addEventListener('error', function() {
                        const placeholder = document.createElement('div');
                        placeholder.className = 'honey-placeholder';
                        placeholder.innerHTML = `
                <div class="placeholder-content">
                    <i class="fas fa-jar fa-3x"></i>
                    <span class="placeholder-text">Image not available</span>
                </div>
            `;
                        this.parentNode.replaceChild(placeholder, this);
                    });
                });

                // Add keyboard navigation for cards
                document.querySelectorAll('.honey-card').forEach((card, index) => {
                    card.setAttribute('tabindex', '0');
                    card.addEventListener('keydown', function(e) {
                        if (e.key === 'Enter' || e.key === ' ') {
                            e.preventDefault();
                            const detailBtn = this.querySelector('.btn-detail');
                            if (detailBtn) {
                                detailBtn.click();
                            }
                        }
                    });
                });

                // Add focus styles for accessibility
                const style = document.createElement('style');
                style.textContent = `
        .honey-card:focus {
            outline: 2px solid var(--hero-primary);
            outline-offset: 2px;
        }
        
        .btn-detail:focus,
        .btn-order:focus {
            outline: 2px solid var(--hero-accent);
            outline-offset: 2px;
        }
    `;
                document.head.appendChild(style);

                // Performance optimization: Preload critical resources
                const preloadLinks = [
                    '/images/honey-placeholder.jpg'
                ];

                preloadLinks.forEach(href => {
                    const link = document.createElement('link');
                    link.rel = 'preload';
                    link.as = 'image';
                    link.href = href;
                    document.head.appendChild(link);
                });

                // Add animation observer for cards
                const cardObserver = new IntersectionObserver((entries) => {
                    entries.forEach(entry => {
                        if (entry.isIntersecting) {
                            entry.target.style.animationPlayState = 'running';
                        }
                    });
                }, {
                    threshold: 0.1
                });

                document.querySelectorAll('.honey-card').forEach(card => {
                    card.style.animationPlayState = 'paused';
                    cardObserver.observe(card);
                });
            });

            // Global error handler
            window.addEventListener('error', function(e) {
                console.error('JavaScript error:', e.error);
            });

            // Handle network status
            window.addEventListener('online', function() {
                console.log('Network connection restored');
            });

            window.addEventListener('offline', function() {
                console.log('Network connection lost');
            });

            // Cleanup on page unload
            window.addEventListener('beforeunload', function() {
                // Clean up any running animations or intervals
                document.querySelectorAll('.honey-card').forEach(card => {
                    card.style.animation = 'none';
                });
            });
        </script>
    @endsection
