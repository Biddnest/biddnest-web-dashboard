<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganizationService extends Model
{
    protected $hidden = ['created_at','updated_at'];
    protected $table = "organization_service_map";
    use HasFactory;
}
