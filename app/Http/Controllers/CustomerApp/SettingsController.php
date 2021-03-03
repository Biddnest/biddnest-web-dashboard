<?php

namespace App\Http\Controllers\CustomerApp;


use App\Enums;
use App\AppEnums as Enums;
use App\Helper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public static function getSettings(){
        return Helper::response(true, "Here are the settings.",[
            "config"=>[
                "service_live"=> true,
                "message"=>null,
              "api"=>[
                  "base_url"=>"https://dashboard-biddnest.dev.diginnovators.com",
                  "version"=>"v1",
                  "environment"=>"staging"
              ],
               "app"=>[
                   "version_code"=>1,
                   "version"=> "1.0.0",
               ]
            ],
            "enums"=>[
                "gender"=>Enums::$GENDER
            ]
        ]);
    }
}
