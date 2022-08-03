<?php

namespace App\Http\Middleware;

use Closure;

class barberMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:barber')) {
            return $next($request);
        }

        return response()->json('Not Authorized', 401);
    }
}
