<?php

namespace App\Enums;
use http\Env\Request;


class BidEnums{
    public static $STATUS =["active"=>0, "bid_submitted"=>1, "rejected"=>2, "won"=>3, "lost"=>4, "expired"=>5];

    public static $BID_TYPE=["bid"=>0, "rebid"=>1];
}