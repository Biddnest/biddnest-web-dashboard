<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    public function zones(){
        return $this->hasManyThrough(Zone::class,AdminZone::class,'admin_id','id','id','zone_id');
    }

    public function cities(){
        return $this->hasManyThrough(City::class,AdminCity::class,'admin_id','id','id','city_id');
    }
}
