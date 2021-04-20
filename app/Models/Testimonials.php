<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonials extends Model
{
    protected $table = "testimonial";
    protected $hidden = ['created_at','updated_at','deleted'];
    use HasFactory;
}
