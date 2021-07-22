<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;

class AppEnums{
    public static $GENDER = [
        ["label"=>"Male", "value"=>"male"],
        ["label"=>"Female", "value"=>"female"],
        ["label"=>"3rd Gender", "value"=>"3rd gender"],
    ];
    public static $STATES = [];
}

