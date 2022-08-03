<?php

namespace App\Http\Middleware;

use Closure;

class adminMiddleware
{

    public function handle($request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:admin')) {
            return $next($request);
        }

        return response()->json('Not Authorized', 401);
    }
}
