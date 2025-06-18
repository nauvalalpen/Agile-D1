@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-lg border-0" style="border-radius: 15px;">
                    <div class="card-header bg-primary text-white text-center p-4">
                        <h3 class="mb-0 fw-bold">Booking Confirmation</h3>
                        <p class="mb-0">You are booking a tour with</p>
                    </div>

                    <div class="card-body p-4 p-md-5">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- Tour Guide Summary -->
                        <div class="order-summary-box bg-light p-4 rounded-3 mb-5">
                            <div class="row align-items-center">
                                <div class="col-md-4 text-center">
                                    @if ($tourguide->foto)
                                        <img src="{{ asset('storage/' . $tourguide->foto) }}"
                                            class="img-fluid rounded-circle shadow" alt="{{ $tourguide->nama }}"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    @else
                                        <img src="{{ asset('images/default-profile.jpg') }}"
                                            class="img-fluid rounded-circle shadow" alt="Default Profile"
                                            style="width: 150px; height: 150px; object-fit: cover;">
                                    @endif
                                </div>
                                <div class="col-md-8 mt-3 mt-md-0">
                                    <h4 class="fw-bold">{{ $tourguide->nama }}</h4>
                                    <p class="text-muted">{{ $tourguide->deskripsi }}</p>
                                    <ul class="list-unstyled tourguide-details">
                                        <li><i class="fas fa-phone fa-fw text-secondary me-2"></i>{{ $tourguide->nohp }}
                                        </li>
                                        <li><i
                                                class="fas fa-map-marker-alt fa-fw text-secondary me-2"></i>{{ $tourguide->alamat }}
                                        </li>
                                        <li><i
                                                class="fas fa-dollar-sign fa-fw text-secondary me-2"></i><strong>{{ $tourguide->price_range }}</strong>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <!-- Order Form -->
                        <h4 class="mb-4 text-center fw-bold">Enter Your Booking Details</h4>
                        <form method="POST" action="{{ route('tourguides.orderSubmit', $tourguide->id) }}">
                            @csrf

                            <div class="row mb-3">
                                <label for="tanggal_order"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Date of Tour') }}</label>
                                <div class="col-md-7">
                                    <input id="tanggal_order" type="date"
                                        class="form-control @error('tanggal_order') is-invalid @enderror"
                                        name="tanggal_order" value="{{ old('tanggal_order') }}" required>
                                    @error('tanggal_order')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="jumlah_orang"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Number of People') }}</label>
                                <div class="col-md-7">
                                    <input id="jumlah_orang" type="number" min="1"
                                        class="form-control @error('jumlah_orang') is-invalid @enderror" name="jumlah_orang"
                                        value="{{ old('jumlah_orang', 1) }}" required>
                                    @error('jumlah_orang')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-4">
                                <label for="notes"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Additional Notes') }}</label>
                                <div class="col-md-7">
                                    <textarea id="notes" class="form-control @error('notes') is-invalid @enderror" name="notes" rows="4"
                                        placeholder="Any special requests or information for the tour guide (e.g., interests, mobility concerns)">{{ old('notes') }}</textarea>
                                    @error('notes')
                                        <span class="invalid-feedback"
                                            role="alert"><strong>{{ $message }}</strong></span>
                                    @enderror
                                </div>
                            </div>

                            <hr class="my-4">

                            <div class="row">
                                <div class="col-md-7 offset-md-4 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg flex-grow-1">
                                        <i class="fas fa-check-circle me-2"></i>{{ __('Confirm Order') }}
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">
                                        {{ __('Cancel') }}
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .order-summary-box {
            border: 1px solid #e9ecef;
        }

        .tourguide-details li {
            margin-bottom: 0.5rem;
            font-size: 1.05rem;
            color: #555;
        }

        .form-control,
        .btn {
            border-radius: 0.5rem;
        }

        .col-form-label {
            font-weight: 500;
        }
    </style>
@endsection
