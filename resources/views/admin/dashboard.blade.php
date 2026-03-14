<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel — Wedding Organizations</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin_dashboard.css') }}">
</head>
<body>
<div class="app">
    <!-- ═══════════════════════════════════════════
       SIDEBAR
    ═══════════════════════════════════════════ -->
    <aside class="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-brand">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/></svg>
                <span class="sidebar-brand-name">Wedding Org</span>
            </div>
            <div class="sidebar-role">Administrator</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-section-label">Menu Utama</div>
            <a class="nav-item active" onclick="switchTab('dashboard', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="7" height="7"/><rect x="14" y="3" width="7" height="7"/><rect x="14" y="14" width="7" height="7"/><rect x="3" y="14" width="7" height="7"/></svg>
                Dashboard
            </a>
            <a class="nav-item" onclick="switchTab('venue', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg>
                Venue
            </a>
            <a class="nav-item" onclick="switchTab('vendor', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                Vendor
            </a>
            <a class="nav-item" onclick="switchTab('pricing', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg>
                Harga & Paket
            </a>

            <div class="nav-section-label">Transaksi</div>
            <a class="nav-item" onclick="switchTab('orders', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="9" cy="21" r="1"/><circle cx="20" cy="21" r="1"/><path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"/></svg>
                Pesanan
                <span class="nav-badge">0</span>
            </a>
            <a class="nav-item" onclick="switchTab('users', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                Pengguna
            </a>
            <a class="nav-item" onclick="switchTab('promos', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"/><line x1="7" y1="7" x2="7.01" y2="7"/></svg>
                Promo & Voucher
            </a>
            <a class="nav-item" onclick="switchTab('ratings', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                Rating Customer
            </a>
            <a class="nav-item" onclick="switchTab('sarans', this)">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path><line x1="9" y1="10" x2="15" y2="10"></line><line x1="12" y1="7" x2="12" y2="13"></line></svg>
                Saran Customer
            </a>
        </nav>

        <div class="sidebar-footer">
            <div class="sidebar-user">
                <div class="avatar">A</div>
                <div class="sidebar-user-info">
                    <div class="sidebar-user-name">Administrator</div>
                    <div class="sidebar-user-email">admin@wedding.com</div>
                </div>
            </div>
            <a href="{{ route('logout') }}" class="nav-item" style="color:var(--danger); margin-top:10px; padding: 10px 12px; border-radius: 6px; background: rgba(192,97,78,0.05); border: 1px solid rgba(192,97,78,0.1);">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/><polyline points="16 17 21 12 16 7"/><line x1="21" y1="12" x2="9" y2="12"/></svg>
                Keluar Website
            </a>
        </div>
    </aside>

    <!-- ═══════════════════════════════════════════
       MAIN CONTENT
    ═══════════════════════════════════════════ -->
    <main class="main">
        <!-- Topbar -->
        <header class="topbar">
            <div class="topbar-left">
                <h1 class="page-title" id="pageTitle">Dashboard <em>Overview</em></h1>
            </div>
            <div class="topbar-right">
                <button class="topbar-btn">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"/><path d="M13.73 21a2 2 0 0 1-3.46 0"/></svg>
                    Notifikasi
                </button>
                <button class="topbar-btn primary" onclick="openAddModal()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                    Tambah Baru
                </button>
            </div>
        </header>

        <div class="content">

            <!-- ── DASHBOARD TAB ── -->
            <div class="tab-panel active" id="tab-dashboard">
                <div class="stats-row">
                    <div class="stat-card">
                        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/></svg></div>
                        <div class="stat-label">Total Venue</div>
                        <div class="stat-value">5</div>
                        <div class="stat-sub">+1 bulan ini</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg></div>
                        <div class="stat-label">Total Vendor</div>
                        <div class="stat-value">4</div>
                        <div class="stat-sub">Semua aktif</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg></div>
                        <div class="stat-label">Pesanan Baru</div>
                        <div class="stat-value">0</div>
                        <div class="stat-sub">Belum ada pesanan</div>
                    </div>
                    <div class="stat-card">
                        <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"/><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"/></svg></div>
                        <div class="stat-label">Pendapatan</div>
                        <div class="stat-value">Rp 0</div>
                        <div class="stat-sub">+0% bulan ini</div>
                    </div>
                </div>

                <div class="section-header">
                    <h2 class="section-title">Venue <em>Terbaru</em></h2>
                </div>
                <div class="items-grid" id="dashVenueGrid">
                    <!-- populated by JS -->
                </div>
            </div>

            <!-- ── VENUE TAB ── -->
            <div class="tab-panel" id="tab-venue">
                <div class="section-header">
                    <h2 class="section-title">Manajemen <em>Venue</em></h2>
                    <div class="section-actions" style="gap:16px">
                        <!-- BULK ACTION BAR -->
                        <div style="display:flex; align-items:center; gap:12px;">
                            <label style="display:flex; align-items:center; gap:8px; font-size:0.8rem; cursor:pointer; color:var(--muted); font-weight:500;" id="selectAllWrap-venue">
                                <input type="checkbox" id="selectAll-venue" onchange="toggleSelectAll('venue')" style="accent-color:var(--danger); width:16px; height:16px;">
                                Pilih Semua
                            </label>
                            <div class="bulk-action" id="bulk-venue">
                                <span class="bulk-text" id="bulkText-venue">0 terpilih</span>
                                <button class="bulk-btn" onclick="bulkDelete('venue')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                        <div class="search-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                            <input type="text" class="search-input" placeholder="Cari venue…" oninput="filterCards(this, 'venueGrid')">
                        </div>
                        <button class="btn-add" onclick="openModal('modalVenue')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <span>Tambah Venue</span>
                        </button>
                    </div>
                </div>
                <div class="items-grid" id="venueGrid">
                    <!-- populated by JS -->
                </div>
            </div>

            <!-- ── VENDOR TAB ── -->
            <div class="tab-panel" id="tab-vendor">
                <div class="section-header">
                    <h2 class="section-title">Manajemen <em>Vendor</em></h2>
                    <div class="section-actions" style="gap:16px">
                        <!-- BULK ACTION BAR -->
                        <div style="display:flex; align-items:center; gap:12px;">
                            <label style="display:flex; align-items:center; gap:8px; font-size:0.8rem; cursor:pointer; color:var(--muted); font-weight:500;" id="selectAllWrap-vendor">
                                <input type="checkbox" id="selectAll-vendor" onchange="toggleSelectAll('vendor')" style="accent-color:var(--danger); width:16px; height:16px;">
                                Pilih Semua
                            </label>
                            <div class="bulk-action" id="bulk-vendor">
                                <span class="bulk-text" id="bulkText-vendor">0 terpilih</span>
                                <button class="bulk-btn" onclick="bulkDelete('vendor')">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                                    Hapus
                                </button>
                            </div>
                        </div>
                        <div class="search-wrap">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
                            </svg>
                            <input type="text" class="search-input" placeholder="Cari vendor…" oninput="filterCards(this, 'vendorGrid')">
                        </div>
                        <button class="btn-add" onclick="openModal('modalVendor')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <span>Tambah Vendor</span>
                        </button>
                    </div>
                </div>
                <div class="items-grid" id="vendorGrid">
                    <!-- populated by JS -->
                </div>
            </div>

            <!-- ── PRICING TAB ── -->
            <div class="tab-panel" id="tab-pricing">
                <div class="section-header">
                    <h2 class="section-title">Pengaturan <em>Harga</em></h2>
                    <div class="section-actions">
                        <button class="btn-add" onclick="openModal('modalPricing')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                            </svg>
                            <span>Tambah Paket Harga</span>
                        </button>
                    </div>
                </div>

                <!-- Venue Pricing -->
                <div class="section-header" style="margin-top:0;margin-bottom:12px">
                    <h3 style="font-family:'Cormorant Garamond',serif;font-size:1rem;color:var(--muted);font-weight:400;letter-spacing:0.05em;">
                        Harga <em style="font-style:italic;color:var(--gold-deep)">Venue</em>
                    </h3>
                </div>

                <div class="pricing-table fade-in">
                    <div class="pricing-table-header">
                        <th>Nama Venue</th>
                        <th>Kapasitas</th>
                        <th>Harga Dasar</th>
                        <th>Diskon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </div>
                    <div id="venuePricingRows">
                        <!-- populated by JS -->
                    </div>
                </div>

                <!-- Vendor Pricing -->
                <div class="section-header" style="margin-top:28px;margin-bottom:12px">
                    <h3 style="font-family:'Cormorant Garamond',serif;font-size:1rem;color:var(--muted);font-weight:400;letter-spacing:0.05em;">
                        Harga <em style="font-style:italic;color:var(--rose)">Vendor</em>
                    </h3>
                </div>

                <div class="pricing-table fade-in">
                    <div class="pricing-table-header">
                        <th>Nama Vendor</th>
                        <th>Kategori</th>
                        <th>Harga Dasar</th>
                        <th>Diskon</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </div>
                    <div id="vendorPricingRows">
                        <!-- populated by JS -->
                    </div>
                </div>
            </div>

            <!-- ── ORDERS TAB ── -->
            <div class="tab-panel" id="tab-orders">
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/><polyline points="14 2 14 8 20 8"/></svg>
                    <h3>Modul Pesanan</h3>
                    <p>Halaman ini sedang dalam pengembangan.<br>Segera hadir.</p>
                </div>
            </div>

            <!-- ── USERS TAB ── -->
            <div class="tab-panel" id="tab-users">
                <div class="empty-state">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                    <h3>Manajemen Pengguna</h3>
                    <p>Halaman ini sedang dalam pengembangan.<br>Segera hadir.</p>
                </div>
            </div>

            <!-- ── PROMOS TAB ── -->
            <div class="tab-panel" id="tab-promos">
                <div class="section-header">
                    <h2 class="section-title">Manajemen <em>Promo & Voucher</em></h2>
                    <div class="section-actions">
                        <button class="btn-add" onclick="openModal('modalPromo')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
                            <span>Buat Promo Baru</span>
                        </button>
                    </div>
                </div>
                <div class="pricing-table fade-in">
                    <div class="pricing-table-header">
                        <th>Kode Promo</th>
                        <th>Tipe</th>
                        <th>Nilai Diskon</th>
                        <th>Batas Guna</th>
                        <th>Terpakai</th>
                        <th>Kadaluarsa</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </div>
                    <div id="promoRows">
                        <!-- populated by JS -->
                    </div>
                </div>
            </div>


    <!-- ── RATINGS TAB ── -->
    <div class="tab-panel" id="tab-ratings">
        <div class="section-header">
            <h2 class="section-title">Rating &amp; <em>Ulasan Customer</em></h2>
        </div>
        
        <div class="reviews-list">
            @forelse($ratings as $rating)
            <div class="review-card fade-in">
                <div class="user-avatar">
                    {{ strtoupper(substr($rating->is_anonymous ? 'A' : ($rating->user->name ?? 'U'), 0, 1)) }}
                </div>
                <div class="review-content">
                    <div class="review-meta">
                        <div>
                            <div class="review-user-name">
                                {{ $rating->is_anonymous ? 'Customer Anonim' : ($rating->user->name ?? 'User #'.$rating->user_id) }}
                            </div>
                            <div class="review-target">
                                Memberikan ulasan untuk 
                                <strong style="color:var(--gold-deep)">
                                    @if($rating->venue_id) Venue #{{$rating->venue_id}} 
                                    @elseif($rating->vendor_id) Vendor #{{$rating->vendor_id}}
                                    @else Layanan Umum @endif
                                </strong>
                            </div>
                        </div>
                        <div class="review-stars">
                            @for($i=0; $i<5; $i++)
                            <svg viewBox="0 0 24 24" width="16" height="16" fill="{{ $i < $rating->overall_rating ? 'currentColor' : 'rgba(0,0,0,0.05)' }}">
                                <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                            </svg>
                            @endfor
                        </div>
                    </div>
                    <div class="review-text">
                        {{ $rating->review_text }}
                    </div>
                    <div class="review-footer">
                        <div class="review-date">
                            Dikirim pada {{ $rating->created_at->format('d F Y') }}
                        </div>
                        <span class="pricing-badge {{ $rating->is_approved ? 'badge-active' : 'badge-inactive' }}">
                            {{ $rating->is_approved ? 'Published' : 'Pending Review' }}
                        </span>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                <h3>Belum Ada Rating</h3>
                <p>Ulasan dari customer Anda akan muncul di sini secara otomatis.</p>
            </div>
            @endforelse
        </div>
    </div>

    <!-- ── SARANS TAB ── -->
    <div class="tab-panel" id="tab-sarans">
        <div class="section-header">
            <h2 class="section-title">Saran &amp; <em>Masukan</em></h2>
        </div>

        <div class="sarans-list">
            @forelse($sarans as $saran)
            <div class="review-card fade-in" style="border-left: 4px solid var(--gold);">
                <div class="user-avatar" style="background: var(--ink); color: var(--gold);">
                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                </div>
                <div class="review-content">
                    <div class="review-meta">
                        <div>
                            <span class="category-tag">{{ $saran->category }}</span>
                            <div class="saran-title" style="margin-top:8px">{{ $saran->title }}</div>
                        </div>
                        <span class="pricing-badge {{ $saran->status === 'read' ? 'badge-active' : 'badge-inactive' }}">
                            {{ $saran->status === 'read' ? 'Terbaca' : 'Pesan Baru' }}
                        </span>
                    </div>
                    <div class="review-text" style="font-style: normal; color: var(--ink-muted); padding-left:0; border-left:none">
                        {{ $saran->content ?? 'Tidak ada detail pesan.'}}
                    </div>
                    <div class="review-footer">
                        <div class="review-date">
                            Diterima pada {{ $saran->created_at->format('d M Y, H:i') }}
                        </div>
                        <button class="btn-xs" style="border-radius: 20px; padding: 4px 15px;">Tandai Dibaca</button>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                <h3>Kotak Saran Kosong</h3>
                <p>Belum ada masukan atau saran dari pelanggan Anda.</p>
            </div>
            @endforelse
        </div>
    </div>

        </div><!-- /content -->
    </main>
</div><!-- /app -->


<!-- ════════════════════ MODAL VENUE ════════════════════ -->
<div class="modal-backdrop" id="modalVenue">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h2 class="modal-title" id="modalVenueTitle">Tambah <em>Venue</em></h2>
            <button class="modal-close" onclick="closeModal('modalVenue')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Venue</label>
                    <input type="text" class="form-control" placeholder="cth. Grand Ballroom Surabaya" id="venueNameInput">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori</label>
                    <select class="form-control" name="category" id="venueCategoryInput">
                        <option value="">Pilih kategori…</option>
                        <option value="taman">Taman / Outdoor</option>
                        <option value="pulau">Pulau / Tepi Laut</option>
                        <option value="resort">Resort / Hotel</option>
                        <option value="gedung">Gedung / Ballroom</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi</label>
                <textarea class="form-control" name="about" id="venueAboutInput" placeholder="Deskripsikan venue secara singkat dan menarik…"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kapasitas (Pax)</label>
                    <input type="number" name="capacity" id="venueCapacityInput" class="form-control" placeholder="cth. 500">
                </div>
                <div class="form-group">
                    <label class="form-label">Kota / Lokasi</label>
                    <input type="text" name="location" id="venueLocationInput" class="form-control" placeholder="cth. Surabaya, Jawa Timur">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Harga Dasar (Rp)</label>
                    <div class="input-prefix-wrap">
                        <div class="input-prefix">Rp</div>
                        <input type="number" name="price" placeholder="0" id="venuePriceInput">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Diskon (%)</label>
                    <input type="number" name="discount" id="venueDiscountInput" class="form-control" placeholder="0" min="0" max="100">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Fasilitas</label>
                <input type="text" name="features" id="venueFeaturesInput" class="form-control" placeholder="cth. AC, Parkir, Catering, Sound System (pisahkan dengan koma)">
            </div>
            <div class="form-group">
                <label class="form-label">Foto Venue</label>
                <div class="upload-zone" id="venueUploadZone" onclick="document.getElementById('venueFileInput').click()">
                    <input type="file" id="venueFileInput" name="images[]" multiple accept="image/*" style="display:none" onchange="handleFileUpload(this, 'venuePreviewGrid')">
                    <div class="upload-zone-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </div>
                    <div class="upload-zone-title">Unggah Foto Venue</div>
                    <div class="upload-zone-sub">Klik atau seret file ke sini · JPG, PNG · Maks. 5MB</div>
                </div>
                <div class="img-preview-grid" id="venuePreviewGrid"></div>
            </div>
            <div class="form-group">
                <div class="toggle-wrap">
                    <span class="toggle-label">Tampilkan sebagai <strong>Featured</strong></span>
                    <label class="toggle">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="toggle-wrap">
                    <span class="toggle-label">Status <strong>Aktif</strong> (terlihat oleh pengguna)</span>
                    <label class="toggle">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-xs" onclick="closeModal('modalVenue')">Batal</button>
            <button class="btn-xs primary" onclick="saveVenue()">Simpan Venue</button>
        </div>
    </div>
</div>

<!-- ════════════════════ MODAL VENDOR ════════════════════ -->
<div class="modal-backdrop" id="modalVendor">
    <div class="modal modal-lg">
        <div class="modal-header">
            <h2 class="modal-title" id="modalVendorTitle">Tambah <em>Vendor</em></h2>
            <button class="modal-close" onclick="closeModal('modalVendor')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Nama Vendor / Usaha</label>
                    <input type="text" class="form-control" placeholder="cth. Elegance Photography Studio" id="vendorNameInput">
                </div>
                <div class="form-group">
                    <label class="form-label">Kategori Layanan</label>
                    <select class="form-control" name="type" id="vendorCategoryInput">
                        <option value="">Pilih kategori…</option>
                        <option value="Fotografer">Fotografer</option>
                        <option value="Videografer">Videografer</option>
                        <option value="Katering">Katering</option>
                        <option value="Dekorasi & Florist">Dekorasi & Florist</option>
                        <option value="Makeup Artist">Makeup Artist</option>
                        <option value="MC & Entertainment">MC & Entertainment</option>
                        <option value="Busana Pengantin">Busana Pengantin</option>
                        <option value="Undangan & Souvenir">Undangan & Souvenir</option>
                        <option value="Wedding Organizer">Wedding Organizer</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Deskripsi Layanan</label>
                <textarea class="form-control" name="about" id="vendorAboutInput" placeholder="Ceritakan keunggulan layanan vendor ini…"></textarea>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Kontak / WhatsApp</label>
                    <input type="text" name="phone" id="vendorPhoneInput" class="form-control" placeholder="cth. 08123456789">
                </div>
                <div class="form-group">
                    <label class="form-label">Kota Operasional</label>
                    <input type="text" name="location" id="vendorLocationInput" class="form-control" placeholder="cth. Surabaya">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Harga Mulai Dari (Rp)</label>
                    <div class="input-prefix-wrap">
                        <div class="input-prefix">Rp</div>
                        <input type="number" name="price" placeholder="0" id="vendorPriceInput">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Diskon (%)</label>
                    <input type="number" name="discount" id="vendorDiscountInput" class="form-control" placeholder="0" min="0" max="100">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Paket Layanan</label>
                <input type="text" name="features" id="vendorFeaturesInput" class="form-control" placeholder="cth. Paket Silver, Paket Gold, Paket Platinum (pisahkan koma)">
            </div>
            <div class="form-group">
                <label class="form-label">Portofolio / Foto Layanan</label>
                <div class="upload-zone" onclick="document.getElementById('vendorFileInput').click()">
                    <input type="file" id="vendorFileInput" name="images[]" multiple accept="image/*" style="display:none" onchange="handleFileUpload(this, 'vendorPreviewGrid')">
                    <div class="upload-zone-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                            <polyline points="21 15 16 10 5 21"/>
                        </svg>
                    </div>
                    <div class="upload-zone-title">Unggah Portofolio</div>
                    <div class="upload-zone-sub">Klik atau seret file ke sini · JPG, PNG · Maks. 5MB</div>
                </div>
                <div class="img-preview-grid" id="vendorPreviewGrid"></div>
            </div>
            <div class="form-group">
                <div class="toggle-wrap">
                    <span class="toggle-label">Tampilkan sebagai <strong>Featured</strong></span>
                    <label class="toggle">
                        <input type="checkbox">
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
            <div class="form-group">
                <div class="toggle-wrap">
                    <span class="toggle-label">Status <strong>Aktif</strong> (terlihat oleh pengguna)</span>
                    <label class="toggle">
                        <input type="checkbox" checked>
                        <span class="toggle-slider"></span>
                    </label>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-xs" onclick="closeModal('modalVendor')">Batal</button>
            <button class="btn-xs primary" onclick="saveVendor()">Simpan Vendor</button>
        </div>
    </div>
</div>

<!-- ════════════════════ MODAL PRICING ════════════════════ -->
<div class="modal-backdrop" id="modalPricing">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Tambah <em>Paket Harga</em></h2>
            <button class="modal-close" onclick="closeModal('modalPricing')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Tipe</label>
                <select class="form-control">
                    <option>Venue</option>
                    <option>Vendor</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Pilih Item</label>
                <select class="form-control">
                    <option>Grand Ballroom Surabaya</option>
                    <option>The Ritz Garden</option>
                    <option>Elegance Photography</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Nama Paket</label>
                <input type="text" class="form-control" placeholder="cth. Paket Hari Kerja, Paket Akhir Pekan">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Harga (Rp)</label>
                    <div class="input-prefix-wrap">
                        <div class="input-prefix">Rp</div>
                        <input type="number" placeholder="0">
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label">Diskon (%)</label>
                    <input type="number" class="form-control" placeholder="0" min="0" max="100">
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Berlaku Hingga</label>
                <input type="date" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Catatan</label>
                <textarea class="form-control" placeholder="Syarat dan ketentuan harga…" style="min-height:70px"></textarea>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-xs" onclick="closeModal('modalPricing')">Batal</button>
            <button class="btn-xs primary" onclick="showToast('Paket harga berhasil disimpan', 'success'); closeModal('modalPricing')">Simpan Paket</button>
        </div>
    </div>


<!-- ════════════════════ MODAL DELETE CONFIRM ════════════════════ -->
<div class="modal-backdrop" id="modalDelete">
    <div class="modal modal-sm">
        <div class="modal-body" style="text-align:center;padding:36px 28px">
            <div class="confirm-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                    <polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/>
                    <path d="M10 11v6"/><path d="M14 11v6"/>
                    <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2"/>
                </svg>
            </div>
            <div class="confirm-title">Hapus <span id="deleteItemName">item</span>?</div>
            <p class="confirm-desc">Tindakan ini tidak dapat dibatalkan.<br>Data akan dihapus secara permanen.</p>
        </div>
        <div class="modal-footer">
            <button class="btn-xs" onclick="closeModal('modalDelete')">Batal</button>
            <button class="btn-xs danger" onclick="confirmDelete()">Ya, Hapus</button>
        </div>
    </div>
</div>

<!-- ════════════════════ MODAL PROMO ════════════════════ -->
<div class="modal-backdrop" id="modalPromo">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Buat <em>Promo Baru</em></h2>
            <button class="modal-close" onclick="closeModal('modalPromo')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Kode Promo</label>
                <input type="text" class="form-control" placeholder="cth. MERDEKA20" id="promoCodeInput" style="text-transform:uppercase">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tipe Diskon</label>
                    <select class="form-control" id="promoTypeInput">
                        <option value="percentage">Persentase (%)</option>
                        <option value="fixed">Nominal (Rp)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai Diskon</label>
                    <input type="number" class="form-control" placeholder="0" id="promoValueInput">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Batas Penggunaan</label>
                    <input type="number" class="form-control" placeholder="Kosongkan jika tidak ada batas" id="promoLimitInput">
                </div>
                <div class="form-group">
                    <label class="form-label">Kadaluarsa</label>
                    <input type="date" class="form-control" id="promoExpiryInput">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-xs" onclick="closeModal('modalPromo')">Batal</button>
            <button class="btn-xs primary" onclick="savePromo()">Buat Promo</button>
        </div>
    </div>
</div>

<!-- ════════════════════ MODAL PROMO ════════════════════ -->
<div class="modal-backdrop" id="modalPromo">
    <div class="modal">
        <div class="modal-header">
            <h2 class="modal-title">Buat <em>Promo Baru</em></h2>
            <button class="modal-close" onclick="closeModal('modalPromo')">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>
        <div class="modal-body">
            <div class="form-group">
                <label class="form-label">Kode Promo</label>
                <input type="text" class="form-control" placeholder="cth. MERDEKA20" id="promoCodeInput" style="text-transform:uppercase">
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Tipe Diskon</label>
                    <select class="form-control" id="promoTypeInput">
                        <option value="percentage">Persentase (%)</option>
                        <option value="fixed">Nominal (Rp)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label class="form-label">Nilai Diskon</label>
                    <input type="number" class="form-control" placeholder="0" id="promoValueInput">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label">Batas Penggunaan</label>
                    <input type="number" class="form-control" placeholder="Kosongkan jika tidak ada batas" id="promoLimitInput">
                </div>
                <div class="form-group">
                    <label class="form-label">Kadaluarsa</label>
                    <input type="date" class="form-control" id="promoExpiryInput">
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn-xs" onclick="closeModal('modalPromo')">Batal</button>
            <button class="btn-xs primary" onclick="savePromo()">Buat Promo</button>
        </div>
    </div>
</div>

<!-- ════════════════════ TOAST ════════════════════ -->
<div class="toast-wrap" id="toastWrap"></div>

<script>
/* ═══════════════════════════════════════
   DATA
═══════════════════════════════════════ */
const VENUE_IMAGES = [
    'https://images.unsplash.com/photo-1519167758481-83f550bb49b3?w=600&q=75&auto=format',
    'https://images.unsplash.com/photo-1464366400600-7168b8af9bc3?w=600&q=75&auto=format',
    'https://images.unsplash.com/photo-1531058020387-3be344556be6?w=600&q=75&auto=format',
    'https://images.unsplash.com/photo-1578922746465-3a80a228f223?w=600&q=75&auto=format',
    'https://images.unsplash.com/photo-1606216840988-92fd20e0d6a0?w=600&q=75&auto=format',
];

const VENDOR_IMAGES = [
    'https://images.unsplash.com/photo-1511285560929-80b456fea0bc?w=600&q=75&auto=format',
    'https://images.unsplash.com/photo-1519741497674-611481863552?w=600&q=75&auto=format',
    'https://images.unsplash.com/photo-1529636444744-adffc9135a5e?w=600&q=75&auto=format',
    'https://images.unsplash.com/photo-1481214110143-ed630356e1bb?w=600&q=75&auto=format',
];

let venues = {!! json_encode($venues) !!};
let vendors = {!! json_encode($vendors) !!};


let deleteTarget = null;

/* ═══════════════════════════════════════
   TAB NAVIGATION
═══════════════════════════════════════ */
const pageTitles = {
    dashboard: 'Dashboard <em>Overview</em>',
    venue:     'Manajemen <em>Venue</em>',
    vendor:    'Manajemen <em>Vendor</em>',
    pricing:   'Pengaturan <em>Harga</em>',
    orders:    'Daftar <em>Pesanan</em>',
    users:     'Manajemen <em>Pengguna</em>',
    promos:    'Manajemen <em>Promo & Voucher</em>',
    ratings:   'Rating <em>Customer</em>',
    sarans:    'Saran <em>Customer</em>',
};

function switchTab(tab, btn) {
    document.querySelectorAll('.tab-panel').forEach(p => p.classList.remove('active'));
    document.querySelectorAll('.nav-item').forEach(n => n.classList.remove('active'));
    
    // Safety check for tab existence
    const targetTab = document.getElementById('tab-' + tab);
    if (!targetTab) return;

    targetTab.classList.add('active');
    
    // Handle Sidebar Button Active State
    if (btn) {
        btn.classList.add('active');
    } else {
        // If triggered via code (init), find the matching button
        const navItems = document.querySelectorAll('.nav-item');
        navItems.forEach(nav => {
            if (nav.getAttribute('onclick') && nav.getAttribute('onclick').includes(`'${tab}'`)) {
                nav.classList.add('active');
            }
        });
    }

    document.getElementById('pageTitle').innerHTML = pageTitles[tab] || tab;
    
    // Save to localStorage for persistence
    localStorage.setItem('adminActiveTab', tab);

    if (tab === 'venue' || tab === 'dashboard') renderVenueGrid();
    if (tab === 'vendor') renderVendorGrid();
    if (tab === 'pricing') renderPricingTables();
    if (tab === 'promos') fetchPromos();
}

let promos = [];

function fetchPromos() {
    fetch('{{ route("admin.promos") }}')
        .then(res => res.json())
        .then(data => {
            promos = data;
            renderPromoTable();
        });
}

function renderPromoTable() {
    const el = document.getElementById('promoRows');
    if (!el) return;
    el.innerHTML = promos.map(p => `
        <div class="pricing-row">
            <td><strong>${p.code}</strong></td>
            <td>${p.type === 'percentage' ? 'Persentase' : 'Nominal'}</td>
            <td>${p.type === 'percentage' ? p.reward_value + '%' : 'Rp ' + parseInt(p.reward_value).toLocaleString()}</td>
            <td>${p.usage_limit || '∞'}</td>
            <td>${p.usage_count}</td>
            <td>${p.expires_at ? new Date(p.expires_at).toLocaleDateString() : '—'}</td>
            <td><span class="pricing-badge badge-active">Aktif</span></td>
            <td>
                <div class="pricing-actions">
                    <button class="btn-xs danger" onclick="deletePromo(${p.id})">Hapus</button>
                </div>
            </td>
        </div>
    `).join('');
}

function savePromo() {
    const data = {
        code: document.getElementById('promoCodeInput').value.toUpperCase(),
        type: document.getElementById('promoTypeInput').value,
        reward_value: document.getElementById('promoValueInput').value,
        usage_limit: document.getElementById('promoLimitInput').value,
        expires_at: document.getElementById('promoExpiryInput').value,
    };

    if (!data.code || !data.reward_value) {
        showToast('Data belum lengkap', 'danger');
        return;
    }

    fetch('{{ route("admin.promos.store") }}', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify(data)
    })
    .then(res => res.json())
    .then(res => {
        showToast(res.message, 'success');
        closeModal('modalPromo');
        fetchPromos();
    })
    .catch(err => showToast('Gagal membuat promo', 'danger'));
}

function deletePromo(id) {
    if (!confirm('Hapus promo ini?')) return;
    fetch('/admin/promos/delete/' + id, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(res => res.json())
    .then(res => {
        showToast(res.message, 'success');
        fetchPromos();
    });
}

function openAddModal() {
    const active = document.querySelector('.tab-panel.active').id;
    if (active === 'tab-venue')   openModal('modalVenue');
    else if (active === 'tab-vendor')  openModal('modalVendor');
    else if (active === 'tab-pricing') openModal('modalPricing');
    else openModal('modalVenue');
}

/* ═══════════════════════════════════════
   RENDER CARDS
═══════════════════════════════════════ */
function fmtPrice(n) {
    if (n >= 1000000) return 'Rp ' + (n/1000000).toFixed(0) + 'jt';
    if (n >= 1000)    return 'Rp ' + (n/1000).toFixed(0) + 'rb';
    return 'Rp ' + n.toLocaleString('id-ID');
}

function fmtFull(n) {
    return 'Rp ' + n.toLocaleString('id-ID');
}

function statusBadge(s) {
    const map = { active:'badge-active', inactive:'badge-inactive', featured:'badge-featured' };
    const label = { active:'Aktif', inactive:'Nonaktif', featured:'Featured' };
    return `<span class="pricing-badge ${map[s]}">${label[s]}</span>`;
}

function statusDot(item) {
    const dot = item.featured ? 'featured' : item.status;
    const label = item.featured ? 'Featured' : (item.status === 'active' ? 'Aktif' : 'Nonaktif');
    return `<div class="item-card-status"><div class="status-dot ${dot}"></div><span style="font-size:0.6rem;color:var(--muted-lt)">${label}</span></div>`;
}

function venueCard(v) {
    const finalPrice = v.price * (1 - v.discount/100);
    return `
    <div class="item-card" data-name="${v.name.toLowerCase()}" style="position:relative">
        <input type="checkbox" class="card-checkbox chk-venue" value="${v.id}" onchange="toggleBulk('venue')">
        <div class="item-card-img-wrap">
            <img src="${v.img}" alt="${v.name}" loading="lazy">
            <div class="item-card-img-count">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                ${v.photos} foto
            </div>
        </div>
        <div class="item-card-body">
            <div class="item-card-category">${v.category} · ${v.city}</div>
            <div class="item-card-name">${v.name}</div>
            <div class="item-card-desc">${v.desc}</div>
            <div class="item-card-price">
                ${fmtPrice(finalPrice)} <span>/ sesi · Kap. ${v.capacity} pax</span>
                ${v.discount > 0 ? `<span style="color:var(--rose);font-family:'Jost',sans-serif;font-size:0.68rem;margin-left:6px;background:rgba(176,84,104,0.08);padding:2px 6px;border-radius:4px">-${v.discount}%</span>` : ''}
            </div>
            <div class="item-card-footer">
                <button class="btn-icon" onclick="editVenue(${v.id})">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit
                </button>
                <button class="btn-icon" onclick="manageImages(${v.id}, 'venue')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    Foto
                </button>
                <button class="btn-icon danger" onclick="openDelete('venue', ${v.id}, '${v.name}')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                    Hapus
                </button>
                ${statusDot(v)}
            </div>
        </div>
    </div>`;
}

function vendorCard(v) {
    const unit = v.category === 'Katering' ? '/pax' : '/layanan';
    return `
    <div class="item-card" data-name="${v.name.toLowerCase()}" style="position:relative">
        <input type="checkbox" class="card-checkbox chk-vendor" value="${v.id}" onchange="toggleBulk('vendor')">
        <div class="item-card-img-wrap">
            <img src="${v.img}" alt="${v.name}" loading="lazy">
            <div class="item-card-img-count">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                ${v.photos} foto
            </div>
        </div>
        <div class="item-card-body">
            <div class="item-card-category">${v.category} · ${v.city}</div>
            <div class="item-card-name">${v.name}</div>
            <div class="item-card-desc">${v.desc}</div>
            <div class="item-card-price">
                Mulai ${fmtPrice(v.price)} <span>${unit}</span>
                ${v.discount > 0 ? `<span style="color:var(--rose);font-family:'Jost',sans-serif;font-size:0.68rem;margin-left:6px;background:rgba(176,84,104,0.08);padding:2px 6px;border-radius:4px">-${v.discount}%</span>` : ''}
            </div>
            <div class="item-card-footer">
                <button class="btn-icon" onclick="editVendor(${v.id})">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit
                </button>
                <button class="btn-icon" onclick="manageImages(${v.id}, 'vendor')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                    Foto
                </button>
                <button class="btn-icon danger" onclick="openDelete('vendor', ${v.id}, '${v.name}')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6"/></svg>
                    Hapus
                </button>
                ${statusDot(v)}
            </div>
        </div>
    </div>`;
}

function renderVenueGrid() {
    const el = document.getElementById('venueGrid');
    if (el) el.innerHTML = venues.map(venueCard).join('');
    const dash = document.getElementById('dashVenueGrid');
    if (dash) dash.innerHTML = venues.slice(0,3).map(venueCard).join('');
}

function renderVendorGrid() {
    const el = document.getElementById('vendorGrid');
    if (el) el.innerHTML = vendors.map(vendorCard).join('');
}

function renderPricingTables() {
    document.getElementById('venuePricingRows').innerHTML = venues.map(v => {
        const final = v.price * (1 - v.discount/100);
        return `
        <div class="pricing-row">
            <td>${v.name}</td>
            <td>${v.capacity} pax</td>
            <td class="pricing-price" id="vp-${v.id}">${fmtFull(v.price)}</td>
            <td>${v.discount > 0 ? `<span style="color:var(--rose);font-weight:500">${v.discount}%</span>` : '—'}</td>
            <td>${statusBadge(v.featured ? 'featured' : v.status)}</td>
            <td>
                <div class="pricing-actions">
                    <button class="btn-xs" onclick="inlineEditPrice('v', ${v.id})">Edit Harga</button>
                    <button class="btn-xs danger" onclick="openDelete('venue', ${v.id}, '${v.name}')">Hapus</button>
                </div>
            </td>
        </div>`;
    }).join('');

    document.getElementById('vendorPricingRows').innerHTML = vendors.map(v => `
        <div class="pricing-row">
            <td>${v.name}</td>
            <td>${v.category}</td>
            <td class="pricing-price" id="vdp-${v.id}">${fmtFull(v.price)}</td>
            <td>${v.discount > 0 ? `<span style="color:var(--rose);font-weight:500">${v.discount}%</span>` : '—'}</td>
            <td>${statusBadge(v.featured ? 'featured' : v.status)}</td>
            <td>
                <div class="pricing-actions">
                    <button class="btn-xs" onclick="inlineEditPrice('vd', ${v.id})">Edit Harga</button>
                    <button class="btn-xs danger" onclick="openDelete('vendor', ${v.id}, '${v.name}')">Hapus</button>
                </div>
            </td>
        </div>
    `).join('');
}

/* ═══════════════════════════════════════
   INLINE PRICE EDIT
═══════════════════════════════════════ */
function inlineEditPrice(type, id) {
    const elId = (type === 'v' ? 'vp-' : 'vdp-') + id;
    const cell = document.getElementById(elId);
    const arr  = type === 'v' ? venues : vendors;
    const item = arr.find(x => x.id === id);
    if (!item) return;

    cell.innerHTML = `
        <div style="display:flex;gap:6px;align-items:center">
            <input class="price-input" type="number" value="${item.price}" id="pricefield-${id}">
            <button class="btn-xs primary" onclick="saveInlinePrice('${type}', ${id})">✓</button>
        </div>`;
    document.getElementById('pricefield-' + id).focus();
}

function saveInlinePrice(type, id) {
    const val = parseInt(document.getElementById('pricefield-' + id).value, 10);
    const arr = type === 'v' ? venues : vendors;
    const item = arr.find(x => x.id === id);
    if (item && val > 0) {
        item.price = val;
        showToast(`Harga "${item.name}" berhasil diperbarui`, 'success');
    }
    renderPricingTables();
}

/* ═══════════════════════════════════════
   MODAL
═══════════════════════════════════════ */
function openModal(id) {
    document.getElementById(id).classList.add('open');
}

function closeModal(id) {
    document.getElementById(id).classList.remove('open');
}

document.querySelectorAll('.modal-backdrop').forEach(b => {
    b.addEventListener('click', e => {
        if (e.target === b) b.classList.remove('open');
    });
});

document.addEventListener('keydown', e => {
    if (e.key === 'Escape') document.querySelectorAll('.modal-backdrop.open').forEach(b => b.classList.remove('open'));
});

/* ═══════════════════════════════════════
   EDIT / DELETE
═══════════════════════════════════════ */
function editVenue(id) {
    const v = venues.find(x => x.id === id);
    if (!v) return;
    document.getElementById('modalVenueTitle').innerHTML = `Edit <em>Venue</em>`;
    document.getElementById('venueNameInput').value  = v.name;
    document.getElementById('venuePriceInput').value = v.price;
    openModal('modalVenue');
}

function editVendor(id) {
    const v = vendors.find(x => x.id === id);
    if (!v) return;
    document.getElementById('modalVendorTitle').innerHTML = `Edit <em>Vendor</em>`;
    document.getElementById('vendorNameInput').value  = v.name;
    document.getElementById('vendorPriceInput').value = v.price;
    openModal('modalVendor');
}

function manageImages(id, type) {
    const arr = type === 'venue' ? venues : vendors;
    const item = arr.find(x => x.id === id);
    if (!item) return;
    if (type === 'venue') { document.getElementById('modalVenueTitle').innerHTML = `Kelola Foto <em>${item.name}</em>`; openModal('modalVenue'); }
    else { document.getElementById('modalVendorTitle').innerHTML = `Kelola Foto <em>${item.name}</em>`; openModal('modalVendor'); }
}

function openDelete(type, id, name) {
    deleteTarget = { type, id };
    document.getElementById('deleteItemName').textContent = `"${name}"`;
    openModal('modalDelete');
}

function confirmDelete() {
    if (!deleteTarget) return;

    const url = deleteTarget.type === 'venue' ? '{{ route("admin.venues.delete") }}' : '{{ route("admin.vendors.delete") }}';
    
    fetch(url, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ ids: [deleteTarget.id] })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            if (deleteTarget.type === 'venue')  venues  = venues.filter(v => v.id !== deleteTarget.id);
            if (deleteTarget.type === 'vendor') vendors = vendors.filter(v => v.id !== deleteTarget.id);
            
            closeModal('modalDelete');
            renderVenueGrid();
            renderVendorGrid();
            renderPricingTables();
            showToast('Item berhasil dihapus permanen dari database', 'danger');
            deleteTarget = null;
        } else {
            showToast('Gagal menghapus item', 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan koneksi', 'danger');
    });
}

/* ═══════════════════════════════════════
   SAVE (mock)
═══════════════════════════════════════ */
function saveVenue() {
    const name = document.getElementById('venueNameInput').value.trim();
    if (!name) { showToast('Nama venue wajib diisi', 'danger'); return; }

    const formData = new FormData();
    formData.append('name', name);
    formData.append('category', document.getElementById('venueCategoryInput').value);
    formData.append('about', document.getElementById('venueAboutInput').value);
    formData.append('location', document.getElementById('venueLocationInput').value);
    formData.append('price', document.getElementById('venuePriceInput').value);
    formData.append('discount', document.getElementById('venueDiscountInput').value);
    formData.append('features', document.getElementById('venueFeaturesInput').value);
    
    const fileInput = document.getElementById('venueFileInput');
    if (fileInput.files.length > 0) {
        for (let i = 0; i < fileInput.files.length; i++) {
            formData.append('images[]', fileInput.files[i]);
        }
    }

    // CSRF Token
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('{{ route("admin.venues.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(`Venue "${name}" berhasil disimpan ke database`, 'success');
            closeModal('modalVenue');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showToast('Gagal menyimpan venue: ' + (data.message || 'Unknown error'), 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan koneksi', 'danger');
    });
}

function saveVendor() {
    const name = document.getElementById('vendorNameInput').value.trim();
    if (!name) { showToast('Nama vendor wajib diisi', 'danger'); return; }

    const formData = new FormData();
    formData.append('name', name);
    formData.append('type', document.getElementById('vendorCategoryInput').value);
    formData.append('about', document.getElementById('vendorAboutInput').value);
    formData.append('location', document.getElementById('vendorLocationInput').value);
    formData.append('price', document.getElementById('vendorPriceInput').value);
    formData.append('discount', document.getElementById('vendorDiscountInput').value);
    formData.append('features', document.getElementById('vendorFeaturesInput').value);

    const fileInput = document.getElementById('vendorFileInput');
    if (fileInput.files.length > 0) {
        for (let i = 0; i < fileInput.files.length; i++) {
            formData.append('images[]', fileInput.files[i]);
        }
    }

    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    fetch('{{ route("admin.vendors.store") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': csrfToken
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showToast(`Vendor "${name}" berhasil disimpan ke database`, 'success');
            closeModal('modalVendor');
            setTimeout(() => window.location.reload(), 1000);
        } else {
            showToast('Gagal menyimpan vendor: ' + (data.message || 'Unknown error'), 'danger');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        showToast('Terjadi kesalahan koneksi', 'danger');
    });
}

/* ═══════════════════════════════════════
   IMAGE UPLOAD PREVIEW
═══════════════════════════════════════ */
function handleFileUpload(input, gridId) {
    const grid = document.getElementById(gridId);
    const files = Array.from(input.files);
    files.forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = e => {
            const div = document.createElement('div');
            div.className = 'img-preview-item';
            div.innerHTML = `
                <img src="${e.target.result}" alt="preview">
                ${grid.children.length === 0 && i === 0 ? '<div class="img-preview-main-badge">Utama</div>' : ''}
                <button class="img-preview-remove" onclick="this.closest('.img-preview-item').remove()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                </button>`;
            grid.appendChild(div);
        };
        reader.readAsDataURL(file);
    });
}

/* ═══════════════════════════════════════
   BULK ACTIONS
═══════════════════════════════════════ */
function toggleBulk(type) {
    const checkboxes = document.querySelectorAll(`.chk-${type}`);
    const checked = document.querySelectorAll(`.chk-${type}:checked`);
    const bulkDiv = document.getElementById(`bulk-${type}`);
    const bulkText = document.getElementById(`bulkText-${type}`);
    const selectAll = document.getElementById(`selectAll-${type}`);

    if (checked.length > 0) {
        bulkDiv.style.display = 'flex';
        bulkText.innerText = `${checked.length} terpilih`;
        if (selectAll) selectAll.checked = checked.length === checkboxes.length;
    } else {
        bulkDiv.style.display = 'none';
        if (selectAll) selectAll.checked = false;
    }
}

function toggleSelectAll(type) {
    const selectAll = document.getElementById(`selectAll-${type}`);
    if (!selectAll) return;
    const allCards = document.querySelectorAll(`#${type}Grid .item-card`);
    allCards.forEach(card => {
        if (card.style.display !== 'none') {
            const cb = card.querySelector(`.chk-${type}`);
            if (cb) cb.checked = selectAll.checked;
        }
    });
    toggleBulk(type);
}

function bulkDelete(type) {
    const checked = document.querySelectorAll(`.chk-${type}:checked`);
    const ids = Array.from(checked).map(c => parseInt(c.value, 10));
    if (ids.length === 0) return;

    if (confirm(`Anda yakin ingin menghapus ${ids.length} item yang dipilih secara permanen dari database?`)) {
        const url = type === 'venue' ? '{{ route("admin.venues.delete") }}' : '{{ route("admin.vendors.delete") }}';

        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify({ ids: ids })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                if (type === 'venue') venues = venues.filter(v => !ids.includes(v.id));
                if (type === 'vendor') vendors = vendors.filter(v => !ids.includes(v.id));

                showToast(`${ids.length} item berhasil dihapus permanen`, 'success');
                
                if (type === 'venue') renderVenueGrid();
                if (type === 'vendor') renderVendorGrid();
                renderPricingTables();
                
                document.getElementById(`bulk-${type}`).style.display = 'none';
                const selectAll = document.getElementById(`selectAll-${type}`);
                if(selectAll) selectAll.checked = false;
            } else {
                showToast('Gagal menghapus item massal', 'danger');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showToast('Terjadi kesalahan koneksi', 'danger');
        });
    }
}

/* ═══════════════════════════════════════
   SEARCH FILTER
═══════════════════════════════════════ */
function filterCards(input, gridId) {
    const q = input.value.toLowerCase();
    document.querySelectorAll(`#${gridId} .item-card`).forEach(card => {
        card.style.display = card.dataset.name.includes(q) ? '' : 'none';
    });
}

/* ═══════════════════════════════════════
   TOAST
═══════════════════════════════════════ */
function showToast(msg, type = 'success') {
    const wrap = document.getElementById('toastWrap');
    const icons = {
        success: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
        danger:  '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
    };
    const t = document.createElement('div');
    t.className = `toast ${type}`;
    t.innerHTML = `${icons[type] || ''}<span>${msg}</span>`;
    wrap.appendChild(t);
    setTimeout(() => { t.style.opacity='0'; t.style.transform='translateX(20px)'; t.style.transition='all 0.3s'; setTimeout(() => t.remove(), 300); }, 3000);
}

/* ═══════════════════════════════════════
   INIT
   ═══════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', () => {
    // Basic Grid Renders
    renderVenueGrid();
    renderVendorGrid();
    renderPricingTables();

    // Recover Active Tab
    const savedTab = localStorage.getItem('adminActiveTab');
    if (savedTab && pageTitles[savedTab]) {
        switchTab(savedTab);
    } else {
        switchTab('dashboard'); // Default
    }
});
</script>

<script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
