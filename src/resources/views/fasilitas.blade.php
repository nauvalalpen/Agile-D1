@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Facilities Management</h1>
            <a href="{{ route('admin.facilities.create') }}"
                class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                <i class="fas fa-plus fa-sm text-white-50"></i> Add New Facility
            </a>
        </div>

        <!-- Facilities List -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">All Facilities</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="facilitiesTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Category</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($facilities ?? [] as $facility)
                                <tr>
                                    <td>{{ $facility->name }}</td>
                                    <td>{{ $facility->category }}</td>
                                    <td>{{ $facility->location }}</td>
                                    <td>
                                        @if ($facility->status == 'operational')
                                            <span class="badge badge-success">Operational</span>
                                        @elseif($facility->status == 'maintenance')
                                            <span class="badge badge-warning">Under Maintenance</span>
                                        @else
                                            <span class="badge badge-danger">Closed</span>
                                        @endif
                                    </td>
                                    <td>{{ Str::limit($facility->description, 50) }}</td>
                                    <td>
                                        <a href="{{ route('admin.facilities.edit', $facility->id) }}"
                                            class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.facilities.show', $facility->id) }}"
                                            class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <form action="{{ route('admin.facilities.destroy', $facility->id) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Are you sure you want to delete this facility?')">
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

        <!-- Facility Categories -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Restrooms</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $restroomCount ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-toilet fa-2x text-gray-300"></i>
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
                                    Parking Areas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $parkingCount ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-parking fa-2x text-gray-300"></i>
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
                                    Rest Areas</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $restAreaCount ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-couch fa-2x text-gray-300"></i>
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
                                    Food Stalls</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $foodStallCount ?? 0 }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-utensils fa-2x text-gray-300"></i>
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
            $('#facilitiesTable').DataTable();
        });
    </script>
@endpush
