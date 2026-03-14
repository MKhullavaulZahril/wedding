<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    //
    protected $fillable = [
        'user_id',
        'venue_id',
        'vendor_id',
        'overall_rating',
        'review_text',
        'review_photo',
        'is_anonymous',
        'is_approved',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'is_approved' => 'boolean',
    ];
}
