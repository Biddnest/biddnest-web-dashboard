<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class OrganizationEnums
{
    public static $SERVICES = ["economic"=>0, "premium"=>1, "both"=>2];
    public static $STATUS = ["lead"=>0, "active"=>1, "suspended"=>2, "pending_approval"=>3];
}
