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
        return $this->hasOne(Booking::class);
    }

    public function organization(){
        return $this->hasOne(Organization::class);
    }

}
