<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    use HasFactory;
    protected $hidden =['created_at', 'updated_at','deleted'];
    public function banners(){
        return $this->hasMany(Banners::class);
    }

    public function zones()
    {
        return $this->hasManyThrough(Zone::class, SliderZone::class, 'slider_id', 'id', 'id', 'zone_id');
    }

    public function cities()
    {
        return $this->hasManyThrough(City::class, SliderCity::class, 'slider_id', 'id', 'id', 'city_id');
    }
}
