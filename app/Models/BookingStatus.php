<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingStatus extends Model
{
    protected $table = "booking_status";
    use HasFactory;
    protected $hidden = ['id','created_at','updated_at'];
}
