<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    protected $hidden = ["deleted"];

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function coordinates(){
        return $this->hasMany(ZoneCoordinate::class);
    }
}
