@extends('layouts.app')

@section('content')
<style>
    :root {
        --green-primary: #228B22;
        --green-light: #90EE90;
        --green-dark: #1a5a1a;
        --white: #ffffff;
        --white-soft: #f8f9fa;
        --shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .verification-container {
        min-height: 100vh;
        background: white;
        display: flex;
        align-items: center;
        padding: 2rem 0;
    }

    .glass-card {
        background: var(--white);
        border: 2px solid var(--green-primary);
        border-radius: 15px;
        padding: 2.5rem;
        box-shadow: var(--shadow);
        max-width: 500px;
        margin: 0 auto;
    }

    .title {
        color: var(--green-primary);
        font-size: 2rem;
        font-weight: 700;
        text-align: center;
        margin-bottom: 1rem;
    }

    .description {
        color: var(--green-dark);
        text-align: center;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .form-label {
        color: var(--green-primary);
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .form-control {
        border: 2px solid var(--green-light);
        border-radius: 8px;
        padding: 12px 15px;
        font-size: 1.1rem;
        transition: all 0.3s ease;
    }

    .form-control:focus {
        border-color: var(--green-primary);
        box-shadow: 0 0 0 0.2rem rgba(34, 139, 34, 0.25);
        outline: none;
    }

    .code-input {
        text-align: center;
        letter-spacing: 0.5rem;
        font-weight: 700;
        font-size: 1.3rem;
    }

    .btn-primary {
        background: var(--green-primary);
        border: 2px solid var(--green-primary);
        color: var(--white);
        padding: 12px 30px;
        border-radius: 8px;
        font-weight: 600;
        transition: all 0.3s ease;
        width: 100%;
    }

    .btn-primary:hover {
        background: var(--green-dark);
        border-color: var(--green-dark);
        transform: translateY(-2px);
    }

    .btn-link {
        color: var(--green-primary);
        text-decoration: none;
        font-weight: 500;
    }

    .btn-link:hover {
        color: var(--green-dark);
        text-decoration: underline;
    }

    .btn-secondary {
        background: var(--white);
        border: 2px solid var(--green-primary);
        color: var(--green-primary);
        padding: 10px 25px;
        border-radius: 8px;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .btn-secondary:hover {
        background: var(--green-primary);
        color: var(--white);
    }

    .alert-success {
        background: var(--green-light);
        border: 1px solid var(--green-primary);
        color: var(--green-dark);
        border-radius: 8px;
        padding: 1rem;
    }

    .alert-danger {
        background: #ffe6e6;
        border: 1px solid #dc3545;
        color: #721c24;
        border-radius: 8px;
        padding: 1rem;
    }

    .divider {
        height: 1px;
        background: var(--green-light);
        margin: 2rem 0;
    }

    .invalid-feedback {
        color: #dc3545;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    @media (max-width: 768px) {
        .verification-container {
            padding: 1rem;
        }
        
        .glass-card {
            padding: 2rem 1.5rem;
        }
        
        .title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="verification-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="glass-card">
                    <h1 class="title">
                        <i class="fas fa-envelope-check me-2"></i>
                        Verifikasi Email
                    </h1>
                    
                    <p class="description">
                        Kami telah mengirimkan kode verifikasi 6 digit ke alamat email Anda. 
                        Masukkan kode tersebut di bawah ini.
                    </p>

                    @if (session('success'))
                        <div class="alert alert-success mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification.verify') }}" id="verificationForm">
                        @csrf

                        <div class="mb-4">
                            <label for="verification_code" class="form-label">
                                <i class="fas fa-key me-2"></i>Kode Verifikasi
                            </label>
                            <input id="verification_code" 
                                   type="text"
                                   class="form-control code-input @error('verification_code') is-invalid @enderror"
                                   name="verification_code" 
                                   required 
                                   maxlength="6" 
                                   placeholder="000000"
                                   autocomplete="off">

                            @error('verification_code')
                                <div class="invalid-feedback">
                                    <i class="fas fa-exclamation-triangle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <button type="submit" class="btn btn-primary" id="verifyBtn">
                                <i class="fas fa-shield-check me-2"></i>
                                <span>Verifikasi Email</span>
                            </button>
                        </div>
                    </form>

                    <div class="divider"></div>

                    <div class="text-center">
                        <p class="mb-3">Tidak menerima kode?</p>
                        
                        <form method="POST" action="{{ route('verification.resend') }}" class="d-inline" id="resendForm">
                            @csrf
                            <input type="hidden" name="email" value="{{ old('email', session('email')) }}">
                            <button type="submit" class="btn btn-link" id="resendBtn">
                                <i class="fas fa-redo me-2"></i>
                                Kirim Ulang Kode
                            </button>
                        </form>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left me-2"></i>
                            Kembali ke Login
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const codeInput = document.getElementById('verification_code');
    const verifyBtn = document.getElementById('verifyBtn');
    const resendBtn = document.getElementById('resendBtn');

    // Auto-focus and number only input
    if (codeInput) {
        codeInput.focus();
        
        codeInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
            
            if (this.value.length === 6) {
                setTimeout(() => {
                    document.getElementById('verificationForm').submit();
                }, 300);
            }
        });
    }
    
    // Handle form submissions with loading states
    document.getElementById('verificationForm').addEventListener('submit', function() {
        verifyBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memverifikasi...';
        verifyBtn.disabled = true;
    });
    
    document.getElementById('resendForm').addEventListener('submit', function() {
        resendBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Mengirim...';
        resendBtn.disabled = true;
    });
});
</script>
@endsection
