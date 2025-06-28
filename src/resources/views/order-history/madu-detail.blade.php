@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Detail Pesanan Madu #{{ $order->id }}</h4>
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
                                        <td>{{ \Carbon\Carbon::parse($order->tanggal)->translatedFormat('d M Y') }}</td>
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
                                        <td>{{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d M Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Terakhir Diperbarui</th>
                                        <td>{{ \Carbon\Carbon::parse($order->updated_at)->translatedFormat('d M Y H:i') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="alert alert-{{ $order->status == 'pending' ? 'warning' : ($order->status == 'accepted' ? 'success' : 'danger') }}">
                            <h5 class="alert-heading">Status Pesanan</h5>
                            @if ($order->status == 'pending')
                                <p>Pesanan Anda sedang kami tinjau. Kami akan mengabari Anda setelah diproses.</p>
                                <p class="mb-0">Mohon tunggu konfirmasi sebelum datang untuk mengambil pesanan Anda.</p>
                            @elseif ($order->status == 'accepted')
                                <p>Pesanan Anda telah diterima!</p>
                                <p class="mb-0">Silakan ambil madu Anda pada
                                    {{ \Carbon\Carbon::parse($order->tanggal)->translatedFormat('l, d F Y') }}
                                    di lokasi kami di <strong>Desa Wisata Lubuk Hitam Lestari</strong>.
                                </p>
                            @elseif ($order->status == 'rejected')
                                <p>Maaf, pesanan Anda ditolak.</p>
                                <p class="mb-0">Kemungkinan karena stok tidak tersedia atau kendala lainnya. Silakan hubungi kami untuk informasi lebih lanjut.</p>
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
