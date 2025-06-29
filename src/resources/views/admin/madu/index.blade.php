@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Produk Madu</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createMaduModal">
                <i class="fas fa-plus"></i> Tambah Produk Madu
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Produk Madu</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Ukuran</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($madus as $madu)
                                <tr class="{{ $madu->deleted_at ? 'table-danger' : '' }}">
                                    {{-- <td>{{ $madu->id }}</td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($madu->gambar)
                                            <img src="{{ asset('storage/' . $madu->gambar) }}" alt="{{ $madu->nama_madu }}"
                                                width="50" height="50" class="img-thumbnail">
                                        @else
                                            <span class="badge bg-secondary">Tidak Ada Gambar</span>
                                        @endif
                                    </td>
                                    <td>{{ $madu->nama_madu }}</td>
                                    <td>{{ $madu->ukuran }}</td>
                                    <td>Rp {{ number_format($madu->harga, 0, ',', '.') }}</td>
                                    <td>{{ $madu->stock }}</td>
                                    <td>
                                        @if ($madu->deleted_at)
                                            <span class="badge bg-danger">Dihapus</span>
                                        @else
                                            <span class="badge bg-success">Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($madu->deleted_at)
                                            <form action="{{ route('admin.madu.restore', $madu->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-success" title="Restore">
                                                    <i class="fas fa-trash-restore"></i>
                                                </button>
                                            </form>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#forceDeleteModal{{ $madu->id }}"
                                                title="Permanently Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                                data-bs-target="#editModal{{ $madu->id }}" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal{{ $madu->id }}" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>

                                <!-- Edit Modal -->
                                <div class="modal fade" id="editModal{{ $madu->id }}" tabindex="-1"
                                    aria-labelledby="editModalLabel{{ $madu->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="editModalLabel{{ $madu->id }}">Edit Produk
                                                    Madu</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{ route('admin.madu.update', $madu->id) }}" method="POST"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="mb-3">
                                                        <label for="nama_madu{{ $madu->id }}" class="form-label">Nama
                                                            Madu</label>
                                                        <input type="text"
                                                            class="form-control @error('nama_madu') is-invalid @enderror"
                                                            id="nama_madu{{ $madu->id }}" name="nama_madu"
                                                            value="{{ old('nama_madu', $madu->nama_madu) }}" required>
                                                        @error('nama_madu')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="ukuran{{ $madu->id }}"
                                                            class="form-label">Ukuran</label>
                                                        <input type="text"
                                                            class="form-control @error('ukuran') is-invalid @enderror"
                                                            id="ukuran{{ $madu->id }}" name="ukuran"
                                                            value="{{ old('ukuran', $madu->ukuran) }}" required>
                                                        @error('ukuran')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="harga{{ $madu->id }}" class="form-label">Harga
                                                            (Rp)
                                                        </label>
                                                        <input type="number"
                                                            class="form-control @error('harga') is-invalid @enderror"
                                                            id="harga{{ $madu->id }}" name="harga"
                                                            value="{{ old('harga', $madu->harga) }}" required
                                                            min="0">
                                                        @error('harga')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="stock{{ $madu->id }}"
                                                            class="form-label">Stok</label>
                                                        <input type="number"
                                                            class="form-control @error('stock') is-invalid @enderror"
                                                            id="stock{{ $madu->id }}" name="stock"
                                                            value="{{ old('stock', $madu->stock) }}" required
                                                            min="0">
                                                        @error('stock')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="deskripsi{{ $madu->id }}"
                                                            class="form-label">Deskripsi</label>
                                                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi{{ $madu->id }}"
                                                            name="deskripsi" rows="5" required>{{ old('deskripsi', $madu->deskripsi) }}</textarea>
                                                        @error('deskripsi')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    <div class="mb-3">
                                                        <label for="gambar{{ $madu->id }}"
                                                            class="form-label">Gambar</label>
                                                        <input type="file"
                                                            class="form-control @error('gambar') is-invalid @enderror"
                                                            id="gambar{{ $madu->id }}" name="gambar"
                                                            accept="image/*">
                                                        <small class="form-text text-muted">Unggah gambar baru jika ingin
                                                            mengganti gambar saat ini. Biarkan kosong untuk mempertahankan
                                                            gambar lama.</small>
                                                        @error('gambar')
                                                            <div class="invalid-feedback">{{ $message }}</div>
                                                        @enderror
                                                    </div>

                                                    @if ($madu->gambar)
                                                        <div class="mb-3">
                                                            <p>Gambar Saat Ini:</p>
                                                            <img src="{{ asset('storage/' . $madu->gambar) }}"
                                                                alt="{{ $madu->nama_madu }}" class="img-thumbnail"
                                                                style="max-height: 200px">
                                                        </div>
                                                    @endif

                                                    <div class="mb-3">
                                                        <div id="imagePreview{{ $madu->id }}" class="mt-2 d-none">
                                                            <p>Pratinjau Gambar Baru:</p>
                                                            <img src="" alt="Preview" class="img-thumbnail"
                                                                style="max-height: 200px">
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer px-0 pb-0">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-primary">Perbarui Produk
                                                            Madu</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Delete Modal -->
                                <div class="modal fade" id="deleteModal{{ $madu->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $madu->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="deleteModalLabel{{ $madu->id }}">
                                                    Konfirmasi Hapus</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus produk madu:
                                                    <strong>{{ $madu->nama_madu }}</strong>?
                                                </p>
                                                <p class="text-muted">Produk akan dipindahkan ke sampah dan dapat
                                                    dipulihkan kembali nanti.</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <form action="{{ route('admin.madu.destroy', $madu->id) }}"
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
                                <div class="modal fade" id="forceDeleteModal{{ $madu->id }}" tabindex="-1"
                                    aria-labelledby="forceDeleteModalLabel{{ $madu->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="forceDeleteModalLabel{{ $madu->id }}">
                                                    Konfirmasi Hapus Permanen</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>Apakah Anda yakin ingin menghapus secara permanen produk madu:
                                                    <strong>{{ $madu->nama_madu }}</strong>?
                                                </p>
                                                <p class="text-danger fw-bold">Tindakan ini tidak dapat dibatalkan!</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Cancel</button>
                                                <form action="{{ route('admin.madu.force-delete', $madu->id) }}"
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
                                    <td colspan="8" class="text-center py-4">Tidak ada produk madu ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Honey Product Modal -->
    <div class="modal fade" id="createMaduModal" tabindex="-1" aria-labelledby="createMaduModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createMaduModalLabel">Tambah Produk Madu Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.madu.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_madu" class="form-label">Nama Madu</label>
                            <input type="text" class="form-control @error('nama_madu') is-invalid @enderror"
                                id="nama_madu" name="nama_madu" value="{{ old('nama_madu') }}" required>
                            @error('nama_madu')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="ukuran" class="form-label">Ukuran</label>
                            <input type="text" class="form-control @error('ukuran') is-invalid @enderror"
                                id="ukuran" name="ukuran" value="{{ old('ukuran') }}" required>
                            @error('ukuran')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga (Rp)</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                id="harga" name="harga" value="{{ old('harga') }}" required min="0">
                            @error('harga')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stock" class="form-label">Stok</label>
                            <input type="number" class="form-control @error('stock') is-invalid @enderror"
                                id="stock" name="stock" value="{{ old('stock') }}" required min="0">
                            @error('stock')
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
                            <label for="gambar" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('gambar') is-invalid @enderror"
                                id="gambar" name="gambar" accept="image/*">
                            <small class="form-text text-muted">Unggah gambar (JPEG, PNG, JPG, GIF). Maksimal ukuran:
                                2MB</small>
                            @error('gambar')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div id="imagePreview" class="mt-2 d-none">
                                <p>Pratinjau Gambar:</p>
                                <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                            </div>
                        </div>

                        <div class="modal-footer px-0 pb-0">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan Produk Madu</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Image preview for create form
            const createGambarInput = document.getElementById('gambar');
            if (createGambarInput) {
                createGambarInput.addEventListener('change', function(event) {
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
            document.querySelectorAll('[id^="gambar"]').forEach(function(input) {
                if (input.id !== 'gambar') { // Skip the create form input
                    input.addEventListener('change', function(event) {
                        const maduId = input.id.replace('gambar', '');
                        const preview = document.getElementById('imagePreview' + maduId);

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
@endsection
