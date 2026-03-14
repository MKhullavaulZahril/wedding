<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VenueController;
use App\Http\Controllers\FlowerController;

use App\Http\Controllers\AuthController;

Route::get('/', function () {
    $featuredVenue = \App\Models\Venue::latest()->first();
    $recentItems = collect();

    if ($featuredVenue) {
        $recentVenues = \App\Models\Venue::where('id', '!=', $featuredVenue->id)
                            ->latest()->take(2)->get();
        $recentVendors = \App\Models\Vendor::latest()->take(2)->get();
        
        $recentItems = $recentVenues->merge($recentVendors)->shuffle();
    }

    return view('welcome', compact('featuredVenue', 'recentItems'));
})->name('landing');

Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class , 'index'])->name('dashboard');

// Authentication Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('forgot-password');
// Google Login via Socialite (Optional, if you want to use Socialite too)
Route::get('/auth/google', [AuthController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [AuthController::class, 'handleGoogleCallback']);

Route::get('/venues', [VenueController::class , 'index'])->name('venues.index');
Route::get('/venues/{id}', [VenueController::class , 'show'])->name('venues.show');

Route::get('/flowers', [FlowerController::class , 'index'])->name('flowers.index');
Route::get('/flowers/{id}', [FlowerController::class , 'show'])->name('flowers.show');

Route::get('/checkout/{venue_id?}', [\App\Http\Controllers\BookingController::class , 'checkout'])->name('checkout')->middleware('auth');
Route::get('/checkout-cart', [\App\Http\Controllers\BookingController::class , 'checkoutCart'])->name('checkout.cart')->middleware('auth');
Route::post('/checkout/pay', [\App\Http\Controllers\BookingController::class , 'pay'])->name('checkout.pay')->middleware('auth');

Route::get('/orders', [\App\Http\Controllers\BookingController::class , 'orders'])->name('orders')->middleware('auth');

// Profile Routes
Route::get('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'edit'])->name('profile.edit')->middleware('auth');
Route::post('/profile/edit', [\App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update')->middleware('auth');

Route::get('/rating', function () {
    return view('rating');
})->name('rating')->middleware('auth');

Route::get('/saran', function () {
    return view('saran');
})->name('saran')->middleware('auth');

Route::post('/saran', function (\Illuminate\Http\Request $request) {
    \App\Models\Saran::create([
        'user_id' => auth()->id(),
        'category' => $request->input('category'),
        'title' => $request->input('title'),
        'content' => $request->input('saran'),
    ]);
    return redirect()->route('dashboard')->with('success', 'Terima kasih! Saran Anda telah kami terima.');
})->name('saran.store')->middleware('auth');

Route::get('/studycase', function () {
    $venues = \App\Models\Venue::paginate(10);
    return view('studycase', compact('venues'));
})->name('studycase')->middleware('auth');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// ── ADMIN PANEL ROUTES (SECURED) ──
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/', function () {
        $venues = \App\Models\Venue::all()->map(function($v) {
            return [
                'id' => $v->id,
                'name' => $v->name,
                'category' => $v->category ?? 'Venue',
                'desc' => \Illuminate\Support\Str::limit($v->about ?? 'Tidak ada deskripsi', 150),
                'price' => (int) ($v->price ?? 0),
                'discount' => 0,
                'capacity' => 500,
                'city' => $v->location ?? '-',
                'img' => $v->image,
                'photos' => is_array($v->gallery) ? count($v->gallery) : (is_string($v->gallery) ? count(json_decode($v->gallery, true) ?? []) : 0),
                'status' => 'active',
                'featured' => false
            ];
        });

        $vendors = \App\Models\Vendor::all()->map(function($v) {
            return [
                'id' => $v->id,
                'name' => $v->name,
                'category' => $v->type ?? 'Vendor',
                'desc' => \Illuminate\Support\Str::limit($v->about ?? 'Tidak ada deskripsi', 150),
                'price' => (int) ($v->price ?? 0),
                'discount' => 0,
                'city' => $v->location ?? '-',
                'img' => $v->image,
                'photos' => 0,
                'status' => 'active',
                'featured' => false
            ];
        });

        $sarans = \App\Models\Saran::latest()->get();
        $ratings = \App\Models\Rating::latest()->get();

        return view('admin.dashboard', compact('venues', 'vendors', 'sarans', 'ratings'));
    })->name('admin.dashboard');

    // Admin Action Routes
    Route::post('/venues/delete', function (\Illuminate\Http\Request $request) {
        $ids = (array) $request->input('ids');
        \App\Models\Venue::whereIn('id', $ids)->delete();
        return response()->json(['success' => true]);
    })->name('admin.venues.delete');

    Route::post('/vendors/delete', function (\Illuminate\Http\Request $request) {
        $ids = (array) $request->input('ids');
        \App\Models\Vendor::whereIn('id', $ids)->delete();
        return response()->json(['success' => true]);
    })->name('admin.vendors.delete');

    Route::post('/venues/store', function (\Illuminate\Http\Request $request) {
        try {
            $venue = new \App\Models\Venue();
            $venue->name = $request->input('name');
            $venue->category = $request->input('category');
            $venue->about = $request->input('about');
            $venue->location = $request->input('location');
            $venue->price = (int) $request->input('price');
            $venue->owner = 'Admin';
            
            if ($request->hasFile('images')) {
                $files = $request->file('images');
                $gallery = [];
                foreach ($files as $index => $file) {
                    $filename = time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/uploads'), $filename);
                    $path = 'images/uploads/' . $filename;
                    $gallery[] = $path;
                    if ($index === 0) { $venue->image = $path; }
                }
                $venue->gallery = $gallery;
            }

            if ($request->input('features')) {
                $venue->features = array_map('trim', explode(',', $request->input('features')));
            }

            $venue->save();
            return response()->json(['success' => true, 'venue' => $venue]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    })->name('admin.venues.store');

    Route::post('/vendors/store', function (\Illuminate\Http\Request $request) {
        try {
            $vendor = new \App\Models\Vendor();
            $vendor->name = $request->input('name');
            $vendor->type = $request->input('type');
            $vendor->about = $request->input('about');
            $vendor->location = $request->input('location');
            $vendor->price = (int) $request->input('price');
            $vendor->owner = 'Admin';
            $vendor->rating = '4.5';

            if ($request->hasFile('images')) {
                $files = $request->file('images');
                $gallery = [];
                foreach ($files as $index => $file) {
                    $filename = 'vendor_' . time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/uploads'), $filename);
                    $path = 'images/uploads/' . $filename;
                    $gallery[] = $path;
                    if ($index === 0) { $vendor->image = $path; }
                }
                $vendor->features = array_map('trim', explode(',', $request->input('features')));
            }

            $vendor->save();
            return response()->json(['success' => true, 'vendor' => $vendor]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    })->name('admin.vendors.store');

    Route::get('/promos', [\App\Http\Controllers\PromoController::class, 'index'])->name('admin.promos');
    Route::post('/promos/store', [\App\Http\Controllers\PromoController::class, 'store'])->name('admin.promos.store');
    Route::post('/promos/delete/{id}', [\App\Http\Controllers\PromoController::class, 'destroy'])->name('admin.promos.delete');
});
Route::post('/promos/validate', [\App\Http\Controllers\PromoController::class, 'validatePromo'])->name('promos.validate');
