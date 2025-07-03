@extends('layouts.app')

@section('content')
    <div class="order-page">
        <div class="container py-5">
            <div class="row justify-content-center g-4">

                <!-- Tour Guide Summary Card -->
                <div class="col-lg-5">
                    <div class="guide-summary-card">
                        <div class="card-body">
                            <div class="guide-profile-section">
                                <div class="guide-image-container">
                                    @if ($tourguide->foto)
                                        <img src="{{ asset('storage/' . $tourguide->foto) }}" class="guide-image"
                                            alt="{{ $tourguide->nama }}">
                                    @else
                                        <div class="guide-image-placeholder">
                                            <i class="fas fa-user"></i>
                                        </div>
                                    @endif
                                    <div class="guide-status-badge">
                                        <i class="fas fa-circle"></i>
                                        <span>Tersedia</span>
                                    </div>
                                </div>

                                <div class="guide-info">
                                    <h4 class="guide-name">{{ $tourguide->nama }}</h4>
                                </div>
                            </div>

                            <div class="guide-description">
                                <p>{{ $tourguide->deskripsi }}</p>
                            </div>

                            <div class="guide-details-grid">
                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-phone"></i>
                                    </div>
                                    <div class="detail-content">
                                        <span class="detail-label">Telepon</span>
                                        <span class="detail-value">{{ $tourguide->nohp }}</span>
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </div>
                                    <div class="detail-content">
                                        <span class="detail-label">Lokasi</span>
                                        <span class="detail-value">{{ $tourguide->alamat }}</span>
                                    </div>
                                </div>

                                <div class="detail-item">
                                    <div class="detail-icon">
                                        <i class="fas fa-dollar-sign"></i>
                                    </div>
                                    <div class="detail-content">
                                        <span class="detail-label">Informasi Harga</span>
                                        <span class="detail-value">{{ $tourguide->price_range }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Order Form Card -->
                <div class="col-lg-7">
                    <div class="order-form-card">
                        <div class="card-body">
                            <h3 class="form-title">
                                <i class="fas fa-calendar-check me-2"></i>
                                Detail Pemesanan Pemandu Wisata
                            </h3>

                            @if (session('status'))
                                <div class="alert alert-success">
                                    <i class="fas fa-check-circle me-2"></i>
                                    {{ session('status') }}
                                </div>
                            @endif

                            <form method="POST" action="{{ route('tourguides.orderSubmit', $tourguide->id) }}"
                                id="orderForm">
                                @csrf

                                <!-- Date Selection -->
                                <div class="form-group">
                                    <label for="tanggal_order" class="form-label">
                                        <i class="fas fa-calendar me-2"></i>
                                        {{ __('Tanggal Pemesanan') }}
                                    </label>
                                    <input id="tanggal_order" type="date"
                                        class="form-control @error('tanggal_order') is-invalid @enderror"
                                        name="tanggal_order" value="{{ old('tanggal_order') }}" required>
                                    @error('tanggal_order')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Number of People -->
                                <div class="form-group">
                                    <label for="jumlah_orang" class="form-label">
                                        <i class="fas fa-users me-2"></i>
                                        {{ __('Jumlah Rombongan') }}
                                    </label>
                                    <div class="number-input-container">
                                        <input id="jumlah_orang" type="number" min="1" max="20"
                                            class="form-control number-input @error('jumlah_orang') is-invalid @enderror"
                                            name="jumlah_orang" value="{{ old('jumlah_orang', 1) }}" required>
                                    </div>
                                    @error('jumlah_orang')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Additional Notes -->
                                <div class="form-group">
                                    <label for="notes" class="form-label">
                                        <i class="fas fa-sticky-note me-2"></i>
                                        {{ __('Catatan') }}
                                        <span class="optional-text">(Opsional)</span>
                                    </label>
                                    <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes" rows="4"
                                        maxlength="500" placeholder="Tulis permintaan khusus Anda disini...">{{ old('notes') }}</textarea>
                                    <div class="character-counter">
                                        <span id="charCount">0</span>/500 karakter
                                    </div>
                                    @error('notes')
                                        <div class="invalid-feedback">
                                            <i class="fas fa-exclamation-circle me-1"></i>
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <!-- Form Actions -->
                                <div class="form-actions">
                                    <a href="{{ url()->previous() }}" class="btn-secondary-action">
                                        <i class="fas fa-arrow-left me-2"></i>
                                        {{ __('Kembali') }}
                                    </a>
                                    <button type="submit" class="btn-primary-action" id="submitBtn">
                                        <i class="fas fa-check-circle me-2"></i>
                                        {{ __('Pesan Sekarang') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        /* === GLOBAL STYLES === */
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(180deg, #e8eee8 0%, #fafbfa 30%, #e4eee4);
            min-height: 100vh;
            margin: 0;
            padding: 0;
            line-height: 1.6;
        }

        /* === MAIN CONTAINER === */
        .container {
            max-width: 1300px;
            margin: 0 auto;
            padding: 0.2rem;
        }

        /* === CARD STYLES === */
        .guide-summary-card,
        .order-form-card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.3);
            overflow: hidden;
            transition: all 0.3s ease;
            height: 100%;
            backdrop-filter: blur(20px);
        }

        .guide-summary-card:hover,
        .order-form-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.15);
        }

        .card-body {
            padding: 2rem;
        }

        .form-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d5a3d;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
        }

        /* === GUIDE PROFILE SECTION === */
        .guide-profile-section {
            display: flex;
            gap: 1.5rem;
            margin-bottom: 2rem;
            align-items: center;
        }

        .guide-image-container {
            position: relative;
            flex-shrink: 0;
        }

        .guide-image {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid rgba(34, 139, 34, 0.3);
            transition: all 0.3s ease;
        }

        .guide-image:hover {
            transform: scale(1.05);
            border-color: #228B22;
        }

        .guide-image-placeholder {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            background: linear-gradient(135deg, #228B22 0%, #32CD32 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            border: 4px solid rgba(34, 139, 34, 0.3);
        }

        .guide-status-badge {
            position: absolute;
            bottom: 5px;
            right: 5px;
            background: #28a745;
            color: white;
            padding: 0.25rem 0.5rem;
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            box-shadow: 0 2px 8px rgba(40, 167, 69, 0.3);
        }

        .guide-status-badge i {
            font-size: 0.5rem;
            animation: pulse 2s infinite;
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.5;
            }
        }

        .guide-info {
            flex: 1;
        }

        .guide-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d5a3d;
            margin-bottom: 0.5rem;
        }

        .guide-rating {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .stars {
            display: flex;
            gap: 0.125rem;
        }

        .stars i {
            color: #ffc107;
            font-size: 0.875rem;
        }

        .rating-text {
            font-size: 0.875rem;
            color: #6c757d;
            font-weight: 500;
        }

        /* === GUIDE DESCRIPTION === */
        .guide-description {
            margin-bottom: 2rem;
        }

        .guide-description p {
            color: #495057;
            line-height: 1.6;
            margin: 0;
        }

        /* === GUIDE DETAILS GRID === */
        .guide-details-grid {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .detail-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem;
            background: rgba(34, 139, 34, 0.1);
            border-radius: 12px;
            transition: all 0.3s ease;
            border: 1px solid rgba(34, 139, 34, 0.2);
        }

        .detail-item:hover {
            background: rgba(34, 139, 34, 0.15);
            transform: translateX(5px);
        }

        .detail-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #228B22, #32CD32);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 0.875rem;
            flex-shrink: 0;
        }

        .detail-content {
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .detail-label {
            font-size: 0.75rem;
            color: #6c757d;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .detail-value {
            font-size: 0.95rem;
            color: #2d5a3d;
            font-weight: 600;
        }

        /* === FORM STYLES === */
        .form-group {
            margin-bottom: 2rem;
        }

        .form-label {
            display: flex;
            align-items: center;
            font-weight: 600;
            color: #2d5a3d;
            margin-bottom: 0.75rem;
            font-size: 1rem;
        }

        .optional-text {
            font-size: 0.75rem;
            color: #6c757d;
            font-weight: 400;
            margin-left: 0.5rem;
        }

        .form-control {
            border: 2px solid rgba(34, 139, 34, 0.2);
            border-radius: 12px;
            padding: 1rem 1.25rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.8);
            color: #2d5a3d;
        }

        .form-control::placeholder {
            color: rgba(45, 90, 61, 0.6);
        }

        .form-control:focus {
            border-color: #228B22;
            box-shadow: 0 0 0 0.25rem rgba(34, 139, 34, 0.25);
            outline: none;
            background: white;
        }

        .form-control:hover {
            border-color: rgba(34, 139, 34, 0.4);
            background: white;
        }

        /* === NUMBER INPUT === */
        .number-input-container {
            display: flex;
            align-items: center;
            gap: 0;
            background: rgba(255, 255, 255, 0.8);
            border: 2px solid rgba(34, 139, 34, 0.2);
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .number-input-container:hover {
            border-color: rgba(34, 139, 34, 0.4);
            background: white;
        }

        .number-input-container:focus-within {
            border-color: #228B22;
            box-shadow: 0 0 0 0.25rem rgba(34, 139, 34, 0.25);
        }

        .number-btn {
            background: rgba(34, 139, 34, 0.1);
            border: none;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #228B22;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .number-btn:hover:not(:disabled) {
            background: #228B22;
            color: white;
        }

        .number-btn:disabled {
            opacity: 0.3;
            cursor: not-allowed;
        }

        .number-input {
            border: none;
            text-align: center;
            font-weight: 600;
            font-size: 1.1rem;
            flex: 1;
            padding: 1rem;
            background: transparent;
            color: #2d5a3d;
        }

        .number-input:focus {
            outline: none;
            box-shadow: none;
        }

        /* === CHARACTER COUNTER === */
        .character-counter {
            text-align: right;
            font-size: 0.75rem;
            color: #6c757d;
            margin-top: 0.5rem;
        }

        /* === FORM ACTIONS === */
        .form-actions {
            display: flex;
            gap: 1rem;
            margin-top: 2rem;
        }

        .btn-primary-action {
            flex: 1;
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
            color: white;
            border: none;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 8px 25px rgba(34, 139, 34, 0.3);
        }

        .btn-primary-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 35px rgba(34, 139, 34, 0.4);
        }

        .btn-primary-action:active {
            transform: translateY(0);
        }

        .btn-secondary-action {
            background: rgba(91, 109, 91, 0.1);
            color: #228B22;
            border: 2px solid rgba(34, 139, 34, 0.2);
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .btn-secondary-action:hover {
            background: rgba(34, 139, 34, 0.2);
            border-color: rgba(34, 139, 34, 0.4);
            color: #228B22;
            text-decoration: none;
            transform: translateY(-1px);
        }

        /* === ALERT STYLES === */
        .alert {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.5rem;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
        }

        .alert-success {
            background: rgba(16, 185, 129, 0.1);
            color: #065f46;
            border: 1px solid rgba(16, 185, 129, 0.3);
        }

        /* === INVALID FEEDBACK === */
        .invalid-feedback {
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        /* === LOADING STATE === */
        .btn-primary-action.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .btn-primary-action.loading::after {
            content: '';
            width: 16px;
            height: 16px;
            border: 2px solid transparent;
            border-top: 2px solid currentColor;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-left: 0.5rem;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 992px) {
            .guide-profile-section {
                flex-direction: column;
                text-align: center;
            }

            .guide-image,
            .guide-image-placeholder {
                width: 120px;
                height: 120px;
            }

            .form-actions {
                flex-direction: column;
            }

            .btn-secondary-action {
                order: -1;
            }
        }

        @media (max-width: 768px) {
            .container {
                padding: 1rem;
            }

            .card-body {
                padding: 1.5rem;
            }

            .guide-details-grid {
                gap: 0.75rem;
            }

            .detail-item {
                padding: 0.75rem;
            }

            .form-actions {
                gap: 0.75rem;
            }

            .btn-primary-action,
            .btn-secondary-action {
                padding: 0.875rem 1.5rem;
                font-size: 1rem;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 0.5rem;
            }

            .card-body {
                padding: 1rem;
            }

            .guide-image,
            .guide-image-placeholder {
                width: 100px;
                height: 100px;
            }

            .detail-item {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .detail-content {
                align-items: center;
            }

            .number-input-container {
                max-width: 200px;
                margin: 0 auto;
            }

            .form-actions {
                flex-direction: column;
                gap: 1rem;
            }

            .btn-primary-action,
            .btn-secondary-action {
                width: 100%;
                justify-content: center;
            }
        }

        /* === ANIMATIONS === */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        .guide-summary-card {
            animation: slideInLeft 0.8s ease-out;
        }

        .order-form-card {
            animation: slideInRight 0.8s ease-out;
        }

        /* === ACCESSIBILITY === */
        .form-control:focus,
        .btn-primary-action:focus,
        .btn-secondary-action:focus,
        .number-btn:focus {
            outline: 2px solid #228B22;
            outline-offset: 2px;
        }

        /* === REDUCED MOTION === */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }

            .guide-summary-card:hover,
            .order-form-card:hover {
                transform: none;
            }
        }

        /* === HIDE NAVBAR/HEADER === */
        .navbar,
        .header,
        nav {
            display: flex !important;
        }

        /* === FULL PAGE LAYOUT === */
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
        }

        .order-page {
            width: 100%;
            margin: 0;
            padding: 0;
        }
    </style>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Number input controls
            const numberInput = document.getElementById('jumlah_orang');

            window.decreaseNumber = function() {
                const currentValue = parseInt(numberInput.value);
                if (currentValue > 1) {
                    numberInput.value = currentValue - 1;
                }
                updateButtonStates();
            };

            window.increaseNumber = function() {
                const currentValue = parseInt(numberInput.value);
                if (currentValue < 20) {
                    numberInput.value = currentValue + 1;
                }
                updateButtonStates();
            };

            function updateButtonStates() {
                const currentValue = parseInt(numberInput.value);
                const minusBtn = document.querySelector('.number-btn.minus');
                const plusBtn = document.querySelector('.number-btn.plus');

                minusBtn.disabled = currentValue <= 1;
                plusBtn.disabled = currentValue >= 20;
            }

            // Character counter for notes
            const notesTextarea = document.getElementById('notes');
            const charCount = document.getElementById('charCount');

            if (notesTextarea && charCount) {
                notesTextarea.addEventListener('input', function() {
                    const currentLength = this.value.length;
                    charCount.textContent = currentLength;

                    if (currentLength > 450) {
                        charCount.style.color = '#dc3545';
                    } else if (currentLength > 400) {
                        charCount.style.color = '#ffc107';
                    } else {
                        charCount.style.color = '#6c757d';
                    }
                });
            }

            // Form submission with loading state
            const form = document.getElementById('orderForm');
            const submitBtn = document.getElementById('submitBtn');

            if (form && submitBtn) {
                form.addEventListener('submit', function() {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                });
            }

            // Date input validation (prevent past dates)
            const dateInput = document.getElementById('tanggal_order');
            if (dateInput) {
                const today = new Date().toISOString().split('T')[0];
                dateInput.setAttribute('min', today);
            }

            // Initialize button states
            updateButtonStates();

            // Smooth scroll to form if there are validation errors
            @if ($errors->any())
                document.querySelector('.order-form-card').scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            @endif

            // Auto-resize textarea
            if (notesTextarea) {
                notesTextarea.addEventListener('input', function() {
                    this.style.height = 'auto';
                    this.style.height = this.scrollHeight + 'px';
                });
            }

            console.log('Order form initialized successfully');
        });
    </script>
@endsection
