@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Tour Guide Order #{{ $order->id }} Details</h4>
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
                                        <th>Tour Guide</th>
                                        <td>{{ $order->tourguide_name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tour Guide Phone</th>
                                        <td>{{ $order->tourguide_nohp }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tour Guide Address</th>
                                        <td>{{ $order->tourguide_alamat }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price Range</th>
                                        <td>{{ $order->tourguide_price_range }}</td>
                                    </tr>
                                    <tr>
                                        <th>Final Price</th>
                                        <td>
                                            @if ($order->final_price)
                                                Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                            @else
                                                <span class="text-muted">Not set yet</span>
                                            @endif
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Tour Date</th>
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
                                <p>Your tour guide request is currently being reviewed. We'll update you once it's
                                    processed.</p>
                                <p class="mb-0">Please wait for confirmation before making any travel arrangements.</p>
                            @elseif ($order->status == 'accepted')
                                <p>Your tour guide request has been accepted!</p>
                                <p class="mb-0">Your tour is scheduled for
                                    {{ date('l, d F Y', strtotime($order->tanggal)) }}. Please contact the tour guide at
                                    {{ $order->tourguide_nohp }} for any specific arrangements.</p>
                            @elseif ($order->status == 'rejected')
                                <p>We're sorry, but your tour guide request has been rejected.</p>
                                <p class="mb-0">This could be due to unavailability or other issues. Please contact us for
                                    more information.</p>
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
