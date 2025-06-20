@extends('layouts.app')

@section('content')
    <div class="order-container">

        <!-- Order Card -->
        <div class="order-card">
            <!-- Header -->
            <div class="card-header">
                <h1>Place Your Order</h1>
                <p>Complete your honey purchase</p>
            </div>

            <!-- Product Info -->
            <div class="product-section">
                <div class="product-image">
                    @if($madu->gambar)
                        <img src="{{ asset('storage/' . $madu->gambar) }}" alt="{{ $madu->nama }}">
                    @else
                        <div class="no-image">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </div>
                <div class="product-details">
                    <h2>{{ $madu->nama }}</h2>
                    <div class="price">Rp {{ number_format($madu->harga, 0, ',', '.') }}</div>
                    <div class="stock">{{ $madu->stock }} in stock</div>
                </div>
            </div>

            <!-- Order Form -->
            <form action="{{ route('madu.orderSubmit', $madu->id) }}" method="POST" class="order-form">
                @csrf
                
                <div class="form-grid">
                    <div class="input-group">
                        <label>Full Name</label>
                        <input type="text" name="nama" value="{{ auth()->user()->name ?? '' }}" required>
                    </div>

                    <div class="input-group">
                        <label>Email</label>
                        <input type="email" name="email" value="{{ auth()->user()->email ?? '' }}" required>
                    </div>

                    <div class="input-group">
                        <label>Phone Number</label>
                        <input type="tel" name="telepon" required>
                    </div>

                    <div class="input-group">
                        <label>Quantity</label>
                        <input type="number" name="jumlah" id="quantity" value="1" min="1" max="{{ $madu->stock }}" required>
                    </div>

                    <div class="input-group">
                        <label>Pickup Date</label>
                        <input type="date" name="tanggal" min="{{ date('Y-m-d', strtotime('+1 day')) }}" required>
                    </div>

                </div>

                <!-- Order Summary -->
                <div class="summary">
                    <div class="summary-row">
                        <span>Price per item</span>
                        <span>Rp {{ number_format($madu->harga, 0, ',', '.') }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Quantity</span>
                        <span id="qty-display">1</span>
                    </div>
                    <div class="summary-row total">
                        <span>Total</span>
                        <span id="total-price">Rp {{ number_format($madu->harga, 0, ',', '.') }}</span>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="action-buttons">
                    <button type="button" class="cancel-btn" onclick="cancelOrder()">
                        <i class="fas fa-times"></i>
                        Cancel
                    </button>
                    <button type="submit" class="order-btn">
                        <i class="fas fa-shopping-cart"></i>
                        Place Order
                    </button>
                </div>
            </form>
        </div>
    </div>

    <style>
        .order-container {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem 1rem;
            min-height: 100vh;
        }

        .order-card {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .card-header {
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .card-header h1 {
            margin: 0 0 0.5rem 0;
            font-size: 2rem;
            font-weight: 700;
        }

        .card-header p {
            margin: 0;
            opacity: 0.9;
            font-size: 1.1rem;
        }

        .product-section {
            display: flex;
            gap: 1.5rem;
            padding: 2rem;
            border-bottom: 1px solid #e5e7eb;
        }

        .product-image {
            width: 100px;
            height: 100px;
            border-radius: 12px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 100%;
            background: #f3f4f6;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #9ca3af;
            font-size: 2rem;
        }

        .product-details h2 {
            margin: 0 0 0.5rem 0;
            font-size: 1.5rem;
            font-weight: 600;
            color: #111827;
        }

        .price {
            font-size: 1.5rem;
            font-weight: 700;
            color: #f59e0b;
            margin-bottom: 0.25rem;
        }

        .stock {
            color: #10b981;
            font-weight: 500;
        }

        .order-form {
            padding: 2rem;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .input-group {
            display: flex;
            flex-direction: column;
        }

        .input-group.full-width {
            grid-column: 1 / -1;
        }

        .input-group label {
            font-weight: 600;
            color: #374151;
            margin-bottom: 0.5rem;
            font-size: 0.875rem;
        }

        .input-group input,
        .input-group textarea {
            padding: 0.75rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.2s ease;
        }

        .input-group input:focus,
        .input-group textarea:focus {
            outline: none;
            border-color: #f59e0b;
            box-shadow: 0 0 0 3px rgba(245, 158, 11, 0.1);
        }

        .summary {
            background: #f9fafb;
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.5rem 0;
        }

        .summary-row.total {
            border-top: 1px solid #e5e7eb;
            margin-top: 0.5rem;
            padding-top: 1rem;
            font-weight: 700;
            font-size: 1.125rem;
            color: #f59e0b;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
        }

        .cancel-btn {
            flex: 1;
            background: #f3f4f6;
            color: #6b7280;
            border: 1px solid #d1d5db;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1.125rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .cancel-btn:hover {
            background: #e5e7eb;
            color: #374151;
            transform: translateY(-1px);
        }

        .order-btn {
            flex: 2;
            background: linear-gradient(135deg, #f59e0b, #d97706);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-size: 1.125rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .order-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
        }

        .order-btn:active,
        .cancel-btn:active {
            transform: translateY(0);
        }

        @media (max-width: 768px) {
            .order-container {
                padding: 1rem;
            }

            .card-header {
                padding: 1.5rem;
            }

            .card-header h1 {
                font-size: 1.5rem;
            }

            .product-section {
                flex-direction: column;
                text-align: center;
                padding: 1.5rem;
            }

            .product-image {
                width: 80px;
                height: 80px;
                margin: 0 auto;
            }

            .form-grid {
                grid-template-columns: 1fr;
                gap: 1rem;
            }

            .order-form {
                padding: 1.5rem;
            }

            .action-buttons {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .card-header h1 {
                font-size: 1.25rem;
            }

            .product-details h2 {
                font-size: 1.25rem;
            }

            .price {
                font-size: 1.25rem;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const quantityInput = document.getElementById('quantity');
            const totalPriceElement = document.getElementById('total-price');
            const qtyDisplayElement = document.getElementById('qty-display');
            const productPrice = {{ $madu->harga }};

            function updateTotal() {
                const quantity = parseInt(quantityInput.value) || 1;
                const total = productPrice * quantity;
                totalPriceElement.textContent = `Rp ${new Intl.NumberFormat('id-ID').format(total)}`;
                qtyDisplayElement.textContent = quantity;
            }

            quantityInput.addEventListener('input', updateTotal);
        });

        function cancelOrder() {
            if (confirm('Are you sure you want to cancel this order?')) {
                window.location.href = '{{ route("madu.index") }}';
            }
        }
    </script>
@endsection
