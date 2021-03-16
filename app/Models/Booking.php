<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "bookings";
    use HasFactory;
    protected $hidden = ['created_at','updated_at','deleted'];

    public function organization(){
        return $this->hasOne(Organization::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function bookinginventory(){
        return $this->hasMany(BookingInventory::class);
    }


}
