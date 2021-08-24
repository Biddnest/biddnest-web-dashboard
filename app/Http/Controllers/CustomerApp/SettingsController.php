<?php

namespace App\Http\Controllers\CustomerApp;


use App\Enums\AppEnums;
use App\Enums\NotificationEnums;
use App\Enums\SliderEnum;
use App\Enums\TicketEnums;
use App\Enums\MailEnums;
use App\Enums\VendorEnums;
use App\Enums\CommonEnums;
use App\Enums\ServiceEnums;
use App\Enums\BookingEnums;
use App\Enums\BidEnums;
use App\Enums\FaqEnums;
use App\Enums\ReviewEnums;
use App\Models\Settings;
use App\Helper;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public static function getSettings(){
        return Helper::response(true, "Here are the settings.",[
            "config"=>[
                "service_live"=> true,
                "message"=>"We are live.",
                "api"=>[
                    "name"=>"Biddnest",
                    "logo"=>env("APP_URL","https://uat-dashboard-biddnest.dev.diginnovators.com")."/static/images/favicon.svg",
                    "base_url"=> env("APP_URL"),
                    "socket_server_url"=> (env('SECURE_SOCKET') ? "https://" : "http://") . env("APP_IP").":".env('DEFAULT_SOCKET_SERVER_PORT'),
                    "version"=>"v1",
                    "environment"=>env("APP_DEBUG") ? "staging" : "production"
                ],
                "app"=>[
                    "version_code"=>(int)Settings::where("key", "app_version_code")->pluck('value')[0],
                    "version"=>Settings::where("key", "app_version")->pluck('value')[0],
                ]
            ],
            "keys"=>[
//                "google_api_key"=>base64_encode(Settings::where("key", "google_api_key")->pluck('value')[0]),
                "cancellation_reason_options"=>json_decode(Settings::where("key", "cancellation_reason_options")->pluck('value')[0], true)
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
                    "type"=>array_slice(TicketEnums::$TYPE, 0,4),
                    "status"=>TicketEnums::$STATUS
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
                    "booking_type"=>BookingEnums::$BOOKING_TYPE,
                    "fetch_type"=>BookingEnums::$BOOKING_FETCH_TYPE,
                    "color"=>BookingEnums::$COLOR_CODE
                ],
                "bid"=>[
                    "status"=>BidEnums::$STATUS
                ],
                "payment"=>[
                    'razorpay'=>[
                        "rzp_id"=>base64_encode(Settings::where("key", "razor_key")->pluck('value')[0]),
                        "rzp_secret"=>base64_encode(Settings::where("key", "razor_secret")->pluck('value')[0])
                    ]
                ],
                "faq"=>[
                    "category"=>FaqEnums::$CATEGORY_POOL
                ],
                "review"=>[
                    "question"=>ReviewEnums::$QUESTIONS
                ],
                "notification"=>[
                    "type"=>NotificationEnums::$TYPE
                ]
            ],
            "contact_us"=>[
                "details"=>Settings::where("key", "contact_details")->pluck('value')[0]
            ],
            "onesignal"=>[
                "user_app_creds"=>base64_encode(Settings::where("key", "onesignal_user_app_creds")->pluck('value')[0])
            ],
            "timer"=>[
                "bid_time"=>Settings::where("key", "bid_time")->pluck('value')[0] * 60,
                "rebid_time"=>Settings::where("key", "rebid_time")->pluck('value')[0] * 60
            ]
        ]);
    }
}
