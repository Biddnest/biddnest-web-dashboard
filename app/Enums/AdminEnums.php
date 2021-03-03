<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class AdminEnums{
    public static $ROLES = ["admin"=>1, "zone_admin"=>2, "marketing"=>3];
    public static $STATUS = ["active"=>1, "suspended"=>2];
}