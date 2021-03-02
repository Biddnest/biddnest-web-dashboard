<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    use HasFactory;

    protected $hidden = ['laravel_through_key','created_at','updated_at','deleted'];


    public  function subservices(){
        $this->belongsToMany(Subservice::class);
    }
}
