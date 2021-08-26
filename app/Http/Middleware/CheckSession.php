<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckSession
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        if(!Session::get('sessionFor') || Session::get('sessionFor') != "admin") {
            Session::flush();
            return response()->redirectToRoute('login');
        }

            return $next($request);

    }
}
