@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="text-center mb-4">Honey Products</h1>
                <p class="text-center lead">Discover our premium honey products from Desa Wisata Kampung Budaya Polowijen</p>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row">
            @forelse ($madus as $madu)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        @if ($madu->gambar)
                            <img src="{{ asset('storage/' . $madu->gambar) }}" class="card-img-top"
                                alt="{{ $madu->nama_madu }}" style="height: 200px; object-fit: cover;">
                        @else
                            <div class="bg-light text-center py-5">
                                <i class="fas fa-image fa-3x text-muted"></i>
                            </div>
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $madu->nama_madu }}</h5>
                            <p class="card-text text-muted">{{ $madu->ukuran }}</p>
                            <p class="card-text">{{ Str::limit($madu->deskripsi, 100) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="h5 mb-0 text-primary">Rp {{ number_format($madu->harga, 0, ',', '.') }}</span>
                                <span
                                    class="badge bg-{{ $madu->stock > 10 ? 'success' : ($madu->stock > 0 ? 'warning' : 'danger') }}">
                                    {{ $madu->stock > 0 ? 'Stock: ' . $madu->stock : 'Out of Stock' }}
                                </span>
                            </div>
                        </div>
                        <div class="card-footer bg-white border-top-0">
                            <div class="d-grid">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#detailModal{{ $madu->id }}">
                                    View Details
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Detail Modal -->
                <div class="modal fade" id="detailModal{{ $madu->id }}" tabindex="-1"
                    aria-labelledby="detailModalLabel{{ $madu->id }}" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="detailModalLabel{{ $madu->id }}">{{ $madu->nama_madu }}
                                </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        @if ($madu->gambar)
                                            <img src="{{ asset('storage/' . $madu->gambar) }}" class="img-fluid rounded"
                                                alt="{{ $madu->nama_madu }}">
                                        @else
                                            <div class="bg-light text-center py-5 rounded">
                                                <i class="fas fa-image fa-5x text-muted"></i>
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <h4>{{ $madu->nama_madu }}</h4>
                                        <p class="text-muted">Size: {{ $madu->ukuran }}</p>
                                        <p class="h5 text-primary mb-3">Rp {{ number_format($madu->harga, 0, ',', '.') }}
                                        </p>
                                        <p>{{ $madu->deskripsi }}</p>

                                        <div class="d-flex align-items-center mb-3">
                                            <span class="me-2">Availability:</span>
                                            <span
                                                class="badge bg-{{ $madu->stock > 10 ? 'success' : ($madu->stock > 0 ? 'warning' : 'danger') }}">
                                                {{ $madu->stock > 0 ? 'In Stock (' . $madu->stock . ' available)' : 'Out of Stock' }}
                                            </span>
                                        </div>

                                        @if ($madu->stock > 0)
                                            @auth
                                                <a href="{{ route('madu.order', $madu->id) }}" class="btn btn-primary">
                                                    Order Now
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}" class="btn btn-outline-primary">
                                                    Login to Order
                                                </a>
                                            @endauth
                                        @else
                                            <button class="btn btn-secondary" disabled>Out of Stock</button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center">
                        <h4 class="alert-heading">No Honey Products Available</h4>
                        <p>We're currently updating our inventory. Please check back later.</p>
                    </div>
                </div>
            @endforelse
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Comprehensive fix for modal backdrop issues
            const fixModalBackdrop = () => {
                // Remove all backdrop elements
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });

                // Reset body styles
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            };

            // Add event listeners to all modal close buttons
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(fixModalBackdrop, 500);
                });
            });

            // Add event listeners to all modals for when they're hidden
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(fixModalBackdrop, 500);
                });

                // Also handle the case where the modal is closed by clicking outside
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        setTimeout(fixModalBackdrop, 500);
                    }
                });
            });

            // Handle ESC key press
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    setTimeout(fixModalBackdrop, 500);
                }
            });

            // Additional safety measure: periodically check for orphaned backdrops
            setInterval(function() {
                if (!document.querySelector('.modal.show') && document.querySelector('.modal-backdrop')) {
                    fixModalBackdrop();
                }
            }, 2000);
        });
    </script>
@endsection
