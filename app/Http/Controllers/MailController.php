<?php

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Mail\InvoiceMail;
use App\Mail\EmailDemo;
use App\Models\Booking;
use Illuminate\Http\Request;

use Mail;
use Monolog\Logger;

class MailController extends Controller
{
    public static function invoice_email($booking_id) {
        $details = Booking::where('public_booking_id', $booking_id)->with('payment')->with(['bid'=>function($query){
            $query->where('status', BidEnums::$STATUS['won']);
        }])->first();

        Logger:info("Details :", (array)$details);

        $send = Mail::to(json_decode($details->contact_details, true)['email'])->send(new EmailDemo($details));

//        Logger:info("Mail response:", (array)$send);

        if($send)
            return Helper::response(true, "success");
        else
            return Helper::response(false, "fail");
    }
}
