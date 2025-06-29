@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Kelola Pesanan Madu</h1>

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
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Daftar Pesanan Madu</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Pengguna</th>
                                <th>Produk Madu</th>
                                <th>Jumlah</th>
                                <th>Tanggal</th>
                                <th>Total Harga</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ $order->nama_madu }}</td>
                                    <td>{{ $order->jumlah }}</td>
                                    <td>{{ $order->tanggal }}</td>
                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif ($order->status == 'accepted')
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif ($order->status == 'rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary order-process-btn"
                                            data-bs-toggle="modal" data-bs-target="#editOrderModal{{ $order->id }}"
                                            data-order-id="{{ $order->id }}">
                                            <i class="fas fa-edit me-1"></i> Proses Pesanan
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">Tidak ada pesanan ditemukan</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Edit Order Modals -->
    @foreach ($orders as $order)
        <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header bg-primary text-white">
                        <div class="d-flex align-items-center">
                            <div class="modal-icon me-3">
                                <i class="fas fa-honey-pot fs-4"></i>
                            </div>
                            <div>
                                <h5 class="modal-title mb-0" id="editOrderModalLabel{{ $order->id }}">
                                    Proses Pesanan Madu
                                </h5>
                                <small class="opacity-75">ID: #{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</small>
                            </div>
                        </div>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>

                    <div class="modal-body p-4">
                        <!-- Order Information Section -->
                        <div class="order-info-section mb-4">
                            <h6 class="section-title mb-3">
                                <i class="fas fa-info-circle text-primary me-2"></i>
                                Informasi Pesanan
                            </h6>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="info-card p-3 bg-light rounded">
                                        <div class="info-item d-flex justify-content-between align-items-center mb-2">
                                            <span class="info-label text-muted">
                                                <i class="fas fa-user me-1"></i> Pengguna
                                            </span>
                                            <strong class="info-value">{{ $order->user_name }}</strong>
                                        </div>
                                        @if (isset($order->user_email))
                                            <div class="info-item d-flex justify-content-between align-items-center mb-2">
                                                <span class="info-label text-muted">
                                                    <i class="fas fa-envelope me-1"></i> Email
                                                </span>
                                                <span class="info-value">{{ $order->user_email }}</span>
                                            </div>
                                        @endif
                                        <div class="info-item d-flex justify-content-between align-items-center">
                                            <span class="info-label text-muted">
                                                <i class="fas fa-honey-pot me-1"></i> Produk
                                            </span>
                                            <strong class="info-value">{{ $order->nama_madu }}</strong>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="info-card p-3 bg-light rounded">
                                        <div class="info-item d-flex justify-content-between align-items-center mb-2">
                                            <span class="info-label text-muted">
                                                <i class="fas fa-sort-numeric-up me-1"></i> Jumlah
                                            </span>
                                            <span class="badge bg-info">{{ $order->jumlah }}</span>
                                        </div>
                                        <div class="info-item d-flex justify-content-between align-items-center mb-2">
                                            <span class="info-label text-muted">
                                                <i class="fas fa-calendar me-1"></i> Tanggal
                                            </span>
                                            <span class="info-value">{{ $order->tanggal }}</span>
                                        </div>
                                        <div class="info-item d-flex justify-content-between align-items-center">
                                            <span class="info-label text-muted">
                                                <i class="fas fa-money-bill-wave me-1"></i> Total
                                            </span>
                                            <span class="badge bg-success fs-6">
                                                Rp {{ number_format($order->total_harga, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Update Section -->
                        <div class="status-update-section">
                            <h6 class="section-title mb-3">
                                <i class="fas fa-edit text-primary me-2"></i>
                                Perbarui Status Pesanan
                            </h6>

                            <!-- Current Status -->
                            <div class="current-status mb-3 p-3 bg-light rounded">
                                <div class="d-flex align-items-center justify-content-between">
                                    <span class="fw-semibold text-muted">Status Saat Ini:</span>
                                    @if ($order->status == 'pending')
                                        <span class="badge bg-warning text-dark fs-6">
                                            <i class="fas fa-clock me-1"></i>Menunggu
                                        </span>
                                    @elseif ($order->status == 'accepted')
                                        <span class="badge bg-success fs-6">
                                            <i class="fas fa-check-circle me-1"></i>Diterima
                                        </span>
                                    @elseif ($order->status == 'rejected')
                                        <span class="badge bg-danger fs-6">
                                            <i class="fas fa-times-circle me-1"></i>Ditolak
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <form action="{{ route('admin.orders-madu.update', $order->id) }}" method="POST"
                                class="status-form" id="statusForm{{ $order->id }}">
                                @csrf
                                @method('PUT')

                                <div class="status-options mb-4">
                                    <label class="form-label fw-semibold mb-3">Pilih Status Baru:</label>

                                    <div class="row g-3">
                                        <!-- Pending Status -->
                                        <div class="col-md-4">
                                            <input type="radio" class="btn-check" name="status" value="pending"
                                                id="pending{{ $order->id }}"
                                                {{ $order->status == 'pending' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-warning w-100 p-3 status-option"
                                                for="pending{{ $order->id }}">
                                                <div class="text-center">
                                                    <i class="fas fa-clock fs-2 mb-2"></i>
                                                    <div class="fw-bold">Menunggu</div>
                                                    <small class="text-muted">Dalam proses review</small>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Accepted Status -->
                                        <div class="col-md-4">
                                            <input type="radio" class="btn-check" name="status" value="accepted"
                                                id="accepted{{ $order->id }}"
                                                {{ $order->status == 'accepted' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-success w-100 p-3 status-option"
                                                for="accepted{{ $order->id }}">
                                                <div class="text-center">
                                                    <i class="fas fa-check-circle fs-2 mb-2"></i>
                                                    <div class="fw-bold">Diterima</div>
                                                    <small class="text-muted">Pesanan disetujui</small>
                                                </div>
                                            </label>
                                        </div>

                                        <!-- Rejected Status -->
                                        <div class="col-md-4">
                                            <input type="radio" class="btn-check" name="status" value="rejected"
                                                id="rejected{{ $order->id }}"
                                                {{ $order->status == 'rejected' ? 'checked' : '' }}>
                                            <label class="btn btn-outline-danger w-100 p-3 status-option"
                                                for="rejected{{ $order->id }}">
                                                <div class="text-center">
                                                    <i class="fas fa-times-circle fs-2 mb-2"></i>
                                                    <div class="fw-bold">Ditolak</div>
                                                    <small class="text-muted">Pesanan tidak dapat diproses</small>
                                                </div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <!-- Action Buttons -->
                                <div class="modal-actions d-flex justify-content-between">
                                    <button type="button" class="btn btn-secondary px-4" data-bs-dismiss="modal">
                                        <i class="fas fa-times me-2"></i>Batal
                                    </button>
                                    <button type="submit" class="btn btn-primary px-4"
                                        id="updateBtn{{ $order->id }}">
                                        <span class="btn-text">
                                            <i class="fas fa-save me-2"></i>Perbarui Status
                                        </span>
                                        <span class="btn-loading d-none">
                                            <i class="fas fa-spinner fa-spin me-2"></i>Memproses...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection

@push('styles')
    <style>
        /* Modal Improvements */
        .modal-content {
            border: none;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .modal-header {
            border-radius: 15px 15px 0 0;
            padding: 1.5rem 2rem;
            border-bottom: none;
        }

        .modal-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(10px);
        }

        .section-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #495057;
            border-bottom: 2px solid #e9ecef;
            padding-bottom: 0.5rem;
        }

        .info-card {
            border: 1px solid #e9ecef;
            transition: all 0.3s ease;
        }

        .info-card:hover {
            border-color: #007bff;
            box-shadow: 0 2px 8px rgba(0, 123, 255, 0.1);
        }

        .info-item {
            font-size: 0.9rem;
        }

        .info-label {
            font-weight: 500;
        }

        .current-status {
            border: 1px solid #e9ecef;
        }

        .status-option {
            height: 120px;
            border: 2px solid transparent !important;
            transition: all 0.3s ease;
            position: relative;
        }

        .status-option:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .btn-check:checked+.status-option {
            transform: scale(1.02);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.15);
        }

        .btn-check:checked+.btn-outline-warning {
            background-color: #ffc107;
            border-color: #ffc107;
            color: #000;
        }

        .btn-check:checked+.btn-outline-success {
            background-color: #198754;
            border-color: #198754;
            color: #fff;
        }

        .btn-check:checked+.btn-outline-danger {
            background-color: #dc3545;
            border-color: #dc3545;
            color: #fff;
        }

        .modal-actions {
            padding-top: 1.5rem;
            border-top: 1px solid #e9ecef;
        }

        .btn-loading {
            display: none;
        }

        .loading .btn-text {
            display: none;
        }

        .loading .btn-loading {
            display: inline-flex;
            align-items: center;
        }

        .order-process-btn {
            transition: all 0.3s ease;
        }

        .order-process-btn:hover {
            transform: translateY(-1px);
            box-shadow: 0 4px 8px rgba(0, 123, 255, 0.3);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .modal-dialog {
                margin: 1rem;
            }

            .modal-header {
                padding: 1rem 1.5rem;
            }

            .modal-body {
                padding: 1.5rem;
            }

            .row.g-3 {
                --bs-gutter-x: 1rem;
            }

            .status-option {
                height: 100px;
                margin-bottom: 0.5rem;
            }

            .modal-actions {
                flex-direction: column;
                gap: 0.75rem;
            }

            .modal-actions .btn {
                width: 100%;
            }
        }

        /* Animation improvements */
        .modal.fade .modal-dialog {
            transform: scale(0.8);
            transition: all 0.3s ease;
        }

        .modal.show .modal-dialog {
            transform: scale(1);
        }

        .status-option {
            animation: fadeInUp 0.3s ease forwards;
        }

        .status-option:nth-child(1) {
            animation-delay: 0.1s;
        }

        .status-option:nth-child(2) {
            animation-delay: 0.2s;
        }

        .status-option:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize DataTable
            $('#dataTable').DataTable({
                "ordering": true,
                "info": true,
                "paging": true,
                "lengthMenu": [
                    [10, 25, 50, -1],
                    [10, 25, 50, "All"]
                ],
                "language": {
                    "emptyTable": "No orders found"
                }
            });

            // Enhanced Modal Management
            const modals = document.querySelectorAll('.modal');

            // Fix for modal backdrop issues
            const fixModalBackdrop = () => {
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            };

            // Enhanced form submission with loading states
            document.querySelectorAll('.status-form').forEach(form => {
                form.addEventListener('submit', function(e) {
                    const submitBtn = form.querySelector('button[type="submit"]');
                    const selectedStatus = form.querySelector('input[name="status"]:checked');

                    if (!selectedStatus) {
                        e.preventDefault();
                        alert('Silakan pilih status terlebih dahulu!');
                        return;
                    }

                    // Show confirmation
                    const orderId = form.id.replace('statusForm', '');
                    const statusText = selectedStatus.nextElementSibling.querySelector('.fw-bold')
                        .textContent;
                    const confirmMessage =
                        `Apakah Anda yakin ingin mengubah status pesanan #${String(orderId).padStart(4, '0')} menjadi "${statusText}"?`;

                    if (!confirm(confirmMessage)) {
                        e.preventDefault();
                        return;
                    }

                    // Show loading state
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;

                    // Disable form elements
                    form.querySelectorAll('input, button').forEach(element => {
                        element.disabled = true;
                    });
                });
            });

            // Status change animation
            document.querySelectorAll('input[name="status"]').forEach(radio => {
                radio.addEventListener('change', function() {
                    const label = this.nextElementSibling;
                    const form = this.closest('form');

                    // Remove animation from other options
                    form.querySelectorAll('.status-option').forEach(option => {
                        option.style.animation = '';
                    });

                    // Add animation to selected option
                    setTimeout(() => {
                        label.style.animation = 'pulse 0.5s ease';
                    }, 100);
                });
            });

            // Modal event listeners
            modals.forEach(modal => {
                // On modal hide
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(fixModalBackdrop, 300);

                    // Reset form states
                    const form = this.querySelector('.status-form');
                    if (form) {
                        const submitBtn = form.querySelector('button[type="submit"]');

                        submitBtn.classList.remove('loading');
                        submitBtn.disabled = false;

                        form.querySelectorAll('input, button').forEach(element => {
                            element.disabled = false;
                        });

                        // Reset animations
                        form.querySelectorAll('.status-option').forEach(option => {
                            option.style.animation = '';
                        });
                    }
                });

                // Handle click outside modal
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        setTimeout(fixModalBackdrop, 300);
                    }
                });
            });

            // Add event listeners to modal close buttons
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(fixModalBackdrop, 300);
                });
            });

            // Handle ESC key press
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    setTimeout(fixModalBackdrop, 300);
                }
            });

            // Additional safety measure: periodically check for orphaned backdrops
            setInterval(function() {
                if (!document.querySelector('.modal.show') && document.querySelector('.modal-backdrop')) {
                    fixModalBackdrop();
                }
            }, 2000);

            // Add smooth scrolling for long modals
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('shown.bs.modal', function() {
                    const modalBody = this.querySelector('.modal-body');
                    if (modalBody.scrollHeight > modalBody.clientHeight) {
                        modalBody.style.overflowY = 'auto';
                        modalBody.style.maxHeight = '70vh';
                    }
                });
            });

            // Pulse animation keyframes
            const style = document.createElement('style');
            style.textContent = `
                @keyframes pulse {
                    0% { transform: scale(1); }
                    50% { transform: scale(1.05); }
                    100% { transform: scale(1); }
                }
            `;
            document.head.appendChild(style);
        });
    </script>
@endpush
