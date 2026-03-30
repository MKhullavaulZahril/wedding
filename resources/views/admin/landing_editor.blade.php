<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page Editor — Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #f8fafc;
        }

        .form-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.05);
        }

        .input-premium {
            background: #f1f5f9;
            border: 2px solid transparent;
            border-radius: 12px;
            transition: all 0.3s;
        }

        .input-premium:focus {
            background: white;
            border-color: #ec4899;
            box-shadow: 0 0 0 4px rgba(236, 72, 153, 0.1);
            outline: none;
        }

        .btn-save {
            background: linear-gradient(135deg, #db2777 0%, #ec4899 100%);
            box-shadow: 0 10px 20px -5px rgba(219, 39, 119, 0.4);
        }
    </style>
</head>

<body class="p-4 md:p-10">

    <div class="max-w-5xl mx-auto">
        <header class="flex justify-between items-center mb-10">
            <div>
                <h1 class="text-3xl font-bold text-slate-800">Landing Page Editor</h1>
                <p class="text-slate-500">Kelola konten halaman depan.</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('admin.dashboard') }}"
                    class="px-6 py-2 bg-slate-100 border border-slate-200 rounded-full text-sm font-bold text-slate-600 hover:bg-slate-200 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Dashboard
                </a>
                <a href="{{ route('landing') }}" target="_blank"
                    class="px-6 py-2 bg-white border border-slate-200 rounded-full text-sm font-bold text-slate-600 hover:bg-slate-50 transition-all flex items-center gap-2 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    Lihat Situs
                </a>
            </div>
        </header>

        @if(session('success'))
            <div
                class="mb-8 p-4 bg-green-50 border border-green-200 text-green-600 rounded-2xl flex items-center gap-3 animate-bounce">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                </svg>
                <span class="font-bold">{{ session('success') }}</span>
            </div>
        @endif

        <form action="{{ route('admin.landing.update') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Branding Section -->
            <div class="form-card p-8 mb-8">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <span
                        class="w-8 h-8 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center text-sm">01</span>
                    Branding & Logo
                </h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-slate-600 mb-2">Nama Logo (Teks)</label>
                        <input type="text" name="logo_text" value="{{ $settings['logo_text'] ?? '' }}"
                            class="w-full p-4 input-premium">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-600 mb-2">Gambar Logo (Opsional)</label>
                        <input type="file" name="logo_image"
                            class="w-full p-3 input-premium bg-white border-2 border-dashed border-slate-200">
                        @if(isset($settings['logo_image']))
                            <img src="{{ asset($settings['logo_image']) }}" class="mt-4 h-12 object-contain rounded">
                        @endif
                    </div>
                </div>
            </div>

            <!-- Hero Section -->
            <div class="form-card p-8 mb-8">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <span
                        class="w-8 h-8 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center text-sm">02</span>
                    Hero Section (Bagian Atas)
                </h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-600 mb-2">Kategori Kecil (Atas Judul)</label>
                        <input type="text" name="hero_small_title" value="{{ $settings['hero_small_title'] ?? '' }}"
                            class="w-full p-4 input-premium">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-600 mb-2">Judul Utama (Gunakan &lt;br&gt; untuk
                            baris baru)</label>
                        <textarea name="hero_main_title" rows="2"
                            class="w-full p-4 input-premium">{{ $settings['hero_main_title'] ?? '' }}</textarea>
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-600 mb-2">Sub-judul Deskripsi</label>
                        <textarea name="hero_subtitle" rows="3"
                            class="w-full p-4 input-premium">{{ $settings['hero_subtitle'] ?? '' }}</textarea>
                    </div>
                    <div class="grid md:grid-cols-2 gap-8">
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Teks Tombol CTA</label>
                            <input type="text" name="hero_cta_text" value="{{ $settings['hero_cta_text'] ?? '' }}"
                                class="w-full p-4 input-premium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Gambar Latar Hero
                                (Opsional)</label>
                            <input type="file" name="hero_bg_image"
                                class="w-full p-3 input-premium bg-white border-2 border-dashed border-slate-200">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Services Section -->
            <div class="form-card p-8 mb-8">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <span
                        class="w-8 h-8 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center text-sm">03</span>
                    Layanan (3 Kartu Utama)
                </h2>
                <div class="grid md:grid-cols-3 gap-6">
                    <!-- Service 1 -->
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="font-bold text-slate-400 mb-4 text-xs uppercase tracking-widest">Layanan 1</p>
                        <input type="text" name="service_1_title" value="{{ $settings['service_1_title'] ?? '' }}"
                            placeholder="Judul" class="w-full p-3 input-premium mb-4">
                        <textarea name="service_1_desc" rows="4" placeholder="Deskripsi"
                            class="w-full p-3 input-premium">{{ $settings['service_1_desc'] ?? '' }}</textarea>
                    </div>
                    <!-- Service 2 -->
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="font-bold text-slate-400 mb-4 text-xs uppercase tracking-widest">Layanan 2</p>
                        <input type="text" name="service_2_title" value="{{ $settings['service_2_title'] ?? '' }}"
                            placeholder="Judul" class="w-full p-3 input-premium mb-4">
                        <textarea name="service_2_desc" rows="4" placeholder="Deskripsi"
                            class="w-full p-3 input-premium">{{ $settings['service_2_desc'] ?? '' }}</textarea>
                    </div>
                    <!-- Service 3 -->
                    <div class="p-6 bg-slate-50 rounded-2xl border border-slate-100">
                        <p class="font-bold text-slate-400 mb-4 text-xs uppercase tracking-widest">Layanan 3</p>
                        <input type="text" name="service_3_title" value="{{ $settings['service_3_title'] ?? '' }}"
                            placeholder="Judul" class="w-full p-3 input-premium mb-4">
                        <textarea name="service_3_desc" rows="4" placeholder="Deskripsi"
                            class="w-full p-3 input-premium">{{ $settings['service_3_desc'] ?? '' }}</textarea>
                    </div>
                </div>
            </div>

            <!-- About & Stats -->
            <div class="form-card p-8 mb-12">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <span
                        class="w-8 h-8 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center text-sm">04</span>
                    Tentang Kami & Statistik
                </h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-600 mb-2">Judul Tentang Kami</label>
                        <input type="text" name="about_main_title" value="{{ $settings['about_main_title'] ?? '' }}"
                            class="w-full p-4 input-premium">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-slate-600 mb-2">Deskripsi Tentang Kami</label>
                        <textarea name="about_desc" rows="5"
                            class="w-full p-4 input-premium">{{ $settings['about_desc'] ?? '' }}</textarea>
                    </div>
                    <div class="grid grid-cols-3 gap-6">
                        <div>
                            <label class="block text-[10px] uppercase font-bold text-slate-400 mb-1">Stat 1
                                Nilai</label>
                            <input type="text" name="stats_1_val" value="{{ $settings['stats_1_val'] ?? '' }}"
                                class="w-full p-3 input-premium">
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase font-bold text-slate-400 mb-1">Stat 2
                                Nilai</label>
                            <input type="text" name="stats_2_val" value="{{ $settings['stats_2_val'] ?? '' }}"
                                class="w-full p-3 input-premium">
                        </div>
                        <div>
                            <label class="block text-[10px] uppercase font-bold text-slate-400 mb-1">Stat 3
                                Nilai</label>
                            <input type="text" name="stats_3_val" value="{{ $settings['stats_3_val'] ?? '' }}"
                                class="w-full p-3 input-premium">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Footer & Contact -->
            <div class="form-card p-8 mb-12">
                <h2 class="text-xl font-bold text-slate-800 mb-6 flex items-center gap-3">
                    <span
                        class="w-8 h-8 bg-pink-100 text-pink-600 rounded-lg flex items-center justify-center text-sm">05</span>
                    Footer & Kontak
                </h2>
                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-bold text-slate-600 mb-2">Deskripsi Tentang Perusahaan (Mulai
                            Bawah)</label>
                        <textarea name="footer_desc" rows="3"
                            class="w-full p-4 input-premium">{{ $settings['footer_desc'] ?? '' }}</textarea>
                    </div>
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Alamat Lengkap</label>
                            <input type="text" name="contact_address" value="{{ $settings['contact_address'] ?? '' }}"
                                class="w-full p-4 input-premium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Email</label>
                            <input type="email" name="contact_email" value="{{ $settings['contact_email'] ?? '' }}"
                                class="w-full p-4 input-premium">
                        </div>
                    </div>
                    <div class="grid md:grid-cols-3 gap-6">
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Nomor WhatsApp (Awali dgn
                                62)</label>
                            <input type="text" name="wa_number" value="{{ $settings['wa_number'] ?? '' }}"
                                class="w-full p-4 input-premium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Username Instagram</label>
                            <input type="text" name="ig_username" value="{{ $settings['ig_username'] ?? '' }}"
                                class="w-full p-4 input-premium">
                        </div>
                        <div>
                            <label class="block text-sm font-bold text-slate-600 mb-2">Username TikTok</label>
                            <input type="text" name="tiktok_username" value="{{ $settings['tiktok_username'] ?? '' }}"
                                class="w-full p-4 input-premium">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Floating Action Bar -->
            <div class="fixed bottom-8 left-1/2 -translate-x-1/2 z-[100] w-full max-w-lg px-4">
                <button type="submit"
                    class="w-full btn-save text-white py-5 rounded-full font-bold text-lg transition-all hover:scale-105 active:scale-95 flex items-center justify-center gap-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4" />
                    </svg>
                    Simpan Semua Perubahan
                </button>
            </div>
        </form>
    </div>

    <div class="h-32"></div> <!-- Spacer for floating bar -->

</body>

</html>