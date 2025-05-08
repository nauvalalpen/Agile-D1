@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="mb-4">My Orders</h1>

                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('order-history') ? 'active' : '' }}"
                            href="{{ route('order-history.index') }}">Tour Guide</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="{{ route('order-madu.index') }}">Honey Products</a>
                    </li>
                    <!-- Add more tabs for other order types as needed -->
                </ul>
            </div>
        </div>

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
                                <th>Order ID</th>
                                <th>Product</th>
                                <th>Quantity</th>
                                <th>Total Price</th>
                                <th>Pickup Date</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Actions</th>
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
                                            <span class="badge bg-warning text-dark">Pending</span>
                                        @elseif ($order->status == 'accepted')
                                            <span class="badge bg-success">Accepted</span>
                                        @elseif ($order->status == 'rejected')
                                            <span class="badge bg-danger">Rejected</span>
                                        @endif
                                    </td>
                                    <td>{{ date('d M Y', strtotime($order->created_at)) }}</td>
                                    <td>
                                        <a href="{{ route('order-madu.show', $order->id) }}" class="btn btn-sm btn-info">
                                            <i class="fas fa-eye"></i> Details
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-4">You haven't placed any honey orders yet.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection
