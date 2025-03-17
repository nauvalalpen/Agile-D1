<?php
namespace App\Http\Controllers;

use App\Models\Tourist;
use App\Models\Checkpoint;
use Illuminate\Support\Facades\DB;

class TouristCheckpointController extends Controller
{
    public function checkout($id)
    {
        $tourist = Tourist::findOrFail($id);
        
        DB::transaction(function() use ($tourist) {
            $tourist->update([
                'checkout_time' => now(),
                'status' => 'checked_out'
            ]);

            Checkpoint::create([
                'tourist_id' => $tourist->id,
                'location' => 'exit_gate',
                'timestamp' => now()
            ]);
        });

        return redirect()->back()->with('success', 'Tourist checked out successfully');
    }
}

?>