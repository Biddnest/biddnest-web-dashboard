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
}