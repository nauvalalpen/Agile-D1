@extends('layouts.app')

@section('title', 'Login - OneVision')

@section('content')
    <div class="min-vh-100 d-flex align-items-center justify-content-center py-5"
        style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-5">
                    <div class="card shadow-lg border-0" style="border-radius: 1rem;">
                        <div class="card-body p-5">
                            <!-- Logo/Brand -->
                            <div class="text-center mb-4">
                                <div class="mb-3">
                                    <i class="fas fa-eye text-primary" style="font-size: 3rem;"></i>
                                </div>
                                <h2 class="fw-bold text-dark mb-2">Welcome Back</h2>
                                <p class="text-muted">Sign in to your OneVision account</p>
                            </div>

                            <!-- Social Login Buttons -->
                            <div class="d-flex justify-content-center align-items-center mb-4 gap-3">
                                <a href="{{ route('auth.google') }}"
                                    class="btn btn-outline-danger d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; border-radius: 50%;" title="Login with Google">
                                    <i class="fab fa-google fa-lg"></i>
                                </a>
                                <button type="button"
                                    class="btn btn-outline-primary d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; border-radius: 50%;" title="Email Login" disabled>
                                    <i class="fas fa-envelope fa-lg"></i>
                                </button>
                                <button type="button"
                                    class="btn btn-outline-dark d-flex align-items-center justify-content-center"
                                    style="width: 50px; height: 50px; border-radius: 50%;" title="Coming Soon" disabled>
                                    <i class="fab fa-apple fa-lg"></i>
                                </button>
                            </div>

                            <div class="text-center mb-4">
                                <small class="text-muted">Or continue with email</small>
                                <hr class="my-3">
                            </div>

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('login') }}" id="loginForm">
                                @csrf

                                <!-- Email Field -->
                                <div class="mb-3">
                                    <label for="email" class="form-label fw-medium">{{ __('Email Address') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-envelope text-muted"></i>
                                        </span>
                                        <input id="email" type="email"
                                            class="form-control border-start-0 @error('email') is-invalid @enderror"
                                            name="email" value="{{ old('email') }}" required autocomplete="email"
                                            autofocus placeholder="Enter your email">
                                    </div>
                                    @error('email')
                                        <div class="invalid-feedback d-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Password Field -->
                                <div class="mb-3">
                                    <label for="password" class="form-label fw-medium">{{ __('Password') }}</label>
                                    <div class="input-group">
                                        <span class="input-group-text bg-light border-end-0">
                                            <i class="fas fa-lock text-muted"></i>
                                        </span>
                                        <input id="password" type="password"
                                            class="form-control border-start-0 border-end-0 @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="current-password"
                                            placeholder="Enter your password">
                                        <button class="btn btn-outline-secondary border-start-0" type="button"
                                            id="togglePassword">
                                            <i class="fas fa-eye" id="togglePasswordIcon"></i>
                                        </button>
                                    </div>
                                    @error('password')
                                        <div class="invalid-feedback d-block">
                                            <strong>{{ $message }}</strong>
                                        </div>
                                    @enderror
                                </div>

                                <!-- Remember Me & Forgot Password -->
                                <div class="d-flex justify-content-between align-items-center mb-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="text-decoration-none" href="{{ route('password.request') }}">
                                            {{ __('Forgot Password?') }}
                                        </a>
                                    @endif
                                </div>

                                <!-- Submit Button -->
                                <div class="d-grid mb-3">
                                    <button type="submit" class="btn btn-primary btn-lg fw-medium" id="loginBtn">
                                        <i class="fas fa-sign-in-alt me-2"></i>
                                        {{ __('Sign In') }}
                                    </button>
                                </div>
                            </form>

                            <!-- Register Link -->
                            <div class="text-center">
                                <p class="mb-0">Don't have an account?
                                    <a href="{{ route('register') }}" class="text-decoration-none fw-medium">
                                        Create one here
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <!-- Additional Info -->
                    <div class="text-center mt-4">
                        <small class="text-white-50">
                            By signing in, you agree to our
                            <a href="#" class="text-white">Terms of Service</a> and
                            <a href="#" class="text-white">Privacy Policy</a>
                        </small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .card {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, 0.95);
        }

        .input-group-text {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
        }

        .form-control {
            border: 1px solid #dee2e6;
            padding: 0.75rem 1rem;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.25);
        }

        .btn-primary {
            background: linear-gradient(135deg, #0d6efd, #0b5ed7);
            border: none;
            padding: 0.75rem 1.5rem;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0b5ed7, #0a58ca);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(13, 110, 253, 0.4);
        }

        .btn-outline-danger:hover {
            background-color: #dc3545;
            border-color: #dc3545;
            color: white;
        }

        .btn-outline-primary:hover:not(:disabled) {
            background-color: #0d6efd;
            border-color: #0d6efd;
            color: white;
        }

        .btn-outline-dark:hover:not(:disabled) {
            background-color: #212529;
            border-color: #212529;
            color: white;
        }

        .social-login-btn {
            transition: all 0.3s ease;
        }

        .social-login-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        @media (max-width: 576px) {
            .card-body {
                padding: 2rem !important;
            }

            .social-login-btn {
                width: 45px !important;
                height: 45px !important;
            }
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            const toggleIcon = document.getElementById('togglePasswordIcon');

            if (togglePassword && passwordInput && toggleIcon) {
                togglePassword.addEventListener('click', function() {
                    const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                    passwordInput.setAttribute('type', type);

                    if (type === 'text') {
                        toggleIcon.classList.remove('fa-eye');
                        toggleIcon.classList.add('fa-eye-slash');
                    } else {
                        toggleIcon.classList.remove('fa-eye-slash');
                        toggleIcon.classList.add('fa-eye');
                    }
                });
            }

            // Form submission handling
            const loginForm = document.getElementById('loginForm');
            const loginBtn = document.getElementById('loginBtn');

            if (loginForm && loginBtn) {
                loginForm.addEventListener('submit', function() {
                    const originalText = loginBtn.innerHTML;
                    loginBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm me-2"></span>Signing In...';
                    loginBtn.disabled = true;

                    // Re-enable button after 10 seconds as fallback
                    setTimeout(() => {
                        loginBtn.innerHTML = originalText;
                        loginBtn.disabled = false;
                    }, 10000);
                });
            }

            // Auto-focus on email field
            const emailInput = document.getElementById('email');
            if (emailInput && !emailInput.value) {
                emailInput.focus();
            }

            // Add loading state to social login buttons
            document.querySelectorAll('a[href*="auth/google"]').forEach(button => {
                button.addEventListener('click', function() {
                    const originalHTML = this.innerHTML;
                    this.innerHTML = '<span class="spinner-border spinner-border-sm"></span>';
                    this.style.pointerEvents = 'none';

                    // Fallback to restore button
                    setTimeout(() => {
                        this.innerHTML = originalHTML;
                        this.style.pointerEvents = 'auto';
                    }, 5000);
                });
            });
        });
    </script>
@endsection
