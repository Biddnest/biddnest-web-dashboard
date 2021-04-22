<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public function zones(){
        return $this->hasManyThrough(Zone::class,AdminZone::class,'admin_id','id','id','zone_id');
//        return $this->hasManyThrough(Services::class,ServiceSubservice::class,);
    }
}
