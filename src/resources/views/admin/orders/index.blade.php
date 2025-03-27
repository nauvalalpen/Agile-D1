@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">{{ __('Manage Tour Guide Orders') }}</div>

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
                                            <th>ID</th>
                                            <th>User</th>
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
                                                <td>{{ $order->id }}</td>
                                                <td>{{ $order->user_name }}</td>
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
                                                    <a href="{{ route('admin.orders.edit', $order->id) }}"
                                                        class="btn btn-sm btn-primary">Process Order</a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="alert alert-info">
                                There are no tour guide orders yet.
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
