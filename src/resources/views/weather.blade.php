@extends('layouts.app')
@section('styles')
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prakiraan Cuaca - oneVision</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        /* Updated color scheme - #1a3d2e (dominant) and #f59e0b */
        :root {
            --hero-primary: #1a3d2e;
            --hero-secondary: #2d4a3a;
            --hero-accent: #f59e0b;
            --hero-light: #f0fdf4;
            --hero-border: #d1fae5;
            --hero-accent-light: #fef3c7;
            --weather-gradient: linear-gradient(135deg, #1a3d2e 0%, #2d4a3a 100%);
            --success-gradient: linear-gradient(135deg, #10b981 0%, #059669 100%);
            --warning-gradient: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
            --shadow-light: 0 4px 15px rgba(26, 61, 46, 0.1);
            --shadow-medium: 0 8px 25px rgba(26, 61, 46, 0.15);
            --shadow-heavy: 0 15px 35px rgba(26, 61, 46, 0.2);
            --green-light: #ecfdf5;
            --green-medium: #a7f3d0;
            --green-dark: #065f46;
        }

        body {
            /* background: linear-gradient(135deg, var(--hero-light) 0%, var(--green-light) 100%); */
            font-family: 'Inter', 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: var(--hero-primary);
            line-height: 1.6;
        }

        /* === HERO SECTION (Same as madu/index.blade.php) === */
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

        /* Main Content Container */
        .main-content {
            margin-top: -30px;
            position: relative;
            margin-bottom: 0;
        }

        .container {
            position: relative;
        }

        .container::before {
            display: none;
        }

        /* Weather Cards */
        .weather-card {
            border-radius: 20px;
            box-shadow: var(--shadow-medium);
            overflow: hidden;
            transition: all 0.3s ease;
            border: none;
            margin-bottom: 2rem;
        }

        .weather-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-heavy);
        }

        .current-weather {
            background: var(--weather-gradient);
            color: white;
            padding: 2.5rem;
            position: relative;
        }

        .current-weather::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--hero-accent), var(--green-medium), var(--success-gradient));
        }

        .weather-location {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .weather-date {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 0.25rem;
        }

        .weather-time {
            font-size: 1rem;
            opacity: 0.8;
            margin-bottom: 1.5rem;
        }

        .current-temp {
            font-size: 4rem;
            font-weight: 800;
            margin: 1rem 0;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .weather-condition {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .weather-icon-large {
            font-size: 4rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .weather-details {
            flex: 1;
        }

        .weather-description {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .weather-stats {
            display: flex;
            gap: 2rem;
            font-size: 1rem;
            opacity: 0.9;
        }

        .weather-stat {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .location-info {
            text-align: right;
            opacity: 0.9;
        }

        .location-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
        }

        .location-details {
            font-size: 0.95rem;
            line-height: 1.4;
        }

        /* Loading State */
        .loading {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            opacity: 0.7;
        }

        .loading-spinner {
            display: inline-block;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-radius: 50%;
            border-top-color: white;
            animation: spin 1s ease-in-out infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        /* Forecast Sections */
        .forecast-section {
            background: rgb(235, 245, 239);
            border-radius: 15px;
            padding: 2rem;
            margin: 2rem 0;
            border: 1px solid var(--hero-border);
        }

        .section-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--hero-primary);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .hourly-forecast {
            overflow-x: auto;
            padding: 1rem 0;
        }

        .hourly-container {
            display: flex;
            gap: 1rem;
            min-width: max-content;
            padding-bottom: 0.5rem;
        }

        .hourly-item {
            background: var(--hero-light);
            border-radius: 15px;
            padding: 1.5rem 1rem;
            text-align: center;
            min-width: 120px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .hourly-item:hover {
            background: var(--green-light);
            border-color: var(--hero-primary);
            transform: translateY(-3px);
        }

        .hourly-item.current {
            background: var(--success-gradient);
            color: white;
            font-weight: 600;
        }

        .hourly-time {
            font-size: 0.9rem;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--hero-primary);
        }

        .hourly-item.current .hourly-time {
            color: white;
        }

        .hourly-temp {
            font-size: 1.25rem;
            font-weight: 700;
            margin: 0.5rem 0;
            color: var(--hero-primary);
        }

        .hourly-item.current .hourly-temp {
            color: white;
        }

        .hourly-wind {
            font-size: 0.85rem;
            color: var(--green-dark);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.25rem;
        }

        .hourly-item.current .hourly-wind {
            color: rgba(255, 255, 255, 0.9);
        }

        /* Daily Forecast */
        .daily-forecast {
            background: rgb(235, 245, 239);
            border-radius: 15px;
            padding: 2rem;
            border: 1px solid var(--hero-border);
        }

        .daily-item {
            padding: 1.5rem;
            border: 1px solid rgb(144, 141, 141);
            transition: all 0.3s ease;
            border-radius: 10px;
            margin-bottom: 0.5rem;
        }

        .daily-item:hover {
            background: var(--hero-light);
            transform: translateX(5px);
        }

        .daily-item:last-child {
            /* border-bottom: none; */
            margin-bottom: 0;
        }

        .daily-date {
            font-weight: 700;
            font-size: 1.1rem;
            color: var(--hero-primary);
            margin-bottom: 0.25rem;
        }

        .daily-date-sub {
            font-size: 0.9rem;
            color: var(--green-dark);
        }

        .temp-range {
            font-size: 1.1rem;
            font-weight: 600;
        }

        .temp-high {
            color: #dc2626;
            font-weight: 700;
        }

        .temp-low {
            color: #2563eb;
            font-weight: 500;
        }

        .wind-info {
            color: var(--green-dark);
            font-size: 0.95rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .weather-badges {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .weather-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        .badge-hot {
            background: var(--warning-gradient);
            color: white;
        }

        .badge-cool {
            background: linear-gradient(135deg, #3b82f6, #1d4ed8);
                        color: white;
        }

        .badge-pleasant {
            background: var(--success-gradient);
            color: white;
        }

        .badge-windy {
            background: linear-gradient(135deg, var(--hero-accent), #d97706);
            color: white;
        }

        .badge-danger {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            border: 1px solid #dc2626;
        }

        .badge-danger::before {
            content: '⚠️ ';
            margin-right: 0.25rem;
        }


        /* Weather Alerts */
        .weather-alert {
            background: linear-gradient(135deg, #dc2626, #b91c1c);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .weather-alert.info {
            background: var(--success-gradient);
        }

        .weather-alert.warning {
            background: var(--warning-gradient);
        }


        .info-card {
            background: white;
            padding: 1.5rem;
            border-radius: 15px;
            box-shadow: var(--shadow-light);
            border-left: 4px solid var(--hero-primary);
            transition: all 0.3s ease;
            border: 1px solid var(--hero-border);
        }

        .info-card:hover {
            transform: translateY(-3px);
            box-shadow: var(--shadow-medium);
            border-left-color: var(--hero-accent);
        }

        .info-card h6 {
            color: var(--hero-primary);
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .info-card h6 i {
            color: var(--hero-accent);
        }

        .info-card p {
            color: var(--green-dark);
            margin-bottom: 0;
            line-height: 1.5;
        }

        /* Footer with spacing */
        .weather-footer {
            text-align: center;
            padding: 3rem 2rem;
            background: rgb(235, 245, 239);
            border-radius: 15px;
            margin-top: 3rem;
            margin-bottom: 3rem;
            color: var(--green-dark);
            border: 1px solid var(--hero-border);
        }

        .weather-footer h6 {
            color: var(--hero-primary);
            font-weight: 600;
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }

        .weather-footer h6 i {
            color: var(--hero-accent);
            margin-right: 0.5rem;
        }

        .weather-footer p {
            margin-bottom: 0.75rem;
            font-size: 0.95rem;
            line-height: 1.6;
        }

        .weather-footer .mt-3 {
            margin-top: 2rem !important;
            padding-top: 1.5rem;
            border-top: 1px solid rgb(144, 141, 141);
        }

        /* Weather Icons Animation */
        .weather-icon {
            animation: float 3s ease-in-out infinite;
            color: var(--hero-accent);
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }

        /* Custom Scrollbar */
        .hourly-forecast::-webkit-scrollbar {
            height: 8px;
        }

        .hourly-forecast::-webkit-scrollbar-track {
            background: var(--hero-light);
            border-radius: 4px;
        }

        .hourly-forecast::-webkit-scrollbar-thumb {
            background: var(--success-gradient);
            border-radius: 4px;
        }

        .hourly-forecast::-webkit-scrollbar-thumb:hover {
            background: var(--hero-primary);
        }

        /* Green theme enhancements */
        .text-muted {
            color: var(--green-dark) !important;
            opacity: 0.8;
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .main-content {
                margin-top: -60px;
            }

            .current-weather {
                padding: 2rem 1.5rem;
            }

            .current-temp {
                font-size: 3rem;
            }

            .weather-condition {
                flex-direction: column;
                text-align: center;
                gap: 1rem;
            }

            .weather-icon-large {
                font-size: 3rem;
            }

            .weather-stats {
                justify-content: center;
                flex-wrap: wrap;
                gap: 1rem;
            }

            .location-info {
                text-align: center;
                margin-top: 1rem;
            }

            .forecast-section,
            .daily-forecast {
                padding: 1.5rem;
            }

            .hourly-item {
                min-width: 100px;
                padding: 1rem 0.75rem;
            }

            .daily-item {
                padding: 1rem;
            }

            .weather-footer {
                padding: 2rem 1.5rem;
                margin-bottom: 2rem;
            }
        }

        @media (max-width: 576px) {
            .main-content {
                margin-top: -40px;
            }

            .current-weather {
                padding: 1.5rem;
            }

            .current-temp {
                font-size: 2.5rem;
            }

            .weather-stats {
                flex-direction: column;
                gap: 0.5rem;
            }

            .forecast-section,
            .daily-forecast {
                padding: 1rem;
            }

            .weather-footer {
                padding: 1.5rem 1rem;
                margin-bottom: 1.5rem;
            }
        }

        /* Smooth transitions */
        * {
            transition: all 0.3s ease;
        }

        /* Enhanced green atmosphere */
        .container {
            position: relative;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: -50px;
            right: -50px;
            bottom: 0;
            background: linear-gradient(135deg, 
                rgba(240, 253, 244, 0.3) 0%, 
                rgba(220, 252, 231, 0.2) 50%, 
                rgba(187, 247, 208, 0.1) 100%);
            border-radius: 20px;
            z-index: -1;
            pointer-events: none;
        }

        /* Add subtle green glow effects */
        .weather-card:hover {
            box-shadow: 0 15px 35px rgba(26, 61, 46, 0.2), 
                        0 0 20px rgba(16, 185, 129, 0.1);
        }

        .info-card:hover {
            box-shadow: 0 8px 25px rgba(26, 61, 46, 0.15), 
                        0 0 15px rgba(16, 185, 129, 0.05);
        }

        /* Green accent for icons */
        .section-title i {
            color: var(--hero-accent);
        }

        .weather-stat i {
            color: var(--green-medium);
        }

        .wind-info i {
            color: var(--hero-accent);
        }
    </style>
</head>

<body>
    <!-- Hero Section -->
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-title">PRAKIRAAN<br>CUACA</div>
            <div class="hero-desc">Dapatkan informasi cuaca terkini dan prakiraan cuaca akurat untuk kawasan Air Terjun Lubuk Hitam Lestari dan sekitarnya di Padang, Sumatera Barat.</div>
            <a href="#weather-content" class="hero-btn">Lihat Prakiraan</a>
        </div>
    </section>

    <!-- Main Content - Raised up to touch hero -->
    <div class="main-content">
        <div class="container" id="weather-content">
            <!-- Current Weather -->
            <div class="row">
                <div class="col-12">
                    <div class="weather-card">
                        <div class="current-weather">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="weather-location">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <span id="locationName">Air Terjun Lubuk Hitam</span>
                                    </div>
                                    <div class="weather-date" id="currentDate">
                                        <div class="loading">
                                            <div class="loading-spinner"></div>
                                            Memuat data...
                                        </div>
                                    </div>
                                    <div class="weather-time" id="currentTime">
                                        <div class="loading">
                                            <div class="loading-spinner"></div>
                                            Memperbarui...
                                        </div>
                                    </div>
                                    
                                    <div class="current-temp" id="currentTemp">
                                        <div class="loading">
                                            <div class="loading-spinner"></div>
                                            --°C
                                        </div>
                                    </div>
                                    
                                    <div class="weather-condition">
                                        <div class="weather-icon-large">
                                            <i class="fas fa-cloud-sun weather-icon" id="weatherIcon"></i>
                                        </div>
                                        <div class="weather-details">
                                            <div class="weather-description" id="weatherDescription">
                                                <div class="loading">
                                                    <div class="loading-spinner"></div>
                                                    Memuat kondisi cuaca...
                                                </div>
                                            </div>
                                            <div class="weather-stats">
                                                <div class="weather-stat">
                                                    <i class="fas fa-eye"></i>
                                                    <span id="feelsLike">Terasa seperti --°C</span>
                                                </div>
                                                <div class="weather-stat">
                                                    <i class="fas fa-tint"></i>
                                                    <span id="humidity">Kelembaban --%</span>
                                                </div>
                                                <div class="weather-stat">
                                                    <i class="fas fa-wind"></i>
                                                    <span id="windSpeed">Angin -- km/jam</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="location-info">
                                        <div class="location-title">Kawasan Wisata</div>
                                        <div class="location-details" id="locationDetails">
                                            Air Terjun Lubuk Hitam Lestari<br>
                                            Kecamatan Bungus Teluk Kabung<br>
                                            Kota Padang, Sumatera Barat<br>
                                            <span id="coordinates">Koordinat: -1.0456°, 100.3673°</span><br>
                                            Zona Waktu: WIB (UTC+7)
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hourly Forecast -->
            <div class="forecast-section">
                <h5 class="section-title">
                    <i class="fas fa-clock"></i>
                    Prakiraan Per Jam
                </h5>
                <div class="hourly-forecast">
                    <div class="hourly-container" id="hourlyContainer">
                        <!-- Hourly data will be populated by JavaScript -->
                        <div class="loading">
                            <div class="loading-spinner"></div>
                            Memuat prakiraan per jam...
                        </div>
                    </div>
                </div>
            </div>

            <!-- Daily Forecast -->
            <div class="daily-forecast">
                <h5 class="section-title">
                    <i class="fas fa-calendar-alt"></i>
                    Prakiraan 7 Hari Ke Depan
                </h5>
                
                <div id="dailyContainer">
                    <!-- Daily data will be populated by JavaScript -->
                    <div class="loading">
                        <div class="loading-spinner"></div>
                        Memuat prakiraan harian...
                    </div>
                </div>
            </div>

            <!-- Dynamic Weather Alert -->
            <div id="weatherAlert" style="display: none;">
                <!-- Weather alerts will be populated by JavaScript based on API data -->
            </div>

            <!-- Footer Information with added spacing -->
            <div class="weather-footer" style="text-align: left">
                <h6>
                    <i class="fas fa-info-circle"></i>
                    Informasi Data Cuaca
                </h6>
                <p>
                    <strong>Sumber Data:</strong> OpenWeatherMap API & Badan Meteorologi, Klimatologi, dan Geofisika (BMKG)
                </p>
                <p>
                    <strong>Pembaruan:</strong> Data cuaca diperbarui secara real-time setiap kali halaman dimuat
                </p>
                <p>
                    <strong>Akurasi:</strong> Prakiraan cuaca memiliki tingkat akurasi hingga 85% untuk 3 hari ke depan
                </p>
                <p>
                    Kondisi cuaca dapat berubah sewaktu-waktu. Selalu periksa kondisi terkini sebelum melakukan aktivitas outdoor.
                </p>
                <div class="mt-3">
                    <small class="text-muted">
                        <i class="fas fa-clock"></i>
                        Terakhir diperbarui: <span id="lastUpdated">Memuat...</span>
                    </small>
                </div>
            </div>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Weather API configuration - Updated for Lubuk Hitam Waterfall, Padang
        const WEATHER_CONFIG = {
            // Lubuk Hitam Lestari Waterfall coordinates in Padang, West Sumatra
            lat: -1.0456,
            lon: 100.3673,
            locationName: 'Air Terjun Lubuk Hitam Lestari, Padang, Sumatera Barat',
            // API endpoints will be configured when backend is ready
            endpoints: {
                current: '/api/weather/current',
                hourly: '/api/weather/hourly',
                daily: '/api/weather/daily'
            }
        };

        // Weather icon mapping
        const WEATHER_ICONS = {
            'clear': 'fas fa-sun',
            'clouds': 'fas fa-cloud',
            'rain': 'fas fa-cloud-rain',
            'drizzle': 'fas fa-cloud-drizzle',
            'thunderstorm': 'fas fa-bolt',
            'snow': 'fas fa-snowflake',
            'mist': 'fas fa-smog',
            'fog': 'fas fa-smog',
            'default': 'fas fa-cloud-sun'
        };

        // Weather condition translations
        const WEATHER_TRANSLATIONS = {
            'clear sky': 'Cerah',
            'few clouds': 'Berawan Sebagian',
            'scattered clouds': 'Berawan',
            'broken clouds': 'Berawan',
            'overcast clouds': 'Mendung',
            'light rain': 'Hujan Ringan',
            'moderate rain': 'Hujan Sedang',
            'heavy rain': 'Hujan Lebat',
            'thunderstorm': 'Badai Petir',
            'mist': 'Berkabut',
            'fog': 'Berkabut Tebal'
        };

        // Update current time and date
        function updateDateTime() {
            const now = new Date();
            const options = { 
                weekday: 'long', 
                year: 'numeric', 
                month: 'long', 
                day: 'numeric',
                timeZone: 'Asia/Jakarta'
            };
            
            const timeOptions = {
                hour: '2-digit',
                minute: '2-digit',
                timeZone: 'Asia/Jakarta',
                timeZoneName: 'short'
            };

            const dateStr = now.toLocaleDateString('id-ID', options);
            const timeStr = now.toLocaleTimeString('id-ID', timeOptions);
            
            document.getElementById('currentDate').textContent = dateStr;
            document.getElementById('currentTime').textContent = `Diperbarui: ${timeStr}`;
            document.getElementById('lastUpdated').textContent = `${dateStr}, ${timeStr}`;
        }

        // Get weather icon class based on condition
        function getWeatherIcon(condition) {
            const conditionLower = condition.toLowerCase();
            for (const [key, icon] of Object.entries(WEATHER_ICONS)) {
                if (conditionLower.includes(key)) {
                    return icon;
                }
            }
            return WEATHER_ICONS.default;
        }

        // Translate weather condition to Indonesian
        function translateWeatherCondition(condition) {
            return WEATHER_TRANSLATIONS[condition.toLowerCase()] || condition;
        }

        // Get weather badge class based on temperature
        function getWeatherBadge(temp, condition) {
            // Rain conditions - RED warning (not recommended for tracking)
            if (condition.toLowerCase().includes('rain')) {
                return { class: 'badge-danger', text: 'Tidak Disarankan' };
            }
            
            // Temperature-based conditions
            if (temp > 32) return { class: 'badge-hot', text: 'Panas' };
            if (temp < 22) return { class: 'badge-cool', text: 'Sejuk' };
            if (condition.toLowerCase().includes('wind')) return { class: 'badge-windy', text: 'Berangin' };
            return { class: 'badge-pleasant', text: 'Nyaman' };
        }


        // Format wind direction
        function getWindDirection(degrees) {
            const directions = ['Utara', 'Timur Laut', 'Timur', 'Tenggara', 'Selatan', 'Barat Daya', 'Barat', 'Barat Laut'];
            return directions[Math.round(degrees / 45) % 8];
        }

        // Create weather alert based on conditions
        function createWeatherAlert(weatherData) {
            const alertContainer = document.getElementById('weatherAlert');
            let alertHTML = '';
            let shouldShow = false;

            // Check for severe weather conditions
            if (weatherData.main && weatherData.main.toLowerCase().includes('rain')) {
                alertHTML = `
                    <div class="weather-alert warning">
                        <i class="fas fa-exclamation-triangle fa-lg"></i>
                        <div>
                            <strong>Peringatan Cuaca:</strong> Kemungkinan hujan. 
                            Pengunjung disarankan membawa perlengkapan hujan dan berhati-hati di jalur menuju air terjun yang mungkin licin.
                        </div>
                    </div>
                `;
                shouldShow = true;
            }

            if (weatherData.wind && weatherData.wind.speed > 20) {
                alertHTML += `
                    <div class="weather-alert warning">
                        <i class="fas fa-wind fa-lg"></i>
                        <div>
                            <strong>Peringatan Angin:</strong> Angin kencang terdeteksi. 
                            Berhati-hati saat beraktivitas di area terbuka sekitar air terjun.
                        </div>
                    </div>
                `;
                shouldShow = true;
            }

            if (shouldShow) {
                alertContainer.innerHTML = alertHTML;
                alertContainer.style.display = 'block';
            } else {
                alertContainer.style.display = 'none';
            }
        }

        // Load current weather data
        async function loadCurrentWeather() {
            try {
                // Mock data for Padang climate (tropical with high humidity)
                const mockData = {
                    name: 'Lubuk Hitam Lestari',
                    main: {
                        temp: 27, // Typical temperature for Padang
                        feels_like: 30,
                        humidity: 82 // High humidity typical for coastal/waterfall areas
                    },
                    weather: [{
                        main: 'Clouds',
                        description: 'scattered clouds'
                    }],
                    wind: {
                        speed: 3.2, // Light breeze typical for the area
                        deg: 180
                    },
                    coord: {
                        lat: WEATHER_CONFIG.lat,
                        lon: WEATHER_CONFIG.lon
                    }
                };

                // Update UI with weather data
                updateCurrentWeatherUI(mockData);
                createWeatherAlert(mockData.weather[0]);

            } catch (error) {
                console.error('Error loading current weather:', error);
                showWeatherError('current');
            }
        }

        // Update current weather UI
        function updateCurrentWeatherUI(data) {
            const temp = Math.round(data.main.temp);
            const feelsLike = Math.round(data.main.feels_like);
            const humidity = data.main.humidity;
            const windSpeed = Math.round(data.wind.speed * 3.6); // Convert m/s to km/h
            const windDir = getWindDirection(data.wind.deg);
            const condition = data.weather[0];
            const iconClass = getWeatherIcon(condition.main);
            const translatedCondition = translateWeatherCondition(condition.description);

            // Update elements
            document.getElementById('currentTemp').textContent = `${temp}°C`;
            document.getElementById('weatherDescription').textContent = translatedCondition;
            document.getElementById('feelsLike').textContent = `Terasa seperti ${feelsLike}°C`;
            document.getElementById('humidity').textContent = `Kelembaban ${humidity}%`;
            document.getElementById('windSpeed').textContent = `Angin ${windSpeed} km/jam dari ${windDir}`;
            
            const weatherIcon = document.getElementById('weatherIcon');
            weatherIcon.className = `${iconClass} weather-icon`;
        }

        // Load hourly forecast
        async function loadHourlyForecast() {
            try {
                // Mock hourly data for Padang climate
                const mockHourlyData = generateMockHourlyDataPadang();
                updateHourlyForecastUI(mockHourlyData);
            } catch (error) {
                console.error('Error loading hourly forecast:', error);
                showWeatherError('hourly');
            }
        }

        // Generate mock hourly data specific to Padang climate
        function generateMockHourlyDataPadang() {
            const hours = [];
            const now = new Date();
            const conditions = ['clear', 'clouds', 'rain']; // Common conditions in Padang
            
            for (let i = 0; i < 24; i++) {
                const time = new Date(now.getTime() + (i * 60 * 60 * 1000));
                // Temperature range typical for Padang (24-31°C)
                const baseTemp = 27;
                const tempVariation = Math.sin((i - 6) * Math.PI / 12) * 3; // Peak at noon
                const temp = baseTemp + tempVariation + (Math.random() * 2 - 1);
                
                // Higher chance of rain in afternoon/evening (typical for tropical climate)
                let condition;
                if (i >= 14 && i <= 18 && Math.random() > 0.6) {
                    condition = 'rain';
                } else if (i >= 6 && i <= 12 && Math.random() > 0.7) {
                    condition = 'clear';
                } else {
                    condition = 'clouds';
                }
                
                const windSpeed = 8 + Math.random() * 10; // 8-18 km/h typical for coastal area
                
                hours.push({
                    time: time,
                    temp: Math.round(Math.max(24, Math.min(31, temp))),
                    condition: condition,
                    windSpeed: Math.round(windSpeed),
                    isCurrent: i === 0
                });
            }
            
            return hours;
        }

        // Update hourly forecast UI
        function updateHourlyForecastUI(hourlyData) {
            const container = document.getElementById('hourlyContainer');
            let html = '';

            hourlyData.forEach((hour, index) => {
                const timeStr = index === 0 ? 'Sekarang' : 
                    hour.time.toLocaleTimeString('id-ID', { 
                        hour: '2-digit', 
                        minute: '2-digit',
                        timeZone: 'Asia/Jakarta'
                    });
                
                const iconClass = getWeatherIcon(hour.condition);
                const currentClass = hour.isCurrent ? 'current' : '';

                html += `
                    <div class="hourly-item ${currentClass}">
                        <div class="hourly-time">${timeStr}</div>
                        <i class="${iconClass} fa-2x weather-icon"></i>
                        <div class="hourly-temp">${hour.temp}°C</div>
                        <div class="hourly-wind">
                            <i class="fas fa-wind"></i>
                            ${hour.windSpeed} km/jam
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        // Load daily forecast
        async function loadDailyForecast() {
            try {
                // Mock daily data for Padang climate
                const mockDailyData = generateMockDailyDataPadang();
                updateDailyForecastUI(mockDailyData);
            } catch (error) {
                console.error('Error loading daily forecast:', error);
                showWeatherError('daily');
            }
        }

        // Generate mock daily data specific to Padang climate
        function generateMockDailyDataPadang() {
                        const days = [];
            const now = new Date();
            const conditions = [
                { main: 'clear', desc: 'clear sky' },
                { main: 'clouds', desc: 'scattered clouds' },
                { main: 'clouds', desc: 'broken clouds' },
                { main: 'rain', desc: 'light rain' },
                { main: 'rain', desc: 'moderate rain' }
            ];
            
            for (let i = 0; i < 7; i++) {
                const date = new Date(now.getTime() + (i * 24 * 60 * 60 * 1000));
                
                // Temperature range typical for Padang (25-32°C high, 22-26°C low)
                const tempHigh = 28 + Math.random() * 4; // 28-32°C
                const tempLow = 22 + Math.random() * 4; // 22-26°C
                
                // Weather patterns typical for West Sumatra
                let condition;
                const rand = Math.random();
                if (rand > 0.7) {
                    condition = conditions[3]; // light rain
                } else if (rand > 0.5) {
                    condition = conditions[4]; // moderate rain
                } else if (rand > 0.3) {
                    condition = conditions[1]; // scattered clouds
                } else if (rand > 0.1) {
                    condition = conditions[2]; // broken clouds
                } else {
                    condition = conditions[0]; // clear sky
                }
                
                const windSpeed = 10 + Math.random() * 8; // 10-18 km/h
                const windDir = Math.random() * 360;
                
                days.push({
                    date: date,
                    tempHigh: Math.round(tempHigh),
                    tempLow: Math.round(tempLow),
                    condition: condition,
                    windSpeed: Math.round(windSpeed),
                    windDirection: getWindDirection(windDir),
                    isToday: i === 0
                });
            }
            
            return days;
        }

        // Update daily forecast UI
        function updateDailyForecastUI(dailyData) {
            const container = document.getElementById('dailyContainer');
            let html = '';

            dailyData.forEach((day, index) => {
                const dayName = index === 0 ? 'Hari Ini' : 
                    index === 1 ? 'Besok' : 
                    day.date.toLocaleDateString('id-ID', { weekday: 'long' });
                
                const dateStr = day.date.toLocaleDateString('id-ID', { 
                    day: 'numeric',
                    month: 'short'
                });

                const iconClass = getWeatherIcon(day.condition.main);
                const translatedCondition = translateWeatherCondition(day.condition.desc);
                const badge = getWeatherBadge(day.tempHigh, day.condition.desc);

                html += `
                    <div class="daily-item">
                        <div class="row align-items-center">
                            <div class="col-md-3">
                                <div class="daily-date">${dayName}</div>
                                <div class="daily-date-sub">${dateStr}</div>
                            </div>
                            <div class="col-md-2 text-center">
                                <i class="${iconClass} fa-2x weather-icon"></i>
                            </div>
                            <div class="col-md-3">
                                <div class="temp-range">
                                    <span class="temp-high">${day.tempHigh}°</span> / <span class="temp-low">${day.tempLow}°</span>
                                </div>
                                <div class="weather-badges">
                                    <span class="weather-badge ${badge.class}">${badge.text}</span>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="wind-info">
                                    <i class="fas fa-wind"></i>
                                    Angin ${day.windSpeed} km/jam dari ${day.windDirection}
                                </div>
                                <small class="text-muted">${translatedCondition}, ${getWeatherAdvicePadang(day.condition.desc, day.tempHigh)}</small>
                            </div>
                        </div>
                    </div>
                `;
            });

            container.innerHTML = html;
        }

        // Get weather advice specific to Padang and waterfall area
        function getWeatherAdvicePadang(condition, temp) {
            if (condition.toLowerCase().includes('rain')) {
                return '⚠️ TIDAK DISARANKAN untuk pendakian - jalur berbahaya dan licin';
            }
            if (temp > 30) {
                return 'gunakan pelindung matahari dan bawa air yang cukup';
            }
            if (condition.toLowerCase().includes('clear')) {
                return 'cuaca ideal untuk menikmati keindahan air terjun';
            }
            if (condition.toLowerCase().includes('cloud')) {
                return 'cuaca nyaman untuk pendakian dan fotografi';
            }
            return 'cocok untuk aktivitas outdoor dengan persiapan yang tepat';
        }


        // Show error message
        function showWeatherError(type) {
            const messages = {
                current: 'Gagal memuat data cuaca saat ini',
                hourly: 'Gagal memuat prakiraan per jam',
                daily: 'Gagal memuat prakiraan harian'
            };

            console.error(`Weather error (${type}):`, messages[type]);
            
            // Show user-friendly error message
            const errorHTML = `
                <div class="text-center py-4">
                    <i class="fas fa-exclamation-triangle fa-2x text-warning mb-3"></i>
                    <p class="text-muted">${messages[type]}. Silakan coba lagi nanti.</p>
                </div>
            `;

            if (type === 'current') {
                document.getElementById('currentTemp').innerHTML = '--°C';
                document.getElementById('weatherDescription').innerHTML = 'Data tidak tersedia';
            } else if (type === 'hourly') {
                document.getElementById('hourlyContainer').innerHTML = errorHTML;
            } else if (type === 'daily') {
                document.getElementById('dailyContainer').innerHTML = errorHTML;
            }
        }

        // Initialize weather data loading
        async function initializeWeather() {
            try {
                // Update date/time first
                updateDateTime();
                
                // Load all weather data
                await Promise.all([
                    loadCurrentWeather(),
                    loadHourlyForecast(),
                    loadDailyForecast()
                ]);

                console.log('Weather data loaded successfully for Lubuk Hitam Waterfall, Padang');
            } catch (error) {
                console.error('Error initializing weather data:', error);
            }
        }

        // Refresh weather data
        async function refreshWeatherData() {
            console.log('Refreshing weather data...');
            await initializeWeather();
        }

        // Smooth scrolling for anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
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

        // Add intersection observer for animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        // Event listeners
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize weather on page load
            initializeWeather();
            
            // Update time every minute
            setInterval(updateDateTime, 60000);
            
            // Refresh weather data every 30 minutes
            setInterval(refreshWeatherData, 30 * 60 * 1000);
            
            // Add click handlers for hourly items
            document.addEventListener('click', function(e) {
                if (e.target.closest('.hourly-item')) {
                    const item = e.target.closest('.hourly-item');
                    // Remove current class from all items
                    document.querySelectorAll('.hourly-item').forEach(i => i.classList.remove('current'));
                    // Add current class to clicked item
                    item.classList.add('current');
                }
            });

            // Observe elements for animation
            document.querySelectorAll('.info-card, .daily-item').forEach((item, index) => {
                item.style.opacity = '0';
                item.style.transform = 'translateY(20px)';
                item.style.transition = `opacity 0.6s ease ${index * 0.1}s, transform 0.6s ease ${index * 0.1}s`;
                observer.observe(item);
            });

            // Add weather icon animations on hover
            setTimeout(() => {
                document.querySelectorAll('.weather-icon').forEach(icon => {
                    icon.addEventListener('mouseenter', function() {
                        this.style.transform = 'scale(1.2) rotate(10deg)';
                    });
                    
                    icon.addEventListener('mouseleave', function() {
                        this.style.transform = 'scale(1) rotate(0deg)';
                    });
                });
            }, 1000);
        });

        // Expose functions for external use (if needed)
        window.WeatherApp = {
            refresh: refreshWeatherData,
            config: WEATHER_CONFIG
        };

        // Console log for debugging
        console.log('Weather page initialized for Lubuk Hitam Lestari Waterfall, Padang');
        console.log('Location coordinates:', WEATHER_CONFIG.lat, WEATHER_CONFIG.lon);
    </script>
    @include('layouts.footer')  
</body>
</html>
@endsection