<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class TicketEnums
{
    public static $TYPE = ["complaint"=>0, "service_request"=>1, "order_cancellation"=>2, "order_reschedule"=>3, "call_back"=>4, "new_branch"=>5, "price_update"=>6];
    public static $STATUS = ["open"=>0, "rejected"=>1, "resolved"=>2, "closed"=>3];
    /*
        booking.id
        user.name
        vendor.name
    */
    public static $TEMPLATES = ["order_reschedule"=>["title_template"=>"Request for order reschedule {{booking.id}}{{user.name}}", "body_template"=>"I want like to reshedule my current order"],
                                "order_cancellation"=>["title_template"=>"Request for order cancel {{booking.id}}{{user.name}}", "body_template"=>"I want like to cancel my current order"],
                                "call_back"=>["title_template"=>"Request for call back", "body_template"=>"I would like to talk to Executive"]];
}
