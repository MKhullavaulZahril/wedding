<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $venue['name'] }} - Wedding Organizations</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/venue-detail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global-layout.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

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
                <li><a href="{{ route('logout') }}" class="danger" style="color: #c0445e;">Keluar</a></li>
            @else
                <li><a href="{{ route('login') }}">Masuk</a></li>
                <li><a href="{{ route('register') }}">Daftar</a></li>
            @endauth
        </ul>
    </aside>

    <!-- --- STICKY SECTION --- -->
    <div class="sticky-top-venue">
        <!-- --- HEADER --- -->
        <header class="header-bg">
            <div class="top-nav">
                <div class="nav-left">
                    <a href="{{ route('venues.index') }}" class="back-button" title="Kembali ke Daftar Venue">
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
        </header>

        <!-- --- DATE INFO --- -->
        <div class="search-pills-row">
            <div class="pill-input">{{ request('date_start', date('Y-m-d')) }}</div>
            <div class="pill-input">{{ request('date_end', date('Y-m-d', strtotime('+1 day'))) }}</div>
        </div>
    </div>

    <main>
    <!-- ══ MAIN CONTENT PANELS ════════════════════════════ -->
    <div class="panels-container">
        
        <!-- PANEL KIRI: Gallery & Core Info -->
        <div class="panel panel-left">
            <div class="venue-showcase">
                <div class="main-gallery-card">
                    <img src="{{ $venue['image'] }}" alt="{{ $venue['name'] }}" loading="lazy">
                    <div class="gallery-arrows">
                        <span class="arr-l">&lt;</span>
                        <span class="arr-r">&gt;</span>
                    </div>
                    <div class="gallery-dots">
                        <span class="d active"></span><span class="d"></span><span class="d"></span>
                    </div>
                </div>

                <div class="venue-meta">
                    <div class="meta-top">
                        <h1 class="venue-name-style">{{ $venue['name'] }}</h1>
                        <div class="rating-tag">{{ $venue['rating'] }} ★</div>
                        <div class="owner-mini-name">{{ $venue['owner']['name'] }}</div>
                    </div>
                    <p class="location-sub">{{ $venue['location'] }}</p>
                    <div class="vendor-action-row">
                        <button class="btn-vendor-contact">Contact Vendor</button>
                    </div>
                </div>

                <div class="secondary-gallery">
                    @foreach(array_slice($venue['gallery'] ?? [], 1, 6) as $img)
                        <div class="gal-item">
                            <img src="{{ $img }}" alt="Preview" loading="lazy">
                        </div>
                    @endforeach
                </div>

                <div class="info-blocks">
                    <div class="info-block">
                        <h3>About</h3>
                        <p>{{ $venue['about'] }}</p>
                    </div>
                    <div class="info-block">
                        <h3>Features</h3>
                        @if(is_array($venue['features']))
                            <p>{{ implode(', ', $venue['features']) }}</p>
                        @else
                            <p>{{ $venue['features'] }}</p>
                        @endif
                    </div>
                </div>
                
                <!-- Re-adding the Price in a nice way if needed, though reference puts it differently -->
                <div class="price-strip">
                    <span class="p-amount">{{ $venue['price'] }}</span>
                    <span class="p-lbl">/ Malam</span>
                    @auth
                        <a href="{{ route('checkout', ['venue_id' => $venue['id']] + request()->query()) }}" class="btn-book-now">Pesan Sekarang</a>
                    @else
                        <a href="{{ route('login', ['redirect_to' => route('checkout', ['venue_id' => $venue['id']] + request()->query())]) }}" class="btn-book-now">Pesan Sekarang</a>
                    @endauth
                </div>

                {{-- Tombol Simpan ke Keranjang --}}
                <button
                    class="btn-add-to-cart"
                    data-id="{{ $venue['id'] }}"
                    data-type="venue"
                    onclick="woCartAdd({
                        id: '{{ $venue['id'] }}',
                        type: 'venue',
                        name: '{{ addslashes($venue['name']) }}',
                        price: '{{ addslashes($venue['price']) }}',
                        location: '{{ addslashes($venue['location']) }}',
                        image: '{{ $venue['image'] }}'
                    }); updateAddButtonState('{{ $venue['id'] }}', 'venue')"
                >
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 2L3 6v14a2 2 0 002 2h14a2 2 0 002-2V6l-3-4z"/><line x1="3" y1="6" x2="21" y2="6"/><path d="M16 10a4 4 0 01-8 0"/></svg>
                    Simpan ke Keranjang
                </button>
            </div>
        </div>

        <!-- PANEL KANAN: Owner, Testimonials, Map -->
        <div class="panel panel-right">
            <div class="section-group">
                <h3 class="panel-section-title">Property owner</h3>
                <div class="owner-premium-card">
                    <div class="owner-avatar">
                        <img src="{{ $venue['owner']['image'] }}" alt="Owner" loading="lazy">
                    </div>
                    <div class="owner-details">
                        <h4>{{ $venue['owner']['name'] }}</h4>
                        <p>{{ $venue['owner']['bio'] }}</p>
                        <button class="btn-contact-vendor-alt">Contact Vendor</button>
                    </div>
                </div>
            </div>

            <div class="section-group testimonial-block">
                <div class="testi-slider">
                    <span class="nav-t">&lt;</span>
                    <div class="testi-text-wrap">
                        <p>"{{ $venue['testimonials'][0]['text'] }}"</p>
                        <span class="testi-author">- {{ $venue['testimonials'][0]['author'] }}</span>
                    </div>
                    <span class="nav-t">&gt;</span>
                </div>
            </div>

            <div class="section-group map-block">
                <div class="modern-map-container">
                    <!-- Placeholder graphic for map as in reference -->
                    <div class="map-artwork-simple">
                        <svg viewBox="0 0 400 240" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect width="400" height="240" fill="#e9f3f8"/>
                            <path d="M0 80h400M0 160h400M120 0v240M280 0v240" stroke="#fff" stroke-width="8"/>
                            <circle cx="210" cy="110" r="10" fill="#c9637a" />
                            <circle cx="210" cy="110" r="20" stroke="#c9637a" stroke-opacity="0.2" stroke-width="5" />
                        </svg>
                        <div class="map-label-overlay">
                            {{ $venue['location'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>

    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        const leftSidebar  = document.getElementById('leftSidebar');
        const rightSidebar = document.getElementById('rightSidebar');
        const overlay      = document.getElementById('overlay');

        function openSidebar(sb) {
            sb.classList.add('active');
            overlay.classList.add('active');
        }
        function closeAll() {
            leftSidebar.classList.remove('active');
            rightSidebar.classList.remove('active');
            overlay.classList.remove('active');
        }

        document.getElementById('toggleRight').addEventListener('click', e => {
            e.stopPropagation();
            rightSidebar.classList.contains('active') ? closeAll() : openSidebar(rightSidebar);
        });
        overlay.addEventListener('click', closeAll);

        // Simple Gallery & Slider logic could be added here
        document.querySelectorAll('.gal-item').forEach(item => {
            item.addEventListener('click', () => {
                const mainImg = document.querySelector('.main-gallery-card img');
                mainImg.src = item.querySelector('img').src;
            });
        });
    </script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
