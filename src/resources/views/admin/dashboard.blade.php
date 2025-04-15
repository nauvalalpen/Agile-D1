@extends('layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Tourist Management Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Tourists Today</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ 0 }}</div>
                            </div>
                            <a href="{{ route('tourists.index') }}" class="btn btn-primary">Manage Tourists</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Guide Management Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Active Guides</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    {{ \App\Models\OrderTourGuide::where('status', 'success')->count() }}</div>

                            </div>
                            <a href="{{ route('admin.orders.index') }}" class="btn btn-success">Manage Guides</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Bookings Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Today's Bookings</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ 0 }}</div>
                            </div>
                            <a href="" class="btn btn-info">View Bookings</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Weather Information Card -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Current Weather</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ 0 }}°C</div>
                            </div>
                            <a href="" class="btn btn-warning">Weather Details</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Checkpoint Status Section -->
        <div class="row">
            <div class="col-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Recent Checkpoints</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Tourist Name</th>
                                        <th>Entry Time</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {{-- @foreach ($recentCheckpoints as $checkpoint)
                                        <tr>
                                            <td>{{ $checkpoint->tourist->name }}</td>
                                            <td>{{ $checkpoint->created_at }}</td>
                                            <td>{{ $checkpoint->status }}</td>
                                            <td>
                                                <a href="{{ route('checkpoints.show', $checkpoint->id) }}"
                                                    class="btn btn-sm btn-primary">Details</a>
                                            </td>
                                        </tr>
                                    @endforeach --}}
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
