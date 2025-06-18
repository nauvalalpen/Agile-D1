<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    public function submit(Request $request)
    {
        // Validate the form data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Here you would typically:
        // 1. Save the contact message to the database
        // 2. Send an email notification
        // 3. Or both

        // For now, just redirect back with a success message
        return redirect()->route('contact')->with('success', 'Thank you for your message! We will get back to you soon.');
    }
}
