<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Venue - Wedding Organizations</title>
    <link rel="preload" href="{{ asset('css/venues.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/venues.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=DM+Sans:wght@300;400;500&family=Pinyon+Script&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=DM+Sans:wght@300;400;500&family=Pinyon+Script&display=swap" rel="stylesheet">
    </noscript>
    <style>
        /* Skeleton Animation */
        @keyframes skeleton-loading {
            0% { background-position: 100% 50%; }
            100% { background-position: 0 50%; }
        }
        .skeleton {
            background: linear-gradient(90deg, #f2f2f2 25%, #e6e6e6 50%, #f2f2f2 75%);
            background-size: 200% 100%;
            animation: skeleton-loading 1.5s infinite;
            border-radius: 4px;
        }
        .skeleton-text { height: 1rem; margin-bottom: 0.5rem; }
        .skeleton-image { height: 200px; width: 100%; }
    </style>
</head>
<body>
    <div class="header-bg">
        <div class="top-nav">
            <div class="nav-left">
                <a href="{{ route('home') }}" class="back-button" title="Kembali ke Dashboard">
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

            <span class="header-logo">Wedding Organizations</span>

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
            <li><a href="{{ route('home') }}">Beranda</a></li>
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

    <main>

    <div class="main-content">
        @php
            $categoryMap = [
                'gedung' => 'Gedung / Ballroom',
                'taman'  => 'Taman / Outdoor',
                'resort' => 'Resort / Hotel',
                'pulau'  => 'Pulau / Tepi Laut'
            ];
            $selectedCategory = request('category');
            $categoryName = $categoryMap[$selectedCategory] ?? 'Semua Venue';
        @endphp
        
        <div class="sticky-controls" style="padding-top: 20px;">
            <div class="search-container">
                <form action="{{ route('venues.index') }}" method="GET" class="pill-group">
                    <input type="hidden" name="category" value="{{ request('category') }}">
                    
                    {{-- Pill: Start Date --}}
                    <div class="search-pill">
                        <input type="date" name="date_start" value="{{ request('date_start', date('Y-m-d')) }}" onchange="this.form.submit()">
                    </div>

                    {{-- Pill: End Date --}}
                    <div class="search-pill">
                        <input type="date" name="date_end" value="{{ request('date_end', date('Y-m-d', strtotime('+1 day'))) }}" onchange="this.form.submit()">
                    </div>
                </form>
            </div>
        </div>

    <div class="main-content">
        <div class="filter-container">
            <a href="{{ route('venues.index') }}" class="filter-pill {{ !$selectedCategory ? 'active' : '' }}">Semua</a>
            @foreach($categoryMap as $key => $label)
                <a href="{{ route('venues.index', ['category' => $key]) }}" class="filter-pill {{ $selectedCategory == $key ? 'active' : '' }}">
                    {{ $label }}
                </a>
            @endforeach
        </div>

        <h2 class="section-title">Pilihan {{ $categoryName }} Untuk Anda</h2>

        <div class="venue-grid">
            @foreach($venues as $index => $venue)
            <div onclick="window.location.href='{{ route('venues.show', $venue['id']) }}'" class="venue-card" style="cursor: pointer; position: relative; text-decoration: none; color: inherit;">
                <div class="image-container">
                    <img src="{{ $venue['image'] }}" alt="{{ $venue['name'] }}" loading="lazy">
                    
                    <div class="nav-arrow left"><span>&lt;</span></div>
                    <div class="nav-arrow right"><span>&gt;</span></div>

                    {{-- Tombol ikon keranjang di kartu --}}
                    <button 
                        class="card-cart-btn"
                        id="cartbtn-venue-{{ $venue['id'] }}"
                        title="Simpan ke Keranjang"
                        onclick="event.preventDefault(); event.stopPropagation();
                            woCartAdd({
                                id: '{{ $venue['id'] }}',
                                type: 'venue',
                                name: '{{ addslashes($venue['name']) }}',
                                price: '{{ addslashes($venue['price']) }}',
                                location: '{{ addslashes($venue['location']) }}',
                                image: '{{ $venue['image'] }}'
                            });
                            this.classList.add('added');
                            this.innerHTML = '<svg width=\'16\' height=\'16\' viewBox=\'0 0 24 24\' fill=\'none\' stroke=\'currentColor\' stroke-width=\'2.5\'><polyline points=\'20 6 9 17 4 12\'/></svg>';
                        "
                    >
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    </button>
                    
                    <div class="dots-container">
                        <span class="dot {{ $index % 3 == 0 ? 'active' : '' }}"></span>
                        <span class="dot {{ $index % 3 == 1 ? 'active' : '' }}"></span>
                        <span class="dot {{ $index % 3 == 2 ? 'active' : '' }}"></span>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="venue-header">
                        <span class="venue-name">{{ $venue['name'] }}</span>
                        <span class="owner-name text-muted">{{ $venue['owner']['name'] ?? 'Owner' }}</span>
                    </div>
                    <div class="venue-location">
                        {{ $venue['location'] }}
                    </div>
                    <div>
                        <span class="venue-price-tag">{{ $venue['price'] }}</span>
                    </div>
                </div>
            </div>
            @endforeach
    </main>
    
    @auth
    <script src="{{ asset('js/cart.js') }}"></script>
    @endauth
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>

