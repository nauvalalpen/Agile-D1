<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Laravel\Socialite\Two\InvalidStateException;

class HandleSocialiteErrors
{
    public function handle(Request $request, Closure $next)
    {
        try {
            return $next($request);
        } catch (InvalidStateException $e) {
            return redirect()->route('login')->with('error', 'Authentication session expired. Please try again.');
        } catch (\Exception $e) {
            \Log::error('Socialite Error: ' . $e->getMessage());
            return redirect()->route('login')->with('error', 'Authentication failed. Please try again.');
        }
    }
}
