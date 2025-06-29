@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Wisatawan</h1>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createTouristsModal">
                <i class="fas fa-plus"></i> Tambah Tiket Masuk
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
                <h6 class="m-0 font-weight-bold text-primary">Daftar Wisatawan</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Nama Ketua</th>
                                <th>Jumlah Rombongan</th>
                                <th>Nomor HP</th>
                                <th>Alamat</th>
                                <th>Waktu Masuk</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($tikets as $tiket)
                                <tr class="{{ $tiket->deleted_at ? 'table-danger' : '' }}">
                                    {{-- <td>{{ $tiket->id }}</td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tiket->nama_ketua }}</td>
                                    <td>{{ $tiket->jumlah_rombongan }}</td>
                                    <td>{{ $tiket->nohp }}</td>
                                    <td>{{ $tiket->alamat }}</td>
                                    <td>{{ $tiket->created_at->format('d M Y H:i') }}</td>
                                    <td class="text-center">
                                        <form action="{{ route('admin.tiketmasuks.updateStatus', $tiket->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit"
                                                class="btn btn-sm {{ $tiket->status === 'selesai' ? 'btn-secondary' : 'btn-success' }}"
                                                {{ $tiket->status === 'selesai' ? 'disabled' : '' }}>
                                                Selesai
                                            </button>
                                        </form>

                                        @if ($tiket->status === 'selesai' && $tiket->waktu_selesai)
                                            <div class="mt-1 text-muted" style="font-size: 0.85rem;">
                                                {{ $tiket->waktu_selesai->format('d M Y H:i') }}
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-warning" data-bs-toggle="modal"
                                            data-bs-target="#editTouristsModal{{ $tiket->id }}">
                                            <i class="fas fa-edit fa-sm"></i> Edit
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">Data wisatawan tidak ditemukan.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Tour Guide Modal -->
    <div class="modal fade" id="createTouristsModal" tabindex="-1" aria-labelledby="createTouristsLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createTouristsLabel">Form Tiket Masuk</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('admin.tiketmasuks.store') }}" enctype="multipart/form-data"
                        id="createTouristsForm">
                        @csrf

                        <div class="mb-3">
                            <label for="nama_ketua" class="form-label">Nama Ketua Rombongan</label>
                            <input type="text" class="form-control @error('nama_ketua') is-invalid @enderror"
                                id="nama_ketua" name="nama_ketua" value="{{ old('nama_ketua') }}" required>
                            @error('nama_ketua')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="jumlah_rombongan" class="form-label">Jumlah Rombongan</label>
                            <input type="number" class="form-control @error('jumlah_rombongan') is-invalid @enderror"
                                id="jumlah_rombongan" name="jumlah_rombongan" value="{{ old('jumlah_rombongan') }}"
                                required>
                            @error('jumlah_rombongan')
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
                            <input type="text" class="form-control @error('alamat') is-invalid @enderror" id="alamat"
                                name="alamat" value="{{ old('alamat') }}" required>
                            @error('alamat')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary"
                        onclick="document.getElementById('createTouristsForm').submit()">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Tourist Modals -->
    @foreach ($tikets as $tiket)
        <div class="modal fade" id="editTouristsModal{{ $tiket->id }}" tabindex="-1"
            aria-labelledby="editTouristsModalLabel{{ $tiket->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editTouristsModalLabel{{ $tiket->id }}">Edit Tiket Masuk</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="{{ route('admin.tiketmasuks.update', $tiket->id) }}"
                            enctype="multipart/form-data" id="editTouristsForm{{ $tiket->id }}">
                            @csrf
                            @method('PUT')

                            <div class="mb-3">
                                <label for="nama_ketua{{ $tiket->id }}" class="form-label">Nama Ketua
                                    Rombongan</label>
                                <input type="text" class="form-control @error('nama_ketua') is-invalid @enderror"
                                    id="nama_ketua{{ $tiket->id }}" name="nama_ketua"
                                    value="{{ old('nama_ketua', $tiket->nama_ketua) }}">
                                @error('nama_ketua')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="jumlah_rombongan{{ $tiket->id }}" class="form-label">Jumlah
                                    Rombongan</label>
                                <input type="number" class="form-control @error('jumlah_rombongan') is-invalid @enderror"
                                    id="jumlah_rombongan{{ $tiket->id }}" name="jumlah_rombongan"
                                    value="{{ old('jumlah_rombongan', $tiket->jumlah_rombongan) }}">
                                @error('jumlah_rombongan')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="nohp{{ $tiket->id }}" class="form-label">No HP</label>
                                <input type="number" class="form-control @error('nohp') is-invalid @enderror"
                                    id="nohp{{ $tiket->id }}" name="nohp"
                                    value="{{ old('nohp', $tiket->nohp) }}">
                                @error('nohp')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="alamat{{ $tiket->id }}" class="form-label">Alamat</label>
                                <input type="text" class="form-control @error('alamat') is-invalid @enderror"
                                    id="alamat{{ $tiket->id }}" name="alamat"
                                    value="{{ old('alamat', $tiket->alamat) }}">
                                @error('alamat')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary"
                            onclick="document.getElementById('editTouristsForm{{ $tiket->id }}').submit()">Update</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable if it exists
            if ($.fn.DataTable) {
                $('#dataTable').DataTable();
            }

            // Show validation errors in modal if they exist
            @if ($errors->any())
                const createModal = new bootstrap.Modal(document.getElementById('createTouristsModal'));
                createModal.show();
            @endif

            // Check URL parameters
            const urlParams = new URLSearchParams(window.location.search);

            // Open create modal if parameter exists
            if (urlParams.has('openCreateModal')) {
                const createModal = new bootstrap.Modal(document.getElementById('createTouristsModal'));
                createModal.show();

                // Clean up URL to prevent modal reopening on refresh
                window.history.replaceState({}, document.title, "{{ route('admin.tiketmasuks.index') }}");
            }

            // Open edit modal if parameter exists
            if (urlParams.has('openEditModal')) {
                const editId = urlParams.get('openEditModal');
                const editModal = new bootstrap.Modal(document.getElementById('editTouristsModal' + editId));
                editModal.show();

                // Clean up URL to prevent modal reopening on refresh
                window.history.replaceState({}, document.title, "{{ route('admin.tiketmasuks.index') }}");
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
