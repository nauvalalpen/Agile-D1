@extends('admin.layouts.admin')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Manage Honey Orders</h1>

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
                <h6 class="m-0 font-weight-bold text-primary">Honey Orders List</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Honey Product</th>
                                <th>Quantity</th>
                                <th>Date</th>
                                <th>Total Price</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ $order->nama_madu }}</td>
                                    <td>{{ $order->jumlah }}</td>
                                    <td>{{ $order->tanggal }}</td>
                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($order->status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif ($order->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                            data-bs-target="#editOrderModal{{ $order->id }}">
                                            <i class="fas fa-edit"></i> Process Order
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">No orders found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Order Modals -->
    @foreach ($orders as $order)
        <div class="modal fade" id="editOrderModal{{ $order->id }}" tabindex="-1"
            aria-labelledby="editOrderModalLabel{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="editOrderModalLabel{{ $order->id }}">Process Honey Order</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-4">
                            <h5>Order Information</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Order ID</th>
                                        <td>{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>User</th>
                                        <td>{{ $order->user_name }} ({{ $order->user_email }})</td>
                                    </tr>
                                    <tr>
                                        <th>Honey Product</th>
                                        <td>{{ $order->nama_madu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>{{ $order->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Date</th>
                                        <td>{{ $order->tanggal }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Price</th>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Current Status</th>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            @elseif ($order->status == 'accepted')
                                                <span class="badge bg-success">Accepted</span>
                                            @elseif ($order->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <form action="{{ route('admin.orders-madu.update', $order->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group row mb-3">
                                <label for="status{{ $order->id }}" class="col-md-4 col-form-label text-md-right">Update
                                    Status</label>
                                <div class="col-md-6">
                                    <select class="form-select" id="status{{ $order->id }}" name="status" required>
                                        <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending
                                        </option>
                                        <option value="accepted" {{ $order->status == 'accepted' ? 'selected' : '' }}>
                                            Accept</option>
                                        <option value="rejected" {{ $order->status == 'rejected' ? 'selected' : '' }}>
                                            Reject</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        Update Status
                                    </button>
                                </div>
                            </div>
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

            // Fix for modal backdrop issues
            const fixModalBackdrop = () => {
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            };

            // Add event listeners to modal close buttons
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(fixModalBackdrop, 300);
                });
            });

            // Add event listeners to modals
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(fixModalBackdrop, 300);
                });

                // Also handle the case where the modal is closed by clicking outside
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        setTimeout(fixModalBackdrop, 300);
                    }
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
        });
    </script>
@endpush
