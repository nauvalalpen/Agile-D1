<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Register' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        :root {
            --emerald-green: #10b981;
            --light-green: #34d399;
            --forest-green: #065f46;
            --dark-forest: #064e3b;
            --deep-green: #047857;
            --pure-white: #ffffff;
        }

        body {
            background-image: url('{{ asset('images/hero.jpg') }}');
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
            color: var(--dark-forest);
        }

        .brand-icon {
            color: var(--emerald-green) !important;
            font-size: 3rem;
        }

        .form-control,
        .form-select {
            border-radius: 25px;
            padding: 0.8rem 1rem;
            font-size: 1.05rem;
            border: 2px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: var(--emerald-green);
            box-shadow: 0 0 0 0.2rem rgba(16, 185, 129, 0.25);
        }

        .form-control.is-invalid:focus {
            border-color: #dc3545;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
        }

        .input-group .form-control {
            border-radius: 25px 0 0 25px;
        }

        .input-group .btn {
            border-radius: 0 25px 25px 0;
            border: 2px solid #e9ecef;
            border-left: none;
        }

        .input-group .btn:hover {
            background-color: var(--emerald-green);
            border-color: var(--emerald-green);
            color: white;
        }

        .btn-custom {
            border-radius: 25px;
            padding: 0.8rem;
            font-size: 1.1rem;
            background: linear-gradient(135deg, var(--emerald-green), var(--forest-green));
            color: white;
            border: none;
            transition: all 0.3s ease;
            font-weight: 600;
        }

        .btn-custom:hover {
            background: linear-gradient(135deg, var(--forest-green), var(--emerald-green));
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            color: white;
        }

        .btn-custom:active {
            transform: translateY(0);
        }

        .btn-custom:disabled {
            opacity: 0.7;
            transform: none;
            cursor: not-allowed;
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
            color: var(--emerald-green);
            text-decoration: none;
            transition: color 0.3s ease;
            font-weight: 500;
        }

        .login-text a:hover {
            color: var(--forest-green);
            text-decoration: underline;
        }

        .text-muted a {
            color: var(--emerald-green) !important;
        }

        .text-muted a:hover {
            color: var(--forest-green) !important;
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
            background: linear-gradient(135deg, var(--emerald-green), var(--light-green));
            color: var(--pure-white);
            border: none;
        }

        .google-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);
            color: var(--pure-white);
        }

        .facebook-btn {
            background: linear-gradient(135deg, var(--forest-green), var(--emerald-green));
            color: var(--pure-white);
            border: none;
        }

        .facebook-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 95, 70, 0.3);
            color: var(--pure-white);
        }

        .apple-btn {
            background: linear-gradient(135deg, var(--dark-forest), var(--deep-green));
            color: var(--pure-white);
            border: none;
        }

        .apple-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(6, 78, 59, 0.3);
            color: var(--pure-white);
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

        .spinner-border {
            color: var(--emerald-green);
        }

        .btn-custom .spinner-border {
            color: white;
        }

        /* Password strength indicator */
        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
        }

        .strength-weak {
            color: #dc3545;
        }

        .strength-medium {
            color: #ffc107;
        }

        .strength-strong {
            color: var(--emerald-green);
        }

        @media (max-width: 576px) {
            .auth-card {
                padding: 2rem 1.5rem;
                margin: 1rem;
            }

            .brand-icon {
                font-size: 2.5rem;
            }

            .auth-card h4 {
                font-size: 1.5rem;
            }
        }
    </style>
</head>

<body>

    <div class="bg-overlay"></div>

    <div class="auth-card text-center">
        <h4>Selamat Datang!</h4>
        <p class="text-muted">Mari mulai perjalanan seru Anda</p>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Nama" value="{{ old('name') }}" required autofocus>
                @error('name')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                    placeholder="E-mail" value="{{ old('email') }}" required>
                @error('email')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password"
                    placeholder="Kata Sandi" required>
                @error('password')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirmation"
                    placeholder="Konfirmasi Kata Sandi" required>
            </div>

            {{-- <div class="mb-3">
                <select class="form-select @error('role') is-invalid @enderror" name="role" required>
                    <option value="" disabled selected>Select Role</option>
                    <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User</option>
                    <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                </select>
                @error('role')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div> --}}

            <div class="d-grid">
                <button type="submit" class="btn btn-custom">BUAT AKUN</button>
            </div>
        </form>

        <hr class="my-4">
        <!-- Add divider -->
        <div class="divider-container mb-3">
            <div class="divider-line"></div>
            <span class="divider-text">atau daftar dengan email</span>
            <div class="divider-line"></div>
        </div>

        <!-- Add the same social login section to register page -->
        <!-- Replace the social icons section with this cleaner approach -->
        <div class="social-login-section mb-4">
            <x-google-login-button text="Sign in with Google" class="w-100 mb-3" />

            <!-- Other social login buttons (coming soon) -->
            <div class="row">
                <div class="col-6">
                    <button type="button" class="btn btn-outline-secondary w-100" disabled
                        onclick="showComingSoon('Facebook')">
                        <i class="fab fa-facebook me-2"></i>Facebook
                    </button>
                </div>
                <div class="col-6">
                    <button type="button" class="btn btn-outline-secondary w-100" disabled
                        onclick="showComingSoon('Apple')">
                        <i class="fab fa-apple me-2"></i>Apple
                    </button>
                </div>
            </div>
        </div>

        {{-- <!-- Add divider -->
        <div class="divider-container mb-4">
            <div class="divider-line"></div>
            <span class="divider-text">or continue with email</span>
            <div class="divider-line"></div>
        </div>

        <!-- Add divider -->
        <div class="divider-container mb-3">
            <div class="divider-line"></div>
            <span class="divider-text">or register with email</span>
            <div class="divider-line"></div>
        </div> --}}

        <!-- Include the same CSS and JavaScript as in login.blade.php -->


        <div class="login-text">
            Sudah punya akun? <a href="{{ route('login') }}">Masuk di sini</a>
        </div>
    </div>

</body>

<style>
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

    /* Loading state for Google button */
    .btn-google.loading {
        pointer-events: none;
        opacity: 0.7;
    }

    .btn-google.loading svg {
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
</style>

<script>
    function showComingSoon(provider) {
        alert(`${provider} login is coming soon! For now, please use Google or email login.`);
    }

    // Add loading state to Google button
    document.addEventListener('DOMContentLoaded', function() {
        const googleBtn = document.querySelector('.btn-google');
        if (googleBtn) {
            googleBtn.addEventListener('click', function() {
                this.classList.add('loading');
                this.innerHTML = this.innerHTML.replace('Continue with Google', 'Connecting...');
            });
        }
    });
</script>

<style>
    .social-icons {
        gap: 1rem;
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
    }

    /* Loading state for Google button */
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
</style>

<!-- Add JavaScript for social login -->
<script>
    function showComingSoon(provider) {
        alert(`${provider} login is coming soon! For now, please use Google or email login.`);
    }

    // Add loading state to Google button
    document.addEventListener('DOMContentLoaded', function() {
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
</script>

</html>
