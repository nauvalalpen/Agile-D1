@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Add New Produk UMKM</h1>
            <a href="{{ route('admin.produkUMKM.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left fa-sm"></i> Back to List
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Product Information</h6>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.produkUMKM.store') }}" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Produk</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama" name="nama" value="{{ old('nama') }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga</label>
                                <input type="number" class="form-control @error('harga') is-invalid @enderror"
                                    id="harga" name="harga" value="{{ old('harga') }}" min="0" step="0.01"
                                    required>
                                @error('harga')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="foto" class="form-label">Foto Produk</label>
                        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                            name="foto" accept="image/*">
                        <small class="form-text text-muted">Upload image file (JPEG, PNG, JPG, GIF). Max size: 2MB</small>
                        @error('foto')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                            required>{{ old('deskripsi') }}</textarea>
                        @error('deskripsi')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Save Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
