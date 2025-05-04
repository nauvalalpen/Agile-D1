<?php

namespace App\Http\Controllers;

use App\Models\Madu;
use App\Models\OrderMadu;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderMaduController extends Controller
{
    /**
     * Display a listing of the user's honey orders.
     */
    public function index()
    {
        $orders = OrderMadu::where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('order-history.madu', compact('orders'));
    }

    /**
     * Display the specified order.
     */

        public function show($id)
        {
            $user = Auth::user();
            
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
                    'users.email as user_email'
                )
                ->where('order_madus.id', $id)
                ->where('order_madus.user_id', $user->id)
                ->first();
                
            if (!$order) {
                return redirect()->route('order-history.index')->with('error', 'Order not found');
            }
            
            // Mark notification as read if it's unread
            if (!$order->is_read && in_array($order->status, ['accepted', 'rejected'])) {
                DB::table('order_madus')
                    ->where('id', $id)
                    ->update(['is_read' => true]);
            }
            
            return redirect()->route('order-history.show', ['id' => $id, 'type' => 'honey']);
        }
        
    

    /**
     * Display a listing of all honey orders for admin.
     */
    public function adminIndex()
    {
        $orders = OrderMadu::with(['user', 'madu'])
            ->orderBy('created_at', 'desc')
            ->get();
        
        return view('admin.madu.orders', compact('orders'));
    }

    /**
     * Show the form for editing the specified order.
     */
    public function edit($id)
    {
        $order = OrderMadu::findOrFail($id);
        return view('admin.madu.order-edit', compact('order'));
    }

    /**
     * Update the specified order in storage.
     */
    public function update(Request $request, $id)
    {
        $order = OrderMadu::findOrFail($id);
        
        $validated = $request->validate([
            'status' => 'required|in:pending,accepted,rejected',
        ]);

        // If rejecting an order that was previously accepted, restore the stock
        if ($order->status === 'accepted' && $validated['status'] === 'rejected') {
            $madu = Madu::find($order->madu_id);
            if ($madu) {
                $madu->update([
                    'stock' => $madu->stock + $order->jumlah
                ]);
            }
        }
        
        // If accepting an order that was previously rejected, reduce the stock
        if ($order->status === 'rejected' && $validated['status'] === 'accepted') {
            $madu = Madu::find($order->madu_id);
            if ($madu) {
                $madu->update([
                    'stock' => $madu->stock - $order->jumlah
                ]);
            }
        }

        $order->update($validated);

        return redirect()->route('admin.orders-madu.index')
            ->with('success', 'Order status updated successfully.');
    }
}
