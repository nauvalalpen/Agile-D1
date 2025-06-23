@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Honey Order #{{ $order->id }} Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>Order Information</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">Order ID</th>
                                        <td>#{{ $order->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Product</th>
                                        <td>{{ $order->nama_madu }}</td>
                                    </tr>
                                    <tr>
                                        <th>Size</th>
                                        <td>{{ $order->ukuran }}</td>
                                    </tr>
                                    <tr>
                                        <th>Quantity</th>
                                        <td>{{ $order->jumlah }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price per Item</th>
                                        <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total Price</th>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pickup Date</th>
                                        <td>{{ date('d M Y', strtotime($order->tanggal)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
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
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ date('d M Y H:i', strtotime($order->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Last Updated</th>
                                        <td>{{ date('d M Y H:i', strtotime($order->updated_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="alert alert-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'accepted' ? 'success' : 'danger') }}">
                            <h5 class="alert-heading">Order Status</h5>
                            @if ($order->status == 'pending')
                                <p>Your order is currently being reviewed. We'll update you once it's processed.</p>
                                <p class="mb-0">Please wait for confirmation before visiting to pick up your order.</p>
                            @elseif ($order->status == 'accepted')
                                <p>Your order has been accepted!</p>
                                <p class="mb-0">Please pick up your honey on
                                    {{ date('l, d F Y', strtotime($order->tanggal)) }} at our location in Desa Wisata Lubuk
                                    Hitam Lestari</p>
                            @elseif ($order->status == 'rejected')
                                <p>We're sorry, but your order has been rejected.</p>
                                <p class="mb-0">This could be due to stock unavailability or other issues. Please contact
                                    us for more information.</p>
                            @endif
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('order-history.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to Orders
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
