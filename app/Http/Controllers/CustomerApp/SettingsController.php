<?php

namespace App\Http\Controllers\CustomerApp;


use App\Enums\AppEnums;
use App\Enums\SliderEnum;
use App\Enums\TicketEnums;
use App\Enums\MailEnums;
use App\Enums\VendorEnums;
use App\Enums\CommonEnums;
use App\Enums\ServiceEnums;
use App\Enums\BookingEnums;
use App\Models\Settings;
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
            "keys"=>[
                "google_api_key"=>Settings::where("key", "google_api_key")->pluck('value')[0],
                "cancellation_reason_options"=>Settings::where("key", "cancellation_reason_options")->pluck('value')[0]
            ],
            "enums"=>[
                "gender"=>AppEnums::$GENDER,
                "slider"=>[
                    "zone"=>SliderEnum::$ZONE,
                    "position"=>SliderEnum::$POSITION,
                    "size"=>SliderEnum::$SIZE,
                    "banner_dimensions"=>SliderEnum::$BANNER_DIMENSIONS
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
                ],
                "common"=>[
                    "yes"=>CommonEnums::$YES,
                    "no"=>CommonEnums::$NO
                ],
                "service"=>[
                    "inventory_quantity_type"=>ServiceEnums::$INVENTORY_QUANTITY_TYPE
                ],
                "booking"=>[
                    "status"=>BookingEnums::$STATUS,
                    "booking_type"=>BookingEnums::$BOOKING_TYPE
                ]
            ]
        ]);
    }
}
