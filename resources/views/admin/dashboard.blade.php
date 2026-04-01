<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel — Wedding Organizations</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400&family=Jost:wght@300;400;500;600&display=swap"
        rel="stylesheet">
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
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5" />
                    </svg>
                    <span class="sidebar-brand-name">Wedding Org</span>
                </div>
                <div class="sidebar-role">Administrator</div>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-section-label">Menu Utama</div>
                <a class="nav-item active" onclick="switchTab('dashboard', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="7" height="7" />
                        <rect x="14" y="3" width="7" height="7" />
                        <rect x="14" y="14" width="7" height="7" />
                        <rect x="3" y="14" width="7" height="7" />
                    </svg>
                    Dashboard
                </a>
                <a class="nav-item" onclick="switchTab('venue', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                        <polyline points="9 22 9 12 15 12 15 22" />
                    </svg>
                    Venue
                </a>
                <a class="nav-item" onclick="switchTab('vendor', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                        <circle cx="12" cy="7" r="4" />
                    </svg>
                    Vendor
                </a>
                <a class="nav-item" onclick="switchTab('pricing', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="12" y1="1" x2="12" y2="23" />
                        <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                    </svg>
                    Paket
                </a>

                <div class="nav-section-label">Transaksi</div>
                <a class="nav-item" onclick="switchTab('orders', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="9" cy="21" r="1" />
                        <circle cx="20" cy="21" r="1" />
                        <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6" />
                    </svg>
                    Pesanan
                    <span class="nav-badge">{{ count($bookings) }}</span>
                </a>
                <a class="nav-item" onclick="switchTab('users', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                        <circle cx="9" cy="7" r="4" />
                        <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                        <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                    </svg>
                    Pengguna
                </a>
                <a class="nav-item" onclick="switchTab('promos', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                        <line x1="7" y1="7" x2="7.01" y2="7" />
                    </svg>
                    Promo
                </a>
                <a class="nav-item" onclick="switchTab('ratings', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polygon
                            points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                        </polygon>
                    </svg>
                    Rating Customer
                </a>
                <a class="nav-item" onclick="switchTab('sarans', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        <line x1="9" y1="10" x2="15" y2="10"></line>
                        <line x1="12" y1="7" x2="12" y2="13"></line>
                    </svg>
                    Saran Customer
                </a>
                <a class="nav-item" onclick="switchTab('studycase', this)">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                    Study Case
                </a>

                <div class="nav-section-label">Pengaturan</div>
                <a class="nav-item" href="{{ route('admin.landing.visual') }}" style="text-decoration:none;">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <rect x="3" y="3" width="18" height="18" rx="2" />
                        <path d="M3 9h18M9 21V9" />
                    </svg>
                    Landing Page
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
                <a href="{{ route('logout') }}" class="nav-item"
                    style="color:var(--danger); margin-top:10px; padding: 10px 12px; border-radius: 6px; background: rgba(192,97,78,0.05); border: 1px solid rgba(192,97,78,0.1);">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4" />
                        <polyline points="16 17 21 12 16 7" />
                        <line x1="21" y1="12" x2="9" y2="12" />
                    </svg>
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
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9" />
                            <path d="M13.73 21a2 2 0 0 1-3.46 0" />
                        </svg>
                        Notifikasi
                    </button>
                    <button class="topbar-btn primary" onclick="openAddModal()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="12" y1="5" x2="12" y2="19" />
                            <line x1="5" y1="12" x2="19" y2="12" />
                        </svg>
                        Tambah Baru
                    </button>
                </div>
            </header>

            <div class="content">

                <!-- ── DASHBOARD TAB ── -->
                <div class="tab-panel active" id="tab-dashboard">
                    <div class="stats-row">
                        <div class="stat-card">
                            <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z" />
                                    <polyline points="9 22 9 12 15 12 15 22" />
                                </svg></div>
                            <div class="stat-label">Total Venue</div>
                            <div class="stat-value">5</div>
                            <div class="stat-sub">+1 bulan ini</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                                    <circle cx="12" cy="7" r="4" />
                                </svg></div>
                            <div class="stat-label">Total Vendor</div>
                            <div class="stat-value">4</div>
                            <div class="stat-sub">Semua aktif</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                    <polyline points="14 2 14 8 20 8" />
                                </svg></div>
                            <div class="stat-label">Pesanan Baru</div>
                            <div class="stat-value">{{ count($bookings) }}</div>
                            <div class="stat-sub">Total pesanan masuk</div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="2">
                                    <line x1="12" y1="1" x2="12" y2="23" />
                                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6" />
                                </svg></div>
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
                                <label
                                    style="display:flex; align-items:center; gap:8px; font-size:0.8rem; cursor:pointer; color:var(--muted); font-weight:500;"
                                    id="selectAllWrap-venue">
                                    <input type="checkbox" id="selectAll-venue" onchange="toggleSelectAll('venue')"
                                        style="accent-color:var(--danger); width:16px; height:16px;">
                                    Pilih Semua
                                </label>
                                <div class="bulk-action" id="bulk-venue">
                                    <span class="bulk-text" id="bulkText-venue">0 terpilih</span>
                                    <button class="bulk-btn" onclick="bulkDelete('venue')">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            style="width:14px;height:14px;">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                            <div class="search-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                                <input type="text" class="search-input" placeholder="Cari venue…"
                                    oninput="filterCards(this, 'venueGrid')">
                            </div>
                            <button class="btn-add" onclick="openModal('modalVenue')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
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
                                <label
                                    style="display:flex; align-items:center; gap:8px; font-size:0.8rem; cursor:pointer; color:var(--muted); font-weight:500;"
                                    id="selectAllWrap-vendor">
                                    <input type="checkbox" id="selectAll-vendor" onchange="toggleSelectAll('vendor')"
                                        style="accent-color:var(--danger); width:16px; height:16px;">
                                    Pilih Semua
                                </label>
                                <div class="bulk-action" id="bulk-vendor">
                                    <span class="bulk-text" id="bulkText-vendor">0 terpilih</span>
                                    <button class="bulk-btn" onclick="bulkDelete('vendor')">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            style="width:14px;height:14px;">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                            <div class="search-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                                <input type="text" class="search-input" placeholder="Cari vendor…"
                                    oninput="filterCards(this, 'vendorGrid')">
                            </div>
                            <button class="btn-add" onclick="openModal('modalVendor')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
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
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                <span>Tambah Paket Harga</span>
                            </button>
                        </div>
                    </div>

                    <!-- Venue Pricing -->
                    <div class="section-header" style="margin-top:0;margin-bottom:16px">
                        <h3
                            style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;color:var(--muted);font-weight:400;letter-spacing:0.05em;">
                            Daftar Harga <em style="font-style:italic;color:var(--gold-deep)">Venue</em>
                        </h3>
                    </div>

                    <div class="pricing-table-premium fade-in">
                        <div class="pt-header" style="grid-template-columns: 2fr 1fr 1.2fr 1fr 1.2fr;">
                            <div class="pt-header-label">Nama Venue</div>
                            <div class="pt-header-label">Kapasitas</div>
                            <div class="pt-header-label">Harga Dasar</div>
                            <div class="pt-header-label">Status</div>
                            <div class="pt-header-label">Aksi</div>
                        </div>
                        <div id="venuePricingRows">
                            <!-- populated by JS -->
                        </div>
                    </div>

                    <!-- Vendor Pricing -->
                    <div class="section-header" style="margin-top:40px;margin-bottom:16px">
                        <h3
                            style="font-family:'Cormorant Garamond',serif;font-size:1.2rem;color:var(--muted);font-weight:400;letter-spacing:0.05em;">
                            Daftar Harga <em style="font-style:italic;color:var(--rose)">Vendor</em>
                        </h3>
                    </div>

                    <div class="pricing-table-premium fade-in">
                        <div class="pt-header" style="grid-template-columns: 2fr 1.2fr 1.2fr 1fr 1.2fr;">
                            <div class="pt-header-label">Nama Vendor</div>
                            <div class="pt-header-label">Kategori</div>
                            <div class="pt-header-label">Harga Dasar</div>
                            <div class="pt-header-label">Status</div>
                            <div class="pt-header-label">Aksi</div>
                        </div>
                        <div id="vendorPricingRows">
                            <!-- populated by JS -->
                        </div>
                    </div>
                </div>

                <div class="tab-panel" id="tab-users">
                    <div class="section-header">
                        <h2 class="section-title">Manajemen <em>Pengguna</em></h2>
                        <div class="section-actions">
                            <div class="search-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                                <input type="text" class="search-input" placeholder="Cari pengguna…"
                                    oninput="filterCards(this, 'userRows')">
                            </div>
                        </div>
                    </div>

                    <div class="pricing-table fade-in">
                        <div class="pricing-table-header"
                            style="display:grid; grid-template-columns: 0.8fr 2fr 2fr 1fr 1.2fr 1.2fr; align-items:center;">
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                ID User</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Nama Lengkap</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Email</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Role</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Tgl Join</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Aksi</div>
                        </div>
                        <div id="userRows">
                            @foreach($users as $user)
                                <div class="pricing-table-row item-card" id="user-row-{{ $user->id }}"
                                    data-name="{{ strtolower($user->name) }} {{ strtolower($user->email) }}"
                                    style="display:grid; grid-template-columns: 0.8fr 2fr 2fr 1fr 1.2fr 1.2fr; align-items:center; border-bottom:1px solid var(--border-light);">
                                    <div style="padding:15px">#{{ $user->id }}</div>
                                    <div style="padding:15px; font-weight:500;">{{ $user->name }}</div>
                                    <div style="padding:15px; color:var(--muted);">{{ $user->email }}</div>
                                    <div style="padding:15px">
                                        <select class="role-select-premium {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}"
                                            onchange="updateUserRole({{ $user->id }}, this)">
                                            <option value="user" {{ ($user->role ?? 'user') === 'user' ? 'selected' : '' }}>
                                                User</option>
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                Admin</option>
                                        </select>
                                    </div>
                                    <div style="padding:15px; font-size:0.85rem;">{{ $user->created_at->format('d/m/Y') }}
                                    </div>
                                    <div style="padding:15px; display:flex; gap:8px;">
                                        <button class="btn-xs" style="padding:5px; border-radius:4px;"
                                            title="Edit Pengguna"
                                            onclick='editUser({!! json_encode($user) !!})'>
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:12px; height:12px;">
                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" />
                                            </svg>
                                        </button>
                                        <button class="btn-xs danger" style="padding:5px; border-radius:4px;"
                                            title="Hapus Pengguna"
                                            onclick="deleteUser({{ $user->id }})">
                                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:12px; height:12px;">
                                                <polyline points="3 6 5 6 21 6" />
                                                <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                                <path d="M10 11v6" /><path d="M14 11v6" />
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="tab-panel" id="tab-orders">
                    <div class="section-header">
                        <h2 class="section-title">Daftar <em>Pesanan</em></h2>
                        <div class="section-actions" style="gap:16px">
                            <!-- BULK ACTION BAR (Identical to Venue) -->
                            <div style="display:flex; align-items:center; gap:12px;">
                                <label
                                    style="display:flex; align-items:center; gap:8px; font-size:0.8rem; cursor:pointer; color:var(--muted); font-weight:500;"
                                    id="selectAllWrap-orders">
                                    <input type="checkbox" id="selectAll-orders" onchange="toggleSelectAll('orders')"
                                        style="accent-color:var(--danger); width:16px; height:16px;">
                                    Pilih Semua
                                </label>
                                <div class="bulk-action" id="bulk-orders">
                                    <span class="bulk-text" id="bulkText-orders">0 terpilih</span>
                                    <button class="bulk-btn" onclick="bulkDelete('orders')">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            style="width:14px;height:14px;">
                                            <polyline points="3 6 5 6 21 6" />
                                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                                        </svg>
                                        Hapus
                                    </button>
                                </div>
                            </div>
                            <div class="search-wrap">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="11" cy="11" r="8" />
                                    <line x1="21" y1="21" x2="16.65" y2="16.65" />
                                </svg>
                                <input type="text" class="search-input" placeholder="Cari pesanan..."
                                    onkeyup="filterCards(this, 'ordersGrid')">
                            </div>
                        </div>
                    </div>

                    <div class="pricing-table fade-in">
                        <div class="pricing-table-header"
                            style="display:grid; grid-template-columns: 0.35fr 0.8fr 1.5fr 2fr 1.2fr 1fr 1.2fr 0.8fr; align-items:center;">
                            <div style="padding:15px;"></div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                ID Pesanan</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Pelanggan</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Item (Venue/Vendor)</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Total Harga</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Status</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Tanggal Pesan</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Aksi</div>
                        </div>
                        <div id="ordersGrid">
                            @forelse($bookings as $booking)
                                <div class="pricing-table-row item-card"
                                    data-name="{{ strtolower($booking->user->name ?? '') }} #{{ $booking->id }}"
                                    style="display:grid; grid-template-columns: 0.35fr 0.8fr 1.5fr 2fr 1.2fr 1fr 1.2fr 0.8fr; align-items:center; border-bottom:1px solid var(--border-light);">
                                    <div style="padding:15px;"><input type="checkbox" class="chk-orders"
                                            value="{{ $booking->id }}" onchange="toggleBulk('orders')"></div>
                                    <div style="padding:15px">#{{ $booking->id }}</div>
                                    <div style="padding:15px">{{ $booking->user->name ?? 'User #' . $booking->user_id }}
                                    </div>
                                    <div style="padding:15px">
                                        <strong style="color:var(--gold-deep)">
                                            @if($booking->venue_id) Venue #{{$booking->venue_id}}
                                            @elseif($booking->vendor_id) Vendor #{{$booking->vendor_id}}
                                            @endif
                                        </strong>
                                    </div>
                                    <div style="padding:15px">Rp
                                        {{ number_format((float) $booking->total_price, 0, ',', '.') }}
                                    </div>
                                    <div style="padding:15px">
                                        <select class="pricing-badge"
                                            onchange="updateOrderStatus({{ $booking->id }}, this.value)"
                                            style="border:none; cursor:pointer; font-family:inherit; font-size:0.75rem; 
                                            background: {{ $booking->status === 'Selesai' ? 'rgba(52,199,89,0.1)' : ($booking->status === 'Dibatalkan' ? 'rgba(255,59,48,0.1)' : 'rgba(255,159,10,0.1)') }};
                                            color: {{ $booking->status === 'Selesai' ? 'var(--success)' : ($booking->status === 'Dibatalkan' ? 'var(--danger)' : 'var(--warning)') }};">
                                            <option value="Belum Diproses" {{ $booking->status === 'Belum Diproses' ? 'selected' : '' }}>Belum Diproses</option>
                                            <option value="Diproses" {{ $booking->status === 'Diproses' ? 'selected' : '' }}>
                                                Diproses</option>
                                            <option value="Selesai" {{ $booking->status === 'Selesai' ? 'selected' : '' }}>
                                                Selesai</option>
                                            <option value="Dibatalkan" {{ $booking->status === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                        </select>
                                    </div>
                                    <div style="padding:15px">{{ $booking->created_at->format('d M Y') }}</div>
                                    <div style="padding:15px; display:flex; gap:8px;">
                                        <button class="btn-xs" onclick="viewOrder({{ $booking->id }})"
                                            style="background:rgba(255,255,255,0.05); border:1px solid var(--border-light); color:var(--muted);">Detail</button>
                                        <button class="btn-xs danger"
                                            onclick="openDelete('orders', {{ $booking->id }}, '#{{ $booking->id }}')"
                                            style="background:transparent; border:none; padding:5px; color:var(--danger); opacity:0.7;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z" />
                                        <polyline points="14 2 14 8 20 8" />
                                    </svg>
                                    <h3>Belum Ada Pesanan</h3>
                                </div>
                            @endforelse
                        </div>


                    </div>
                </div>


                <!-- ── RATINGS TAB ── -->
                <div class="tab-panel" id="tab-ratings">
                    <div class="section-header">
                        <h2 class="section-title">Rating &amp; <em>Ulasan Customer</em></h2>
                        <div class="section-actions">
                            <button class="btn-add" onclick="openModal('modalRatingManual')">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                <span>Tambah Testimoni</span>
                            </button>
                        </div>
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
                                                {{ $rating->is_anonymous ? 'Customer Anonim' : ($rating->user->name ?? 'User #' . $rating->user_id) }}
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
                                            @for($i = 0; $i < 5; $i++)
                                                <svg viewBox="0 0 24 24" width="16" height="16"
                                                    fill="{{ $i < $rating->overall_rating ? 'currentColor' : 'rgba(0,0,0,0.05)' }}">
                                                    <path
                                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z">
                                                    </path>
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
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <polygon
                                        points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2">
                                    </polygon>
                                </svg>
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
                                    <svg viewBox="0 0 24 24" width="20" height="20" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                    </svg>
                                </div>
                                <div class="review-content">
                                    <div class="review-meta">
                                        <div>
                                            <span class="category-tag">{{ $saran->category }}</span>
                                            <div class="saran-title" style="margin-top:8px">{{ $saran->title }}</div>
                                        </div>
                                    </div>
                                    <div class="review-text"
                                        style="font-style: normal; color: var(--ink-muted); padding-left:0; border-left:none">
                                        {{ $saran->content ?? 'Tidak ada detail pesan.'}}
                                    </div>
                                    <div class="review-footer">
                                        <div class="review-date">
                                            Diterima pada {{ $saran->created_at->format('d M Y, H:i') }}
                                        </div>
                                        <button class="btn-xs" style="border-radius: 20px; padding: 4px 15px;">Tandai
                                            Dibaca</button>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="empty-state">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                                </svg>
                                <h3>Kotak Saran Kosong</h3>
                                <p>Belum ada masukan atau saran dari pelanggan Anda.</p>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- ── STUDY CASE TAB ── -->
                <div class="tab-panel" id="tab-studycase">
                    <div class="section-header">
                        <h2 class="section-title">Laporan <em>Study Case</em></h2>
                        <div class="section-actions" style="gap:16px">
                            <span
                                style="font-size: 0.72rem; color: var(--muted); letter-spacing: 0.05em; text-transform: uppercase; font-weight: 500;">
                                Data Venue (Seeder) · 10 Baris / Halaman
                            </span>
                        </div>
                    </div>

                    <div class="pricing-table fade-in">
                        <div class="pricing-table-header studycase-grid">
                            <th>ID</th>
                            <th>Nama Venue</th>
                            <th>Kategori</th>
                            <th>Pemilik/PIC</th>
                            <th>Kapasitas</th>
                            <th>Harga (Rp)</th>
                        </div>
                        <div id="studycaseRows">
                            @forelse($venuesPaged as $v)
                                <div class="pricing-row studycase-grid">
                                    <td style="color: var(--danger); font-weight: 700;">#{{ $v->id }}</td>
                                    <td style="font-weight: 500; color: var(--ink);">{{ $v->name }}</td>
                                    <td>
                                        <span class="pricing-badge"
                                            style="background: var(--gold-dim); color: var(--gold-deep);">
                                            {{ ucfirst($v->category) }}
                                        </span>
                                    </td>
                                    <td>{{ $v->owner }}</td>
                                    <td>{{ number_format($v->capacity ?? 0, 0, ',', '.') }} Pax</td>
                                    <td class="pricing-price">Rp {{ number_format((float) $v->price, 0, ',', '.') }}</td>
                                </div>
                            @empty
                                <div style="padding: 60px; text-align: center; color: var(--muted); font-size: 0.85rem;">
                                    Tidak ada data ditemukan dalam database.
                                </div>
                            @endforelse
                        </div>
                    </div>

                    <div style="margin-top: 24px; display: flex; justify-content: flex-end;">
                        {{ $venuesPaged->links() }}
                    </div>
                </div>

                <!-- ── PROMOS TAB ── -->
                <div class="tab-panel" id="tab-promos">
                    <div class="section-header">
                        <h2 class="section-title">Manajemen <em>Kode Promo</em></h2>
                        <div class="section-actions">
                            <button class="btn-add" onclick="openModal('modalPromo'); resetPromoForm()">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <line x1="12" y1="5" x2="12" y2="19" />
                                    <line x1="5" y1="12" x2="19" y2="12" />
                                </svg>
                                <span>Tambah Promo</span>
                            </button>
                        </div>
                    </div>

                    <div class="pricing-table fade-in">
                        <div class="pricing-table-header"
                            style="display:grid; grid-template-columns: 0.5fr 1.2fr 1fr 1fr 1fr 1fr 1fr 0.8fr; align-items:center;">
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                ID</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Kode</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Tipe</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Nilai Diskon</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Pemakaian</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Berlaku Hingga</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Status</div>
                            <div
                                style="padding:15px; font-size:0.56rem; letter-spacing:0.2em; text-transform:uppercase; color:var(--muted); font-weight:600;">
                                Aksi</div>
                        </div>
                        <div id="promoRows">
                            @forelse($promos as $promo)
                                <div class="pricing-table-row item-card"
                                    style="display:grid; grid-template-columns: 0.5fr 1.2fr 1fr 1fr 1fr 1fr 1fr 0.8fr; align-items:center; border-bottom:1px solid var(--border-light);">
                                    <div style="padding:15px; color:var(--muted);">#{{ $promo->id }}</div>
                                    <div style="padding:15px;">
                                        <span
                                            style="font-family: monospace; font-size: 0.9rem; font-weight: 700; background: rgba(255,193,7,0.1); color: var(--gold-deep); padding: 4px 10px; border-radius: 6px; letter-spacing: 0.1em;">{{ $promo->code }}</span>
                                    </div>
                                    <div style="padding:15px;">
                                        <span class="pricing-badge"
                                            style="background: {{ $promo->type === 'percentage' ? 'rgba(88,86,214,0.1)' : 'rgba(52,199,89,0.1)' }}; color: {{ $promo->type === 'percentage' ? '#5856d6' : 'var(--success)' }}">
                                            {{ $promo->type === 'percentage' ? 'Persentase' : 'Nominal Tetap' }}
                                        </span>
                                    </div>
                                    <div style="padding:15px; font-weight: 600;">
                                        @if($promo->type === 'percentage')
                                            {{ $promo->reward_value }}%
                                        @else
                                            Rp {{ number_format($promo->reward_value, 0, ',', '.') }}
                                        @endif
                                    </div>
                                    <div style="padding:15px; color:var(--muted);">
                                        {{ $promo->usage_count }} / {{ $promo->usage_limit ?? '∞' }}
                                    </div>
                                    <div style="padding:15px; color:var(--muted); font-size:0.85rem;">
                                        {{ $promo->expires_at ? $promo->expires_at->format('d M Y') : 'Tidak Ada' }}
                                    </div>
                                    <div style="padding:15px;">
                                        <span class="pricing-badge {{ $promo->is_active ? 'active' : '' }}"
                                            style="cursor:pointer;" onclick="togglePromoStatus({{ $promo->id }}, this)">
                                            {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                                        </span>
                                    </div>
                                    <div style="padding:15px; display:flex; gap:8px;">
                                        <button class="btn-xs"
                                            onclick="editPromo({{ $promo->id }}, '{{ $promo->code }}', '{{ $promo->type }}', {{ $promo->reward_value }}, {{ $promo->usage_limit ?? 'null' }}, '{{ $promo->expires_at ? $promo->expires_at->format('Y-m-d') : '' }}', {{ $promo->is_active ? 'true' : 'false' }})"
                                            style="background:rgba(255,255,255,0.05); border:1px solid var(--border-light); color:var(--muted);">Edit</button>
                                        <button class="btn-xs danger"
                                            onclick="deletePromo({{ $promo->id }}, '{{ $promo->code }}')"
                                            style="background:transparent; border:none; padding:5px; color:var(--danger); opacity:0.7;">
                                            <svg width="14" height="14" viewBox="0 0 24 24" fill="none"
                                                stroke="currentColor" stroke-width="2">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                </path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            @empty
                                <div class="empty-state">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1">
                                        <path
                                            d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z" />
                                        <line x1="7" y1="7" x2="7.01" y2="7" />
                                    </svg>
                                    <h3>Belum Ada Kode Promo</h3>
                                    <p>Tambahkan kode promo untuk menarik lebih banyak pelanggan.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

            </div><!-- /content -->
        </main>
    </div><!-- /app -->


    <!-- ════════════════════ MODAL PROMO ════════════════════ -->
    <div class="modal-backdrop" id="modalPromo">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title" id="modalPromoTitle">Tambah <em>Kode Promo</em></h2>
                <button class="modal-close" onclick="closeModal('modalPromo')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="promoEditId">
                <div class="form-group">
                    <label class="form-label">Kode Promo</label>
                    <input type="text" id="promoCode" class="form-control" placeholder="cth. WEDDING20"
                        style="text-transform:uppercase; letter-spacing:0.1em; font-weight:600;">
                    <small style="color:var(--muted); margin-top:4px; display:block;">Kode akan dikonversi otomatis
                        menjadi huruf kapital</small>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Tipe Diskon</label>
                        <select id="promoType" class="form-control" onchange="updatePromoValueLabel()">
                            <option value="percentage">Persentase (%)</option>
                            <option value="fixed">Nominal Tetap (Rp)</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" id="promoValueLabel">Nilai Diskon (%)</label>
                        <input type="number" id="promoValue" class="form-control" placeholder="cth. 20" min="0">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label">Batas Berlaku Mulai</label>
                        <input type="date" id="promoLimit" class="form-control">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Berlaku Hingga</label>
                        <input type="date" id="promoExpiry" class="form-control">
                    </div>
                </div>
                <div class="form-group">
                    <div class="toggle-wrap">
                        <span class="toggle-label">Status <strong>Aktif</strong></span>
                        <label class="toggle">
                            <input type="checkbox" id="promoIsActive" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-xs" onclick="closeModal('modalPromo')">Batal</button>
                <button class="btn-xs primary" onclick="savePromo()">Simpan Promo</button>
            </div>
        </div>
    </div>

    <!-- ════════════════════ MODAL VENUE ════════════════════ -->
    <div class="modal-backdrop" id="modalVenue">
        <div class="modal modal-lg">
            <div class="modal-header">
                <h2 class="modal-title" id="modalVenueTitle">Detail <em>Venue</em></h2>
                <button class="modal-close" onclick="closeModal('modalVenue')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Section 1: Informasi Dasar -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M13 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V9z"></path>
                                <polyline points="13 2 13 9 20 9"></polyline>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Informasi Utama</h3>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Nama Venue</label>
                            <input type="text" name="name" id="venueNameInput" class="form-control-premium"
                                placeholder="cth. Grand Ballroom Surabaya">
                        </div>
                        <div class="form-group" style="margin-bottom: 0;">
                            <label class="form-label">Kategori Venue</label>
                            <select name="category" id="venueCategoryInput" class="form-control-premium">
                                <option value="Indoor">Indoor</option>
                                <option value="Outdoor">Outdoor</option>
                                <option value="Semi-Outdoor">Semi-Outdoor</option>
                                <option value="Ballroom">Ballroom</option>
                                <option value="Garden">Garden</option>
                                <option value="Villa">Villa</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group" style="margin-top: 16px;">
                        <label class="form-label">Deskripsi Lengkap</label>
                        <textarea class="form-control-premium" name="about" id="venueAboutInput" rows="4"
                            placeholder="Deskripsikan keindahan dan keunggulan venue ini..."></textarea>
                    </div>
                </div>

                <!-- Section 2: Detail Kapasitas & Lokasi -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                <circle cx="12" cy="10" r="3"></circle>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Detail & Lokasi</h3>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Kapasitas Maksimal (Pax)</label>
                            <input type="number" name="capacity" id="venueCapacityInput" class="form-control-premium"
                                placeholder="cth. 500">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kota / Lokasi</label>
                            <select name="location" id="venueLocationInput" class="form-control-premium">
                                <option value="" disabled selected>Pilih Kota</option>
                                <option value="Jakarta">Jakarta</option>
                                <option value="Surabaya">Surabaya</option>
                                <option value="Sidoarjo">Sidoarjo</option>
                                <option value="Bandung">Bandung</option>
                                <option value="Bali">Bali</option>
                                <option value="Yogyakarta">Yogyakarta</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Section 3: Pengaturan Harga -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Biaya & Penawaran</h3>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Harga Sewa (IDR)</label>
                            <input type="number" name="price" id="venuePriceInput" class="form-control-premium"
                                placeholder="0">
                        </div>
                    </div>
                </div>

                <!-- Section 4: Media & Fasilitas -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Media & Fasilitas</h3>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Fasilitas Utama</label>
                        <input type="text" name="features" id="venueFeaturesInput" class="form-control-premium"
                            placeholder="AC, Parkir, Catering... (pisahkan dengan koma)">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label class="form-label">Unggah Foto Gallery</label>
                        <div class="premium-upload-zone" onclick="document.getElementById('venueFileInput').click()">
                            <input type="file" id="venueFileInput" name="images[]" multiple accept="image/*"
                                style="display:none" onchange="handleFileUpload(this, 'venuePreviewGrid')">
                            <div class="premium-upload-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                            </div>
                            <p class="premium-upload-text">Klik atau seret foto ke sini</p>
                            <span class="premium-upload-sub">JPG, PNG · Maksimum 5MB per file</span>
                        </div>
                        <div class="img-preview-grid" id="venuePreviewGrid"></div>
                    </div>
                </div>

                <!-- Section 5: Status -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Konfigurasi Status</h3>
                    </div>
                    <div class="toggle-premium">
                        <div class="toggle-premium-label">
                            <span class="toggle-premium-title">Featured Venue</span>
                            <span class="toggle-premium-desc">Tampilkan di posisi teratas halaman utama</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="venueFeaturedInput">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-premium">
                        <div class="toggle-premium-label">
                            <span class="toggle-premium-title">Status Aktif</span>
                            <span class="toggle-premium-desc">Jika non-aktif, venue tidak akan terlihat oleh
                                publik</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="venueActiveInput" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer"
                style="padding: 24px 32px; background: var(--ivory); border-radius: 0 0 12px 12px;">
                <button class="btn-xs" onclick="closeModal('modalVenue')"
                    style="background: #fff; padding: 10px 20px;">Batal</button>
                <button class="btn-xs primary" onclick="saveVenue()"
                    style="padding: 10px 24px; font-weight: 600;">Simpan Perubahan</button>
            </div>
        </div>
    </div>
    <!-- ════════════════════ MODAL VENDOR ════════════════════ -->
    <div class="modal-backdrop" id="modalVendor">
        <div class="modal modal-lg">
            <div class="modal-header">
                <h2 class="modal-title" id="modalVendorTitle">Detail <em>Vendor</em></h2>
                <button class="modal-close" onclick="closeModal('modalVendor')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18"></line>
                        <line x1="6" y1="6" x2="18" y2="18"></line>
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <!-- Section 1: Informasi Bisnis -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Informasi Bisnis</h3>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Nama Vendor / Usaha</label>
                            <input type="text" id="vendorNameInput" class="form-control-premium"
                                placeholder="cth. Elegance Photography Studio">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kategori Layanan</label>
                            <select id="vendorCategoryInput" class="form-control-premium">
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
                    <div class="form-group" style="margin-top: 16px;">
                        <label class="form-label">Tentang Layanan</label>
                        <textarea id="vendorAboutInput" class="form-control-premium" rows="4"
                            placeholder="Ceritakan keahlian dan portofolio vendor ini..."></textarea>
                    </div>
                </div>

                <!-- Section 2: Kontak & Jangkauan -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path
                                    d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Kontak & Jangkauan</h3>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">WhatsApp (Bisnis)</label>
                            <input type="text" id="vendorPhoneInput" class="form-control-premium"
                                placeholder="cth. 08123456789">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Kota Operasional</label>
                            <input type="text" id="vendorLocationInput" class="form-control-premium"
                                placeholder="cth. Surabaya">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Biaya & Promo -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <line x1="12" y1="1" x2="12" y2="23"></line>
                                <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Biaya Layanan</h3>
                    </div>
                    <div class="form-grid-2">
                        <div class="form-group">
                            <label class="form-label">Harga Mulai Dari (IDR)</label>
                            <input type="number" id="vendorPriceInput" class="form-control-premium" placeholder="0">
                        </div>
                    </div>
                </div>

                <!-- Section 4: Portofolio -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                <polyline points="21 15 16 10 5 21"></polyline>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Portofolio Layanan</h3>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Paket Layanan Utama</label>
                        <input type="text" id="vendorFeaturesInput" class="form-control-premium"
                            placeholder="Paket Silver, Paket Gold... (pisahkan koma)">
                    </div>
                    <div class="form-group" style="margin-top: 20px;">
                        <label class="form-label">Unggah Foto Portofolio</label>
                        <div class="premium-upload-zone" onclick="document.getElementById('vendorFileInput').click()">
                            <input type="file" id="vendorFileInput" name="images[]" multiple accept="image/*"
                                style="display:none" onchange="handleFileUpload(this, 'vendorPreviewGrid')">
                            <div class="premium-upload-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                    <polyline points="17 8 12 3 7 8"></polyline>
                                    <line x1="12" y1="3" x2="12" y2="15"></line>
                                </svg>
                            </div>
                            <p class="premium-upload-text">Klik atau seret portofolio ke sini</p>
                            <span class="premium-upload-sub">JPG, PNG · Maksimum 5MB per file</span>
                        </div>
                        <div class="img-preview-grid" id="vendorPreviewGrid"></div>
                    </div>
                </div>

                <!-- Section 5: Status -->
                <div class="modal-section">
                    <div class="modal-section-header">
                        <div class="modal-section-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <circle cx="12" cy="12" r="10"></circle>
                                <line x1="12" y1="8" x2="12" y2="12"></line>
                                <line x1="12" y1="16" x2="12.01" y2="16"></line>
                            </svg>
                        </div>
                        <h3 class="modal-section-title">Konfigurasi Status</h3>
                    </div>
                    <div class="toggle-premium">
                        <div class="toggle-premium-label">
                            <span class="toggle-premium-title">Featured Vendor</span>
                            <span class="toggle-premium-desc">Prioritaskan vendor di halaman pencarian</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="vendorFeaturedInput">
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                    <div class="toggle-premium">
                        <div class="toggle-premium-label">
                            <span class="toggle-premium-title">Status Kerjasama</span>
                            <span class="toggle-premium-desc">Aktifkan untuk menampilkan ke pengguna</span>
                        </div>
                        <label class="toggle">
                            <input type="checkbox" id="vendorActiveInput" checked>
                            <span class="toggle-slider"></span>
                        </label>
                    </div>
                </div>
            </div>
            <div class="modal-footer"
                style="padding: 24px 32px; background: var(--ivory); border-radius: 0 0 12px 12px;">
                <button class="btn-xs" onclick="closeModal('modalVendor')"
                    style="background: #fff; padding: 10px 20px;">Batal</button>
                <button class="btn-xs primary" onclick="saveVendor()"
                    style="padding: 10px 24px; font-weight: 600;">Simpan Perubahan</button>
            </div>
        </div>
    </div>

    <!-- ════════════════════ MODAL PRICING ════════════════════ -->
    <div class="modal-backdrop" id="modalPricing">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title">Tambah <em>Paket Harga</em></h2>
                <button class="modal-close" onclick="closeModal('modalPricing')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
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
                    <textarea class="form-control" placeholder="Syarat dan ketentuan harga…"
                        style="min-height:70px"></textarea>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-xs" onclick="closeModal('modalPricing')">Batal</button>
                <button class="btn-xs primary"
                    onclick="showToast('Paket harga berhasil disimpan', 'success'); closeModal('modalPricing')">Simpan
                    Paket</button>
            </div>
        </div>
    <!-- ════════════════════ MODAL USER ════════════════════ -->
    <div class="modal-backdrop" id="modalUser">
        <div class="modal">
            <div class="modal-header">
                <h2 class="modal-title" id="modalUserTitle">Tambah <em>Pengguna Baru</em></h2>
                <button class="modal-close" onclick="closeModal('modalUser')">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <line x1="18" y1="6" x2="6" y2="18" />
                        <line x1="6" y1="6" x2="18" y2="18" />
                    </svg>
                </button>
            </div>
            <div class="modal-body">
                <input type="hidden" id="userInputId">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" id="userInputName" class="form-control" placeholder="Nama lengkap pengguna">
                </div>
                <div class="form-group">
                    <label class="form-label">Alamat Email</label>
                    <input type="email" id="userInputEmail" class="form-control" placeholder="email@contoh.com">
                </div>
                <div class="form-group">
                    <label class="form-label">Password</label>
                    <input type="password" id="userInputPassword" class="form-control" placeholder="Minimal 8 karakter">
                    <small style="font-size:0.6rem; color:var(--muted);" id="pwNote"></small>
                </div>
                <div class="form-group">
                    <label class="form-label">Role Pengguna</label>
                    <select id="userInputRole" class="form-control">
                        <option value="user">User (Customer)</option>
                        <option value="admin">Admin (Pengelola)</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button class="btn-xs" onclick="closeModal('modalUser')">Batal</button>
                <button class="btn-xs primary" onclick="saveUser()">Simpan Pengguna</button>
            </div>
        </div>
    </div>



        <!-- ════════════════════ MODAL DELETE CONFIRM ════════════════════ -->
        <div class="modal-backdrop" id="modalDelete">
            <div class="modal modal-sm">
                <div class="modal-body" style="text-align:center;padding:36px 28px">
                    <div class="confirm-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                            <polyline points="3 6 5 6 21 6" />
                            <path d="M19 6l-1 14a2 2 0 0 1-2 2H8a2 2 0 0 1-2-2L5 6" />
                            <path d="M10 11v6" />
                            <path d="M14 11v6" />
                            <path d="M9 6V4a1 1 0 0 1 1-1h4a1 1 0 0 1 1 1v2" />
                        </svg>
                    </div>
                    <div class="confirm-title">Hapus <span id="deleteItemName">item</span>?</div>
                    <p class="confirm-desc">Tindakan ini tidak dapat dibatalkan.<br>Data akan dihapus secara permanen.
                    </p>
                </div>
                <div class="modal-footer">
                    <button class="btn-xs" onclick="closeModal('modalDelete')">Batal</button>
                    <button class="btn-xs danger" onclick="confirmDelete()">Ya, Hapus</button>
                </div>
            </div>
        </div>

        <!-- ════════════════════ MODAL RATING MANUAL ════════════════════ -->
        <div class="modal-backdrop" id="modalRatingManual">
            <div class="modal">
                <div class="modal-header">
                    <h2 class="modal-title">Tambah <em>Testimoni Manual</em></h2>
                    <button class="modal-close" onclick="closeModal('modalRatingManual')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <line x1="18" y1="6" x2="6" y2="18" />
                            <line x1="6" y1="6" x2="18" y2="18" />
                        </svg>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label class="form-label">Nama Pemberi Ulasan</label>
                        <input type="text" class="form-control" placeholder="cth. Ibu Sari & Bapak Budi"
                            id="rateAuthorInput">
                    </div>
                    <div class="form-group">
                        <label class="form-label">Target (Venue/Vendor)</label>
                        <input type="text" class="form-control" placeholder="cth. Grand Ballroom LIPI"
                            id="rateTargetInput">
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label">Rating Bintang (1-5)</label>
                            <select class="form-control" id="rateStarInput">
                                <option value="5">⭐⭐⭐⭐⭐ (5)</option>
                                <option value="4">⭐⭐⭐⭐ (4)</option>
                                <option value="3">⭐⭐⭐ (3)</option>
                                <option value="2">⭐⭐ (2)</option>
                                <option value="1">⭐ (1)</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label">Isi Ulasan</label>
                        <textarea class="form-control" placeholder="Tuliskan pengalaman manis mereka di sini…"
                            id="rateTextInput" style="min-height:100px"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn-xs" onclick="closeModal('modalRatingManual')">Batal</button>
                    <button class="btn-xs primary" onclick="saveRatingManual()">Simpan Testimoni</button>
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
               FORMATTING HELPERS
               ═══════════════════════════════════════ */
            const fmtPrice = v => 'Rp ' + (v / 1000000).toFixed(1) + 'jt';
            const fmtFull = v => 'Rp ' + parseInt(v).toLocaleString('id-ID');

            function statusDot(v) {
                const color = v.status === 'active' ? 'var(--success)' : 'var(--muted-lt)';
                return `<div class="status-dot" style="background:${color}" title="${v.status}"></div>`;
            }

            function statusBadge(status) {
                let cls = 'pricing-badge';
                if (status === 'featured') cls += ' active';
                return `<span class="${cls}">${status}</span>`;
            }

            /* ═══════════════════════════════════════
               TAB NAVIGATION
            ═══════════════════════════════════════ */
            const pageTitles = {
                dashboard: 'Dashboard <em>Overview</em>',
                venue: 'Manajemen <em>Venue</em>',
                vendor: 'Manajemen <em>Vendor</em>',
                pricing: 'Pengaturan <em>Harga</em>',
                orders: 'Daftar <em>Pesanan</em>',
                users: 'Manajemen <em>Pengguna</em>',
                promos: 'Manajemen <em>Promo & Voucher</em>',
                ratings: 'Rating <em>Customer</em>',
                sarans: 'Saran <em>Customer</em>',
                studycase: 'Laporan <em>Study Case</em>',
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
            <td><span class="pricing-badge active">Aktif</span></td>
            <td>
                <div class="pricing-actions">
                    <button class="btn-xs danger" onclick="deletePromo(${p.id})">Hapus</button>
                </div>
            </td>
        </div>`).join('');
            }

            function venueCard(v) {
                const finalPrice = v.price * (1 - v.discount / 100);
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
                if (dash) dash.innerHTML = venues.slice(0, 3).map(venueCard).join('');
            }

            function renderVendorGrid() {
                const el = document.getElementById('vendorGrid');
                if (el) el.innerHTML = vendors.map(vendorCard).join('');
            }

            function renderPricingTables() {
                document.getElementById('venuePricingRows').innerHTML = venues.map(v => `
                    <div class="pt-row" style="grid-template-columns: 2fr 1fr 1.2fr 1fr 1.2fr;">
                        <div class="pt-name">${v.name}</div>
                        <div class="pt-sub">${v.capacity} pax</div>
                        <div class="pt-price" id="vp-${v.id}">${fmtFull(v.price)}</div>
                        <div>${statusBadge(v.featured ? 'featured' : v.status)}</div>
                        <div style="display:flex; gap:8px;">
                            <button class="btn-xs" onclick="inlineEditPrice('v', ${v.id})" style="background:rgba(201,169,110,0.1); color:var(--gold-deep); border:1px solid rgba(201,169,110,0.2);">Edit Harga</button>
                            <button class="btn-xs danger" onclick="openDelete('venue', ${v.id}, '${v.name}')" style="background:transparent; border:none; color:var(--danger); opacity:0.7;">Hapus</button>
                        </div>
                    </div>`).join('');

                document.getElementById('vendorPricingRows').innerHTML = vendors.map(v => `
                    <div class="pt-row" style="grid-template-columns: 2fr 1.2fr 1.2fr 1fr 1.2fr;">
                        <div class="pt-name">${v.name}</div>
                        <div class="pt-sub">${v.category || v.type}</div>
                        <div class="pt-price" id="vdp-${v.id}">${fmtFull(v.price)}</div>
                        <div>${statusBadge(v.featured ? 'featured' : v.status)}</div>
                        <div style="display:flex; gap:8px;">
                            <button class="btn-xs" onclick="inlineEditPrice('vd', ${v.id})" style="background:rgba(201,169,110,0.1); color:var(--gold-deep); border:1px solid rgba(201,169,110,0.2);">Edit Harga</button>
                            <button class="btn-xs danger" onclick="openDelete('vendor', ${v.id}, '${v.name}')" style="background:transparent; border:none; color:var(--danger); opacity:0.7;">Hapus</button>
                        </div>
                    </div>`).join('');
            }

            /* ═══════════════════════════════════════
               INLINE PRICE EDIT
            ═══════════════════════════════════════ */
            function inlineEditPrice(type, id) {
                const elId = (type === 'v' ? 'vp-' : 'vdp-') + id;
                const cell = document.getElementById(elId);
                const arr = type === 'v' ? venues : vendors;
                const item = arr.find(x => x.id === id);
                if (!item) return;

                cell.innerHTML = `
                    <div class="inline-edit-wrap">
                        <input class="inline-edit-input" type="number" value="${item.price}" id="pricefield-${id}">
                        <button class="btn-save-inline" onclick="saveInlinePrice('${type}', ${id})" title="Simpan">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3"><polyline points="20 6 9 17 4 12"/></svg>
                        </button>
                        <button class="btn-cancel-inline" onclick="renderPricingTables()" title="Batal">
                            <svg viewBox="0 0 24 24" width="14" height="14" fill="none" stroke="currentColor" stroke-width="3"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                        </button>
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
                document.getElementById('modalVenueTitle').innerHTML = `Edit <em>${v.name}</em>`;
                document.getElementById('venueNameInput').value = v.name;
                document.getElementById('venueCategoryInput').value = v.category || 'Indoor';
                document.getElementById('venueAboutInput').value = v.about || v.desc || '';
                document.getElementById('venueCapacityInput').value = v.capacity || '';
                document.getElementById('venueLocationInput').value = v.city || v.location || '';
                document.getElementById('venuePriceInput').value = v.price;
                document.getElementById('venueFeaturesInput').value = v.features || '';
                document.getElementById('venueFeaturedInput').checked = !!v.featured;
                document.getElementById('venueActiveInput').checked = v.status === 'active';

                // Clear previews and show current image if any
                const grid = document.getElementById('venuePreviewGrid');
                grid.innerHTML = '';
                if (v.img) {
                    const div = document.createElement('div');
                    div.className = 'preview-thumb';
                    div.innerHTML = `<img src="${v.img}" alt="current">`;
                    grid.appendChild(div);
                }

                openModal('modalVenue');
            }

            function editVendor(id) {
                const v = vendors.find(x => x.id === id);
                if (!v) return;
                document.getElementById('modalVendorTitle').innerHTML = `Edit <em>${v.name}</em>`;
                document.getElementById('vendorNameInput').value = v.name;
                document.getElementById('vendorCategoryInput').value = v.category || v.type || '';
                document.getElementById('vendorAboutInput').value = v.about || v.desc || '';
                document.getElementById('vendorPhoneInput').value = v.phone || '';
                document.getElementById('vendorLocationInput').value = v.city || v.location || '';
                document.getElementById('vendorPriceInput').value = v.price;
                document.getElementById('vendorFeaturesInput').value = v.features || '';
                document.getElementById('vendorFeaturedInput').checked = !!v.featured;
                document.getElementById('vendorActiveInput').checked = v.status === 'active';

                const grid = document.getElementById('vendorPreviewGrid');
                grid.innerHTML = '';
                if (v.img) {
                    const div = document.createElement('div');
                    div.className = 'preview-thumb';
                    div.innerHTML = `<img src="${v.img}" alt="current">`;
                    grid.appendChild(div);
                }

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

                let url;
                if (deleteTarget.type === 'venue') url = '{{ route("admin.venues.delete") }}';
                else if (deleteTarget.type === 'vendor') url = '{{ route("admin.vendors.delete") }}';
                else if (deleteTarget.type === 'orders') url = '{{ route("admin.orders.delete") }}';

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
                            if (deleteTarget.type === 'venue') venues = venues.filter(v => v.id !== deleteTarget.id);
                            if (deleteTarget.type === 'vendor') vendors = vendors.filter(v => v.id !== deleteTarget.id);

                            closeModal('modalDelete');
                            if (deleteTarget.type === 'venue') renderVenueGrid();
                            if (deleteTarget.type === 'vendor') renderVendorGrid();
                            if (deleteTarget.type === 'orders') setTimeout(() => window.location.reload(), 500);
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
                formData.append('capacity', document.getElementById('venueCapacityInput').value);
                formData.append('location', document.getElementById('venueLocationInput').value);
                formData.append('price', document.getElementById('venuePriceInput').value);
                formData.append('features', document.getElementById('venueFeaturesInput').value);
                formData.append('featured', document.getElementById('venueFeaturedInput').checked ? 1 : 0);
                formData.append('status', document.getElementById('venueActiveInput').checked ? 'active' : 'inactive');

                const fileInput = document.getElementById('venueFileInput');
                if (fileInput.files.length > 0) {
                    for (let i = 0; i < fileInput.files.length; i++) {
                        formData.append('images[]', fileInput.files[i]);
                    }
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{ route("admin.venues.store") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(`Venue "${name}" berhasil diperbarui`, 'success');
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
                formData.append('phone', document.getElementById('vendorPhoneInput').value);
                formData.append('price', document.getElementById('vendorPriceInput').value);
                // formData.append('discount', document.getElementById('vendorDiscountInput').value); // Hapus diskon
                formData.append('features', document.getElementById('vendorFeaturesInput').value);
                formData.append('featured', document.getElementById('vendorFeaturedInput').checked ? 1 : 0);
                formData.append('status', document.getElementById('vendorActiveInput').checked ? 'active' : 'inactive');

                const fileInput = document.getElementById('vendorFileInput');
                if (fileInput.files.length > 0) {
                    for (let i = 0; i < fileInput.files.length; i++) {
                        formData.append('images[]', fileInput.files[i]);
                    }
                }

                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{ route("admin.vendors.store") }}', {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(`Vendor "${name}" berhasil diperbarui`, 'success');
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
                    let url;
                    if (type === 'venue') url = '{{ route("admin.venues.delete") }}';
                    else if (type === 'vendor') url = '{{ route("admin.vendors.delete") }}';
                    else if (type === 'orders') url = '{{ route("admin.orders.delete") }}';

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
                                if (type === 'orders') setTimeout(() => window.location.reload(), 500);
                                renderPricingTables();

                                document.getElementById(`bulk-${type}`).style.display = 'none';
                                const selectAll = document.getElementById(`selectAll-${type}`);
                                if (selectAll) selectAll.checked = false;
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
                    card.style.display = card.dataset.name.includes(q) ? 'grid' : 'none';
                });
            }

            /* ═══════════════════════════════════════
               TOAST
            ═══════════════════════════════════════ */
            function showToast(msg, type = 'success') {
                const wrap = document.getElementById('toastWrap');
                const icons = {
                    success: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>',
                    danger: '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>',
                };
                const t = document.createElement('div');
                t.className = `toast ${type}`;
                t.innerHTML = `${icons[type] || ''}<span>${msg}</span>`;
                wrap.appendChild(t);
                setTimeout(() => { t.style.opacity = '0'; t.style.transform = 'translateX(20px)'; t.style.transition = 'all 0.3s'; setTimeout(() => t.remove(), 300); }, 3000);
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
            function updateOrderStatus(id, newStatus) {
                const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

                fetch('{{ route("admin.orders.update-status") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({ id: id, status: newStatus })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showToast(`Status pesanan #${id} berhasil diubah menjadi "${newStatus}"`, 'success');

                            // Update color feedback manually to avoid reload
                            const select = event.target;
                            if (newStatus === 'Selesai') {
                                select.style.background = 'rgba(52,199,89,0.1)';
                                select.style.color = 'var(--success)';
                            } else if (newStatus === 'Dibatalkan') {
                                select.style.background = 'rgba(255,59,48,0.1)';
                                select.style.color = 'var(--danger)';
                            } else {
                                select.style.background = 'rgba(255,159,10,0.1)';
                                select.style.color = 'var(--warning)';
                            }
                        } else {
                            showToast('Gagal memperbarui status pesanan', 'danger');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToast('Terjadi kesalahan koneksi', 'danger');
                    });
            }

            /* ═══════════════════════════════════════
               PROMO CRUD
               ═══════════════════════════════════════ */
            function resetPromoForm() {
                document.getElementById('promoEditId').value = '';
                document.getElementById('promoCode').value = '';
                document.getElementById('promoType').value = 'percentage';
                document.getElementById('promoValue').value = '';
                document.getElementById('promoLimit').value = '';
                document.getElementById('promoExpiry').value = '';
                document.getElementById('promoIsActive').checked = true;
                document.getElementById('modalPromoTitle').innerHTML = 'Tambah <em>Kode Promo</em>';
                updatePromoValueLabel();
            }

            function updatePromoValueLabel() {
                const type = document.getElementById('promoType').value;
                document.getElementById('promoValueLabel').textContent = type === 'percentage' ? 'Nilai Diskon (%)' : 'Nilai Diskon (Rp)';
            }

            function editPromo(id, code, type, value, limit, expiry, isActive) {
                document.getElementById('promoEditId').value = id;
                document.getElementById('promoCode').value = code;
                document.getElementById('promoType').value = type;
                document.getElementById('promoValue').value = value;
                document.getElementById('promoLimit').value = limit || '';
                document.getElementById('promoExpiry').value = expiry;
                document.getElementById('promoIsActive').checked = isActive;
                document.getElementById('modalPromoTitle').innerHTML = 'Edit <em>Kode Promo</em>';
                updatePromoValueLabel();
                openModal('modalPromo');
            }

            function savePromo() {
                const id = document.getElementById('promoEditId').value;
                const code = document.getElementById('promoCode').value.toUpperCase().trim();
                const type = document.getElementById('promoType').value;
                const value = document.getElementById('promoValue').value;
                const limit = document.getElementById('promoLimit').value;
                const expiry = document.getElementById('promoExpiry').value;
                const isActive = document.getElementById('promoIsActive').checked;

                if (!code || !value) {
                    showToast('Kode dan nilai diskon wajib diisi', 'danger');
                    return;
                }

                const url = id ? `/admin/promos/${id}/update` : `{{ route('admin.promos.store') }}`;
                const payload = { code, type, reward_value: value, usage_limit: limit || null, expires_at: expiry || null, is_active: isActive };

                fetch(url, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content },
                    body: JSON.stringify(payload)
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            showToast(id ? 'Promo berhasil diperbarui!' : 'Promo berhasil ditambahkan!', 'success');
                            closeModal('modalPromo');
                            setTimeout(() => location.reload(), 800);
                        } else {
                            showToast(data.message || 'Gagal menyimpan promo', 'danger');
                        }
                    })
                    .catch(() => showToast('Terjadi kesalahan koneksi', 'danger'));
            }

            function deletePromo(id, code) {
                if (!confirm(`Hapus kode promo "${code}"? Tindakan ini tidak dapat dibatalkan.`)) return;
                fetch(`/admin/promos/delete/${id}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            showToast(`Promo "${code}" berhasil dihapus`, 'success');
                            setTimeout(() => location.reload(), 800);
                        } else {
                            showToast('Gagal menghapus promo', 'danger');
                        }
                    })
                    .catch(() => showToast('Terjadi kesalahan koneksi', 'danger'));
            }

            function togglePromoStatus(id, el) {
                fetch('/admin/promos/toggle/' + id, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            const isNowActive = data.is_active;
                            el.textContent = isNowActive ? 'Aktif' : 'Nonaktif';
                            el.className = 'pricing-badge' + (isNowActive ? ' active' : '');
                            showToast(`Status promo berhasil diubah menjadi "${isNowActive ? 'Aktif' : 'Nonaktif'}"`, 'success');
                        } else {
                            showToast('Gagal mengubah status promo', 'danger');
                        }
                    })
                    .catch(() => showToast('Terjadi kesalahan koneksi', 'danger'));
            }

            /* ═══════════════════════════════════════
               ADD MODAL DISPATCHER
               ═══════════════════════════════════════ */
            function openAddModal() {
                const activeTab = localStorage.getItem('adminActiveTab') || 'dashboard';

                if (activeTab === 'venue' || activeTab === 'dashboard') {
                    resetVenueForm();
                    openModal('modalVenue');
                } else if (activeTab === 'vendor') {
                    resetVendorForm();
                    openModal('modalVendor');
                } else if (activeTab === 'promos') {
                    resetPromoForm();
                    openModal('modalPromo');
                } else if (activeTab === 'users') {
                    resetUserForm();
                    openModal('modalUser');
                } else if (activeTab === 'ratings') {
                    // Assuming there's a reset function if needed
                    openModal('modalRatingManual');
                } else {
                    showToast('Pilih tab Venue, Vendor, Pengguna, atau Promo untuk menambah data baru', 'danger');
                }
            }

            function resetUserForm() {
                document.getElementById('modalUserTitle').innerHTML = 'Tambah <em>Pengguna Baru</em>';
                document.getElementById('userInputName').value = '';
                document.getElementById('userInputEmail').value = '';
                document.getElementById('userInputPassword').value = '';
                document.getElementById('userInputRole').value = 'user';
            }

            function saveUser() {
                const name = document.getElementById('userInputName').value;
                const email = document.getElementById('userInputEmail').value;
                const password = document.getElementById('userInputPassword').value;
                const role = document.getElementById('userInputRole').value;

                if (!name || !email || !password) {
                    showToast('Mohon isi semua field wajib', 'warning');
                    return;
                }

                fetch('/admin/users', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({ name, email, password, role })
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            showToast('User berhasil ditambahkan!', 'success');
                            closeModal('modalUser');
                            setTimeout(() => location.reload(), 800);
                        } else {
                            showToast(data.message || 'Gagal menambahkan user', 'danger');
                        }
                    })
                    .catch(() => showToast('Terjadi kesalahan koneksi', 'danger'));
            }

            function updateUserRole(id, el) {
                const role = el.value;
                fetch('/admin/users/update-role', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    },
                    body: JSON.stringify({
                        id,
                        role
                    })
                })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success) {
                            showToast(`Role user berhasil diubah menjadi ${role}`, 'success');
                            // Update visual badge without reload
                            el.classList.remove('role-admin', 'role-user');
                            el.classList.add(role === 'admin' ? 'role-admin' : 'role-user');
                        } else {
                            showToast('Gagal mengubah role', 'danger');
                        }
                    })
                    .catch(() => showToast('Terjadi kesalahan koneksi', 'danger'));
            }

            function editUser(user) {
                document.getElementById('modalUserTitle').innerHTML = 'Edit <em>Pengguna</em>';
                document.getElementById('userInputId').value = user.id;
                document.getElementById('userInputName').value = user.name;
                document.getElementById('userInputEmail').value = user.email;
                document.getElementById('userInputRole').value = user.role;
                document.getElementById('userInputPassword').value = '';
                document.getElementById('pwNote').innerText = '* Kosongkan jika tidak ingin merubah password';
                openModal('modalUser');
            }

            function deleteUser(id) {
                if (confirm('Apakah Anda yakin ingin menghapus pengguna ini secara permanen?')) {
                    fetch('/admin/users/delete', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: JSON.stringify({
                            id
                        })
                    })
                        .then(r => r.json())
                        .then(data => {
                            if (data.success) {
                                showToast('Pengguna berhasil dihapus', 'success');
                                const row = document.getElementById(`user-row-${id}`);
                                if (row) row.remove();
                            } else {
                                showToast(data.message || 'Gagal menghapus pengguna', 'danger');
                            }
                        })
                        .catch(() => showToast('Terjadi kesalahan koneksi', 'danger'));
                }
            }

            function resetVenueForm() {
                document.getElementById('modalVenueTitle').innerHTML = 'Tambah <em>Venue Baru</em>';
                document.getElementById('venueNameInput').value = '';
                document.getElementById('venueCategoryInput').value = 'Indoor';
                document.getElementById('venueAboutInput').value = '';
                document.getElementById('venueCapacityInput').value = '';
                document.getElementById('venueLocationInput').value = '';
                document.getElementById('venuePriceInput').value = '';
                document.getElementById('venueFeaturesInput').value = '';
                document.getElementById('venueFeaturedInput').checked = false;
                document.getElementById('venueActiveInput').checked = true;
                document.getElementById('venuePreviewGrid').innerHTML = '';
                document.getElementById('venueFileInput').value = '';
            }

            function resetVendorForm() {
                document.getElementById('modalVendorTitle').innerHTML = 'Tambah <em>Vendor Baru</em>';
                document.getElementById('vendorNameInput').value = '';
                document.getElementById('vendorCategoryInput').value = '';
                document.getElementById('vendorAboutInput').value = '';
                document.getElementById('vendorPhoneInput').value = '';
                document.getElementById('vendorLocationInput').value = '';
                document.getElementById('vendorPriceInput').value = '';
                document.getElementById('vendorFeaturesInput').value = '';
                document.getElementById('vendorFeaturedInput').checked = false;
                document.getElementById('vendorActiveInput').checked = true;
                document.getElementById('vendorPreviewGrid').innerHTML = '';
                document.getElementById('vendorFileInput').value = '';
            }
        </script>

        <script src="//instant.page/5.2.0" type="module"></script>
</body>

</html>