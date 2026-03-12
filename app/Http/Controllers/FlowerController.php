<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;

class FlowerController extends Controller
{
    public function index(Request $request)
    {
        $category = $request->query('category');
        $query = Vendor::query();

        if ($category) {
            $query->where('type', 'like', '%' . $category . '%');
        }

        $vendors = $query->latest('id')->paginate(20)->withQueryString();
        
        return view('flowers', compact('vendors'));
    }

    public function show($id)
    {
        $vendor = Vendor::findOrFail($id);

        $ownerName = is_string($vendor->owner) ? $vendor->owner : (isset($vendor->owner['name']) ? $vendor->owner['name'] : 'Unknown');

        $vendorData = [
            'id' => $vendor->id,
            'name' => $vendor->name,
            'rating' => $vendor->rating ?? '0.0',
            'location' => $vendor->location ?? '',
            'price' => $vendor->price ?? '0',
            'about' => $vendor->about ?? '',
            'features' => collect($vendor->features)->toArray(),
            'categories' => collect($vendor->categories)->toArray(),
            'testimonials' => collect($vendor->testimonials)->toArray(),
            'main_image' => asset(ltrim($vendor->image ?? '', '/')),
            'image' => asset(ltrim($vendor->image ?? '', '/')),
            'owner' => [
                'name' => $ownerName,
                'bio' => 'Pemilik ' . ($vendor->name ?? 'Vendor') . ' yang berpengalaman dan berdedikasi menghadirkan bunga terbaik untuk momen spesial Anda.',
                'image' => 'https://ui-avatars.com/api/?name=' . urlencode($ownerName) . '&background=f9d8e4&color=d13d6a',
            ],
        ];

        return view('flower-detail', ['vendor' => $vendorData]);
    }
}
