@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tour Guides Management</h1>
            <a href="{{ route('admin.guides.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New Guide
            </a>
        </div>

        <!-- Tour Guides List -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Tour Guides</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="guidesTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Photo</th>
                                <th>Name</th>
                                <th>Experience</th>
                                <th>Languages</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($guides ?? [] as $guide)
                                <tr>
                                    <td>
                                        <img src="{{ asset('storage/' . $guide->photo) }}" alt="{{ $guide->name }}"
                                            class="img-profile rounded-circle" style="width: 50px; height: 50px;">
                                    </td>
                                    <td>{{ $guide->name }}</td>
                                    <td>{{ $guide->experience }} years</td>
                                    <td>{{ $guide->languages }}</td>
                                    <td>
                                        <div class="text-warning">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $guide->rating)
                                                    <i class="fas fa-star"></i>
                                                @elseif($i - 0.5 <= $guide->rating)
                                                    <i class="fas fa-star-half-alt"></i>
                                                @else
                                                    <i class="far fa-star"></i>
                                                @endif
                                            @endfor
                                            ({{ $guide->rating }})
                                        </div>
                                    </td>
                                    <td>
                                        @if ($guide->status == 'active')
                                            <span class="badge badge-success">Active</span>
                                        @elseif($guide->status == 'on_tour')
                                            <span class="badge badge-info">On Tour</span>
                                        @else
                                            <span class="badge badge-secondary">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.guides.edit', $guide->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.guides.show', $guide->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.guides.destroy', $guide->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this guide?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Guide Statistics -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Guides</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalGuides ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active Guides</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeGuides ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-check-circle fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    On Tour</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $onTourGuides ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-hiking fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Average Rating</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ number_format($averageRating ?? 0, 1) }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-star fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#guidesTable').DataTable();
        });
    </script>
@endpush
