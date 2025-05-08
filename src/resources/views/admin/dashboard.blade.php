@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">

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
