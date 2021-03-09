<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class MailEnums
{
    public static $STATUS = ["draft"=>0, "scheduled"=>1, "sent"=>2, "canceled"=>3];
}