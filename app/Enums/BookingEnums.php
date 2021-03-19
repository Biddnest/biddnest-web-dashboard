<?php

namespace App\Enums;
use http\Env\Request;


class BookingEnums{
    public static $STATUS =["enquiry"=>0, "placed"=>1, "biding"=>2, "rebiding"=>3, "payment_pending"=>4,  "awaiting_pickup"=>5, "in_transit"=>6, "completed"=>7, "cancelled"=>8];


    public static $BOOKING_TYPE=["economic"=>0, "premium"=>1];
}

