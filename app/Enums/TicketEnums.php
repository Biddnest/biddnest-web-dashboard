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
    public static $TYPE = ["complaint"=>0, "service_request"=>1, "order_cancellation"=>2, "order_reschedule"=>3];

    /*
        booking.id
        user.name
        vendor.name
    */
    public static $TEMPLATES = ["order_reschedule"=>["title_template"=>"Request for order reschedule {{booking.id}}{{user.name}}", "body_template"=>"I want like to reshedule my  urrent order"],
                                "order_cancellation"=>["title_template"=>"Request for order cancel {{booking.id}}{{user.name}}", "body_template"=>"I want like to cancel my  urrent order"]];
}
