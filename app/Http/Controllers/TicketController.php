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
    public static function create($sender_id, $ticket_type, $heading, $desc, $meta)
    {
        switch ($ticket_type) {
            case TicketEnums::$TYPE['order_reschedule']:
                $title = TicketEnums::$TEMPLATES['order_reschedule']['title_template'];
                $body = TicketEnums::$TEMPLATES['order_reschedule']['body_template'];
                if (isset($meta['public_booking_id'])) {
                    $booking = Booking::where("public_booking_id", $meta['public_booking_id'])
                        ->with('organization')
                        ->with('payment')
                        ->with('driver')
                        ->with('vehicle')
                        ->with('user')
                        ->where("user_id", $sender_id)
                        ->first();
                    $title = str_replace("{{booking.id}}", "", $title);
                    $title = str_replace("{{user.name}}", "", $title);

                    $body = str_replace("{{booking.id}}", "", $body);
                    $body = str_replace("{{user.name}}", "", $body);
                }
                break;

            case TicketEnums::$TYPE['order_cancellation']:
                $title = TicketEnums::$TEMPLATES['order_cancellation']['title_template'];
                $body = TicketEnums::$TEMPLATES['order_cancellation']['body_template'];
                if (isset($meta['public_booking_id'])) {
                    $booking = Booking::where("public_booking_id", $meta['public_booking_id'])
                        ->with('organization')
                        ->with('payment')
                        ->with('driver')
                        ->with('vehicle')
                        ->with('user')
                        ->where("user_id", $sender_id)
                        ->first();
                    $title = str_replace("{{booking.id}}", "", $title);
                    $title = str_replace("{{user.name}}", "", $title);

                    $body = str_replace("{{booking.id}}", "", $body);
                    $body = str_replace("{{user.name}}", "", $body);

                }
                    break;
            default:
                $title = "";
                $desc = "";
        }

        $ticket = new Ticket;
        $ticket->user_id = $sender_id;
        $ticket->heading = $heading;
        $ticket->desc = $desc;
        $ticket->order_id = $meta['public_booking_id'];
        $ticket->type = $ticket_type;
        $ticket->meta = json_encode($meta);

        if(!$ticket->save())
            return Helper::response(false, "Could'nt create ticket.");

            return Helper::response(true, "Ticket raised",["ticket"=>Ticket::findOrFail($ticket->id)]);

    }

    public function fillVars($template, $data, $initialKey = "booking"){

        $template_explode = explode(" ",$template);

        $variables = [];
        foreach ($template_explode as $var){
            if(strpos($template,"{{") !== false && strpos($template,"}}") !== false){
                $variables[] = substr($var,strpos($template,"{{")+2, strpos($template,"}}") - 1);
            }
        }

        foreach ($variables as $var){

        }

        /*booking.ud*/
        foreach($data[$initialKey] as $key=>$value){
            $template = str_replace("{{booking}}" );
            if(!is_array($value)){
            $template = str_replace();
            }
        }
    }

}
