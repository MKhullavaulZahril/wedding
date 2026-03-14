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
            <h1 class="text-2xl font-bold text-rose tracking-tight">Wedding <em>Organizations</em></h1>
            <div class="space-x-8 hidden md:flex items-center text-sm font-medium">
                <a href="{{ route('dashboard') }}" class="hover:text-rose transition-colors">Venue</a>
                <a href="{{ route('dashboard') }}" class="hover:text-rose transition-colors">Vendor</a>
                <a href="#about" class="hover:text-rose transition-colors">About</a>
                <a href="#review" class="hover:text-rose transition-colors">Review</a>
            </div>
            <!-- Mobile Menu Toggle (Simplified) -->
            <button class="md:hidden text-rose">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
            </button>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient pt-40 pb-32 px-6 relative">
        <div class="hero-pattern"></div>
        <div class="max-w-4xl mx-auto text-center relative z-10">
            <span class="text-rose font-semibold tracking-widest text-xs uppercase mb-4 block">The Ultimate Wedding Marketplace</span>
            <h2 class="text-5xl md:text-7xl font-bold mb-8 leading-tight">Wujudkan Pernikahan <br><span class="italic text-rose">Impianmu</span> Bersama Kami</h2>
            <p class="text-lg md:text-xl text-muted mb-10 max-w-2xl mx-auto leading-relaxed">Temukan venue eksklusif dan rangkaian bunga terindah untuk hari paling spesial dalam hidupmu.</p>
            <div class="flex flex-col sm:flex-row justify-center gap-5">
                <a href="{{ route('dashboard') }}" class="btn-premium text-white px-10 py-4 rounded-full font-bold transition-all flex items-center justify-center gap-2">
                    Cari Venue
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-32 px-6 bg-white">
        <div class="max-w-6xl mx-auto">
            <div class="text-center mb-20">
                <h2 class="text-4xl font-bold mb-4">Layanan Kami</h2>
                <p class="text-muted max-w-xl mx-auto">Kami menyediakan layanan terbaik untuk memastikan pernikahan Anda berjalan sempurna tanpa hambatan.</p>
            </div>
            <div class="grid md:grid-cols-3 gap-8">
                <div class="card-feature p-10 rounded-3xl text-center">
                    <div class="w-16 h-16 bg-rose-pale rounded-2xl flex items-center justify-center mx-auto mb-8">
                        <span class="text-3xl text-rose">💐</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#1e1620]">Layanan Vendor</h3>
                    <p class="text-muted leading-relaxed">perusahaan penyedia layanan dan produk spesifik (seperti katering, dekorasi, dokumentasi, busana, dan venue) yang bekerja sama dengan calon pengantin untuk merencanakan serta melaksanakan pernikahan impian.</p>
                </div>
                <div class="card-feature p-10 rounded-3xl text-center">
                    <div class="w-16 h-16 bg-rose-pale rounded-2xl flex items-center justify-center mx-auto mb-8">
                        <span class="text-3xl text-rose">🏛️</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#1e1620]">Venue Eksklusif</h3>
                    <p class="text-muted leading-relaxed">Akses ke gedung-gedung termewah dan taman outdoor tersembunyi yang siap menyambut tamu spesial Anda.</p>
                </div>
                <div class="card-feature p-10 rounded-3xl text-center">
                    <div class="w-16 h-16 bg-rose-pale rounded-2xl flex items-center justify-center mx-auto mb-8">
                        <span class="text-3xl text-rose">🛒</span>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-[#1e1620]">Booking Mudah</h3>
                    <p class="text-muted leading-relaxed">Pantau semua pesanan dan kelola anggaran pernikahan Anda dalam satu dashboard yang intuitif dan aman.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section class="py-24 px-6 bg-white">
        <div class="max-w-7xl mx-auto">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h2 class="text-3xl font-bold">Inspirasi Pernikahan</h2>
                    <p class="text-muted">Temukan ide terbaik dari koleksi venue dan vendor kami.</p>
                </div>
                <a href="{{ route('dashboard') }}" class="text-rose font-bold text-sm tracking-widest uppercase hover:underline">Lihat Semua</a>
            </div>
            
            @if(isset($featuredVenue))
            <div class="grid grid-cols-1 md:grid-cols-12 gap-4 h-[600px]">
                <!-- Large Image (Left) -->
                <a href="{{ route('venues.show', $featuredVenue->id) }}" class="md:col-span-7 relative overflow-hidden rounded-3xl group block">
                    <img src="{{ Str::startsWith($featuredVenue->image, 'http') ? $featuredVenue->image : asset($featuredVenue->image) }}" alt="{{ $featuredVenue->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-8">
                        <div>
                            <span class="bg-rose text-white text-[10px] px-3 py-1 rounded-full uppercase font-bold tracking-widest mb-2 inline-block">Venue Utama</span>
                            <h3 class="text-white text-2xl font-bold">{{ $featuredVenue->name }}</h3>
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
                        <a href="{{ $routeUrl }}" class="relative overflow-hidden rounded-2xl group block">
                            <img src="{{ Str::startsWith($item->image, 'http') ? $item->image : asset($item->image) }}" alt="{{ $item->name }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
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
                <span class="text-rose font-semibold tracking-widest text-xs uppercase mb-4 block">Testimoni</span>
                <h2 class="text-4xl font-bold mb-4 text-[#1e1620]">Apa Kata Mereka?</h2>
                <p class="text-muted max-w-xl mx-auto">Pengalaman nyata dari pasangan yang telah mempercayakan momen bahagia mereka kepada mitra kami.</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <!-- Review 1 -->
                <div class="p-8 border border-pink-50 rounded-3xl bg-rose-pale/10 hover:shadow-xl transition-shadow">
                    <div class="flex items-center gap-1 mb-4 text-[#e6b800]">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-muted leading-relaxed mb-6 italic">"Platform ini sangat membantu! Kami menemukan venue Taman yang luar biasa indah dengan harga yang sangat sesuai budget. Semua proses booking berjalan lancar."</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-rose flex items-center justify-center text-white font-bold font-['Playfair_Display']">AD</div>
                        <div>
                            <h4 class="font-bold text-[#1e1620]">Ardi & Dita</h4>
                            <p class="text-xs text-muted">Venue: Bumi Samami</p>
                        </div>
                    </div>
                </div>

                <!-- Review 2 -->
                <div class="p-8 border border-pink-50 rounded-3xl bg-rose-pale/10 hover:shadow-xl transition-shadow relative top-0 md:top-8">
                    <div class="flex items-center gap-1 mb-4 text-[#e6b800]">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-muted leading-relaxed mb-6 italic">"Dari ballroom yang elegan hingga vendor bunga yang profesional, semuanya tersedia di sini. Menghemat banyak waktu kami. Sangat terpercaya dan layanannya memuaskan!"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-rose flex items-center justify-center text-white font-bold font-['Playfair_Display']">RJ</div>
                        <div>
                            <h4 class="font-bold text-[#1e1620]">Reza & Jasmine</h4>
                            <p class="text-xs text-muted">Venue: Grand Ballroom LIPI</p>
                        </div>
                    </div>
                </div>

                <!-- Review 3 -->
                <div class="p-8 border border-pink-50 rounded-3xl bg-rose-pale/10 hover:shadow-xl transition-shadow">
                    <div class="flex items-center gap-1 mb-4 text-[#e6b800]">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                    </div>
                    <p class="text-muted leading-relaxed mb-6 italic">"Resort di Bali yang kami temukan melalui web ini benar-benar memberikan servis bintang lima. Detail dan pelayanannya tidak main-main. Recommended banget!"</p>
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 rounded-full bg-rose flex items-center justify-center text-white font-bold font-['Playfair_Display']">FW</div>
                        <div>
                            <h4 class="font-bold text-[#1e1620]">Fahri & Winda</h4>
                            <p class="text-xs text-muted">Venue: Merusaka Nusa Dua</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 px-6 bg-rose-pale/30 border-t border-pink-50">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-rose font-semibold tracking-widest text-xs uppercase mb-4 block">Siapa Kami</span>
            <h2 class="text-4xl font-bold mb-8 text-[#1e1620]">Mengenal Wedding <em class="text-rose italic">Organizations</em></h2>
            <p class="text-lg text-muted leading-relaxed mb-8">
                Kami hadir dengan satu misi utama: mempermudah setiap pasangan untuk mewujudkan hari pernikahan yang tak terlupakan tanpa beban stres. 
                Dengan melakukan kurasi ketat terhadap vendor-vendor terbaik dan menyediakan akses tak terbatas ke daftar venue paling memukau dan eksklusif. 
                Dari ballroom megah di jantung kota hingga taman romantis dengan nuansa alam, tim platform kami siap mendampingi setiap langkah perencanaan pernikahan Anda hingga terwujud menjadi nyata.
            </p>
            <div class="flex justify-center flex-wrap gap-12 mt-12 text-center text-rose">
                <div>
                    <h4 class="text-4xl font-bold font-['Playfair_Display'] mb-2">100+</h4>
                    <span class="text-xs tracking-widest uppercase text-muted font-bold">Venue Mitra</span>
                </div>
                <div>
                    <h4 class="text-4xl font-bold font-['Playfair_Display'] mb-2">50+</h4>
                    <span class="text-xs tracking-widest uppercase text-muted font-bold">Vendor Pro</span>
                </div>
                <div>
                    <h4 class="text-4xl font-bold font-['Playfair_Display'] mb-2">5K+</h4>
                    <span class="text-xs tracking-widest uppercase text-muted font-bold">Pasangan Bahagia</span>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 text-center bg-white border-t border-pink-50 text-muted">
        <div class="max-w-7xl mx-auto px-6">
            <h2 class="text-2xl font-bold text-rose mb-6">Wedding <em>Organizations</em></h2>
            <div class="flex justify-center gap-8 mb-8 text-sm font-medium">
                <a href="#" class="hover:text-rose transition-colors">Instagram</a>
                <a href="#" class="hover:text-rose transition-colors">Facebook</a>
                <a href="#" class="hover:text-rose transition-colors">Twitter</a>
                <a href="#" class="hover:text-rose transition-colors">Contact</a>
            </div>
            <p class="text-xs tracking-widest uppercase opacity-60">
                © {{ date('Y') }}  Wedding Organizations Marketplace. Crafted with love.
            </p>
        </div>
    </footer>

    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
