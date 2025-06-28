@extends('layouts.admin')
@section('content')
<div class="weather-dashboard">
    <h2>Informasi Cuaca</h2>
    <div class="weather-info">
        <div class="card">
            <h3>Suhu Saat Ini</h3>
            <p>{{ $weather->temperature }}°C</p>
        </div>
        <div class="card">
            <h3>Curah Hujan</h3>
            <p>{{ $weather->rainfall }} mm</p>
        </div>
    </div>
</div>
@endsection
