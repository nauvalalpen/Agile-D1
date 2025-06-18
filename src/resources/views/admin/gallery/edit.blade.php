<form action="{{ route('admin.gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data"
    id="editGalleryForm{{ $gallery->id }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="judul{{ $gallery->id }}" class="form-label">Judul</label>
        <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul{{ $gallery->id }}"
            name="judul" value="{{ old('judul', $gallery->judul) }}" placeholder="Masukkan judul foto" required>
        @error('judul')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="deskripsi{{ $gallery->id }}" class="form-label">Deskripsi</label>
        <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi{{ $gallery->id }}"
            name="deskripsi" rows="3" placeholder="Tuliskan deskripsi singkat" required>{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
        @error('deskripsi')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Add hidden tanggal field -->
    <input type="hidden" name="tanggal" value="{{ $gallery->tanggal ?? $gallery->created_at->format('Y-m-d') }}">

    <div class="mb-3">
        <label for="foto{{ $gallery->id }}" class="form-label">Ganti Foto</label>
        <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto{{ $gallery->id }}"
            name="foto" accept="image/*">
        <small class="text-muted">Kosongkan jika tidak ingin mengganti foto.</small>
        @error('foto')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    @if ($gallery->foto)
        <div class="mb-3">
            <label class="form-label">Foto Saat Ini:</label><br>
            <img src="{{ asset('storage/' . $gallery->foto) }}" alt="{{ $gallery->judul }}" class="img-thumbnail"
                style="max-width: 100%; height: auto; max-height: 200px;">
        </div>
    @endif

    <div class="mb-3 d-none" id="imagePreview{{ $gallery->id }}">
        <label class="form-label">Preview Foto Baru:</label><br>
        <img src="" alt="Preview" class="img-thumbnail"
            style="max-width: 100%; height: auto; max-height: 200px;">
    </div>

    <div class="modal-footer px-0 pb-0">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Simpan Perubahan</button>
    </div>
</form>

<script>
    document.getElementById('foto{{ $gallery->id }}').addEventListener('change', function(event) {
        const preview = document.getElementById('imagePreview{{ $gallery->id }}');
        const img = preview.querySelector('img');

        if (event.target.files && event.target.files[0]) {
            img.src = URL.createObjectURL(event.target.files[0]);
            preview.classList.remove('d-none');
        } else {
            img.src = '';
            preview.classList.add('d-none');
        }
    });
</script>
