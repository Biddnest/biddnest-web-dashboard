<?php

namespace App\Http\Controllers;

use App\Enums\BidEnums;
use App\Mail\InvoiceMail;
use App\Models\Booking;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{
    public static function invoice_email($booking_id) {
       $details = Booking::where('public_booking_id', $booking_id)->with('payment')->with(['bid'=>function($query){
            $query->where('status', BidEnums::$STATUS['won']);
        }])->first();

        $email= json_decode($details->contact_details, true)['email'];

        $send = Mail::to($email)->send(new InvoiceMail($details));

    }
}
