<form action="{{ route('admin.facilities.store') }}" method="POST" enctype="multipart/form-data" id="createFacilityForm">
    @csrf
    <div class="mb-3">
        <label for="nama_fasilitas" class="form-label">Facility Name</label>
        <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror" id="nama_fasilitas"
            name="nama_fasilitas" value="{{ old('nama_fasilitas') }}" required>
        @error('nama_fasilitas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="lokasi" class="form-label">Location</label>
        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi"
            value="{{ old('lokasi') }}" required>
        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Description</label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5"
            required>{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Photo</label>
        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto" name="foto"
            accept="image/*">
        <small class="form-text text-muted">Upload an image (JPEG, PNG, JPG, GIF). Max size: 2MB</small>
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <div id="imagePreview" class="mt-2 d-none">
            <p>Image Preview:</p>
            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
        </div>
    </div>

    <div class="modal-footer px-0 pb-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Save Facility</button>
    </div>
</form>

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
