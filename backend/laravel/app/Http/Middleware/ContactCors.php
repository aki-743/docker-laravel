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
        // $originURL =  (empty($_SERVER['HTTPS']) ? 'http://' : 'https://') . $_SERVER['HTTP_HOST'];
        // // 基本的にはWebではCORSを許可しない
        // return $next($request)
        //     ->header('Access-Control-Allow-Origin', $originURL)
        //     ->header('Access-Control-Allow-Methods', null)
        //     ->header('Access-Control-Allow-Headers', 'Authorization, X-Requested-With, Origin, Contet-Type, Authorization, Accept, Accept-Encoding')
        //     ->header('Access-Control-Allow-Credentials', false);
    }
}
