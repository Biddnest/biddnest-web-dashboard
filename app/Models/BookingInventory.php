<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingInventory extends Model
{
    protected $table = "booking_inventories";
    use HasFactory;
    protected $hidden = ['created_at','updated_at','deleted'];

    public function bookings(){
        return $this->hasOne(Bookings::class);
    }

}
