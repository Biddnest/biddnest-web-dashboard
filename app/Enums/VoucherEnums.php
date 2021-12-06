<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Enums;


class VoucherEnums
{

    public static $STATUS = ["active" => 1, "inactive" => 2, "out_of_stock"=>3];
    public static $TYPE = ["predefined" => 0,"generated"=>1];
    public static $PROVIDER = ["amazon" => 0];
    public static $CODE_STATUS = ["open"=>0, "pending_redemption" => 1, "redeemed" => 2, "expired"=>3];

}
