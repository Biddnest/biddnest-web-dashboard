<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{

    protected $hidden = ['laravel_through_key','created_at','updated_at','deleted'];
    use HasFactory;

    public function bookings(){
        $this->hasMany(Bookings::class);
    }
}
