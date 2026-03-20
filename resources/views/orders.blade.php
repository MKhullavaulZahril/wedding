<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pemesanan Saya - Wedding Organizations</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,600;1,300;1,400&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/orders.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global-layout.css') }}">
</head>
<body>

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
                <li><a href="{{ Auth::user()->role === 'admin' ? route('admin.dashboard') : route('logout') }}" class="danger" style="color: #c0445e;">{{ Auth::user()->role === 'admin' ? 'Panel Admin' : 'Keluar' }}</a></li>
            @else
                <li><a href="{{ route('login') }}">Masuk</a></li>
                <li><a href="{{ route('register') }}">Daftar</a></li>
            @endauth
        </ul>
    </aside>

    <!-- ══ STICKY TOP SECTION ══════════════════════════════════ -->
    <div class="sticky-top-container">
        <header class="curved-header">
            <div class="header-nav">
                <a href="{{ route('home') }}" class="nav-circle-btn" id="toggleLeft">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                </a>

                <div class="nav-menu-btn" id="toggleRight">
                    <span></span><span></span><span></span>
                </div>
            </div>
            <h1 class="page-title" style="margin-bottom: 10px;">Pemesanan Saya</h1>
        </header>

        <div class="search-area-wrap">
            <div class="orders-container-mini">
                <div class="search-bar-wrap">
                    <form action="{{ route('orders') }}" method="GET" class="order-search-form">
                        <div class="search-input-group">
                            <svg class="search-icon" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/></svg>
                            <input type="text" name="q" placeholder="Cari ID Pesanan atau Nama Venue..." value="{{ request('q') }}">
                        </div>
                        <button type="submit" class="btn-search">Cari</button>
                    </form>
                </div>
            </div>
            <div class="order-filters">
                <a href="{{ route('orders', ['type' => 'all', 'q' => request('q')]) }}" class="filter-pill {{ request('type', 'all') == 'all' ? 'active' : '' }}">Semua</a>
                <a href="{{ route('orders', ['type' => 'venue', 'q' => request('q')]) }}" class="filter-pill {{ request('type') == 'venue' ? 'active' : '' }}">Gedung</a>
                <a href="{{ route('orders', ['type' => 'flower', 'q' => request('q')]) }}" class="filter-pill {{ request('type') == 'flower' ? 'active' : '' }}">Vendor</a>
            </div>
        </div>
    </div>

    <main class="orders-container">

        @if(count($orders) > 0)
            <div class="orders-list">
                @foreach($orders as $order)
                    <div class="order-card">
                        <div class="order-image">
                            <img src="{{ $order['image'] }}" alt="{{ $order['venue_name'] }}">
                            <span class="order-status {{ $order['status_class'] }}">{{ $order['status'] }}</span>
                        </div>
                        <div class="order-details">
                            <div class="order-header">
                                <h3>{{ $order['venue_name'] }}</h3>
                                <span class="order-id">#{{ $order['id'] }}</span>
                            </div>
                            <p class="order-location">
                                <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
                                {{ $order['location'] }}
                            </p>
                            <div class="order-footer">
                                <div class="order-info">
                                    <span class="label">Tanggal Acara</span>
                                    <span class="value">{{ $order['date'] }}</span>
                                </div>
                                <div class="order-info">
                                    <span class="label">Total Pembayaran</span>
                                    <span class="value price">{{ $order['total_price'] }}</span>
                                </div>
                            </div>
                            <div class="order-actions">
                                <a href="{{ route('venues.show', $order['venue_id']) }}" class="btn-detail">Lihat Detail</a>
                                @if($order['status'] == 'Belum Diproses')
                                    <a href="{{ route('checkout', ['venue_id' => $order['venue_id']]) }}" class="btn-pay">Bayar Sekarang</a>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-orders">
                <div class="empty-icon">📂</div>
                <h2>Belum Ada Pemesanan</h2>
                <p>Anda belum memiliki riwayat pemesanan. Mulai jelajahi venue impian Anda sekarang!</p>
                <a href="{{ route('venues.index') }}" class="btn-explore">Jelajahi Venue</a>
            </div>
        @endif
    </main>

    <footer class="simple-footer">
        <p>&copy; 2026 Wedding Organizations. All rights reserved.</p>
    </footer>

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

        // Toggle Left Sidebar (Jelajahi)
        // Note: Tombol kiri adalah ikon kembali, tapi kita tambahkan toggle jika diinginkan
        // Di sini kita biarkan dia sebagai link kembali ke dashboard jika diklik
        // Tapi kita tambahkan listener jika ingin konsisten dengan dashboard
        document.getElementById('toggleRight').addEventListener('click', e => {
            e.stopPropagation();
            rightSidebar.classList.contains('active') ? closeAll() : openSidebar(rightSidebar);
        });

        overlay.addEventListener('click', closeAll);
    </script>

    <!-- Performance Optimization: Instant.page -->
    <script src="//instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipSbmfOOiyv9D41tqtGj73T9MToG+8m/N8eO0vHnF+mX402p99xUqS7B"></script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>

