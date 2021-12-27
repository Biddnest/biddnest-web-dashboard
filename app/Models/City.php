<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    protected $hidden =['created_at', 'updated_at','deleted'];

    public function zones(){
        return $this->hasManyThrough(Zone::class,CityZone::class,'city_id','id','id','zone_id');
    }
}
