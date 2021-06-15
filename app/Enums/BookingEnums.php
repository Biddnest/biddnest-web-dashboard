<?php

namespace App\Enums;


class BookingEnums{

    public static $STATUS =["enquiry"=>0, "placed"=>1, "biding"=>2, "rebiding"=>3, "payment_pending"=>4, "pending_driver_assign"=>5, "awaiting_pickup"=>6, "in_transit"=>7, "completed"=>8, "cancelled"=>9, "bounced"=>10, "hold"=>11];

    public static $COLOR_CODE =["enquiry"=>"#E5F6FC", "placed"=>"#FF5722", "biding"=>"#FEF6E0", "rebiding"=>"#FF5722", "payment_pending"=>"#FF5722", "pending_driver_assign"=>"#FF5722", "awaiting_pickup"=>"#DDF6E9", "in_transit"=>"#FFF1E3", "completed"=>"#A3E7C5", "cancelled"=>"#FDC5C5", "bounced"=>"#FFEFEF"];

    public static $BOOKING_TYPE=["economic"=>0, "premium"=>1];

    public static $CREATED_THROUGH_CHANNEL=["app"=>0, "web"=>1, "support"=>2];

    public static $BOOKING_FETCH_TYPE=["live","scheduled","bookmarked","participated"];
}

