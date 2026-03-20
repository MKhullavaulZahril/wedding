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
        'rating_venue',
        'rating_catering',
        'rating_service',
        'rating_price',
        'review_text',
        'review_photo',
        'is_anonymous',
        'is_approved',
        'manual_author',
        'manual_target',
    ];

    protected $casts = [
        'is_anonymous' => 'boolean',
        'is_approved' => 'boolean',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function venue()
    {
        return $this->belongsTo(Venue::class);
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class);
    }
}
