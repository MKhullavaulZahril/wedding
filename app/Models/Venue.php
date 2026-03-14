<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    protected $fillable = [
        'name',
        'owner',
        'location',
        'price',
        'image',
        'gallery',
        'about',
        'features',
        'category',
    ];

    protected $casts = [
        'gallery' => 'array',
        'features' => 'array',
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset($value) : asset('images/placeholder-venue.jpg');
    }
}
