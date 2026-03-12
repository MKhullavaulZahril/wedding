<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venue;

class VenueController extends Controller
{
    /**
     * Tampilkan daftar semua venue dari Database MySQL.
     */
    public function index(Request $request)
    {
        $category = $request->query('category');
        $query = Venue::query();

        if ($category) {
            $query->where('category', 'like', '%' . $category . '%');
        }

        $venues = $query->latest('id')->paginate(20)->withQueryString();
        
        return view('venues', compact('venues'));
    }

    /**
     * Tampilkan detail venue spesifik dari Database MySQL.
     */
    public function show($id)
    {
        $venue = Venue::findOrFail($id);

        $gallery = collect($venue->gallery)->toArray();
        
        $formattedGallery = array_map(function($img) {
            return asset(ltrim($img, '/'));
        }, $gallery);

        $mainImage = asset($venue->image ?? '');
        if (!in_array($mainImage, $formattedGallery)) {
            array_unshift($formattedGallery, $mainImage);
        }

        $ownerName = is_string($venue->owner) ? $venue->owner : (isset($venue->owner['name']) ? $venue->owner['name'] : 'Owner');

        // Format owner untuk kompatibilitas dengan view
        $venueData = [
            'id' => $venue->id,
            'name' => $venue->name,
            'rating' => '4.5',
            'location' => $venue->location,
            'price' => 'IDR ' . number_format((float)($venue->price ?? 0), 0, ',', '.'),
            'about' => $venue->about ?? '',
            'features' => collect($venue->features)->toArray(),
            'gallery' => $formattedGallery,
            'image' => $mainImage,
            'owner' => [
                'name' => $ownerName,
                'bio' => 'Pengelola ' . ($venue->name ?? 'Venue') . ' yang berpengalaman dan berdedikasi memastikan pernikahan Anda berjalan sempurna.',
                'image' => 'https://ui-avatars.com/api/?name=' . urlencode($ownerName) . '&background=f9d8e4&color=d13d6a',
            ],
            'testimonials' => [
                [
                    'text' => 'Pernikahan kami di sini sangat berkesan. Fasilitas lengkap dan staf yang ramah. Sangat direkomendasikan!',
                    'author' => 'Ibu Sari & Bapak Budi'
                ]
            ],
        ];

        return view('venue-detail', ['venue' => $venueData]);
    }
}
