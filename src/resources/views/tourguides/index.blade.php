@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Tour Guides Management</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTourGuideModal">
                <i class="fas fa-plus fa-sm"></i> Add New Tour Guide
            </button>
        </div>

        <!-- Alert Messages -->
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <!-- Search, Filter and Sort Controls -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Search & Filter</h6>
            </div>
            <div class="card-body">
                <form action="{{ route('tourguides.index') }}" method="GET" class="mb-0">
                    <div class="row g-3 align-items-center">
                        <!-- Search -->
                        <div class="col-md-4">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search" name="search"
                                    placeholder="Search by name, address or description" value="{{ request('search') }}">
                                <button class="btn btn-outline-secondary" type="submit">
                                    <i class="fas fa-search"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Price Range Filter -->
                        <div class="col-md-3">
                            <select class="form-select" name="price_filter">
                                <option value="">All Price Ranges</option>
                                <option value="100-200" {{ request('price_filter') == '100-200' ? 'selected' : '' }}>Rp
                                    100.000 - Rp 200.000</option>
                                <option value="200-300" {{ request('price_filter') == '200-300' ? 'selected' : '' }}>Rp
                                    200.000 - Rp 300.000</option>
                                <option value="300-400" {{ request('price_filter') == '300-400' ? 'selected' : '' }}>Rp
                                    300.000 - Rp 400.000</option>
                                <option value="400" {{ request('price_filter') == '400' ? 'selected' : '' }}>Above Rp
                                    400.000</option>
                            </select>
                        </div>

                        <!-- Sort By -->
                        <div class="col-md-3">
                            <div class="input-group">
                                <select class="form-select" name="sort_by">
                                    <option value="id" {{ request('sort_by') == 'id' ? 'selected' : '' }}>ID</option>
                                    <option value="nama" {{ request('sort_by') == 'nama' ? 'selected' : '' }}>Name
                                    </option>
                                    <option value="price_range" {{ request('sort_by') == 'price_range' ? 'selected' : '' }}>
                                        Price Range</option>
                                    <option value="created_at" {{ request('sort_by') == 'created_at' ? 'selected' : '' }}>
                                        Date Added</option>
                                </select>
                                <select class="form-select" name="sort_direction">
                                    <option value="asc" {{ request('sort_direction') == 'asc' ? 'selected' : '' }}>
                                        Ascending</option>
                                    <option value="desc" {{ request('sort_direction') == 'desc' ? 'selected' : '' }}>
                                        Descending</option>
                                </select>
                            </div>
                        </div>

                        <!-- Apply/Reset Buttons -->
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-primary">Apply</button>
                            <a href="{{ route('tourguides.index') }}" class="btn btn-secondary">Reset</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tour Guides DataTable -->
        <div class="card shadow mb-4">
            <div class="card-header py-3 d-flex justify-content-between align-items-center">
                <h6 class="m-0 font-weight-bold text-primary">Tour Guides</h6>
                <span>Showing {{ $tourguides->firstItem() ?? 0 }} to {{ $tourguides->lastItem() ?? 0 }} of
                    {{ $tourguides->total() }} entries</span>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>No HP</th>
                                <th>Alamat</th>
                                <th>Price Range</th>
                                <th>Deskripsi</th>
                                <th>Foto</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tourguides as $tourguide)
                                <tr>
                                    <td>{{ $tourguide->id }}</td>
                                    <td>{{ $tourguide->nama }}</td>
                                    <td>{{ $tourguide->nohp }}</td>
                                    <td>{{ $tourguide->alamat }}</td>
                                    <td>{{ $tourguide->price_range }}</td>
                                    <td>{{ Str::limit($tourguide->deskripsi, 50) }}</td>
                                    <td>
                                        @if ($tourguide->foto)
                                            <img src="{{ asset('storage/' . $tourguide->foto) }}" class="img-thumbnail"
                                                alt="{{ $tourguide->nama }}" style="max-height: 100px;">
                                        @else
                                            <span class="text-muted">No image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex">
                                            <button type="button" class="btn btn-sm btn-info me-2" data-bs-toggle="modal"
                                                data-bs-target="#editTourGuideModal{{ $tourguide->id }}">
                                                <i class="fas fa-edit fa-sm"></i> Edit
                                            </button>
                                            <button type="button" class="btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#deleteTourGuideModal{{ $tourguide->id }}">
                                                <i class="fas fa-trash fa-sm"></i> Delete
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No tour guides found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-center mt-4">
                    @if ($tourguides->hasPages())
                        <nav>
                            <ul class="pagination">
                                {{-- Previous Page Link --}}
                                @if ($tourguides->onFirstPage())
                                    <li class="page-item disabled">
                                        <span class="page-link">&laquo;</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tourguides->previousPageUrl() }}"
                                            rel="prev">&laquo;</a>
                                    </li>
                                @endif

                                {{-- Pagination Elements --}}
                                @foreach ($tourguides->getUrlRange(1, $tourguides->lastPage()) as $page => $url)
                                    @if ($page == $tourguides->currentPage())
                                        <li class="page-item active">
                                            <span class="page-link">{{ $page }}</span>
                                        </li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endif
                                @endforeach

                                {{-- Next Page Link --}}
                                @if ($tourguides->hasMorePages())
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $tourguides->nextPageUrl() }}"
                                            rel="next">&raquo;</a>
                                    </li>
                                @else
                                    <li class="page-item disabled">
                                        <span class="page-link">&raquo;</span>
                                    </li>
                                @endif
                            </ul>
                        </nav>
                    @endif
                </div>

            </div>
        </div>
    </div>

    <!-- Create Tour Guide Modal -->
    <div class="modal fade" id="createTourGuideModal" tabindex="-1" aria-labelledby="createTourGuideModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTourGuideModalLabel">Add New Tour Guide</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('tourguides.store') }}" enctype="multipart/form-data"
                        id="createTourGuideForm">
                        @csrf

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama</label>
                            <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama"
                                name="nama" value="{{ old('nama') }}" required>
                            @error('nama')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nohp" class="form-label">No HP</label>
                            <input type="text" class="form-control @error('nohp') is-invalid @enderror" id="nohp"
                                name="nohp" value="{{ old('nohp') }}" required>
                            @error('nohp')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="alamat" class="form-label">Alamat</label>
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                id="alamat" name="alamat" value="{{ old('alamat') }}" required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="pricerange" class="form-label">Price Range</label>
                            <input type="text" class="form-control @error('pricerange') is-invalid @enderror"
                                id="pricerange" name="pricerange" value="{{ old('pricerange') }}" required>
                            @error('pricerange')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi"
                                rows="3" required>{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="foto">Photo</label>
                            <input type="file" class="form-control @error('foto') is-invalid @enderror" id="foto"
                                name="foto">
                            @error('foto')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('createTourGuideForm').submit()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Tour Guide Modals -->
    @foreach ($tourguides as $tourguide)
        <div class="modal fade" id="editTourGuideModal{{ $tourguide->id }}" tabindex="-1"
            aria-labelledby="editTourGuideModalLabel{{ $tourguide->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTourGuideModalLabel{{ $tourguide->id }}">Edit Tour Guide</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('tourguides.update', $tourguide->id) }}"
                            enctype="multipart/form-data" id="editTourGuideForm{{ $tourguide->id }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama{{ $tourguide->id }}" class="form-label">Nama</label>
                                <input type="text" class="form-control @error('nama') is-invalid @enderror"
                                    id="nama{{ $tourguide->id }}" name="nama"
                                    value="{{ old('nama', $tourguide->nama) }}" required>
                                @error('nama')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nohp{{ $tourguide->id }}" class="form-label">No HP</label>
                                <input type="text" class="form-control @error('nohp') is-invalid @enderror"
                                    id="nohp{{ $tourguide->id }}" name="nohp"
                                    value="{{ old('nohp', $tourguide->nohp) }}" required>
                                @error('nohp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat{{ $tourguide->id }}" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat{{ $tourguide->id }}" name="alamat"
                                    value="{{ old('alamat', $tourguide->alamat) }}" required>
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="pricerange{{ $tourguide->id }}" class="form-label">Price Range</label>
                                <input type="text" class="form-control @error('pricerange') is-invalid @enderror"
                                    id="pricerange{{ $tourguide->id }}" name="pricerange"
                                    value="{{ old('pricerange', $tourguide->price_range) }}" required>
                                @error('pricerange')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="deskripsi{{ $tourguide->id }}" class="form-label">Deskripsi</label>
                                <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi{{ $tourguide->id }}"
                                    name="deskripsi" rows="3" required>{{ old('deskripsi', $tourguide->deskripsi) }}</textarea>
                                @error('deskripsi')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group mb-3">
                                <label for="foto{{ $tourguide->id }}">Photo</label>
                                @if ($tourguide->foto)
                                    <div class="mb-2">
                                        <img src="{{ asset('storage/' . $tourguide->foto) }}" alt="Current Photo"
                                            style="max-height: 100px;">
                                    </div>
                                @endif
                                <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                    id="foto{{ $tourguide->id }}" name="foto">
                                <small class="form-text text-muted">Leave empty to keep the current photo</small>
                                @error('foto')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="document.getElementById('editTourGuideForm{{ $tourguide->id }}').submit()">Update</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Delete Tour Guide Modals -->
    @foreach ($tourguides as $tourguide)
        <div class="modal fade" id="deleteTourGuideModal{{ $tourguide->id }}" tabindex="-1"
            aria-labelledby="deleteTourGuideModalLabel{{ $tourguide->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteTourGuideModalLabel{{ $tourguide->id }}">Confirm Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <p>Are you sure you want to delete the tour guide: <strong>{{ $tourguide->nama }}</strong>?</p>
                        <p class="text-danger">This action cannot be undone.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <form action="{{ route('tourguides.destroy', $tourguide->id) }}" method="POST"
                            id="deleteTourGuideForm{{ $tourguide->id }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Show validation errors in modal if they exist
            @if ($errors->any())
                const createModal = new bootstrap.Modal(document.getElementById('createTourGuideModal'));
                createModal.show();
            @endif

            // Check URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Open create modal if parameter exists
            if (urlParams.has('openCreateModal')) {
                const createModal = new bootstrap.Modal(document.getElementById('createTourGuideModal'));
                createModal.show();

                // Clean up URL to prevent modal reopening on refresh
                window.history.replaceState({}, document.title, "{{ route('tourguides.index') }}");
            }

            // Open edit modal if parameter exists
            if (urlParams.has('openEditModal')) {
                const editId = urlParams.get('openEditModal');
                const editModal = new bootstrap.Modal(document.getElementById('editTourGuideModal' + editId));
                editModal.show();

                // Clean up URL to prevent modal reopening on refresh
                window.history.replaceState({}, document.title, "{{ route('tourguides.index') }}");
            }

            // Properly handle modal closing
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    // Remove modal backdrop if it exists
                    const backdrop = document.querySelector('.modal-backdrop');
                    if (backdrop) {
                        backdrop.remove();
                    }

                    // Remove modal-open class from body
                    document.body.classList.remove('modal-open');
                    document.body.style.overflow = '';
                    document.body.style.paddingRight = '';
                });
            });
        });
    </script>
@endpush
