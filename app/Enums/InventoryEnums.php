<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class InventoryEnums{
    public static $SIZE = ["small"=>1, "medium"=>2, "large"=>3];

    public static $CATEGORY = ["electronics", "furniture", "appliances", "electrical", "automobile", "others"];
}
