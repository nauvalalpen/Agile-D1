@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Order #{{ $order->id }} Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-4">
                            <h5>Informasi Pesanan</h5>
                            <table class="table table-bordered">
                                <tbody>
                                    <tr>
                                        <th style="width: 30%">ID Pesanan</th>
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
                                        <th>Tanggal Pengambilan</th>
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
                                        <th>Tanggal Pemesanan</th>
                                        <td>{{ date('d M Y H:i', strtotime($order->created_at)) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Pembaruan Terakhir</th>
                                        <td>{{ date('d M Y H:i', strtotime($order->updated_at)) }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div
                            class="alert alert-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'accepted' ? 'success' : 'danger') }}">
                            <h5 class="alert-heading">Status Pesanan</h5>
                            @if ($order->status == 'pending')
                                <p>Pesanan Anda sedang ditinjau. Kami akan menghubungi Anda setelah diproses.</p>
                                <p class="mb-0">Silakan tunggu konfirmasi sebelum datang untuk mengambil pesanan Anda.</p>
                            @elseif ($order->status == 'accepted')
                                <p>Pesanan Anda telah diterima!</p>
                                <p class="mb-0">Silakan ambil madu Anda pada
                                    {{ date('l, d F Y', strtotime($order->tanggal)) }} di lokasi kami di Desa Wisata Lubuk
                                    Hitam Lestari</p>
                            @elseif ($order->status == 'rejected')
                                <p>Mohon maaf, pesanan Anda ditolak.</p>
                                <p class="mb-0">Kemungkinan karena stok tidak tersedia atau alasan lainnya. Silakan hubungi kami untuk informasi lebih lanjut.</p>
                            @endif
                        </div>

                        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                            <a href="{{ route('order-madu.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Kembali ke Daftar Pesanan
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
