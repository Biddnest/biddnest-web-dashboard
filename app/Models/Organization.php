<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organization extends Model
{
    use HasFactory;

    public function kyc(){
        $this->hasOne(Org_kyc::class);
    }
    public function vendors(){
        $this->hasMany(Vendor::class);
    }
}
