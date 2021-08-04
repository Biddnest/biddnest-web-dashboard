<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class SliderEnum
{
    public static $ZONE = ["all"=>1, "custom"=>2];
    public static $STATUS = ["active"=>1, "suspended"=>2];

    public static $POSITION = ["main"=>1, "secondary"=>2];
    public static $SIZE = ["wide"=>1, "square"=>2, "web"=>3];

    public static $BANNER_DIMENSIONS = [
        "wide"=>[376,180],
        "square"=>[256,256],
        "web"=>[1280, 580],
        "tab"=>[1366, 768]
        ];

    public static $PLATFORM = ["app"=>0, "web"=>1, "tab"=>2];

    public static $TYPE = ["promo"=>0,"info"=>1];

}
