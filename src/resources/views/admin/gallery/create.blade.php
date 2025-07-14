<form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data" id="createGalleryForm">
    @csrf

    <div class="mb-3">
        <label for="judul" class="form-label">Judul</label>
        <input 
            type="text" 
            class="form-control @error('judul') is-invalid @enderror" 
            id="judul" 
            name="judul" 
            value="{{ old('judul') }}" 
            required
        >
        @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="deskripsi" class="form-label">Deskripsi</label>
        <textarea 
            class="form-control @error('deskripsi') is-invalid @enderror" 
            id="deskripsi" 
            name="deskripsi" 
            rows="5" 
            required
        >{{ old('deskripsi') }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="foto" class="form-label">Foto</label>
        <input 
            type="file" 
            class="form-control @error('foto') is-invalid @enderror" 
            id="foto" 
            name="foto" 
            accept="image/*"
            required
        >
        <small class="form-text text-muted">Upload gambar (jpeg, png, jpg, gif). Max size: 2MB.</small>
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <div id="imagePreview" class="mt-2 d-none">
            <p>Preview Gambar:</p>
            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
        </div>
    </div>

    <div class="modal-footer px-0 pb-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-primary">Tambah Galeri</button>
    </div>
</form>

<script>
    document.getElementById('foto').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview');
        const previewImg = preview.querySelector('img');

        if (event.target.files.length > 0) {
            const file = event.target.files[0];
            const url = URL.createObjectURL(file);
            previewImg.src = url;
            preview.classList.remove('d-none');
        } else {
            previewImg.src = '';
            preview.classList.add('d-none');
        }
    });
</script>
