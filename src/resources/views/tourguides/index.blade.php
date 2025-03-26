@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4>Tour Guides</h4>
                        <a href="{{ route('tourguides.create') }}" class="btn btn-primary">Add New Tour Guide</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nama</th>
                                        <th>No HP</th>
                                        <th>Alamat</th>
                                        <th>Foto</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($tourguides as $tourguide)
                                        <tr>
                                            <td>{{ $tourguide->id }}</td>
                                            <td>{{ $tourguide->nama }}</td>
                                            <td>{{ $tourguide->nohp }}</td>
                                            <td>{{ $tourguide->alamat }}</td>
                                            <td>
                                                <img src="{{ $tourguide->foto }}" alt="{{ $tourguide->nama }}"
                                                    width="100">
                                            </td>
                                            <td>
                                                <div class="d-flex">
                                                    <a href="{{ route('tourguides.edit', $tourguide->id) }}"
                                                        class="btn btn-sm btn-info me-2">Edit</a>
                                                    <form action="{{ route('tourguides.destroy', $tourguide->id) }}"
                                                        method="POST"
                                                        onsubmit="return confirm('Are you sure you want to delete this tour guide?')">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">No tour guides found.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
