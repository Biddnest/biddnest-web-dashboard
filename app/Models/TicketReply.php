<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketReply extends Model
{
    protected $table = "ticket_reply";
    protected $hidden = ['id', 'status', 'ticket_id', 'vendor_id','updated_at','deleted'];
    use HasFactory;

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function agent(){
        return $this->belongsTo(Admin::class);
    }
}
