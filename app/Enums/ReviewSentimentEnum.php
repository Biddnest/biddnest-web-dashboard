<?php

namespace App\Enums;
use Carbon\CarbonImmutable;
use Faker\Provider\File;
use \Firebase\JWT\JWT;
use http\Env\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Fabito\AvatarGenerator\Avatar;


class ReviewSentimentEnum
{
    public static $REVIEW_SUMMARY = ['neg' => "Negative 👎", 'neu' => "Neutral 🙂", 'pos' =>  "Positive 😃", 'compound' => "Compond 😐"];
}
