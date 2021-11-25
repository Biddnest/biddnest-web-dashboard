<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReferralHistory extends Model
{
    use HasFactory;

    protected $table = "referral_history";

    public function referrer(){
        return $this->belongsTo(User::class, "user_id", "id");
    }

    public function referee(){
        return $this->belongsTo(User::class, "referred_by_id", "id");
    }

}
