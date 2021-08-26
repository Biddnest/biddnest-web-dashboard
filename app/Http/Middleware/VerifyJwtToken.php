<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Http\Middleware;

use Closure;
use Exception;
use Firebase\JWT\JWT;
use Illuminate\Foundation\Inspiring;
use Illuminate\Http\Request;

class VerifyJwtToken
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
//        return response()->json($request->bearerToken());
        if(!$request->bearerToken())
            return response()->json(["status"=>"fail", "message"=>"Authorization headers are missing.","data"=>null])->setStatusCode(401);

        try {
            if ($data = JWT::decode($request->bearerToken(), config('jwt.secret'),['HS256'])){

                if($data->iss != config('app.url'))
                    return response()->json(["status"=>"fail", "message"=>"You are not authorized. Better have a quote from us: ".Inspiring::quote(),"data"=>null])->setStatusCode(401);

                if(strpos($request->path(), "vendor") !== false) {
                    if (!isset($data->payload->organization_id))
                        return response()->json(["status" => "fail", "message" => "You are not authorized. Better have a quote from us: " . Inspiring::quote(), "data" => null])->setStatusCode(401);
                } else {
                    if (isset($data->payload->organization_id))
                        return response()->json(["status" => "fail", "message" => "You are not authorized. Better have a quote from us: " . Inspiring::quote(), "data" => null])->setStatusCode(401);
                }
                $request->token_payload = $data->payload;
                return $next($request);
            }
        } catch (Exception $e) {
            return response()->json(["status" => "fail", "message" => "You are not authorized to access this application.", "data" => ["error" => $e->getMessage()]])->setStatusCode(401);
        }

    }
}
