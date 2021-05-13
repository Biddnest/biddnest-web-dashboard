<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Enums;


class PayoutEnums{
    public static $STATUS = ["scheduled" => 0, "processing" => 1, "transferred" => 2, "suspended" => 3, "cancelled" => 4, "temporary_hold"=>5,"queued"=>6];

}
