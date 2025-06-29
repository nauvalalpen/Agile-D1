@extends('admin.layouts.admin')

@section('content')
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Kelola Pesanan Pemandu Wisata</h1>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">{{ __('Daftar Pesanan Pemandu Wisata') }}</h6>
        </div>

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
                    <table class="table table-bordered" id="ordersTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Pengguna</th>
                                <th>Pemandu Wisata</th>
                                <th>Tanggal Pesan</th>
                                <th>Jumlah Orang</th>
                                <th>Rentang Harga</th>
                                <th>Status</th>
                                <th>Harga Final</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $order)
                                <tr>
                                    {{-- <td>{{ $order->id }}</td> --}}
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $order->user_name }}</td>
                                    <td>{{ $order->tourguide_name }}</td>
                                    <td>{{ date('d M Y', strtotime($order->tanggal_order)) }}</td>
                                    <td>{{ $order->jumlah_orang }}</td>
                                    <td>{{ $order->price_range }}</td>
                                    <td>
                                        @if ($order->status == 'pending')
                                            <span class="badge bg-warning text-dark">Pending</span>
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
                                            class="btn btn-sm btn-primary">Proses Pesanan</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <div class="alert alert-info">
                    Belum ada pesanan pemandu wisata.
                </div>
            @endif
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#ordersTable').DataTable();
        });
    </script>
@endpush
