@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Manage News</h1>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createNewsModal">
            <i class="fas fa-plus"></i> Add New News
        </button>
    </div>

    @if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">News List</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Gambar</th>
                            <th>Judul</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Upload</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($berita as $index => $item)
                        <tr class="{{ $item->deleted_at ? 'table-danger' : '' }}">
                            <td>{{ $index + 1 }}</td>
                            <td>
                                @if ($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}" width="60"
                                    height="60" class="img-thumbnail">
                                @else
                                <span class="badge bg-secondary">No Image</span>
                                @endif
                            </td>
                            <td>{{ $item->judul }}</td>
                            <td>{{ \Illuminate\Support\Str::limit($item->deskripsi, 60) }}</td>
                            <td>{{ $item->created_at->format('d M Y') }}</td>
                            <td>
                                @if ($item->deleted_at)
                                <!-- Tombol Restore -->
                                <form action="{{ route('admin.berita.restore', $item->id) }}" method="POST"
                                    class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success btn-sm" title="Restore">
                                        <i class="fas fa-trash-restore"></i>
                                    </button>
                                </form>
                                <!-- Tombol Force Delete -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#forceDeleteModal{{ $item->id }}" title="Hapus Permanen">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                                @else
                                <!-- Tombol Edit -->
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#editModal{{ $item->id }}" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <!-- Tombol Delete -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $item->id }}" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                                @endif
                            </td>
                        </tr>

                        {{-- Modal Edit --}}
                        <div class="modal fade" id="editModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="editModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <form action="{{ route('admin.berita.update', $item->id) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel{{ $item->id }}">Edit Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="mb-3">
                                                <label for="judul{{ $item->id }}" class="form-label">Judul</label>
                                                <input type="text" class="form-control" id="judul{{ $item->id }}"
                                                    name="judul" value="{{ old('judul', $item->judul) }}" required>
                                            </div>
                                            <div class="mb-3">
                                                <label for="deskripsi{{ $item->id }}" class="form-label">Deskripsi</label>
                                                <textarea class="form-control" id="deskripsi{{ $item->id }}" name="deskripsi"
                                                    rows="5"
                                                    required>{{ old('deskripsi', $item->deskripsi) }}</textarea>
                                            </div>
                                            <div class="mb-3">
                                                <label for="foto{{ $item->id }}" class="form-label">Gambar Baru</label>
                                                <input type="file" class="form-control" id="foto{{ $item->id }}" name="foto"
                                                    accept="image/*">
                                                @if ($item->foto)
                                                <img src="{{ asset('storage/' . $item->foto) }}" alt="{{ $item->judul }}"
                                                    class="img-thumbnail mt-2" style="max-height: 150px;">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        {{-- Modal Delete --}}
                        <div class="modal fade" id="deleteModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="deleteModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel{{ $item->id }}">Hapus Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Apakah anda yakin ingin menghapus berita <strong>{{ $item->judul }}</strong> ini?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        {{-- Modal Force Delete --}}
                        <div class="modal fade" id="forceDeleteModal{{ $item->id }}" tabindex="-1"
                            aria-labelledby="forceDeleteModalLabel{{ $item->id }}" aria-hidden="true">
                            <div class="modal-dialog">
                                <form action="{{ route('admin.berita.force-delete', $item->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="forceDeleteModalLabel{{ $item->id }}">Hapus
                                                Permanen Berita</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            Berita <strong>{{ $item->judul }}</strong> akan dihapus secara permanen.
                                            Tindakan ini tidak bisa dibatalkan. Yakin?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">Data berita tidak ditemukan.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Modal Create --}}
<div class="modal fade" id="createNewsModal" tabindex="-1" aria-labelledby="createNewsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="createNewsModalLabel">Tambah Berita Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="judul" class="form-label">Judul</label>
                        <input type="text" class="form-control" id="judul" name="judul" required>
                    </div>
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" id="deskripsi" name="deskripsi" rows="5" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="foto" class="form-label">Gambar</label>
                        <input type="file" class="form-control" id="foto" name="foto" accept="image/*" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary">Tambah Berita</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview for create form
            const createFotoInput = document.getElementById('foto');
            if (createFotoInput) {
                createFotoInput.addEventListener('change', function(event) {
                    const preview = document.getElementById('imagePreview');
                    const previewImg = preview.querySelector('img');

                    if (event.target.files.length > 0) {
                        const file = event.target.files[0];
                        const url = URL.createObjectURL(file);
                        previewImg.src = url;
                        preview.classList.remove('d-none');
                    } else {
                        preview.classList.add('d-none');
                    }
                });
            }

            // Image preview for edit forms
            document.querySelectorAll('[id^="foto"]').forEach(function(input) {
                if (input.id !== 'foto') { // Skip the create form input
                    input.addEventListener('change', function(event) {
                        const facilityId = input.id.replace('foto', '');
                        const preview = document.getElementById('imagePreview' + facilityId);

                        if (preview) {
                            const previewImg = preview.querySelector('img');

                            if (event.target.files.length > 0) {
                                const file = event.target.files[0];
                                const url = URL.createObjectURL(file);
                                previewImg.src = url;
                                preview.classList.remove('d-none');
                            } else {
                                preview.classList.add('d-none');
                            }
                        }
                    });
                }
            });

            // Comprehensive fix for modal backdrop issues
            const fixModalBackdrop = () => {
                // Remove all backdrop elements
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });

                // Reset body styles
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            };

            // Add event listeners to all modal close buttons
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(fixModalBackdrop, 500);
                });
            });

            // Add event listeners to all modals for when they're hidden
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(fixModalBackdrop, 500);
                });

                // Also handle the case where the modal is closed by clicking outside
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        setTimeout(fixModalBackdrop, 500);
                    }
                });
            });

            // Handle ESC key press
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    setTimeout(fixModalBackdrop, 500);
                }
            });

            // Additional safety measure: periodically check for orphaned backdrops
            setInterval(function() {
                if (!document.querySelector('.modal.show') && document.querySelector('.modal-backdrop')) {
                    fixModalBackdrop();
                }
            }, 2000);
        });
    </script>
@endpush
