<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wedding Organizations</title>
    <link rel="preload" href="{{ asset('css/dashboard.css') }}" as="style">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preload" href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=DM+Sans:wght@300;400;500&family=Pinyon+Script&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,500;1,400;1,500&family=DM+Sans:wght@300;400;500&family=Pinyon+Script&display=swap" rel="stylesheet">
    </noscript>
</head>
<body>


<!-- Header -->
<header class="header">
    <a href="{{ route('profile.edit') }}" class="btn-profile" aria-label="Profil" style="overflow: hidden; display: flex; align-items: center; justify-content: center;">
        @auth
            @if(Auth::user()->profile_photo)
                <img src="{{ asset(Auth::user()->profile_photo) }}" style="width: 100%; height: 100%; object-fit: cover; border-radius: 50%;">
            @else
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            @endif
        @else
            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                <circle cx="12" cy="7" r="4"/>
            </svg>
        @endauth
    </a>

    <span class="header-logo">Wedding Organizations</span>

    <button class="btn-hamburger" id="toggleRight" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</header>

<!-- Main -->
<main class="main">

    @if(session('success'))
        <div class="success-alert" style="background: #eefdf5; color: #1a7f4e; padding: 15px 25px; border-radius: 15px; margin: 20px; font-size: 0.85rem; border: 1px solid #d1f7e3; display: flex; align-items: center; gap: 10px; animation: fadeInUp 0.5s ease;">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"></polyline></svg>
            {{ session('success') }}
        </div>
    @endif

    <!-- Hero -->
    <div class="hero">
        <span class="hero-eyebrow">Selamat datang</span>
        <h1 class="hero-title">Wujudkan <em>Hari Istimewa</em><br>Impian Anda</h1>
        <p class="hero-subtitle">Temukan venue & vendor terbaik untuk pernikahan sempurna</p>
        <div class="hero-rule"><div class="hero-rule-diamond"></div></div>
    </div>

    <!-- Search Card -->
    <div class="search-card">
        <div class="tabs">
            <div class="tab active" data-action="venues">Venue</div>
            <div class="tab" data-action="vendors">Vendor</div>
        </div>

        <form id="searchForm" action="{{ route('venues.index') }}" method="GET">

            <!-- Kategori -->
            <div class="field">
                <div class="field-label">Kategori</div>
                <div class="select-wrap">
                    <select name="category" id="categorySelect">
                        <option value="" selected>Semua Kategori</option>
                    </select>
                </div>
            </div>

            <!-- Tanggal -->
            <div class="field">
                <div class="field-label">Tanggal Acara</div>
                <div class="date-row">
                    <input type="date" name="date_start" id="dateStart">
                    <input type="date" name="date_end" id="dateEnd">
                </div>
            </div>

            <!-- Lokasi -->
            <div class="field">
                <div class="field-label">Lokasi</div>
                <input type="text" name="location" id="locationInput" placeholder="Cari kota atau area...">
            </div>

            <div class="divider"><span class="divider-icon">✦</span></div>

            <button type="submit" class="btn-go" id="btnGo">
                <span>Temukan Sekarang</span>
            </button>
        </form>
    </div>


    <p class="footer-text">Crafted with love, designed for forever.</p>
</main>

<div class="bg-layer"></div>
<div class="overlay" id="overlay"></div>

<!-- Left Sidebar -->
<aside class="sidebar sidebar-left" id="leftSidebar">
    <div class="sidebar-inner">
        <p class="sidebar-label">Jelajahi</p>
        <ul class="sidebar-menu">
            <li><a href="{{ route('venues.index') }}">Gedung</a></li>
            <li><a href="{{ route('flowers.index') }}">Vendor</a></li>
            <li><a href="#">Acara</a></li>
            <li><a href="#">Tips &amp; Trik</a></li>
        </ul>
        <div class="sidebar-accent">W</div>
    </div>
</aside>

<!-- Right Sidebar -->
<aside class="sidebar sidebar-right" id="rightSidebar">
    <div class="sidebar-inner">
        <p class="sidebar-label" style="text-align:right">Akun</p>
        <ul class="sidebar-menu">
            @auth
                <li><p style="padding: 12px 28px; font-size: 0.8rem; color: #888; text-align: right;">{{ Auth::user()->name }}</p></li>
                <li><a href="{{ route('orders') }}">Pemesanan Sebelumnya</a></li>
                <li><a href="{{ route('rating') }}">View Rating</a></li>
                <li><a href="{{ route('saran') }}">Saran</a></li>
                <li><a href="{{ route('studycase') }}">Study Case</a></li>
                <li><a href="{{ route('profile.edit') }}">Privasi</a></li>
                <li><a href="{{ route('logout') }}" class="danger" style="color: #c0445e;" onclick="localStorage.removeItem('wo_cart')">Keluar</a></li>
            @else
                <li><a href="{{ route('login') }}">Masuk</a></li>
                <li><a href="{{ route('register') }}">Daftar</a></li>
            @endauth
        </ul>
        <div class="sidebar-accent" style="text-align:right">W</div>
    </div>
</aside>

@auth
<script src="{{ asset('js/cart.js') }}"></script>
@endauth
<script>
    /* ── Sidebar ── */
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

    /* ── Form Logic ── */
    const btnGo      = document.getElementById('btnGo');
    const categoryEl = document.getElementById('categorySelect');
    const dateStartEl= document.getElementById('dateStart');
    const dateEndEl  = document.getElementById('dateEnd');
    const locationEl = document.getElementById('locationInput');
    const tabs       = document.querySelectorAll('.tab');
    const form       = document.getElementById('searchForm');

    const venueOptions = [
        { value: 'gedung',  label: 'Gedung / Ballroom' },
        { value: 'taman',   label: 'Taman / Outdoor' },
        { value: 'resort',  label: 'Resort / Hotel' },
        { value: 'pulau',   label: 'Pulau / Tepi Laut' },
    ];
    const vendorOptions = [
        { value: 'katering',     label: 'Katering' },
        { value: 'dekorasi',     label: 'Dekorasi' },
        { value: 'mua',          label: 'Makeup Artist & Hairstylist' },
        { value: 'busana',       label: 'Busana Pengantin' },
        { value: 'dokumentasi',  label: 'Fotografer & Videografer' },
        { value: 'hiburan',      label: 'Hiburan' },
        { value: 'suvenir',      label: 'Undangan & Suvenir' },
        { value: 'kue',          label: 'Kue Pernikahan' },
        { value: 'cincin',       label: 'Cincin Pernikahan' },
        { value: 'transportasi', label: 'Transportasi & Akomodasi' },
    ];

    function checkFields() {
        const ok = categoryEl.value || locationEl.value.trim();
        btnGo.disabled = !ok;
    }

    function setOptions(list) {
        categoryEl.innerHTML = '<option value="" selected>Semua Kategori</option>';
        list.forEach(({ value, label }) => {
            const o = document.createElement('option');
            o.value = value; o.textContent = label;
            categoryEl.appendChild(o);
        });
        checkFields();
    }

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            const isVendor = tab.dataset.action === 'vendors';
            setOptions(isVendor ? vendorOptions : venueOptions);
            form.action = isVendor ? "{{ route('flowers.index') }}" : "{{ route('venues.index') }}";
        });
    });

    [categoryEl, dateStartEl, dateEndEl, locationEl].forEach(el => {
        el.addEventListener('change', checkFields);
        el.addEventListener('input',  checkFields);
    });

    form.addEventListener('submit', e => {
        if (!categoryEl.value && !locationEl.value.trim()) {
            e.preventDefault();
            alert('Harap isi setidaknya satu kriteria pencarian.');
        }
    });

    /* ── Date Realtime ── */
    const today = new Date().toISOString().split('T')[0];
    dateStartEl.value = today;

    setOptions(venueOptions);
    checkFields();
</script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
