@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4 text-center">Gallery</h1>

        <div class="row">
            @forelse ($galleries as $gallery)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if ($gallery->foto)
                            <img src="{{ asset('storage/' . $gallery->foto) }}" class="card-img-top"
                                alt="{{ $gallery->judul }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center py-5">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $gallery->judul }}</h5>
                            <h6 class="card-subtitle mb-2 text-muted">{{ \Carbon\Carbon::parse($gallery->tanggal)->format('d M Y') }}</h6>
                            <p class="card-text">{{ Str::limit($gallery->deskripsi, 150) }}</p>
                        </div>
                        <div class="card-footer bg-transparent">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#galleryModal{{ $gallery->id }}">
                                View Details
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Modal for gallery details -->
                <div class="modal fade" id="galleryModal{{ $gallery->id }}" tabindex="-1"
                    aria-labelledby="galleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="galleryModalLabel{{ $gallery->id }}">
                                    {{ $gallery->judul }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($gallery->foto)
                                            <img src="{{ asset('storage/' . $gallery->foto) }}" class="img-fluid rounded"
                                                alt="{{ $gallery->judul }}">
                                        @else
                                            <div class="bg-light text-center py-5 rounded">
                                                <i class="fas fa-image fa-5x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h5>Date</h5>
                                        <p>{{ \Carbon\Carbon::parse($gallery->tanggal)->format('d M Y') }}</p>
                                        <h5>Description</h5>
                                        <p>{{ $gallery->deskripsi }}</p>
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
                    <h3>No gallery items available at the moment</h3>
                    <small class="form-text text-muted">please check back later.</small>
                </div>
            @endforelse
        </div>
    </div>
@endsection
