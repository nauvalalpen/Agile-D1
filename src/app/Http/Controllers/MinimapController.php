<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MinimapController extends Controller
{
    /**
     * Display the minimap navigation
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        // You can add logic here to fetch minimap data if needed
        $minimapData = [
            'title' => 'Digital Navigation Map',
            'description' => 'Interactive minimap for location navigation'
        ];

        return view('minimap.index', compact('minimapData'));
    }

    /**
     * Display fullscreen minimap
     *
     * @return \Illuminate\View\View
     */
    public function fullscreen()
    {
        return view('minimap.fullscreen');
    }
}
