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
        <a href="{{ route('home') }}" class="back-link" style="position:absolute; left:40px; text-decoration:none; color:#8b7880; font-size:12px; font-weight:600; display:flex; align-items:center; gap:8px;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali
        </a>
        <div class="brand-name">Wedding <em>Organizations</em></div>
    </nav>

    <div class="main-container">
        <div class="page-header">
            <h1>Laporan Study Case</h1>
            <p>Menampilkan tabel data dummy (Venue) dari Database Seeder, tertampil per 10 baris</p>
        </div>

        <div class="card">
            <div class="card-header-info">
                <div class="total-badge">Total Data Venue: {{ $venues->total() }}</div>
                <div class="page-indicator">Halaman {{ $venues->currentPage() }} dari {{ $venues->lastPage() }}</div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th width="80">ID</th>
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
                                <td class="td-name">{{ $venue->name }}</td>
                                <td><span class="td-category">{{ ucfirst($venue->category) }}</span></td>
                                <td class="td-owner">{{ $venue->owner }}</td>
                                <td class="td-owner">{{ number_format($venue->capacity ?? 0, 0, ',', '.') }} Pax</td>
                                <td class="td-price">Rp {{ number_format($venue->price, 0, ',', '.') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5" style="color: #8b7880;">Tidak ada data ditemukan.</td>
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

