<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Venue;
use App\Models\Vendor;
use App\Models\Booking;
use Kreait\Firebase\Factory;

class FirebaseSync extends Command
{
    protected $signature   = 'app:firebase-sync';
    protected $description = 'Sync all MySQL data (Users, Venues, Vendors, Bookings) to Firebase Realtime Database';

    public function handle(): void
    {
        $this->info('🔥 Connecting to Firebase…');

        $factory  = (new Factory)
            ->withServiceAccount(base_path(env('FIREBASE_CREDENTIALS')))
            ->withDatabaseUri(env('FIREBASE_DATABASE_URL'));

        $database = $factory->createDatabase();
        
        // Clear root first if it's corrupted (numeric keys at root indicate corruption)
        $this->info('🧹 Cleaning up root database...');
        $database->getReference('/')->remove();

        // ── USERS ────────────────────────────────────────────────────────────
        $this->info('📤 Syncing users…');
        $users = User::all()->keyBy('id')->map(fn ($u) => [
            'id'         => $u->id,
            'name'       => $u->name,
            'email'      => $u->email,
            'google_id'  => $u->google_id,
            'created_at' => (string) $u->created_at,
            'updated_at' => (string) $u->updated_at,
        ])->toArray();

        $database->getReference('users')->set($users);
        $this->info('  ✅ ' . count($users) . ' users synced.');

        // ── VENUES ───────────────────────────────────────────────────────────
        $this->info('📤 Syncing venues…');
        $venues = Venue::all()->keyBy('id')->map(fn ($v) => [
            'id'         => $v->id,
            'name'       => $v->name,
            'owner'      => [
                'name' => $v->owner,
                'image' => 'https://ui-avatars.com/api/?name=' . urlencode($v->owner),
                'bio' => 'Professional venue owner for ' . $v->name
            ],
            'location'   => $v->location,
            'price'      => $v->price,
            'rating'     => '4.8',
            'image'      => $v->image,
            'gallery'    => is_array($v->gallery) ? $v->gallery : json_decode($v->gallery ?? '[]', true),
            'about'      => $v->about,
            'features'   => $v->features,
            'category'   => $v->category,
            'testimonials' => [
                ['text' => 'Pelayanan sangat memuaskan dan tempatnya indah.', 'author' => 'Andi & Budi']
            ],
            'created_at' => (string) $v->created_at,
            'updated_at' => (string) $v->updated_at,
        ])->toArray();

        $database->getReference('venues')->set($venues);
        $this->info('  ✅ ' . count($venues) . ' venues synced.');

        // ── VENDORS ──────────────────────────────────────────────────────────
        $this->info('📤 Syncing vendors…');
        $vendors = Vendor::all()->keyBy('id')->map(fn ($v) => [
            'id'           => $v->id,
            'name'         => $v->name,
            'owner'        => $v->owner,
            'location'     => $v->location,
            'price'        => $v->price,
            'image'        => $v->image,
            'rating'       => $v->rating,
            'type'         => $v->type,
            'about'        => $v->about,
            'features'     => $v->features ?? [],
            'categories'   => $v->categories ?? [],
            'testimonials' => $v->testimonials ?? [],
            'created_at'   => (string) $v->created_at,
            'updated_at'   => (string) $v->updated_at,
        ])->toArray();

        $database->getReference('vendors')->set($vendors);
        $this->info('  ✅ ' . count($vendors) . ' vendors synced.');

        // ── BOOKINGS ─────────────────────────────────────────────────────────
        $this->info('📤 Syncing bookings…');
        $bookings = Booking::all()->keyBy('id')->map(fn ($b) => [
            'id'              => $b->id,
            'user_id'         => $b->user_id,
            'item_type'       => $b->item_type,
            'item_id'         => $b->item_id,
            'status'          => $b->status,
            'total_price'     => $b->total_price,
            'booking_details' => $b->booking_details ?? [],
            'created_at'      => (string) $b->created_at,
            'updated_at'      => (string) $b->updated_at,
        ])->toArray();

        $database->getReference('bookings')->set($bookings);
        $this->info('  ✅ ' . count($bookings) . ' bookings synced.');

        $this->newLine();
        $this->info('🎉 All data successfully synced to Firebase RTDB!');
    }
}
