<?php

namespace App\Http\Controllers;

use App\Enums\AdminEnums;
use App\Helper;
use App\Models\Booking;
use App\Models\Organization;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public static function adminSearch($query, $role){

        $search_result = ["bookings"=>[],"users"=>[], "organizations"=>[],"inventories"=>[],"services"=>[],"subservices"=>[]];
        if(sizeof($query) < 3)
            return Helper::response(true, "Please type atleast 3 letters", ["results"=>$search_result]);

        switch($role){
            case AdminEnums::$ROLES['admin']:
            $search_result['bookings'] = Booking::whereLike("public_booking_id", "$query%")->paginate(3);
            $search_result['users'] = User::whereLike("fname", "$query%")
                ->orWhereLike("lname", "$query%")
                ->orWhereLike("email", "$query%")
                ->orWhereLike("phone", "$query%")
                ->paginate(5);
            $search_result['organizations'] = Organization::whereLike("org_name", "$query%")
                ->with('vendor')
                ->paginate(3);

            $search_result['inventories'] = Organization::whereLike("name", "$query%")
                ->paginate(3);

            $search_result['services'] = Organization::whereLike("name", "$query%")
                ->paginate(3);

            $search_result['subservices'] = Organization::whereLike("name", "$query%")
                ->paginate(3);
            break;

            case AdminEnums::$ROLES['zone_admin']:
            $search_result['bookings'] = Booking::whereIn("zone_id",Session::get('admin_zones'))->whereLike("public_booking_id", "$query%")->paginate(3);
            $search_result['users'] = User::whereLike("fname", "$query%")
                ->orWhereLike("lname", "$query%")
                ->orWhereLike("email", "$query%")
                ->orWhereLike("phone", "$query%")
                ->paginate(5);
            $search_result['organizations'] = Organization::whereIn("zone_id",Session::get('admin_zones'))
                ->whereLike("org_name", "$query%")
                ->paginate(3);

            $search_result['inventories'] = Organization::whereLike("name", "$query%")
                ->paginate(3);

            $search_result['services'] = Organization::whereLike("name", "$query%")
                ->paginate(3);

            $search_result['subservices'] = Organization::whereLike("name", "$query%")
                ->paginate(3);
            break;
            default:
                return Helper::response(true, "Here are the results", ["results"=>$search_result]);
        }

                return Helper::response(true, "Here are the results", ["results"=>$search_result]);


    }
}
