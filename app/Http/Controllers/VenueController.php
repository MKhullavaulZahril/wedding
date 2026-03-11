<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

class VenueController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    /**
     * Tampilkan daftar semua venue dari Firebase.
     */
    public function index(Request $request)
    {
        $category = $request->query('category');
        
        try {
            if ($category) {
                // Try fast server-side filtering first
                $venuesData = $this->firebase->getCachedDataFiltered('venues', 'category', $category, 50, 15);
            } else {
                // Fetch first 50 items for speed
                $venuesData = $this->firebase->getCachedDataLimited('venues', 50, 15);
            }
        } catch (\Exception $e) {
            // Fallback: Fetch everything and filter in PHP if Firebase indexing isn't ready
            $venuesData = $this->firebase->getCachedData('venues', 60);
        }
        
        if (!$venuesData) {
            $venuesData = [];
        }

        $venuesCollection = collect($venuesData)->filter();

        // Filter berdasarkan kategori jika ada
        if ($request->filled('category')) {
            $venuesCollection = $venuesCollection->filter(function($item) use ($request) {
                $itemCat = str_replace([' / ', '/'], ' ', strtolower($item['category'] ?? ''));
                $searchCat = str_replace([' / ', '/'], ' ', strtolower($request->category));
                return str_contains($itemCat, $searchCat) || $itemCat == $searchCat;
            });
        }

        // Urutkan berdasarkan yang terbaru (berdasarkan id atau created_at jika ada)
        $venuesCollection = $venuesCollection->sortByDesc('id');

        // Manual Pagination
        $perPage = 20;
        $currentPage = $request->input('page', 1);
        $currentItems = $venuesCollection->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $venues = new LengthAwarePaginator(
            $currentItems,
            $venuesCollection->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('venues', compact('venues'));
    }

    /**
     * Tampilkan detail venue spesifik dari Firebase.
     */
    public function show($id)
    {
        $venue = $this->firebase->getCachedData("venues/$id", 30); // Cache details longer

        if (!$venue) {
            abort(404, 'Venue tidak ditemukan.');
        }

        // Konversi ke object-like array untuk kompatibilitas dengan view
        $venue = (object) $venue;

        // Parse gallery if it's a string (though in RTDB it should already be an array)
        $gallery = is_string($venue->gallery ?? null) ? json_decode($venue->gallery, true) : ($venue->gallery ?? []);
        
        // Wrap gallery items in asset() and ensure paths are correct
        $formattedGallery = array_map(function($img) {
            return asset(ltrim($img, '/'));
        }, $gallery);

        // Prepend main image to gallery if not already present
        $mainImage = asset($venue->image ?? '');
        if (!in_array($mainImage, $formattedGallery)) {
            array_unshift($formattedGallery, $mainImage);
        }

        // Format owner untuk kompatibilitas dengan view
        $venueData = [
            'id' => $venue->id,
            'name' => $venue->name,
            'rating' => '4.5',
            'location' => $venue->location,
            'price' => 'IDR ' . number_format((float)($venue->price ?? 0), 0, ',', '.'),
            'about' => $venue->about ?? '',
            'features' => $venue->features ?? [],
            'gallery' => $formattedGallery,
            'image' => $mainImage,
            'owner' => [
                'name' => is_array($venue->owner) ? ($venue->owner['name'] ?? 'Unknown') : ($venue->owner ?? 'Unknown'),
                'bio' => 'Pengelola ' . ($venue->name ?? 'Venue') . ' yang berpengalaman dan berdedikasi memastikan pernikahan Anda berjalan sempurna.',
                'image' => 'https://ui-avatars.com/api/?name=' . urlencode(is_array($venue->owner) ? ($venue->owner['name'] ?? 'Owner') : ($venue->owner ?? 'Owner')) . '&background=f9d8e4&color=d13d6a',
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
