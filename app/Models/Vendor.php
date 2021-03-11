<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $hidden = ['laravel_through_key','created_at','updated_at','deleted',"password"];
    use HasFactory;

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
