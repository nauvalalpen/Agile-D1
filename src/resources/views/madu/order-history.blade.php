@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h1 class="mb-4">Pesanan Maduku</h1>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card shadow">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                               <th>ID Pesanan</th>
                                <th>Produk</th>
                                <th>Jumlah</th>
                                <th>Total Harga</th>
                                <th>Tanggal Ambil</th>
                                <th>Status</th>
                                <th>Tanggal Pesan</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                <tr>
                                    <td>#{{ $order->id }}</td>
                                    <td>{{ $order->nama_madu }}</td>
                                    <td>{{ $order->jumlah }}</td>
                                    <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    <td>{{ date('d M Y', strtotime($order->tanggal)) }}</td>
                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning text-dark">Menunggu</span>
                                        @elseif ($order->status == 'accepted')
                                            <span class="badge bg-success">Diterima</span>
                                        @elseif ($order->status == 'rejected')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                                    <td>
                                        <button type="button" class="btn btn-sm btn-info" data-bs-toggle="modal"
                                            data-bs-target="#orderDetailModal{{ $order->id }}">
                                            <i class="fas fa-eye"></i> Detail
                                        </button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">Anda belum melakukan pemesanan madu.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Order Detail Modals -->
        @foreach ($orders as $order)
            <div class="modal fade" id="orderDetailModal{{ $order->id }}" tabindex="-1"
                aria-labelledby="orderDetailModalLabel{{ $order->id }}" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="orderDetailModalLabel{{ $order->id }}">Order
                                #{{ $order->id }} Details</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-4">
                                <h6 class="text-muted">Informasi Pesanan</h6>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>ID Pesanan</th>
                                            <td>#{{ $order->id }}</td>
                                        </tr>
                                        <tr>
                                            <th>Produk</th>
                                            <td>{{ $order->nama_madu }}</td>
                                        </tr>
                                        <tr>
                                            <th>Jumlah</th>
                                            <td>{{ $order->jumlah }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total Harga</th>
                                            <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Ambil</th>
                                            <td>{{ date('d M Y', strtotime($order->tanggal)) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Status</th>
                                            <td>
                                                @if ($order->status == 'pending')
                                                    <span class="badge bg-warning text-dark">Menunggu</span>
                                                @elseif ($order->status == 'accepted')
                                                    <span class="badge bg-success">Diterima</span>
                                                @elseif ($order->status == 'rejected')
                                                    <span class="badge bg-danger">Ditolak</span>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <th>Tanggal Pesan</th>
                                            <td>{{ date('d M Y H:i', strtotime($order->created_at)) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div class="alert alert-info">
                                <h6 class="alert-heading">Informasi Status Pesanan</h6>
                                @if ($order->status == 'pending')
                                    <p class="mb-0">YPesanan Anda sedang ditinjau. Kami akan memberi tahu Anda setelah diproses.</p>
                                @elseif ($order->status == 'accepted')
                                    <p class="mb-0">Pesanan Anda telah diterima! Silakan ambil madu pada tanggal yang dijadwalkan.</p>
                                @elseif ($order->status == 'rejected')
                                    <p class="mb-0">Maaf, pesanan Anda ditolak. Silakan hubungi kami untuk informasi lebih lanjut.</p>
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Comprehensive fix for modal backdrop issues
            const fixModalBackdrop = () => {
                // Remove all backdrop elements
                document.querySelectorAll('.modal-backdrop').forEach(backdrop => {
                    backdrop.remove();
                });

                // Reset body styles
                document.body.classList.remove('modal-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            };

            // Add event listeners to all modal close buttons
            document.querySelectorAll('[data-bs-dismiss="modal"]').forEach(button => {
                button.addEventListener('click', function() {
                    setTimeout(fixModalBackdrop, 500);
                });
            });

            // Add event listeners to all modals for when they're hidden
            document.querySelectorAll('.modal').forEach(modal => {
                modal.addEventListener('hidden.bs.modal', function() {
                    setTimeout(fixModalBackdrop, 500);
                });

                // Also handle the case where the modal is closed by clicking outside
                modal.addEventListener('click', function(event) {
                    if (event.target === modal) {
                        setTimeout(fixModalBackdrop, 500);
                    }
                });
            });

            // Handle ESC key press
            document.addEventListener('keydown', function(event) {
                if (event.key === 'Escape') {
                    setTimeout(fixModalBackdrop, 500);
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
@endsection
