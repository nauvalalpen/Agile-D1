@extends('layouts.app')

@section('content')
    <div class="invoice-page">
        <div class="container py-5">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <!-- Invoice Card -->
                    <div class="invoice-card">
                        <!-- Invoice Header -->
                        <div class="invoice-header">
                            <div class="row align-items-center">
                                <div class="col-md-6">
                                    <div class="company-info">
                                        <h2 class="company-name">Desa Wisata Lubuk Hitam</h2>
                                        <p class="company-tagline">Madu Alami Berkualitas Premium</p>
                                        <div class="company-details">
                                            <p><i class="fas fa-map-marker-alt"></i>Kecamatan Bungus Teluk Kabung, Kota
                                                Padang</p>
                                            <p><i class="fas fa-phone"></i> +62 812-3456-7890</p>
                                            <p><i class="fas fa-envelope"></i> info@lubukhitam.com</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <div class="invoice-title">
                                        <h1>Bukti</h1>
                                        <h1>Pemesanan</h1>
                                        <div class="invoice-number">#{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Info -->
                        <div class="invoice-info">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="info-section">
                                        <h4>Tagihan Kepada:</h4>
                                        <div class="customer-info">
                                            <p class="customer-name">{{ Auth::user()->name }}</p>
                                            <p><i class="fas fa-envelope"></i> {{ Auth::user()->email }}</p>
                                            <p><i class="fas fa-calendar"></i> Tanggal Pesan:
                                                {{ \Carbon\Carbon::parse($order->created_at)->translatedFormat('d F Y') }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="info-section">
                                        <h4>Detail Pengambilan:</h4>
                                        <div class="pickup-info">
                                            <p><i class="fas fa-calendar-check"></i>
                                                {{ \Carbon\Carbon::parse($order->tanggal)->translatedFormat('l, d F Y') }}
                                            </p>
                                            <p><i class="fas fa-clock"></i> 08:00 - 17:00 WIB</p>
                                            <p><i class="fas fa-map-marker-alt"></i> Desa Wisata Lubuk Hitam</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Badge -->
                        <div class="status-section">
                            <div class="status-badge status-{{ $order->status }}">
                                @if ($order->status == 'pending')
                                    <i class="fas fa-clock"></i>
                                    <span>MENUNGGU KONFIRMASI</span>
                                @elseif ($order->status == 'accepted')
                                    <i class="fas fa-check-circle"></i>
                                    <span>PESANAN DITERIMA</span>
                                @elseif ($order->status == 'rejected')
                                    <i class="fas fa-times-circle"></i>
                                    <span>PESANAN DITOLAK</span>
                                @endif
                            </div>
                        </div>

                        <!-- Invoice Table -->
                        <div class="invoice-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Produk</th>
                                        <th>Ukuran</th>
                                        <th>Jumlah</th>
                                        <th>Harga Satuan</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <span class="product-name">{{ $order->nama_madu }}</span>
                                            </div>
                                        </td>
                                        <td>{{ $order->ukuran }}</td>
                                        <td>{{ $order->jumlah }}</td>
                                        <td>Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                                        <td>Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <!-- Invoice Summary -->
                        <div class="invoice-summary">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="payment-info">
                                        <h5>Informasi Pembayaran:</h5>
                                        <div class="payment-method">
                                            <i class="fas fa-money-bill-wave"></i>
                                            <span>Bayar di Tempat</span>
                                        </div>
                                        <p class="payment-note">Pembayaran dilakukan saat pengambilan produk.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="summary-table">
                                        <table class="table table-sm">
                                            <tr>
                                                <td>Subtotal:</td>
                                                <td class="text-end">Rp
                                                    {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                                            </tr>
                                            <tr>
                                                <td>Pajak (0%):</td>
                                                <td class="text-end">Rp 0</td>
                                            </tr>
                                            <tr class="total-row">
                                                <td><strong>Total Bayar:</strong></td>
                                                <td class="text-end"><strong>Rp
                                                        {{ number_format($order->total_harga, 0, ',', '.') }}</strong></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Status Message -->
                        <div class="status-message status-{{ $order->status }}">
                            <div class="message-icon">
                                @if ($order->status == 'pending')
                                    <i class="fas fa-hourglass-half"></i>
                                @elseif ($order->status == 'accepted')
                                    <i class="fas fa-check-circle"></i>
                                @elseif ($order->status == 'rejected')
                                    <i class="fas fa-exclamation-triangle"></i>
                                @endif
                            </div>
                            <div class="message-content">
                                @if ($order->status == 'pending')
                                    <h5>Pesanan Sedang Diproses</h5>
                                    <p>Pesanan Anda sedang dalam proses peninjauan. Kami akan memberi kabar jika sudah
                                        diproses. Silakan tunggu konfirmasi sebelum datang untuk mengambil pesanan Anda.</p>
                                @elseif ($order->status == 'accepted')
                                    <h5>Pesanan Telah Dikonfirmasi!</h5>
                                    <p>Pesanan Anda telah diterima dan siap untuk diambil pada
                                        <strong>{{ \Carbon\Carbon::parse($order->tanggal)->translatedFormat('l, d F Y') }}</strong>
                                        di lokasi kami di <strong>Desa Wisata Lubuk Hitam Lestari</strong>.</p>
                                @elseif ($order->status == 'rejected')
                                    <h5>Pesanan Tidak Dapat Diproses</h5>
                                    <p>Maaf, pesanan Anda telah ditolak. Kemungkinan karena stok tidak tersedia atau alasan
                                        lainnya. Silakan hubungi pengelola untuk informasi lebih lanjut.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="invoice-actions">
                            <div class="d-flex gap-3 justify-content-end flex-wrap">
                                <a href="{{ route('order-history.index') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Kembali
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('styles')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f8f9fa;
        }

        .invoice-page {
            min-height: 100vh;
            padding: 2rem 0;
        }

        .invoice-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            margin-bottom: 2rem;
        }

        /* === INVOICE HEADER === */
        .invoice-header {
            background: linear-gradient(135deg, #d5931f, #ef8710);
            color: white;
            padding: 2rem;
        }

        .company-name {
            font-size: 1.8rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }

        .company-tagline {
            font-size: 1rem;
            opacity: 0.9;
            margin-bottom: 1rem;
        }

        .company-details p {
            margin-bottom: 0.25rem;
            font-size: 0.9rem;
            opacity: 0.9;
        }

        .company-details i {
            width: 16px;
            margin-right: 0.5rem;
        }

        .invoice-title h1 {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 0.5rem;
            letter-spacing: 2px;
        }

        .invoice-number {
            font-size: 1.2rem;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.2);
            padding: 0.5rem 1rem;
            border-radius: 25px;
            display: inline-block;
        }

        /* === INVOICE INFO === */
        .invoice-info {
            padding: 2rem;
            background: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
        }

        .info-section h4 {
            color: #2d5a3d;
            font-weight: 600;
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }

        .customer-info,
        .pickup-info {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            border-left: 4px solid #f59e0b;
        }

        .customer-name {
            font-size: 1.2rem;
            font-weight: 700;
            color: #2d5a3d;
            margin-bottom: 0.5rem;
        }

        .customer-info p,
        .pickup-info p {
            margin-bottom: 0.5rem;
            color: #6c757d;
        }

        .customer-info i,
        .pickup-info i {
            width: 16px;
            margin-right: 0.5rem;
            color: #f59e0b;
        }

        /* === STATUS SECTION === */
        .status-section {
            padding: 1.5rem 2rem;
            text-align: center;
            background: white;
        }

        .status-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.75rem;
            padding: 1rem 2rem;
            border-radius: 50px;
            font-weight: 700;
            font-size: 1rem;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .status-badge.status-pending {
            background: linear-gradient(135deg, #ffc107, #ffb300);
            color: white;
            box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
        }

        .status-badge.status-accepted {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        .status-badge.status-rejected {
            background: linear-gradient(135deg, #dc3545, #c82333);
            color: white;
            box-shadow: 0 5px 15px rgba(220, 53, 69, 0.3);
        }

        /* === INVOICE TABLE === */
        .invoice-table {
            padding: 0 2rem;
        }

        .invoice-table .table {
            margin-bottom: 0;
            border-collapse: separate;
            border-spacing: 0;
        }

        .invoice-table thead th {
            background: #ea9a2a;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 1rem;
            border: none;
            font-size: 0.875rem;
        }

        .invoice-table thead th:first-child {
            border-radius: 10px 0 0 0;
        }

        .invoice-table thead th:last-child {
            border-radius: 0 10px 0 0;
        }

        .invoice-table tbody td {
            padding: 1.5rem 1rem;
            border-bottom: 1px solid #e9ecef;
            vertical-align: middle;
        }

        .product-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .product-icon {
            width: 40px;
            height: 40px;
            background: linear-gradient(135deg, #228B22, #32CD32);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.2rem;
        }

        .product-name {
            font-weight: 600;
            color: #ea9a2a;
            font-size: 1.1rem;
        }

        /* === INVOICE SUMMARY === */
        .invoice-summary {
            padding: 2rem;
            background: #f8f9fa;
        }

        .payment-info h5 {
            color: #2d5a3d;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .payment-method {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            background: white;
            padding: 1rem;
            border-radius: 10px;
            border-left: 4px solid #228B22;
            margin-bottom: 0.75rem;
        }

        .payment-method i {
            color: #228B22;
            font-size: 1.2rem;
        }

        .payment-method span {
            font-weight: 600;
            color: #2d5a3d;
        }

        .payment-note {
            color: #6c757d;
            font-size: 0.9rem;
            margin: 0;
        }

        .summary-table {
            background: white;
            border-radius: 10px;
            padding: 1.5rem;
            border: 1px solid #e9ecef;
        }

        .summary-table .table {
            margin-bottom: 0;
        }

        .summary-table td {
            border: none;
            padding: 0.75rem 0;
            color: #6c757d;
        }

        .total-row {
            border-top: 2px solid #228B22 !important;
            padding-top: 1rem !important;
        }

        .total-row td {
            color: #2d5a3d !important;
            font-size: 1.2rem;
            padding-top: 1rem !important;
        }

        /* === STATUS MESSAGE === */
        .status-message {
            margin: 2rem;
            padding: 2rem;
            border-radius: 15px;
            display: flex;
            align-items: flex-start;
            gap: 1.5rem;
        }

        .status-message.status-pending {
            background: linear-gradient(135deg, #fff3cd, #ffeaa7);
            border-left: 5px solid #ffc107;
        }

        .status-message.status-accepted {
            background: linear-gradient(135deg, #d1fae5, #a7f3d0);
            border-left: 5px solid #28a745;
        }

        .status-message.status-rejected {
            background: linear-gradient(135deg, #fee2e2, #fecaca);
            border-left: 5px solid #dc3545;
        }

        .message-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .status-pending .message-icon {
            background: rgba(255, 193, 7, 0.2);
            color: #ffc107;
        }

        .status-accepted .message-icon {
            background: rgba(40, 167, 69, 0.2);
            color: #28a745;
        }

        .status-rejected .message-icon {
            background: rgba(220, 53, 69, 0.2);
            color: #dc3545;
        }

        .message-content h5 {
            font-weight: 700;
            margin-bottom: 0.75rem;
        }

        .status-pending .message-content h5 {
            color: #856404;
        }

        .status-accepted .message-content h5 {
            color: #155724;
        }

        .status-rejected .message-content h5 {
            color: #721c24;
        }

        .message-content p {
            margin: 0;
            line-height: 1.6;
            opacity: 0.9;
        }

        /* === INVOICE FOOTER === */
        .invoice-footer {
            padding: 2rem;
            background: #f8f9fa;
            border-top: 1px solid #e9ecef;
        }

        .terms h6,
        .contact-info h6 {
            color: #2d5a3d;
            font-weight: 600;
            margin-bottom: 1rem;
        }

        .terms ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .terms li {
            padding: 0.5rem 0;
            border-bottom: 1px solid #e9ecef;
            color: #6c757d;
            position: relative;
            padding-left: 1.5rem;
        }

        .terms li:before {
            content: '✓';
            position: absolute;
            left: 0;
            color: #228B22;
            font-weight: bold;
        }

        .terms li:last-child {
            border-bottom: none;
        }

        .contact-info p {
            margin-bottom: 0.5rem;
            color: #6c757d;
        }

        .contact-info i {
            width: 16px;
            margin-right: 0.5rem;
            color: #228B22;
        }

        /* === ACTION BUTTONS === */
        .invoice-actions {
            padding: 2rem;
            background: white;
            border-top: 1px solid #e9ecef;
        }

        .btn {
            padding: 0.875rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            border: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .btn-secondary {
            background: #6c757d;
            color: white;
        }

        .btn-secondary:hover {
            background: #5a6268;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(108, 117, 125, 0.3);
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #20c997, #17a2b8);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
        }

        /* === RESPONSIVE DESIGN === */
        @media (max-width: 768px) {
            .invoice-header {
                padding: 1.5rem;
            }

            .invoice-title {
                text-align: center;
                margin-top: 1rem;
            }

            .invoice-title h1 {
                font-size: 2rem;
            }

            .invoice-info {
                padding: 1.5rem;
            }

            .invoice-table {
                padding: 0 1rem;
                overflow-x: auto;
            }

            .invoice-table .table {
                min-width: 600px;
            }

            .invoice-summary {
                padding: 1.5rem;
            }

            .status-message {
                margin: 1rem;
                padding: 1.5rem;
                flex-direction: column;
                text-align: center;
            }

            .invoice-footer {
                padding: 1.5rem;
            }

            .invoice-actions {
                padding: 1.5rem;
            }

            .invoice-actions .d-flex {
                flex-direction: column;
            }

            .btn {
                width: 100%;
                justify-content: center;
            }
        }

        @media (max-width: 576px) {
            .company-name {
                font-size: 1.5rem;
            }

            .invoice-title h1 {
                font-size: 1.75rem;
            }

            .customer-info,
            .pickup-info {
                padding: 1rem;
            }

            .status-badge {
                padding: 0.75rem 1.5rem;
                font-size: 0.875rem;
            }

            .product-info {
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
            }

            .summary-table {
                padding: 1rem;
            }

            .message-icon {
                width: 50px;
                height: 50px;
                font-size: 1.25rem;
            }
        }

        /* === ANIMATIONS === */
        .invoice-card {
            animation: slideInUp 0.6s ease-out;
        }

        @keyframes slideInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .status-badge {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.05);
            }

            100% {
                transform: scale(1);
            }
        }

        /* === HOVER EFFECTS === */
        .customer-info:hover,
        .pickup-info:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        .summary-table:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }
    </style>
@endsection
