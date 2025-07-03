@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Galeri</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createGalleryModal">
                <i class="fas fa-plus"></i> Tambah Galeri Baru
            </button>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Galeri</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="galleryTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Tanggal Upload</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($galleries as $index => $gallery)
                                <tr class="{{ $gallery->deleted_at ? 'table-danger' : '' }}">
                                    {{-- <td>{{ $index + 1 }}</td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $gallery->judul }}</td>
                                    <td>{{ Str::limit($gallery->deskripsi, 50) }}</td>
                                    <td>
                                        @if ($gallery->foto)
                                            <img src="{{ asset('storage/' . $gallery->foto) }}" alt="{{ $gallery->judul }}"
                                                width="60" height="60" class="img-thumbnail cursor-pointer"
                                                onclick="showImageModal('{{ asset('storage/' . $gallery->foto) }}', '{{ $gallery->judul }}')">
                                        @else
                                            <span class="badge bg-secondary">No Image</span>
                                        @endif
                                    </td>
                                    <td>{{ $gallery->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        @if ($gallery->deleted_at)
                                            <span class="badge bg-danger">Dihapus</span>
                                        @else
                                            <span class="badge bg-success">Aktif</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($gallery->deleted_at)
                                            <!-- Restore Button -->
                                            <button type="button" class="btn btn-sm btn-success me-1"
                                                onclick="showRestoreModal({{ $gallery->id }}, '{{ addslashes($gallery->judul) }}')"
                                                title="Restore">
                                                <i class="fas fa-trash-restore"></i>
                                            </button>
                                            <!-- Force Delete Button -->
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="showForceDeleteModal({{ $gallery->id }}, '{{ addslashes($gallery->judul) }}')"
                                                title="Permanently Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        @else
                                            <!-- View Details Button -->
                                            <button type="button" class="btn btn-sm btn-info me-1"
                                                onclick="showDetailsModal({{ $gallery->id }})" title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </button>
                                            <!-- Edit Button -->
                                            <button type="button" class="btn btn-sm btn-warning me-1"
                                                onclick="showEditModal({{ $gallery->id }})" title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <!-- Delete Button -->
                                            <button type="button" class="btn btn-sm btn-danger"
                                                onclick="showDeleteModal({{ $gallery->id }}, '{{ addslashes($gallery->judul) }}')"
                                                title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center">Data galeri tidak tersedia.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Gallery Modal -->
    <div class="modal fade" id="createGalleryModal" tabindex="-1" aria-labelledby="createGalleryModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createGalleryModalLabel">Tambah Gallery Baru</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.gallery.store') }}" method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        @csrf
                        <div class="mb-3">
                            <label for="judul" class="form-label">Judul</label>
                            <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul"
                                name="judul" value="{{ old('judul') }}" required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="4"
                                required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto" accept="image/*" required>
                            <small class="form-text text-muted">Upload gambar (jpeg, png, jpg, gif). Max size: 2MB.</small>
                            @error('foto')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 d-none" id="createImagePreview">
                            <label class="form-label">Preview:</label><br>
                            <img src="" alt="Preview" class="img-thumbnail" style="max-height: 200px;">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Tambah Gallery</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View Details Modal -->
    <div class="modal fade" id="detailsModal" tabindex="-1" aria-labelledby="detailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="detailsModalLabel">Gallery Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="detailsModalBody">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Gallery</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="editModalBody">
                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Image View Modal -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">View Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">
                    <img src="" alt="" id="modalImage" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin menghapus gallery <strong id="deleteItemName"></strong>?</p>
                    <p class="text-muted">Data akan dipindahkan ke trash dan dapat dikembalikan.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Restore Confirmation Modal -->
    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="restoreModalLabel">Konfirmasi Restore</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Apakah Anda yakin ingin mengembalikan gallery <strong id="restoreItemName"></strong>?</p>
                    <p class="text-success">Gallery akan dipulihkan dan kembali aktif.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="restoreForm" method="POST" style="display: inline;">
                        @csrf
                        <button type="submit" class="btn btn-success">Restore</button>
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
                    <h5 class="modal-title" id="forceDeleteModalLabel">Hapus Permanen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Anda akan menghapus secara permanen gallery <strong id="forceDeleteItemName"></strong>.</p>
                    <p class="text-danger fw-bold">Tindakan ini tidak dapat dibatalkan!</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form id="forceDeleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Hapus Permanen</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        // Wait for DOM to be fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            console.log('DOM loaded, initializing gallery functions...');

            // Initialize DataTable if available
            if (typeof $.fn.DataTable !== 'undefined') {
                $('#galleryTable').DataTable({
                    responsive: true,
                    pageLength: 10,
                    order: [
                        [0, 'asc']
                    ]
                });
            }

            // Image preview for create form
            const createFotoInput = document.getElementById('foto');
            if (createFotoInput) {
                createFotoInput.addEventListener('change', function(event) {
                    const preview = document.getElementById('createImagePreview');
                    const img = preview.querySelector('img');

                    if (event.target.files && event.target.files[0]) {
                        const file = event.target.files[0];
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            img.src = e.target.result;
                            preview.classList.remove('d-none');
                        };
                        reader.readAsDataURL(file);
                    } else {
                        preview.classList.add('d-none');
                        img.src = '';
                    }
                });
            }

            // Modal cleanup function
            function cleanupModals() {
                // Remove all modal backdrops
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });

                // Reset body styles
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';

                // Hide all modals
                document.querySelectorAll('.modal').forEach(modal => {
                    modal.classList.remove('show');
                    modal.style.display = 'none';
                    modal.setAttribute('aria-hidden', 'true');
                });
            }

            // Add event listeners to all modal close events
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(cleanupModals, 100);
                });
            });

            // Handle ESC key
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    setTimeout(cleanupModals, 100);
                }
            });

            // Make functions globally available
            window.showImageModal = showImageModal;
            window.showDetailsModal = showDetailsModal;
            window.showEditModal = showEditModal;
            window.showDeleteModal = showDeleteModal;
            window.showRestoreModal = showRestoreModal;
            window.showForceDeleteModal = showForceDeleteModal;
        });

        // Show image in modal
        function showImageModal(imageSrc, imageTitle) {
            console.log('Showing image modal for:', imageTitle);

            const modal = document.getElementById('imageModal');
            const modalImage = document.getElementById('modalImage');
            const modalLabel = document.getElementById('imageModalLabel');

            if (!modal || !modalImage || !modalLabel) {
                console.error('Image modal elements not found');
                return;
            }

            modalImage.src = imageSrc;
            modalImage.alt = imageTitle;
            modalLabel.textContent = imageTitle;

            const bsModal = new bootstrap.Modal(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            bsModal.show();
        }

        // Show details modal
        function showDetailsModal(galleryId) {
            console.log('Showing details modal for gallery ID:', galleryId);

            const modal = document.getElementById('detailsModal');
            const modalBody = document.getElementById('detailsModalBody');

            if (!modal || !modalBody) {
                console.error('Details modal elements not found');
                return;
            }

            // Show loading
            modalBody.innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading gallery details...</p>
        </div>
    `;

            const bsModal = new bootstrap.Modal(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            bsModal.show();

            // Fetch gallery details
            fetch(`/admin/gallery/${galleryId}/details`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.json();
                })
                .then(data => {
                    console.log('Received data:', data);
                    if (data.success) {
                        const gallery = data.data;
                        modalBody.innerHTML = `
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold">ID:</h6>
                        <p>${gallery.id}</p>
                        
                        <h6 class="fw-bold">Judul:</h6>
                        <p>${gallery.judul}</p>
                        
                        <h6 class="fw-bold">Deskripsi:</h6>
                        <p>${gallery.deskripsi.replace(/\n/g, '<br>')}</p>
                        
                        <h6 class="fw-bold">Tanggal Upload:</h6>
                        <p>${gallery.created_at}</p>
                        
                        <h6 class="fw-bold">Terakhir Diupdate:</h6>
                        <p>${gallery.updated_at}</p>
                        
                        <h6 class="fw-bold">Status:</h6>
                        <p><span class="badge ${gallery.status === 'Active' ? 'bg-success' : 'bg-danger'}">${gallery.status}</span></p>
                        
                        ${gallery.deleted_at ? `
                                                    <h6 class="fw-bold">Tanggal Dihapus:</h6>
                                                    <p>${gallery.deleted_at}</p>
                                                    ` : ''}
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Foto:</h6>
                        ${gallery.foto ? 
                            `<img src="${gallery.foto}" alt="${gallery.judul}" class="img-fluid rounded" style="max-height: 300px; cursor: pointer;" onclick="showImageModal('${gallery.foto}', '${gallery.judul}')">` : 
                            '<p class="text-muted">No image available</p>'
                        }
                    </div>
                </div>
            `;
                    } else {
                        throw new Error(data.message || 'Failed to load gallery details');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalBody.innerHTML = `
            <div class="alert alert-danger">
                <h5><i class="fas fa-exclamation-triangle"></i> Error Loading Details</h5>
                <p>Unable to load gallery details. Please try again.</p>
                <p class="mb-0"><small>Error: ${error.message}</small></p>
                <button class="btn btn-sm btn-outline-danger mt-2" onclick="showDetailsModal(${galleryId})">
                    <i class="fas fa-redo"></i> Retry
                </button>
            </div>
        `;
                });
        }

        // Show edit modal
        function showEditModal(galleryId) {
            console.log('Showing edit modal for gallery ID:', galleryId);

            const modal = document.getElementById('editModal');
            const modalBody = document.getElementById('editModalBody');

            if (!modal || !modalBody) {
                console.error('Edit modal elements not found');
                return;
            }

            // Show loading
            modalBody.innerHTML = `
        <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
            <p class="mt-2">Loading edit form...</p>
        </div>
    `;

            const bsModal = new bootstrap.Modal(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            bsModal.show();

            // Fetch edit form
            fetch(`/admin/gallery/${galleryId}/edit-modal`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'text/html',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                })
                .then(response => {
                    console.log('Edit form response status:', response.status);
                    if (!response.ok) {
                        throw new Error(`HTTP error! status: ${response.status}`);
                    }
                    return response.text();
                })
                .then(html => {
                    modalBody.innerHTML = html;

                    // Initialize image preview for edit form
                    const editFotoInput = modalBody.querySelector('input[type="file"]');
                    if (editFotoInput) {
                        editFotoInput.addEventListener('change', function(event) {
                            const preview = modalBody.querySelector('[id^="imagePreview"]');
                            if (preview) {
                                const img = preview.querySelector('img');
                                if (event.target.files && event.target.files[0]) {
                                    const file = event.target.files[0];
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        img.src = e.target.result;
                                        preview.classList.remove('d-none');
                                    };
                                    reader.readAsDataURL(file);
                                } else {
                                    preview.classList.add('d-none');
                                    img.src = '';
                                }
                            }
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    modalBody.innerHTML = `
            <div class="alert alert-danger">
                <h5><i class="fas fa-exclamation-triangle"></i> Error Loading Edit Form</h5>
                <p>Unable to load edit form. Please try again.</p>
                <p class="mb-0"><small>Error: ${error.message}</small></p>
                <button class="btn btn-sm btn-outline-danger mt-2" onclick="showEditModal(${galleryId})">
                    <i class="fas fa-redo"></i> Retry
                </button>
            </div>
        `;
                });
        }

        // Show delete confirmation modal
        function showDeleteModal(galleryId, galleryTitle) {
            console.log('Showing delete modal for:', galleryTitle);

            const modal = document.getElementById('deleteModal');
            const form = document.getElementById('deleteForm');
            const itemName = document.getElementById('deleteItemName');

            if (!modal || !form || !itemName) {
                console.error('Delete modal elements not found');
                return;
            }

            itemName.textContent = galleryTitle;
            form.action = `/admin/gallery/${galleryId}`;

            const bsModal = new bootstrap.Modal(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            bsModal.show();
        }

        // Show restore confirmation modal
        function showRestoreModal(galleryId, galleryTitle) {
            console.log('Showing restore modal for:', galleryTitle);

            const modal = document.getElementById('restoreModal');
            const form = document.getElementById('restoreForm');
            const itemName = document.getElementById('restoreItemName');

            if (!modal || !form || !itemName) {
                console.error('Restore modal elements not found');
                return;
            }

            itemName.textContent = galleryTitle;
            form.action = `/admin/gallery/${galleryId}/restore`;

            const bsModal = new bootstrap.Modal(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            bsModal.show();
        }

        // Show force delete confirmation modal
        function showForceDeleteModal(galleryId, galleryTitle) {
            console.log('Showing force delete modal for:', galleryTitle);

            const modal = document.getElementById('forceDeleteModal');
            const form = document.getElementById('forceDeleteForm');
            const itemName = document.getElementById('forceDeleteItemName');

            if (!modal || !form || !itemName) {
                console.error('Force delete modal elements not found');
                return;
            }

            itemName.textContent = galleryTitle;
            form.action = `/admin/gallery/${galleryId}/force-delete`;

            const bsModal = new bootstrap.Modal(modal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            bsModal.show();
        }
    </script>
@endpush

@push('styles')
    <style>
        .cursor-pointer {
            cursor: pointer;
        }

        .img-thumbnail:hover {
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }

        /* Modal z-index fixes */
        .modal-backdrop {
            z-index: 1040 !important;
        }

        .modal {
            z-index: 1050 !important;
        }

        .modal.show {
            display: block !important;
        }

        /* Ensure proper modal behavior */
        .modal-open {
            overflow: hidden !important;
        }

        /* Loading spinner styling */
        .spinner-border {
            width: 3rem;
            height: 3rem;
        }

        /* Button spacing */
        .btn+.btn {
            margin-left: 0.25rem;
        }

        /* Table responsive improvements */
        @media (max-width: 768px) {
            .table-responsive {
                font-size: 0.875rem;
            }

            .btn-sm {
                padding: 0.25rem 0.5rem;
                font-size: 0.75rem;
            }

            .btn-sm i {
                font-size: 0.75rem;
            }
        }

        /* Fix for potential backdrop issues */
        body.modal-open {
            padding-right: 0 !important;
        }

        /* Ensure modals are properly positioned */
        .modal-dialog {
            margin: 1.75rem auto;
        }

        /* Image modal specific styles */
        #imageModal .modal-body {
            padding: 1rem;
        }

        #imageModal img {
            max-width: 100%;
            height: auto;
            border-radius: 0.375rem;
        }

        /* Details modal specific styles */
        #detailsModal .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }

        /* Edit modal specific styles */
        #editModal .modal-body {
            max-height: 70vh;
            overflow-y: auto;
        }

        /* Alert styling in modals */
        .modal .alert {
            margin-bottom: 0;
        }

        .modal .alert:last-child {
            margin-bottom: 0;
        }
    </style>
@endpush
