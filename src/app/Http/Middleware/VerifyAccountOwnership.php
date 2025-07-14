<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifyAccountOwnership
{
    public function handle(Request $request, Closure $next)
    {
        // Ensure user is authenticated
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // For sensitive operations, require recent authentication
        $sensitiveRoutes = [
            'settings.password.update',
            'settings.2fa.enable',
            'settings.2fa.disable',
            'settings.account.delete',
            'auth.google.unlink',
        ];

        if (in_array($request->route()->getName(), $sensitiveRoutes)) {
            // Check if user authenticated recently (within last 30 minutes)
            $lastAuth = session('auth.password_confirmed_at');
            
            if (!$lastAuth || now()->diffInMinutes($lastAuth) > 30) {
                // Store intended URL
                session(['url.intended' => $request->url()]);
                
                return redirect()->route('password.confirm')
                    ->with('warning', 'Please confirm your password to continue.');
            }
        }

        return $next($request);
    }
}
