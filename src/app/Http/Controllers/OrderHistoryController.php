<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class OrderHistoryController extends Controller
{
    /**
     * Display user's order history
     */
        public function index(Request $request)
        {
            $user = Auth::user();
            $activeTab = $request->query('tab', 'all'); // Default to 'all' if no tab specified
            
            // First, let's check the actual column name in the order_tour_guides table
            $tourGuideColumns = Schema::getColumnListing('order_tour_guides');
            $dateColumnName = in_array('tanggal', $tourGuideColumns) ? 'tanggal' : 
                             (in_array('date', $tourGuideColumns) ? 'date' : 
                             (in_array('tour_date', $tourGuideColumns) ? 'tour_date' : 'created_at'));
            
            // Get tour guide orders
            $tourGuideOrders = DB::table('order_tour_guides')
                ->join('tourguides', 'order_tour_guides.tourguide_id', '=', 'tourguides.id')
                ->join('users', 'order_tour_guides.user_id', '=', 'users.id')
                ->select(
                    'order_tour_guides.id',
                    "order_tour_guides.{$dateColumnName} as date", // Use the detected column name
                    'order_tour_guides.status',
                    'order_tour_guides.created_at',
                    'order_tour_guides.updated_at',
                    'tourguides.nama as item_name',
                    'tourguides.nohp as item_detail',
                    DB::raw("'tour_guide' as order_type"),
                    DB::raw("NULL as jumlah"),
                    DB::raw("NULL as total_harga")
                )
                ->where('order_tour_guides.user_id', $user->id);
            
            // Get honey orders
            $honeyOrders = DB::table('order_madus')
                ->join('madus', 'order_madus.madu_id', '=', 'madus.id')
                ->join('users', 'order_madus.user_id', '=', 'users.id')
                ->select(
                    'order_madus.id',
                    'order_madus.tanggal as date', // Standardize to 'date'
                    'order_madus.status',
                    'order_madus.created_at',
                    'order_madus.updated_at',
                    'madus.nama_madu as item_name',
                    'madus.ukuran as item_detail',
                    DB::raw("'honey' as order_type"),
                    'order_madus.jumlah',
                    'order_madus.total_harga'
                )
                ->where('order_madus.user_id', $user->id);
            
            // Filter based on active tab
            if ($activeTab === 'tour_guide') {
                $orders = $tourGuideOrders->orderBy('order_tour_guides.created_at', 'desc')->get();
            } elseif ($activeTab === 'honey') {
                $orders = $honeyOrders->orderBy('order_madus.created_at', 'desc')->get();
            } else {
                // For the combined view, we'll use the alternative approach without UNION
                $tourGuideResults = $tourGuideOrders->orderBy('order_tour_guides.created_at', 'desc')->get();
                $honeyResults = $honeyOrders->orderBy('order_madus.created_at', 'desc')->get();
                
                // Combine the results
                $orders = collect(array_merge($tourGuideResults->all(), $honeyResults->all()))
                    ->sortByDesc('created_at')
                    ->values();
            }
            
            return view('order-history.index', compact('orders', 'activeTab'));
        }
        
    

    public function show($id, Request $request)
    {
        $user = Auth::user();
        $orderType = $request->query('type', 'tour_guide'); // Default to tour_guide
        
        if ($orderType === 'honey') {
            $order = DB::table('order_madus')
                ->join('madus', 'order_madus.madu_id', '=', 'madus.id')
                ->join('users', 'order_madus.user_id', '=', 'users.id')
                ->select(
                    'order_madus.*',
                    'madus.nama_madu',
                    'madus.ukuran',
                    'madus.harga',
                    'madus.gambar',
                    'users.name as user_name',
                    'users.email as user_email',
                    DB::raw("'honey' as order_type")
                )
                ->where('order_madus.id', $id)
                ->where('order_madus.user_id', $user->id)
                ->first();
                
            if (!$order) {
                return redirect()->route('order-history.index')->with('error', 'Order not found');
            }
            
            return view('order-history.show-honey', compact('order'));
        } else {
            $order = DB::table('order_tour_guides')
                ->join('tourguides', 'order_tour_guides.tourguide_id', '=', 'tourguides.id')
                ->join('users', 'order_tour_guides.user_id', '=', 'users.id')
                ->select(
                    'order_tour_guides.*',
                    'tourguides.nama as tourguide_name',
                    'tourguides.nohp as tourguide_nohp',
                    'tourguides.alamat as tourguide_alamat',
                    'tourguides.price_range as tourguide_price_range',
                    'users.name as user_name',
                    'users.email as user_email',
                    DB::raw("'tour_guide' as order_type")
                )
                ->where('order_tour_guides.id', $id)
                ->where('order_tour_guides.user_id', $user->id)
                ->first();
                
            if (!$order) {
                return redirect()->route('order-history.index')->with('error', 'Order not found');
            }
            
            // Mark notification as read if it's unread
            if (!$order->is_read && in_array($order->status, ['accepted', 'rejected'])) {
                DB::table('order_tour_guides')
                    ->where('id', $id)
                    ->update(['is_read' => true]);
            }
            
            return view('order-history.show-tour-guide', compact('order'));
        }
    }

}
