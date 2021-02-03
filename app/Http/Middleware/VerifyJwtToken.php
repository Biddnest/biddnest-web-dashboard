<?php

namespace App\Http\Middleware;

use Closure;
use Firebase\JWT\JWT;
use Illuminate\Http\Request;
use App\Helper;

class VerifyJwtToken
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
//        return response()->json($request->bearerToken());
        if(!$request->bearerToken())
            return response()->json(["status"=>"fail", "message"=>"Authorization headers are missing.","data"=>[]])->setStatusCode(401);

        try {
            if (JWT::decode($request->bearerToken(), config('jwt.secret'),['HS256']))
                return $next($request);
        } catch (\Exception $e) {
            return response()->json(["status"=>"fail", "message"=>"You are not authorized to access this application.","data"=>["error"=>$e->getMessage()]])->setStatusCode(401);
        }

    }
}
