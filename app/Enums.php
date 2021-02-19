<?php

namespace App;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;

class VendorRoles
{
    static $OWNER = 1;
    static $MANAGER = 2;
}

