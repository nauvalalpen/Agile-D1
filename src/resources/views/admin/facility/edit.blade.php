@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0">Edit Facility</h5>
                        <a href="{{ route('admin.facilities.index') }}" class="btn btn-sm btn-secondary">
                            <i class="fas fa-arrow-left"></i> Back to List
                        </a>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_fasilitas" class="form-label">Facility Name</label>
                                <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror"
                                    id="nama_fasilitas" name="nama_fasilitas"
                                    value="{{ old('nama_fasilitas', $facility->nama_fasilitas) }}" required>
                                @error('nama_fasilitas')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Location</label>
                                <input type="text" class="form-control @error('lokasi') is-invalid @enderror"
                                    id="lokasi" name="lokasi" value="{{ old('lokasi', $facility->lokasi) }}" required>
                                @error('lokasi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Description</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
                                    required>{{ old('deskripsi', $facility->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="foto" class="form-label">Photo</label>
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto" name="foto" accept="image/*">
                                <small class="form-text text-muted">Upload a new image to replace the current one. Leave
                                    empty to keep the current image.</small>
                                @error('foto')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                @if ($facility->foto)
                                    <div class="mt-2">
                                        <p>Current Image:</p>
                                        <img src="{{ asset('storage/' . $facility->foto) }}"
                                            alt="{{ $facility->nama_fasilitas }}" class="img-thumbnail"
                                            style="max-height: 200px">
                                    </div>
                                @endif
                                <div id="imagePreview" class="mt-2 d-none">
                                    <p>New Image Preview:</p>
                                    <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Update Facility
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        // Image preview functionality
        document.getElementById('foto').addEventListener('change', function(event) {
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
    </script>
@endsection
