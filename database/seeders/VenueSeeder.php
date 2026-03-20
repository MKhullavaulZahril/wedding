<?php

namespace Database\Seeders;

use App\Models\Venue;
use Illuminate\Database\Seeder;

class VenueSeeder extends Seeder
{
   public function run(): void
{
    $ballroomDir = '/images/venues/Ballroom/';
    $pulauDir = '/images/venues/Pulau/';
    $resortDir = '/images/venues/Resort/';
    $tamanDir = '/images/venues/Taman/';

    $ballroomGallery = [
        $ballroomDir . 'Aula-Masjid-Manarul-Aman.webp',
        $ballroomDir . 'Balai-Kartini.webp',
        $ballroomDir . 'Balai-Samudera-Kelapa-Gading-Jakarta-Utara.webp',
        $ballroomDir . 'Gedung Sampoerna Strategic Square.jpg',
        $ballroomDir . 'Gedung-Aneka-Bhakti.webp',
        $ballroomDir . 'Graha-Pondok-Pinang-Lebak-Bulus.webp',
        $ballroomDir . 'Grand-Ballroom-LIPI-Kuningan-Barat-Jakarta-Selatan.webp',
        $ballroomDir . 'Lippo-Kuningan-Grand-Ballroom.webp',
        $ballroomDir . 'Pati-Unus-Hall.webp',
        $ballroomDir . 'Smesco-Convention-Hall.webp',
    ];

    $tamanGallery = [
        $tamanDir . 'Bumi Samami.webp',
        $tamanDir . 'Gunung Pancar.webp',
        $tamanDir . 'Taman Langsat.webp',
    ];

    $resortGallery = [
        $resortDir . 'Hotel Ciputra world Surabaya.jpg',
        $resortDir . 'Hotel Dafam Semarang.jpg',
        $resortDir . 'Hotel Neo Candi Semarang.jpg',
        $resortDir . 'Patra Semarang Hotel & Convention.jpg',
        $resortDir . 'Pesonna Hotel Semarang.jpg',
    ];

    $pulauGallery = [
        $pulauDir . 'Merusaka Nusa Dua.jpg',
        $pulauDir . 'Renaissance Bali Nusa Dua.jpg',
        $pulauDir . 'Samabe Bali Suites and Villa.jpg',
        $pulauDir . 'Sofitel Bali Nusa Dua Beach Resort.jpg',
        $pulauDir . 'The Westin Resort Nusa Dua, Bali.jpg',
    ];

    $features = 'Kapasitas besar, parkir luas, sistem pendingin udara pusat, ruang rias pengantin.';

    // LIST DATA DASAR
    $venues = [
        ['name' => 'Aula Masjid Manarul Aman', 'image' => $ballroomDir . 'Aula-Masjid-Manarul-Aman.webp', 'category' => 'Ballroom', 'location' => 'Jakarta'],
        ['name' => 'Balai Kartini', 'image' => $ballroomDir . 'Balai-Kartini.webp', 'category' => 'Ballroom', 'location' => 'Sidoarjo'],
        ['name' => 'Bumi Samami', 'image' => $tamanDir . 'Bumi Samami.webp', 'category' => 'taman', 'location' => 'Bandung'],
        ['name' => 'Hotel Dafam Semarang', 'image' => $resortDir . 'Hotel Dafam Semarang.jpg', 'category' => 'resort', 'location' => 'Semarang'],
        ['name' => 'Merusaka Nusa Dua', 'image' => $pulauDir . 'Merusaka Nusa Dua.jpg', 'category' => 'pulau', 'location' => 'Bali'],
    ];

    $totalData = 100;

    for ($i = 0; $i < $totalData; $i++) {

        $v = $venues[array_rand($venues)];

        $catGallery = match ($v['category']) {
            'gedung' => $ballroomGallery,
            'taman' => $tamanGallery,
            'resort' => $resortGallery,
            'pulau' => $pulauGallery,
            default => [],
        };

        $finalGallery = array_unique(array_merge([$v['image']], $catGallery));

        Venue::create([
            'name' => $v['name'] . ' ' . ($i + 1),
            'owner' => 'Vendor Pernikahan',
            'location' => $v['location'],
            'price' => 'IDR ' . number_format(rand(5, 50), 0, ',', '.') . '.000.000 / Malam',
            'image' => $v['image'],
            'gallery' => array_values($finalGallery),
            'about' => $v['name'] . ' merupakan lokasi impian untuk pernikahan Anda.',
            'features' => $features,
            'category' => $v['category'],
        ]);
    }
}
}
