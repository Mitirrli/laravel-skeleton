<?php

namespace App\Http\Middleware;

use Closure;

class UniteReturn
{
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        return $response;
    }
}
