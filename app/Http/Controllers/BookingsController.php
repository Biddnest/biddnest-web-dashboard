<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\Request;
use App\Models\Bookings;
use App\Models\Organization;
use App\Models\User;
use App\Helper;
use App\Sms;
use Intervention\Image\ImageManager;
use App\Enums\CommonEnums;

class BookingsController extends Controller
{
    public static function get()  
    {
        $result=Bookings::where(['status'=> CommonEnums::$YES, 'deleted'=>CommonEnums::$NO])->with("user")->with("Organization")->get();

        if(!$result)
            return Helper::response(false,"Couldn't fetche data");
        else
            return Helper::response(true,"Data fetched successfully", $result);
    }

    public static function add($data)
    {
        
    }
}
