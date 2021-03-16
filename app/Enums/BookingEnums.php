<?php

namespace App\Enums;
use http\Env\Request;


class BookingEnums{
    public static $STATUS =["enquiry"=>0, "placed"=>1, "bidding"=>2, "rebidding"=>3, "payment"=>4,  "awaiting_pickup"=>5, "in_transit"=>6, "completed"=>7, "cancelled"=>8];

    public static $BOOKING_TYPE=["economic"=>0, "premium"=>1];
}

