<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saran & Masukan - Wedding Organizations</title>
    <link rel="stylesheet" href="{{ asset('css/saran.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global-layout.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" style="position:absolute; left:40px; text-decoration:none; color:var(--muted); font-size:12px; font-weight:600; display:flex; align-items:center; gap:8px;">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="14" height="14">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali
        </a>
        <div class="brand-name">Wedding <em>Organizations</em></div>
    </nav>

    <div class="container">
        <div class="page-header">
            <h1>Kirim Saran &amp; Masukan</h1>
            <p>Pendapat Anda sangat berharga untuk meningkatkan layanan kami</p>
        </div>

        <div class="card">
            <div class="illustration">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    <line x1="9" y1="10" x2="15" y2="10"></line>
                    <line x1="12" y1="7" x2="12" y2="13"></line>
                </svg>
            </div>

            <form action="{{ route('saran.store') }}" method="POST">
                @csrf
                <div class="field">
                    <label>Kategori Masukan</label>
                    <select name="category" required>
                        <option value="" disabled selected>Pilih Kategori...</option>
                        <option value="layanan">Kualitas Layanan</option>
                        <option value="fitur">Usulan Fitur Baru</option>
                        <option value="bug">Laporan Masalah (Bug)</option>
                        <option value="mitra">Vendor &amp; Venue</option>
                        <option value="lainnya">Lainnya</option>
                    </select>
                </div>

                <div class="field">
                    <label>Judul Masukan</label>
                    <input type="text" name="title" placeholder="Singkat dan jelas mengenai saran Anda" required>
                </div>

                <div class="field">
                    <label>Detail Saran &amp; Masukan</label>
                    <textarea name="saran" placeholder="Jelaskan secara detail apa yang bisa kami tingkatkan untuk membantu Anda..." required></textarea>
                </div>

                <div class="action-bar">
                    <a href="{{ route('dashboard') }}" class="btn-cancel">Batal</a>
                    <button type="submit" class="btn-submit">Kirim Saran</button>
                </div>
            </form>
        </div>
    </div>
    <!-- Performance Optimization: Instant.page -->
    <script src="//instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipSbmfOOiyv9D41tqtGj73T9MToG+8m/N8eO0vHnF+mX402p99xUqS7B"></script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
