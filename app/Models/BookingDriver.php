<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingDriver extends Model
{

    protected $table = "booking_driver_map";
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function driver()
     {
         return $this->belongsTo(Vendor::class);
     }
}
