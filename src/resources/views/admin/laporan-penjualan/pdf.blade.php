<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
        }

        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .summary {
            margin-bottom: 30px;
        }

        .summary-item {
            display: inline-block;
            margin-right: 30px;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
            font-weight: bold;
        }

        .total-row {
            background-color: #e9ecef;
            font-weight: bold;
        }

        .text-center {
            text-align: center;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>Laporan Penjualan</h1>
        <p>Generated on: {{ date('d M Y H:i') }}</p>
        @if ($period != 'all')
            <p>Period: {{ ucfirst($period) }}</p>
        @endif
    </div>

    <div class="summary">
        <h3>Ringkasan</h3>
        <div class="summary-item">
            <strong>Total Orders:</strong><br>
            {{ $totals['total']['count'] }}
        </div>
        <div class="summary-item">
            <strong>Total Revenue:</strong><br>
            Rp {{ number_format($totals['total']['revenue'], 0, ',', '.') }}
        </div>
        <div class="summary-item">
            <strong>Tour Guide Orders:</strong><br>
            {{ $totals['tourguide']['count'] }}
        </div>
        <div class="summary-item">
            <strong>Honey Orders:</strong><br>
            {{ $totals['madu']['count'] }}
        </div>
    </div>

    @if ($type == 'all' || $type == 'tourguide')
        <h3>Tour Guide Orders</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Customer</th>
                    <th>Tour Guide</th>
                    <th>Order Date</th>
                    <th>People</th>
                    <th>Price Range</th>
                    <th>Final Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tourGuideOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->user_name }}</td>
                        <td>{{ $order->tourguide_name }}</td>
                        <td>{{ date('d M Y', strtotime($order->tanggal_order)) }}</td>
                        <td>{{ $order->jumlah_orang }}</td>
                        <td>{{ $order->price_range }}</td>
                        <td class="text-right">
                            @if ($order->final_price)
                                Rp {{ number_format($order->final_price, 0, ',', '.') }}
                            @else
                                -
                            @endif
                        </td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="6">Total Tour Guide Orders</td>
                    <td class="text-right">Rp {{ number_format($totals['tourguide']['revenue'], 0, ',', '.') }}</td>
                    <td>{{ $totals['tourguide']['count'] }} orders</td>
                </tr>
            </tfoot>
        </table>
    @endif

    @if ($type == 'all' || $type == 'madu')
        <h3>Honey Orders</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Product</th>
                    <th>Size</th>
                    <th>Qty</th>
                    <th>Price/Item</th>
                    <th>Total Price</th>
                    <th>Pickup Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($maduOrders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>{{ $order->nama_madu }}</td>
                        <td>{{ $order->ukuran }}</td>
                        <td>{{ $order->jumlah }}</td>
                        <td class="text-right">Rp {{ number_format($order->harga, 0, ',', '.') }}</td>
                        <td class="text-right">Rp {{ number_format($order->total_harga, 0, ',', '.') }}</td>
                        <td>{{ date('d M Y', strtotime($order->tanggal)) }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td colspan="5">Total Honey Orders</td>
                    <td class="text-right">Rp {{ number_format($totals['madu']['revenue'], 0, ',', '.') }}</td>
                    <td colspan="2">{{ $totals['madu']['count'] }} orders</td>
                </tr>
            </tfoot>
        </table>
    @endif

    <div style="margin-top: 50px;">
        <h3>Detail Summary</h3>
        <table style="width: 50%;">
            <tr>
                <th>Category</th>
                <th>Tour Guide</th>
                <th>Honey</th>
                <th>Total</th>
            </tr>
            <tr>
                <td>Pending Orders</td>
                <td class="text-center">{{ $totals['tourguide']['pending'] }}</td>
                <td class="text-center">{{ $totals['madu']['pending'] }}</td>
                <td class="text-center">{{ $totals['tourguide']['pending'] + $totals['madu']['pending'] }}</td>
            </tr>
            <tr>
                <td>Accepted Orders</td>
                <td class="text-center">{{ $totals['tourguide']['accepted'] }}</td>
                <td class="text-center">{{ $totals['madu']['accepted'] }}</td>
                <td class="text-center">{{ $totals['tourguide']['accepted'] + $totals['madu']['accepted'] }}</td>
            </tr>
            <tr>
                <td>Rejected Orders</td>
                <td class="text-center">{{ $totals['tourguide']['rejected'] }}</td>
                <td class="text-center">{{ $totals['madu']['rejected'] }}</td>
                <td class="text-center">{{ $totals['tourguide']['rejected'] + $totals['madu']['rejected'] }}</td>
            </tr>
            <tr class="total-row">
                <td>Total Revenue</td>
                <td class="text-right">Rp {{ number_format($totals['tourguide']['revenue'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totals['madu']['revenue'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($totals['total']['revenue'], 0, ',', '.') }}</td>
            </tr>
        </table>
    </div>
</body>

</html>
