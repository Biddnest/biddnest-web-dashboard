<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $hidden = ['created_at','updated_at', 'deleted'];
    protected $table = "review";
    use HasFactory;
}
