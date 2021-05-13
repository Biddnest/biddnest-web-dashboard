<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;

class CommonEnums{
    public static $YES = 1;
    public static $NO = 0;

    public static $PAGE_LENGTH = 15;

    public static $TICKE_STATUS=["open"=>0, "aprove"=>1, "modify"=>2];
}
