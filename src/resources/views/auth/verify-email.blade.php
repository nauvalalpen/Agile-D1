@extends('layouts.app')

@section('content')
<style>
    /* Glass morphism styles consistent with index.blade.php */
    .glass-section {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
    }

    .glass-card {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.15), rgba(255, 255, 255, 0.05));
        backdrop-filter: blur(15px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 15px;
        padding: 2rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .glass-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 30px rgba(0, 0, 0, 0.15);
    }

    .btn-glass {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.1));
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        color: white;
        padding: 12px 24px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
        display: inline-block;
    }

    .btn-glass:hover {
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.2));
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        color: white;
    }

    .btn-glass-primary {
        background: linear-gradient(135deg, rgba(74, 144, 226, 0.8), rgba(74, 144, 226, 0.6));
        border: 1px solid rgba(74, 144, 226, 0.5);
    }

    .btn-glass-primary:hover {
        background: linear-gradient(135deg, rgba(74, 144, 226, 0.9), rgba(74, 144, 226, 0.7));
        color: white;
    }

    .btn-glass-link {
        background: transparent;
        border: none;
        color: rgba(255, 255, 255, 0.8);
        text-decoration: underline;
        padding: 0;
    }

    .btn-glass-link:hover {
        color: white;
        background: transparent;
        transform: none;
        box-shadow: none;
    }

    .form-control-glass {
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.3);
        border-radius: 10px;
        color: white;
        padding: 12px 16px;
        backdrop-filter: blur(10px);
        transition: all 0.3s ease;
    }

    .form-control-glass:focus {
        background: rgba(255, 255, 255, 0.15);
        border-color: rgba(74, 144, 226, 0.8);
        box-shadow: 0 0 0 0.2rem rgba(74, 144, 226, 0.25);
        color: white;
    }

    .form-control-glass::placeholder {
        color: rgba(255, 255, 255, 0.6);
    }

    .form-label-glass {
        color: rgba(255, 255, 255, 0.9);
        font-weight: 500;
        margin-bottom: 8px;
    }

    .alert-glass {
        background: linear-gradient(135deg, rgba(40, 167, 69, 0.2), rgba(40, 167, 69, 0.1));
        border: 1px solid rgba(40, 167, 69, 0.3);
        border-radius: 10px;
        color: rgba(255, 255, 255, 0.9);
        backdrop-filter: blur(10px);
    }

    .alert-glass.alert-danger {
        background: linear-gradient(135deg, rgba(220, 53, 69, 0.2), rgba(220, 53, 69, 0.1));
        border-color: rgba(220, 53, 69, 0.3);
    }

    .verification-container {
        min-height: 100vh;
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        display: flex;
        align-items: center;
        padding: 2rem 0;
    }

    .verification-title {
        color: white;
        font-size: 2rem;
        font-weight: 600;
        margin-bottom: 1rem;
        text-align: center;
    }

    .verification-subtitle {
        color: rgba(255, 255, 255, 0.8);
        text-align: center;
        margin-bottom: 2rem;
        line-height: 1.6;
    }

    .code-input {
        font-size: 1.2rem;
        text-align: center;
        letter-spacing: 0.5rem;
        font-weight: 600;
    }

    .divider {
        height: 1px;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        margin: 2rem 0;
    }

    .resend-section {
        text-align: center;
        color: rgba(255, 255, 255, 0.8);
    }

    .invalid-feedback {
        color: #ff6b6b;
        font-size: 0.875rem;
        margin-top: 0.5rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .verification-container {
            padding: 1rem;
        }
        
        .glass-card {
            padding: 1.5rem;
        }
        
        .verification-title {
            font-size: 1.5rem;
        }
    }
</style>

<div class="verification-container">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="glass-card">
                    <h1 class="verification-title">Verifikasi Email Anda</h1>
                    
                    <p class="verification-subtitle">
                        Kami telah mengirimkan kode verifikasi 6 digit ke alamat email Anda. 
                        Silakan masukkan kode tersebut di bawah ini untuk memverifikasi akun Anda.
                    </p>

                    @if (session('success'))
                        <div class="alert alert-glass mb-4" role="alert">
                            <i class="fas fa-check-circle me-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-glass alert-danger mb-4" role="alert">
                            <i class="fas fa-exclamation-circle me-2"></i>
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('verification.verify') }}">
                        @csrf

                        <div class="mb-4">
                            <label for="verification_code" class="form-label form-label-glass">
                                <i class="fas fa-key me-2"></i>Kode Verifikasi
                            </label>
                            <input id="verification_code" 
                                   type="text"
                                   class="form-control form-control-glass code-input @error('verification_code') is-invalid @enderror"
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

                        <div class="d-grid mb-4">
                            <button type="submit" class="btn btn-glass btn-glass-primary">
                                <i class="fas fa-shield-check me-2"></i>
                                Verifikasi Email
                            </button>
                        </div>
                    </form>

                    <div class="divider"></div>

                    <div class="resend-section">
                        <p class="mb-3">
                            <i class="fas fa-question-circle me-2"></i>
                            Tidak menerima kode verifikasi?
                        </p>
                        
                        <form method="POST" action="{{ route('verification.resend') }}" class="d-inline">
                            @csrf
                            <input type="hidden" name="email" value="{{ old('email', session('email')) }}">
                            <button type="submit" class="btn btn-glass btn-glass-link">
                                <i class="fas fa-redo me-2"></i>
                                Kirim Ulang Kode Verifikasi
                            </button>
                        </form>
                    </div>

                    <div class="text-center mt-4">
                        <a href="{{ route('login') }}" class="btn btn-glass">
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
    // Auto-focus on verification code input
    const codeInput = document.getElementById('verification_code');
    if (codeInput) {
        codeInput.focus();
        
        // Only allow numbers
        codeInput.addEventListener('input', function(e) {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
        
        // Auto-submit when 6 digits are entered
        codeInput.addEventListener('input', function(e) {
            if (this.value.length === 6) {
                // Add a small delay for better UX
                setTimeout(() => {
                    this.closest('form').submit();
                }, 500);
            }
        });
    }
    
    // Add loading state to buttons
    document.querySelectorAll('form').forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = this.querySelector('button[type="submit"]');
            if (submitBtn) {
                const originalText = submitBtn.innerHTML;
                submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>Memproses...';
                submitBtn.disabled = true;
                
                // Re-enable after 5 seconds as fallback
                setTimeout(() => {
                    submitBtn.innerHTML = originalText;
                    submitBtn.disabled = false;
                }, 5000);
            }
        });
    });
    
    // Show success notification if verification was successful
    @if(session('success'))
        setTimeout(() => {
            // You can add a toast notification here if you have one
            console.log('Verification successful!');
        }, 100);
    @endif
});
</script>
@endsection
