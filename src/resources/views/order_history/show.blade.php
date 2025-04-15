@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span>{{ __('Order Details') }}</span>
                            <a href="{{ route('order-history.index') }}" class="btn btn-sm btn-secondary">Back to Order
                                History</a>
                        </div>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-md-4 mb-4">
                                @if ($order->tourguide_foto)
                                    <img src="{{ asset('storage/' . $order->tourguide_foto) }}" class="img-fluid rounded"
                                        alt="{{ $order->tourguide_name }}">
                                @else
                                    <img src="{{ asset('images/default-profile.jpg') }}" class="img-fluid rounded"
                                        alt="Default Profile">
                                @endif
                            </div>
                            <div class="col-md-8">
                                <h4>{{ $order->tourguide_name }}</h4>

                                <div class="mt-3">
                                    <h5>Tour Guide Information</h5>
                                    <table class="table table-bordered">
                                        <tbody>
                                            <tr>
                                                <th>Phone</th>
                                                <td>{{ $order->tourguide_nohp }}</td>
                                            </tr>
                                            <tr>
                                                <th>Address</th>
                                                <td>{{ $order->tourguide_alamat }}</td>
                                            </tr>
                                            <tr>
                                                <th>Description</th>
                                                <td>{{ $order->tourguide_deskripsi }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="mt-4">
                            <h5>Order Information</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ date('d M Y', strtotime($order->tanggal_order)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Number of People</th>
                                        <td>{{ $order->jumlah_orang }}</td>
                                    </tr>
                                    <tr>
                                        <th>Price Range</th>
                                        <td>{{ $order->price_range }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status</th>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning">Pending</span>
                                            @elseif($order->status == 'accepted')
                                                <span class="badge bg-success">Accepted</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="badge bg-danger">Rejected</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @if ($order->final_price)
                                        <tr>
                                            <th>Final Price</th>
                                            <td>Rp {{ number_format($order->final_price, 0, ',', '.') }}</td>
                                        </tr>
                                    @endif
                                    @if ($order->admin_notes)
                                        <tr>
                                            <th>Admin Notes</th>
                                            <td>{{ $order->admin_notes }}</td>
                                        </tr>
                                    @endif
                                    <tr>
                                        <th>Created At</th>
                                        <td>{{ date('d M Y H:i', strtotime($order->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Updated At</th>
                                        <td>{{ date('d M Y H:i', strtotime($order->updated_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
