<form action="{{ route('admin.facilities.update', $facility->id) }}" method="POST" enctype="multipart/form-data"
    id="editFacilityForm{{ $facility->id }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="nama_fasilitas{{ $facility->id }}" class="form-label">Facility Name</label>
        <input type="text" class="form-control @error('nama_fasilitas') is-invalid @enderror"
            id="nama_fasilitas{{ $facility->id }}" name="nama_fasilitas"
            value="{{ old('nama_fasilitas', $facility->nama_fasilitas) }}" required>
        @error('nama_fasilitas')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="lokasi{{ $facility->id }}" class="form-label">Location</label>
        <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi{{ $facility->id }}"
            name="lokasi" value="{{ old('lokasi', $facility->lokasi) }}" required>
        @error('lokasi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="deskripsi{{ $facility->id }}" class="form-label">Description</label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi{{ $facility->id }}"
            name="deskripsi" rows="5" required>{{ old('deskripsi', $facility->deskripsi) }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="foto{{ $facility->id }}" class="form-label">Photo</label>
        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto{{ $facility->id }}"
            name="foto" accept="image/*">
        <small class="form-text text-muted">Upload a new image to replace the current one. Leave empty to keep the
            current image.</small>
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    @if ($facility->foto)
        <div class="mb-3">
            <p>Current Image:</p>
            <img src="{{ asset('storage/' . $facility->foto) }}" alt="{{ $facility->nama_fasilitas }}"
                class="img-thumbnail" style="max-height: 200px">
        </div>
    @endif

    <div class="mb-3">
        <div id="imagePreview{{ $facility->id }}" class="mt-2 d-none">
            <p>New Image Preview:</p>
            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px">
        </div>
    </div>

    <div class="modal-footer px-0 pb-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update Facility</button>
    </div>
</form>

<script>
    // Image preview functionality
    document.getElementById('foto{{ $facility->id }}').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview{{ $facility->id }}');
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
