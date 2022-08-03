<?php

namespace App\Http\Middleware;

use Closure;

class userMiddleware
{
    public function handle($request, Closure $next)
    {
        if (auth()->user()->tokenCan('role:user')) {
            return $next($request);
        }

        return response()->json('Not Authorized', 401);
    }
}
