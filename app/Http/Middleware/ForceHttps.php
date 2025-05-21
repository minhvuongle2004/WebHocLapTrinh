<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceHttps
{
    public function handle(Request $request, Closure $next)
    {
        // Kiểm tra xem request có từ ngrok không
        $isNgrok = strpos($request->getHost(), 'ngrok') !== false;

        // Ép HTTPS cho ngrok hoặc môi trường không phải local
        if ($isNgrok || env('APP_ENV') !== 'local') {
            // if (!$request->secure() && $request->header('X-Forwarded-Proto') !== 'https') {
            //     // Giữ session và CSRF token khi redirect
            //     return redirect()->secure($request->getRequestUri())->withCookie(cookie('XSRF-TOKEN', $request->session()->token()));
            // }
            \URL::forceScheme('http');
        } else {
            // Ép HTTP cho môi trường local
            \URL::forceScheme('http');
        }

        return $next($request);
    }
}