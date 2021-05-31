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
    public static $CATEGORY_POOL = [["name"=>"Delivery", "value"=>"delivery","image"=>"https://dashboard-biddnest.dev.diginnovators.com/storage/misc/delivery.svg"],
                                    ["name"=>"Packaging", "value"=>"packaging","image"=>"https://dashboard-biddnest.dev.diginnovators.com/storage/misc/packaging.svg"],
                                    ["name"=>"Vendor", "value"=>"organization","image"=>"https://dashboard-biddnest.dev.diginnovators.com/storage/misc/vendor.svg"],
                                    ["name"=>"Bidding", "value"=>"bidding","image"=>"https://dashboard-biddnest.dev.diginnovators.com/storage/misc/bidding.svg"],
                                    ["name"=>"Safety", "value"=>"safety","image"=>"https://dashboard-biddnest.dev.diginnovators.com/storage/misc/safety.svg"],
                                    ["name"=>"Payment", "value"=>"payment","image"=>"https://dashboard-biddnest.dev.diginnovators.com/storage/misc/pricing.svg"],
                                    ];

    public static $TYPE = ["delivery", "packaging", "organization", "bidding", "safety", "payment"];
}
