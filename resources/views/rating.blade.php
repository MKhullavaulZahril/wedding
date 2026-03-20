<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review & Rating - Wedding Organizations</title>
    <link rel="stylesheet" href="{{ asset('css/rating.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global-layout.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('home') }}" style="position:absolute; left:40px; text-decoration:none; color:var(--muted); font-size:12px; font-weight:600; display:flex; align-items:center; gap:8px;">
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
            <h1>Review &amp; Rating</h1>
            <p>Bagikan pengalaman Anda dan bantu calon pengantin lainnya</p>
        </div>

        @if(session('success'))
            <div style="background:#e6f4ea; color:#1e7e34; padding:15px; border-radius:10px; margin-bottom:20px; font-size:13px; font-weight:600;">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div style="background:#fce8e6; color:#d93025; padding:15px; border-radius:10px; margin-bottom:20px; font-size:13px; font-weight:600;">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid-layout">
            <!-- Left Column: Form -->
            <div class="form-column">
                <div class="card">
                    <div class="card-header">
                        <div class="header-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                            </svg>
                        </div>
                        <div>
                            <h2>Tulis Ulasan</h2>
                            <p style="font-size:10px; color:var(--muted); margin-top:2px;">Ceritakan pengalaman pernikahan Anda</p>
                        </div>
                    </div>

                    <form action="#" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="venue-box">
                            <img src="{{ asset('img/gallery1.jpg') }}" onerror="this.src='https://images.unsplash.com/photo-1519225421980-715cb0215aed?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80'" alt="Venue">
                            <div class="venue-box-info">
                                <h4>Royal Wedding Hall</h4>
                                <p>118, Townhall Resort 15, Custom</p>
                                <div class="date">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="10" height="10"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>
                                    Pernikahan: 14 Februari 2026
                                </div>
                            </div>
                        </div>

                        <div class="section-label">Penilaian Keseluruhan</div>
                        <div class="stars-interactive" id="mainStars">
                            @for($i=1; $i<=5; $i++)
                                <svg viewBox="0 0 24 24" data-value="{{$i}}" onclick="setMainRating({{$i}})"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                            @endfor
                        </div>
                        <p class="helper-text">Klik bintang untuk memberi penilaian</p>
                        <input type="hidden" name="rating_overall" id="ratingOverall" value="0">

                        <div class="section-label">Penilaian Per Aspek</div>
                        <div class="aspects-grid">
                            <div class="aspect-box">
                                <div class="aspect-header">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 21h18"></path><path d="M19 21v-4"></path><path d="M19 17a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v4"></path><path d="M12 15V3"></path><path d="M7 6h10"></path></svg>
                                    Venue &amp; Fasilitas
                                </div>
                                <div class="aspect-stars" data-target="rating_venue">
                                    @for($i=1; $i<=5; $i++)
                                    <svg viewBox="0 0 24 24" data-val="{{$i}}"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating_venue" id="rating_venue" value="0">
                            </div>
                            <div class="aspect-box">
                                <div class="aspect-header">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"></path><path d="M14 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"></path><path d="M10 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"></path><path d="M6 11V6a2 2 0 0 0-2-2v0a2 2 0 0 0-2 2v0"></path><line x1="2" y1="11" x2="22" y2="11"></line><path d="M12 11v10"></path><path d="M8 11v10"></path><path d="M16 11v10"></path></svg>
                                    Katering
                                </div>
                                <div class="aspect-stars" data-target="rating_catering">
                                    @for($i=1; $i<=5; $i++)
                                    <svg viewBox="0 0 24 24" data-val="{{$i}}"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating_catering" id="rating_catering" value="0">
                            </div>
                            <div class="aspect-box">
                                <div class="aspect-header">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                    Pelayanan
                                </div>
                                <div class="aspect-stars" data-target="rating_service">
                                    @for($i=1; $i<=5; $i++)
                                    <svg viewBox="0 0 24 24" data-val="{{$i}}"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating_service" id="rating_service" value="0">
                            </div>
                            <div class="aspect-box">
                                <div class="aspect-header">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                                    Harga
                                </div>
                                <div class="aspect-stars" data-target="rating_price">
                                    @for($i=1; $i<=5; $i++)
                                    <svg viewBox="0 0 24 24" data-val="{{$i}}"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                    @endfor
                                </div>
                                <input type="hidden" name="rating_price" id="rating_price" value="0">
                            </div>
                        </div>

                        <div class="section-label">Ulasan Anda</div>
                        <textarea placeholder="Ceritakan pengalaman pernikahan Anda di venue ini. Apa yang paling berkesan? Adakah hal yang perlu ditingkatkan?" name="review_text"></textarea>

                        <div class="section-label">Tambah Foto (Opsional)</div>
                        <div class="upload-btn" onclick="document.getElementById('review_photo').click()">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" width="20" height="20"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
                        </div>
                        <input type="file" id="review_photo" name="review_photo" accept="image/*" style="display:none">

                        <div class="toggle-row">
                            <input type="hidden" name="is_anonymous" id="is_anonymous" value="0">
                            <div class="toggle-switch" id="anonToggle"></div>
                            <div class="toggle-label">Posting Anonim &mdash; <span>Nama Anda tidak akan ditampilkan</span></div>
                        </div>

                        <button type="submit" class="btn-submit">KIRIM ULASAN</button>
                    </form>
                </div>
            </div>

            <!-- Right Column: Stats & List -->
            <div class="summary-column">
                <div class="card" style="padding:40px 30px;">
                    <h2 class="section-label" style="font-size:12px; color:var(--ink); margin-bottom:24px; text-transform:none; letter-spacing:0.02em;">Statistik Rating</h2>
                    
                    <div class="rating-stats">
                        <div class="rating-score">4.9</div>
                        <div class="rating-stars">
                            @for($i=0; $i<5; $i++)
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                            @endfor
                        </div>
                        <div class="rating-count">dari 48 ulasan terverifikasi</div>
                    </div>

                    <div class="bars-wrap">
                        <div class="bar-row">
                            <span>5</span>
                            <div class="bar-track"><div class="bar-fill" style="width: 82%;"></div></div>
                            <span class="bar-pct">82%</span>
                        </div>
                        <div class="bar-row">
                            <span>4</span>
                            <div class="bar-track"><div class="bar-fill" style="width: 12%;"></div></div>
                            <span class="bar-pct">12%</span>
                        </div>
                        <div class="bar-row">
                            <span>3</span>
                            <div class="bar-track"><div class="bar-fill" style="width: 4%;"></div></div>
                            <span class="bar-pct">4%</span>
                        </div>
                        <div class="bar-row">
                            <span>2</span>
                            <div class="bar-track"><div class="bar-fill" style="width: 1%;"></div></div>
                            <span class="bar-pct">1%</span>
                        </div>
                        <div class="bar-row">
                            <span>1</span>
                            <div class="bar-track"><div class="bar-fill" style="width: 1%;"></div></div>
                            <span class="bar-pct">1%</span>
                        </div>
                    </div>
                </div>

                <div class="card" style="padding:30px;">
                    <div class="reviews-header">
                        <h3>Ulasan Terbaru</h3>
                        <div class="sort-btn">Terbaru ▾</div>
                    </div>

                    <div class="review-item" style="animation: fadeInUp 0.8s ease backwards; animation-delay: 0.2s;">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">A</div>
                            <div class="reviewer-text">
                                <h4>Anisa &amp; Reza</h4>
                                <p>14 Februari 2026</p>
                            </div>
                            <div class="reviewer-rating">
                                @for($i=0; $i<5; $i++)
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                @endfor
                            </div>
                        </div>
                        <div class="review-content">
                            Tempat yang luar biasa! Dekorasi sangat elegan dan sesuai harapan kami. Tim pelayanan sangat profesional dan responsif. Tamu-tamu kami sangat terkesan dengan keindahan venue ini.
                        </div>
                        <div class="review-tags">
                            <span class="tag">VENUE INDAH</span>
                            <span class="tag">PELAYANAN RAMAH</span>
                            <span class="tag">RECOMMENDED</span>
                        </div>
                        <button class="btn-helpful">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                            Membantu (12)
                        </button>
                    </div>

                    <div class="review-item" style="animation: fadeInUp 0.8s ease backwards; animation-delay: 0.4s;">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">D</div>
                            <div class="reviewer-text">
                                <h4>Dewi Kartika</h4>
                                <p>2 Januari 2026</p>
                            </div>
                            <div class="reviewer-rating">
                                @for($i=0; $i<5; $i++)
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                @endfor
                            </div>
                        </div>
                        <div class="review-content">
                            Pernikahan kami berjalan sempurna berkat koordinasi yang baik dari tim Royal Wedding Hall. Katering juga enak dan bervariasi. Sangat rekomendasikan!
                        </div>
                        <div class="review-tags">
                            <span class="tag">KATERING LEZAT</span>
                            <span class="tag">KOORDINASI BAIK</span>
                        </div>
                        <button class="btn-helpful">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                            Membantu (8)
                        </button>
                    </div>

                    <div class="review-item" style="animation: fadeInUp 0.8s ease backwards; animation-delay: 0.6s;">
                        <div class="reviewer-info">
                            <div class="reviewer-avatar">B</div>
                            <div class="reviewer-text">
                                <h4>Budi Santoso</h4>
                                <p>16 Desember 2025</p>
                            </div>
                            <div class="reviewer-rating">
                                @for($i=0; $i<4; $i++)
                                <svg viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                                @endfor
                                <svg viewBox="0 0 24 24" style="color:var(--star-empty);"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path></svg>
                            </div>
                        </div>
                        <div class="review-content">
                            Overall memuaskan. Venue cukup luas dan nyaman. Mungkin parkirannya bisa ditambah lagi untuk acara besar. Pelayanan staf sudah sangat baik.
                        </div>
                        <div class="review-tags">
                            <span class="tag">VENUE LUAS</span>
                        </div>
                        <button class="btn-helpful">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M14 9V5a3 3 0 0 0-3-3l-4 9v11h11.28a2 2 0 0 0 2-1.7l1.38-9a2 2 0 0 0-2-2.3zM7 22H4a2 2 0 0 1-2-2v-7a2 2 0 0 1 2-2h3"></path></svg>
                            Membantu (5)
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script>
        // Main Stars
        const mainStars = document.querySelectorAll('#mainStars svg');
        const overallInput = document.getElementById('ratingOverall');
        
        function setMainRating(val) {
            overallInput.value = val;
            mainStars.forEach((star, i) => {
                star.classList.toggle('active', i < val);
            });
        }

        // Hover effect for main stars
        mainStars.forEach((star, index) => {
            star.addEventListener('mouseenter', () => {
                mainStars.forEach((s, i) => s.classList.toggle('selected', i <= index));
            });
            star.addEventListener('mouseleave', () => {
                mainStars.forEach(s => s.classList.remove('selected'));
            });
        });

        // Aspect Stars
        const aspectContainers = document.querySelectorAll('.aspect-stars');
        aspectContainers.forEach(container => {
            const stars = container.querySelectorAll('svg');
            const targetId = container.dataset.target;
            const inputField = document.getElementById(targetId);

            stars.forEach((star, index) => {
                star.addEventListener('click', () => {
                    const val = index + 1;
                    inputField.value = val;
                    stars.forEach((s, i) => s.classList.toggle('active', i < val));
                });
                
                star.addEventListener('mouseenter', () => {
                    stars.forEach((s, i) => s.classList.toggle('selected', i <= index));
                });
                
                star.addEventListener('mouseleave', () => {
                    stars.forEach(s => s.classList.remove('selected'));
                });
            });
        });

        // Anonymous Toggle
        const anonToggle = document.getElementById('anonToggle');
        const anonInput = document.getElementById('is_anonymous');
        anonToggle.addEventListener('click', function() {
            this.classList.toggle('active');
            anonInput.value = this.classList.contains('active') ? '1' : '0';
        });

        // Upload Photo Preview (Opsional, tambahan jika digunakan)
        document.getElementById('review_photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const btn = document.querySelector('.upload-btn');
                    btn.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; border-radius:10px; object-fit:cover;">`;
                    btn.style.border = 'none';
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <!-- Performance Optimization: Instant.page -->
    <script src="//instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipSbmfOOiyv9D41tqtGj73T9MToG+8m/N8eO0vHnF+mX402p99xUqS7B"></script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>

