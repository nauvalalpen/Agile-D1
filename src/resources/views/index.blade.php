{{-- resources/views/indexUser.blade.php --}}

@extends('layouts.app')

{{-- Ganti 'Contact Us - oneVision' dengan judul yang sesuai untuk halaman ini --}}
@section('title', 'Welcome - ONEVISION')

@section('content')

    <style>
        /* Custom CSS untuk Hero Section */
        .hero-section-onevision {
            background-image: url('{{ asset('images/waterfall.jpg') }}');
            /* Ganti dengan gambar hero utama */
            background-size: cover;
            background-position: center;
            padding-top: 5rem;
            /* Sesuaikan padding */
            padding-bottom: 12rem;
            /* Beri ruang untuk box di bawah */
            position: relative;
            color: white;
            /* Warna teks default jika diperlukan */
        }

        .hero-content-box {
            position: absolute;
            bottom: -60px;
            /* Sesuaikan agar box menjorok ke bawah */
            left: 50%;
            transform: translateX(-50%);
            width: 90%;
            max-width: 500px;
            /* Lebar maksimum box */
            z-index: 10;
        }

        /* Custom CSS untuk Card dengan gambar latar (Explore Section) */
        .explore-bg-section {
            background-image: url('{{ asset('images/explore-bg.jpg') }}');
            /* Ganti dengan gambar latar explore */
            background-size: cover;
            background-position: center;
            position: relative;
            color: white;
        }

        /* Overlay gelap agar teks terbaca */
        .explore-bg-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            /* Overlay gelap */
            z-index: 1;
        }

        .explore-bg-section .container {
            position: relative;
            z-index: 2;
        }

        /* Styling untuk icon facilities */
        .facility-icon-wrapper {
            width: 60px;
            height: 60px;
            background-color: #e0f2fe;
            /* Warna biru muda */
            color: #0ea5e9;
            /* Warna biru langit */
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            margin: 0 auto 1rem;
            font-size: 1.5rem;
        }

        /* Styling untuk Testimonial Carousel */
        .testimonial-card img {
            width: 80px;
            height: 80px;
            object-fit: cover;
        }

        /* Styling untuk News Carousel */
        #newsCarousel .carousel-item .col-md-4 {
            display: block;
            /* Pastikan kolom ditampilkan */
        }

        /* Customisasi untuk menampilkan 3 item di carousel (mungkin perlu penyesuaian lebih lanjut) */
        @media (min-width: 768px) {

            #newsCarousel .carousel-inner .carousel-item-end.active,
            #newsCarousel .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            #newsCarousel .carousel-inner .carousel-item-start.active,
            #newsCarousel .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }

            #newsCarousel .carousel-inner .carousel-item-end,
            #newsCarousel .carousel-inner .carousel-item-start {
                transform: translateX(0);
            }

            /* Adjust for Testimonials if needed */
            #testimonialCarousel .carousel-inner .carousel-item-end.active,
            #testimonialCarousel .carousel-inner .carousel-item-next {
                transform: translateX(33.333%);
            }

            #testimonialCarousel .carousel-inner .carousel-item-start.active,
            #testimonialCarousel .carousel-inner .carousel-item-prev {
                transform: translateX(-33.333%);
            }

            #testimonialCarousel .carousel-inner .carousel-item-end,
            #testimonialCarousel .carousel-inner .carousel-item-start {
                transform: translateX(0);
            }
        }

        /* Remove default carousel controls background */
        #newsCarousel .carousel-control-prev,
        #newsCarousel .carousel-control-next,
        #testimonialCarousel .carousel-control-prev,
        #testimonialCarousel .carousel-control-next {
            background: none;
            border: none;
            width: auto;
        }

        #newsCarousel .carousel-control-prev-icon,
        #newsCarousel .carousel-control-next-icon,
        #testimonialCarousel .carousel-control-prev-icon,
        #testimonialCarousel .carousel-control-next-icon {
            filter: invert(1) grayscale(100) brightness(1.5);
            /* Make arrows black/gray */
        }

        /* Custom Carousel Indicators */
        .carousel-indicators [data-bs-target] {
            background-color: #adb5bd;
            /* Warna indikator tidak aktif */
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
        }

        .carousel-indicators .active {
            background-color: #0ea5e9;
            /* Warna indikator aktif (biru langit) */
        }
    </style>

    <!-- 1. Hero Section -->
    <section class="hero-section-onevision">
        <!-- Konten di dalam hero jika ada (misal: tagline di atas), jika tidak, biarkan kosong -->
        <div class="container text-center" style="padding-top: 2rem; padding-bottom: 2rem;">
            {{-- Mungkin ada teks atau logo di sini jika desain memerlukannya --}}
        </div>

        <!-- Box Konten di Bawah Hero -->
        <div class="hero-content-box">
            <div class="card shadow-lg border-0 rounded-4 p-4 p-md-5">
                <div class="card-body text-center">
                    <h1 class="card-title fw-bold mb-3" style="color: #0ea5e9;">AIR TERJUN LUBUK HITAM</h1>
                    <p class="card-text text-muted mb-4 fs-5">Beautiful Places in Sumatera Barat</p>
                    {{-- Ganti '#' dengan route login yang sebenarnya --}}
                    <a href="#" class="btn btn-outline-secondary rounded-pill px-4 py-2">Login</a>
                </div>
            </div>
        </div>
    </section>
    <!-- Spacer untuk memberi ruang setelah hero box -->
    <div style="height: 100px;"></div>

    <!-- 2. Explore Section -->
    <section class="py-5 explore-bg-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5 mb-4 mb-lg-0">
                    <h2 class="fw-bold display-5 mb-3">EXPLORE AIR TERJUN LUBUK HITAM</h2>
                    <p class="lead mb-4">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum has been the industry's standard dummy text ever since the 1500s.</p>
                    {{-- Ganti '#' dengan route yang sesuai --}}
                    <a href="#" class="btn btn-light rounded-pill px-4 py-2">
                        See all <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
                <div class="col-lg-7">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                                <img src="{{ asset('images/explore-bg.jpg') }}" class="card-img-top" alt="Azure Haven"
                                    style="height: 150px; object-fit: cover;">
                                <div class="card-body text-center py-3">
                                    <h6 class="card-title mb-0 text-dark">Azure Haven</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                                <img src="{{ asset('images/explore-bg.jpg') }}" class="card-img-top" alt="Serene Sanctuary"
                                    style="height: 150px; object-fit: cover;">
                                <div class="card-body text-center py-3">
                                    <h6 class="card-title mb-0 text-dark">Serene Sanctuary</h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                                <img src="{{ asset('images/explore-bg.jpg') }}" class="card-img-top" alt="Verdant Vista"
                                    style="height: 150px; object-fit: cover;">
                                <div class="card-body text-center py-3">
                                    <h6 class="card-title mb-0 text-dark">Verdant Vista</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. Facilities Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5">FACILITIES</h2>
            <div class="row text-center g-4">
                <div class="col-md-4">
                    <div class="facility-icon-wrapper shadow-sm">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <h5 class="fw-semibold mb-2">Competitive Prices</h5>
                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum.</p>
                </div>
                <div class="col-md-4">
                    <div class="facility-icon-wrapper shadow-sm">
                        <i class="fas fa-shield-alt"></i> {{-- Mengganti ikon gembok --}}
                    </div>
                    <h5 class="fw-semibold mb-2">Secure Booking</h5>
                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum.</p>
                </div>
                <div class="col-md-4">
                    <div class="facility-icon-wrapper shadow-sm">
                        <i class="fas fa-sync-alt"></i> {{-- Mengganti ikon refresh --}}
                    </div>
                    <h5 class="fw-semibold mb-2">Seamless Experience</h5>
                    <p class="text-muted">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem
                        Ipsum.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. Tour Guide Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-2">TOUR GUIDE</h2>
            <p class="text-center text-muted mb-5">Our Best Tour Guide</p>
            <div class="row g-4">
                @foreach ($tourGuides as $guide)
                    <div class="col-md-4">
                        <div class="card shadow-sm border-0 rounded-3 overflow-hidden">
                            <img src="{{ asset('storage/' . $guide->foto) }}" class="card-img-top" alt="{{ $guide->nama }}"
                                style="height: 250px; object-fit: cover;">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title mb-0">{{ $guide->nama }}</h5>
                                    <span class="fw-bold text-primary">{{ $guide->price_range }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="text-center mt-5">
                <a href="{{ route('login') }}" class="btn btn-outline-secondary rounded-pill px-4 py-2">
                    Login <i class="fas fa-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </section>


    <!-- 5. Feature News Section (Carousel) -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0">Feature News</h2>
                <div>
                    <button class="btn btn-outline-secondary btn-sm me-1" type="button" data-bs-target="#newsCarousel"
                        data-bs-slide="prev">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-outline-secondary btn-sm" type="button" data-bs-target="#newsCarousel"
                        data-bs-slide="next">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div id="newsCarousel" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-indicators mb-0" style="position: static; margin-top: 2rem;">
                    <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#newsCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    {{-- Tambah indicator jika ada lebih banyak slide --}}
                </div>
                <div class="carousel-inner">
                    {{-- Slide 1 --}}
                    <div class="carousel-item active">
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                    <img src="{{ asset('images/delicious_restaurant.jpg') }}" class="card-img-top"
                                        alt="News 1" style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <p class="text-muted small mb-1"><i class="far fa-calendar-alt me-1"></i> February
                                            20, 2024</p>
                                        <h5 class="card-title fw-semibold">Delicious restaurant at Hanalei Bay</h5>
                                        <p class="card-text text-muted small flex-grow-1">Lorem Ipsum is simply dummy text
                                            of the printing and typesetting industry. Lorem Ipsum has been lorem...</p>
                                        <a href="#" class="text-decoration-none" style="color: #0ea5e9;">See more
                                            <i class="fas fa-arrow-right small ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                    <img src="{{ asset('images/top_10_most_beautiful.jpg') }}" class="card-img-top"
                                        alt="News 2" style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <p class="text-muted small mb-1"><i class="far fa-calendar-alt me-1"></i> February
                                            20, 2024</p>
                                        <h5 class="card-title fw-semibold">Top 10 most beautiful check-in spots in Ph</h5>
                                        <p class="card-text text-muted small flex-grow-1">Lorem Ipsum is simply dummy text
                                            of the printing and typesetting industry. Lorem Ipsum has been lorem...</p>
                                        <a href="#" class="text-decoration-none" style="color: #0ea5e9;">See more
                                            <i class="fas fa-arrow-right small ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card h-100 shadow-sm border-0 rounded-3 overflow-hidden">
                                    <img src="{{ asset('images/top_5_newest_services.jpg') }}" class="card-img-top"
                                        alt="News 3" style="height: 200px; object-fit: cover;">
                                    <div class="card-body d-flex flex-column">
                                        <p class="text-muted small mb-1"><i class="far fa-calendar-alt me-1"></i> February
                                            20, 2024</p>
                                        <h5 class="card-title fw-semibold">Top 5 newest services at Navagio Beach</h5>
                                        <p class="card-text text-muted small flex-grow-1">Lorem Ipsum is simply dummy text
                                            of the printing and typesetting industry. Lorem Ipsum has been lorem...</p>
                                        <a href="#" class="text-decoration-none" style="color: #0ea5e9;">See more
                                            <i class="fas fa-arrow-right small ms-1"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Slide 2 (Contoh jika ada lebih banyak berita) --}}
                    {{-- <div class="carousel-item">
                     <div class="row g-4"> --}}
                    {{-- Card 4 --}}
                    {{-- Card 5 --}}
                    {{-- Card 6 --}}
                    {{-- </div>
                </div> --}}
                </div>
                {{-- Tombol Previous/Next di bawah (opsional, bisa dihapus jika sudah pakai yg di atas) --}}
                {{-- <button class="carousel-control-prev" type="button" data-bs-target="#newsCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#newsCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button> --}}
            </div>
        </div>
    </section>

    <!-- 6. Testimonials Section (Carousel) -->
    <section class="py-5 position-relative"
        style="background-image: url('{{ asset('images/testimonials-bg.jpg') }}'); background-size: cover; background-position: center;">
        {{-- Dark Overlay --}}
        <div
            style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-color: rgba(0, 0, 0, 0.4); z-index: 1;">
        </div>

        <div class="container position-relative" style="z-index: 2;">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="fw-bold mb-0 text-white">Testimonials</h2>
                {{-- Carousel Controls (Top Right) --}}
                <div>
                    <button class="btn btn-sm me-1" type="button" data-bs-target="#testimonialCarousel"
                        data-bs-slide="prev" style="background-color: rgba(0,0,0,0.3); border: none; color: white;">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <button class="btn btn-sm" type="button" data-bs-target="#testimonialCarousel" data-bs-slide="next"
                        style="background-color: rgba(0,0,0,0.3); border: none; color: white;">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>

            <div id="testimonialCarousel" class="carousel slide" data-bs-ride="false"> {{-- data-bs-ride="false" agar tidak auto slide --}}
                {{-- Carousel Indicators (Bottom Center) --}}
                <div class="carousel-indicators position-relative mt-4 mb-0" style="bottom: -30px;">
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="1"
                        aria-label="Slide 2"></button>
                    {{-- Tambah indicator jika ada lebih banyak slide --}}
                    {{-- <button type="button" data-bs-target="#testimonialCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button> --}}
                </div>

                <div class="carousel-inner pb-5"> {{-- Padding bottom agar indicator tidak tertutup --}}
                    {{-- Slide 1 --}}
                    <div class="carousel-item active">
                        <div class="row g-4 justify-content-center"> {{-- justify-content-center jika hanya 1 atau 2 item di slide terakhir --}}
                            {{-- Testimonial Card 1 --}}
                            <div class="col-md-4">
                                {{-- Card dengan posisi relatif untuk gambar absolut --}}
                                <div class="card h-100 shadow border-0 rounded-4 text-center position-relative pt-5 pb-4 px-3"
                                    style="margin-top: 40px;">
                                    {{-- Gambar diletakkan di atas card --}}
                                    <img src="{{ asset('images/sebastian.jpg') }}" alt="Sebastian"
                                        class="rounded-circle position-absolute top-0 start-50 translate-middle shadow-sm"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                    <div class="card-body p-0">
                                        <h5 class="fw-semibold mb-2 mt-2">Sebastian</h5>
                                        <p class="text-muted small mb-0">Lorem Ipsum is simply dummy text of the printing
                                            and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text.</p>
                                    </div>
                                </div>
                            </div>
                            {{-- Testimonial Card 2 --}}
                            <div class="col-md-4">
                                <div class="card h-100 shadow border-0 rounded-4 text-center position-relative pt-5 pb-4 px-3"
                                    style="margin-top: 40px;">
                                    <img src="{{ asset('images/evangeline.jpg') }}" alt="Evangeline"
                                        class="rounded-circle position-absolute top-0 start-50 translate-middle shadow-sm"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                    <div class="card-body p-0">
                                        <h5 class="fw-semibold mb-2 mt-2">Evangeline</h5>
                                        <p class="text-muted small mb-0">Lorem Ipsum is simply dummy text of the printing
                                            and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text.</p>
                                    </div>
                                </div>
                            </div>
                            {{-- Testimonial Card 3 --}}
                            <div class="col-md-4">
                                <div class="card h-100 shadow border-0 rounded-4 text-center position-relative pt-5 pb-4 px-3"
                                    style="margin-top: 40px;">
                                    <img src="{{ asset('images/alexander.jpg') }}" alt="Alexander"
                                        class="rounded-circle position-absolute top-0 start-50 translate-middle shadow-sm"
                                        style="width: 80px; height: 80px; object-fit: cover;">
                                    <div class="card-body p-0">
                                        <h5 class="fw-semibold mb-2 mt-2">Alexander</h5>
                                        <p class="text-muted small mb-0">Lorem Ipsum is simply dummy text of the printing
                                            and typesetting industry. Lorem Ipsum has been the industry's standard dummy
                                            text.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- Slide 2 (Contoh jika ada lebih banyak testimoni) --}}
                    {{-- <div class="carousel-item">
                     <div class="row g-4 justify-content-center"> --}}
                    {{-- Testimonial Card 4 --}}
                    {{-- Testimonial Card 5 --}}
                    {{-- Testimonial Card 6 --}}
                    {{-- </div>
                </div> --}}
                </div>
            </div>
        </div>
    </section>

    {{-- Tambahkan CSS ini di bagian <style> atau file CSS terpisah --}}
    <style>
        #testimonialCarousel .carousel-indicators [data-bs-target] {
            background-color: #adb5bd;
            /* Warna indikator tidak aktif */
            width: 10px;
            height: 10px;
            border-radius: 50%;
            margin: 0 5px;
            border: none;
            opacity: 0.7;
        }

        #testimonialCarousel .carousel-indicators .active {
            background-color: #ffffff;
            /* Warna indikator aktif */
            opacity: 1;
        }
    </style>

    <!-- 7. Maps Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-4">Maps</h2>
            <div class="card">
                <div class="card-body p-0">
                    <div class="ratio ratio-16x9">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15955.309681576033!2d100.4237422!3d-1.0524651!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd4a594047f51ff%3A0xf851098b76ef9461!2sWisata%20Air%20Terjun%20Lubuk%20Hitam%20Lestari!5e0!3m2!1sen!2sid!4v1700000000000!5m2!1sen!2sid"
                            width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- 8. Testimonials --}}


    {{-- Footer mungkin sudah ada di layouts.app --}}
    {{-- Jika belum ada, kamu bisa adaptasi footer dari screenshot pertama di sini --}}
    {{-- Contoh adaptasi footer (sesuaikan dengan kebutuhan): --}}
    {{-- <footer class="bg-dark text-white pt-5 pb-4">
    <div class="container">
        <div class="row">
             <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Support</h5>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Help Center</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Safety Information</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Cancellation options</a></li>
                </ul>
            </div>
             <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Company</h5>
                 <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">About us</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Privacy policy</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Community Blog</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Terms of service</a></li>
                </ul>
            </div>
             <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3">Contact</h5>
                <ul class="list-unstyled text-secondary">
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">FAQ</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Get in touch</a></li>
                    <li class="mb-2"><a href="#" class="text-secondary text-decoration-none">Partnerships</a></li>
                </ul>
            </div>
            <div class="col-md-3 mb-4">
                 <h5 class="fw-bold mb-3">Social</h5>
                 <div class="d-flex">
                    <a href="#" class="text-secondary me-3 fs-5"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="text-secondary me-3 fs-5"><i class="fab fa-twitter"></i></a>
                    <a href="#" class="text-secondary me-3 fs-5"><i class="fab fa-tiktok"></i></a>
                    <a href="#" class="text-secondary me-3 fs-5"><i class="fab fa-youtube"></i></a>
                 </div>
            </div>
        </div>
        <hr class="border-secondary">
        <div class="row align-items-center">
            <div class="col-md-6">
                 <p class="text-secondary small mb-0">© Copyright Agenda 2024</p>
            </div>
             <div class="col-md-6 text-md-end">
                 <i class="fab fa-cc-visa fs-4 me-2 text-secondary"></i>
                 <i class="fab fa-cc-mastercard fs-4 me-2 text-secondary"></i>
                 <i class="fab fa-cc-discover fs-4 me-2 text-secondary"></i>
                 <i class="fab fa-cc-paypal fs-4 me-2 text-secondary"></i>
                 {{-- Tambahkan ikon pembayaran lainnya jika perlu --}}
    {{-- </div>
        </div>
    </div>
</footer> --}}

    @include('layouts.footer')


@endsection

{{-- Jangan lupa sertakan script Bootstrap JS di layouts.app jika belum --}}
{{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script> --}}
{{-- Script untuk carousel multi-item (opsional, jika diperlukan) --}}
{{-- @push('scripts')
<script>
    // Basic multi-item carousel functionality (Bootstrap 5)
    document.querySelectorAll('.carousel').forEach(carousel => {
        if (carousel.dataset.bsInterval) { // Check if carousel should auto slide
            return; // Let Bootstrap handle auto slide
        }
        let items = carousel.querySelectorAll('.carousel-item');
        items.forEach((el) => {
            const minPerSlide = 3; // Show 3 items per slide
            let next = el.nextElementSibling;
            for (var i = 1; i < minPerSlide; i++) {
                if (!next) {
                    // wrap carousel by using first child
                    next = items[0];
                }
                let cloneChild = next.cloneNode(true);
                el.appendChild(cloneChild.children[0]);
                next = next.nextElementSibling;
            }
        });
    });
</script>
@endpush --}}
