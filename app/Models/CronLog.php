<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CronLog extends Model
{
    protected $table = "crone_logs";
    protected $hidden =['created_at', 'updated_at'];
    use HasFactory;
}
