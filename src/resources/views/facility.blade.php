@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center">Our Facilities</h1>

        <div class="row">
            @forelse ($facilities as $facility)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($facility->foto)
                            <img src="{{ asset('storage/' . $facility->foto) }}" class="card-img-top"
                                alt="{{ $facility->nama_fasilitas }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center py-5">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $facility->nama_fasilitas }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ $facility->lokasi }}</h6>
                            <p class="card-text">{{ Str::limit($facility->deskripsi, 150) }}</p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#facilityModal{{ $facility->id }}">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal for facility details -->
                <div class="modal fade" id="facilityModal{{ $facility->id }}" tabindex="-1"
                    aria-labelledby="facilityModalLabel{{ $facility->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="facilityModalLabel{{ $facility->id }}">
                                    {{ $facility->nama_fasilitas }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($facility->foto)
                                            <img src="{{ asset('storage/' . $facility->foto) }}" class="img-fluid rounded"
                                                alt="{{ $facility->nama_fasilitas }}">
                                        @else
                                            <div class="bg-light text-center py-5 rounded">
                                                <i class="fas fa-image fa-5x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Location</h5>
                                        <p>{{ $facility->lokasi }}</p>
                                        <h5>Description</h5>
                                        <p>{{ $facility->deskripsi }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <h3>No facilities available at the moment.</h3>
                    <p>Please check back later for updates.</p>
                </div>
            @endforelse
        </div>
    </div>
@endsection
