<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CacheStaticAssets
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // Check if the path matches a static asset pattern
        if ($request->is('images/*') || $request->is('css/*')) {
            $response->headers->set('Cache-Control', 'public, max-age=604800'); // Cache for 7 days
        }

        return $response;
    }
}