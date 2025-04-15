@extends('layouts.admin')
@section('content')
<div class="weather-dashboard">
    <h2>Weather Information</h2>
    <div class="weather-info">
        <div class="card">
            <h3>Current Temperature</h3>
            <p>{{ $weather->temperature }}°C</p>
        </div>
        <div class="card">
            <h3>Rainfall</h3>
            <p>{{ $weather->rainfall }} mm</p>
        </div>
    </div>
</div>
@endsection
