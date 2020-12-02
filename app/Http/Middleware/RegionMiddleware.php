<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RegionMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if( $request->query('region') ) {
            return redirect($request->url())->withCookie(cookie()->forever('region', $request->query('region')));
        }

        return $next($request);
    }
}
