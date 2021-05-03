<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class redirectToDashboard
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

        if(Session::get('sessionFor') != "admin")
            return response()->redirectToRoute('dashboard');
        else if(Session::get('sessionFor') != "vendor")
            return response()->redirectToRoute('vendor.dashboard');


        return $next($request);
    }
}
