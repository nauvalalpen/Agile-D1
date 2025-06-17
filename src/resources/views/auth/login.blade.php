<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Login' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background-image: url('{{ asset("images/bg.png") }}');
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

        .form-control {
            border-radius: 25px;
            padding: 0.8rem 1rem;
            font-size: 1.1rem;
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
        <h4>Welcome back!</h4>
        <p class="text-muted">Please log in to your account</p>

        <form method="POST" action="{{ route('login.submit') }}">
            @csrf

            <div class="mb-3">
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       placeholder="E-mail" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3">
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       placeholder="Password" required>
                @error('password')
                    <span class="invalid-feedback d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-custom">LOG IN</button>
            </div>
        </form>

        <hr class="my-4">
        <p>or</p>

        <div class="d-flex justify-content-center align-items-center mb-3 social-icons">
        <i class="fab fa-facebook fa-2x mx-2"></i>
        <i class="fas fa-envelope fa-2x mx-2"></i>
        <i class="fab fa-apple fa-2x mx-2"></i>
        </div>

        <div class="login-text">
            New here? <a href="{{ route('register') }}">Create your account</a>
        </div>
    </div>

</body>
</html>
