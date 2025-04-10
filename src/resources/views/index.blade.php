<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agile-D1 - Welcome</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        .hero-section {
            background-image: url('/images/hero-bg.jpg');
            background-size: cover;
            background-position: center;
            color: white;
            padding: 100px 0;
            margin-bottom: 30px;
        }

        .feature-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-5px);
        }

        .card-icon {
            font-size: 2.5rem;
            margin-bottom: 15px;
            color: #4e73df;
        }
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('title', 'Contact Us - oneVision')

    @section('content')

        <!-- Hero Section -->
        <section class="hero-section">
            <div class="container text-center">
                <h1 class="display-4">Welcome to Agile-D1</h1>
                <p class="lead">Discover the beauty of nature and local products</p>
                <div class="mt-4">
                    <a href="{{ route('tourguides.index') }}" class="btn btn-primary btn-lg me-2">Find a Guide</a>
                    <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg">Contact Us</a>
                </div>
            </div>
        </section>

        <!-- Feature Cards Section -->
        <section class="py-5">
            <div class="container">
                <h2 class="text-center mb-5">Explore Our Features</h2>
                <div class="row">
                    <!-- Tour Guides Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-user-tie card-icon"></i>
                                <h5 class="card-title">Tour Guides</h5>
                                <p class="card-text">Explore with our experienced local guides.</p>
                                <a href="{{ route('tourguides.index') }}" class="btn btn-primary">View Guides</a>
                            </div>
                        </div>
                    </div>

                    <!-- Honey Products Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-honey-pot card-icon"></i>
                                <h5 class="card-title">Honey Products</h5>
                                <p class="card-text">Pure, natural honey from local beekeepers.</p>
                                <a href="{{ route('honey') }}" class="btn btn-warning">Shop Honey</a>
                            </div>
                        </div>
                    </div>

                    <!-- UMKM Products Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-store card-icon"></i>
                                <h5 class="card-title">UMKM Products</h5>
                                <p class="card-text">Support local small businesses and artisans.</p>
                                <a href="{{ route('umkm') }}" class="btn btn-info">Shop Products</a>
                            </div>
                        </div>
                    </div>

                    <!-- Gallery Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-images card-icon"></i>
                                <h5 class="card-title">Gallery</h5>
                                <p class="card-text">View stunning photos of our attractions.</p>
                                <a href="{{ route('gallery') }}" class="btn btn-primary">View Gallery</a>
                            </div>
                        </div>
                    </div>

                    <!-- News Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-newspaper card-icon"></i>
                                <h5 class="card-title">News</h5>
                                <p class="card-text">Stay updated with our latest news and events.</p>
                                <a href="{{ route('news') }}" class="btn btn-secondary">Read News</a>
                            </div>
                        </div>
                    </div>

                    <!-- Facilities Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-building card-icon"></i>
                                <h5 class="card-title">Facilities</h5>
                                <p class="card-text">Learn about our visitor facilities and amenities.</p>
                                <a href="{{ route('facilities') }}" class="btn btn-success">View Facilities</a>
                            </div>
                        </div>
                    </div>

                    <!-- Map Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-map-marked-alt card-icon"></i>
                                <h5 class="card-title">Location Map</h5>
                                <p class="card-text">Find your way to our location with our interactive map.</p>
                                <a href="{{ route('map') }}" class="btn btn-primary">View Map</a>
                            </div>
                        </div>
                    </div>

                    <!-- Weather Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-cloud-sun card-icon"></i>
                                <h5 class="card-title">Weather</h5>
                                <p class="card-text">Check the current weather conditions for your visit.</p>
                                <a href="{{ route('weather') }}" class="btn btn-warning">Weather Info</a>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Card -->
                    <div class="col-md-4 col-lg-3">
                        <div class="card feature-card text-center">
                            <div class="card-body">
                                <i class="fas fa-envelope card-icon"></i>
                                <h5 class="card-title">Contact Us</h5>
                                <p class="card-text">Get in touch with us for inquiries or feedback.</p>
                                <a href="{{ route('contact') }}" class="btn btn-primary">Contact</a>
                            </div>
                        </div>
                    </div>

                    <!-- Profile Card (visible only when logged in) -->
                    @auth
                        <div class="col-md-4 col-lg-3">
                            <div class="card feature-card text-center">
                                <div class="card-body">
                                    <i class="fas fa-user-circle card-icon"></i>
                                    <h5 class="card-title">Your Profile</h5>
                                    <p class="card-text">Manage your account and view your activities.</p>
                                    <a href="{{ route('profile') }}" class="btn btn-primary">View Profile</a>
                                </div>
                            </div>
                        </div>
                    @endauth
                </div>
            </div>
        </section>

    @endsection
    <!-- Footer -->
    {{-- <footer class="bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h5>Agile-D1</h5>
                    <p>Discover the beauty of nature and local products with us.</p>
                </div>
                <div class="col-md-3">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('guides') }}" class="text-white">Tour Guides</a></li>
                        <li><a href="{{ route('honey') }}" class="text-white">Honey Products</a></li>
                        <li><a href="{{ route('umkm') }}" class="text-white">UMKM Products</a></li>
                        <li><a href="{{ route('gallery') }}" class="text-white">Gallery</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <address class="mb-0">
                        <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> Jl. Example Street No. 123</p>
                        <p class="mb-1"><i class="fas fa-phone me-2"></i> +62 123 4567 890</p>
                        <p class="mb-1"><i class="fas fa-envelope me-2"></i> info@agile-d1.com</p>
                    </address>
                </div>
            </div>
            <hr>
            <div class="text-center">
                <p>&copy; {{ date('Y') }} Agile-D1. All rights reserved.</p>
            </div>
        </div>
    </footer> --}}

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
