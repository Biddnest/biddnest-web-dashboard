<?php

namespace App\Http\Controllers;

use App\Enums\BookingEnums;
use App\Helper;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Support\Facades\Artisan;

class ReviewController extends Controller
{
    public static function add($user_id, $public_booking_id, $review, $suggestion)
    {
        $review_exist = Review::where('user_id', $user_id)
                        ->where(['booking_id'=>Booking::where(['public_booking_id'=>$public_booking_id, 'user_id'=>$user_id])->where(['status'=>BookingEnums::$STATUS['completed']])->pluck('id')[0]])
                        ->first();
        if($review_exist)
            return Helper::response(false, "review already exist");
            
        // return $review;

        $ratings =0;

        foreach($review as $key=>$rating){
            $ratings =$ratings + $rating['rating'];
        }
      
        if(!$review_exist)
        {
            $reviews = new Review;
            $reviews->user_id =$user_id;
            $reviews->booking_id =Booking::where('public_booking_id', $public_booking_id)->pluck('id')[0];
            $reviews->desc =$suggestion;
            $reviews->ratings =json_encode($review);
            $reviews->star =round($ratings/3);
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
