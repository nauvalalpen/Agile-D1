@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Produk UMKM</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createProdukUMKMModal">
                <i class="fas fa-plus"></i> Tambah Produk Baru
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Produk UMKM </h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Harga</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($produkUMKM as $produk)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        @if ($produk->foto)
                                            <img src="{{ asset('storage/' . $produk->foto) }}" alt="{{ $produk->nama }}"
                                                width="50" height="50" class="img-thumbnail">
                                        @else
                                            <span class="badge bg-secondary">Tidak Ada Gambar </span>
                                        @endif
                                    </td>
                                    <td>{{ $produk->nama }}</td>
                                    <td>Rp {{ number_format($produk->harga, 0, ',', '.') }}</td>
                                    <td>{{ Str::limit($produk->deskripsi, 50) }}</td>
                                    <td>
                                        @if ($produk->deleted_at)
                                            <span class="badge bg-danger">Dihapus</span>
                                        @else
                                            <span class="badge bg-success">Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($produk->deleted_at)
                                            <!-- Restore Button -->
                                            <button type="button" class="btn btn-sm btn-success me-1"
                                                onclick="showRestoreModal({{ $produk->id }}, '{{ addslashes($produk->nama) }}')"
                                                title="Restore">
                                                <i class="fas fa-trash-restore"></i>
                                            </button>
                                            <!-- Force Delete Button -->
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="showForceDeleteModal({{ $produk->id }}, '{{ addslashes($produk->nama) }}')"
                                                title="Permanently Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-warning btn-sm edit-btn me-1"
                                                data-id="{{ $produk->id }}" data-bs-toggle="modal"
                                                data-bs-target="#editProdukUMKMModal" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button type="button" class="btn btn-danger btn-sm"
                                                onclick="showDeleteModal({{ $produk->id }}, '{{ addslashes($produk->nama) }}')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">Tidak ada produk ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Produk UMKM Modal -->
    <div class="modal fade" id="createProdukUMKMModal" tabindex="-1" aria-labelledby="createProdukUMKMModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createProdukUMKMModalLabel">Tambah Produk UMKM Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.produkUMKM.store') }}" enctype="multipart/form-data"
                        id="createProdukUMKMForm">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="harga" class="form-label">Harga</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror" id="harga"
                                name="harga" value="{{ old('harga') }}" min="0" step="0.01" required>
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Photo</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*">
                            <small class="form-text text-muted">Unggah file gambar (JPEG, PNG, JPG, GIF). Ukuran maksimum:
                                2MB</small>
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                rows="4" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Simpan Produk UMKM
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Produk UMKM Modal -->
    <div class="modal fade" id="editProdukUMKMModal" tabindex="-1" aria-labelledby="editProdukUMKMModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editProdukUMKMModalLabel">Edit Produk UMKM</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="" enctype="multipart/form-data" id="editProdukUMKMForm">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="edit_nama" class="form-label">Nama Produk</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="edit_nama"
                                name="nama" required>
                            @error('nama')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="edit_harga" class="form-label">Harga</label>
                            <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                id="edit_harga" name="harga" min="0" step="0.01" required>
                            @error('harga')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="edit_foto" class="form-label">Gambar</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="edit_foto"
                                name="foto" accept="image/*">
                            <small class="form-text text-muted">Unggah gambar baru untuk menggantikan gambar saat ini.
                                Biarkan kosong jika ingin mempertahankan gambar yang ada.</small>
                            @error('foto')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="edit_deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="edit_deskripsi" name="deskripsi"
                                rows="4" required></textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">
                                Simpan Perubahan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal for restore and force delete --}}

    <!-- Restore Confirmation Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreModalLabel">Konfirmasi Restore</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengembalikan produk "<span id="restoreProductName"></span>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="restoreForm" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Ya, Kembalikan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Force Delete Confirmation Modal -->
    <div class="modal fade" id="forceDeleteModal" tabindex="-1" aria-labelledby="forceDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="forceDeleteModalLabel">Konfirmasi Hapus Permanen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p class="text-danger"><strong>Peringatan!</strong> Tindakan ini tidak dapat dibatalkan.</p>
                    <p>Apakah Anda yakin ingin menghapus permanen produk "<span id="forceDeleteProductName"></span>"?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="forceDeleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus Permanen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Add this modal with the other modals -->

    <!-- Soft Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus produk "<span id="deleteProductName"></span>"?</p>
                    <p class="text-muted"><small><i class="fas fa-info-circle"></i> Produk yang dihapus masih dapat
                            dikembalikan.</small></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit button clicks (existing code)
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const produkId = this.getAttribute('data-id');

                    // Fetch produk data
                    fetch(`/admin/produkUMKM/${produkId}/edit-modal`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the edit form
                            document.getElementById('edit_nama').value = data.nama;
                            document.getElementById('edit_harga').value = data.harga;
                            document.getElementById('edit_deskripsi').value = data.deskripsi;

                            // Update form action
                            document.getElementById('editProdukUMKMForm').action =
                                `/admin/produkUMKM/${data.id}`;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error loading product data');
                        });
                });
            });
        });

        // Show restore modal
        function showRestoreModal(produkId, produkName) {
            document.getElementById('restoreProductName').textContent = produkName;
            document.getElementById('restoreForm').action = `/admin/produkUMKM/${produkId}/restore`;

            const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
            restoreModal.show();
        }

        // Show force delete modal
        function showForceDeleteModal(produkId, produkName) {
            document.getElementById('forceDeleteProductName').textContent = produkName;
            document.getElementById('forceDeleteForm').action = `/admin/produkUMKM/${produkId}/force-delete`;

            const forceDeleteModal = new bootstrap.Modal(document.getElementById('forceDeleteModal'));
            forceDeleteModal.show();
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit button clicks (existing code)
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const produkId = this.getAttribute('data-id');

                    // Fetch produk data
                    fetch(`/admin/produkUMKM/${produkId}/edit-modal`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the edit form
                            document.getElementById('edit_nama').value = data.nama;
                            document.getElementById('edit_harga').value = data.harga;
                            document.getElementById('edit_deskripsi').value = data.deskripsi;

                            // Update form action
                            document.getElementById('editProdukUMKMForm').action =
                                `/admin/produkUMKM/${data.id}`;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error loading product data');
                        });
                });
            });
        });

        // Show soft delete modal
        function showDeleteModal(produkId, produkName) {
            document.getElementById('deleteProductName').textContent = produkName;
            document.getElementById('deleteForm').action = `/admin/produkUMKM/${produkId}`;

            const deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'));
            deleteModal.show();
        }

        // Show restore modal
        function showRestoreModal(produkId, produkName) {
            document.getElementById('restoreProductName').textContent = produkName;
            document.getElementById('restoreForm').action = `/admin/produkUMKM/${produkId}/restore`;

            const restoreModal = new bootstrap.Modal(document.getElementById('restoreModal'));
            restoreModal.show();
        }

        // Show force delete modal
        function showForceDeleteModal(produkId, produkName) {
            document.getElementById('forceDeleteProductName').textContent = produkName;
            document.getElementById('forceDeleteForm').action = `/admin/produkUMKM/${produkId}/force-delete`;

            const forceDeleteModal = new bootstrap.Modal(document.getElementById('forceDeleteModal'));
            forceDeleteModal.show();
        }
    </script>


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle edit button clicks
            document.querySelectorAll('.edit-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const produkId = this.getAttribute('data-id');

                    // Fetch produk data
                    fetch(`/admin/produkUMKM/${produkId}/edit-modal`)
                        .then(response => response.json())
                        .then(data => {
                            // Populate the edit form
                            document.getElementById('edit_nama').value = data.nama;
                            document.getElementById('edit_harga').value = data.harga;
                            document.getElementById('edit_deskripsi').value = data.deskripsi;

                            // Update form action
                            document.getElementById('editProdukUMKMForm').action =
                                `/admin/produkUMKM/${data.id}`;
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('Error loading product data');
                        });
                });
            });
        });
    </script>
@endsection
