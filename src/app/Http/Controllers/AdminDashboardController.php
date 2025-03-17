<?php 

namespace App\Http\Controllers;

use App\Models\Tourist;
use App\Models\Guide;
use App\Models\Booking;
use App\Models\Checkpoint;
use App\Models\WeatherRecord;

class AdminDashboardController extends Controller
{
    public function index()
    {
        // Get counts for dashboard statistics
        $touristCount = Tourist::whereDate('entry_date', today())->count();
        $guideCount = Guide::where('availability', true)->count();
        $bookingCount = Booking::whereDate('booking_date', today())->count();
        $weather = WeatherRecord::latest()->first();
        $recentCheckpoints = Checkpoint::with('tourist')
                                    ->latest()
                                    ->take(5)
                                    ->get();

        // Pass variables to view using compact()
        return view('admin.dashboard', compact(
            'touristCount',
            'guideCount',
            'bookingCount',
            'weather',
            'recentCheckpoints'
        ));
    }
}


?>