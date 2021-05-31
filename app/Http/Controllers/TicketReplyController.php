<?php

namespace App\Http\Controllers;

use App\Enums\NotificationEnums;
use App\Enums\TicketEnums;
use App\Helper;
use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\TicketReply;
use Illuminate\Http\Request;

class TicketReplyController extends Controller
{
    public static function addChatForUserAPP($sender_id, $ticket_id, $chat)
    {
        $ticket_exist = Ticket::where(['id'=>$ticket_id, 'user_id'=>$sender_id])->first();

        if($ticket_exist->staus ===  TicketEnums::$STATUS['rejected'])
            return Helper::response(false, "Ticket is Rejected");

        if($ticket_exist->staus ===  TicketEnums::$STATUS['closed'])
            return Helper::response(false, "Ticket is closed");

        if($ticket_exist->staus <  TicketEnums::$STATUS['resolved'])
            return Helper::response(false, "Ticket Not Approved Yet");

        $add_chat = new TicketReply();
        $add_chat->ticket_id = $ticket_id;
        $add_chat->user_id = $sender_id;
        $add_chat->chat =$chat;
        $chat_result = $add_chat->save();

        if(!$chat_result)
            return Helper::response(false, "couldn't send Massage, Please try again");

        return Helper::response(true, "added chat Successfully", ['ticket'=>Ticket::where('id', $ticket_id)->with('reply')]);
    }

    public static function addReplyFromAdmin($sender_id, $ticket_id, $chat)
    {
        $add_chat = new TicketReply();
        $add_chat->ticket_id = $ticket_id;
        $add_chat->admin_id = $sender_id;
        $add_chat->chat =$chat;
        $chat_result = $add_chat->save();

        if(!$chat_result)
            return Helper::response(false, "couldn't send Massage, Please try again");

        dispatch(function() use($ticket_id){
            $ticket_details=Ticket::findOrfail($ticket_id);
            if($ticket_details->user_id) {
                NotificationController::sendTo("user", [$ticket_details->user_id], "You have reply from Support.", "Tap to respond.", [
                    "type" => NotificationEnums::$TYPE['ticket'],
                ]);
            }
            if($ticket_details->vendor_id) {
                NotificationController::sendTo("vendor", [$ticket_details->vendor_id], "You have reply from Support.", "Tap to respond.", [
                    "type" => NotificationEnums::$TYPE['ticket'],
                ]);
            }
        })->afterResponse();

        return Helper::response(true, "added chat Successfully", ['ticket'=>Ticket::where('id', $ticket_id)->with('reply')]);
    }


    public static function addReplyFromVendor($sender_id, $ticket_id, $chat)
    {
        $add_chat = new TicketReply();
        $add_chat->ticket_id = $ticket_id;
        $add_chat->vendor_id = $sender_id;
        $add_chat->chat =$chat;
        $chat_result = $add_chat->save();

        if(!$chat_result)
            return Helper::response(false, "couldn't send Massage, Please try again");

        return Helper::response(true, "added chat Successfully", ['ticket'=>Ticket::where('id', $ticket_id)->with('reply')]);
    }

    public static function changeStatus($id, $status)
    {
        $ticket_status = Ticket::where('id', $id)->update([
            "status"=>$status
        ]);

        if(!$ticket_status)
            return Helper::response(false, "couldn't update status");

        return Helper::response(true, "status updated Successfully");
    }

    public static function changeApprovedBranchStatus($id, $status)
    {

    }
    public static function changeApprovedPriceStatus($id, $status)
    {

    }
    public static function changeRescheduleBooking($id, $status)
    {

    }
    public static function changeCancelBooking($id, $status)
    {

    }
}
