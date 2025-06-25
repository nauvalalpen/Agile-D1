<?php

namespace App\Traits;

use App\Models\Facility;
use App\Models\UserActivity;
use Carbon\Carbon;

trait TracksFacilityUsage
{
    /**
     * Track facility usage
     */
    public function trackFacilityUsage($facilityId, $userId = null)
    {
        $facility = Facility::find($facilityId);
        
        if ($facility) {
            $facility->increment('usage_count');
            $facility->update(['last_used_at' => Carbon::now()]);
            
            // Log the activity if user is provided
            if ($userId && class_exists(UserActivity::class)) {
                UserActivity::log(
                    $userId,
                    'facility_usage',
                    "Used facility: {$facility->nama_fasilitas}",
                    [
                        'facility_id' => $facilityId,
                        'facility_name' => $facility->nama_fasilitas,
                        'location' => $facility->lokasi
                    ]
                );
            }
            
            return true;
        }
        
        return false;
    }

    /**
     * Get facility usage statistics
     */
    public function getFacilityUsageStats($facilityId)
    {
        $facility = Facility::find($facilityId);
        
        if (!$facility) {
            return null;
        }

        return [
            'total_usage' => $facility->usage_count,
            'last_used' => $facility->last_used_at,
            'usage_today' => UserActivity::where('activity_type', 'facility_usage')
                                        ->where('metadata->facility_id', $facilityId)
                                        ->whereDate('created_at', Carbon::today())
                                        ->count(),
            'usage_this_week' => UserActivity::where('activity_type', 'facility_usage')
                                            ->where('metadata->facility_id', $facilityId)
                                            ->whereBetween('created_at', [
                                                Carbon::now()->startOfWeek(),
                                                Carbon::now()->endOfWeek()
                                            ])
                                            ->count(),
            'usage_this_month' => UserActivity::where('activity_type', 'facility_usage')
                                             ->where('metadata->facility_id', $facilityId)
                                             ->whereBetween('created_at', [
                                                 Carbon::now()->startOfMonth(),
                                                 Carbon::now()->endOfMonth()
                                             ])
                                             ->count()
        ];
    }
}
