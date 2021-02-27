<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HttpsProtocol
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
        if (empty($_SERVER['HTTPS']) && env('APP_ENV') === 'production') {
            if ($_SERVER["HTTP_X_FORWARDED_PROTO"] != 'https') {
                return redirect()->secure($request->getRequestUri());
            }
        }
        return $next($request);
    }
}
