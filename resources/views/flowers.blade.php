<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Bunga - Wedding Organizations</title>
    <link rel="stylesheet" href="{{ asset('css/flowers.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=DM+Sans:wght@300;400;500&family=Pinyon+Script&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=DM+Sans:wght@300;400;500&family=Pinyon+Script&display=swap" rel="stylesheet">
    </noscript>
</head>
<body>
    <div class="header-bg">
        <div class="top-nav">
            <div class="nav-left">
                <a href="{{ route('dashboard') }}" class="back-button" title="Kembali ke Dashboard">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                </a>
                <a href="{{ route('profile.edit') }}" class="profile-icon" title="Edit Profil" style="overflow: hidden; display: flex; align-items: center; justify-content: center; text-decoration: none; color: inherit;">
                    @auth
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset(Auth::user()->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
                        @else
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                        @endif
                    @else
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                    @endauth
                </a>
            </div>
            <div class="menu-icon" id="toggleRight">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </div>
    </div>

    <!-- Overlay -->
    <div class="overlay" id="overlay"></div>

    <!-- Left Sidebar -->
    <aside class="sidebar sidebar-left" id="leftSidebar">
        <p class="sidebar-label">Jelajahi</p>
        <ul class="sidebar-menu">
            <li><a href="{{ route('dashboard') }}">Beranda</a></li>
            <li><a href="{{ route('venues.index') }}">Gedung</a></li>
            <li><a href="{{ route('flowers.index') }}">Vendor</a></li>
        </ul>
    </aside>

    <!-- Right Sidebar -->
    <aside class="sidebar sidebar-right" id="rightSidebar">
        <p class="sidebar-label" style="text-align:right">Akun</p>
        <ul class="sidebar-menu">
            @auth
                <li><p style="padding: 12px 28px; font-size: 0.8rem; color: #888; text-align: right;">{{ Auth::user()->name }}</p></li>
                <li><a href="{{ route('orders') }}">Pemesanan Saya</a></li>
                <li><a href="{{ route('logout') }}" class="danger" style="color: #c0445e;" onclick="localStorage.removeItem('wo_cart')">Keluar</a></li>
            @else
                <li><a href="{{ route('login') }}">Masuk</a></li>
                <li><a href="{{ route('register') }}">Daftar</a></li>
            @endauth
        </ul>
    </aside>

    <script>
        const leftSB  = document.getElementById('leftSidebar');
        const rightSB = document.getElementById('rightSidebar');
        const overlay = document.getElementById('overlay');
        const openSidebar = sb => { sb.classList.add('active'); overlay.classList.add('active'); };
        const closeAll    = ()  => { leftSB.classList.remove('active'); rightSB.classList.remove('active'); overlay.classList.remove('active'); };

        document.getElementById('toggleRight').addEventListener('click', e => {
            e.stopPropagation();
            rightSB.classList.contains('active') ? closeAll() : openSidebar(rightSB);
        });
        overlay.addEventListener('click', closeAll);
    </script>

    @php
        $categoryMap = [
            'katering' => 'Katering',
            'dekorasi' => 'Dekorasi',
            'mua'      => 'MUA & Hair',
            'busana'   => 'Busana',
            'dokumentasi' => 'Dokumentasi',
            'hiburan'  => 'Hiburan',
            'undangan' => 'Undangan',
            'kue'      => 'Kue',
            'cincin'   => 'Cincin',
            'transport' => 'Transport'
        ];
        $selectedCategory = request('category');
        $categoryName = $categoryMap[$selectedCategory] ?? 'Vendor Pilihan';
    @endphp

    <main>
        <div class="sticky-controls" style="padding-top: 20px;">
            <div class="search-container" style="margin-top: 10px;">
        <form action="{{ route('flowers.index') }}" method="GET" class="search-box-inline">
            <input type="hidden" name="category" value="{{ request('category') }}">
            <input type="text" name="q" placeholder="Cari nama atau jasa vendor..." value="{{ request('q') }}">
            <input type="text" name="location" placeholder="Lokasi..." value="{{ request('location') }}">
            <button type="submit">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
            </button>
        </form>
    </div>
            <div class="search-container" style="margin-bottom: 20px;">
                <div class="search-input">{{ request('date_start', date('Y-m-d')) }}</div>
                <div class="search-input">{{ request('date_end', date('Y-m-d', strtotime('+1 day'))) }}</div>
            </div>

            <div class="filter-container">
                <a href="{{ route('flowers.index', request()->except('category')) }}" class="filter-pill {{ !$selectedCategory ? 'active' : '' }}">Semua</a>
                @foreach($categoryMap as $key => $label)
                    <a href="{{ route('flowers.index', array_merge(request()->query(), ['category' => $key])) }}" class="filter-pill {{ $selectedCategory == $key ? 'active' : '' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>

        <div class="main-content">
            <h2 class="section-title">{{ $categoryName }} Terbaik Untuk Anda</h2>

            <div class="venue-grid">
                @foreach($vendors as $index => $vendor)
                <div data-url="{{ route('flowers.show', array_merge(['id' => $vendor['id']], request()->query())) }}" class="venue-card clickable-card" style="cursor: pointer; position: relative; text-decoration: none; color: inherit;">
                    <div class="image-container">
                        <img src="{{ $vendor['image'] }}" alt="{{ $vendor['name'] }}" loading="lazy">
                        
                        {{-- Tombol ikon keranjang di kartu --}}
                        @php
                            $vPrice    = 'IDR ' . number_format((float)($vendor['price'] ?? 0), 0, ',', '.');
                            $vname     = addslashes($vendor['name']);
                            $vlocation = addslashes($vendor['location']);
                        @endphp
                        <button
                            class="card-cart-btn"
                            style="position: absolute; right: 10px; top: 10px; z-index: 9999; pointer-events: auto;"
                            id="cartbtn-vendor-{{ $vendor['id'] }}"
                            title="Simpan ke Keranjang"
                            data-id="{{ $vendor['id'] }}"
                            data-type="vendor"
                            data-name="{{ $vname }}"
                            data-price="{{ $vPrice }}"
                            data-location="{{ $vlocation }}"
                            data-image="{{ $vendor['image'] }}"
                        >
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                        </button>

                        <!-- Navigation dots -->
                        <div class="dots-container">
                            <span class="dot active"></span>
                            <span class="dot"></span>
                            <span class="dot"></span>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="venue-header">
                            <span class="venue-name">{{ $vendor['name'] }}</span>
                            <span class="owner-name text-muted">{{ $vendor['owner'] }}</span>
                        </div>
                        <p class="venue-location">{{ $vendor['location'] }}</p>
                        <div class="venue-price-tag">
                            IDR {{ number_format((float)($vendor['price'] ?? 0), 0, ',', '.') }} / Malam
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </main>
    @auth
    <script src="{{ asset('js/cart.js') }}"></script>
    @endauth
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Event delegation untuk kartu 
            document.querySelectorAll('.clickable-card').forEach(card => {
                card.addEventListener('click', function(e) {
                    // Cek jika targetnya adalah tombol atau berada DI DALAM tombol
                    const cartBtn = e.target.closest('.card-cart-btn');
                    
                    if (cartBtn) {
                        e.preventDefault();
                        e.stopPropagation();
                        // cart.js global listener yg kita tambahkan akan menangkap trigger klik ini 
                        return;
                    }
                    
                    // Jika yang diklik bukan tombol keranjang (misalnya klik gambar / judul), ke URL 
                    window.location.href = this.dataset.url;
                });
            });
        });
    </script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
