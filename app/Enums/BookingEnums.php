<?php

namespace App\Enums;
use http\Env\Request;


class BookingEnums{
    public static $STATUS =["enquiry"=>0, "placed"=>1, "biding"=>2, "rebiding"=>3, "payment_pending"=>4, "awaiting_pickup"=>5, "driver_assign"=>6, "in_transit"=>7, "completed"=>8, "cancelled"=>9];


    public static $BOOKING_TYPE=["economic"=>0, "premium"=>1];

    public static $BOOKING_FETCH_TYPE=["live","scheduled","bookmarked"];
}

