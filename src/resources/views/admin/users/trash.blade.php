@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Riwayat Hapus</h1>
        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Kembali
        </a>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-danger">Daftar Sampah</h6>
        </div>
        <div class="card-body">
            @if($users->isEmpty())
                <p class="text-center text-muted">No deleted users found.</p>
            @else
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead class="table-danger">
                        <tr>
                            <th>No</th>
                            <th>Photo</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Deleted At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $index => $user)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($user->photo)
                                <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" width="60" height="60" class="img-thumbnail rounded-circle">
                                @else
                                <span class="badge bg-secondary">No Photo</span>
                                @endif
                            </td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ ucfirst($user->role) }}</td>
                            <td>{{ $user->deleted_at->format('d M Y H:i') }}</td>
                            <td>
                                <!-- Restore Button -->
                                <form action="{{ route('admin.users.restore', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" title="Restore">
                                        <i class="fas fa-trash-restore"></i> Restore
                                    </button>
                                </form>
                                <!-- Force Delete Button trigger modal -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#forceDeleteModal{{ $user->id }}" title="Delete Permanently">
                                    <i class="fas fa-trash-alt"></i> Delete Permanently
                                </button>
                            </td>
                        </tr>

                        {{-- Modal Force Delete --}}
                        <div class="modal fade" id="forceDeleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="forceDeleteModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.users.force-delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="forceDeleteModalLabel{{ $user->id }}">Delete User Permanently</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            User <strong>{{ $user->name }}</strong> akan dihapus permanen. Apakah kamu yakin?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete Permanently</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
