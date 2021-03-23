<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */
namespace App\Enums;
class CouponEnums{
    public static $COUPON_TYPE = ["discount"=>1];
    public static $DISCOUNT_TYPE = ["fixed"=>0,"percentage"=>1];
    public static $ZONE_SCOPE = ["all"=>0,"custom"=>1];
    public static $ORGANIZATION_SCOPE = ["all"=>0,"custom"=>1];
    public static $SCOPE = ["all"=>0,"custom"=>1];
    public static $DEDUCTION_SOURCE = ["admin"=>0,"vendor"=>1];
    public static $USER_SCOPE = ["all"=>0,"custom"=>1];
    public static $STATUS = ["active"=>0,"inactive"=>1, "expired"=>2];

}


