<?php

namespace App\Enums;
use http\Env\Request;


class BookingEnums{
    public static $STATUS =["enquiry"=>0, "placed"=>1, "biding"=>2, "rebiding"=>3, "payment_pending"=>4, "pending_driver_assign"=>5, "awaiting_pickup"=>6, "in_transit"=>7, "completed"=>8, "cancelled"=>9, "bounced"=>10, "hold"=>11];

    public static $COLOR_CODE =["enquiry"=>"#FF5722", "placed"=>"#FF5722", "biding"=>"#FF5722", "rebiding"=>"#FF5722", "payment_pending"=>"#FF5722", "pending_driver_assign"=>"#FF5722", "awaiting_pickup"=>"#FF5722", "in_transit"=>"#FF5722", "completed"=>"#008000", "cancelled"=>"#FF0000"];

    public static $BOOKING_TYPE=["economic"=>0, "premium"=>1];

    public static $CREATED_THROUGH_CHANNEL=["app"=>0, "web"=>1, "support"=>2];

    public static $BOOKING_FETCH_TYPE=["live","scheduled","bookmarked","participated"];
}

