@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Order Tour Guide') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row mb-4">
                            <div class="col-md-4">
                                @if ($tourguide->foto)
                                    <img src="{{ asset('storage/' . $tourguide->foto) }}" class="img-fluid rounded"
                                        alt="{{ $tourguide->nama }}">
                                @else
                                    <img src="{{ asset('images/default-profile.jpg') }}" class="img-fluid rounded"
                                        alt="Default Profile">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $tourguide->nama }}</h4>
                                <table class="table table-bordered mt-3">
                                    <tbody>
                                        <tr>
                                            <th>No HP</th>
                                            <td>{{ $tourguide->nohp }}</td>
                                        </tr>
                                        <tr>
                                            <th>Alamat</th>
                                            <td>{{ $tourguide->alamat }}</td>
                                        </tr>
                                        <tr>
                                            <th>Deskripsi</th>
                                            <td>{{ $tourguide->deskripsi }}</td>
                                        </tr>
                                        <tr>
                                            <th>Price Range</th>
                                            <td>{{ $tourguide->price_range }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <form method="POST" action="{{ route('tourguides.orderSubmit', $tourguide->id) }}">
                            @csrf

                            <div class="form-group row mb-3">
                                <label for="tanggal_order"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Tanggal Order') }}</label>
                                <div class="col-md-6">
                                    <input id="tanggal_order" type="date"
                                        class="form-control @error('tanggal_order') is-invalid @enderror"
                                        name="tanggal_order" value="{{ old('tanggal_order') }}" required>
                                    @error('tanggal_order')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="jumlah_orang"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Jumlah Orang') }}</label>
                                <div class="col-md-6">
                                    <input id="jumlah_orang" type="number" min="1"
                                        class="form-control @error('jumlah_orang') is-invalid @enderror" name="jumlah_orang"
                                        value="{{ old('jumlah_orang', 1) }}" required>
                                    @error('jumlah_orang')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-3">
                                <label for="notes"
                                    class="col-md-4 col-form-label text-md-right">{{ __('Additional Notes') }}</label>
                                <div class="col-md-6">
                                    <textarea id="notes" class="form-control" name="notes" rows="4"
                                        placeholder="Any special requests or information for the tour guide">{{ old('notes') }}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4 d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm Order') }}
                                    </button>
                                    <a href="{{ route('tourguides.index') }}" class="btn btn-secondary">
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
        .form-group {
            margin-bottom: 1rem;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .d-flex {
            display: flex;
        }
    </style>
@endsection
