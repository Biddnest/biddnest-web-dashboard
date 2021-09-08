<?php

namespace App\Enums;


class BookingEnums{

    public static $STATUS =["enquiry"=>0, "placed"=>1, "biding"=>2, "rebiding"=>3, "payment_pending"=>4, "pending_driver_assign"=>5, "awaiting_pickup"=>6, "in_transit"=>7, "completed"=>8, "cancelled"=>9, "bounced"=>10, "hold"=>11, "cancelrequest"=>12,"in_progress"=>13];

    public static $COLOR_CODE =["enquiry"=>"#3c69a5", "placed"=>"#e6c32d", "biding"=>"#ff8f30", "rebiding"=>"#e27214", "payment_pending"=>"#ff741e", "pending_driver_assign"=>"#ffaa22", "awaiting_pickup"=>"#238150", "in_transit"=>"#238150", "completed"=>"#3d7c5d", "cancelled"=>"#ce3131", "bounced"=>"#ce3131", "cancelrequest"=>"#ce3131",];

    public static $BOOKING_TYPE=["economic"=>0, "premium"=>1];

    public static $CREATED_THROUGH_CHANNEL=["app"=>0, "web"=>1, "support"=>2];

    public static $BOOKING_FETCH_TYPE=["live","scheduled","bookmarked","participated"];
}

