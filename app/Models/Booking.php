<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $table = "bookings";
    use HasFactory;
    protected $hidden = ['created_at','updated_at','deleted'];

    public function vendor(){
        return $this->belongsTo(Organization::class);
    }

    public function user(){
        return $this->hasOne(User::class);
    }

    public function inventories(){
        return $this->hasMany(BookingInventory::class);
    }

    public function movement_dates(){
        return $this->hasMany(MovementDates::class);
    }

    public function service(){
        return $this->belongsTo(Service::class)->select(['name','image']);
    }

    public function status_history(){
        return $this->hasMany(BookingStatus::class);
    }

    public function bid()
    {
        return $this->hasOne(Bid::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }
}
