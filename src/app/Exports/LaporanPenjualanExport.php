<?php

namespace App\Exports;

use App\Models\OrderTourGuide;
use App\Models\OrderMadu;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Maatwebsite\Excel\Concerns\WithTitle;
use Carbon\Carbon;

class LaporanPenjualanExport implements WithMultipleSheets
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function sheets(): array
    {
        $sheets = [];
        $type = $this->filters['type'] ?? 'all';

        if ($type === 'all' || $type === 'tourguide') {
            $sheets[] = new TourGuideSheet($this->filters);
        }

        if ($type === 'all' || $type === 'madu') {
            $sheets[] = new MaduSheet($this->filters);
        }

        $sheets[] = new SummarySheet($this->filters);

        return $sheets;
    }
}

class TourGuideSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = OrderTourGuide::query();
        
        if (isset($this->filters['period']) && $this->filters['period'] !== 'all') {
            $dateFilter = $this->getDateFilter($this->filters['period'], $this->filters['start_date'] ?? null, $this->filters['end_date'] ?? null);
            $query->whereBetween('tanggal_order', [$dateFilter['start'], $dateFilter['end']]);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Customer Name',
            'Tour Guide',
            'Order Date',
            'Number of People',
            'Price Range',
            'Final Price',
            'Status',
            'Created At'
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->user_name,
            $order->tourguide_name,
            date('d M Y', strtotime($order->tanggal_order)),
            $order->jumlah_orang,
            $order->price_range,
            $order->final_price ? 'Rp ' . number_format($order->final_price, 0, ',', '.') : '-',
            ucfirst($order->status),
            $order->created_at->format('d M Y H:i')
        ];
    }

    public function title(): string
    {
        return 'Tour Guide Orders';
    }

    private function getDateFilter($period, $startDate = null, $endDate = null)
    {
        $now = Carbon::now();
        
        switch ($period) {
            case 'today':
                return ['start' => $now->startOfDay(), 'end' => $now->endOfDay()];
            case 'week':
                return ['start' => $now->startOfWeek(), 'end' => $now->endOfWeek()];
            case 'month':
                return ['start' => $now->startOfMonth(), 'end' => $now->endOfMonth()];
            case 'custom':
                return ['start' => Carbon::parse($startDate)->startOfDay(), 'end' => Carbon::parse($endDate)->endOfDay()];
            default:
                return ['start' => Carbon::create(2020, 1, 1), 'end' => $now->endOfDay()];
        }
    }
}

class MaduSheet implements FromCollection, WithHeadings, WithMapping, WithTitle
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        $query = OrderMadu::query();
        
        if (isset($this->filters['period']) && $this->filters['period'] !== 'all') {
            $dateFilter = $this->getDateFilter($this->filters['period'], $this->filters['start_date'] ?? null, $this->filters['end_date'] ?? null);
            $query->whereBetween('tanggal', [$dateFilter['start'], $dateFilter['end']]);
        }

        return $query->orderBy('created_at', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Product Name',
            'Size',
            'Quantity',
            'Price per Item',
            'Total Price',
            'Pickup Date',
            'Status',
            'Created At'
        ];
    }

    public function map($order): array
    {
        return [
            $order->id,
            $order->nama_madu,
            $order->ukuran,
            $order->jumlah,
            'Rp ' . number_format($order->harga, 0, ',', '.'),
            'Rp ' . number_format($order->total_harga, 0, ',', '.'),
            date('d M Y', strtotime($order->tanggal)),
            ucfirst($order->status),
            $order->created_at->format('d M Y H:i')
        ];
    }

    public function title(): string
    {
        return 'Honey Orders';
    }

    private function getDateFilter($period, $startDate = null, $endDate = null)
    {
        $now = Carbon::now();
        
        switch ($period) {
            case 'today':
                return ['start' => $now->startOfDay(), 'end' => $now->endOfDay()];
            case 'week':
                return ['start' => $now->startOfWeek(), 'end' => $now->endOfWeek()];
            case 'month':
                return ['start' => $now->startOfMonth(), 'end' => $now->endOfMonth()];
            case 'custom':
                return ['start' => Carbon::parse($startDate)->startOfDay(), 'end' => Carbon::parse($endDate)->endOfDay()];
            default:
                return ['start' => Carbon::create(2020, 1, 1), 'end' => $now->endOfDay()];
        }
    }
}

class SummarySheet implements FromCollection, WithHeadings, WithTitle
{
    protected $filters;

    public function __construct($filters)
    {
        $this->filters = $filters;
    }

    public function collection()
    {
        // Calculate summary data
        $tourGuideQuery = OrderTourGuide::query();
        $maduQuery = OrderMadu::query();

        if (isset($this->filters['period']) && $this->filters['period'] !== 'all') {
            $dateFilter = $this->getDateFilter($this->filters['period'], $this->filters['start_date'] ?? null, $this->filters['end_date'] ?? null);
            
            $tourGuideQuery->whereBetween('tanggal_order', [$dateFilter['start'], $dateFilter['end']]);
            $maduQuery->whereBetween('tanggal', [$dateFilter['start'], $dateFilter['end']]);
        }

        $tourGuideOrders = $tourGuideQuery->get();
        $maduOrders = $maduQuery->get();

        return collect([
            ['Category', 'Tour Guide Orders', 'Honey Orders', 'Total'],
            ['Total Orders', $tourGuideOrders->count(), $maduOrders->count(), $tourGuideOrders->count() + $maduOrders->count()],
            ['Pending Orders', $tourGuideOrders->where('status', 'pending')->count(), $maduOrders->where('status', 'pending')->count(), $tourGuideOrders->where('status', 'pending')->count() + $maduOrders->where('status', 'pending')->count()],
            ['Accepted Orders', $tourGuideOrders->where('status', 'accepted')->count(), $maduOrders->where('status', 'accepted')->count(), $tourGuideOrders->where('status', 'accepted')->count() + $maduOrders->where('status', 'accepted')->count()],
            ['Rejected Orders', $tourGuideOrders->where('status', 'rejected')->count(), $maduOrders->where('status', 'rejected')->count(), $tourGuideOrders->where('status', 'rejected')->count() + $maduOrders->where('status', 'rejected')->count()],
            ['Total Revenue', 'Rp ' . number_format($tourGuideOrders->where('status', 'accepted')->sum('final_price'), 0, ',', '.'), 'Rp ' . number_format($maduOrders->where('status', 'accepted')->sum('total_harga'), 0, ',', '.'), 'Rp ' . number_format($tourGuideOrders->where('status', 'accepted')->sum('final_price') + $maduOrders->where('status', 'accepted')->sum('total_harga'), 0, ',', '.')]
        ]);
    }

    public function headings(): array
    {
        return [];
    }

    public function title(): string
    {
        return 'Summary';
    }

    private function getDateFilter($period, $startDate = null, $endDate = null)
    {
        $now = Carbon::now();
        
        switch ($period) {
            case 'today':
                return ['start' => $now->startOfDay(), 'end' => $now->endOfDay()];
            case 'week':
                return ['start' => $now->startOfWeek(), 'end' => $now->endOfWeek()];
            case 'month':
                return ['start' => $now->startOfMonth(), 'end' => $now->endOfMonth()];
            case 'custom':
                return ['start' => Carbon::parse($startDate)->startOfDay(), 'end' => Carbon::parse($endDate)->endOfDay()];
            default:
                return ['start' => Carbon::create(2020, 1, 1), 'end' => $now->endOfDay()];
        }
    }
}

