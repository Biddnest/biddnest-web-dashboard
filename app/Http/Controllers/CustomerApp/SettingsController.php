<?php

namespace App\Http\Controllers\CustomerApp;


use App\Enums\AppEnums;
use App\Enums\SliderEnums;
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
                "gender"=>AppEnums::$GENDER,
                "slider"=>[
                    "zone"=>SliderEnums::$ZONE,
                    "position"=>SliderEnums::$POSITION,
                    "size"=>SliderEnums::$SIZE,
                    "banner_dimensions"=>SliderEnums::$BANNER_DIMENSIONS,
                    "platform"=>SliderEnums::$PLATFORM
                ],
                "admin"=>[
                    "roles"=>AdminEnums::$ROLES,
                    "verifide"=>AdminEnums::$VERIFIDE
                ],
                "mail"=>[
                    "status"=>MailEnums::$STATUS
                ],
                "ticket"=>[
                    "type"=>TicketEnums::$TYPE
                ],
                "vendor"=>[
                    "roles"=>VendorEnums::$ROLES,
                    "status"=>VendorEnums::$STATUS
                ]
            ]
        ]);
    }
}
