<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pesanan — Wedding Organizations</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
</head>
<body>

    <!-- --- STICKY TOP SECTION --- -->
    <div class="sticky-top">
        <!-- --- HEADER NAV --- -->
        <header class="header-bg">
            <div class="top-nav">
                <div class="nav-left">
                    <a href="javascript:history.back()" class="back-button" title="Kembali">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    </a>
                </div>
                <div class="nav-brand">Wedding <em>Organizations</em></div>
                <div style="width: 40px;"></div> <!-- Spacer for symmetry -->
            </div>
        </header>

        <!-- --- SUMMARY BAR --- -->
        <div class="summary-bar">
            <div class="search-pills-row">
                <div class="pill-display">📍 {{ $booking['location'] }}</div>
                <div class="pill-display">📅 {{ $booking['details']['check_in'] }} — {{ $booking['details']['check_out'] }}</div>
            </div>
        </div>
    </div>

    <!-- --- MAIN CONTENT --- -->
    <main>
        
        <!-- SIDE PANEL: Venue Info & Summary (STICKY) -->
        <article class="panel venue-preview">
            <div class="venue-image-wrap">
                <img src="{{ $booking['image'] }}" alt="{{ $booking['item_name'] }}">
            </div>
            
            <div class="venue-host">{{ $booking['owner'] }}</div>
            <h1 class="venue-title">{{ $booking['item_name'] }}</h1>
            
            <div class="venue-info-row">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                {{ $booking['location'] }}
            </div>

            <div class="price-display-mini">
                {{ $booking['price_per_night'] }} <span>/ Malam</span>
            </div>

            <!-- Ringkasan Pembayaran pindah ke sini agar Sticky -->
            <div class="section-title-mini">Ringkasan Pembayaran</div>
            <div class="summary-details">
                @foreach($booking['summary'] as $label => $price)
                    <div class="summary-item {{ $label == 'Total' ? 'total' : '' }} {{ str_contains(strtolower($label), 'diskon') ? 'discount' : '' }}">
                        <span class="label">{{ $label }}</span>
                        <span class="value">{{ $price }}</span>
                    </div>
                @endforeach
            </div>
        </article>

        <!-- MAIN PANEL: Checkout forms (SCROLLING) -->
        <section class="panel">
            
            <!-- Step 1: Verifikasi Detail Pemesanan -->
            <div class="section-title">1. Verifikasi Detail Pemesanan</div>
            <div class="summary-details">
                <div class="summary-item">
                    <span class="label">📅 Check-in</span>
                    <span class="value">{{ $booking['details']['check_in'] }}</span>
                </div>
                <div class="summary-item">
                    <span class="label">📅 Check-out</span>
                    <span class="value">{{ $booking['details']['check_out'] }}</span>
                </div>
                <div class="summary-item">
                    <span class="label">👤 Jumlah Tamu</span>
                    <span class="value">{{ $booking['details']['guests'] }} Tamu</span>
                </div>
                <div class="summary-item">
                    <span class="label">🌙 Durasi</span>
                    <span class="value">{{ $booking['details']['nights'] }} Malam</span>
                </div>
            </div>

            <!-- Step 2: Data Tamu -->
            <div class="section-title">2. Pengisian Data Tamu</div>
            <div class="guest-form">
                <div class="input-group">
                    <label class="input-label">NAMA LENGKAP</label>
                    <input type="text" name="guest_name" class="modern-input" placeholder="Masukkan nama sesuai KTP" value="{{ auth()->user()->name }}">
                </div>
                <div class="form-row">
                    <div class="input-group">
                        <label class="input-label">NOMOR TELEPON</label>
                        <input type="tel" name="guest_phone" class="modern-input" placeholder="08xx xxxx xxxx">
                    </div>
                    <div class="input-group">
                        <label class="input-label">EMAIL</label>
                        <input type="email" name="guest_email" class="modern-input" placeholder="email@contoh.com" value="{{ auth()->user()->email }}">
                    </div>
                </div>
                <div class="input-group">
                    <label class="input-label">PERMINTAAN KHUSUS (Opsional)</label>
                    <textarea name="special_request" class="modern-input" rows="2" placeholder="Contoh: Late check-in, kamar bebas asap rokok..."></textarea>
                </div>
            </div>

            <!-- Step 3: Kode Promo -->
            <div class="section-title">3. Kode Promo & Voucher</div>
            <div class="promo-box">
                <div class="input-group" style="flex: 1; margin-bottom: 0;">
                    <input type="text" class="modern-input" placeholder="Punya kode promo?">
                </div>
                <button type="button" class="btn-apply">Gunakan</button>
            </div>

            <!-- Step 4: Metode Pembayaran -->
            <div class="section-title">4. Metode Pembayaran</div>
            <div class="payment-methods">
                <button class="method-btn active" onclick="setTab(this,'card')">💳 Kartu</button>
                <button class="method-btn" onclick="setTab(this,'upi')">🏦 VA</button>
                <button class="method-btn" onclick="setTab(this,'bank')">🏧 Transfer</button>
                <button class="method-btn" onclick="setTab(this,'wallet')">📱 E-Wallet</button>
            </div>

            <form action="{{ route('checkout.pay') }}" method="POST" id="checkout-form">
                @csrf
                
                <!-- Card Detail -->
                <div id="form-card">
                    <div class="input-group">
                        <label class="input-label">NAMA DI KARTU</label>
                        <input type="text" name="card_name" class="modern-input" placeholder="Contoh: John Doe" autocomplete="cc-name">
                    </div>
                    <div class="input-group">
                        <label class="input-label">NOMOR KARTU</label>
                        <input type="text" id="cardnum" name="card_number" class="modern-input" placeholder="0000 0000 0000 0000" autocomplete="cc-number">
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label class="input-label">BERLAKU HINGGA</label>
                            <input type="text" name="card_expiry" class="modern-input" placeholder="MM/YY" autocomplete="cc-exp">
                        </div>
                        <div class="input-group">
                            <label class="input-label">CVV</label>
                            <input type="password" name="card_cvv" class="modern-input" placeholder="***" autocomplete="cc-csc">
                        </div>
                    </div>
                </div>

                <!-- UPI/VA Detail -->
                <div id="form-upi" style="display:none;">
                    <div class="input-group">
                        <label class="input-label">PILIH BANK VIRTUAL ACCOUNT</label>
                        <select class="modern-input">
                            <option>BCA Virtual Account</option>
                            <option>Mandiri Virtual Account</option>
                            <option>BNI Virtual Account</option>
                        </select>
                    </div>
                </div>

                <!-- Wallet Detail -->
                <div id="form-wallet" style="display:none;">
                    <div class="input-group">
                        <label class="input-label">PILIH E-WALLET</label>
                        <div class="wallet-options">
                            <label class="wallet-item"><input type="radio" name="wallet" value="gopay"> GoPay</label>
                            <label class="wallet-item"><input type="radio" name="wallet" value="ovo"> OVO</label>
                            <label class="wallet-item"><input type="radio" name="wallet" value="dana"> DANA</label>
                            <label class="wallet-item"><input type="radio" name="wallet" value="shopeepay"> ShopeePay</label>
                        </div>
                    </div>
                </div>

                <!-- Bank Detail -->
                <div id="form-bank" style="display:none;">
                    <div class="input-group">
                        <label class="input-label">PILIH BANK TUJUAN</label>
                        <select name="bank_name" class="modern-input">
                            <option value="" disabled selected>-- Pilih Bank --</option>
                            <option value="BCA">BCA (Bank Central Asia)</option>
                            <option value="MANDIRI">Mandiri</option>
                        </select>
                    </div>
                </div>

                <!-- Hidden Fields for Firebase Storage -->
                <input type="hidden" name="item_id" value="{{ request('venue_id') }}">
                <input type="hidden" name="item_name" value="{{ $booking['item_name'] }}">
                <input type="hidden" name="image" value="{{ str_replace(url('/'), '', $booking['image']) }}">
                <input type="hidden" name="location" value="{{ $booking['location'] }}">
                <input type="hidden" name="total_price" value="{{ preg_replace('/\D/', '', $booking['summary']['Total']) }}">

                <!-- Terms -->
                <div class="terms-check">
                    <label>
                        <input type="checkbox" id="terms" required> 
                        Saya menyetujui <a href="#">Syarat & Ketentuan</a> serta kebijakan privasi yang berlaku.
                    </label>
                </div>

                <button type="button" class="pay-now-btn" id="pay-btn" onclick="handlePay()">
                    BAYAR SEKARANG — {{ $booking['summary']['Total'] }}
                </button>
            </form>
            
        </section>

    </main>

    <script>
        function setTab(btn, form) {
            document.querySelectorAll('.method-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            ['card','upi','bank','wallet'].forEach(f => {
                const el = document.getElementById('form-' + f);
                if(el) el.style.display = (f === form ? 'block' : 'none');
            });
        }

        function handlePay() {
            const terms = document.getElementById('terms');
            if(!terms.checked) {
                alert("Silakan setujui Syarat & Ketentuan terlebih dahulu.");
                return;
            }

            const btn = document.getElementById('pay-btn');
            btn.innerHTML = '🛡️ Memverifikasi Keamanan...';
            btn.disabled = true;
            
            setTimeout(() => {
                btn.innerHTML = '🔑 Masukkan Kode OTP (Simulasi)';
                setTimeout(() => {
                    btn.innerHTML = '✔️ Pembayaran Berhasil! Mengirim Voucher...';
                    btn.style.background = '#27ae60';
                    setTimeout(() => document.getElementById('checkout-form').submit(), 1200);
                }, 2000);
            }, 1500);
        }

        // Card number formatting
        const cn = document.getElementById('cardnum');
        if(cn) cn.addEventListener('input', e => {
            let v = e.target.value.replace(/\D/g,'').slice(0,16);
            e.target.value = v.replace(/(.{4})/g,'$1 ').trim();
        });
    </script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
