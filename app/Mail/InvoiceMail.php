<?php

namespace App\Mail;

use App\Enums\BidEnums;
use App\Models\Booking;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Mail;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    private $order_details;
    public function __construct($details)
    {
        $this->order_details=$details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $data = array('name'=>json_decode($this->order_details->contact_details, true)['name']);
         /*Mail::send(['text'=>'mail'], $data, function($message){*/
//            $this->to(json_decode($this->order_details->contact_details, true)['email'], json_decode($this->order_details->contact_details, true)['name']);
          return  $this->from("dinesh.jain@diginnovators.com", "Biddnest")
                ->markdown('mail')->with(['details'=>$this->order_details]);
//        });

    }
}
