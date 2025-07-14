@extends('admin.layouts.admin')

@section('title', 'Kelola Laporan Penjualan')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Kelola Laporan Penjualan</h1>
            <div class="btn-group">
                <a href="{{ route('admin.laporan-penjualan.export-pdf', request()->query()) }}" class="btn btn-danger btn-sm">
                    <i class="fas fa-file-pdf fa-sm text-white-50"></i> Export PDF
                </a>
                <a href="{{ route('admin.laporan-penjualan.export-excel', request()->query()) }}"
                    class="btn btn-success btn-sm">
                    <i class="fas fa-file-excel fa-sm text-white-50"></i> Export Excel
                </a>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Filter Laporan</h6>
            </div>
            <div class="card-body">
                <form method="GET" action="{{ route('admin.laporan-penjualan.index') }}">
                    <div class="row">
                        <div class="col-md-3">
                            <label for="type" class="form-label">Jenis Order</label>
                            <select name="type" id="type" class="form-control">
                                <option value="all" {{ $type == 'all' ? 'selected' : '' }}>Semua</option>
                                <option value="tourguide" {{ $type == 'tourguide' ? 'selected' : '' }}>Tour Guide</option>
                                <option value="madu" {{ $type == 'madu' ? 'selected' : '' }}>Madu</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <label for="period" class="form-label">Periode</label>
                            <select name="period" id="period" class="form-control">
                                <option value="all" {{ $period == 'all' ? 'selected' : '' }}>Semua</option>
                                <option value="today" {{ $period == 'today' ? 'selected' : '' }}>Hari Ini</option>
                                <option value="week" {{ $period == 'week' ? 'selected' : '' }}>Minggu Ini</option>
                                <option value="month" {{ $period == 'month' ? 'selected' : '' }}>Bulan Ini</option>
                                <option value="custom" {{ $period == 'custom' ? 'selected' : '' }}>Custom</option>
                            </select>
                        </div>
                        <div class="col-md-2" id="start-date-group"
                            style="display: {{ $period == 'custom' ? 'block' : 'none' }}">
                            <label for="start_date" class="form-label">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" class="form-control"
                                value="{{ $startDate }}">
                        </div>
                        <div class="col-md-2" id="end-date-group"
                            style="display: {{ $period == 'custom' ? 'block' : 'none' }}">
                            <label for="end_date" class="form-label">Tanggal Akhir</label>
                            <input type="date" name="end_date" id="end_date" class="form-control"
                                value="{{ $endDate }}">
                        </div>
                        <div class="col-md-2">
                            <label class="form-label">&nbsp;</label>
                            <button type="submit" class="btn btn-primary d-block">Filter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Summary Cards -->
        <div class="row">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    Total Pesanan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totals['total']['count'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    Total Pendapatan</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">Rp
                                    {{ number_format($totals['total']['revenue'], 0, ',', '.') }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    Pesanan Pemandu Wisata</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totals['tourguide']['count'] }}
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    Pesanan Madu</div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totals['madu']['count'] }}</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-jar fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tour Guide Orders Table -->
        @if ($type == 'all' || $type == 'tourguide')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan Pemandu Wisata</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="tourGuideTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Nama Pemandu</th>
                                    <th>Tanggal Pesan</th>
                                    <th>Jumlah Orang</th>
                                    <th>Rentang Harga</th>
                                    <th>Harga Final</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($tourGuideOrders as $order)
                                    <tr>
                                        {{-- <td>{{ $order->id }}</td> --}}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ $order->tourguide_name }}</td>
                                        <td>{{ date('d M Y', strtotime($order->tanggal_order)) }}</td>
                                        <td>{{ $order->jumlah_orang }}</td>
                                        <td>{{ $order->price_range }}</td>
                                        <td>
                                            @if ($order->final_price)
                                                Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                            @else
                                                -
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            @elseif($order->status == 'accepted')
                                                <span class="badge bg-success">Diterima</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-info">
                                    <th colspan="6">Total Pendapatan Pemandu Wisata</th>
                                    <th>Rp {{ number_format($totals['tourguide']['revenue'], 0, ',', '.') }}</th>
                                    <th>{{ $totals['tourguide']['count'] }} pesanan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Honey Orders Table -->
        @if ($type == 'all' || $type == 'madu')
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Pesanan Madu</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="maduTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>NO</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Produk</th>
                                    <th>Ukuran</th>
                                    <th>Jumlah</th>
                                    <th>Harga per Item</th>
                                    <th>Tanggal Ambil</th>
                                    <th>Total Harga</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($maduOrders as $order)
                                    <tr>
                                        {{-- <td>{{ $order->id }}</td> --}}
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $order->user_name }}</td>
                                        <td>{{ $order->nama_madu }}</td>
                                        <td>{{ $order->ukuran }}</td>
                                        <td>{{ $order->jumlah }}</td>
                                        <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                                        <td>{{ date('d M Y', strtotime($order->tanggal)) }}</td>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning text-dark">Menunggu</span>
                                            @elseif($order->status == 'accepted')
                                                <span class="badge bg-success">Diterima</span>
                                            @elseif($order->status == 'rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="table-info">
                                    <th colspan="7">Total Pesanan Madu</th>
                                    <th>Rp {{ number_format($totals['madu']['revenue'], 0, ',', '.') }}</th>
                                    {{-- <th></th> --}}
                                    <th colspan="2">{{ $totals['madu']['count'] }} pesanan</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        @endif

        <!-- Detailed Summary -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Ringkasan Detail</h6>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6>Pesanan Pemandu Wisata</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Menunggu
                                <span class="badge bg-warning rounded-pill">{{ $totals['tourguide']['pending'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Diterima
                                <span class="badge bg-success rounded-pill">{{ $totals['tourguide']['accepted'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ditolak
                                <span class="badge bg-danger rounded-pill">{{ $totals['tourguide']['rejected'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Total Pendapatan</strong>
                                <strong>Rp {{ number_format($totals['tourguide']['revenue'], 0, ',', '.') }}</strong>
                            </li>
                        </ul>
                    </div>
                    <div class="col-md-6">
                        <h6>Pesanan Produk Madu</h6>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Menunggu
                                <span class="badge bg-warning rounded-pill">{{ $totals['madu']['pending'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Diterima
                                <span class="badge bg-success rounded-pill">{{ $totals['madu']['accepted'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                Ditolak
                                <span class="badge bg-danger rounded-pill">{{ $totals['madu']['rejected'] }}</span>
                            </li>
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <strong>Total Pendapatan</strong>
                                <strong>Rp {{ number_format($totals['madu']['revenue'], 0, ',', '.') }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Initialize DataTables
            $('#tourGuideTable').DataTable({
                "pageLength": 25,
                "order": [
                    [0, "desc"]
                ]
            });

            $('#maduTable').DataTable({
                "pageLength": 25,
                "order": [
                    [0, "desc"]
                ]
            });

            // Handle period change
            $('#period').change(function() {
                if ($(this).val() === 'custom') {
                    $('#start-date-group, #end-date-group').show();
                } else {
                    $('#start-date-group, #end-date-group').hide();
                }
            });
        });
    </script>
@endpush
