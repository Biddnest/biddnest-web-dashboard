<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Mail;

class MailController extends Controller
{
    public static function invoice_email() {
        $data = array('name'=>"abc");
        Mail::send(['text'=>'mail'], $data, function($message) {
            $message->to('dhanashree.mane@diginnovators.com', "hello, abc")->subject("Invoice of you order #123");
            $message->from("bidnest@diginnovators.com", "abc");
        });

        echo "success";
    }
}
