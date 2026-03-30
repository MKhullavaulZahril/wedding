<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Organizations — Wujudkan Pernikahan Impianmu</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
</head>
<body class="bg-white">

    <!-- Navbar -->
    <nav class="fixed w-full z-50 bg-white/80 backdrop-blur-md border-b border-pink-50">
        <div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">
            <a href="/" class="flex items-center gap-3">
                @if($logoImg = \App\Models\SiteSetting::getValue('logo_image'))
                    <img src="{{ asset($logoImg) }}" class="h-8 object-contain">
                @else
                    <div class="w-8 h-8 bg-rose rounded-full flex items-center justify-center">
                        <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" width="16" height="16"><path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/></svg>
                    </div>
                @endif
                <h1 data-edit-key="logo_text" class="text-2xl font-bold text-rose tracking-tight leading-none">{{ \App\Models\SiteSetting::getValue('logo_text', 'Wedding Organizations') }}</h1>
            </a>
            <div class="space-x-8 hidden md:flex items-center text-sm font-medium">
                <a href="{{ route('home') }}" class="hover:text-rose transition-colors"><span data-edit-key="nav_link_1">{{ \App\Models\SiteSetting::getValue('nav_link_1', 'Venue') }}</span></a>
                <a href="{{ route('home') }}" class="hover:text-rose transition-colors"><span data-edit-key="nav_link_2">{{ \App\Models\SiteSetting::getValue('nav_link_2', 'Vendor') }}</span></a>
                <a href="#about" class="hover:text-rose transition-colors"><span data-edit-key="nav_link_3">{{ \App\Models\SiteSetting::getValue('nav_link_3', 'About') }}</span></a>
                <a href="#review" class="hover:text-rose transition-colors"><span data-edit-key="nav_link_4">{{ \App\Models\SiteSetting::getValue('nav_link_4', 'Review') }}</span></a>
            </div>
            <!-- Mobile Menu Toggle (Simplified) -->
            <button class="md:hidden text-rose">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-40 pb-32 px-6 relative" 
             @if($heroBg = \App\Models\SiteSetting::getValue('hero_bg_image')) style="background-image: url('{{ asset($heroBg) }}'); background-size: cover; background-position: center;" @endif>
        <div class="hero-pattern" @if(\App\Models\SiteSetting::getValue('hero_bg_image')) style="opacity: 0.1;" @endif></div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span data-edit-key="hero_small_title" class="text-rose font-semibold tracking-widest text-xs uppercase mb-4 block">{{ \App\Models\SiteSetting::getValue('hero_small_title', 'The Ultimate Wedding Marketplace') }}</span>
            <h2 data-edit-key="hero_main_title" class="text-5xl md:text-7xl font-bold mb-8 leading-tight">{!! \App\Models\SiteSetting::getValue('hero_main_title', 'Wujudkan Pernikahan <br><span class="italic text-rose">Impianmu</span> Bersama Kami') !!}</h2>
            <p data-edit-key="hero_subtitle" class="text-lg md:text-xl text-muted mb-10 max-w-2xl mx-auto leading-relaxed">{{ \App\Models\SiteSetting::getValue('hero_subtitle', 'Temukan venue eksklusif dan rangkaian bunga terindah untuk hari paling spesial dalam hidupmu.') }}</p>
            <div class="flex flex-col sm:flex-row justify-center gap-5">
                <a href="{{ route('home') }}" class="btn-premium text-white px-10 py-4 rounded-full font-bold transition-all flex items-center justify-center gap-2 shadow-lg shadow-rose/20">
                    <span data-edit-key="hero_cta_text">{{ \App\Models\SiteSetting::getValue('hero_cta_text', 'Cari Venue') }}</span>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-32 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20">
                <h2 data-edit-key="service_main_title" class="text-4xl font-bold mb-4">{{ \App\Models\SiteSetting::getValue('service_main_title', 'Layanan Kami') }}</h2>
                <p data-edit-key="service_main_desc" class="text-muted max-w-xl mx-auto">{{ \App\Models\SiteSetting::getValue('service_main_desc', 'Kami menyediakan layanan terbaik untuk memastikan pernikahan Anda berjalan sempurna tanpa hambatan.') }}</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="card-feature p-10 rounded-3xl text-center">
                    <div class="w-16 h-16 bg-rose-pale rounded-2xl flex items-center justify-center mx-auto mb-8">
                        <span class="text-3xl text-rose">💐</span>
                    </div>
                    <h3 data-edit-key="service_1_title" class="text-2xl font-bold mb-4 text-[#1e1620]">{{ \App\Models\SiteSetting::getValue('service_1_title', 'Layanan Vendor') }}</h3>
                    <p data-edit-key="service_1_desc" class="text-muted leading-relaxed">{{ \App\Models\SiteSetting::getValue('service_1_desc', 'Layanan untuk merencanakan pernikahan impian Anda.') }}</p>
                </div>
                <div class="card-feature p-10 rounded-3xl text-center">
                    <div class="w-16 h-16 bg-rose-pale rounded-2xl flex items-center justify-center mx-auto mb-8">
                        <span class="text-3xl text-rose">🏛️</span>
                    </div>
                    <h3 data-edit-key="service_2_title" class="text-2xl font-bold mb-4 text-[#1e1620]">{{ \App\Models\SiteSetting::getValue('service_2_title', 'Venue Eksklusif') }}</h3>
                    <p data-edit-key="service_2_desc" class="text-muted leading-relaxed font-normal">{{ \App\Models\SiteSetting::getValue('service_2_desc', 'Akses ke gedung-gedung termewah dan taman outdoor tersembunyi.') }}</p>
                </div>
                <div class="card-feature p-10 rounded-3xl text-center">
                    <div class="w-16 h-16 bg-rose-pale rounded-2xl flex items-center justify-center mx-auto mb-8">
                        <span class="text-3xl text-rose">🛒</span>
                    </div>
                    <h3 data-edit-key="service_3_title" class="text-2xl font-bold mb-4 text-[#1e1620]">{{ \App\Models\SiteSetting::getValue('service_3_title', 'Booking Mudah') }}</h3>
                    <p data-edit-key="service_3_desc" class="text-muted leading-relaxed font-normal">{{ \App\Models\SiteSetting::getValue('service_3_desc', 'Pantau semua pesanan dan kelola anggaran pernikahan Anda.') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 data-edit-key="gallery_title" class="text-3xl font-bold">{{ \App\Models\SiteSetting::getValue('gallery_title', 'Inspirasi Pernikahan') }}</h2>
                    <p data-edit-key="gallery_subtitle" class="text-muted">{{ \App\Models\SiteSetting::getValue('gallery_subtitle', 'Temukan ide terbaik dari koleksi venue dan vendor kami.') }}</p>
                </div>
                <a href="{{ route('home') }}" class="text-rose font-bold text-sm tracking-widest uppercase hover:underline">Lihat Semua</a>
            </div>
            
            @if(isset($featuredVenue))
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 h-[600px]">
                <!-- Large Image (Left) -->
                <a href="{{ route('venues.show', $featuredVenue->id) }}" class="md:col-span-7 relative overflow-hidden rounded-3xl group block shadow-xl transition-all hover:scale-[1.01]">
                    <img src="{{ Str::startsWith($featuredVenue->image, 'http') ? $featuredVenue->image : asset($featuredVenue->image) }}" alt="{{ $featuredVenue->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end p-8">
                        <div>
                            <span class="bg-rose text-white text-[10px] px-3 py-1 rounded-full uppercase font-bold tracking-widest mb-2 inline-block">Venue Utama</span>
                            <h3 class="text-white text-3xl font-bold drop-shadow-lg">{{ $featuredVenue->name }}</h3>
                        </div>
                    </div>
                </a>
                
                <!-- Small Images (Right Grid) -->
                <div class="md:col-span-5 grid grid-cols-2 gap-4 h-full">
                    @foreach($recentItems as $item)
                        @php 
                            $isVenue = class_basename($item) === 'Venue'; 
                            $routeUrl = $isVenue ? route('venues.show', $item->id) : route('flowers.show', $item->id);
                        @endphp
                        <a href="{{ $routeUrl }}" class="relative overflow-hidden rounded-2xl group block shadow-lg">
                            <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset($item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity flex items-end p-4">
                                <h4 class="text-white text-sm font-bold truncate drop-shadow-md">{{ $item->name }}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
            @else
            <!-- Fallback Jika Database Kosong -->
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 h-[600px]">
                <div class="md:col-span-12 flex items-center justify-center bg-gray-100 rounded-3xl">
                    <p class="text-muted">Belum ada inspirasi venue yang ditambahkan.</p>
                </div>
            </div>
            @endif
        </div>
    </section>

    <!-- Reviews Section -->
    <section id="review" class="py-24 px-6 bg-white border-t border-pink-50">
        <div class="max-w-7xl mx-auto">
            <div class="text-center mb-16">
                <span data-edit-key="testimonial_small_title" class="text-rose font-semibold tracking-widest text-xs uppercase mb-4 block">{{ \App\Models\SiteSetting::getValue('testimonial_small_title', 'Testimoni') }}</span>
                <h2 data-edit-key="testimonial_main_title" class="text-4xl font-bold mb-4 text-[#1e1620]">{{ \App\Models\SiteSetting::getValue('testimonial_main_title', 'Apa Kata Mereka?') }}</h2>
                <p data-edit-key="testimonial_desc" class="text-muted max-w-xl mx-auto">{{ \App\Models\SiteSetting::getValue('testimonial_desc', 'Pengalaman nyata dari pasangan yang telah mempercayakan momen bahagia mereka kepada mitra kami.') }}</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                @forelse($ratings as $rating)
                <div class="p-8 border border-pink-50 rounded-3xl bg-rose-pale/10 hover:shadow-xl transition-shadow @if($loop->iteration == 2) relative top-0 md:top-8 @endif">
                    <div class="flex items-center gap-1 mb-4 text-[#e6b800]">
                        @for($i=0; $i<5; $i++)
                        <svg class="w-4 h-4" fill="{{ $i < $rating->overall_rating ? 'currentColor' : 'rgba(0,0,0,0.05)' }}" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        @endfor
                    </div>
                    <p class="text-muted leading-relaxed mb-6 italic">"{{ $rating->review_text }}"</p>
                    <div class="flex items-center gap-4">
                        @php
                            $authorName = $rating->manual_author ?: ($rating->is_anonymous ? 'Customer' : ($rating->user->name ?? 'User'));
                            $initials = '';
                            $parts = explode(' ', $authorName);
                            foreach($parts as $part) {
                                if(strlen($part) > 0) $initials .= strtoupper($part[0]);
                            }
                            $initials = substr($initials, 0, 2);
                        @endphp
                        <div class="w-12 h-12 rounded-full bg-rose flex items-center justify-center text-white font-bold font-['Playfair_Display']">{{ $initials }}</div>
                        <div>
                            <h4 class="font-bold text-[#1e1620]">{{ $authorName }}</h4>
                            @php
                                $target = $rating->manual_target ?: ($rating->venue->name ?? ($rating->vendor->name ?? 'Layanan'));
                            @endphp
                            <p class="text-xs text-muted">Target: {{ $target }}</p>
                        </div>
                    </div>
                </div>
                @empty
                <div class="md:col-span-3 text-center py-12">
                    <p class="text-muted italic">Belum ada testimoni yang dipublikasikan.</p>
                </div>
                @endforelse
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 px-6 bg-rose-pale/30 border-t border-pink-50">
        <div class="max-w-4xl mx-auto text-center">
            <span data-edit-key="about_small_title" class="text-rose font-semibold tracking-widest text-xs uppercase mb-4 block">{{ \App\Models\SiteSetting::getValue('about_small_title', 'Siapa Kami') }}</span>
            <h2 data-edit-key="about_main_title" class="text-4xl font-bold mb-8 text-[#1e1620]">{{ \App\Models\SiteSetting::getValue('about_main_title', 'Mengenal Wedding Organizations') }}</h2>
            <p data-edit-key="about_desc" class="text-lg text-muted leading-relaxed mb-8">
                {{ \App\Models\SiteSetting::getValue('about_desc', 'Kami hadir dengan satu misi utama: mempermudah setiap pasangan untuk mewujudkan hari pernikahan yang tak terlupakan tanpa beban stres.') }}
            </p>
            <div class="flex justify-center flex-wrap gap-12 mt-12 text-center text-rose">
                <div>
                    <h4 data-edit-key="stats_1_val" class="text-4xl font-bold font-['Playfair_Display'] mb-2">{{ \App\Models\SiteSetting::getValue('stats_1_val', '100+') }}</h4>
                    <span data-edit-key="stats_1_label" class="text-xs tracking-widest uppercase text-muted font-bold">{{ \App\Models\SiteSetting::getValue('stats_1_label', 'Venue Mitra') }}</span>
                </div>
                <div>
                    <h4 data-edit-key="stats_2_val" class="text-4xl font-bold font-['Playfair_Display'] mb-2">{{ \App\Models\SiteSetting::getValue('stats_2_val', '50+') }}</h4>
                    <span data-edit-key="stats_2_label" class="text-xs tracking-widest uppercase text-muted font-bold">{{ \App\Models\SiteSetting::getValue('stats_2_label', 'Vendor Pro') }}</span>
                </div>
                <div>
                    <h4 data-edit-key="stats_3_val" class="text-4xl font-bold font-['Playfair_Display'] mb-2">{{ \App\Models\SiteSetting::getValue('stats_3_val', '5K+') }}</h4>
                    <span data-edit-key="stats_3_label" class="text-xs tracking-widest uppercase text-muted font-bold">{{ \App\Models\SiteSetting::getValue('stats_3_label', 'Pasangan Bahagia') }}</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Section -->
    <footer class="bg-[#0f172a] text-white pt-24 pb-12 px-6 relative overflow-hidden">
        <!-- Floating Scroll Up -->
        <a href="#" class="fixed bottom-8 right-8 w-12 h-12 bg-[#f59e0b] rounded-full flex items-center justify-center text-white shadow-lg hover:bg-[#d97706] transition-all z-50">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3" width="20" height="20">
                <polyline points="18 15 12 9 6 15"></polyline>
            </svg>
        </a>

        <div class="max-w-7xl mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-16 mb-20">
                <!-- Brand Profile -->
                <div>
                    <div class="flex items-center gap-3 mb-8">
                        <div class="w-10 h-10 bg-rose rounded-full flex items-center justify-center">
                            @if($logoImg = \App\Models\SiteSetting::getValue('logo_image'))
                                <img src="{{ asset($logoImg) }}" class="h-6 object-contain">
                            @else
                                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" width="20" height="20">
                                    <path d="M12 21.35l-1.45-1.32C5.4 15.36 2 12.28 2 8.5 2 5.42 4.42 3 7.5 3c1.74 0 3.41.81 4.5 2.09C13.09 3.81 14.76 3 16.5 3 19.58 3 22 5.42 22 8.5c0 3.78-3.4 6.86-8.55 11.54L12 21.35z"/>
                                </svg>
                            @endif
                        </div>
                        <h2 class="text-2xl font-bold font-['Playfair_Display']">{!! str_replace('Organizations', '<em class="text-rose not-italic">Organizations</em>', \App\Models\SiteSetting::getValue('logo_text', 'Wedding Organizations')) !!}</h2>
                    </div>
                    <div class="h-1 w-16 bg-gradient-to-r from-rose to-amber-400 mb-8"></div>
                    <p data-edit-key="footer_desc" class="text-slate-400 leading-relaxed text-sm">
                        {{ \App\Models\SiteSetting::getValue('footer_desc', 'Melayani perjalanan kebahagiaan Anda dengan penuh profesionalisme, kenyamanan, dan amanah. Berpengalaman mendampingi ribuan pasangan mewujudkan pernikahan impian dengan pelayanan terbaik dan harga yang tetap terjangkau.') }}
                    </p>
                </div>

                <!-- Contact Info -->
                <div>
                    <h3 class="text-lg font-bold mb-8 flex items-center gap-3">
                        <svg viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" width="20" height="20"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                        Kontak Kami
                    </h3>
                    <ul class="space-y-6 text-sm text-slate-300">
                        <li class="flex items-start gap-4">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" width="18" height="18" class="mt-1 flex-shrink-0"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            <span data-edit-key="contact_address">{{ \App\Models\SiteSetting::getValue('contact_address', 'Jakarta & Sidoarjo, Indonesia') }}</span>
                        </li>
                        <li class="flex items-center gap-4">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#f59e0b" stroke-width="2" width="18" height="18" class="flex-shrink-0"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                            <span data-edit-key="contact_email">{{ \App\Models\SiteSetting::getValue('contact_email', 'info@weddingorganizations.com') }}</span>
                        </li>
                    </ul>
                    <a href="https://wa.me/{{ \App\Models\SiteSetting::getValue('wa_number', '6288989337729') }}" target="_blank" rel="noopener noreferrer" class="mt-10 inline-flex items-center gap-3 bg-[#22c55e] hover:bg-[#16a34a] text-white px-8 py-3 rounded-full font-bold text-sm transition-all shadow-lg shadow-green-500/20">
                        <span>Chat WhatsApp</span>
                    </a>
                </div>

                <!-- Follow Us -->
                <div>
                    <h3 class="text-lg font-bold mb-8">Ikuti Kami</h3>
                    <div class="flex gap-4 mb-10">
                        <a href="https://instagram.com/{{ \App\Models\SiteSetting::getValue('ig_username', 'weddingorg') }}" class="group flex items-center gap-4 bg-slate-800/50 p-4 rounded-xl border border-slate-700 hover:border-rose transition-all flex-1">
                            <div class="w-10 h-10 bg-gradient-to-tr from-[#f9ce34] via-[#ee2a7b] to-[#6228d7] rounded-lg flex items-center justify-center">
                                <svg viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2" width="20" height="20"><rect x="2" y="2" width="20" height="20" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" y1="6.5" x2="17.51" y2="6.5"/></svg>
                            </div>
                            <div class="text-xs">
                                <p class="text-slate-400">Instagram</p>
                                <p data-edit-key="ig_username" class="font-bold">{{ \App\Models\SiteSetting::getValue('ig_username', 'Wedding Org') }}</p>
                            </div>
                        </a>
                        <a href="https://tiktok.com/@{{ \App\Models\SiteSetting::getValue('tiktok_username', 'weddingorg') }}" class="group flex items-center gap-4 bg-slate-800/50 p-4 rounded-xl border border-slate-700 hover:border-rose transition-all flex-1">
                            <div class="w-10 h-10 bg-black rounded-lg flex items-center justify-center">
                                <svg viewBox="0 0 24 24" fill="white" width="18" height="18">
                                    <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.17-2.84-.6-4.13-1.32-.14 2.87-.14 5.74-.01 8.61.16 2.02-.35 4.1-1.8 5.62-1.53 1.68-4.04 2.32-6.27 1.93-2.12-.33-4.1-1.74-5.02-3.66-.99-2.01-.84-4.57.48-6.42a6.3 6.3 0 0 1 1.72-1.73c.01 1.55.03 3.1.04 4.65a2.6 2.6 0 0 0-1.07 3.32c.5 1.05 1.75 1.72 2.9 1.52 1.37-.2 2.45-1.51 2.37-2.89-.04-4.22-.04-8.44-.04-12.66.02-1.43 0-2.86.01-4.29"/>
                                </svg>
                            </div>
                            <div class="text-xs">
                                <p class="text-slate-400">TikTok</p>
                                <p data-edit-key="tiktok_username" class="font-bold">{{ \App\Models\SiteSetting::getValue('tiktok_username', 'Wedding Org') }}</p>
                            </div>
                        </a>
                    </div>

                    <!-- Statistics Small -->
                    <div class="grid grid-cols-3 gap-3">
                        <div class="bg-slate-800/30 p-4 rounded-xl text-center border border-slate-700/50">
                            <p class="text-rose font-bold text-lg leading-none mb-1">5K+</p>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider">Pasangan</p>
                        </div>
                        <div class="bg-slate-800/30 p-4 rounded-xl text-center border border-slate-700/50">
                            <p class="text-rose font-bold text-lg leading-none mb-1">100+</p>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider">Venue</p>
                        </div>
                        <div class="bg-slate-800/30 p-4 rounded-xl text-center border border-slate-700/50">
                            <p class="text-rose font-bold text-lg leading-none mb-1">4.9</p>
                            <p class="text-[10px] text-slate-500 uppercase tracking-wider">Rating</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-800/60 text-center text-xs text-slate-500">
                <p>© {{ date('Y') }} <span class="text-rose font-bold">Wedding Organizations</span>. Semua hak dilindungi.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="//instant.page/5.2.0" type="module"></script>
    <script>
        // Scroll to Top Logic
        const scrollTopBtn = document.querySelector('a[href="#"]');
        if (scrollTopBtn) {
            scrollTopBtn.style.display = 'none';
            window.addEventListener('scroll', () => {
                if (window.scrollY > 500) {
                    scrollTopBtn.style.display = 'flex';
                } else {
                    scrollTopBtn.style.display = 'none';
                }
            });
            scrollTopBtn.addEventListener('click', (e) => {
                e.preventDefault();
                window.scrollTo({ top: 0, behavior: 'smooth' });
            });
        }
    </script>

    @if(isset($editMode) && $editMode)
    <!-- INLINE EDITOR SCRIPTS & STYLES -->
    <style>
        [data-edit-key] {
            outline: 2px dashed rgba(236,72,153, 0.5); /* pink-500 */
            transition: all 0.2s;
            cursor: text;
            position: relative;
        }
        [data-edit-key]:hover, [data-edit-key]:focus {
            outline: 2px solid #ec4899;
            background: rgba(236,72,153,0.05);
        }
        
        /* Floating Toolbar */
        #visual-editor-toolbar {
            position: fixed;
            top: 20px;
            left: 50%;
            transform: translateX(-50%);
            background: #1e293b; /* slate-800 */
            color: white;
            padding: 12px 24px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            gap: 16px;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.5);
            z-index: 99999;
            font-family: 'DM Sans', sans-serif;
            border: 1px solid rgba(255,255,255,0.1);
        }
        .vs-btn {
            background: #ec4899;
            padding: 8px 20px;
            border-radius: 999px;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
            transition: all 0.2s;
            border: none;
            color: white;
        }
        .vs-btn:hover { background: #db2777; }
        .vs-btn-outline {
            background: rgba(255,255,255,0.1);
            color: white;
            text-decoration: none;
            padding: 8px 16px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 500;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }
        .vs-btn-outline:hover { background: rgba(255,255,255,0.2); }
    </style>

    <div id="visual-editor-toolbar">
        <div class="flex items-center gap-2">
            <span class="w-2 h-2 rounded-full bg-green-500 animate-pulse hidden md:block"></span>
            <span class="text-sm font-medium mr-4 hidden md:block">Visual Editor Aktif</span>
        </div>
        <button class="vs-btn" id="vs-save-btn">Simpan Perubahan</button>
        <div class="flex items-center gap-2">
            <a href="{{ route('admin.landing.editor') }}" class="vs-btn-outline group relative" title="Ubah Gambar & Link WhatsApp">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                <span class="hidden md:inline">Pengaturan Lanjut</span>
            </a>
            <a href="{{ route('admin.dashboard') }}" class="vs-btn-outline">
                <svg class="w-4 h-4 md:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path></svg>
                <span class="hidden md:inline">Dashboard</span>
            </a>
        </div>
    </div>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const editables = document.querySelectorAll('[data-edit-key]');
            
            // Enable content editable
            editables.forEach(el => {
                el.contentEditable = "true";
                
                // Mencegah link pindah halaman saat teks diklik (karena ada yang di dalam tag <a>)
                el.addEventListener('click', (e) => {
                    e.preventDefault();
                    e.stopPropagation();
                });

                // Prevent line breaks in items that shouldn't have them
                el.addEventListener('keydown', (e) => {
                    if (e.key === 'Enter' && !el.dataset.editKey.includes('main_title') && !el.dataset.editKey.includes('desc')) {
                        e.preventDefault();
                    }
                });
            });

            // Save functionality
            document.getElementById('vs-save-btn').addEventListener('click', async (e) => {
                const btn = e.target;
                const originalText = btn.innerText;
                btn.innerText = "Menyimpan...";
                btn.style.opacity = '0.7';
                btn.disabled = true;

                const data = {};
                editables.forEach(el => {
                    const key = el.dataset.editKey;
                    if (key === 'hero_main_title') {
                        data[key] = el.innerHTML; // preserve br
                    } else {
                        data[key] = el.innerText.trim();
                    }
                });

                try {
                    const response = await fetch('{{ route('admin.landing.visual.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify(data)
                    });
                    
                    const result = await response.json();
                    if(result.success) {
                        btn.innerText = "Tersimpan ✅";
                        btn.style.background = "#22c55e"; // green-500
                        setTimeout(() => {
                            btn.innerText = originalText;
                            btn.style.background = "#ec4899";
                            btn.style.opacity = '1';
                            btn.disabled = false;
                        }, 2000);
                    } else {
                        alert("Gagal menyimpan: " + (result.message || 'Error'));
                        btn.innerText = originalText;
                        btn.style.opacity = '1';
                        btn.disabled = false;
                    }
                } catch(error) {
                    alert("Terjadi kesalahan sistem.");
                    console.error(error);
                    btn.innerText = originalText;
                    btn.style.opacity = '1';
                    btn.disabled = false;
                }
            });
        });
    </script>
    @endif
</body>
</html>

