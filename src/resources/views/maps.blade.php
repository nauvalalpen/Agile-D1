@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Location Maps</h1>
            <a href="{{ route('admin.maps.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New Location
            </a>
        </div>

        <!-- Map Display -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Interactive Map</h6>
            </div>
            <div class="card-body">
                <div id="mapContainer" style="height: 500px; width: 100%;"></div>
            </div>
        </div>

        <!-- Location List -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Locations</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="locationsTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Type</th>
                                <th>Latitude</th>
                                <th>Longitude</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($locations ?? [] as $location)
                                <tr>
                                    <td>{{ $location->name }}</td>
                                    <td>{{ $location->type }}</td>
                                    <td>{{ $location->latitude }}</td>
                                    <td>{{ $location->longitude }}</td>
                                    <td>{{ Str::limit($location->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('admin.maps.edit', $location->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.maps.show', $location->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.maps.destroy', $location->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this location?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script>
        $(document).ready(function() {
            // Initialize the map
            var map = L.map('mapContainer').setView([-7.9425, 112.9531], 13); // Coordinates for Mount Bromo area

            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            // Add markers for each location
            @foreach ($locations ?? [] as $location)
                L.marker([{{ $location->latitude }}, {{ $location->longitude }}])
                    .addTo(map)
                    .bindPopup("<b>{{ $location->name }}</b><br>{{ $location->description }}")
                    .openPopup();
            @endforeach

            // Initialize datatable
            $('#locationsTable').DataTable();
        });
    </script>
@endpush
