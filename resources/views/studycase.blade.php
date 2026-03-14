<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Data - Study Case</title>
    <link rel="stylesheet" href="{{ asset('css/studycase.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" style="position:absolute; left:40px; text-decoration:none; color:#8b7880; font-size:12px; font-weight:600; display:flex; align-items:center; gap:8px;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali
        </a>
        <div class="brand-name" style="font-family:'Playfair Display',serif; font-size:16px; font-weight:700; color:#1e1620; letter-spacing:.04em;">Wedding <em style="color:#c0435f; font-style:italic;">Organizations</em></div>
    </nav>

    <div class="main-container">
        <div class="page-header">
            <h1 style="font-family:'Playfair Display',serif; font-size:28px; font-weight:700; color:#1e1620; margin-bottom:5px;">Laporan Study Case</h1>
            <p style="color:#8b7880; font-size:13px; margin:0;">Menampilkan tabel data dummy (Venue) dari Database Seeder, tertampil per 10 baris</p>
        </div>

        <div class="card">
            <div class="card-header-info">
                <h2 style="font-family:'Playfair Display', serif; font-size: 17px; font-weight: 700; color: #1e1620; margin: 0;">Total Data Venue: {{ $venues->total() }}</h2>
                <div style="font-size: 11px; color: #8b7880;">Halaman {{ $venues->currentPage() }} dari {{ $venues->lastPage() }}</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nama Venue</th>
                            <th>Kategori</th>
                            <th>Pemilik/PIC</th>
                            <th>Kapasitas</th>
                            <th>Harga (Rp)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($venues as $venue)
                            <tr>
                                <td style="color: #c0435f; font-weight: 700;">#{{ $venue->id }}</td>
                                <td style="font-weight: 600;">{{ $venue->name }}</td>
                                <td><span class="badge-category">{{ ucfirst($venue->category) }}</span></td>
                                <td>{{ $venue->owner }}</td>
                                <td>{{ number_format($venue->capacity ?? 0, 0, ',', '.') }} Pax</td>
                                <td style="font-family:'Playfair Display',serif; font-weight:700;">{{ $venue->price }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4" style="color: #8b7880;">Tidak ada data ditemukan.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="pagination-container">
                {{ $venues->links('pagination::bootstrap-4') }}
            </div>
        </div>
    </div>
    <!-- Performance Optimization: Instant.page -->
    <script src="//instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipSbmfOOiyv9D41tqtGj73T9MToG+8m/N8eO0vHnF+mX402p99xUqS7B"></script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
