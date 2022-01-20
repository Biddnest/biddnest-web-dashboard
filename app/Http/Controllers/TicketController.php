<?php

namespace App\Http\Controllers;

use App\Enums\BookingEnums;
use App\Enums\TicketEnums;
use App\Helper;
use App\Models\Booking;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Support\Facades\Log;
use Intervention\Image\ImageManager;
use Monolog\Logger;


class TicketController extends Controller
{
    public static function create($sender_id, $ticket_type, $meta, $ticket_images = null, $heading=null, $body=null, $status=null)
    {
        $images = [];
        $imageman = new ImageManager(array('driver' => 'gd'));
        if($ticket_images && count($ticket_images) > 0){
            foreach ($ticket_images as $key_img => $image) {
                $images[] = Helper::saveFile($imageman->make($image)->encode('png', 100), "BD" . uniqid() . $key_img . ".png", "tickets/" . $sender_id);

            }
        }
        if($status){
            $status_def=$status;
        }
        else{
            $status_def=TicketEnums::$STATUS['open'];
        }

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
                $ticket->booking_id = $booking['id'];
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                $ticket->status = $status_def;
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

                    Booking::where("public_booking_id", $meta['public_booking_id'])->update(["status"=>BookingEnums::$STATUS['cancel_request']]);
                    $title = str_replace("{{booking.id}}", "", $title);
                    $title = str_replace("{{user.name}}", "", $title);

                    $body = str_replace("{{booking.id}}", "", $body);
                    $body = str_replace("{{user.name}}", "", $body);

                }
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->booking_id = $booking['id'];
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                $ticket->status = $status_def;
            break;

            case TicketEnums::$TYPE['complaint']:
                $title = $heading." #".$meta["public_booking_id"];
                $body = $body;
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                $ticket->status = $status_def;
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
                $ticket->image = json_encode($images);
                $ticket->status = $status_def;
            break;

            case TicketEnums::$TYPE['service_request']:
                $title = $heading." #".$meta["public_booking_id"];
                $body = $body;
                $ticket = new Ticket;
                $ticket->vendor_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                $ticket->status = $status_def;
                break;

            default:
                    $title = "";
                    $desc = "";
        }

        if(!$ticket->save())
            return Helper::response(false, "Could'nt create ticket.");

            return Helper::response(true, "Ticket raised",["ticket"=>Ticket::findOrFail($ticket->id)]);

    }

    public static function createForUserApp($sender_id, $ticket_type, $meta, $ticket_images= null, $heading=null, $body=null)
    {
        $images = [];
        $imageman = new ImageManager(array('driver' => 'gd'));
        if($ticket_images && count($ticket_images)){
          foreach ($ticket_images as $key_img => $image) {
            $images[] = Helper::saveFile($imageman->make($image)->encode('png', 100), "BD" . uniqid() . $key_img . ".png", "tickets/" . $sender_id);
            Log::info($images);
          }
        }

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
                $ticket->booking_id = $booking['id'];
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
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
                        if($booking->status > BookingEnums::$STATUS['payment_pending']){
                            Booking::where("public_booking_id", $meta['public_booking_id'])
                            ->update([
                                "status"=>BookingEnums::$STATUS['cancel_request'],
                                "cancelled_meta"=>json_encode(['reason'=>$heading, 'desc'=>$body])
                            ]);
                        }
                        elseif($booking->status == BookingEnums::$STATUS['payment_pending']){
                            Booking::where("public_booking_id", $meta['public_booking_id'])
                            ->update([
                                "status"=>BookingEnums::$STATUS['cancelled'],
                                "cancelled_meta"=>json_encode(['reason'=>$heading, 'desc'=>$body])
                            ]);
                            return Helper::response(true, "Oreder cancelled successfully");
                        }
                           

                    $title = str_replace("{{booking.id}}", "", $title);
                    $title = str_replace("{{user.name}}", "", $title);

                    $body = str_replace("{{booking.id}}", "", $body);
                    $body = str_replace("{{user.name}}", "", $body);

                }
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->booking_id = $booking['id'];
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                break;

            case TicketEnums::$TYPE['complaint']:
                $title = $heading." #".$meta["public_booking_id"];
                $body = $body;
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
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
                $ticket->image = json_encode($images);
                break;

            case TicketEnums::$TYPE['service_request']:
                $title = $heading." #".$meta["public_booking_id"];
                $body = $body;
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                break;

            default:
                $title = "";
                $desc = "";
        }

        if(!$ticket->save())
            return Helper::response(false, "Could'nt create ticket.");

        return Helper::response(true, "Ticket raised",["ticket"=>Ticket::findOrFail($ticket->id)]);

    }

    public static function createForVendor($sender_id, $ticket_type, $meta, $ticket_images = [], $heading=null, $body=null)
    {
        $images = [];
        $imageman = new ImageManager(array('driver' => 'gd'));
        if($ticket_images){
            foreach ($ticket_images as $key_img => $image) {
                $images[] = Helper::saveFile($imageman->make($image)->encode('png', 100), "BD" . uniqid() . $key_img . ".png", "tickets/" . $sender_id);
                Log::info($images);
            }
        }

        switch ($ticket_type) {
            case TicketEnums::$TYPE['complaint']:
                $title = $heading;
                $body = $body;
                $ticket = new Ticket;
                $ticket->vendor_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                break;

            case TicketEnums::$TYPE['call_back']:
                $title = TicketEnums::$TEMPLATES['call_back']['title_template'];
                $body = TicketEnums::$TEMPLATES['call_back']['body_template'];
                $ticket = new Ticket;
                $ticket->vendor_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                break;

            case TicketEnums::$TYPE['service_request']:
                $title = $heading;
                $body = $body;
                $ticket = new Ticket;
                $ticket->vendor_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                break;

            case TicketEnums::$TYPE['new_branch']:
                    $title1 = TicketEnums::$TEMPLATES['new_branch']['title_template'];
                    $body1 = TicketEnums::$TEMPLATES['new_branch']['body_template'];
                    $title = $title1;
                    $body = $body1;
                    $ticket = new Ticket;
                    $ticket->vendor_id = $sender_id;
                    $ticket->heading = $title;
                    $ticket->desc = $body;
                    $ticket->type = $ticket_type;
                    $ticket->meta = json_encode($meta);
                    $ticket->image = json_encode($images);
            break;

            case TicketEnums::$TYPE['price_update']:
                    $title1 = TicketEnums::$TEMPLATES['price_update']['title_template'];
                    $body1 = TicketEnums::$TEMPLATES['price_update']['body_template'];
                    $title = $title1;
                    $body = $body1;
                    $ticket = new Ticket;
                    $ticket->vendor_id = $sender_id;
                    $ticket->heading = $title;
                    $ticket->desc = $body;
                    $ticket->type = $ticket_type;
                    $ticket->meta = json_encode($meta);
                    $ticket->image = json_encode($images);
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

    public static function get($sender_id = null, $web=false)
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

        if($web)
            return $tickets;
        else
            return Helper::response(true, "Ticket raised",["ticket"=>$tickets]);
    }

    public static function addReplyFromUser($sender_id, $ticket_id, $reply)
    {
        $ticket_exist = Ticket::where(['id'=>$ticket_id, 'user_id'=>$sender_id])->first();

        if(!$ticket_exist)
            return Helper::response(false, "Ticket doesn't exist");

        if($ticket_exist->status ==  TicketEnums::$STATUS['rejected'])
            return Helper::response(false, "Ticket is Rejected");

        if($ticket_exist->status ==  TicketEnums::$STATUS['closed'])
            return Helper::response(false, "Ticket is closed");

        if($ticket_exist->status ==  TicketEnums::$STATUS['resolved'])
            return Helper::response(false, "Ticket is resolved");

        $add_chat = new TicketReply;
        $add_chat->ticket_id = $ticket_id;
        $add_chat->user_id = $sender_id;
        $add_chat->chat =$reply;
        $chat_result = $add_chat->save();

        if(!$chat_result)
            return Helper::response(false, "couldn't send Massage, Please try again");

        return Helper::response(true, "added chat Successfully", ['reply'=>TicketReply::findOrFail($add_chat->id)]);
    }

    public static function getOneForUserApp($sender_id, $ticket_id)
    {
        $tickets = Ticket::where(['id'=>$ticket_id])->with(['reply'=> function($query) {
           $query->with('admin');
        }])->get();

        return Helper::response(true, "Here are the Ticket Details",["ticket"=>$tickets[0]]);
    }

    public static function getOneForVendorApp($sender_id, $ticket_id)
    {
        $tickets = Ticket::where(['id'=>$ticket_id])->with(['reply'=> function($query) {
           $query->with('admin');
        }])->get();

        return Helper::response(true, "Here are the Ticket Details",["ticket"=>$tickets[0]]);
    }

    public static function createCallBack($ticket_type, $phone)
    {
        $meta=["phone"=>$phone, "public_booking_id"=>null];
        $title = TicketEnums::$TEMPLATES['call_back']['title_template'];
        $body = "Request to call back on ".$phone;
        $ticket = new Ticket;
        $ticket->heading = $title;
        $ticket->desc = $body;
        $ticket->type = $ticket_type;
        $ticket->meta = json_encode($meta);

        if(!$ticket->save())
            return Helper::response(false, "Could'nt create ticket.");

        return Helper::response(true, "Ticket raised",["ticket"=>Ticket::findOrFail($ticket->id)]);
    }

    public static function createCallBackBooking($sender_id, $booking_id)
    {
        $meta=["phone"=>null, "public_booking_id"=>$booking_id];
        $booking_id_id = Booking::where('public_booking_id', $booking_id)->pluck('id')[0];
        $title = TicketEnums::$TEMPLATES['call_back']['title_template'];
        $body = "Request to call back ".$booking_id;
        $ticket = new Ticket;
        $ticket->user_id = $sender_id;
        $ticket->heading = $title;
        $ticket->desc = $body;
        $ticket->booking_id = $booking_id_id;
        $ticket->type = TicketEnums::$TYPE['call_back'];
        $ticket->meta = json_encode($meta);

        if(!$ticket->save())
            return Helper::response(false, "Could'nt create ticket.");

        return Helper::response(true, "Ticket raised",["ticket"=>Ticket::findOrFail($ticket->id)]);
    }

    public static function createRejectCall($sender_id, $ticket_type, $data)
    {
        $meta=["public_booking_id"=>$data];
        $title = TicketEnums::$TEMPLATES['call_back']['title_template'];
        $body = "Request to Cancel this Oreder ".$data;
        $ticket = new Ticket;
        $ticket->heading = $title;
        $ticket->desc = $body;
        $ticket->user_id = $sender_id;
        $ticket->type = $ticket_type;
        $ticket->meta = json_encode($meta);

        if(!$ticket->save())
            return Helper::response(false, "Could'nt create ticket.");

        return Helper::response(true, "Ticket raised Successfull",["ticket"=>Ticket::findOrFail($ticket->id)]);
    }

    public static function createForWeb($sender_id, $ticket_type, $meta, $ticket_images, $heading=null, $body=null)
    {
            $images = [];
        if($ticket_images){
            $imageman = new ImageManager(array('driver' => 'gd'));
            foreach ($ticket_images as $key_img => $image) {
                $images[] = Helper::saveFile($imageman->make($image)->encode('png', 100), "BD" . uniqid() . $key_img . ".png", "tickets/" . $sender_id);
                Log::info($images);
            }
        }

        switch ($ticket_type) {
            case TicketEnums::$TYPE['order_reschedule']:
                $title = $heading ? $heading : TicketEnums::$TEMPLATES['order_reschedule']['title_template'];
                $body = $body ? $body : TicketEnums::$TEMPLATES['order_reschedule']['body_template'];
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
                $ticket->booking_id = $booking['id'];
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                break;

            case TicketEnums::$TYPE['order_cancellation']:
                $title = $heading ? $heading : TicketEnums::$TEMPLATES['order_cancellation']['title_template'];
                $body = $body ? $body :TicketEnums::$TEMPLATES['order_cancellation']['body_template'];

                $ticket = new Ticket;
                $ticket->user_id = $sender_id;


                if (isset($meta['public_booking_id'])) {
                    $booking = Booking::where("public_booking_id", $meta['public_booking_id'])
                        ->with('organization')
                        ->with('payment')
                        ->with('driver')
                        ->with('vehicle')
                        ->with('user')
                        ->where("user_id", $sender_id)
                        ->first();


                    /*registering booking id to ticket*/
                    $ticket->booking_id = $booking['id'];
                }

                $title = str_replace("{{booking.id}}", "", $title);
                $title = str_replace("{{user.name}}", "", $title);

                $body = str_replace("{{booking.id}}", "", $body);
                $body = str_replace("{{user.name}}", "", $body);

                $ticket->heading = $title;
                $ticket->desc = $body;

                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
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
                $ticket->image = json_encode($images);
                break;

            case TicketEnums::$TYPE['call_back']:
                $title = $heading ? $heading : TicketEnums::$TEMPLATES['call_back']['title_template'];
                $body = $body ? $body : TicketEnums::$TEMPLATES['call_back']['body_template'];
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                break;

            case TicketEnums::$TYPE['service_request']:
                $title = $heading;
                $body = $body;
                $ticket = new Ticket;
                $ticket->user_id = $sender_id;
                $ticket->heading = $title;
                $ticket->desc = $body;
                $ticket->type = $ticket_type;
                $ticket->meta = json_encode($meta);
                $ticket->image = json_encode($images);
                break;

            default:
                $title = "";
                $desc = "";
        }

        if(!$ticket->save())
            return Helper::response(false, "Could'nt create ticket.");

        return Helper::response(true, "Ticket raised",["ticket"=>Ticket::findOrFail($ticket->id)]);

    }

}
