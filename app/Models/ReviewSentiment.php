<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewSentiment extends Model
{
    use HasFactory;

    protected  $table = "review_sentiments";

    public function review()
    {
        return $this->belongsTo(Review::class);
    }

}
