<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper;
use App\Models\Review;
use App\Models\Booking;
use App\Enums\ReviewEnums;
use App\Enums\BookingEnums;
use App\Models\ReviewSentiment;
use App\Enums\ReviewSentimentEnum;
use Illuminate\Support\Facades\Artisan;

class ReviewController extends Controller
{
    public static function add($user_id, $public_booking_id, $review, $suggestion)
    {
        $review_exist = Review::where('user_id', $user_id)
                        ->where(['booking_id'=>Booking::where(['public_booking_id'=>$public_booking_id, 'user_id'=>$user_id])
                            ->where(['status'=>BookingEnums::$STATUS['completed']])->pluck('id')[0]])
                        ->first();
        if($review_exist)
            return Helper::response(false, "review already exist");


        if(!$review_exist)
        {
            $reviews = new Review;
            $reviews->user_id =$user_id;
            $reviews->booking_id =Booking::where('public_booking_id', $public_booking_id)->pluck('id')[0];
            $reviews->desc =$suggestion;
            $reviews->ratings =json_encode($review);
            $review_result =$reviews->save();

            if(!$review_result)
                return Helper::response(false, "couldn't add review");

            dispatch(function (){
                Artisan::call("sentiment:analyze review");
            })->afterResponse();

            return Helper::response(true, "Thankyou for reviewing us.", ['review'=>Review::findOrFail($reviews->id)]);

        }




    }
}
