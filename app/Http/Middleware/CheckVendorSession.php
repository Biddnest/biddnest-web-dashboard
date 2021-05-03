<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckVendorSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if(!Session::get('sessionFor') || Session::get('sessionFor') != "vendor") {
            Session::flush();
            return response()->redirectToRoute('vendor.login');
        }

        return $next($request);
    }
}
