<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class NotificationEnums
{
    public static $TYPE = [
        "general"=>0,
        "booking"=>1,
        "link"=>2,
    ];


}
