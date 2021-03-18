<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    public function zones(){
        return $this->hasMany(AdminZone::class)->select("zone_id");
    }
}
