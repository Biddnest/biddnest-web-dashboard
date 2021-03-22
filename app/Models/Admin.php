<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public function zones(){
        return $this->hasManyThrough(Zone::class,AdminZone::class,'zone_id','id','id','admin_id');
//        return $this->hasManyThrough(Services::class,ServiceSubservice::class,);
    }
}
