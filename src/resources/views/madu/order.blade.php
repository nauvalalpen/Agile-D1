@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Order Honey Product</h4>
                    </div>
                    <div class="card-body">
                        <div class="row mb-4">
                            <div class="col-md-4">
                                @if ($madu->gambar)
                                    <img src="{{ asset('storage/' . $madu->gambar) }}" class="img-fluid rounded"
                                        alt="{{ $madu->nama_madu }}">
                                @else
                                    <div class="bg-light text-center py-5 rounded">
                                        <i class="fas fa-image fa-5x text-muted"></i>
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $madu->nama_madu }}</h4>
                                <p class="text-muted">Size: {{ $madu->ukuran }}</p>
                                <p class="h5 text-primary">Rp {{ number_format($madu->harga, 0, ',', '.') }}</p>
                                <p>{{ Str::limit($madu->deskripsi, 150) }}</p>
                                <p class="mb-0">
                                    <span class="badge bg-{{ $madu->stock > 10 ? 'success' : 'warning' }}">
                                        Stock: {{ $madu->stock }}
                                    </span>
                                </p>
                            </div>
                        </div>

                        <form action="{{ route('madu.orderSubmit', $madu->id) }}" method="POST">
                            @csrf

                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Quantity</label>
                                <input type="number" class="form-control @error('jumlah') is-invalid @enderror"
                                    id="jumlah" name="jumlah" value="{{ old('jumlah', 1) }}" min="1"
                                    max="{{ $madu->stock }}" required>
                                <div class="form-text">Maximum available: {{ $madu->stock }}</div>
                                @error('jumlah')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="tanggal" class="form-label">Pickup Date</label>
                                <input type="date" class="form-control @error('tanggal') is-invalid @enderror"
                                    id="tanggal" name="tanggal"
                                    value="{{ old('tanggal', date('Y-m-d', strtotime('+1 day'))) }}"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                                <div class="form-text">Please select a date starting from tomorrow.</div>
                                @error('tanggal')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-4">
                                <div class="card bg-light">
                                    <div class="card-body">
                                        <h5 class="card-title">Order Summary</h5>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Price per item:</span>
                                            <span>Rp {{ number_format($madu->harga, 0, ',', '.') }}</span>
                                        </div>
                                        <div class="d-flex justify-content-between mb-2">
                                            <span>Quantity:</span>
                                            <span id="summary-quantity">1</span>
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between fw-bold">
                                            <span>Total:</span>
                                            <span id="summary-total">Rp
                                                {{ number_format($madu->harga, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary">Place Order</button>
                                <a href="{{ route('madu.index') }}" class="btn btn-outline-secondary">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const jumlahInput = document.getElementById('jumlah');
            const summaryQuantity = document.getElementById('summary-quantity');
            const summaryTotal = document.getElementById('summary-total');
            const pricePerItem = {{ $madu->harga }};

            // Update summary when quantity changes
            jumlahInput.addEventListener('input', function() {
                const quantity = parseInt(this.value) || 0;
                const total = quantity * pricePerItem;

                summaryQuantity.textContent = quantity;
                summaryTotal.textContent = 'Rp ' + total.toLocaleString('id-ID');
            });
        });
    </script>
@endsection
