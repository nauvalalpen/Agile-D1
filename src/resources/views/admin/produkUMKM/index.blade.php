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
                                            <form action="{{ route('admin.produkUMKM.restore', $produk->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                <button type="submit" class="btn btn-success btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin mengembalikan produk ini')">
                                                    <i class="fas fa-undo"></i> Pulihkan
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.produkUMKM.force-delete', $produk->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus permanen produk ini?')">
                                                    <i class="fas fa-trash"></i> Hapus Permanen
                                                </button>
                                            </form>
                                        @else
                                            <button type="button" class="btn btn-warning btn-sm edit-btn"
                                                data-id="{{ $produk->id }}" data-bs-toggle="modal"
                                                data-bs-target="#editProdukUMKMModal">
                                                <i class="fas fa-edit"></i> Edit
                                            </button>
                                            <form action="{{ route('admin.produkUMKM.destroy', $produk->id) }}"
                                                method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus produk ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
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
                            <small class="form-text text-muted">Unggah gambar baru untuk menggantikan gambar saat ini. Biarkan kosong jika ingin mempertahankan gambar yang ada.</small>
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
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Perbarui Produk UMKM
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
