<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class VendorEnums
{
    public static $ROLES = ["admin"=>1, "manager"=>2, "driver"=>3];
    public static $STATUS = ["inactive"=>0, "active"=>1, "suspended"=>2, "lead"=>3];
    public static $VERIFICATION = ['pending'=>0, "approved"=>1, "rejected"=>2, "incomplete"=>3];
}
