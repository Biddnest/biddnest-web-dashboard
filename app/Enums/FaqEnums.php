<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class FaqEnums
{
    public static $CATEGORY_POOL = [["name"=>"Delivery", "value"=>"delivery","image"=>""],
                                    ["name"=>"Packaging", "value"=>"packaging","image"=>""],
                                    ["name"=>"Vendor", "value"=>"organization","image"=>""],
                                    ["name"=>"Bidding", "value"=>"bidding","image"=>""],
                                    ["name"=>"How It works", "value"=>"bidding","image"=>""],
                                    ["name"=>"Payment", "value"=>"payment","image"=>""],
                                    ];
}
