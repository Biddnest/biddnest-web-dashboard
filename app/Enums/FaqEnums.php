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
    public static $CATEGORY_POOL = [["name"=>"Delivery", "value"=>"delivery","image"=>"https://via.placeholder.com/48x48.png"],
                                    ["name"=>"Packaging", "value"=>"packaging","image"=>"https://via.placeholder.com/48x48.png"],
                                    ["name"=>"Vendor", "value"=>"organization","image"=>"https://via.placeholder.com/48x48.png"],
                                    ["name"=>"Bidding", "value"=>"bidding","image"=>"https://via.placeholder.com/48x48.png"],
                                    ["name"=>"Safety", "value"=>"safety","image"=>"https://via.placeholder.com/48x48.png"],
                                    ["name"=>"Payment", "value"=>"payment","image"=>"https://via.placeholder.com/48x48.png"],
                                    ];

    public static $TYPE = ["delivery", "packaging", "organization", "bidding", "safety", "payment"];
}
