<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\FirebaseService;

class FlowerController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    public function index(Request $request)
    {
        $category = $request->query('category');
        
        try {
            if ($category) {
                // Try fast server-side filtering first
                $vendorsData = $this->firebase->getCachedDataFiltered('vendors', 'type', $category, 50, 15);
            } else {
                // Fetch first 50 items for speed
                $vendorsData = $this->firebase->getCachedDataLimited('vendors', 50, 15);
            }
        } catch (\Exception $e) {
            // Fallback: Fetch everything and filter in PHP if Firebase indexing isn't ready
            $vendorsData = $this->firebase->getCachedData('vendors', 60);
        }
        
        if (!$vendorsData) {
            $vendorsData = [];
        }

        $vendorsCollection = collect($vendorsData)->filter();

        // Filter berdasarkan kategori/type jika ada
        if ($request->filled('category')) {
            $vendorsCollection = $vendorsCollection->filter(function($item) use ($request) {
                return strtolower($item['type'] ?? '') == strtolower($request->category);
            });
        }

        $vendors = $vendorsCollection->values();
        
        return view('flowers', compact('vendors'));
    }

    /**
     * Tampilkan detail vendor bunga spesifik dari Firebase.
     */
    public function show($id)
    {
        $vendor = $this->firebase->getCachedData("vendors/$id", 30);

        if (!$vendor) {
            abort(404, 'Vendor bunga tidak ditemukan.');
        }

        // Konversi ke object-like array untuk kompatibilitas dengan view
        $vendor = (object) $vendor;

        // Format data agar kompatibel dengan view (yang mengharapkan 'owner' sebagai array)
        $vendorData = [
            'id' => $vendor->id,
            'name' => $vendor->name,
            'rating' => $vendor->rating ?? '0.0',
            'location' => $vendor->location ?? '',
            'price' => $vendor->price ?? '0',
            'about' => $vendor->about ?? '',
            'features' => $vendor->features ?? [],
            'categories' => $vendor->categories ?? [],
            'testimonials' => $vendor->testimonials ?? [],
            'main_image' => $vendor->image ?? '',
            'owner' => [
                'name' => is_array($vendor->owner) ? ($vendor->owner['name'] ?? 'Unknown') : ($vendor->owner ?? 'Unknown'),
                'bio' => 'Pemilik ' . ($vendor->name ?? 'Vendor') . ' yang berpengalaman dan berdedikasi menghadirkan bunga terbaik untuk momen spesial Anda.',
                'image' => 'https://images.unsplash.com/photo-1544124499-58912cbddada?auto=format&fit=crop&w=400&q=80',
            ],
        ];

        return view('flower-detail', ['vendor' => $vendorData]);
    }
}
