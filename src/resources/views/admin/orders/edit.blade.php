@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-xl-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white py-4">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <div class="header-icon me-3">
                                    <i class="fas fa-route fs-3"></i>
                                </div>
                                <div>
                                    <h4 class="mb-0">{{ __('Proses Pesanan Pemandu Wisata') }}</h4>
                                    <small class="opacity-75">ID: #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</small>
                                </div>
                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm">
                                <i class="fas fa-arrow-left me-2"></i>Kembali ke Daftar
                            </a>
                        </div>
                    </div>

                    <div class="card-body p-0">
                        @if (session('status'))
                            <div class="alert alert-success mx-4 mt-4" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('status') }}
                            </div>
                        @endif

                        <!-- Order Information Section -->
                        <div class="order-details-section p-4 bg-light">
                            <h5 class="section-title mb-4">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Informasi Pesanan
                            </h5>

                            <div class="row g-4">
                                <div class="col-lg-6">
                                    <div class="info-group">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-hashtag text-primary"></i>
                                                ID Pesanan
                                            </div>
                                            <div class="info-value">
                                                <span
                                                    class="badge bg-primary fs-6">#{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</span>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-user text-success"></i>
                                                Pengguna
                                            </div>
                                            <div class="info-value">
                                                <strong>{{ $order->user_name }}</strong>
                                                <br>
                                                <small class="text-muted">{{ $order->user_email }}</small>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-route text-info"></i>
                                                Pemandu Wisata
                                            </div>
                                            <div class="info-value">
                                                <strong>{{ $order->tourguide_name }}</strong>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-phone text-warning"></i>
                                                No HP Pemandu
                                            </div>
                                            <div class="info-value">
                                                <a href="tel:{{ $order->tourguide_nohp }}" class="text-decoration-none">
                                                    {{ $order->tourguide_nohp }}
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="info-group">
                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-calendar text-danger"></i>
                                                Tanggal Wisata
                                            </div>
                                            <div class="info-value">
                                                <span class="badge bg-light text-dark fs-6">
                                                    {{ date('d M Y', strtotime($order->tanggal_order)) }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-users text-secondary"></i>
                                                Jumlah Orang
                                            </div>
                                            <div class="info-value">
                                                <span class="badge bg-info fs-6">{{ $order->jumlah_orang }} orang</span>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-money-bill-wave text-success"></i>
                                                Rentang Harga
                                            </div>
                                            <div class="info-value">
                                                <span
                                                    class="badge bg-warning text-dark fs-6">{{ $order->price_range }}</span>
                                            </div>
                                        </div>

                                        <div class="info-item">
                                            <div class="info-label">
                                                <i class="fas fa-flag text-primary"></i>
                                                Status Saat Ini
                                            </div>
                                            <div class="info-value">
                                                @if ($order->status == 'pending')
                                                    <span class="badge bg-warning text-dark fs-6">
                                                        <i class="fas fa-clock me-1"></i>Menunggu
                                                    </span>
                                                @elseif($order->status == 'accepted')
                                                    <span class="badge bg-success fs-6">
                                                        <i class="fas fa-check-circle me-1"></i>Diterima
                                                    </span>
                                                @elseif($order->status == 'rejected')
                                                    <span class="badge bg-danger fs-6">
                                                        <i class="fas fa-times-circle me-1"></i>Ditolak
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Form Section -->
                        <div class="form-section p-4">
                            <h5 class="section-title mb-4">
                                <i class="fas fa-edit text-primary me-2"></i>
                                Proses Pesanan
                            </h5>

                            <form method="POST" action="{{ route('admin.orders.update', $order->id) }}"
                                class="order-form">
                                @csrf
                                @method('PUT')

                                <div class="row g-4">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="final_price" class="form-label fw-bold">
                                                <i class="fas fa-money-bill-wave text-success me-2"></i>
                                                {{ __('Harga Final (Rp)') }}
                                            </label>
                                            <div class="input-group">
                                                <span class="input-group-text">Rp</span>
                                                <input id="final_price" type="number" min="0"
                                                    class="form-control form-control-lg @error('final_price') is-invalid @enderror"
                                                    name="final_price"
                                                    value="{{ old('final_price', $order->final_price) }}" placeholder="0">
                                            </div>
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Wajib diisi jika menerima pesanan
                                            </small>
                                            @error('final_price')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="admin_notes" class="form-label fw-bold">
                                                <i class="fas fa-sticky-note text-info me-2"></i>
                                                {{ __('Catatan Admin') }}
                                            </label>
                                            <textarea id="admin_notes" class="form-control @error('admin_notes') is-invalid @enderror" name="admin_notes"
                                                rows="4" placeholder="Catatan tambahan untuk pengguna (opsional)">{{ old('admin_notes', $order->admin_notes) }}</textarea>
                                            <small class="form-text text-muted">
                                                <i class="fas fa-info-circle me-1"></i>
                                                Catatan ini akan dilihat oleh pengguna
                                            </small>
                                            @error('admin_notes')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Status Selection -->
                                <div class="status-selection-section mt-5">
                                    <label class="form-label fw-bold mb-3">
                                        <i class="fas fa-tasks text-primary me-2"></i>
                                        {{ __('Keputusan') }}
                                    </label>

                                    <div class="row g-3">
                                        <div class="col-md-6">
                                            <button type="submit" name="status" value="accepted"
                                                class="btn btn-success btn-lg w-100 status-btn" id="acceptBtn">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-check-circle fs-4 me-3"></i>
                                                    <div class="text-start">
                                                        <div class="fw-bold">{{ __('Terima Pesanan') }}</div>
                                                        <small class="opacity-75">Setujui dan proses pesanan</small>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>

                                        <div class="col-md-6">
                                            <button type="submit" name="status" value="rejected"
                                                class="btn btn-danger btn-lg w-100 status-btn" id="rejectBtn">
                                                <div class="d-flex align-items-center justify-content-center">
                                                    <i class="fas fa-times-circle fs-4 me-3"></i>
                                                    <div class="text-start">
                                                        <div class="fw-bold">{{ __('Tolak Pesanan') }}</div>
                                                        <small class="opacity-75">Tolak dan batalkan pesanan</small>
                                                    </div>
                                                </div>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .card {
            border-radius: 15px;
            overflow: hidden;
        }

        .card-header {
            border-bottom: none;
        }

        .header-icon {
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 0.75rem;
        }

        .order-details-section {
            border-bottom: 1px solid #e9ecef;
        }

        .info-group {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            height: 100%;
        }

        .info-item {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            padding: 1rem 0;
            border-bottom: 1px solid #f8f9fa;
        }

        .info-item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .info-label {
            font-weight: 600;
            color: #6c757d;
            font-size: 0.9rem;
            min-width: 140px;
            display: flex;
            align-items: center;
        }

        .info-label i {
            margin-right: 0.5rem;
            width: 16px;
        }

        .info-value {
            text-align: right;
            flex: 1;
            margin-left: 1rem;
        }

        .form-section {
            background: white;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .input-group-text {
            background: #f8f9fa;
            border-color: #ced4da;
            font-weight: 600;
        }

        .status-selection-section {
            padding: 2rem;
            background: #f8f9fa;
            border-radius: 10px;
            border: 2px dashed #dee2e6;
        }

        .status-btn {
            padding: 1.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 2px solid transparent;
            position: relative;
            overflow: hidden;
        }

        .status-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        }

        .status-btn:active {
            transform: translateY(-1px);
        }

        .btn-success.status-btn:hover {
            background: linear-gradient(135deg, #28a745, #20c997);
            border-color: #28a745;
        }

        .btn-danger.status-btn:hover {
            background: linear-gradient(135deg, #dc3545, #c82333);
            border-color: #dc3545;
        }

        /* Loading states */
        .status-btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .status-btn.loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .card-header {
                padding: 1.5rem;
            }

            .header-icon {
                width: 50px;
                height: 50px;
            }

            .info-item {
                flex-direction: column;
                align-items: flex-start;
            }

            .info-value {
                text-align: left;
                margin-left: 0;
                margin-top: 0.5rem;
            }

            .status-btn {
                padding: 1rem;
                margin-bottom: 1rem;
            }

            .status-btn .d-flex {
                flex-direction: column;
                text-align: center;
            }

            .status-btn i {
                margin-bottom: 0.5rem;
                margin-right: 0 !important;
            }
        }

        /* Animation for page load */
        .card {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Form validation styling */
        .is-invalid {
            border-color: #dc3545;
        }

        .invalid-feedback {
            display: block;
            width: 100%;
            margin-top: 0.25rem;
            font-size: 0.875rem;
            color: #dc3545;
        }

        /* Badge improvements */
        .badge {
            font-weight: 600;
            padding: 0.5rem 0.75rem;
        }

        /* Alert improvements */
        .alert {
            border: none;
            border-radius: 10px;
            padding: 1rem 1.5rem;
        }

        .alert-success {
            background: linear-gradient(135deg, #d4edda, #c3e6cb);
            color: #155724;
        }

        /* Link styling */
        a[href^="tel:"] {
            color: #007bff;
            font-weight: 600;
        }

        a[href^="tel:"]:hover {
            color: #0056b3;
            text-decoration: underline;
        }

        /* Button back styling */
        .btn-light {
            background: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .btn-light:hover {
            background: white;
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const finalPriceInput = document.getElementById('final_price');
            const acceptBtn = document.getElementById('acceptBtn');
            const rejectBtn = document.getElementById('rejectBtn');
            const form = document.querySelector('.order-form');

            // Format number input
            if (finalPriceInput) {
                finalPriceInput.addEventListener('input', function() {
                    // Remove non-numeric characters except for the decimal point
                    this.value = this.value.replace(/[^0-9]/g, '');
                });

                // Add thousand separators on blur
                finalPriceInput.addEventListener('blur', function() {
                    if (this.value) {
                        const formatted = parseInt(this.value).toLocaleString('id-ID');
                        // Store original value for form submission
                        this.dataset.originalValue = this.value;
                        // Show formatted value
                        this.value = formatted;
                    }
                });

                // Remove formatting on focus
                finalPriceInput.addEventListener('focus', function() {
                    if (this.dataset.originalValue) {
                        this.value = this.dataset.originalValue;
                    }
                });
            }

            // Enhanced form submission with validation
            if (form) {
                form.addEventListener('submit', function(e) {
                    const submitBtn = e.submitter;
                    const status = submitBtn.value;

                    // Restore original value before submission
                    if (finalPriceInput && finalPriceInput.dataset.originalValue) {
                        finalPriceInput.value = finalPriceInput.dataset.originalValue;
                    }

                    // Validation for accepted status
                    if (status === 'accepted') {
                        if (!finalPriceInput.value || parseInt(finalPriceInput.value) <= 0) {
                            e.preventDefault();
                            alert('Harga final wajib diisi untuk pesanan yang diterima!');
                            finalPriceInput.focus();
                            return;
                        }
                    }

                    // Show confirmation dialog
                    const orderId = '{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}';
                    const statusText = status === 'accepted' ? 'menerima' : 'menolak';
                    let confirmMessage = `Apakah Anda yakin ingin ${statusText} pesanan #${orderId}?`;

                    if (status === 'accepted' && finalPriceInput.value) {
                        const finalPrice = parseInt(finalPriceInput.value).toLocaleString('id-ID');
                        confirmMessage += `\n\nHarga final: Rp ${finalPrice}`;
                    }

                    if (!confirm(confirmMessage)) {
                        e.preventDefault();
                        return;
                    }

                    // Show loading state
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;

                    // Disable other button
                    const otherBtn = submitBtn === acceptBtn ? rejectBtn : acceptBtn;
                    otherBtn.disabled = true;

                    // Disable form inputs
                    form.querySelectorAll('input, textarea, button').forEach(element => {
                        if (element !== submitBtn) {
                            element.disabled = true;
                        }
                    });

                    // Change button text
                    const buttonText = submitBtn.querySelector('.fw-bold');
                    if (buttonText) {
                        buttonText.textContent = 'Memproses...';
                    }
                });
            }

            // Add hover effects to info cards
            document.querySelectorAll('.info-group').forEach(card => {
                card.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-2px)';
                    this.style.boxShadow = '0 4px 20px rgba(0, 0, 0, 0.1)';
                });

                card.addEventListener('mouseleave', function() {
                    this.style.transform = 'translateY(0)';
                    this.style.boxShadow = '0 2px 10px rgba(0, 0, 0, 0.05)';
                });
            });

            // Add animation to status buttons
            document.querySelectorAll('.status-btn').forEach(btn => {
                btn.addEventListener('mouseenter', function() {
                    this.style.transform = 'translateY(-3px) scale(1.02)';
                });

                btn.addEventListener('mouseleave', function() {
                    if (!this.classList.contains('loading')) {
                        this.style.transform = 'translateY(0) scale(1)';
                    }
                });
            });

            // Auto-resize textarea
            const textarea = document.getElementById('admin_notes');
            if (textarea) {
                textarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = (this.scrollHeight) + 'px';
                });

                // Initial resize
                textarea.style.height = 'auto';
                textarea.style.height = (textarea.scrollHeight) + 'px';
            }

            // Add smooth scroll to form section when validation fails
            const invalidInputs = document.querySelectorAll('.is-invalid');
            if (invalidInputs.length > 0) {
                invalidInputs[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
                invalidInputs[0].focus();
            }

            // Add success message auto-hide
            const successAlert = document.querySelector('.alert-success');
            if (successAlert) {
                setTimeout(() => {
                    successAlert.style.opacity = '0';
                    successAlert.style.transform = 'translateY(-20px)';
                    setTimeout(() => {
                        successAlert.remove();
                    }, 300);
                }, 5000);
            }

            // Add keyboard shortcuts
            document.addEventListener('keydown', function(e) {
                // Ctrl/Cmd + Enter to accept
                if ((e.ctrlKey || e.metaKey) && e.key === 'Enter') {
                    e.preventDefault();
                    if (acceptBtn && !acceptBtn.disabled) {
                        acceptBtn.click();
                    }
                }

                // Ctrl/Cmd + Shift + Enter to reject
                if ((e.ctrlKey || e.metaKey) && e.shiftKey && e.key === 'Enter') {
                    e.preventDefault();
                    if (rejectBtn && !rejectBtn.disabled) {
                        rejectBtn.click();
                    }
                }
            });

            // Add tooltip for keyboard shortcuts
            if (acceptBtn) {
                acceptBtn.title = 'Shortcut: Ctrl+Enter';
            }
            if (rejectBtn) {
                rejectBtn.title = 'Shortcut: Ctrl+Shift+Enter';
            }

            // Add real-time price calculation display
            if (finalPriceInput) {
                const priceDisplay = document.createElement('div');
                priceDisplay.className = 'mt-2 text-muted small';
                priceDisplay.style.display = 'none';
                finalPriceInput.parentElement.appendChild(priceDisplay);

                finalPriceInput.addEventListener('input', function() {
                    const value = parseInt(this.value);
                    if (value > 0) {
                        priceDisplay.innerHTML =
                            `<i class="fas fa-calculator me-1"></i>Harga: Rp ${value.toLocaleString('id-ID')}`;
                        priceDisplay.style.display = 'block';
                    } else {
                        priceDisplay.style.display = 'none';
                    }
                });
            }
        });
    </script>
@endpush
