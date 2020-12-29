<?php

namespace App\Http\Middleware;

use App\Models\Region;
use Closure;
use Illuminate\Http\Request;

class RegionMiddleware
{

    public function handle(Request $request, Closure $next)
    {
//        if ($cookie = $request->cookie('region')) {
//            dd($cookie);
//        }
        if($slug = $request->query('region')) {
            $region = Region::whereSlug($slug)->first();
            if ($region) {
                return redirect($request->url())->withCookie(cookie()->forever('region', $region->slug));
            }
        }

        return $next($request);
    }
}
