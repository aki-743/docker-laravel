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
        // すべてのレスポンスに CORS 用のヘッダーを追加する必要はないので URL から判断する
        $paths = explode('/', $request->getPathInfo());
        if ($paths[1] === 'api') {
            $origin_URL = config('cors.allowed_origins');
            if ($paths[2] === 'firebase') {
                $origin_URL = config('app.FIREBASE_FUNCTIONS_ORIGIN_URL');
            }
            if($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
                return $next($request)
                    ->header('Access-Control-Allow-Origin', $origin_URL)
                    ->header('Cache-Control', 'public')
                    ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                    ->header('Access-Control-Allow-Headers', 'X-XSRF-TOKEN, Authorization, content-type, Transfer-Encoding, Accept, Accept-Encoding, Accept-Language')
                    ->header('Access-Control-Allow-Credentials', 'true')
                    ->header('Status', '204');
            };
            return $next($request)
                ->header('Access-Control-Allow-Origin', $origin_URL)
                ->header('Cache-Control', 'public')
                ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, OPTIONS')
                ->header('Access-Control-Allow-Credentials', 'true')
                ->header('Access-Control-Allow-Headers', 'X-XSRF-TOKEN, Authorization, content-type, Transfer-Encoding, Accept, Accept-Encoding, Accept-Language')
                ->header('Access-Control-Expose-Headers', 'Authorization');
        }
        return $next($request);
    }
}
