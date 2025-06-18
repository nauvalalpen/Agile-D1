<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\OrderTourGuide;
use App\Models\OrderMadu;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanPenjualanExport;
use Illuminate\Support\Facades\DB;

class LaporanPenjualanController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');
        $period = $request->get('period', 'all');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Initialize queries
        $tourGuideQuery = OrderTourGuide::query();
        $maduQuery = OrderMadu::query();

        // Apply date filters
        if ($period !== 'all') {
            $dateFilter = $this->getDateFilter($period, $startDate, $endDate);
            
            $tourGuideQuery->whereBetween('tanggal_order', [$dateFilter['start'], $dateFilter['end']]);
            $maduQuery->whereBetween('tanggal', [$dateFilter['start'], $dateFilter['end']]);
        }

        // Get data based on type filter
        $tourGuideOrders = collect();
        $maduOrders = collect();

        if ($type === 'all' || $type === 'tourguide') {
            $tourGuideOrders = $tourGuideQuery->orderBy('created_at', 'desc')->get();
        }

        if ($type === 'all' || $type === 'madu') {
            $maduOrders = $maduQuery->orderBy('created_at', 'desc')->get();
        }

        // Calculate totals
        $totals = $this->calculateTotals($tourGuideOrders, $maduOrders);

        return view('admin.laporan-penjualan.index', compact(
            'tourGuideOrders',
            'maduOrders',
            'totals',
            'type',
            'period',
            'startDate',
            'endDate'
        ));
    }

    private function getDateFilter($period, $startDate = null, $endDate = null)
    {
        $now = Carbon::now();
        
        switch ($period) {
            case 'today':
                return [
                    'start' => $now->copy()->startOfDay(),
                    'end' => $now->copy()->endOfDay()
                ];
            case 'week':
                return [
                    'start' => $now->copy()->startOfWeek(),
                    'end' => $now->copy()->endOfWeek()
                ];
            case 'month':
                return [
                    'start' => $now->copy()->startOfMonth(),
                    'end' => $now->copy()->endOfMonth()
                ];
            case 'custom':
                return [
                    'start' => Carbon::parse($startDate)->startOfDay(),
                    'end' => Carbon::parse($endDate)->endOfDay()
                ];
            default:
                return [
                    'start' => Carbon::create(2020, 1, 1),
                    'end' => $now->copy()->endOfDay()
                ];
        }
    }

    private function calculateTotals($tourGuideOrders, $maduOrders)
    {
        return [
            'tourguide' => [
                'count' => $tourGuideOrders->count(),
                'revenue' => $tourGuideOrders->where('status', 'accepted')->sum('final_price'),
                'pending' => $tourGuideOrders->where('status', 'pending')->count(),
                'accepted' => $tourGuideOrders->where('status', 'accepted')->count(),
                'rejected' => $tourGuideOrders->where('status', 'rejected')->count(),
            ],
            'madu' => [
                'count' => $maduOrders->count(),
                'revenue' => $maduOrders->where('status', 'accepted')->sum('total_harga'),
                'pending' => $maduOrders->where('status', 'pending')->count(),
                'accepted' => $maduOrders->where('status', 'accepted')->count(),
                'rejected' => $maduOrders->where('status', 'rejected')->count(),
            ],
            'total' => [
                'count' => $tourGuideOrders->count() + $maduOrders->count(),
                'revenue' => $tourGuideOrders->where('status', 'accepted')->sum('final_price') + $maduOrders->where('status', 'accepted')->sum('total_harga'),
            ]
        ];
    }

    public function exportPdf(Request $request)
    {
        $type = $request->get('type', 'all');
        $period = $request->get('period', 'all');
        $startDate = $request->get('start_date');
        $endDate = $request->get('end_date');

        // Get filtered data (same logic as index method)
        $tourGuideQuery = OrderTourGuide::query();
        $maduQuery = OrderMadu::query();

        if ($period !== 'all') {
            $dateFilter = $this->getDateFilter($period, $startDate, $endDate);
            
            $tourGuideQuery->whereBetween('tanggal_order', [$dateFilter['start'], $dateFilter['end']]);
            $maduQuery->whereBetween('tanggal', [$dateFilter['start'], $dateFilter['end']]);
        }

        $tourGuideOrders = collect();
        $maduOrders = collect();

        if ($type === 'all' || $type === 'tourguide') {
            $tourGuideOrders = $tourGuideQuery->orderBy('created_at', 'desc')->get();
        }

        if ($type === 'all' || $type === 'madu') {
            $maduOrders = $maduQuery->orderBy('created_at', 'desc')->get();
        }

        $totals = $this->calculateTotals($tourGuideOrders, $maduOrders);

        $pdf = Pdf::loadView('admin.laporan-penjualan.pdf', compact(
            'tourGuideOrders',
            'maduOrders',
            'totals',
            'type',
            'period'
        ));

        return $pdf->download('laporan-penjualan-' . date('Y-m-d') . '.pdf');
    }

    public function exportExcel(Request $request)
    {
        return Excel::download(new LaporanPenjualanExport($request->all()), 'laporan-penjualan-' . date('Y-m-d') . '.xlsx');
    }
}
