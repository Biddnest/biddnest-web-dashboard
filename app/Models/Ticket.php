<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $table = "ticket";
    protected $hidden = ['created_at','updated_at','deleted'];
    use HasFactory;

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function vendor(){
        return $this->belongsTo(Vendor::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
