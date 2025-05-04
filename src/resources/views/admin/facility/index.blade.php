@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Manage Facilities</h1>
            <a href="{{ route('admin.facilities.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add New Facility
            </a>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($facilities as $facility)
                                <tr class="{{ $facility->deleted_at ? 'table-danger' : '' }}">
                                    <td>{{ $facility->id }}</td>
                                    <td>
                                        @if ($facility->foto)
                                            <img src="{{ asset('storage/' . $facility->foto) }}"
                                                alt="{{ $facility->nama_fasilitas }}" width="50" height="50"
                                                class="img-thumbnail">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $facility->nama_fasilitas }}</td>
                                    <td>{{ $facility->lokasi }}</td>
                                    <td>
                                        @if ($facility->deleted_at)
                                            <span class="badge bg-danger">Deleted</span>
                                        @else
                                            <span class="badge bg-success">Active</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($facility->deleted_at)
                                            <form action="{{ route('admin.facilities.restore', $facility->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Restore">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#forceDeleteModal{{ $facility->id }}"
                                                title="Permanently Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <a href="{{ route('admin.facilities.edit', $facility->id) }}"
                                                class="btn btn-sm btn-primary" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $facility->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $facility->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $facility->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $facility->id }}">Confirm
                                                    Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to delete the facility:
                                                    <strong>{{ $facility->nama_fasilitas }}</strong>?
                                                </p>
                                                <p class="text-muted">The item will be moved to trash and can be restored
                                                    later.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.facilities.destroy', $facility->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Force Delete Modal -->
                                <div class="modal fade" id="forceDeleteModal{{ $facility->id }}" tabindex="-1"
                                    aria-labelledby="forceDeleteModalLabel{{ $facility->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="forceDeleteModalLabel{{ $facility->id }}">
                                                    Confirm Permanent Delete</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Are you sure you want to permanently delete the facility:
                                                    <strong>{{ $facility->nama_fasilitas }}</strong>?
                                                </p>
                                                <p class="text-danger fw-bold">This action cannot be undone!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.facilities.force-delete', $facility->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Permanently
                                                        Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4">No facilities found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
