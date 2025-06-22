<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login' }} - OneVision</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            background-image: url('{{ asset('images/bg.png') }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .bg-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: -1;
        }

        .auth-card {
            background-color: #ffffff;
            border-radius: 20px;
            padding: 3rem 2.5rem;
            box-shadow: 0 0 30px rgba(0, 0, 0, 0.25);
            max-width: 500px;
            width: 100%;
        }

        .auth-card h4 {
            font-weight: bold;
        }

        .form-control,
        .form-select {
            border-radius: 25px;
            padding: 0.8rem 1rem;
            font-size: 1.05rem;
        }

        .input-group .form-control {
            border-radius: 25px 0 0 25px;
        }

        .input-group .btn {
            border-radius: 0 25px 25px 0;
        }

        .btn-custom {
            border-radius: 25px;
            padding: 0.8rem;
            font-size: 1.1rem;
            background-color: black;
            color: white;
        }

        .btn-custom:hover {
            background-color: #a79f9f;
        }

        .social-icons img {
            width: 45px;
            height: 45px;
            margin: 0 10px;
            cursor: pointer;
        }

        .login-text {
            font-size: 0.95rem;
            text-align: center;
            margin-top: 1.2rem;
        }

        .login-text a {
            text-decoration: none;
        }

        hr {
            opacity: 0.3;
        }

        .social-login-section {
            margin: 2rem 0;
        }

        .divider-container {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }

        .divider-line {
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, #e0e0e0, transparent);
        }

        .divider-text {
            padding: 0 1rem;
            color: #666;
            font-size: 0.875rem;
            background: white;
            white-space: nowrap;
        }

        .btn-outline-secondary:disabled {
            opacity: 0.5;
            cursor: not-allowed;
        }

        .social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            text-decoration: none;
            transition: all 0.3s ease;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .google-btn {
            background: linear-gradient(135deg, #4285f4, #34a853);
            color: white;
        }

        .google-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(66, 133, 244, 0.3);
            color: white;
        }

        .facebook-btn {
            background: linear-gradient(135deg, #1877f2, #42a5f5);
            color: white;
        }

        .facebook-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(24, 119, 242, 0.3);
            color: white;
        }

        .apple-btn {
            background: linear-gradient(135deg, #000000, #333333);
            color: white;
        }

        .apple-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
            color: white;
        }

        .social-btn.loading {
            pointer-events: none;
            opacity: 0.7;
        }

        .social-btn.loading i {
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

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin: 1rem 0;
            font-size: 0.9rem;
        }

        .remember-forgot a {
            text-decoration: none;
            color: #666;
        }

        .remember-forgot a:hover {
            color: #000;
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }
        }
    </style>
</head>

<body>

    <div class="bg-overlay"></div>

    <div class="auth-card text-center">
        <!-- Logo/Brand -->
        <div class="mb-4">
            <i class="fas fa-eye text-primary" style="font-size: 3rem;"></i>
        </div>

        <h4>Welcome Back!</h4>
        <p class="text-muted">Sign in to your OneVision account</p>

        <!-- Social Login Section -->
        <div class="social-login-section mb-4">
            <!-- Social Login Buttons -->
            <div class="d-flex justify-content-center align-items-center mb-3 gap-3">
                <a href="{{ route('auth.google') }}" class="social-btn google-btn" title="Login with Google">
                    <i class="fab fa-google fa-lg"></i>
                </a>
                <button type="button" class="social-btn facebook-btn" disabled onclick="showComingSoon('Facebook')"
                    title="Coming Soon">
                    <i class="fab fa-facebook fa-lg"></i>
                </button>
                <button type="button" class="social-btn apple-btn" disabled onclick="showComingSoon('Apple')"
                    title="Coming Soon">
                    <i class="fab fa-apple fa-lg"></i>
                </button>
            </div>
        </div>

        <!-- Divider -->
        <div class="divider-container mb-4">
            <div class="divider-line"></div>
            <span class="divider-text">or continue with email</span>
            <div class="divider-line"></div>
        </div>

        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" id="loginForm">
            @csrf

            <!-- Email Field -->
            <div class="mb-3">
                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                    name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                    placeholder="Enter your email">
                @error('email')
                    <div class="invalid-feedback d-block">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <!-- Password Field -->
            <div class="mb-3">
                <div class="input-group">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                        name="password" required autocomplete="current-password" placeholder="Enter your password">
                    <button class="btn btn-outline-secondary" type="button" id="togglePassword">
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
            <div class="remember-forgot">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember"
                        {{ old('remember') ? 'checked' : '' }}>
                    <label class="form-check-label" for="remember">
                        {{ __('Remember Me') }}
                    </label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}">
                        {{ __('Forgot Password?') }}
                    </a>
                @endif
            </div>

            <!-- Submit Button -->
            <div class="d-grid">
                <button type="submit" class="btn btn-custom" id="loginBtn">
                    SIGN IN
                </button>
            </div>
        </form>

        <!-- Register Link -->
        <div class="login-text">
            Don't have an account? <a href="{{ route('register') }}">Create one here</a>
        </div>

        <!-- Additional Info -->
        <div class="text-center mt-4">
            <small class="text-muted">
                By signing in, you agree to our
                <a href="#" class="text-muted">Terms of Service</a> and
                <a href="#" class="text-muted">Privacy Policy</a>
            </small>
        </div>
    </div>

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

            // Add loading state to Google login button
            const googleBtn = document.querySelector('.google-btn');
            if (googleBtn) {
                googleBtn.addEventListener('click', function() {
                    this.classList.add('loading');
                    const icon = this.querySelector('i');
                    icon.classList.remove('fa-google');
                    icon.classList.add('fa-spinner');
                });
            }
        });

        function showComingSoon(provider) {
            alert(`${provider} login is coming soon! For now, please use Google or email login.`);
        }
    </script>

</body>

</html>
