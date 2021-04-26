<?php

namespace App\Http\Controllers;

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

        return Helper::response(true, "added chat Successfully", ['ticket'=>Ticket::where('id', $ticket_id)->with('reply')]);
    }
}
