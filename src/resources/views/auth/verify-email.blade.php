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

                        <p>We've sent a 6-digit verification code to your email address. Please enter the code below to
                            verify your account.</p>

                        <form method="POST" action="{{ route('verification.verify') }}">
                            @csrf

                            {{-- <div class="row mb-3">
                                <label for="email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email"
                                        class="form-control @error('email') is-invalid @enderror" name="email"
                                        value="{{ old('email', session('email')) }}" required autocomplete="email">

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div> --}}

                            <div class="row mb-3">
                                <label for="verification_code"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Verification Code') }}</label>

                                <div class="col-md-6">
                                    <input id="verification_code" type="text"
                                        class="form-control @error('verification_code') is-invalid @enderror"
                                        name="verification_code" required maxlength="6" placeholder="Enter 6-digit code">

                                    @error('verification_code')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Verify Email') }}
                                    </button>
                                </div>
                            </div>
                        </form>

                        <hr>

                        <div class="text-center">
                            <p>Didn't receive the code?</p>
                            <form method="POST" action="{{ route('verification.resend') }}" class="d-inline">
                                @csrf
                                <input type="hidden" name="email" value="{{ old('email', session('email')) }}">
                                <button type="submit" class="btn btn-link p-0">
                                    {{ __('Resend verification code') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
