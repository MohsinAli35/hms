<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class MainMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // allow admin and tokenist to access admin panel
        // admin role = 1
        // tokinest  role = 2
        if(Auth::check() && auth()->user()->role == 1 || auth()->user()->role == 2){
            return $next($request);
        }
        return redirect()->back();
    }
}
