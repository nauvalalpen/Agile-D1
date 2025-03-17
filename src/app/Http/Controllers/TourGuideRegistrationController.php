<?php 

// Tour guide registration

namespace App\Http\Controllers;

use App\Models\TourGuide;
use Illuminate\Http\Request;

class TourGuideRegistrationController extends Controller
{
    public function storeTourGuide(Request $request) {
        $data = $request->validate([
            'name' => 'required',
            'expertise' => 'required',
            'availability' => 'required|boolean',
            'contact' => 'required'
        ]);
        
        TourGuide::create($data);
    }
}


?>