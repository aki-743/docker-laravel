<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ApiCors
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
        // APIリクエストはCORS対策を行う
        if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
            // OPTIONSの場合もヘッダーを追加する
            return $next($request)
                ->header('Access-Control-Allow-Origin', config('cors.allowed_origins'))
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', ['X-Requested-With', 'Content-Type', 'Origin', 'Cache-Control', 'Authorization', 'Accept', 'Accept-Encoding'])
                ->header('Access-Control-Allow-Credentials', true);
        } else {
            return $next($request)
                ->header('Access-Control-Allow-Origin', config('cors.allowed_origins'))
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Headers', ['X-Requested-With', 'Content-Type', 'Origin', 'Cache-Control', 'Authorization', 'Accept', 'Accept-Encoding']);
        }
    }
}
