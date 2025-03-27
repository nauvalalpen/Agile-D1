@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">{{ __('My Order History') }}</div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success" role="alert">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if (session('error'))
                            <div class="alert alert-danger" role="alert">
                                {{ session('error') }}
                            </div>
                        @endif

                        @if (count($orders) > 0)
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>Tour Guide</th>
                                            <th>Tanggal Order</th>
                                            <th>Jumlah Orang</th>
                                            <th>Price Range</th>
                                            <th>Status</th>
                                            <th>Final Price</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>{{ $order->tourguide_name }}</td>
                                                <td>{{ date('d M Y', strtotime($order->tanggal_order)) }}</td>
                                                <td>{{ $order->jumlah_orang }}</td>
                                                <td>{{ $order->price_range }}</td>
                                                <td>
                                                    @if ($order->status == 'pending')
                                                        <span class="badge bg-warning">Pending</span>
                                                    @elseif($order->status == 'accepted')
                                                        <span class="badge bg-success">Accepted</span>
                                                    @elseif($order->status == 'rejected')
                                                        <span class="badge bg-danger">Rejected</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($order->final_price)
                                                        Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('order-history.show', $order->id) }}"
                                                        class="btn btn-sm btn-info">View Details</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                You have no order history yet. <a href="{{ route('tourguides.index') }}">Browse tour
                                    guides</a> to make an order.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
