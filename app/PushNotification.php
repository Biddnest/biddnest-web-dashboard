<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App;
use GuzzleHttp\Client;

class PushNotification
{
    private static $user_app_creds = ["6b33862a-ec91-44bd-bf29-1c8ae35317d1", "MjlhNjhlZWQtNzE3ZS00YjNjLTg5NzQtOTY0ZDIxYjg1ZDIy"];
    private static $vendor_app_creds = ["42d0f367-a40c-41e2-a9e3-95d62e38ad99", "NTkyMTU3ODUtMWM3OS00N2YyLTgzMWItOTZhMjNlY2E4ODFk"];

    public static function sendToUsers($user_type = "user", $title, $desc, $players, $data, $url=null){

        if(count($players)<1)
            return Helper::response(false, "No players registered yet.");

        switch($user_type){
            case "user":
                $credentials =self::$user_app_creds;
                break;
            case "vendor":
                $credentials = self::$vendor_app_creds;
                break;

            default:
                return false;
                break;
        }

        $client = new Client(['base_uri' => 'https://onesignal.com/api/v1/','headers' => [
            'Authorization'=> 'Basic '.$credentials[0],
            'Content-Type' => 'application/json'
        ]]);

//        return $players;
        $response = $client->request('POST', 'notifications', [
            'auth'=>[$credentials[0],$credentials[1]],
            'json' => [
                'app_id'=>$credentials[0],
                'contents' => [
                    'en' => $title
                ],
                'heading' => [
                    'en' => $title
                ],
                'subtitle' => [
                    'en' => $desc
                ],
                "data" => $data,
                'url' => $url,
                'include_player_ids' => $players,
                'android_channel_id' => "d3e26d45-acec-4baf-99e9-e3e2bd38d06c",
//                'include_external_user_ids'=>$players
            ],
        ]);

        return Helper::response(true,"Push sent",["response"=>$response]);

    }



}
