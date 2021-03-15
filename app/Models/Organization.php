<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function kyc(){
        return $this->hasOne(Org_kyc::class);
    }
    public function vendors(){
        return $this->hasMany(Vendor::class);
    }

    public function bookings(){
        return $this->hasMany(Bookings::class);
    }
}
