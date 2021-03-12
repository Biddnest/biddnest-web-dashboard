<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlideBanner extends Model
{
    protected $hidden =['created_at', 'updated_at','deleted'];
    protected $table = "banners";
    use HasFactory;
}
