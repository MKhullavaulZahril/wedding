<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class LandingEditorController extends Controller
{
    /**
     * Display the landing page editor.
     */
    public function index()
    {
        // Get all settings indexed by key
        $settings = SiteSetting::all()->pluck('value', 'key');
        
        return view('admin.landing_editor', compact('settings'));
    }

    /**
     * Update landing page settings.
     */
    public function update(Request $request)
    {
        $data = $request->all();

        // Handle File Uploads
        $fileKeys = ['logo_image', 'hero_bg_image'];
        
        foreach ($fileKeys as $key) {
            if ($request->hasFile($key)) {
                $file = $request->file($key);
                $filename = time() . '_' . Str::slug(pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME)) . '.' . $file->getClientOriginalExtension();
                
                // Move file to public/images/uploads
                $file->move(public_path('images/uploads'), $filename);
                
                // Save path to settings
                $data[$key] = 'images/uploads/' . $filename;
            }
        }

        // Update all keys sent in the request
        foreach ($data as $key => $value) {
            if ($key === '_token' || $key === '_method') continue;
            
            // Only update keys that correspond to files if they were actually uploaded
            if (in_array($key, $fileKeys) && !$request->hasFile($key)) continue;

            SiteSetting::setValue($key, $value);
        }

        return back()->with('success', 'Landing Page berhasil diperbarui!');
    }

    /**
     * Display the inline visual editor.
     */
    public function visualEditor()
    {
        $featuredVenue = \App\Models\Venue::latest()->first();
        $recentItems = collect();

        if ($featuredVenue) {
            $recentVenues = \App\Models\Venue::where('id', '!=', $featuredVenue->id)
                                ->latest()->take(2)->get();
            $recentVendors = \App\Models\Vendor::latest()->take(2)->get();
            
            $recentItems = $recentVenues->merge($recentVendors)->shuffle();

            foreach ($recentItems as $item) {
                $item->item_type = class_basename($item);
            }
        }

        $ratings = \App\Models\Rating::where('is_approved', true)
                    ->with(['user', 'venue', 'vendor'])
                    ->latest()
                    ->take(3)
                    ->get();

        return view('welcome', [
            'editMode' => true,
            'featuredVenue' => $featuredVenue,
            'recentItems' => $recentItems,
            'ratings' => $ratings
        ]);
    }

    /**
     * Update landing page settings via AJAX from inline editor.
     */
    public function updateVisual(Request $request)
    {
        try {
            $data = $request->except(['_token', '_method']);
            
            // Handle images
            $fileKeys = ['logo_image', 'hero_bg_image'];
            foreach ($fileKeys as $key) {
                if ($request->hasFile($key)) {
                    $file = $request->file($key);
                    $filename = time() . '_' . $key . '.' . $file->getClientOriginalExtension();
                    $file->move(public_path('images/uploads'), $filename);
                    $data[$key] = 'images/uploads/' . $filename;
                }
            }

            foreach ($data as $key => $value) {
                if (in_array($key, $fileKeys) && !is_string($value)) continue;
                SiteSetting::setValue($key, $value);
            }

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()]);
        }
    }
}
