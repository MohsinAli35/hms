<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Symfony\Component\HttpFoundation\Response;

class ExpireProjectMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $expirationDate = env('EXPIRATION_DATE');
        $currentDate = Date::now();

        if ($currentDate->gt($expirationDate)) {
            abort(503, 'Project Expired');
        }

        return $next($request);
        
    }
}
