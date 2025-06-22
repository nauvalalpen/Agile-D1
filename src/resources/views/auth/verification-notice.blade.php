@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Verify Your Email Address') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="text-center">
                            <i class="fas fa-envelope fa-3x text-primary mb-3"></i>
                            <h4>Check Your Email</h4>
                            <p>We've sent a verification code to <strong>{{ session('email') }}</strong></p>
                            <p>Please check your email and enter the 6-digit code to complete your registration.</p>

                            <a href="{{ route('verification.show') }}" class="btn btn-primary">
                                Enter Verification Code
                            </a>

                            <hr>

                            <p class="text-muted">Didn't receive the email? Check your spam folder or</p>
                            <form method="POST" action="{{ route('verification.resend') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="email" value="{{ session('email') }}">
                                <button type="submit" class="btn btn-link">
                                    Resend verification code
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
