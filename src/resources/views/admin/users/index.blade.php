@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0 text-gray-800">Manajemen Pengelolaan User</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createUserModal">
            <i class="fas fa-plus"></i> Add Users
        </button>
    </div>


    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show d-flex justify-content-between align-items-center" role="alert">
        <div>
            {{ session('success') }}
        </div>
        <button type="button" class="btn-close ms-2" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif


    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Daftar Pengguna</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $index => $user)
                        <tr class="{{ $user->deleted_at ? 'table-danger' : '' }}">
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
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td>
                                <div class="text-center">
                                    <!-- Edit Button -->
                                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editModal{{ $user->id }}" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </button>
                                    <!-- Delete Button -->
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $user->id }}" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="editModal{{ $user->id }}" tabindex="-1" aria-labelledby="editModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $user->id }}">Edit User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="name{{ $user->id }}" class="form-label">Name</label>
                                                <input type="text" class="form-control" id="name{{ $user->id }}" name="name" value="{{ old('name', $user->name) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="email{{ $user->id }}" class="form-label">Email</label>
                                                <input type="email" class="form-control" id="email{{ $user->id }}" name="email" value="{{ old('email', $user->email) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="role{{ $user->id }}" class="form-label">Role</label>
                                                <select name="role" id="role{{ $user->id }}" class="form-select" required>
                                                    <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                                                    <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>User</option>
                                                    
                                                </select>
                                            </div>
                                            <div class="mb-3">
                                                <label for="password{{ $user->id }}" class="form-label">Password <small class="text-muted">(Kosongkan jika tidak ingin diubah)</small></label>
                                                <input type="password" class="form-control" id="password{{ $user->id }}" name="password" autocomplete="new-password">
                                            </div>
                                            <div class="form-group">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation_edit" class="form-control" >
                                            </div>
                                            <div class="mb-3">
                                                <label for="photo{{ $user->id }}" class="form-label">New Photo</label>
                                                <input type="file" class="form-control" id="photo{{ $user->id }}" name="photo" accept="image/*">
                                                @if ($user->photo)
                                                <img src="{{ asset('storage/' . $user->photo) }}" alt="{{ $user->name }}" class="img-thumbnail mt-2 rounded-circle" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Delete --}}
                        <div class="modal fade" id="deleteModal{{ $user->id }}" tabindex="-1" aria-labelledby="deleteModalLabel{{ $user->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $user->id }}">Delete User</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete user <strong>{{ $user->name }}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">No users found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="mt-3 text-center">
                    <a href="{{ route('admin.users.trash') }}" class="btn btn-warning me-2">
                        <i class="fas fa-trash"></i> Deleted Users
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modal Create --}}
<div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUserModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.users.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createUserModalLabel">Add New User</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role" class="form-select" required>
                            <option value="admin">Admin</option>
                            <option value="user" selected>User</option>
                            
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" autocomplete="new-password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirm Password</label>
                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="photo" class="form-label">Photo</label>
                        <input type="file" class="form-control" id="photo" name="photo" accept="image/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable if it exists
            if ($.fn.DataTable) {
                $('#dataTable').DataTable();
            }

            // Show validation errors in modal if they exist
            @if ($errors->any())
                const createModal = new bootstrap.Modal(document.getElementById('createTouristsModal'));
                createModal.show();
            @endif

            // Check URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Open create modal if parameter exists
            if (urlParams.has('openCreateModal')) {
                const createModal = new bootstrap.Modal(document.getElementById('createTouristsModal'));
                createModal.show();

                // Clean up URL to prevent modal reopening on refresh
                window.history.replaceState({}, document.title, "{{ route('admin.tiketmasuks.index') }}");
            }

            // Open edit modal if parameter exists
            if (urlParams.has('openEditModal')) {
                const editId = urlParams.get('openEditModal');
                const editModal = new bootstrap.Modal(document.getElementById('editTouristsModal' + editId));
                editModal.show();

                // Clean up URL to prevent modal reopening on refresh
                window.history.replaceState({}, document.title, "{{ route('admin.tiketmasuks.index') }}");
            }

            // Properly handle modal closing
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    // Remove modal backdrop if it exists
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }

                    // Remove modal-open class from body
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                });
            });
        });
    </script>
@endpush