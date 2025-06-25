<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\TourGuide;
use App\Models\Facility;
use App\Models\UserActivity;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $filter = $request->get('filter', 'week');
        $analytics = $this->getAnalyticsData($filter);
        $recentActivities = $this->getRecentActivities();

        if ($request->ajax()) {
            return response()->json($analytics);
        }

        return view('admin.dashboard', compact('analytics', 'recentActivities'));
    }

    private function getAnalyticsData($filter)
    {
        $dateRange = $this->getDateRange($filter);
        
        return [
            'total_users' => $this->getTotalUsers(),
            'active_users' => $this->getActiveUsers($dateRange),
            'new_registrations' => $this->getNewRegistrations($dateRange),
            'tour_bookings' => $this->getTourBookings($dateRange),
            'activity_labels' => $this->getActivityLabels($filter),
            'activity_data' => $this->getActivityData($filter),
            'user_types_labels' => ['Regular Users', 'Tour Guides', 'Admins'],
            'user_types_data' => $this->getUserTypesData(),
            'monthly_labels' => $this->getMonthlyLabels(),
            'monthly_data' => $this->getMonthlyRegistrationData(),
            'facilities_labels' => $this->getFacilitiesLabels(),
            'facilities_data' => $this->getFacilitiesData(),
            'most_used_facilities' => $this->getMostUsedFacilities(),
            'recently_used_facilities' => $this->getRecentlyUsedFacilities()
        ];
    }

    private function getDateRange($filter)
    {
        switch ($filter) {
            case 'week':
                return [
                    'start' => Carbon::now()->startOfWeek(),
                    'end' => Carbon::now()->endOfWeek()
                ];
            case 'month':
                return [
                    'start' => Carbon::now()->startOfMonth(),
                    'end' => Carbon::now()->endOfMonth()
                ];
            case 'year':
                return [
                    'start' => Carbon::now()->startOfYear(),
                    'end' => Carbon::now()->endOfYear()
                ];
            default:
                return [
                    'start' => Carbon::now()->startOfWeek(),
                    'end' => Carbon::now()->endOfWeek()
                ];
        }
    }

    private function getTotalUsers()
    {
        return User::count();
    }

    private function getActiveUsers($dateRange)
    {
        return User::whereBetween('updated_at', [$dateRange['start'], $dateRange['end']])
                   ->count();
    }

    private function getNewRegistrations($dateRange)
    {
        return User::whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                   ->count();
    }

    private function getTourBookings($dateRange)
    {
        return DB::table('order_tour_guides')
                 ->whereBetween('created_at', [$dateRange['start'], $dateRange['end']])
                 ->count();
    }

    private function getActivityLabels($filter)
    {
        switch ($filter) {
            case 'week':
                return ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
            case 'month':
                $days = [];
                $start = Carbon::now()->startOfMonth();
                $end = Carbon::now()->endOfMonth();
                
                for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
                    $days[] = $date->format('M j');
                }
                return $days;
            case 'year':
                return ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 
                       'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            default:
                return ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
        }
    }

    private function getActivityData($filter)
    {
        switch ($filter) {
            case 'week':
                return $this->getWeeklyActivityData();
            case 'month':
                return $this->getMonthlyActivityData();
            case 'year':
                return $this->getYearlyActivityData();
            default:
                return $this->getWeeklyActivityData();
        }
    }

    private function getWeeklyActivityData()
    {
        $data = [];
        $startOfWeek = Carbon::now()->startOfWeek();
        
        for ($i = 0; $i < 7; $i++) {
            $date = $startOfWeek->copy()->addDays($i);
            $count = User::whereDate('updated_at', $date)->count();
            $data[] = $count;
        }
        
        return $data;
    }

    private function getMonthlyActivityData()
    {
        $data = [];
        $start = Carbon::now()->startOfMonth();
        $end = Carbon::now()->endOfMonth();
        
        for ($date = $start->copy(); $date->lte($end); $date->addDay()) {
            $count = User::whereDate('updated_at', $date)->count();
            $data[] = $count;
        }
        
        return $data;
    }

    private function getYearlyActivityData()
    {
        $data = [];
        
        for ($month = 1; $month <= 12; $month++) {
            $count = User::whereYear('created_at', Carbon::now()->year)
                        ->whereMonth('created_at', $month)
                        ->count();
            $data[] = $count;
        }
        
        return $data;
    }

    private function getUserTypesData()
    {
        $regularUsers = User::where('role', 'user')->orWhereNull('role')->count();
        $tourGuides = User::where('role', 'tour_guide')->count();
        $admins = User::where('role', 'admin')->count();
        
        return [$regularUsers, $tourGuides, $admins];
    }

    private function getMonthlyLabels()
    {
        $labels = [];
        for ($i = 5; $i >= 0; $i--) {
            $labels[] = Carbon::now()->subMonths($i)->format('M Y');
        }
        return $labels;
    }

    private function getMonthlyRegistrationData()
    {
        $data = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = Carbon::now()->subMonths($i);
            $count = User::whereYear('created_at', $date->year)
                        ->whereMonth('created_at', $date->month)
                        ->count();
            $data[] = $count;
        }
        return $data;
    }

    private function getFacilitiesLabels()
    {
        return Facility::orderBy('usage_count', 'desc')
                      ->limit(5)
                      ->pluck('nama_fasilitas')
                      ->toArray();
    }

    private function getFacilitiesData()
    {
        return Facility::orderBy('usage_count', 'desc')
                      ->limit(5)
                      ->pluck('usage_count')
                      ->toArray();
    }

    private function getMostUsedFacilities()
    {
        return Facility::orderBy('usage_count', 'desc')
                      ->limit(5)
                      ->get();
    }

    private function getRecentlyUsedFacilities()
    {
        return Facility::whereNotNull('last_used_at')
                      ->orderBy('last_used_at', 'desc')
                      ->limit(5)
                      ->get();
    }

    private function getRecentActivities()
    {
        // If you have UserActivity model implemented
        if (class_exists(UserActivity::class)) {
            return UserActivity::with('user')
                              ->orderBy('created_at', 'desc')
                              ->limit(10)
                              ->get();
        }

        // Mock data if UserActivity is not implemented yet
        return collect([
            (object) [
                'user' => (object) ['name' => 'John Doe'],
                'activity_type' => 'Login',
                'created_at' => Carbon::now()->subMinutes(5),
                'status' => 'success'
            ],
            (object) [
                'user' => (object) ['name' => 'Jane Smith'],
                'activity_type' => 'Tour Booking',
                'created_at' => Carbon::now()->subMinutes(15),
                'status' => 'success'
            ],
            (object) [
                'user' => (object) ['name' => 'Mike Johnson'],
                'activity_type' => 'Facility Usage',
                'created_at' => Carbon::now()->subMinutes(30),
                'status' => 'success'
            ],
            (object) [
                'user' => (object) ['name' => 'Sarah Wilson'],
                'activity_type' => 'Profile Update',
                'created_at' => Carbon::now()->subHours(1),
                'status' => 'success'
            ],
            (object) [
                'user' => (object) ['name' => 'David Brown'],
                'activity_type' => 'Facility Check-in',
                'created_at' => Carbon::now()->subHours(2),
                'status' => 'success'
            ]
        ]);
    }

    // Additional method to get comprehensive facility statistics
    public function getFacilityStats()
    {
        return [
            'total_facilities' => Facility::count(),
            'facilities_with_photos' => Facility::whereNotNull('foto')->count(),
            'most_used_today' => Facility::whereDate('last_used_at', Carbon::today())
                                       ->orderBy('usage_count', 'desc')
                                       ->first(),
            'average_usage' => Facility::avg('usage_count'),
            'facilities_by_location' => Facility::select('lokasi', DB::raw('count(*) as count'))
                                              ->groupBy('lokasi')
                                              ->get()
        ];
    }

    // Method to get real-time dashboard data
    public function getRealTimeData()
    {
        return response()->json([
            'online_users' => $this->getOnlineUsersCount(),
            'active_bookings' => $this->getActiveBookingsCount(),
            'facility_occupancy' => $this->getFacilityOccupancy(),
            'system_status' => $this->getSystemStatus()
        ]);
    }

    private function getOnlineUsersCount()
    {
        // Assuming you track user sessions or last activity
        return User::where('updated_at', '>=', Carbon::now()->subMinutes(15))->count();
    }

    private function getActiveBookingsCount()
    {
        return DB::table('order_tour_guides')
                 ->where('status', 'active')
                 ->orWhere('status', 'confirmed')
                 ->count();
    }

    private function getFacilityOccupancy()
    {
        return Facility::whereDate('last_used_at', Carbon::today())
                      ->count();
    }

    private function getSystemStatus()
    {
        return [
            'database' => 'online',
            'storage' => is_writable(storage_path()) ? 'online' : 'offline',
            'cache' => 'online',
            'queue' => 'online'
        ];
    }
}
