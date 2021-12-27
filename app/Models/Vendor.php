<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $hidden = ['created_at','updated_at','deleted',"password", "pin", "verf_code"];
    use HasFactory;

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
