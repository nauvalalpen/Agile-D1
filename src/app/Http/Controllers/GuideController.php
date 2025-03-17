<?php

namespace App\Http\Controllers;

use App\Models\Guide;  // Changed from TourGuide to Guide
use Illuminate\Http\Request;

class GuideController extends Controller
{
    public function index()
    {
        $guides = Guide::with('bookings')->get();  // Using Guide instead of TourGuide
        return view('admin.guides.index', compact('guides'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'expertise' => 'required',
            'contact' => 'required'
        ]);

        Guide::create($validated);  // Using Guide instead of TourGuide
        return redirect()->route('guides.index');
    }
}


?>