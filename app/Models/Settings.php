<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $table = "app_settings";
    use HasFactory;
    protected $hidden =['created_at', 'updated_at'];
}
