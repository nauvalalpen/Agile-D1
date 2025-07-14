<?php

namespace App\Http\Middleware;

use Illuminate\Http\Middleware\TrustProxies as Middleware;
use Illuminate\Http\Request;

class TrustProxies extends Middleware
{
    /**
     * The trusted proxies for this application.
     *
     * @var array|string|null
     */
    // Trusting all proxies is common for simple setups.
    // For higher security, you could list your proxy's IP address, e.g., '127.0.0.1'.
    protected $proxies = '*';

    /**
     * The headers that should be used to detect proxies.
     *
     * @var int
     */
    // This tells Laravel to trust the X-Forwarded-For, X-Forwarded-Host,
    // X-Forwarded-Port, X-Forwarded-Proto, and X-Forwarded-AWS-ELB headers.
    protected $headers =
        Request::HEADER_X_FORWARDED_FOR |
        Request::HEADER_X_FORWARDED_HOST |
        Request::HEADER_X_FORWARDED_PORT |
        Request::HEADER_X_FORWARDED_PROTO |
        Request::HEADER_X_FORWARDED_AWS_ELB;
}