<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ContactCors
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
        return $next($request)
            ->header('Access-Control-Allow-Origin', config('cors.allowed_origins'))
            ->header('Access-Control-Allow-Methods', 'GET, POST')
            ->header('Access-Control-Allow-Headers', ['X-Requested-With', 'Content-Type', 'Origin', 'Cache-Control', 'Authorization', 'Accept', 'Accept-Encoding']);
    }
}
