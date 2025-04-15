<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderHistoryController extends Controller
{
    /**
     * Display user's order history
     */
    public function index()
    {
        $user_id = Auth::id();
        
        // Get all orders for the current user with tour guide details
        $orders = DB::table('order_tour_guides')
            ->join('tourguides', 'order_tour_guides.tourguide_id', '=', 'tourguides.id')
            ->select('order_tour_guides.*', 'tourguides.nama as tourguide_name', 'tourguides.foto as tourguide_foto')
            ->where('order_tour_guides.user_id', $user_id)
            ->orderBy('order_tour_guides.created_at', 'desc')
            ->get();
            
        // Mark notifications as read when viewing order history
        DB::table('order_tour_guides')
            ->where('user_id', $user_id)
            ->update(['is_read' => true]);
            
        return view('order_history.index', compact('orders'));
    }
    
    /**
     * Display details of a specific order
     */
    public function show($id)
    {
        $user_id = Auth::id();
        
        // Get the specific order with tour guide details
        $order = DB::table('order_tour_guides')
            ->join('tourguides', 'order_tour_guides.tourguide_id', '=', 'tourguides.id')
            ->select('order_tour_guides.*', 'tourguides.nama as tourguide_name', 
                    'tourguides.nohp as tourguide_nohp', 'tourguides.alamat as tourguide_alamat', 
                    'tourguides.deskripsi as tourguide_deskripsi', 'tourguides.foto as tourguide_foto')
            ->where('order_tour_guides.id', $id)
            ->where('order_tour_guides.user_id', $user_id)
            ->first();
            
        if (!$order) {
            return redirect()->route('order-history.index')->with('error', 'Order not found.');
        }
        
        // Mark this specific notification as read
        DB::table('order_tour_guides')
            ->where('id', $id)
            ->update(['is_read' => true]);
        
        return view('order_history.show', compact('order'));
    }
}
