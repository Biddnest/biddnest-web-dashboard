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
        return $this->belongsTo(Organization::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
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

    public function movement_specifications()
    {
        return $this->hasOne(Bid::class);
    }

    public function bids()
    {
        return $this->hasMany(Bid::class);
    }

    public function payment()
    {
        return $this->hasOne(Payment::class);
    }

    public function driver()
    {
        return $this->hasOneThrough(Vendor::class, BookingDriver::class, 'booking_id', 'id', 'id', 'driver_id');
    }

    public function vehicle()
    {
        return $this->hasOneThrough(Vehicle::class, BookingDriver::class, 'vehicle_id', 'id', 'id', 'vehicle_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // public function bookingdriver()
    // {
    //     return $this->morphMany(BookingDriver::class, 'driver');
    // }
}
