@extends('layouts.app')

@section('content')
    {{-- Include AOS (Animate on Scroll) Library --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    {{-- Recommended: Include Font Awesome if not already in your app.blade.php --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" />


    <!-- 1. HERO SECTION (from your screenshot) -->
    <section class="hero-section">
        <div class="hero-content" data-aos="fade-up">
            <div class="hero-title">GALLERY<br>WISATA</div>
            <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
            <a href="#gallery-grid" class="hero-btn">More info</a>
        </div>
    </section>


    <!-- CONTAINER FOR THE REST OF THE PAGE CONTENT -->
    <div class="container py-5">

        <!-- 2. MAIN GALLERY GRID (with Modals) -->
        <div id="gallery-grid" class="gallery-container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="section-heading">Explore Our Gallery</h2>
                <p class="section-subheading">Click on any item to view more details and see the full picture.</p>
            </div>

            <div class="row">
                @forelse ($galleries as $gallery)
                    <div class="col-md-6 col-lg-4 mb-4 d-flex align-items-stretch">
                        <div class="gallery-card w-100" data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                            <div class="gallery-card-img-wrapper">
                                @if ($gallery->foto)
                                    <img src="{{ asset('storage/' . $gallery->foto) }}" class="gallery-card-img"
                                        alt="{{ $gallery->judul }}">
                                @else
                                    <div class="bg-light d-flex align-items-center justify-content-center h-100">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $gallery->judul }}</h5>
                                <h6 class="card-subtitle mb-2 text-muted">
                                    {{ \Carbon\Carbon::parse($gallery->tanggal)->format('d M Y') }}
                                </h6>
                                <p class="card-text">{{ Str::limit($gallery->deskripsi, 100) }}</p>
                                <div class="mt-auto">
                                    <button type="button" class="btn btn-primary w-100" data-bs-toggle="modal"
                                        data-bs-target="#galleryModal{{ $gallery->id }}">
                                        View Details
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal for each gallery item -->
                    <div class="modal fade" id="galleryModal{{ $gallery->id }}" tabindex="-1"
                        aria-labelledby="galleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="galleryModalLabel{{ $gallery->id }}">{{ $gallery->judul }}
                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-md-7">
                                            @if ($gallery->foto)
                                                <img src="{{ asset('storage/' . $gallery->foto) }}"
                                                    class="img-fluid rounded" alt="{{ $gallery->judul }}">
                                            @endif
                                        </div>
                                        <div class="col-md-5">
                                            <h5><i class="fas fa-calendar-alt me-2 text-primary"></i>Date</h5>
                                            <p>{{ \Carbon\Carbon::parse($gallery->tanggal)->format('F j, Y') }}</p>
                                            <h5 class="mt-3"><i
                                                    class="fas fa-info-circle me-2 text-primary"></i>Description</h5>
                                            <p>{{ $gallery->deskripsi }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-12 text-center py-5" data-aos="fade-up">
                        <h3>No gallery items available at the moment.</h3>
                        <p class="text-muted">Please check back later.</p>
                    </div>
                @endforelse
            </div>
        </div>


        <!-- 3. HERO TOUR GUIDE SECTION -->
        <div class="hero-tour-section my-5 py-5" data-aos="fade-up">
            <div class="row align-items-center g-5">
                <div class="col-lg-6" data-aos="fade-right" data-aos-delay="200">
                    <div class="hero-tour-text">
                        <h3>Experience Adventure with<br>Our Best Tour Guides</h3>
                        <p>
                            From painting sessions to outdoor escapades, our experiences promise unforgettable moments of
                            inspiration and rejuvenation. Venture into nature’s embrace on our thrilling hiking adventures
                            or chase the thundering roar of cascading waterfalls.
                        </p>
                        <a href="{{-- route('tourguides.index') --}}" class="btn btn-dark-custom">Find a Guide</a>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="hero-tour-img">
                        <img src="{{ asset('images/explore-bg.jpg') }}" alt="Tour Guide">
                    </div>
                </div>
            </div>
        </div>


        <!-- 4. SCROLLABLE GALLERY -->
        <div class="scrolling-gallery-section" data-aos="fade-up">
            <div class="text-center mb-5">
                <h2 class="section-heading">More Visuals</h2>
                <p class="section-subheading">A glimpse into the stunning scenery awaiting you.</p>
            </div>
            <div class="scroll-gallery">
                <div class="scroll-track">
                    @foreach ($galleries->concat($galleries) as $gallery)
                        {{-- Double the items for a seamless loop --}}
                        <div class="scroll-card">
                            <img src="{{ asset('storage/' . $gallery->foto) }}" alt="{{ $gallery->judul }}">
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
        });
    </script>

    @include('layouts.footer')
@endsection

@section('styles')
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* A modern, clean font */
            background-color: #f8f9fa;
        }

        /* === 1. HERO SECTION === */
        .hero-section {
            position: relative;
            background: linear-gradient(rgba(0, 0, 0, 0.4), rgba(0, 0, 0, 0.4)),
                url('/images/hero.jpg') no-repeat center center/cover;
            /* Ensure your hero image is in public/images/ */
            height: 85vh;
            min-height: 500px;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            overflow: hidden;
        }

        .hero-content {
            max-width: 800px;
        }

        .hero-title {
            font-family: 'Montserrat', sans-serif;
            font-size: clamp(3rem, 10vw, 6rem);
            font-weight: 900;
            line-height: 1.1;
            margin-bottom: 20px;
            letter-spacing: 0.5rem;
            text-transform: uppercase;
            text-shadow: 2px 2px 10px rgba(0, 0, 0, 0.5);
        }

        .hero-desc {
            font-size: 1.1rem;
            margin-bottom: 30px;
            color: #ddd;
            max-width: 500px;
            margin-left: auto;
            margin-right: auto;
        }

        .hero-btn {
            display: inline-block;
            padding: 12px 35px;
            background-color: transparent;
            border: 2px solid white;
            color: white;
            text-decoration: none;
            font-weight: 600;
            border-radius: 50px;
            transition: all 0.3s ease;
            font-size: 1rem;
            letter-spacing: 1.5px;
        }

        .hero-btn:hover {
            background-color: white;
            color: black;
            transform: scale(1.05);
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

        /* === 2. MAIN GALLERY GRID === */
        .gallery-container {
            margin-top: -80px;
            /* Pull the content up over the hero image slightly */
            position: relative;
            z-index: 2;
            background: #f8f9fa;
            padding: 4rem 2rem;
            border-radius: 20px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        }

        .gallery-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
        }

        .gallery-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
        }

        .gallery-card-img-wrapper {
            height: 220px;
            overflow: hidden;
        }

        .gallery-card-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-card:hover .gallery-card-img {
            transform: scale(1.1);
        }

        .modal-content {
            border-radius: 15px;
            border: none;
        }

        .modal-header {
            border-bottom: 1px solid #dee2e6;
        }

        /* === 3. HERO TOUR GUIDE SECTION === */
        .hero-tour-section {
            background-color: #fff;
            border-radius: 20px;
            padding: 3rem;
        }

        .hero-tour-img img {
            max-width: 100%;
            border-radius: 16px;
        }

        .hero-tour-text h3 {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 1rem;
            line-height: 1.3;
        }

        .hero-tour-text p {
            font-size: 1rem;
            line-height: 1.7;
            color: #555;
        }

        .btn-dark-custom {
            margin-top: 1.5rem;
            padding: 12px 35px;
            background-color: #212529;
            color: #fff;
            border: 2px solid #212529;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-dark-custom:hover {
            background-color: #fff;
            color: #212529;
        }

        /* === 4. SCROLLING GALLERY === */
        .scrolling-gallery-section {
            overflow: hidden;
            /* Important to contain the animation */
        }

        .scroll-gallery {
            display: flex;
            overflow: hidden;
            -webkit-mask-image: linear-gradient(to right, transparent, #000 10%, #000 90%, transparent);
            mask-image: linear-gradient(to right, transparent, #000 10%, #000 90%, transparent);
        }

        .scroll-track {
            display: flex;
            gap: 20px;
            animation: scroll 40s linear infinite;
        }

        .scroll-card {
            flex: 0 0 auto;
            width: 250px;
            height: 320px;
            border-radius: 14px;
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .scroll-card img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        @keyframes scroll {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
            }
        }
    </style>
@endsection
