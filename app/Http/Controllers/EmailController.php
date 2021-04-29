<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmailController extends Controller
{
    public static function sendSimpleMailToUser($user_id){}

    public static function sendSimpleMailToVendor($user_id, $subject){

        $user = User::findorFail($user_id);

        Mail::send('emails.reminder', ['user' => $user], function ($m) use ($user, $subject) {
            $m->from('hello@app.com', 'Your Application');

            $m->to($user->email, $user->fname." ".$user->lname)->subject($subject);
        });
    }

    public static function sendWelcomeMailToUser($user_id){}

    public static function sendInvoiceToUser($user_id, $booking_id){
        $user = User::findorFail($user_id);

        $booking = Booking::with("payment")->findorFail($booking_id);

        Mail::send('emails.reminder', ['user' => $user, 'booking'=>$booking], function ($m) use ($user, $booking) {
            $m->to($user->email, $user->fname." ".$user->lname)->subject("Payment received for booking #".$booking->public_booking_id);
        });
    }

    public static function sendPayoutInvoiceToVendor($user_id, $payout_id){}

}
