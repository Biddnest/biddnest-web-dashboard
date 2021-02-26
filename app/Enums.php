<?php

namespace App;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;

class VendorEnums
{
    public static $ROLES = ["admin"=>1, "manager"=>2];
    public static $STATUS = ["active"=>1, "suspended"=>2];
}

class AdminEnums{
    public static $ROLES = ["admin"=>1, "zone_admin"=>2, "marketing"=>3];
    public static $STATUS = ["active"=>1, "suspended"=>2];
}

class CommonEnums{
    public static $YES = 1;
    public static $NO = 0;
}

