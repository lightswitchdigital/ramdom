<?php

namespace App\Http\Middleware;

use App\Models\Region;
use Closure;
use Illuminate\Http\Request;

class RegionMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        if($slug = $request->query('region') ) {
            $region = Region::whereSlug($slug)->first();
            if ($region) {
                return redirect($request->url())->withCookie(cookie()->forever('region', $request->query('region')));
            }
        }

        return $next($request);
    }
}
