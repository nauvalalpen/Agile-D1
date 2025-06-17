@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Manage Gallery</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGalleryModal">
                <i class="fas fa-plus"></i> Add New Gallery
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Gallery List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="galleryTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Tanggal Upload</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($galleries as $gallery)
                                <tr class="{{ $gallery->deleted_at ? 'table-danger' : '' }}">
                                    <td>{{ $gallery->id }}</td>
                                    <td>{{ $gallery->judul }}</td>
                                    <td>{{ Str::limit($gallery->deskripsi, 50) }}</td>
                                    <td>
                                        @if ($gallery->foto)
                                            <img src="{{ asset('storage/' . $gallery->foto) }}" alt="{{ $gallery->judul }}"
                                                width="60" height="60" class="img-thumbnail">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $gallery->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($gallery->deleted_at)
                                            <!-- Tombol Restore -->
                                            <form action="{{ route('admin.gallery.restore', $gallery->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Restore">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                            <!-- Tombol Force Delete (modal) -->
                                            <button type="button" class="btn btn-sm btn-danger" title="Permanently Delete"
                                                data-bs-toggle="modal"
                                                data-bs-target="#forceDeleteGalleryModal{{ $gallery->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <!-- Tombol Edit (modal) -->
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editGalleryModal{{ $gallery->id }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- Tombol Delete (modal) -->
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteGalleryModal{{ $gallery->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Modal Edit -->
                                <div class="modal fade" id="editGalleryModal{{ $gallery->id }}" tabindex="-1"
                                    aria-labelledby="editGalleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editGalleryModalLabel{{ $gallery->id }}">Edit
                                                    Gallery</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.gallery.update', $gallery->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <!-- Add hidden tanggal field -->
                                                    <input type="hidden" name="tanggal"
                                                        value="{{ $gallery->tanggal ?? $gallery->created_at->format('Y-m-d') }}">

                                                    <div class="mb-3">
                                                        <label for="judul{{ $gallery->id }}"
                                                            class="form-label">Judul</label>
                                                        <input type="text"
                                                            class="form-control @error('judul') is-invalid @enderror"
                                                            id="judul{{ $gallery->id }}" name="judul"
                                                            value="{{ old('judul', $gallery->judul) }}" required>
                                                        @error('judul')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="deskripsi{{ $gallery->id }}"
                                                            class="form-label">Deskripsi</label>
                                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi{{ $gallery->id }}"
                                                            name="deskripsi" rows="4" required>{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
                                                        @error('deskripsi')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="foto{{ $gallery->id }}"
                                                            class="form-label">Foto</label>
                                                        <input type="file"
                                                            class="form-control @error('foto') is-invalid @enderror"
                                                            id="foto{{ $gallery->id }}" name="foto" accept="image/*">
                                                        <small class="form-text text-muted">Upload foto baru untuk
                                                            mengganti foto lama, kosongkan jika tidak ingin
                                                            mengganti.</small>
                                                        @error('foto')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    @if ($gallery->foto)
                                                        <div class="mb-3">
                                                            <p>Foto saat ini:</p>
                                                            <img src="{{ asset('storage/' . $gallery->foto) }}"
                                                                alt="{{ $gallery->judul }}" class="img-thumbnail"
                                                                style="max-height: 200px">
                                                        </div>
                                                    @endif

                                                    <div class="mb-3 d-none" id="imagePreview{{ $gallery->id }}">
                                                        <label class="form-label">Preview Foto Baru:</label><br>
                                                        <img src="" alt="Preview" class="img-thumbnail"
                                                            style="max-width: 100%; height: auto; max-height: 200px;">
                                                    </div>

                                                    <div class="modal-footer px-0 pb-0">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Update
                                                            Gallery</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <!-- Modal Delete -->
                                <div class="modal fade" id="deleteGalleryModal{{ $gallery->id }}" tabindex="-1"
                                    aria-labelledby="deleteGalleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteGalleryModalLabel{{ $gallery->id }}">
                                                    Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus gallery
                                                    <strong>{{ $gallery->judul }}</strong>?</p>
                                                <p class="text-muted">Data akan dipindahkan ke trash dan dapat
                                                    dikembalikan.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.gallery.destroy', $gallery->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Modal Force Delete -->
                                <div class="modal fade" id="forceDeleteGalleryModal{{ $gallery->id }}" tabindex="-1"
                                    aria-labelledby="forceDeleteGalleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title"
                                                    id="forceDeleteGalleryModalLabel{{ $gallery->id }}">Hapus Permanen
                                                </h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Anda akan menghapus secara permanen gallery
                                                    <strong>{{ $gallery->judul }}</strong>.</p>
                                                <p class="text-danger fw-bold">Tindakan ini tidak dapat dibatalkan!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.gallery.force-delete', $gallery->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data galeri tidak tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>


        <!-- Modal Restore -->
        @forelse ($galleries as $gallery)
            @if ($gallery->deleted_at)
                <div class="modal fade" id="restoreGalleryModal{{ $gallery->id }}" tabindex="-1"
                    aria-labelledby="restoreGalleryModalLabel{{ $gallery->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="restoreGalleryModalLabel{{ $gallery->id }}">Konfirmasi
                                    Restore</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <p>Apakah Anda yakin ingin mengembalikan gallery <strong>{{ $gallery->judul }}</strong>?
                                </p>
                                <p class="text-success fw-bold">Gallery akan dipulihkan dan kembali aktif.</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <form action="{{ route('admin.gallery.restore', $gallery->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Restore</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @empty
        @endforelse



        <!-- Modal Create Gallery -->
        <div class="modal fade" id="createGalleryModal" tabindex="-1" aria-labelledby="createGalleryModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createGalleryModalLabel">Tambah Gallery Baru</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul</label>
                                <input type="text" class="form-control @error('judul') is-invalid @enderror"
                                    id="judul" name="judul" value="{{ old('judul') }}" required>
                                @error('judul')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                    rows="4" required>{{ old('deskripsi') }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Foto</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" name="foto" accept="image/jpeg, png, jpg, gif" required>
                                <small class="form-text text-muted">Upload gambar (jpeg, png, jpg, gif). Max size:
                                    2MB.</small>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="modal-footer px-0 pb-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Tambah Gallery</button>
                            </div>
                        </form>
                    </div>
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
