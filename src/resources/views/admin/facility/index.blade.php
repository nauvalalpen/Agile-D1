@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Fasilitas</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createFacilityModal">
                <i class="fas fa-plus"></i> Tambah Fasilitas Baru
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Fasilitas</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
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
                                            <span class="badge bg-secondary">Tidak Ada Gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ $facility->nama_fasilitas }}</td>
                                    <td>{{ $facility->lokasi }}</td>
                                    <td>{{ Str::limit($facility->deskripsi, 50) }}</td>
                                    <td>
                                        @if ($facility->deleted_at)
                                            <span class="badge bg-danger">Dihapus</span>
                                        @else
                                            <span class="badge bg-success">Aktif</span>
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
                                            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $facility->id }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $facility->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $facility->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $facility->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $facility->id }}">Edit
                                                    Fasilitas</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.facilities.update', $facility->id) }}"
                                                    method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="nama_fasilitas{{ $facility->id }}"
                                                            class="form-label">Nama Fasilitas</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_fasilitas') is-invalid @enderror"
                                                            id="nama_fasilitas{{ $facility->id }}" name="nama_fasilitas"
                                                            value="{{ old('nama_fasilitas', $facility->nama_fasilitas) }}"
                                                            required>
                                                        @error('nama_fasilitas')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="lokasi{{ $facility->id }}"
                                                            class="form-label">Lokasi</label>
                                                        <input type="text"
                                                            class="form-control @error('lokasi') is-invalid @enderror"
                                                            id="lokasi{{ $facility->id }}" name="lokasi"
                                                            value="{{ old('lokasi', $facility->lokasi) }}" required>
                                                        @error('lokasi')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="deskripsi{{ $facility->id }}"
                                                            class="form-label">Deskripsi</label>
                                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi{{ $facility->id }}"
                                                            name="deskripsi" rows="5" required>{{ old('deskripsi', $facility->deskripsi) }}</textarea>
                                                        @error('deskripsi')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="foto{{ $facility->id }}"
                                                            class="form-label">Foto</label>
                                                        <input type="file"
                                                            class="form-control @error('foto') is-invalid @enderror"
                                                            id="foto{{ $facility->id }}" name="foto"
                                                            accept="image/*">
                                                        <small class="form-text text-muted">Unggah gambar baru untuk mengganti
                                                            yang lama. Kosongkan jika tidak ingin mengubah gambar.</small>
                                                        @error('foto')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    @if ($facility->foto)
                                                        <div class="mb-3">
                                                            <p>Foto Saat Ini:</p>
                                                            <img src="{{ asset('storage/' . $facility->foto) }}"
                                                                alt="{{ $facility->nama_fasilitas }}"
                                                                class="img-thumbnail" style="max-height: 200px">
                                                        </div>
                                                    @endif

                                                    <div class="mb-3">
                                                        <div id="imagePreview{{ $facility->id }}" class="mt-2 d-none">
                                                            <p>Pratinjau Gambar Baru:</p>
                                                            <img src="" alt="Preview" class="img-thumbnail"
                                                                style="max-height: 200px">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer px-0 pb-0">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Perbarui Fasilitas</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $facility->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $facility->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $facility->id }}">Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah kamu yakin ingin menghapus fasilitas:
                                                    <strong>{{ $facility->nama_fasilitas }}</strong>?
                                                </p>
                                                <p class="text-muted">Fasilitas akan dipindahkan ke tempat sampah dan dapat dipulihkan nanti.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.facilities.destroy', $facility->id) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Hapus</button>
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
                                                    Konfirmasi Hapus Permanen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah kamu yakin ingin menghapus permanen fasilitas:
                                                    <strong>{{ $facility->nama_fasilitas }}</strong>?
                                                </p>
                                                <p class="text-danger fw-bold">Tindakan ini tidak dapat dibatalkan!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.facilities.force-delete', $facility->id) }}"
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
                                    <td colspan="7" class="text-center py-4">Tidak ada fasilitas yang ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Facility Modal -->
    <div class="modal fade" id="createFacilityModal" tabindex="-1" aria-labelledby="createFacilityModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createFacilityModalLabel">Tambah Fasilitas Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data"
                        id="createFacilityForm">
                        @csrf
                        <div class="mb-3">
                            <label for="nama_fasilitas" class="form-label">Nama Fasilitas</label>
                            <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror"
                                id="nama_fasilitas" name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" required>
                            @error('nama_fasilitas')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="lokasi" class="form-label">Lokasi</label>
                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                id="lokasi" name="lokasi" value="{{ old('lokasi') }}" required>
                            @error('lokasi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                rows="5" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*">
                            <small class="form-text text-muted">Unggah gambar (JPEG, PNG, JPG, GIF). Maksimal 2MB</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div id="imagePreview" class="mt-2 d-none">
                                <p>Pratinjau Foto:</p>
                                <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Fasilitas</button>
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
