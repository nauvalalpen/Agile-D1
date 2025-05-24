@extends('layouts.app')

@section('content')
    <div class="container-fluid py-5" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="text-center mb-5">
                <h1 class="display-4 fw-bold text-white mb-3">Produk UMKM</h1>
                <p class="lead text-white-50">Discover authentic local products from our community</p>
            </div>
        </div>
    </div>

    <div class="container py-5">
        @if ($produkUMKM->count() > 0)
            <div class="row g-4">
                @foreach ($produkUMKM as $produk)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm border-0 product-card">
                            <div class="position-relative overflow-hidden">
                                @if ($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}" class="card-img-top product-image"
                                        alt="{{ $produk->nama }}" style="height: 250px; object-fit: cover;">
                                @else
                                    <div class="card-img-top d-flex align-items-center justify-content-center bg-light"
                                        style="height: 250px;">
                                        <i class="fas fa-image fa-3x text-muted"></i>
                                    </div>
                                @endif
                                <div class="position-absolute top-0 end-0 m-3">
                                    <span class="badge bg-primary rounded-pill">UMKM</span>
                                </div>
                            </div>

                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold text-dark mb-2">{{ $produk->nama }}</h5>
                                <p class="card-text text-muted flex-grow-1">{{ Str::limit($produk->deskripsi, 100) }}</p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <h4 class="text-primary fw-bold mb-0">
                                            Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                        </h4>
                                        <button class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                            data-bs-target="#productModal{{ $produk->id }}">
                                            <i class="fas fa-eye"></i> View Details
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-center mt-5">
                {{ $produkUMKM->links() }}
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-5x text-muted mb-4"></i>
                <h3 class="text-muted">No Products Available</h3>
                <p class="text-muted">Check back later for new UMKM products.</p>
            </div>
        @endif
    </div>

    <!-- Product Detail Modals -->
    @foreach ($produkUMKM as $produk)
        <div class="modal fade" id="productModal{{ $produk->id }}" tabindex="-1"
            aria-labelledby="productModalLabel{{ $produk->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="productModalLabel{{ $produk->id }}">
                            {{ $produk->nama }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-6">
                                @if ($produk->foto)
                                    <img src="{{ asset('storage/' . $produk->foto) }}" class="img-fluid rounded"
                                        alt="{{ $produk->nama }}">
                                @else
                                    <div class="bg-light rounded d-flex align-items-center justify-content-center"
                                        style="height: 300px;">
                                        <i class="fas fa-image fa-5x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h4 class="fw-bold text-primary mb-3">
                                    Rp {{ number_format($produk->harga, 0, ',', '.') }}
                                </h4>
                                <h6 class="fw-bold mb-2">Description:</h6>
                                <p class="text-muted">{{ $produk->deskripsi }}</p>

                                <div class="mt-4">
                                    <button class="btn btn-primary btn-lg w-100">
                                        <i class="fas fa-shopping-cart"></i> Contact Seller
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .product-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15) !important;
        }

        .product-image {
            transition: transform 0.3s ease;
        }

        .product-card:hover .product-image {
            transform: scale(1.05);
        }
    </style>
@endsection
