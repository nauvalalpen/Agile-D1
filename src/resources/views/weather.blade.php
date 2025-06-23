<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Forecast</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #f5f7fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .weather-card {
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s;
        }

        .weather-card:hover {
            transform: translateY(-5px);
        }

        .current-weather {
            background: linear-gradient(to right, #4facfe, #00f2fe);
            color: white;
            padding: 20px;
        }

        .hourly-forecast {
            overflow-x: auto;
            white-space: nowrap;
            padding: 15px 0;
        }

        .hourly-item {
            display: inline-block;
            text-align: center;
            padding: 10px 15px;
            min-width: 100px;
            border-right: 1px solid #eee;
        }

        .hourly-item:last-child {
            border-right: none;
        }

        .daily-forecast {
            margin-top: 20px;
        }

        .daily-item {
            padding: 15px;
            border-bottom: 1px solid #eee;
        }

        .daily-item:last-child {
            border-bottom: none;
        }

        .weather-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .temp-high {
            color: #ff6b6b;
        }

        .temp-low {
            color: #4facfe;
        }

        .wind-speed {
            color: #868e96;
        }

        /* Weather icons based on WMO codes */
        .wmo-0 {
            content: "☀️";
        }

        /* Clear sky */
        .wmo-1,
        .wmo-2,
        .wmo-3 {
            content: "🌤️";
        }

        /* Partly cloudy */
        .wmo-45,
        .wmo-48 {
            content: "🌫️";
        }

        /* Fog */
        .wmo-51,
        .wmo-53,
        .wmo-55 {
            content: "🌦️";
        }

        /* Drizzle */
        .wmo-61,
        .wmo-63,
        .wmo-65 {
            content: "🌧️";
        }

        /* Rain */
        .wmo-71,
        .wmo-73,
        .wmo-75 {
            content: "❄️";
        }

        /* Snow */
        .wmo-80,
        .wmo-81,
        .wmo-82 {
            content: "🌦️";
        }

        /* Rain showers */
        .wmo-95,
        .wmo-96,
        .wmo-99 {
            content: "⛈️";
        }

        /* Thunderstorm */
    </style>
</head>

<body>
    @extends('layouts.app')

    @section('title', 'Contact Us - oneVision')

    @section('content')
        {{-- First Section of page as static --}}
        <section class="hero-section">
            <div class="hero-content">
                <div class="hero-title">WEATHER<br>REALTIME</div>
                <div class="hero-desc">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</div>
                <a href="/weatherf" class="hero-btn">More info</a>
            </div>
        </section>
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-md-10">
                    <div class="weather-card mb-4">
                        <div class="current-weather">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2 class="mb-0">Current Weather</h2>
                                    <p class="mb-2">{{ date('l, F j, Y', strtotime($weatherData['current']['time'])) }}
                                    </p>
                                    <p class="mb-0">{{ date('g:i A', strtotime($weatherData['current']['time'])) }}</p>
                                    <h3 class="display-4 mt-3">
                                        {{ $weatherData['hourly']['temperature_2m'][array_search(date('Y-m-d\TH:00', strtotime($weatherData['current']['time'])), $weatherData['hourly']['time'])] }}{{ $weatherData['hourly_units']['temperature_2m'] }}
                                    </h3>

                                    @php
                                        $weatherCode = $weatherData['current']['weather_code'];
                                        $weatherDescription = '';

                                        // Map WMO weather codes to descriptions
                                        switch ($weatherCode) {
                                            case 0:
                                                $weatherDescription = 'Clear sky';
                                                $weatherIcon = '☀️';
                                                break;
                                            case 1:
                                                $weatherDescription = 'Mainly clear';
                                                $weatherIcon = '🌤️';
                                                break;
                                            case 2:
                                                $weatherDescription = 'Partly cloudy';
                                                $weatherIcon = '⛅';
                                                break;
                                            case 3:
                                                $weatherDescription = 'Overcast';
                                                $weatherIcon = '☁️';
                                                break;
                                            case 45:
                                            case 48:
                                                $weatherDescription = 'Fog';
                                                $weatherIcon = '🌫️';
                                                break;
                                            case 51:
                                            case 53:
                                            case 55:
                                                $weatherDescription = 'Drizzle';
                                                $weatherIcon = '🌦️';
                                                break;
                                            case 61:
                                            case 63:
                                            case 65:
                                                $weatherDescription = 'Rain';
                                                $weatherIcon = '🌧️';
                                                break;
                                            case 71:
                                            case 73:
                                            case 75:
                                                $weatherDescription = 'Snow';
                                                $weatherIcon = '❄️';
                                                break;
                                            case 80:
                                            case 81:
                                            case 82:
                                                $weatherDescription = 'Rain showers';
                                                $weatherIcon = '🌦️';
                                                break;
                                            case 95:
                                            case 96:
                                            case 99:
                                                $weatherDescription = 'Thunderstorm';
                                                $weatherIcon = '⛈️';
                                                break;
                                            default:
                                                $weatherDescription = 'Unknown';
                                                $weatherIcon = '❓';
                                        }

                                        $currentHourIndex = array_search(
                                            date('Y-m-d\TH:00', strtotime($weatherData['current']['time'])),
                                            $weatherData['hourly']['time'],
                                        );
                                        $currentWindSpeed = $weatherData['hourly']['wind_speed_10m'][$currentHourIndex];
                                    @endphp

                                    <div class="d-flex align-items-center mt-3">
                                        <span style="font-size: 3rem;">{{ $weatherIcon }}</span>
                                        <div class="ms-3">
                                            <h4>{{ $weatherDescription }}</h4>
                                            <p class="mb-0">Wind: {{ $currentWindSpeed }}
                                                {{ $weatherData['hourly_units']['wind_speed_10m'] }}</p>
                                            <p class="mb-0">Rain: {{ $weatherData['current']['rain'] }}
                                                {{ $weatherData['current_units']['rain'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="text-md-end mt-4 mt-md-0">
                                        <h4>{{ $weatherData['timezone'] }}</h4>
                                        <p>Lat: {{ $weatherData['latitude'] }}, Long: {{ $weatherData['longitude'] }}</p>
                                        <p>Elevation: {{ $weatherData['elevation'] }}m</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            <h3 class="mb-3">Hourly Forecast</h3>
                            <div class="hourly-forecast">
                                @php
                                    // Get current date to show only today's forecast
$currentDate = date('Y-m-d', strtotime($weatherData['current']['time']));
$nextDay = date('Y-m-d', strtotime($currentDate . ' +1 day'));

// Find starting index (current hour)
$startIndex = array_search(
    date('Y-m-d\TH:00', strtotime($weatherData['current']['time'])),
    $weatherData['hourly']['time'],
);
if ($startIndex === false) {
    $startIndex = 0;
}

// Show next 24 hours
$endIndex = min($startIndex + 24, count($weatherData['hourly']['time']) - 1);
                                @endphp

                                @for ($i = $startIndex; $i <= $endIndex; $i++)
                                    <div class="hourly-item">
                                        <div class="time">
                                            {{ date('g A', strtotime($weatherData['hourly']['time'][$i])) }}</div>
                                        <div class="temp">
                                            {{ $weatherData['hourly']['temperature_2m'][$i] }}{{ $weatherData['hourly_units']['temperature_2m'] }}
                                        </div>
                                        <div class="wind-speed">
                                            <i class="fas fa-wind"></i> {{ $weatherData['hourly']['wind_speed_10m'][$i] }}
                                            {{ $weatherData['hourly_units']['wind_speed_10m'] }}
                                        </div>
                                    </div>
                                @endfor
                            </div>
                        </div>
                    </div>

                    <div class="weather-card">
                        <div class="card-body">
                            <h3 class="mb-3">7-Day Forecast</h3>
                            <div class="daily-forecast">
                                @php
                                    // Group hourly data by day to create daily forecast
                                    $dailyData = [];
                                    $currentDay = '';
                                    $tempMin = PHP_INT_MAX;
                                    $tempMax = PHP_INT_MIN;
                                    $windAvg = 0;
                                    $windCount = 0;
                                    $dayDate = '';

                                    foreach ($weatherData['hourly']['time'] as $index => $time) {
                                        $day = date('Y-m-d', strtotime($time));

                                        if ($currentDay != $day) {
                                            if ($currentDay != '') {
                                                $dailyData[$currentDay] = [
                                                    'date' => $dayDate,
                                                    'temp_min' => $tempMin,
                                                    'temp_max' => $tempMax,
                                                    'wind_avg' => $windCount > 0 ? $windAvg / $windCount : 0,
                                                ];
                                            }

                                            $currentDay = $day;
                                            $tempMin = PHP_INT_MAX;
                                            $tempMax = PHP_INT_MIN;
                                            $windAvg = 0;
                                            $windCount = 0;
                                            $dayDate = $time;
                                        }

                                        $temp = $weatherData['hourly']['temperature_2m'][$index];
                                        $wind = $weatherData['hourly']['wind_speed_10m'][$index];

                                        $tempMin = min($tempMin, $temp);
                                        $tempMax = max($tempMax, $temp);
                                        $windAvg += $wind;
                                        $windCount++;
                                    }

                                    // Add the last day
                                    if ($currentDay != '') {
                                        $dailyData[$currentDay] = [
                                            'date' => $dayDate,
                                            'temp_min' => $tempMin,
                                            'temp_max' => $tempMax,
                                            'wind_avg' => $windCount > 0 ? $windAvg / $windCount : 0,
                                        ];
                                    }

                                    // Limit to 7 days
                                    $dailyData = array_slice($dailyData, 0, 7, true);
                                @endphp

                                @foreach ($dailyData as $day => $data)
                                    <div class="daily-item">
                                        <div class="row align-items-center">
                                            <div class="col-md-3">
                                                <h5 class="mb-0">{{ date('l', strtotime($data['date'])) }}</h5>
                                                <p class="mb-0 text-muted">{{ date('M j', strtotime($data['date'])) }}</p>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <span
                                                    class="temp-high">{{ round($data['temp_max']) }}{{ $weatherData['hourly_units']['temperature_2m'] }}</span>
                                                /
                                                <span
                                                    class="temp-low">{{ round($data['temp_min']) }}{{ $weatherData['hourly_units']['temperature_2m'] }}</span>
                                            </div>
                                            <div class="col-md-3 text-center">
                                                <i class="fas fa-wind me-2"></i>
                                                <span>{{ round($data['wind_avg'], 1) }}
                                                    {{ $weatherData['hourly_units']['wind_speed_10m'] }}</span>
                                            </div>
                                            <div class="col-md-3 text-md-end">
                                                @if ($data['temp_max'] > 30)
                                                    <span class="badge bg-danger">Hot</span>
                                                @elseif ($data['temp_min'] < 20)
                                                    <span class="badge bg-info text-dark">Cool</span>
                                                @else
                                                    <span class="badge bg-success">Pleasant</span>
                                                @endif

                                                @if ($data['wind_avg'] > 10)
                                                    <span class="badge bg-warning text-dark">Windy</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 text-center text-muted">
                        <p>Weather data provided by Open-Meteo API</p>
                        <p>Last updated: {{ date('F j, Y g:i A', strtotime($weatherData['current']['time'])) }}</p>
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.footer')
    @endsection

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get current hour to highlight in hourly forecast
            const currentHour = new Date().getHours();
            const hourlyItems = document.querySelectorAll('.hourly-item');

            hourlyItems.forEach((item, index) => {
                const itemHour = new Date(
                    "{{ $weatherData['hourly']['time'][0] }}"
                ).getHours() + index;

                if (itemHour % 24 === currentHour) {
                    item.style.backgroundColor = 'rgba(79, 172, 254, 0.1)';
                    item.style.borderRadius = '10px';
                    item.style.fontWeight = 'bold';
                }
            });

            // Responsive adjustments
            const adjustLayout = () => {
                if (window.innerWidth < 768) {
                    document.querySelectorAll('.daily-item .text-md-end').forEach(el => {
                        el.classList.add('mt-2');
                    });
                } else {
                    document.querySelectorAll('.daily-item .text-md-end').forEach(el => {
                        el.classList.remove('mt-2');
                    });
                }
            };

            window.addEventListener('resize', adjustLayout);
            adjustLayout();
        });
    </script>
</body>

<style>
    /* Fonts */
    h2.section-title,
    h3.section-title,
    h4.hot-topic-title,
    h6.news-title {
        font-family: 'Montserrat', sans-serif;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    p.hot-topic-desc,
    small,
    a.read-more-link {
        font-family: 'Poppins', sans-serif;
    }

    /* HOT TOPIC */
    .hot-topic-img-wrapper {
        height: 500px;
        /* diperbesar dari 400px */
        position: relative;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .hot-topic-img-wrapper:hover {
        transform: scale(1.03);
        box-shadow: 0 20px 35px rgba(0, 0, 0, 0.35);
    }

    .hot-topic-img {
        height: 100%;
        width: 100%;
        object-fit: cover;
        border-radius: 1.25rem;
        transition: transform 0.3s ease;
    }

    .hot-topic-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 2rem;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.75), transparent);
        border-bottom-left-radius: 1.25rem;
        border-bottom-right-radius: 1.25rem;
    }

    .hot-topic-title {
        font-size: 2rem;
        /* lebih besar */
        margin-bottom: 0.5rem;
        color: #fff;
    }

    .hot-topic-meta {
        font-size: 1rem;
        color: #ddd;
    }

    .hot-topic-desc {
        font-size: 1.2rem;
        line-height: 1.6;
        color: #eee;
        margin-top: 0.5rem;
    }

    .btn-read-more {
        margin-top: 1rem;
        font-size: 1.1rem;
        padding: 0.75rem 1.75rem;
    }

    /* LATEST NEWS */
    .card {
        border-radius: 1rem;
        transition: box-shadow 0.3s ease;
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
    }

    .news-img {
        height: 250px;
        /* diperbesar */
        width: 100%;
        object-fit: cover;
        border-top-left-radius: 1rem;
        border-top-right-radius: 1rem;
        transition: transform 0.3s ease;
    }

    .hover-shadow:hover .news-img {
        transform: scale(1.05);
    }

    .card-body {
        padding: 1.25rem;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .news-title {
        font-size: 1.25rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        color: #222;
        flex-grow: 1;
    }

    .news-meta {
        font-size: 0.95rem;
        color: #777;
        margin-top: auto;
        font-style: italic;
    }

    /* RESPONSIVE - Skala turun bertahap */
    @media (max-width: 992px) {
        .hot-topic-img-wrapper {
            height: 400px;
        }

        .news-img {
            height: 200px;
        }

        .news-title {
            font-size: 1.1rem;
        }
    }

    @media (max-width: 768px) {
        .hot-topic-img-wrapper {
            height: 300px;
        }

        .news-img {
            height: 160px;
        }

        .hot-topic-title {
            font-size: 1.5rem;
        }

        .hot-topic-desc {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .news-img {
            height: 140px;
        }

        .news-title {
            font-size: 1rem;
        }
    }

    /* ==== BUTTON "READ MORE" ==== */
    .btn-read-more {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 12px 30px;
        background: linear-gradient(135deg, #0d6efd, #0056b3);
        color: #fff;
        font-weight: 600;
        font-size: 1.05rem;
        border: none;
        border-radius: 50px;
        text-decoration: none;
        transition: all 0.3s ease-in-out;
        box-shadow: 0 8px 20px rgba(13, 110, 253, 0.3);
        gap: 0.5rem;
    }

    .btn-read-more:hover {
        background: linear-gradient(135deg, #0046b3, #003580);
        transform: translateY(-3px);
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
    }

    .btn-arrow {
        transition: transform 0.3s ease;
        font-weight: bold;
        font-size: 1.2rem;
    }

    .btn-read-more:hover .btn-arrow {
        transform: translateX(6px);
    }


    /* content   */
    body,
    html {
        margin: 0;
        padding: 0;
        font-family: 'Helvetica Neue', sans-serif;
    }

    .hero-section {
        position: relative;
        background: linear-gradient(to right, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.2)),
            url('/images/hero.jpg') no-repeat center center/cover;
        height: 80vh;
        color: white;
        display: flex;
        align-items: center;
        justify-content: flex-start;
        /* Default for desktop */
        overflow: hidden;
        transition: height 0.3s ease;
        /* Smooth height transition */
    }

    .hero-content {
        width: 100%;
        max-width: 1140px;
        padding: 0 30px 0 350px;
        /* Default desktop padding */
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 1.2s ease forwards;
        animation-delay: 0.3s;
        transition: padding 0.3s ease;
        /* Smooth padding transition */
    }

    @keyframes fadeInUp {
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }


    .hero-title {
        font-size: 80px;
        /* besar dan dominan */
        font-weight: 900;
        line-height: 1.1;
        margin-bottom: 20px;
        letter-spacing: 30px;
        /* jarak antar huruf */
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
</style>

</html>
