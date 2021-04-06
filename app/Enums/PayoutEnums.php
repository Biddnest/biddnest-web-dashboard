<?php
/*
 * Copyright (c) 2021. This Project was built and maintained by Diginnovators Private Limited.
 */

namespace App\Enums;
use http\Env\Request;


class PayoutEnums{
    public static $STATUS =["scheduled"=>0, "processing"=>1, "transferred"=>2, "suspended"=>3, "canceled"=>4];

}
