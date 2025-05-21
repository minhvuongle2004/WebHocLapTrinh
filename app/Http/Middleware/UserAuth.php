<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        if (!auth()->check()) {
            // Lưu URL trước đó, nhưng không áp dụng cho route POST
            if (!$request->isMethod('post')) {
                session()->put('url.intended', $request->url());
            }
            return redirect()->route('user.login');
        }
        return $next($request);
    }
}
