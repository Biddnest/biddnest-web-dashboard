<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class SliderEnums
{
    public static $ZONE = ["universal"=>1, "zone"=>2];
    public static $STATUS = ["active"=>1, "suspended"=>2];

    public static $POSITION = ["main"=>1, "secondary"=>2];
    public static $SIZE = ["wide"=>1, "square"=>2];

    public static $BANNER_DIMENSIONS = [
        "wide"=>[328,118],
        "square"=>[186,270]
        ];
}
