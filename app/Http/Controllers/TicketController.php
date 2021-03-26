<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper;
use App\Models\Ticket;
use App\Models\Booking;
use App\Enums\TicketEnums;

class TicketController extends Controller
{
    public static function create($sender_id, $ticket_type, $meta)
    {
        switch($ticket_type)
        {
            case TicketEnums::$TYPE['order_reschedule']:
                $title= TicketEnums::$TEMPLATES['order_reschedule']['title_template'];
                $body= TicketEnums::$TEMPLATES['order_reschedule']['body_template'];
                if(isset($meta['public_booking_id']))
                {
                    $booking =Booking::where("public_booking_id", $meta['public_booking_id'])
                    ->with('organization')
                    ->with('payment')
                    ->with('driver')
                    ->with('vehicle')
                    ->with('user')
                    ->where("user_id", $sender_id)
                    ->first();

                    
                }
            break;

            case TicketEnums::$TYPE['order_cancellation']:
                $title= TicketEnums::$TEMPLATES['order_reschedule']['title_template'];
                $title= TicketEnums::$TEMPLATES['order_reschedule']['body_template'];
            break;

        }
    }
}
