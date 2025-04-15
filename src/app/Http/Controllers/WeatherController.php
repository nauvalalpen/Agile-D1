<?php 

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class WeatherController extends Controller
{
    public function index()
    {
        try {
            $weatherData = $this->getWeather();
            return view('weather', [
                'weatherData' => $weatherData,
                // 'weatherDescriptions' => $this->getWeatherDescriptions()
            ]);
        } catch (\Exception $e) {
            Log::error('Error fetching weather info: ' . $e->getMessage());
            return view('weather', ['error' => 'Unable to fetch weather data']);
        }
    }
    
    private function getWeatherDescriptions()
    {
        return [
            0 => 'Clear sky',
            1 => 'Mainly clear',
            2 => 'Partly cloudy',
            3 => 'Overcast',
            45 => 'Fog',
            48 => 'Depositing rime fog',
            51 => 'Light drizzle',
            53 => 'Moderate drizzle',
            55 => 'Dense drizzle',
            56 => 'Light freezing drizzle',
            57 => 'Dense freezing drizzle',
            61 => 'Slight rain',
            63 => 'Moderate rain',
            65 => 'Heavy rain',
            66 => 'Light freezing rain',
            67 => 'Heavy freezing rain',
            71 => 'Slight snow fall',
            73 => 'Moderate snow fall',
            75 => 'Heavy snow fall',
            77 => 'Snow grains',
            80 => 'Slight rain showers',
            81 => 'Moderate rain showers',
            82 => 'Violent rain showers',
            85 => 'Slight snow showers',
            86 => 'Heavy snow showers',
            95 => 'Thunderstorm',
            96 => 'Thunderstorm with slight hail',
            99 => 'Thunderstorm with heavy hail',
        ];
    }
       

    public function updateWeatherInfo()
    {
        try {
            $weatherData = $this->getWeather();
            return response()->json(['success' => true, 'data' => $weatherData]);
        } catch (\Exception $e) {
            Log::error('Error updating weather info: ' . $e->getMessage());
            return response()->json(['error' => 'Weather update failed'], 500);
        }
    }

    public function getWeather()
    {
        $apiUrl = "https://api.open-meteo.com/v1/forecast?latitude=-0.9492&longitude=100.3543&hourly=temperature_2m,wind_speed_10m&current=temperature_2m,weather_code,rain&timezone=Asia/Bangkok";
        
        $response = Http::get($apiUrl);
        
        if ($response->successful()) {
            return $response->json();
        } else {
            Log::error('Weather API error: ' . $response->status() . ' - ' . $response->body());
            throw new \Exception('Failed to fetch weather data');
        }
    }

}
