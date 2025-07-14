<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // dd(Auth::user());
        if (Auth::check() && Auth::user()->role=='admin') {
            return $next($request);
        }
        
        // return redirect('/')->with('error', 'You do not have admin access');
        abort(403, 'Unauthorized access. Admin role required.');
    }
}
