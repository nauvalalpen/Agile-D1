<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class AddCsrfToken
{
    public function handle(Request $request, Closure $next)
    {
        View::share('csrf_token', csrf_token());
        return $next($request);
    }
}
