<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MovementDates extends Model
{
    protected $table = "movement_dates";
    protected $hidden =['created_at', 'updated_at'];
    use HasFactory;

    public function bookings(){
        return $this->hasMany(Bookings::class);
    }
}
