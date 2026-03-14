<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable = [
        'name',
        'owner',
        'location',
        'price',
        'image',
        'rating',
        'type',
        'about',
        'features',
        'categories',
        'testimonials',
    ];

    protected $casts = [
        'features' => 'array',
        'categories' => 'array',
        'testimonials' => 'array',
    ];

    public function getImageAttribute($value)
    {
        return $value ? asset($value) : asset('images/placeholder-vendor.jpg');
    }
}
