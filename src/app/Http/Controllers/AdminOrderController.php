<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    /**
     * Display all tour guide orders for admin
     */
    public function index()
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        
        // Get all orders with user and tour guide details
        $orders = DB::table('order_tour_guides')
            ->join('users', 'order_tour_guides.user_id', '=', 'users.id')
            ->join('tourguides', 'order_tour_guides.tourguide_id', '=', 'tourguides.id')
            ->select('order_tour_guides.*', 'users.name as user_name', 'tourguides.nama as tourguide_name')
            ->orderBy('order_tour_guides.created_at', 'desc')
            ->get();
            
        return view('admin.orders.index', compact('orders'));
    }
    
    /**
     * Show form to set price and confirm/deny order
     */
    public function edit($id)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        
        $order = DB::table('order_tour_guides')
            ->join('users', 'order_tour_guides.user_id', '=', 'users.id')
            ->join('tourguides', 'order_tour_guides.tourguide_id', '=', 'tourguides.id')
            ->select('order_tour_guides.*', 'users.name as user_name', 'users.email as user_email',
                    'tourguides.nama as tourguide_name', 'tourguides.nohp as tourguide_nohp',
                    'tourguides.alamat as tourguide_alamat', 'tourguides.deskripsi as tourguide_deskripsi')
            ->where('order_tour_guides.id', $id)
            ->first();
            
        if (!$order) {
            return redirect()->route('admin.orders.index')->with('error', 'Order not found.');
        }
        
        return view('admin.orders.edit', compact('order'));
    }
    
    /**
     * Update order status and price
     */
    public function update(Request $request, $id)
    {
        // Check if user is admin
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('home')->with('error', 'Unauthorized access.');
        }
        
        $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
            'final_price' => 'required_if:status,accepted|nullable|numeric|min:0',
            'admin_notes' => 'nullable|string|max:500',
        ]);
        
        $updateData = [
            'status' => $request->status,
            'admin_notes' => $request->admin_notes,
            'is_read' => false, // Mark as unread so user gets notification
            'updated_at' => now(),
        ];
        
        if ($request->status == 'accepted' && $request->filled('final_price')) {
            $updateData['final_price'] = $request->final_price;
        }
        
        DB::table('order_tour_guides')
            ->where('id', $id)
            ->update($updateData);
            
        return redirect()->route('admin.orders.index')->with('success', 'Order has been ' . $request->status);
    }
}
