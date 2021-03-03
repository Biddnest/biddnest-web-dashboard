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
    public static $ROLES = ["admin"=>1, "manager"=>2];
    public static $STATUS = ["active"=>1, "suspended"=>2];
}