<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SiteSetting;

class SiteSettingsSeeder extends Seeder
{
    /**
     * Seed the application's configuration settings from welcome.blade.php defaults.
     */
    public function run(): void
    {
        $settings = [
            // Branding
            'logo_text' => 'Wedding Organizations',
            'logo_image' => null,

            // Hero Section
            'hero_small_title' => 'The Ultimate Wedding Marketplace',
            'hero_main_title' => 'Wujudkan Pernikahan Impianmu Bersama Kami',
            'hero_subtitle' => 'Temukan venue eksklusif dan rangkaian bunga terindah untuk hari paling spesial dalam hidupmu.',
            'hero_cta_text' => 'Cari Venue',
            'hero_bg_image' => null, // Will use gradient if null

            // Services
            'service_1_title' => 'Layanan Vendor',
            'service_1_desc' => 'perusahaan penyedia layanan dan produk spesifik (seperti katering, dekorasi, dokumentasi, busana, dan venue) yang bekerja sama dengan calon pengantin untuk merencanakan serta melaksanakan pernikahan impian.',
            'service_2_title' => 'Venue Eksklusif',
            'service_2_desc' => 'Akses ke gedung-gedung termewah dan taman outdoor tersembunyi yang siap menyambut tamu spesial Anda.',
            'service_3_title' => 'Booking Mudah',
            'service_3_desc' => 'Pantau semua pesanan dan kelola anggaran pernikahan Anda dalam satu dashboard yang intuitif dan aman.',

            // About Section
            'about_small_title' => 'Siapa Kami',
            'about_main_title' => 'Mengenal Wedding Organizations',
            'about_desc' => 'Kami hadir dengan satu misi utama: mempermudah setiap pasangan untuk mewujudkan hari pernikahan yang tak terlupakan tanpa beban stres. Dengan melakukan kurasi ketat terhadap vendor-vendor terbaik dan menyediakan akses tak terbatas ke daftar venue paling memukau dan eksklusif. Dari ballroom megah di jantung kota hingga taman romantis dengan nuansa alam, tim platform kami siap mendampingi setiap langkah perencanaan pernikahan Anda hingga terwujud menjadi nyata.',

            // Stats
            'stats_1_val' => '100+',
            'stats_1_label' => 'Venue Mitra',
            'stats_2_val' => '50+',
            'stats_2_label' => 'Vendor Pro',
            'stats_3_val' => '5K+',
            'stats_3_label' => 'Pasangan Bahagia',
        ];

        foreach ($settings as $key => $value) {
            SiteSetting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
