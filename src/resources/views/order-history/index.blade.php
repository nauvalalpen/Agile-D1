@extends('layouts.app')

@section('content')
    {{-- Include AOS (Animate on Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Include Font Awesome --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />

    <!-- 1. HERO SECTION -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">RIWAYAT<br>PESANAN</div>
            <div class="hero-desc">Pantau dan kelola semua pesanan Anda dengan mudah. Lihat status, detail, dan riwayat
                transaksi lengkap.</div>
            <a href="#orders-grid" class="hero-btn">Lihat Pesanan</a>
        </div>
    </section>

    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. MAIN ORDERS SECTION -->
        <div id="orders-grid" class="orders-container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-heading">Riwayat Pesanan Saya</h2>
                <p class="section-subheading">Kelola dan pantau semua aktivitas pesanan Anda dalam satu tempat.</p>
            </div>

            <!-- Order Statistics -->
            <div class="order-stats-section mb-5" data-aos="fade-up" data-aos-delay="100" id="order-stats">
                <div class="row g-4">
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-shopping-cart"></i>
                            </div>
                            <h3 class="stat-number" data-count="{{ $orders->count() }}">0</h3>
                            <p class="stat-label">Total Pesanan</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-clock"></i>
                            </div>
                            <h3 class="stat-number" data-count="{{ $orders->where('status', 'pending')->count() }}">0</h3>
                            <p class="stat-label">Menunggu</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <h3 class="stat-number" data-count="{{ $orders->where('status', 'accepted')->count() }}">0</h3>
                            <p class="stat-label">Diterima</p>
                        </div>
                    </div>
                    <div class="col-md-3 col-6">
                        <div class="stat-card">
                            <div class="stat-icon">
                                <i class="fas fa-times-circle"></i>
                            </div>
                            <h3 class="stat-number" data-count="{{ $orders->where('status', 'rejected')->count() }}">0</h3>
                            <p class="stat-label">Ditolak</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Filter Tabs -->
            <div class="order-tabs-section mb-4" data-aos="fade-up" data-aos-delay="200">
                <div class="custom-tabs">
                    <div class="tab-buttons">
                        <button class="tab-btn {{ $activeTab == 'all' ? 'active' : '' }}" id="tab-btn-navbar"
                            onclick="filterOrders('all')" data-tab="all">
                            <i class="fas fa-list me-2"></i>Semua Pesanan
                        </button>
                        <button class="tab-btn {{ $activeTab == 'tour_guide' ? 'active' : '' }}" id="tab-btn-tourguide"
                            onclick="filterOrders('tour_guide')" data-tab="tour_guide">
                            <i class="fas fa-user-tie me-2"></i>Tour Guide
                        </button>
                        <button class="tab-btn {{ $activeTab == 'honey' ? 'active' : '' }}" id="tab-btn-navbar"
                            onclick="filterOrders('honey')" data-tab="honey">
                            <i class="fas fa-jar me-2"></i>Produk Madu
                        </button>
                    </div>
                </div>
            </div>

            <!-- Success/Error Messages -->
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show custom-alert" role="alert"
                    data-aos="fade-down">
                    <i class="fas fa-check-circle me-2"></i>
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show custom-alert" role="alert"
                    data-aos="fade-down">
                    <i class="fas fa-exclamation-circle me-2"></i>
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Orders Grid -->
            <div class="orders-grid" data-aos="fade-up" data-aos-delay="300">
                @forelse ($orders as $order)
                    <div class="order-card" data-order-type="{{ $order->order_type }}" data-status="{{ $order->status }}">
                        <div class="order-card-header">
                            <div class="order-id">
                                <i class="fas fa-hashtag me-1"></i>
                                <span>{{ $order->id }}</span>
                            </div>
                            <div class="order-type-badge" id="tab-btn-navbar">
                                @if ($order->order_type == 'tour_guide')
                                    <span class="badge badge-tour-guide" id="tab-btn-navbar">
                                        <i class="fas fa-user-tie me-1"></i>Tour Guide
                                    </span>
                                @elseif ($order->order_type == 'honey')
                                    <span class="badge badge-honey">
                                        <i class="fas fa-jar me-1"></i>Madu
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="order-card-body">
                            <h5 class="order-item-name">{{ $order->item_name }}</h5>

                            <div class="order-details">
                                @if ($order->order_type == 'honey' && $order->jumlah)
                                    <div class="detail-item">
                                        <i class="fas fa-cubes text-muted me-2"></i>
                                        <span class="detail-label">Jumlah:</span>
                                        <span class="detail-value">{{ $order->jumlah }}</span>
                                    </div>
                                @endif

                                <div class="detail-item">
                                    <i class="fas fa-calendar-alt text-muted me-2"></i>
                                    <span class="detail-label">Tanggal:</span>
                                    <span class="detail-value">
                                        @if (isset($order->tanggal))
                                            {{ date('d M Y', strtotime($order->tanggal)) }}
                                        @elseif (isset($order->date))
                                            {{ date('d M Y', strtotime($order->date)) }}
                                        @else
                                            -
                                        @endif
                                    </span>
                                </div>

                                <div class="detail-item">
                                    <i class="fas fa-clock text-muted me-2"></i>
                                    <span class="detail-label">Dibuat:</span>
                                    <span class="detail-value">{{ date('d M Y', strtotime($order->created_at)) }}</span>
                                </div>
                            </div>

                            <div class="order-status-section" id="validasi-hasil-pesanan">
                                <div class="status-badge" id="validasi-hasil-pesanan">
                                    @if ($order->status == 'pending')
                                        <span class="status-pending" id="validasi-hasil-pesanan">
                                            <i class="fas fa-clock me-1"></i>Menunggu
                                        </span>
                                    @elseif ($order->status == 'accepted')
                                        <span class="status-accepted" id="validasi-hasil-pesanan">
                                            <i class="fas fa-check-circle me-1"></i>Diterima
                                        </span>
                                    @elseif ($order->status == 'rejected')
                                        <span class="status-rejected" id="validasi-hasil-pesanan">
                                            <i class="fas fa-times-circle me-1"></i>Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="order-card-footer btn btn-custom w-100">
                            <button type="button" class="btn btn-custom w-70" id="tab-btn-lihatDetail"
                                onclick="window.location.href='{{ route('order-history.show', ['id' => $order->id]) }}?type={{ $order->order_type }}'">
                                <i class="fas fa-eye me-2"></i>Lihat Detail
                            </button>
                        </div>
                    </div>
                @empty
                    <div class="empty-state" data-aos="fade-up">
                        <div class="empty-icon">
                            <i class="fas fa-shopping-cart"></i>
                        </div>
                        <h3>Belum Ada Pesanan</h3>
                        <p>Anda belum memiliki riwayat pesanan. Mulai jelajahi produk dan layanan kami!</p>
                        <a href="{{ route('tourguides.index') }}" class="btn btn-dark-custom">
                            <i class="fas fa-plus me-2"></i>Buat Pesanan Pertama
                        </a>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- 3. QUICK ACTIONS SECTION -->
        @if ($orders->count() > 0)
            <div class="quick-actions-section my-5 py-5" data-aos="fade-up">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                        <div class="quick-actions-content">
                            <h3>Butuh Bantuan dengan Pesanan Anda?</h3>
                            <p>
                                Tim customer service kami siap membantu Anda 24/7. Hubungi kami untuk pertanyaan
                                tentang status pesanan, pembatalan, atau informasi lainnya.
                            </p>
                            <div class="action-buttons">
                                <a href="https://wa.me/6283199877326?text=Halloo ... ,saya ingin bertanya terkait pesanan saya"
                                    class="btn btn-custom me-3" id="btn-hubungi-CS">
                                    <i class="fab fa-whatsapp me-2"></i>Hubungi CS
                                </a>
                                <a href="#" class="btn btn-outline" id="btn-FAQ">
                                    <i class="fas fa-question-circle me-2"></i>FAQ
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                        <div class="quick-actions-image">
                            <img src="{{ asset('images/hero.jpg') }}" alt="Customer Support" class="img-fluid rounded">
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    <!-- AOS Script -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });

        // Order data for JavaScript
        const orderData = {!! json_encode(
            $orders->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_type' => $order->order_type,
                    'item_name' => $order->item_name,
                    'status' => $order->status,
                    'jumlah' => $order->jumlah ?? null,
                    'tanggal' => $order->tanggal ?? ($order->date ?? null),
                    'created_at' => \Carbon\Carbon::parse($order->created_at)->format('F j, Y \a\t g:i A'),
                ];
            }),
        ) !!};

        // Filter orders function
        function filterOrders(type) {
            console.log('Filtering orders by type:', type);

            // Update active tab
            document.querySelectorAll('.tab-btn').forEach(function(btn) {
                btn.classList.remove('active');
            });
            document.querySelector('[data-tab="' + type + '"]').classList.add('active');

            // Filter order cards
            const orderCards = document.querySelectorAll('.order-card');
            orderCards.forEach(function(card) {
                if (type === 'all') {
                    card.style.display = 'block';
                    card.classList.add('fade-in');
                } else {
                    if (card.dataset.orderType === type) {
                        card.style.display = 'block';
                        card.classList.add('fade-in');
                    } else {
                        card.style.display = 'none';
                        card.classList.remove('fade-in');
                    }
                }
            });

            // Update URL without page reload
            const url = new URL(window.location);
            url.searchParams.set('tab', type);
            window.history.pushState({}, '', url);
        }

        // Counter animation for stats
        function animateCounters() {
            const counters = document.querySelectorAll('.stat-number');

            counters.forEach(function(counter) {
                const target = parseInt(counter.dataset.count);
                const increment = target / 30;
                let current = 0;

                const timer = setInterval(function() {
                    current += increment;
                    if (current >= target) {
                        counter.textContent = target;
                        clearInterval(timer);
                    } else {
                        counter.textContent = Math.floor(current);
                    }
                }, 50);
            });
        }

        // Document ready
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Order history page loaded with', orderData.length, 'orders');

            // Smooth scrolling for hero button
            const heroBtn = document.querySelector('.hero-btn');
            if (heroBtn) {
                heroBtn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const target = document.querySelector('#orders-grid');
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                });
            }

            // Add hover effects to order cards
            document.querySelectorAll('.order-card').forEach(function(card) {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-5px)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                });
            });

            // Animate counters when stats section is visible
            const statsSection = document.querySelector('.order-stats-section');
            if (statsSection) {
                const observer = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            animateCounters();
                            observer.unobserve(entry.target);
                        }
                    });
                }, {
                    threshold: 0.5
                });

                observer.observe(statsSection);
            }

            // Auto-dismiss alerts after 5 seconds
            setTimeout(function() {
                document.querySelectorAll('.alert').forEach(function(alert) {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                });
            }, 5000);
        });

        // Global error handler
        window.addEventListener('error', function(e) {
            console.error('JavaScript error:', e.error);
        });

        // Make functions globally available
        window.filterOrders = filterOrders;
    </script>

    @include('layouts.footer')
@endsection

@section('styles')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9fa;
        }

        /* === 1. HERO SECTION (MATCHING GALERI PAGE) === */
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
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: 30px;
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

        /* === UTILITY & HEADINGS === */
        .section-heading {
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 2.5rem;
            color: #212529;
        }

        .section-subheading {
            font-size: 1.1rem;
            color: #6c757d;
            max-width: 600px;
            margin: 0 auto;
        }

        /* === 2. MAIN ORDERS SECTION === */
        .orders-container {
            margin-top: -80px;
            position: relative;
            z-index: 2;
            background: #f8f9fa;
            padding: 4rem 2rem;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        /* === ORDER STATISTICS === */
        .order-stats-section {
            background: linear-gradient(135deg, #92c1f0 0%, #0099ff 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            color: white;
        }

        .stat-card {
            text-align: center;
            padding: 1.5rem;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 15px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: white;
        }

        .stat-label {
            /* background: rgba(255, 255, 255, 0.1); */
            font-size: 1rem;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 0;
        }

        /* === ORDER FILTER TABS === */
        .order-tabs-section {
            background: #fff;
            border-radius: 15px;
            padding: 1rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .custom-tabs {
            display: flex;
            justify-content: center;
        }

        .tab-buttons {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
            justify-content: center;
        }

        .tab-btn {
            padding: 12px 24px;
            background: #f8f9fa;
            border: 2px solid #e9ecef;
            border-radius: 25px;
            color: #6c757d;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
        }

        .tab-btn:hover {
            background: #e9ecef;
            color: #495057;
            transform: translateY(-2px);
        }

        .tab-btn.active {
            background: #212529;
            color: white;
            border-color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 37, 41, 0.3);
        }

        /* === CUSTOM ALERTS === */
        .custom-alert {
            border-radius: 15px;
            border: none;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
            color: #155724;
        }

        .alert-danger {
            background: linear-gradient(135deg, #f8d7da 0%, #f5c6cb 100%);
            color: #721c24;
        }

        /* === ORDERS GRID === */
        .orders-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .order-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border: 1px solid #e9ecef;
        }

        .order-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .order-card-header {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            padding: 1rem 1.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #e9ecef;
        }

        .order-id {
            display: flex;
            align-items: center;
            font-weight: 700;
            color: #495057;
            font-size: 1.1rem;
        }

        .order-type-badge .badge {
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            font-size: 0.85rem;
        }

        .badge-tour-guide {
            background: linear-gradient(135deg, #0d6efd, #0056b3);
            color: white;
        }

        .badge-honey {
            background: linear-gradient(135deg, #ffc107, #e0a800);
            color: #000;
        }

        .order-card-body {
            padding: 1.5rem;
        }

        .order-item-name {
            font-weight: 700;
            color: #212529;
            margin-bottom: 1rem;
            font-size: 1.25rem;
        }

        .order-details {
            margin-bottom: 1.5rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            margin-bottom: 0.75rem;
            padding: 0.5rem 0;
        }

        .detail-label {
            font-weight: 600;
            color: #6c757d;
            margin-left: 0.5rem;
            margin-right: 0.5rem;
        }

        .detail-value {
            color: #495057;
            font-weight: 500;
        }

        .order-status-section {
            margin-bottom: 1rem;
        }

        .status-badge {
            display: flex;
            justify-content: center;
        }

        .status-pending {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            color: #856404;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .status-accepted {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .status-rejected {
            background: linear-gradient(135deg, #f8d7da, #f5c6cb);
            color: #721c24;
            padding: 0.5rem 1rem;
            border-radius: 25px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
        }

        .order-card-footer {
            padding: 1rem 1.5rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        /* === UNIFIED BUTTON STYLES === */
        .btn-dark-custom {
            padding: 12px 35px;
            background-color: #212529;
            color: #fff;
            border: 2px solid #212529;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-align: center;
            width: 100%;
        }

        .btn-dark-custom:hover {
            background-color: #fff;
            color: #212529;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        .btn-outline-dark {
            padding: 12px 35px;
            background-color: transparent;
            color: #212529;
            border: 2px solid #212529;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
            display: inline-block;
            font-size: 1rem;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .btn-outline-dark:hover {
            background-color: #212529;
            color: #fff;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(33, 37, 41, 0.3);
        }

        /* === EMPTY STATE === */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            grid-column: 1 / -1;
        }

        .empty-icon {
            width: 100px;
            height: 100px;
            background: linear-gradient(135deg, #e9ecef, #dee2e6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 2rem;
            font-size: 3rem;
            color: #6c757d;
        }

        .empty-state h3 {
            color: #495057;
            margin-bottom: 1rem;
            font-weight: 700;
        }

        .empty-state p {
            color: #6c757d;
            margin-bottom: 2rem;
            max-width: 400px;
            margin-left: auto;
            margin-right: auto;
        }

        /* === 3. QUICK ACTIONS SECTION === */
        .quick-actions-section {
            background-color: #fff;
            border-radius: 20px;
            padding: 3rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
        }

        .quick-actions-content h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
            color: #212529;
        }

        .quick-actions-content p {
            font-size: 1rem;
            line-height: 1.7;
            color: #6c757d;
            margin-bottom: 2rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .quick-actions-image img {
            border-radius: 15px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }

        .quick-actions-image img:hover {
            transform: scale(1.02);
        }

        /* === ANIMATIONS === */
        .fade-in {
            animation: fadeIn 0.5s ease-in-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 768px) {
            .hero-title {
                font-size: 3rem;
                letter-spacing: 0.2rem;
            }

            .hero-content {
                padding-left: 30px;
                padding-right: 30px;
            }

            .orders-container {
                margin-top: -40px;
                padding: 2rem 1rem;
            }

            .orders-grid {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }

            .order-stats-section {
                padding: 2rem 1rem;
            }

            .stat-number {
                font-size: 2rem;
            }

            .stat-card {
                padding: 1rem;
            }

            .quick-actions-section {
                padding: 2rem;
            }

            .quick-actions-content h3 {
                font-size: 1.5rem;
            }

            .section-heading {
                font-size: 2rem;
            }

            .btn-dark-custom,
            .btn-outline-dark {
                padding: 10px 25px;
                font-size: 0.9rem;
            }

            .tab-buttons {
                flex-direction: column;
                align-items: center;
            }

            .tab-btn {
                width: 100%;
                max-width: 250px;
                justify-content: center;
            }

            .action-buttons {
                flex-direction: column;
            }

            .action-buttons .btn {
                width: 100%;
            }
        }

        @media (max-width: 576px) {
            .hero-section {
                height: 70vh;
                min-height: 400px;
            }

            .hero-title {
                font-size: 2.5rem;
            }

            .order-card-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }

            .order-id {
                justify-content: center;
            }

            .detail-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 0.25rem;
            }

            .detail-row .detail-value {
                font-weight: 600;
            }

            .btn-dark-custom,
            .btn-outline-dark {
                padding: 8px 20px;
                font-size: 0.85rem;
            }

            .stat-number {
                font-size: 1.8rem;
            }

            .order-stats-section,
            .quick-actions-section {
                padding: 1.5rem;
            }

            .empty-icon {
                width: 80px;
                height: 80px;
                font-size: 2.5rem;
            }

            .detail-section {
                padding: 1rem;
            }
        }

        /* === LOADING SPINNER === */
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        /* === ACCESSIBILITY IMPROVEMENTS === */
        .btn:focus,
        .btn-close:focus,
        .tab-btn:focus {
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            outline: none;
        }

        .order-card:focus-within {
            outline: 2px solid #0d6efd;
            outline-offset: 2px;
        }

        /* === SMOOTH TRANSITIONS === */
        * {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        /* === BUTTON CONSISTENCY === */
        .btn-secondary {
            padding: 8px 20px;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            transform: translateY(-1px);
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.15);
        }

        #validasi-hasil-pesanan {
            background: rgba(244, 245, 244, 0.1);
            /* color: #006400; */
        }

        #btn-hubungi-CS {
            border-radius: 50px;
            color: white;
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.4);
        }

        #btn-FAQ {
            border-radius: 50px;
            background: rgba(0, 100, 0, 0.1);
            color: #006400;
        }

        /* === ADDITIONAL ANIMATIONS === */
        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        .stat-icon:hover {
            animation: pulse 1s infinite;
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(50px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .quick-actions-content {
            animation: slideInLeft 0.8s ease-out;
        }

        .quick-actions-image {
            animation: slideInRight 0.8s ease-out;
        }

        /* === HOVER EFFECTS === */
        .order-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(45deg, transparent, rgba(255, 255, 255, 0.1), transparent);
            transform: translateX(-100%);
            transition: transform 0.6s;
            z-index: 1;
            pointer-events: none;
        }

        .order-card:hover::before {
            transform: translateX(100%);
        }

        /* === LOADING STATES === */
        .loading {
            opacity: 0.7;
            pointer-events: none;
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
            border-top: 2px solid #3498db;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        #order-stats {
            color: white;
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.4);
        }

        #tab-btn-navbar {
            background: rgba(255, 255, 255, 0.1);
            color: #006400;
        }

        #tab-btn-lihatDetail {
            background: rgba(0, 100, 0, 0.1);
            color: #006400;
            border-radius: 50px;
        }

        #tab-btn-tourguide {
            background: rgb(255, 255, 255);
            color: #006400;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* === HIGH CONTRAST MODE === */
        @media (prefers-contrast: high) {
            .order-card {
                border: 2px solid #000;
            }

            .btn-dark-custom {
                border: 3px solid #000;
            }

            .tab-btn {
                border: 2px solid #000;
            }
        }

        /* === REDUCED MOTION === */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* === DARK MODE SUPPORT === */
        @media (prefers-color-scheme: dark) {
            body {
                background-color: #f5f4f4;
                color: #ffffff;
            }

            .orders-container,
            .order-card,
            .quick-actions-section,
            .order-tabs-section {
                background-color: #fbf5f5;
                color: #ffffff;
            }

            .section-heading {
                color: #090909;
            }

            .section-subheading,
            .detail-label,
            .detail-value {
                color: #b0b0b0;
            }

            .order-card-header {
                background: linear-gradient(135deg, #ffffff 0%, #ffffff 100%);
            }

            .detail-section {
                background: #3d3d3d;
            }
        }

        /* === TOUCH DEVICE OPTIMIZATIONS === */
        @media (hover: none) and (pointer: coarse) {
            .order-card:hover {
                transform: none;
            }

            .btn {
                min-height: 44px;
                min-width: 44px;
            }

            .tab-btn {
                min-height: 44px;
            }
        }

        /* === PERFORMANCE OPTIMIZATIONS === */
        .order-card,
        .quick-actions-image img {
            will-change: transform;
        }

        .stat-card {
            will-change: transform, box-shadow;
        }

        /* === CUSTOM SCROLLBAR === */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background: #888;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #555;
        }

        /* === SKELETON LOADING === */
        .skeleton {
            background: linear-gradient(90deg, #f0f0f0 25%, #e0e0e0 50%, #f0f0f0 75%);
            background-size: 200% 100%;
            animation: loading 1.5s infinite;
        }

        @keyframes loading {
            0% {
                background-position: 200% 0;
            }

            100% {
                background-position: -200% 0;
            }
        }

        .skeleton-text {
            height: 1rem;
            margin-bottom: 0.5rem;
            border-radius: 4px;
        }

        .skeleton-title {
            height: 1.5rem;
            width: 70%;
            margin-bottom: 1rem;
            border-radius: 4px;
        }

        /* === STATUS INDICATORS === */
        .status-indicator {
            position: relative;
            display: inline-block;
        }

        .status-indicator::before {
            content: '';
            position: absolute;
            left: -15px;
            top: 50%;
            transform: translateY(-50%);
            width: 8px;
            height: 8px;
            border-radius: 50%;
        }

        .status-pending::before {
            background: #ffc107;
            animation: pulse 2s infinite;
        }

        .status-accepted::before {
            background: #28a745;
        }

        .status-rejected::before {
            background: #dc3545;
        }

        /* === FLOATING ACTION BUTTON === */
        .floating-action-btn {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 60px;
            height: 60px;
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            box-shadow: 0 8px 25px rgba(40, 167, 69, 0.3);
            transition: all 0.3s ease;
            z-index: 1000;
            text-decoration: none;
        }

        .floating-action-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 12px 30px rgba(40, 167, 69, 0.4);
            color: white;
        }

        /* === BREADCRUMB STYLING === */
        .breadcrumb-section {
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            padding: 1rem 0;
            margin-bottom: 2rem;
            border-radius: 10px;
        }

        .breadcrumb {
            background: none;
            margin-bottom: 0;
        }

        .breadcrumb-item+.breadcrumb-item::before {
            content: "›";
            font-weight: bold;
            color: #6c757d;
        }

        .breadcrumb-item.active {
            color: #0d6efd;
            font-weight: 600;
        }

        /* === TOOLTIP STYLES === */
        .tooltip {
            font-size: 0.875rem;
        }

        .tooltip-inner {
            background-color: #212529;
            border-radius: 6px;
            padding: 0.5rem 0.75rem;
        }

        /* === PROGRESS INDICATORS === */
        .progress-ring {
            width: 40px;
            height: 40px;
            transform: rotate(-90deg);
        }

        .progress-ring-circle {
            fill: transparent;
            stroke: #e9ecef;
            stroke-width: 4;
            stroke-dasharray: 113;
            stroke-dashoffset: 113;
            transition: stroke-dashoffset 0.5s ease-in-out;
        }

        .progress-ring-circle.pending {
            stroke: #ffc107;
            stroke-dashoffset: 75;
        }

        .progress-ring-circle.accepted {
            stroke: #28a745;
            stroke-dashoffset: 0;
        }

        .progress-ring-circle.rejected {
            stroke: #dc3545;
            stroke-dashoffset: 113;
        }

        /* === NOTIFICATION BADGES === */
        .notification-badge {
            position: absolute;
            top: 0px;
            right: 0px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            font-weight: 600;
        }

        /* === SEARCH AND FILTER ENHANCEMENTS === */
        .search-filter-section {
            background: #fff;
            border-radius: 15px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }

        .search-input {
            border-radius: 25px;
            border: 2px solid #e9ecef;
            padding: 0.75rem 1.5rem;
            transition: all 0.3s ease;
        }

        .search-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        /* === EXPORT BUTTONS === */
        .export-buttons {
            display: flex;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .export-btn {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.875rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .export-btn:hover {
            transform: translateY(-2px);
        }

        /* === FINAL RESPONSIVE ADJUSTMENTS === */
        @media (max-width: 480px) {
            .hero-title {
                font-size: 2rem;
                letter-spacing: 0.1rem;
            }

            .orders-grid {
                gap: 1rem;
            }

            .order-card-body {
                padding: 1rem;
            }

            .order-card-footer {
                padding: 0.75rem 1rem;
            }

            .detail-section {
                padding: 0.75rem;
            }
        }
    </style>
@endsection
