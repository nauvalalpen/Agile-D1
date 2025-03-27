@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Tour Guides') }}</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            @forelse ($tourguides as $tourguide)
                                <div class="col-md-4 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0">{{ $tourguide->nama }}</h5>
                                        </div>

                                        @if ($tourguide->foto)
                                            <img src="{{ asset('storage/' . $tourguide->foto) }}" class="card-img-top"
                                                alt="{{ $tourguide->nama }}" style="height: 200px; object-fit: cover;">
                                        @else
                                            <img src="{{ asset('images/default-profile.jpg') }}" class="card-img-top"
                                                alt="Default Profile" style="height: 200px; object-fit: cover;">
                                        @endif

                                        <div class="card-body">
                                            <table class="table table-bordered">
                                                <tbody>
                                                    <tr>
                                                        <th>Nama</th>
                                                        <td>{{ $tourguide->nama }}</td>
                                                    </tr>
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
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="card-footer">
                                            @auth
                                                <a href="{{ route('tourguides.order', $tourguide->id) }}"
                                                    class="btn btn-success btn-block">Order Tour Guide</a>
                                            @else
                                                <div class="alert alert-warning mb-2">Please log in to order a tour guide</div>
                                                <a href="{{ route('login') }}" class="btn btn-primary btn-block">Login</a>
                                            @endauth
                                        </div>

                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="alert alert-info">
                                        No tour guides available at the moment.
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        @if (isset($tourguides) && method_exists($tourguides, 'links'))
                            <div class="mt-4">
                                {{ $tourguides->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        .card-header {
            font-weight: bold;
        }

        .table th {
            width: 30%;
        }

        .btn-block {
            display: block;
            width: 100%;
        }
    </style>
@endsection
