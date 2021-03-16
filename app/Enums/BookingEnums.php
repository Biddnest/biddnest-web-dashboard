<?php

namespace App\Enums;
use http\Env\Request;


class BookingEnums{
    public static $STATUS =["enquiry"=>0, "placed"=>1, "bidding"=>2, "rebidding"=>3, "payment"=>4, "pending_user_confirmation"=>5,  "awaiting_pickup"=>6, "in_transit"=>7, "completed"=>8, "cancelled"=>9];

    public static $BOOKING_TYPE=["economic"=>0, "premium"=>1];
}

