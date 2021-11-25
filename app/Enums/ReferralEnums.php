<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Enums;


class ReferralEnums
{

    public static $STATUS = ["active" => 0, "inactive" => 1, "out_of_stock"=>2];
    public static $TRIGGER = ["signup" => 0, "payment_completion"=>1, "booking_completion"=>2];
    public static $TYPE = ["points" => 0,"voucher"=>1];

}
