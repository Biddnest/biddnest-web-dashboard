<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = "vehicle";
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];

    // public function bookingdriver()
    // {
    //     return $this->morphMany(BookingDriver::class, 'driver');
    // }
}
