<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $hidden = ['organization_id','created_at','updated_at','deleted',"password"];
    use HasFactory;

    public function organization(){
        return $this->belongsTo(Organization::class);
    }
}
