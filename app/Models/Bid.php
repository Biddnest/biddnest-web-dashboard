<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    protected $table = "bid";
    use HasFactory;
    protected $hidden = ['created_at','updated_at'];

    public function booking(){
        return $this->belongsTo(Booking::class);
    }

    public function organization(){
        return $this->belongsTo(Organization::class);
    }

    public function inventories()
    {
        return $this->hasMany(BidInventory::class);
    }

    public function booking_inventories()
    {
        return $this->hasManyThrough(BookingInventory::class, Booking::class, 'id','booking_id', 'booking_id', 'id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
