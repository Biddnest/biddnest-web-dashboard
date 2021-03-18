<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Org_kyc extends Model
{
    protected $hidden = ['created_at','updated_at','deleted'];
    protected $table = "org_kycs";
    use HasFactory;

}
