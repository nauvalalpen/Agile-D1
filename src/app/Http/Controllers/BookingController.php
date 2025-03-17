<?php 

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Tourist;
use App\Models\TourGuide;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'tourist_id' => 'required|exists:tourists,id',
            'guide_id' => 'required|exists:tour_guides,id',
            'booking_date' => 'required|date',
            'duration' => 'required|integer'
        ]);

        $booking = Booking::create($validated);
        
        return redirect()->route('bookings.index')
            ->with('success', 'Booking created successfully');
    }
}

?>