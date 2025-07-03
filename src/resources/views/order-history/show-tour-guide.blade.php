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
                                        <p class="company-tagline">Layanan Pemandu Wisata Profesional</p>
                                        <div class="company-details">
                                            <p><i class="fas fa-map-marker-alt"></i> Kecamatan Bungus Teluk Kabung, Kota
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
                                        <h4>Detail Tur:</h4>
                                        <div class="pickup-info">
                                            <p><i class="fas fa-calendar-check"></i>
                                                {{ \Carbon\Carbon::parse($order->tanggal_order)->translatedFormat('l, d F Y') }}
                                            </p>
                                            <p><i class="fas fa-clock"></i> Sesuai Kesepakatan</p>
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

                        <!-- Tour Guide Info Section -->
                        <div class="tourguide-section">
                            <h3 class="section-title">
                                <i class="fas fa-user-tie"></i>
                                Informasi Pemandu Wisata
                            </h3>
                            <div class="tourguide-card">
                                <div class="tourguide-avatar">
                                    <i class="fas fa-user-circle"></i>
                                </div>
                                <div class="tourguide-details">
                                    <h4 class="tourguide-name">{{ $order->tourguide_name }}</h4>
                                    <div class="tourguide-contact">
                                        <p><i class="fas fa-phone"></i> {{ $order->tourguide_nohp }}</p>
                                        <p><i class="fas fa-map-marker-alt"></i> {{ $order->tourguide_alamat }}</p>
                                    </div>
                                </div>
                                <div class="price-range">
                                    <span class="price-label">Kisaran Harga</span>
                                    <span class="price-value">{{ $order->tourguide_price_range }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Invoice Table -->
                        <div class="invoice-table">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Layanan</th>
                                        <th>Tanggal</th>
                                        <th>Durasi</th>
                                        <th>Harga</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <span class="product-name">Pemandu Wisata</span>
                                            </div>
                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($order->tanggal_order)->translatedFormat('d M Y') }}
                                        </td>
                                        <td>1 Hari</td>
                                        <td>
                                            @if ($order->final_price)
                                                Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                            @else
                                                <span class="text-muted">{{ $order->tourguide_price_range }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($order->status == 'pending')
                                                <span class="badge bg-warning">Menunggu</span>
                                            @elseif ($order->status == 'accepted')
                                                <span class="badge bg-success">Diterima</span>
                                            @elseif ($order->status == 'rejected')
                                                <span class="badge bg-danger">Ditolak</span>
                                            @endif
                                        </td>
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
                                            <i class="fas fa-handshake"></i>
                                            <span>Negosiasi langsung dengan Pemandu dan Pengelola</span>
                                        </div>
                                        <p class="payment-note">Pembayaran dilakukan saat tur selesai.</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="summary-table">
                                        <table class="table table-sm">
                                            <tr>
                                                <td>Kisaran Harga:</td>
                                                <td class="text-end">{{ $order->tourguide_price_range }}</td>
                                            </tr>
                                            @if ($order->final_price)
                                                <tr>
                                                    <td>Harga Final:</td>
                                                    <td class="text-end">Rp
                                                        {{ number_format($order->final_price, 0, ',', '.') }}</td>
                                                </tr>
                                            @endif
                                            <tr class="total-row">
                                                <td><strong>Total Bayar</strong></td>
                                                <td class="text-end">
                                                    <strong>
                                                        @if ($order->final_price)
                                                            Rp {{ number_format($order->final_price, 0, ',', '.') }}
                                                        @else
                                                            {{ $order->tourguide_price_range }}
                                                        @endif
                                                    </strong>
                                                </td>
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
                                    <p>Permintaan pemandu wisata Anda sedang dalam proses peninjauan. Kami akan
                                        menghubungkan Anda dengan pemandu yang sesuai. Silakan tunggu konfirmasi sebelum
                                        melakukan perjalanan.</p>
                                @elseif ($order->status == 'accepted')
                                    <h5>Pesanan Telah Dikonfirmasi!</h5>
                                    <p>Permintaan pemandu wisata Anda telah diterima! Tur dijadwalkan pada
                                        <strong>{{ \Carbon\Carbon::parse($order->tanggal_order)->translatedFormat('l, d F Y') }}</strong>.
                                        Silakan hubungi pemandu di nomor berikut
                                        <strong>{{ $order->tourguide_nohp }}</strong> untuk koordinasi lebih lanjut.</p>
                                @elseif ($order->status == 'rejected')
                                    <h5>Pesanan Tidak Dapat Diproses</h5>
                                    <p>Maaf, permintaan pemandu wisata Anda telah ditolak. Kemungkinan karena pemandu tidak
                                        tersedia pada tanggal yang diminta atau alasan lainnya. Silakan hubungi pengelola
                                        untuk informasi lebih lanjut.</p>
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
            background: linear-gradient(135deg, #228B22 0%, #2d5a3d 100%);
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
            border-left: 4px solid #228B22;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
            color: #228B22;
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

        /* === TOUR GUIDE SECTION === */
        .tourguide-section {
            padding: 2rem;
            background: white;
            border-bottom: 1px solid #e9ecef;
        }

        .section-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: #2d5a3d;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding-bottom: 0.75rem;
            border-bottom: 2px solid #e9ecef;
        }

        .tourguide-card {
            background: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 15px;
            padding: 2rem;
            display: flex;
            align-items: center;
            gap: 2rem;
            transition: all 0.3s ease;
        }

        .tourguide-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            border-color: #228B22;
        }

        .tourguide-avatar {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, #228B22, #32CD32);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 2.5rem;
            flex-shrink: 0;
        }

        .tourguide-details {
            flex: 1;
        }

        .tourguide-name {
            font-size: 1.5rem;
            font-weight: 700;
            color: #2d5a3d;
            margin-bottom: 1rem;
        }

        .tourguide-contact p {
            margin-bottom: 0.5rem;
            color: #6c757d;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .tourguide-contact i {
            color: #228B22;
            width: 16px;
        }

        .price-range {
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            padding: 1rem;
            background: rgba(34, 139, 34, 0.1);
            border-radius: 10px;
            border: 1px solid rgba(34, 139, 34, 0.2);
        }

        .price-label {
            font-size: 0.875rem;
            color: #6c757d;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 0.5rem;
        }

        .price-value {
            font-size: 1.2rem;
            font-weight: 700;
            color: #228B22;
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
            background: #2d5a3d;
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
            color: #2d5a3d;
            font-size: 1.1rem;
        }

        .badge {
            padding: 0.5rem 1rem;
            border-radius: 50px;
            font-size: 0.875rem;
            font-weight: 600;
        }

        .bg-warning {
            background: linear-gradient(135deg, #ffc107, #ffb300) !important;
            color: white !important;
        }

        .bg-success {
            background: linear-gradient(135deg, #28a745, #20c997) !important;
            color: white !important;
        }

        .bg-danger {
            background: linear-gradient(135deg, #dc3545, #c82333) !important;
            color: white !important;
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
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
            color: white;
        }

        .btn-primary {
            background: linear-gradient(135deg, #007bff, #0056b3);
            color: white;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #0056b3, #004085);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 123, 255, 0.3);
            color: white;
        }

        .btn-success {
            background: linear-gradient(135deg, #28a745, #20c997);
            color: white;
        }

        .btn-success:hover {
            background: linear-gradient(135deg, #20c997, #17a2b8);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(40, 167, 69, 0.3);
            color: white;
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

            .tourguide-section {
                padding: 1.5rem;
            }

            .tourguide-card {
                flex-direction: column;
                text-align: center;
                gap: 1.5rem;
            }

            .tourguide-avatar {
                width: 100px;
                height: 100px;
                font-size: 3rem;
            }

            .price-range {
                width: 100%;
            }

            .invoice-table {
                padding: 0 1rem;
                overflow-x: auto;
            }

            .invoice-table .table {
                min-width: 700px;
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
                margin-bottom: 0.5rem;
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

            .tourguide-card {
                padding: 1.5rem;
            }

            .tourguide-name {
                font-size: 1.25rem;
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

            .section-title {
                font-size: 1.1rem;
                flex-direction: column;
                text-align: center;
                gap: 0.5rem;
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

        .tourguide-avatar {
            animation: float 3s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-5px);
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

        .payment-method:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
        }

        /* === ADDITIONAL STYLES === */
        .text-muted {
            color: #6c757d !important;
            font-style: italic;
        }

        .invoice-table tbody tr:hover {
            background-color: rgba(34, 139, 34, 0.05);
            transition: background-color 0.3s ease;
        }

        /* === SPECIAL ELEMENTS === */
        .tourguide-contact a {
            color: #228B22;
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .tourguide-contact a:hover {
            color: #2d5a3d;
            text-decoration: underline;
        }

        /* === LOADING STATES === */
        .loading {
            opacity: 0.7;
            pointer-events: none;
            position: relative;
        }

        .loading::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 20px;
            height: 20px;
            margin: -10px 0 0 -10px;
            border: 2px solid #f3f3f3;
            border-top: 2px solid #228B22;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        /* === ACCESSIBILITY IMPROVEMENTS === */
        .btn:focus,
        .tourguide-card:focus {
            outline: 2px solid #228B22;
            outline-offset: 2px;
        }

        /* === HIGH CONTRAST MODE === */
        @media (prefers-contrast: high) {
            .invoice-card {
                border: 2px solid #000;
            }

            .status-badge {
                border: 2px solid #000;
            }

            .tourguide-card {
                border: 2px solid #000;
            }
        }

        /* === REDUCED MOTION === */
        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
            }
        }

        /* === UTILITY CLASSES === */
        .text-center {
            text-align: center;
        }

        .text-end {
            text-align: end;
        }

        .fw-bold {
            font-weight: 700;
        }

        .mb-0 {
            margin-bottom: 0;
        }

        .mb-1 {
            margin-bottom: 0.25rem;
        }

        .mb-2 {
            margin-bottom: 0.5rem;
        }

        .mb-3 {
            margin-bottom: 1rem;
        }

        .mb-4 {
            margin-bottom: 1.5rem;
        }

        .mb-5 {
            margin-bottom: 3rem;
        }

        .mt-3 {
            margin-top: 1rem;
        }

        .p-0 {
            padding: 0;
        }

        .p-1 {
            padding: 0.25rem;
        }

        .p-2 {
            padding: 0.5rem;
        }

        .p-3 {
            padding: 1rem;
        }

        .p-4 {
            padding: 1.5rem;
        }

        .p-5 {
            padding: 3rem;
        }

        /* === FINAL TOUCHES === */
        .invoice-card * {
            box-sizing: border-box;
        }

        .invoice-card img {
            max-width: 100%;
            height: auto;
        }

        .invoice-card table {
            width: 100%;
            border-collapse: collapse;
        }

        /* === CUSTOM SCROLLBAR === */
        .invoice-table::-webkit-scrollbar {
            height: 8px;
        }

        .invoice-table::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 4px;
        }

        .invoice-table::-webkit-scrollbar-thumb {
            background: #c1c1c1;
            border-radius: 4px;
        }

        .invoice-table::-webkit-scrollbar-thumb:hover {
            background: #a8a8a8;
        }

        /* === ENHANCED VISUAL ELEMENTS === */
        .invoice-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><defs><pattern id="grain" width="100" height="100" patternUnits="userSpaceOnUse"><circle cx="25" cy="25" r="1" fill="white" opacity="0.1"/><circle cx="75" cy="75" r="1" fill="white" opacity="0.1"/><circle cx="50" cy="10" r="0.5" fill="white" opacity="0.1"/><circle cx="10" cy="90" r="0.5" fill="white" opacity="0.1"/></pattern></defs><rect width="100" height="100" fill="url(%23grain)"/></svg>');
            opacity: 0.1;
            pointer-events: none;
        }

        .invoice-header {
            position: relative;
            overflow: hidden;
        }

        /* === ADDITIONAL RESPONSIVE FIXES === */
        @media (max-width: 480px) {
            .invoice-page {
                padding: 1rem 0;
            }

            .invoice-header {
                padding: 1rem;
            }

            .company-name {
                font-size: 1.25rem;
            }

            .company-tagline {
                font-size: 0.875rem;
            }

            .invoice-title h1 {
                font-size: 1.5rem;
            }

            .invoice-number {
                font-size: 1rem;
                padding: 0.375rem 0.75rem;
            }

            .invoice-info,
            .tourguide-section,
            .invoice-summary,
            .invoice-footer,
            .invoice-actions {
                padding: 1rem;
            }

            .status-section {
                padding: 1rem;
            }

            .status-badge {
                padding: 0.5rem 1rem;
                font-size: 0.75rem;
            }

            .status-message {
                margin: 0.5rem;
                padding: 1rem;
            }

            .section-title {
                font-size: 1rem;
            }

            .tourguide-name {
                font-size: 1.1rem;
            }

            .price-value {
                font-size: 1rem;
            }

            .btn {
                padding: 0.75rem 1.5rem;
                font-size: 0.875rem;
            }
        }

        /* === FOCUS STATES === */
        .customer-info:focus-within,
        .pickup-info:focus-within,
        .payment-method:focus-within,
        .summary-table:focus-within {
            outline: 2px solid #228B22;
            outline-offset: 2px;
        }

        /* === SMOOTH SCROLLING === */
        html {
            scroll-behavior: smooth;
        }

        /* === SELECTION STYLES === */
        ::selection {
            background: rgba(34, 139, 34, 0.2);
            color: #2d5a3d;
        }

        ::-moz-selection {
            background: rgba(34, 139, 34, 0.2);
            color: #2d5a3d;
        }
    </style>
@endsection
