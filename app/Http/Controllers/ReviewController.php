<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper;
use App\Models\Review;
use App\Models\Booking;
use App\Enums\ReviewEnums;

class ReviewController extends Controller
{
    public static function add($user_id, $public_booking_id, $ratings, $suggestion)
    {
        $review_exist = Review::where('user_id', $user_id)
                        ->where(['booking_id'=>Booking::where('public_booking_id', $public_booking_id)->pluck('id')[0]])->first();

        $rateings =[];
        foreach($ratings as $rateing)
        {
            $rateings[]= $rateing;
        }

        if(!$review_exist)
        {
            $review = new Review;
            $review->user_id =$user_id;
            $review->booking_id =Booking::where('public_booking_id', $public_booking_id)->pluck('id')[0];
            $review->desc =$suggestion;
            $review->ratings =json_encode($rateings);
            $review_result =$review->save();
        }
        else
        {
            $review_result = Review::where('user_id', $user_id)
                            ->where(['booking_id'=>Booking::where('public_booking_id', $public_booking_id)->pluck('id')[0]])
                            ->update([
                                'desc'=>$suggestion,
                                'ratings'=>json_encode($rateings)
                            ]);
        }

        if(!$review_result)
            return Helper::responce(false, "couldn't add review");
        
        return Helper::responce(true, "Review added successfully");
    }
}
