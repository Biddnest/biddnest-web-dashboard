<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Helper;
use App\Models\Ticket;
use App\Models\Booking;
use App\Models\User;
use App\Enums\TicketEnums;


class TicketController extends Controller
{
    public static function create($sender_id, $ticket_type, $meta, $heading=null, $body=null)
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
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->order_id = $booking['id'];
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
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
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->order_id = $booking['id'];
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
            break;

            case TicketEnums::$TYPE['complaint']:
                        $title = $heading;
                        $body = $body;
                        $ticket = new Ticket;
                        $ticket->user_id = $sender_id;
                        $ticket->heading = $title;
                        $ticket->desc = $body;
                        $ticket->type = $ticket_type;
                        $ticket->meta = json_encode($meta);
            break;

            case TicketEnums::$TYPE['call_back']:
                $title = TicketEnums::$TEMPLATES['call_back']['title_template'];
                $body = TicketEnums::$TEMPLATES['call_back']['body_template'];
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
            break;
            
            default:
                    $title = "";
                    $desc = "";
        }

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

    public static function get($sender_id = null)
    {
        if(!$sender_id)
        {
            $tickets = Ticket::with('booking')->with(['vendor'=>function ($org){
                $org->with('organization');
            }])->with('user')->orderBy('id', 'DESC')->get();
        }
        else
        {
            $tickets = Ticket::where('user_id', $sender_id)->orWhere('vendor_id', $sender_id)
                                ->whereNotIn('type', [TicketEnums::$TEMPLATES['call_back']])->with('booking')
                                ->orderBy('id', 'DESC')->get();
        }

        if(!$tickets)
            return Helper::response(false, "Could'nt get ticket.");

        return Helper::response(true, "Ticket raised",["ticket"=>$tickets]);
    }

}