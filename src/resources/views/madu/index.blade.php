@extends('layouts.app')

@section('content')
    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">MADU<br>PREMIUM</div>
            <div class="hero-desc">Nikmati kelezatan dan khasiat madu murni berkualitas tinggi dari alam Indonesia</div>
            <a href="#products" class="hero-btn">Explore Products</a>
        </div>
    </section>

    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. HONEY PRODUCTS TITLE CARD -->
        <div class="products-title-card" data-aos="fade-up">
            <div class="title-card-inner">
                <div class="title-card-icon">
                    <div class="honey-drop">🍯</div>
                    <div class="sparkles">
                        <span class="sparkle">✨</span>
                        <span class="sparkle">⭐</span>
                        <span class="sparkle">💫</span>
                    </div>
                </div>
                <div class="title-card-content">
                    <h2 class="products-main-title">Honey Products</h2>
                    <div class="title-underline"></div>
                    <p class="products-subtitle">Koleksi madu premium berkualitas tinggi langsung dari alam Indonesia</p>
                    <div class="products-stats">
                        <div class="stat-item">
                            <span class="stat-number">{{ $madus->count() }}</span>
                            <span class="stat-label">Produk</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <span class="stat-number">100%</span>
                            <span class="stat-label">Murni</span>
                        </div>
                        <div class="stat-divider"></div>
                        <div class="stat-item">
                            <span class="stat-number">Premium</span>
                            <span class="stat-label">Kualitas</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- 3. ENHANCED PRODUCTS GRID -->
        <div id="products" class="products-section">
            <div class="products-grid" id="productGrid">
                @foreach($madus as $madu)
                <div class="product-card-wrapper" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="enhanced-product-card" data-product-id="{{ $madu->id }}">
                        <!-- Product Image Container -->
                        <div class="product-image-container">
                            @if($madu->gambar)
                                <img src="{{ asset('storage/' . $madu->gambar) }}" alt="{{ $madu->nama }}" class="product-image">
                            @else
                                <div class="product-placeholder">
                                    <div class="placeholder-icon">🍯</div>
                                    <span class="placeholder-text">No Image</span>
                                </div>
                            @endif
                            
                            
                            <!-- Stock Badge -->
                            @if($madu->stock <= 5 && $madu->stock > 0)
                                <div class="stock-badge limited">
                                    <span class="badge-icon">⚠️</span>
                                    <span class="badge-text">Stok Terbatas</span>
                                </div>
                            @elseif($madu->stock == 0)
                                <div class="stock-badge sold-out">
                                    <span class="badge-icon">❌</span>
                                    <span class="badge-text">Habis</span>
                                </div>
                            @else
                                <div class="stock-badge available">
                                    <span class="badge-text">Tersedia</span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Enhanced Product Info -->
                        <div class="product-info">
                            <div class="product-header">
                                <h3 class="product-name">{{ $madu->nama }}</h3>
                                <div class="product-rating">
                                    <div class="stars">
                                        <span class="star filled">⭐</span>
                                        <span class="star filled">⭐</span>
                                        <span class="star filled">⭐</span>
                                        <span class="star filled">⭐</span>
                                        <span class="star filled">⭐</span>
                                    </div>
                                    <span class="rating-text">5.0</span>
                                </div>
                            </div>
                            
                            <div class="product-description">
                                <p>{{ Str::limit($madu->deskripsi, 100) }}</p>
                            </div>
                            
                            <div class="product-features">
                                <div class="feature-item">
                                    <span class="feature-icon">🌿</span>
                                    <span class="feature-text">100% Natural</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon">🏆</span>
                                    <span class="feature-text">Premium Quality</span>
                                </div>
                                <div class="feature-item">
                                    <span class="feature-icon">🇮🇩</span>
                                    <span class="feature-text">Made in Indonesia</span>
                                </div>
                            </div>
                            
                            <div class="product-footer">
                                <div class="price-section">
                                    <div class="current-price">Rp {{ number_format($madu->harga, 0, ',', '.') }}</div>
                                    <div class="price-per-unit">per botol</div>
                                </div>
                                
                                <div class="stock-info">
                                    @if($madu->stock > 0)
                                        <div class="stock-available">
                                            <span class="stock-icon">📦</span>
                                            <span class="stock-text">{{ $madu->stok }} tersedia</span>
                                        </div>
                                    @else
                                        <div class="stock-unavailable">
                                            <span class="stock-icon">❌</span>
                                            <span class="stock-text">Stock habis</span>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="product-actions">
                                <button class="action-btn primary-btn" data-bs-toggle="modal" data-bs-target="#productModal" data-product="{{ $madu->id }}">
                                    <span class="btn-icon">🛒</span>
                                    <span class="btn-text">Order Now</span>
                                </button>
                                <button class="action-btn secondary-btn wishlist-btn">
                                    <span class="btn-icon">❤️</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            @if($madus->isEmpty())
                <div class="empty-state">
                    <div class="empty-icon">🍯</div>
                    <h3 class="empty-title">Belum ada produk madu</h3>
                    <p class="empty-description">Produk madu premium akan segera tersedia untuk Anda</p>
                </div>
            @endif
        </div>
    </div>

    <!-- Enhanced Product Modal -->
    <div class="modal fade custom-modal" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                   <h5 class="modal-title" id="productModalLabel">
                    <span class="modal-icon">🍯</span>
                    {{ $madu->nama_madu }}
                </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row g-4">
                        <div class="col-lg-6">
                            <div class="modal-image-container">
                                <img src="" alt="" class="modal-image">
                                <div class="image-overlay">
                                    <div class="zoom-indicator">🔍</div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="modal-product-details">
                                <div class="modal-product-header">
                                    <h2 class="modal-product-name"></h2>
                                    <div class="modal-product-rating">
                                        <div class="stars">
                                            <span class="star">⭐</span>
                                            <span class="star">⭐</span>
                                            <span class="star">⭐</span>
                                            <span class="star">⭐</span>
                                            <span class="star">⭐</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-price-section">
                                    <div class="modal-current-price"></div>
                                    <div class="price-benefits">
                                        <span class="benefit-item">💰 Best Price Guarantee</span>
                                    </div>
                                </div>
                                
                                <div class="modal-description">
                                    <h6>📝 Deskripsi Produk</h6>
                                    <p class="description-text"></p>
                                </div>
                                
                                <div class="modal-features">
                                    <h6>✨ Keunggulan Produk</h6>
                                    <div class="features-grid">
                                        <div class="feature-card">
                                            <span class="feature-icon">🌿</span>
                                            <span class="feature-title">100% Natural</span>
                                            <span class="feature-desc">Tanpa bahan kimia</span>
                                        </div>
                                        <div class="feature-card">
                                            <span class="feature-icon">🏆</span>
                                            <span class="feature-title">Premium Quality</span>
                                            <span class="feature-desc">Kualitas terjamin</span>
                                        </div>
                                        <div class="feature-card">
                                            <span class="feature-icon">🔬</span>
                                            <span class="feature-title">Lab Tested</span>
                                            <span class="feature-desc">Teruji laboratorium</span>
                                        </div>
                                        <div class="feature-card">
                                            <span class="feature-icon">📦</span>
                                            <span class="feature-title">Fresh Packaging</span>
                                            <span class="feature-desc">Kemasan higienis</span>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="modal-availability">
                                    <div class="availability-info">
                                        <span class="availability-label">📊 Ketersediaan:</span>
                                        <span class="availability-status"></span>
                                    </div>
                                </div>
                                
                                <div class="modal-actions">
                                    @auth
                                        <a href="{{ route('madu.order', $madu->id) }}" class="enhanced-btn primary-btn">
                                            <span class="btn-icon">🛒</span>
                                            <span class="btn-text">Order Sekarang</span>
                                            <div class="btn-shine"></div>
                                        </a>
                                    @else
                                        <a href="{{ route('login') }}" class="enhanced-btn primary-btn">
                                            <span class="btn-icon">🔐</span>
                                            <span class="btn-text">Login untuk Order</span>
                                            <div class="btn-shine"></div>
                                        </a>
                                    @endauth
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
       
        /* === 1. HERO SECTION === */
        .hero-section {
            position: relative;
            background: linear-gradient(to right, rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.3)),
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
            padding-left: 295px;
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
        /* ===== PRODUCTS TITLE CARD ===== */
        .products-title-card {
            background: linear-gradient(135deg, #fff 0%, #f8f9fa 100%);
            border-radius: 30px;
            padding: 3rem 2rem;
            margin-bottom: 4rem;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(243, 156, 18, 0.1);
            position: relative;
            overflow: hidden;
        }

        .products-title-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(243, 156, 18, 0.05), rgba(230, 126, 34, 0.03));
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .products-title-card:hover::before {
            opacity: 1;
        }

        .title-card-inner {
            display: flex;
            align-items: center;
            gap: 2rem;
            position: relative;
            z-index: 2;
        }

        .title-card-icon {
            position: relative;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .honey-drop {
            font-size: 4rem;
            animation: honeyFloat 3s ease-in-out infinite;
            filter: drop-shadow(0 10px 20px rgba(243, 156, 18, 0.3));
        }

        @keyframes honeyFloat {
            0%, 100% { transform: translateY(0px) rotate(0deg); }
            50% { transform: translateY(-15px) rotate(5deg); }
        }

        .sparkles {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
        }

        .sparkle {
            position: absolute;
            font-size: 1.5rem;
            animation: sparkleFloat 2s ease-in-out infinite;
        }

        .sparkle:nth-child(1) {
            top: -10px;
            right: -10px;
            animation-delay: 0s;
        }

        .sparkle:nth-child(2) {
            bottom: -10px;
            left: -10px;
            animation-delay: 0.7s;
        }

        .sparkle:nth-child(3) {
            top: 50%;
            right: -20px;
            animation-delay: 1.4s;
        }

        @keyframes sparkleFloat {
            0%, 100% { 
                opacity: 0.3;
                transform: scale(0.8) rotate(0deg);
            }
            50% { 
                opacity: 1;
                transform: scale(1.2) rotate(180deg);
            }
        }

        .title-card-content {
            flex: 1;
        }

        .products-main-title {
            font-size: 3.5rem;
            font-weight: 900;
            color: #2c3e50;
            margin-bottom: 1rem;
            background: linear-gradient(135deg, #f39c12, #e67e22, #d35400);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
        }

        .title-underline {
            width: 120px;
            height: 6px;
            background: linear-gradient(135deg, #f39c12, #e67e22);
            border-radius: 3px;
            margin-bottom: 1.5rem;
            animation: underlineGrow 1s ease-out;
        }

        @keyframes underlineGrow {
            from { width: 0; opacity: 0; }
            to { width: 120px; opacity: 1; }
        }

        .products-subtitle {
            font-size: 1.2rem;
            color: #7f8c8d;
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .products-stats {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .stat-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .stat-number {
            font-size: 2rem;
            font-weight: 800;
            color: #f39c12;
            display: block;
            margin-bottom: 0.5rem;
        }

        .stat-label {
            font-size: 0.9rem;
            color: #95a5a6;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }

        .stat-divider {
            width: 2px;
            height: 40px;
            background: linear-gradient(to bottom, transparent, #e67e22, transparent);
        }

        /* ===== ENHANCED PRODUCTS GRID ===== */
       .products-section {
    margin-top: 2rem;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr)); /* dari 380px jadi 260px */
    gap: 1.5rem; /* dari 2.5rem dikurangi agar lebih rapat */
    margin-top: 2rem;
}

.product-card-wrapper {
    opacity: 0;
    transform: translateY(50px);
    animation: cardEntrance 0.8s ease-out forwards;
}

@keyframes cardEntrance {
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.enhanced-product-card {
    background: #fff;
    border-radius: 16px; /* lebih kecil dari 25px */
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.06); /* bayangan lebih ringan */
    transition: all 0.4s ease;
    border: 1.5px solid transparent;
    position: relative;
    height: 100%;
    display: flex;
    flex-direction: column;
}

.enhanced-product-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, rgba(243, 156, 18, 0.05), rgba(230, 126, 34, 0.03));
    opacity: 0;
    transition: opacity 0.4s ease;
    border-radius: 16px;
    z-index: 1;
}

.enhanced-product-card:hover::before {
    opacity: 1;
}

.enhanced-product-card:hover {
    transform: translateY(-12px) scale(1.015);
    box-shadow: 0 20px 50px rgba(243, 156, 18, 0.15);
    border-color: rgba(243, 156, 18, 0.25);
}


        /* ===== PRODUCT IMAGE CONTAINER ===== */
        .product-image-container {
            position: relative;
            height: 280px;
            overflow: hidden;
            border-radius: 25px 25px 0 0;
        }

        .product-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .enhanced-product-card:hover .product-image {
            transform: scale(1.1);
        }

        .product-placeholder {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            color: #6c757d;
        }

        .placeholder-icon {
            font-size: 3rem;
            margin-bottom: 1rem;
            animation: placeholderPulse 2s ease-in-out infinite;
        }

        @keyframes placeholderPulse {
            0%, 100% { opacity: 0.5; transform: scale(1); }
            50% { opacity: 1; transform: scale(1.1); }
        }

        .placeholder-text {
            font-size: 1.1rem;
            font-weight: 600;
        }


        .overlay-content {
            text-align: center;
            transform: translateY(30px);
            transition: transform 0.4s ease;
        }

        .enhanced-product-card:hover .overlay-content {
            transform: translateY(0);
        }

        .view-details-btn {
            background: rgba(255, 255, 255, 0.95);
            border: none;
            border-radius: 50px;
            padding: 1rem 2rem;
            color: #f39c12;
            font-weight: 700;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .view-details-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(243, 156, 18, 0.3), transparent);
            transition: left 0.6s;
        }

        .view-details-btn:hover::before {
            left: 100%;
        }

        .view-details-btn:hover {
            transform: scale(1.05);
            box-shadow: 0 10px 30px rgba(243, 156, 18, 0.4);
        }

        .btn-icon {
            font-size: 1.2rem;
        }

        .btn-text {
            font-weight: 700;
        }

        /* ===== STOCK BADGES ===== */
        .stock-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            color: white;
            display: flex;
            align-items: center;
            gap: 0.3rem;
            z-index: 3;
            backdrop-filter: blur(10px);
        }

        .stock-badge.available {
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            animation: availablePulse 2s ease-in-out infinite;
        }

        .stock-badge.limited {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            animation: limitedPulse 1.5s ease-in-out infinite;
        }

        .stock-badge.sold-out {
            background: linear-gradient(135deg, #e74c3c, #c0392b);
            animation: soldOutShake 3s ease-in-out infinite;
        }

        @keyframes availablePulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.05); }
        }

        @keyframes limitedPulse {
            0%, 100% { transform: scale(1); box-shadow: 0 0 0 0 rgba(243, 156, 18, 0.7); }
            50% { transform: scale(1.1); box-shadow: 0 0 0 10px rgba(243, 156, 18, 0); }
        }

        @keyframes soldOutShake {
            0%, 100% { transform: translateX(0); }
            10%, 30%, 50%, 70%, 90% { transform: translateX(-2px); }
            20%, 40%, 60%, 80% { transform: translateX(2px); }
        }

        /* ===== ENHANCED PRODUCT INFO ===== */
        .product-info {
            padding: 2rem;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            position: relative;
            z-index: 2;
        }

        .product-header {
            margin-bottom: 1.5rem;
        }

        .product-name {
            font-size: 1.8rem;
            font-weight: 800;
            color: #2c3e50;
            margin-bottom: 0.8rem;
            line-height: 1.3;
            transition: color 0.3s ease;
        }

        .enhanced-product-card:hover .product-name {
            color: #f39c12;
        }

        
        .product-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stars {
            display: flex;
            gap: 0.2rem;
        }

        .star {
            font-size: 1rem;
            transition: transform 0.2s ease;
        }

        }

        @keyframes starTwinkle {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        .rating-text {
            font-size: 0.9rem;
            color: #7f8c8d;
            font-weight: 600;
        }

        .product-description {
            margin-bottom: 1.5rem;
        }

        .product-description p {
            color: #7f8c8d;
            line-height: 1.6;
            font-size: 1rem;
        }

        /* ===== PRODUCT FEATURES ===== */
        .product-features {
            display: flex;
            flex-wrap: wrap;
            gap: 0.8rem;
            margin-bottom: 1.5rem;
        }

        .feature-item {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            background: rgba(243, 156, 18, 0.1);
            padding: 0.4rem 0.8rem;
            border-radius: 15px;
            font-size: 0.85rem;
            font-weight: 600;
            color: #f39c12;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            background: rgba(243, 156, 18, 0.2);
            transform: translateY(-2px);
        }

        .feature-icon {
            font-size: 1rem;
        }

        /* ===== PRODUCT FOOTER ===== */
        .product-footer {
            margin-bottom: 1.5rem;
            padding-top: 1rem;
            border-top: 2px solid #f8f9fa;
        }

        .price-section {
            margin-bottom: 1rem;
        }

        .current-price {
            font-size: 2rem;
            font-weight: 900;
            background: linear-gradient(135deg, #f39c12, #e67e22, #d35400);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            display: block;
            margin-bottom: 0.3rem;
        }

        .price-per-unit {
            font-size: 0.9rem;
            color: #95a5a6;
            font-weight: 500;
        }

        .stock-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stock-available {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #27ae60;
            font-weight: 600;
            font-size: 0.9rem;
        }

        .stock-unavailable {
            display: flex;
            align-items: center;
            gap: 0.4rem;
            color: #e74c3c;
            font-weight: 600;
            font-size: 0.9rem;
        }

        /* ===== PRODUCT ACTIONS ===== */
        .product-actions {
            display: flex;
            gap: 1rem;
            margin-top: auto;
        }

        .action-btn {
            border: none;
            border-radius: 15px;
            padding: 1rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            position: relative;
            overflow: hidden;
        }

        .primary-btn {
            flex: 1;
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            font-size: 1rem;
        }

        .primary-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.6s;
        }

        .primary-btn:hover::before {
            left: 100%;
        }

        .primary-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 35px rgba(243, 156, 18, 0.4);
        }

        .secondary-btn {
            width: 60px;
            background: rgba(243, 156, 18, 0.1);
            color: #f39c12;
            border: 2px solid rgba(243, 156, 18, 0.3);
        }

        .secondary-btn:hover {
            background: #f39c12;
            color: white;
            transform: scale(1.1);
        }

        /* ===== EMPTY STATE ===== */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: linear-gradient(135deg, #f8f9fa, #e9ecef);
            border-radius: 25px;
            margin: 2rem 0;
        }

        .empty-icon {
            font-size: 5rem;
            margin-bottom: 2rem;
            animation: emptyFloat 3s ease-in-out infinite;
        }

        @keyframes emptyFloat {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        .empty-title {
            font-size: 2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
        }

        .empty-description {
            font-size: 1.1rem;
            color: #7f8c8d;
            max-width: 400px;
            margin: 0 auto;
        }

        /* ===== ENHANCED MODAL STYLES ===== */
        .custom-modal .modal-content {
            border: none;
            border-radius: 25px;
            box-shadow: 0 50px 100px rgba(0, 0, 0, 0.2);
            overflow: hidden;
        }

        .custom-modal .modal-header {
            background: linear-gradient(135deg, #f39c12, #e67e22);
            color: white;
            border: none;
            padding: 2rem;
            position: relative;
        }

        .custom-modal .modal-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="honeycomb" patternUnits="userSpaceOnUse" width="20" height="20"><polygon fill="rgba(255,255,255,0.1)" points="10,0 20,5.77 20,14.23 10,20 0,14.23 0,5.77"/></pattern></defs><rect width="100" height="100" fill="url(%23honeycomb)"/></svg>');
            opacity: 0.3;
        }

        .modal-title {
            font-weight: 800;
            font-size: 1.5rem;
            position: relative;
            z-index: 1;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .modal-icon {
            font-size: 1.8rem;
        }

        .btn-close {
            filter: brightness(0) invert(1);
            opacity: 0.8;
            transition: all 0.3s ease;
            position: relative;
            z-index: 1;
        }

        .btn-close:hover {
            opacity: 1;
            transform: scale(1.2) rotate(90deg);
        }

        .custom-modal .modal-body {
            padding: 2.5rem;
            background: linear-gradient(135deg, #ffffff, #f8f9fa);
        }

        /* ===== MODAL IMAGE CONTAINER ===== */
        .modal-image-container {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
        }

        .modal-image {
            width: 100%;
            height: auto;
            max-height: 500px;
            object-fit: cover;
            transition: transform 0.5s ease;
        }

        .modal-image-container:hover .modal-image {
            transform: scale(1.05);
        }

        .image-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .modal-image-container:hover .image-overlay {
            opacity: 1;
        }

        .zoom-indicator {
            font-size: 2rem;
            color: white;
            animation: zoomPulse 2s ease-in-out infinite;
        }

        @keyframes zoomPulse {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.2); }
        }

        /* ===== MODAL PRODUCT DETAILS ===== */
        .modal-product-details {
            padding: 1rem 0;
        }

        .modal-product-header {
            margin-bottom: 2rem;
        }

        .modal-product-name {
            font-size: 2.5rem;
            font-weight: 900;
            color: #2c3e50;
            margin-bottom: 1rem;
            line-height: 1.2;
        }

        .modal-product-rating {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .rating-count {
            color: #7f8c8d;
            font-size: 0.9rem;
        }

        .modal-price-section {
            margin-bottom: 2rem;
            padding: 1.5rem;
            background: rgba(243, 156, 18, 0.05);
            border-radius: 15px;
            border: 2px solid rgba(243, 156, 18, 0.1);
        }

        .modal-current-price {
            font-size: 2.8rem;
            font-weight: 900;
            background: linear-gradient(135deg, #f39c12, #e67e22, #d35400);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 1rem;
        }

        .price-benefits {
            display: flex;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .benefit-item {
            display: flex;
            align-items: center;
            gap: 0.3rem;
            font-size: 0.9rem;
            color: #27ae60;
            font-weight: 600;
        }

        .modal-description {
            margin-bottom: 2rem;
        }

        .modal-description h6 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .description-text {
            color: #7f8c8d;
            line-height: 1.7;
            font-size: 1.1rem;
        }

        /* ===== MODAL FEATURES GRID ===== */
        .modal-features {
            margin-bottom: 2rem;
        }

        .modal-features h6 {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
        }

        .feature-card {
            background: white;
            padding: 1.0rem;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border: 2px solid rgba(243, 156, 18, 0.1);
        }

        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(243, 156, 18, 0.2);
            border-color: rgba(243, 156, 18, 0.3);
        }

        .feature-card .feature-icon {
            font-size: 2rem;
            margin-bottom: 0.8rem;
            display: block;
        }

        .feature-title {
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 0.5rem;
            display: block;
            font-size: 1rem;
        }

        .feature-desc {
            font-size: 0.85rem;
            color: #7f8c8d;
            display: block;
        }

        /* ===== MODAL AVAILABILITY ===== */
        .modal-availability {
            margin-bottom: 2rem;
            padding: 1rem 1.5rem;
            background: rgba(39, 174, 96, 0.1);
            border-radius: 15px;
            border-left: 4px solid #27ae60;
        }

        .availability-info {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .availability-label {
            font-weight: 700;
            color: #2c3e50;
        }

        .availability-status {
            font-weight: 600;
            color: #27ae60;
        }
/* ===== ENHANCED MODAL BUTTONS ===== */
.modal-actions {
    display: flex;
    gap: 1rem;
    margin-top: 1.5rem;
}

.enhanced-btn {
    position: relative;
    display: inline-block;
    padding: 0.75rem 1.5rem;
    font-weight: 600;
    border-radius: 12px;
    text-align: center;
    cursor: pointer;
    overflow: hidden;
    text-decoration: none;
    transition: all 0.3s ease;
}

.enhanced-btn .btn-shine {
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255,255,255,0.5), transparent);
    transition: left 0.8s ease;
    z-index: 1;
}

.enhanced-btn:hover .btn-shine {
    left: 100%;
}

.enhanced-btn.primary-btn {
    flex: 2;
    background: linear-gradient(135deg, #f39c12, #e67e22);
    color: white;
    border: none;
    box-shadow: 0 6px 12px rgba(230, 126, 34, 0.3);
    z-index: 0;
}

.enhanced-btn.primary-btn:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(243, 156, 18, 0.5);
}

.enhanced-btn.secondary-btn {
    flex: 1;
    background: white;
    color: #e67e22;
    border: 2px solid #e67e22;
    z-index: 0;
}

.enhanced-btn.secondary-btn:hover {
    background: #e67e22;
    color: white;
    transform: translateY(-3px);
    box-shadow: 0 8px 18px rgba(243, 156, 18, 0.4);
}

        /* ===== RESPONSIVE DESIGN ===== */
        @media (max-width: 1200px) {
            .hero-title {
                font-size: 60px;
                letter-spacing: 20px;
            }
            
            .hero-content {
                padding-left: 200px;
            }
            
            .products-main-title {
                font-size: 3rem;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
                gap: 2rem;
            }
        }

        @media (max-width: 992px) {
            .hero-title {
                font-size: 50px;
                letter-spacing: 15px;
            }
            
            .hero-content {
                padding-left: 100px;
            }
            
            .title-card-inner {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }
            
            .products-main-title {
                font-size: 2.5rem;
            }
            
            .products-stats {
                justify-content: center;
            }
            
            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
                gap: 1.5rem;
            }
            
            .product-image-container {
                height: 250px;
            }
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 40px;
                letter-spacing: 10px;
            }
            
            .hero-content {
                padding-left: 50px;
                text-align: center;
            }
            
            .products-title-card {
                padding: 2rem 1.5rem;
                margin-bottom: 3rem;
            }
            
            .products-main-title {
                font-size: 2rem;
            }
            
            .products-stats {
                flex-direction: column;
                gap: 1rem;
            }
            
            .stat-divider {
                width: 40px;
                height: 2px;
            }
            
            .products-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
            
            .product-info {
                padding: 1.5rem;
            }
            
            .product-name {
                font-size: 1.5rem;
            }
            
            .current-price {
                font-size: 1.8rem;
            }
            
            .modal-product-name {
                font-size: 2rem;
            }
            
            .modal-current-price {
                font-size: 2.2rem;
            }
            
            .features-grid {
                grid-template-columns: 1fr;
            }
            
            .modal-actions {
                flex-direction: column;
            }
        }

        @media (max-width: 576px) {
            .hero-title {
                font-size: 30px;
                letter-spacing: 5px;
            }
            
            .hero-desc {
                font-size: 14px;
            }
            
            .products-title-card {
                padding: 1.5rem 1rem;
            }
            
            .products-main-title {
                font-size: 1.8rem;
            }
            
            .honey-drop {
                font-size: 3rem;
            }
            
            .product-image-container {
                height: 220px;
            }
            
            .product-info {
                padding: 1.2rem;
            }
            
            .product-features {
                gap: 0.5rem;
            }
            
            .feature-item {
                font-size: 0.8rem;
                padding: 0.3rem 0.6rem;
            }
        }

        /* ===== LOADING ANIMATIONS ===== */
        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { 
                transform: rotate(360deg); 
            }
        }

        /* ===== ADDITIONAL ANIMATIONS ===== */
        @keyframes shimmer {
            0% { background-position: -200% 0; }
            100% { background-position: 200% 0; }
        }

        @keyframes modalSlideIn {
            from {
                opacity: 0;
                transform: scale(0.7) translateY(-50px);
            }
            to {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
        }

        @keyframes modalSlideOut {
            from {
                opacity: 1;
                transform: scale(1) translateY(0);
            }
            to {
                opacity: 0;
                transform: scale(0.7) translateY(-50px);
            }
        }

        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }

        .ripple-effect {
            position: absolute;
            border-radius: 50%;
            background: rgba(243, 156, 18, 0.4);
            transform: scale(0);
            animation: ripple 0.8s linear;
            pointer-events: none;
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // ===== INITIALIZE VARIABLES =====
            const madus = @json($madus);
            const productModal = document.getElementById('productModal');
            const productCards = document.querySelectorAll('.enhanced-product-card');
            
            // ===== AOS INITIALIZATION =====
            if (typeof AOS !== 'undefined') {
                AOS.init({
                    duration: 800,
                    easing: 'ease-out-cubic',
                    once: true,
                    offset: 100
                });
            }

            // ===== ENHANCED PRODUCT CARD INTERACTIONS =====
            productCards.forEach((card, index) => {
                // Staggered entrance animation
                card.style.animationDelay = `${index * 0.1}s`;
                
                // Enhanced hover effects
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-20px) scale(1.02)';
                    this.style.boxShadow = '0 30px 80px rgba(243, 156, 18, 0.2)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = '';
                    this.style.boxShadow = '';
                });

                // Ripple effect on click
                card.addEventListener('click', function(e) {
                    if (!e.target.closest('button')) {
                        createRipple(this, e);
                    }
                });
            });

            // ===== MODAL FUNCTIONALITY =====
            if (productModal) {
                productModal.addEventListener('show.bs.modal', function(e) {
                    const button = e.relatedTarget;
                    const productId = button.getAttribute('data-product');
                    const product = madus.find(m => m.id == productId);
                    
                    if (product) {
                        updateModalContent(this, product);
                        
                        // Add entrance animation
                        const modalDialog = this.querySelector('.modal-dialog');
                        modalDialog.style.animation = 'modalSlideIn 0.6s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                    }
                });

                productModal.addEventListener('hide.bs.modal', function() {
                    const modalDialog = this.querySelector('.modal-dialog');
                    modalDialog.style.animation = 'modalSlideOut 0.4s ease-in-out';
                });

                // Order button functionality
                const orderBtn = productModal.querySelector('#orderNowBtn');
                if (orderBtn) {
                    orderBtn.addEventListener('click', function() {
                        // Add loading state
                        const originalText = this.innerHTML;
                        this.innerHTML = '<span class="loading-spinner"></span> Processing...';
                        this.disabled = true;
                        
                        // Simulate order process
                        setTimeout(() => {
                            this.innerHTML = originalText;
                            this.disabled = false;
                            showNotification('Order berhasil! Kami akan menghubungi Anda segera.', 'success');
                            
                            // Close modal after delay
                            setTimeout(() => {
                                const modalInstance = bootstrap.Modal.getInstance(productModal);
                                if (modalInstance) modalInstance.hide();
                            }, 1500);
                        }, 2000);
                    });
                }

                // Wishlist functionality
                const wishlistBtns = document.querySelectorAll('.wishlist-btn, #addToWishlistBtn');
                wishlistBtns.forEach(btn => {
                    btn.addEventListener('click', function() {
                        const icon = this.querySelector('.btn-icon');
                        const isActive = icon.textContent === '💖';
                        
                        if (isActive) {
                            icon.textContent = '❤️';
                            showNotification('Dihapus dari wishlist', 'info');
                        } else {
                            icon.textContent = '💖';
                            createHeartBurst(this);
                            showNotification('Ditambahkan ke wishlist!', 'success');
                        }
                        
                        // Add bounce animation
                        this.style.animation = 'bounce 0.6s ease';
                        setTimeout(() => {
                            this.style.animation = '';
                        }, 600);
                    });
                });
            }

            // ===== SMOOTH SCROLLING =====
            const heroBtn = document.querySelector('.hero-btn');
            if (heroBtn) {
                heroBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector('#products');
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

            // ===== INTERSECTION OBSERVER FOR ANIMATIONS =====
            const observerOptions = {
                threshold: 0.1,
                rootMargin: '0px 0px -50px 0px'
            };

            const observer = new IntersectionObserver((entries) => {
                entries.forEach(entry => {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('animate-in');
                        
                        // Add staggered animation for product cards
                        if (entry.target.classList.contains('product-card-wrapper')) {
                            const delay = Array.from(document.querySelectorAll('.product-card-wrapper')).indexOf(entry.target) * 100;
                            entry.target.style.animationDelay = delay + 'ms';
                        }
                    }
                });
            }, observerOptions);

            // Observe all animated elements
            document.querySelectorAll('.product-card-wrapper, .products-title-card').forEach(item => {
                observer.observe(item);
            });

            // ===== UTILITY FUNCTIONS =====
            function updateModalContent(modal, product) {
                modal.querySelector('.modal-product-name').textContent = product.nama;
                
                const modalImg = modal.querySelector('.modal-image');
                if (product.gambar) {
                    modalImg.src = `/storage/${product.gambar}`;
                    modalImg.alt = product.nama;
                } else {
                    modalImg.src = '/images/placeholder-madu.jpg';
                    modalImg.alt = 'No image available';
                }
                
                modal.querySelector('.description-text').textContent = product.deskripsi || 'Tidak ada deskripsi tersedia.';
                modal.querySelector('.modal-current-price').textContent = `Rp ${new Intl.NumberFormat('id-ID').format(product.harga)}`;
                
                const availabilityStatus = modal.querySelector('.availability-status');
                if (product.stock > 0) {
                    availabilityStatus.innerHTML = `<span style="color: #27ae60;">✅ ${product.stock} unit tersedia</span>`;
                } else {
                    availabilityStatus.innerHTML = '<span style="color: #e74c3c;">❌ Stok habis</span>';
                }
            }

            function createRipple(element, event) {
                const rect = element.getBoundingClientRect();
                const size = Math.max(rect.width, rect.height);
                const x = event.clientX - rect.left - size / 2;
                const y = event.clientY - rect.top - size / 2;
                
                const ripple = document.createElement('div');
                ripple.className = 'ripple-effect';
                ripple.style.width = ripple.style.height = size + 'px';
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                element.style.position = 'relative';
                element.style.overflow = 'hidden';
                element.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.remove();
                }, 800);
            }

            function createHeartBurst(element) {
                const rect = element.getBoundingClientRect();
                const centerX = rect.left + rect.width / 2;
                const centerY = rect.top + rect.height / 2;
                
                for (let i = 0; i < 6; i++) {
                    const heart = document.createElement('div');
                    heart.style.cssText = `
                        position: fixed;
                        left: ${centerX}px;
                        top: ${centerY}px;
                        font-size: 1.5rem;
                        color: #e74c3c;
                        pointer-events: none;
                        z-index: 10000;
                        animation: heartBurst 1.2s ease-out forwards;
                        animation-delay: ${i * 0.1}s;
                    `;
                    heart.textContent = '💖';
                    
                    const angle = (i * 60) * Math.PI / 180;
                    const distance = 80;
                    heart.style.setProperty('--end-x', Math.cos(angle) * distance + 'px');
                    heart.style.setProperty('--end-y', Math.sin(angle) * distance + 'px');
                    
                    document.body.appendChild(heart);
                    
                    setTimeout(() => {
                        heart.remove();
                    }, 1200);
                }
            }

            function showNotification(message, type = 'info') {
                // Create notification container if it doesn't exist
                let container = document.querySelector('.notification-container');
                if (!container) {
                    container = document.createElement('div');
                    container.className = 'notification-container';
                    container.style.cssText = `
                        position: fixed;
                        top: 20px;
                        right: 20px;
                        z-index: 10000;
                        max-width: 400px;
                    `;
                    document.body.appendChild(container);
                }

                const notification = document.createElement('div');
                notification.className = `notification ${type}`;
                
                const icons = {
                    success: '✅',
                    error: '❌',
                    info: 'ℹ️',
                    warning: '⚠️'
                };

                notification.innerHTML = `
                    <div class="notification-content">
                        <span class="notification-icon">${icons[type] || icons.info}</span>
                        <span class="notification-message">${message}</span>
                        <button class="notification-close">×</button>
                    </div>
                `;

                notification.style.cssText = `
                    background: white;
                    border-radius: 15px;
                    padding: 1rem 1.5rem;
                    margin-bottom: 1rem;
                    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
                    border-left: 4px solid ${type === 'success' ? '#27ae60' : type === 'error' ? '#e74c3c' : type === 'warning' ? '#f39c12' : '#3498db'};
                    transform: translateX(120%);
                    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
                    backdrop-filter: blur(10px);
                `;

                const content = notification.querySelector('.notification-content');
                content.style.cssText = `
                    display: flex;
                    align-items: center;
                    gap: 0.8rem;
                `;

                const icon = notification.querySelector('.notification-icon');
                icon.style.cssText = `
                    font-size: 1.2rem;
                `;

                const messageEl = notification.querySelector('.notification-message');
                messageEl.style.cssText = `
                    flex: 1;
                    font-weight: 600;
                    color: #2c3e50;
                `;

                const closeBtn = notification.querySelector('.notification-close');
                closeBtn.style.cssText = `
                    background: none;
                    border: none;
                    font-size: 1.5rem;
                    color: #95a5a6;
                    cursor: pointer;
                    padding: 0;
                    width: 24px;
                    height: 24px;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border-radius: 50%;
                    transition: all 0.3s ease;
                `;

                closeBtn.addEventListener('mouseenter', function() {
                    this.style.background = '#ecf0f1';
                    this.style.color = '#2c3e50';
                });

                closeBtn.addEventListener('mouseleave', function() {
                    this.style.background = 'none';
                    this.style.color = '#95a5a6';
                });

                container.appendChild(notification);

                // Show notification
                setTimeout(() => {
                    notification.style.transform = 'translateX(0)';
                }, 100);

                // Auto hide after 4 seconds
                const autoHideTimeout = setTimeout(() => {
                    hideNotification(notification);
                }, 4000);

                // Close button functionality
                closeBtn.addEventListener('click', () => {
                    clearTimeout(autoHideTimeout);
                    hideNotification(notification);
                });

                function hideNotification(notif) {
                    notif.style.transform = 'translateX(120%)';
                    setTimeout(() => {
                        if (notif.parentNode) {
                            notif.remove();
                        }
                    }, 500);
                }
            }

            // ===== FLOATING PARTICLES ANIMATION =====
            function createFloatingParticles() {
                const heroSection = document.querySelector('.hero-section');
                if (!heroSection) return;

                setInterval(() => {
                    if (document.querySelectorAll('.floating-particle').length < 8) {
                        const particle = document.createElement('div');
                        particle.className = 'floating-particle';
                        particle.style.cssText = `
                            position: absolute;
                            width: ${Math.random() * 8 + 4}px;
                            height: ${Math.random() * 8 + 4}px;
                            background: rgba(243, 156, 18, ${Math.random() * 0.6 + 0.2});
                            border-radius: 50%;
                            left: ${Math.random() * 100}%;
                            bottom: -10px;
                            animation: floatUp ${Math.random() * 6 + 6}s linear infinite;
                            pointer-events: none;
                            z-index: 1;
                        `;

                        heroSection.appendChild(particle);

                        setTimeout(() => {
                            if (particle.parentNode) {
                                particle.remove();
                            }
                        }, 12000);
                    }
                }, 1500);
            }

            // ===== PERFORMANCE OPTIMIZATIONS =====
let ticking = false;

window.addEventListener('scroll', () => {
    if (!ticking) {
        window.requestAnimationFrame(() => {
            const heroSection = document.querySelector('.hero-section');
            if (heroSection) {
                const scrolled = window.pageYOffset;
                const parallax = scrolled * 0.3;
                heroSection.style.transform = `translateY(${parallax}px)`;
            }
            ticking = false;
        });
        ticking = true;
    }
});

            // ===== KEYBOARD NAVIGATION =====
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    const openModal = document.querySelector('.modal.show');
                    if (openModal) {
                        const modalInstance = bootstrap.Modal.getInstance(openModal);
                        if (modalInstance) modalInstance.hide();
                    }
                }
            });

        
            // ===== INITIALIZE EVERYTHING =====
            function initializeApp() {
                try {
                    createFloatingParticles();
                    
                    // Add entrance animations
                    const animatedElements = document.querySelectorAll('.products-title-card, .product-card-wrapper');
                    animatedElements.forEach((el, index) => {
                        el.style.opacity = '0';
                        el.style.transform = 'translateY(30px)';
                        
                        setTimeout(() => {
                            el.style.transition = 'all 0.8s cubic-bezier(0.175, 0.885, 0.32, 1.275)';
                            el.style.opacity = '1';
                            el.style.transform = 'translateY(0)';
                        }, index * 100);
                    });

                    console.log('🍯 Madu Store initialized successfully!');
                    
                } catch (error) {
                    console.error('Initialization error:', error);
                    showNotification('Gagal memuat halaman. Silakan refresh.', 'error');
                }
            }

            // Start the app
            initializeApp();

        }); // End of DOMContentLoaded

        // ===== ADDITIONAL CSS ANIMATIONS =====
        const additionalStyles = document.createElement('style');
        additionalStyles.textContent = `
            @keyframes floatUp {
                0% {
                    transform: translateY(0px) rotate(0deg);
                    opacity: 0;
                }
                10% {
                    opacity: 1;
                }
                90% {
                    opacity: 1;
                }
                100% {
                    transform: translateY(-100vh) rotate(360deg);
                    opacity: 0;
                }
            }

            @keyframes heartBurst {
                0% {
                    transform: scale(0) rotate(0deg);
                    opacity: 1;
                }
                50% {
                    transform: scale(1.2) rotate(180deg);
                    opacity: 0.8;
                }
                100% {
                    transform: scale(0) rotate(360deg) translate(var(--end-x), var(--end-y));
                    opacity: 0;
                }
            }

            @keyframes bounce {
                0%, 20%, 53%, 80%, 100% {
                    transform: translate3d(0, 0, 0);
                }
                40%, 43% {
                    transform: translate3d(0, -15px, 0);
                }
                70% {
                    transform: translate3d(0, -7px, 0);
                }
                90% {
                    transform: translate3d(0, -2px, 0);
                }
            }

            /* Enhanced focus states for accessibility */
            .enhanced-product-card:focus-visible,
            .action-btn:focus-visible,
            .enhanced-btn:focus-visible {
                outline: 3px solid rgba(243, 156, 18, 0.6);
                outline-offset: 4px;
            }

            /* Loading states */
            .loading {
                pointer-events: none;
                opacity: 0.7;
                position: relative;
            }

            .loading::after {
                content: '';
                position: absolute;
                top: 50%;
                left: 50%;
                width: 20px;
                height: 20px;
                margin: -10px 0 0 -10px;
                border: 2px solid #f3f3f3;
                border-top: 2px solid #f39c12;
                border-radius: 50%;
                animation: spin 1s linear infinite;
            }

            /* Print styles */
            @media print {
                .hero-section,
                .product-overlay,
                .stock-badge,
                .notification-container {
                    display: none !important;
                }
                
                .enhanced-product-card {
                    box-shadow: none;
                    border: 2px solid #e2e8f0;
                    break-inside: avoid;
                    margin-bottom: 2rem;
                }
                
                .product-image {
                    filter: grayscale(100%);
                }
            }

            /* High contrast mode */
            @media (prefers-contrast: high) {
                .enhanced-product-card {
                    border: 3px solid #000;
                }
                
                .product-name {
                    color: #000;
                }
                
                .product-description p {
                    color: #333;
                }
            }

            /* Reduced motion */
            @media (prefers-reduced-motion: reduce) {
                *,
                *::before,
                *::after {
                    animation-duration: 0.01ms !important;
                    animation-iteration-count: 1 !important;
                    transition-duration: 0.01ms !important;
                }
                
                .enhanced-product-card:hover {
                    transform: none;
                }
            }
        `;
        document.head.appendChild(additionalStyles);
    </script>

    @include('layouts.footer')
@endsection
