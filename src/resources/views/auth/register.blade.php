<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Register' }}</title>
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
    </style>
</head>

<body>

    <div class="bg-overlay"></div>

    <div class="auth-card text-center">
        <h4>Welcome!</h4>
        <p class="text-muted">Let's get started on your exciting journey</p>

        <form method="POST" action="{{ route('register.submit') }}">
            @csrf

            <div class="mb-3">
                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name"
                    placeholder="Name" value="{{ old('name') }}" required autofocus>
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
                    placeholder="Password" required>
                @error('password')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password"
                    required>
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
                <button type="submit" class="btn btn-custom">CREATE ACCOUNT</button>
            </div>
        </form>

        <hr class="my-4">
        <!-- Add divider -->
        <div class="divider-container mb-3">
            <div class="divider-line"></div>
            <span class="divider-text">or register with email</span>
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
            Already have an account? <a href="{{ route('login') }}">Log In</a>
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
