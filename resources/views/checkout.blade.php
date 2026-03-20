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
                    <div class="input-group">
                        <label class="input-label">NOMOR TELEPON (UNTUK OTP)</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="tel" name="otp_phone" id="otp_phone_input" class="modern-input" placeholder="08xx xxxx xxxx" style="flex: 1;">
                            <button type="button" class="btn-apply" id="btn-send-otp" onclick="sendOTP()" style="white-space: nowrap; background: var(--primary); color: #fff; min-height: 48px;">Dapatkan OTP</button>
                        </div>
                    </div>

                    <div id="otp-section" style="display:none; margin-top: 5px;">
                        <div class="input-group">
                            <label class="input-label" style="color: var(--primary);">MASUKKAN KODE OTP</label>
                            <div style="display: flex; gap: 10px;">
                                <input type="text" id="otp_input" class="modern-input" placeholder="XXXXXX" maxlength="6" style="text-align: center; letter-spacing: 5px; font-weight: 700; flex: 1;">
                                <button type="button" class="btn-apply" id="btn-verify-otp" onclick="verifyOTP()" style="white-space: nowrap; background: #27ae60; color: #fff;">Verifikasi</button>
                            </div>
                            <p id="otp-status" style="font-size: 0.75rem; color: #27ae60; margin-top: 8px; font-weight: 500;"></p>
                        </div>
                    </div>
                </div>

                <!-- UPI/VA Detail -->
                <div id="form-upi" style="display:none;">
                    <div class="input-group">
                        <label class="input-label">PILIH BANK VIRTUAL ACCOUNT</label>
                        <select class="modern-input" id="va-selector" onchange="updateVA()">
                            <option value="" disabled selected>-- Pilih Bank --</option>
                            <option value="BCA">BCA Virtual Account</option>
                            <option value="MANDIRI">Mandiri Virtual Account</option>
                            <option value="BNI">BNI Virtual Account</option>
                        </select>
                    </div>

                    <!-- VA Number Display -->
                    <div id="va-display" class="va-premium-box" style="display:none;">
                        <div class="va-header">
                            <span id="va-bank-name">BANK</span>
                            <span class="va-tag">VIRTUAL ACCOUNT</span>
                        </div>
                        <div class="va-number-row">
                            <code id="va-number">8800000000000000</code>
                            <button type="button" class="btn-copy-va" onclick="copyVA()">Salin</button>
                        </div>
                        <p class="va-instruction">Mohon transfer tepat sesuai nominal hingga digit terakhir.</p>
                    </div>
                </div>

                <!-- Wallet Detail -->
                <div id="form-wallet" style="display:none;">
                    <div class="input-group">
                        <label class="input-label">PILIH E-WALLET</label>
                        <div class="wallet-options">
                            <label class="wallet-item"><input type="radio" name="wallet" value="gopay" onchange="updateWallet()"> GoPay</label>
                            <label class="wallet-item"><input type="radio" name="wallet" value="ovo" onchange="updateWallet()"> OVO</label>
                            <label class="wallet-item"><input type="radio" name="wallet" value="dana" onchange="updateWallet()"> DANA</label>
                            <label class="wallet-item"><input type="radio" name="wallet" value="shopeepay" onchange="updateWallet()"> ShopeePay</label>
                        </div>
                    </div>

                    <!-- Wallet Number Display -->
                    <div id="wallet-display" class="va-premium-box" style="display:none; border-color: #27ae60; background: #f6fff9;">
                        <div class="va-header">
                            <span id="wallet-name" style="color: #27ae60;">E-WALLET</span>
                            <span class="va-tag" style="background: #e6f9ed; color: #27ae60;">PAYMENT ID</span>
                        </div>
                        <div class="va-number-row" style="border-color: #e6f9ed;">
                            <code id="wallet-number" style="color: #27ae60;">08xx xxxx xxxx</code>
                            <button type="button" class="btn-copy-va" style="color: #27ae60; border-color: #27ae60;" onclick="copyWallet()">Salin</button>
                        </div>
                        <p class="va-instruction">Buka aplikasi E-Wallet Anda dan masukkan nomor di atas.</p>
                    </div>
                </div>

                <!-- Bank Detail -->
                <div id="form-bank" style="display:none;">
                    <div class="input-group">
                        <label class="input-label">PILIH BANK TUJUAN</label>
                        <select name="bank_name" class="modern-input" id="bank-selector" onchange="updateBank()">
                            <option value="" disabled selected>-- Pilih Bank --</option>
                            <option value="BCA">BCA (Bank Central Asia)</option>
                            <option value="MANDIRI">Mandiri</option>
                            <option value="BNI">BNI (Bank Negara Indonesia)</option>
                        </select>
                    </div>

                    <!-- Bank Account Display -->
                    <div id="bank-display" class="va-premium-box" style="display:none; border-color: #3498db; background: #f0f7ff;">
                        <div class="va-header">
                            <span id="bank-acc-name" style="color: #3498db;">BANK ACCOUNT</span>
                            <span class="va-tag" style="background: #e1effe; color: #3498db;">TRANSFER MANUAL</span>
                        </div>
                        <div class="va-number-row" style="border-color: #e1effe;">
                            <code id="bank-number" style="color: #3498db;">0000000000</code>
                            <button type="button" class="btn-copy-va" style="color: #3498db; border-color: #3498db;" onclick="copyBank()">Salin</button>
                        </div>
                        <p class="va-instruction" style="color: #3498db;">A/N Wedding Organizations. Pastikan transfer sebelum 24 jam.</p>
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
            const otpVerified = document.getElementById('otp_input').disabled;

            if (!otpVerified) {
                alert("Silakan masukkan kode OTP dan klik Verifikasi terlebih dahulu.");
                document.getElementById('otp_input').focus();
                return;
            }

            btn.innerHTML = '🛡️ Memproses Transaksi...';
            btn.disabled = true;
            
            setTimeout(() => {
                btn.innerHTML = '✔️ Pembayaran Berhasil! Mengirim Voucher...';
                btn.style.background = '#27ae60';
                setTimeout(() => document.getElementById('checkout-form').submit(), 1200);
            }, 2000);
        }

        function verifyOTP() {
            const otpInput = document.getElementById('otp_input');
            const status = document.getElementById('otp-status');
            const verifyBtn = document.getElementById('btn-verify-otp');
            
            if (otpInput.value.length < 4) {
                alert("Silakan masukkan kode OTP (simulasi) 4-6 digit.");
                return;
            }

            verifyBtn.innerHTML = '⏳...';
            
            setTimeout(() => {
                status.innerHTML = '✔️ OTP Berhasil Terverifikasi!';
                status.style.color = '#27ae60';
                otpInput.disabled = true;
                verifyBtn.disabled = true;
                verifyBtn.innerHTML = 'Berhasil';
                verifyBtn.style.background = '#218c4d';
            }, 1000);
        }

        function sendOTP() {
            const phoneInput = document.getElementById('otp_phone_input');
            const phone = phoneInput.value;
            const btn = document.getElementById('btn-send-otp');
            const status = document.getElementById('otp-status');
            const section = document.getElementById('otp-section');

            if (phone.length < 10) {
                alert("Silakan masukkan nomor telepon yang valid.");
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '⏳...';

            setTimeout(() => {
                section.style.display = 'block';
                status.style.display = 'block';
                status.innerHTML = `🛡️ Kode OTP telah dikirim ke nomor <b>${phone}</b>`;
                status.style.color = 'var(--text-muted)';
                btn.innerHTML = 'Kirim Ulang';
                btn.disabled = false;
                phoneInput.disabled = true;
            }, 1500);
        }

        function updateVA() {
            const selector = document.getElementById('va-selector');
            const display = document.getElementById('va-display');
            const bankNameEl = document.getElementById('va-bank-name');
            const vaNumEl = document.getElementById('va-number');
            
            if (selector.value) {
                display.style.display = 'block';
                bankNameEl.innerText = selector.value;
                
                // Generate fake VA based on bank
                let prefix = selector.value === 'BCA' ? '88000' : (selector.value === 'MANDIRI' ? '89000' : '82000');
                const randomPart = Math.floor(Math.random() * 9000000000) + 1000000000;
                vaNumEl.innerText = prefix + randomPart;
            }
        }

        function copyVA() {
            const vaNum = document.getElementById('va-number').innerText;
            navigator.clipboard.writeText(vaNum);
            
            const copyBtn = document.querySelector('#va-display .btn-copy-va');
            copyBtn.innerText = 'Tersalin!';
            copyBtn.style.background = '#27ae60';
            copyBtn.style.color = '#fff';
            
            setTimeout(() => {
                copyBtn.innerText = 'Salin';
                copyBtn.style.background = 'transparent';
                copyBtn.style.color = 'var(--primary)';
            }, 2000);
        }

        function updateWallet() {
            const display = document.getElementById('wallet-display');
            const nameEl = document.getElementById('wallet-name');
            const numEl = document.getElementById('wallet-number');
            const selected = document.querySelector('input[name="wallet"]:checked');
            
            if (selected) {
                display.style.display = 'block';
                nameEl.innerText = selected.value.toUpperCase();
                
                // Generate fake payment number
                numEl.innerText = '08' + Math.floor(Math.random() * 9000000000 + 1000000000);
            }
        }

        function copyWallet() {
            const num = document.getElementById('wallet-number').innerText;
            navigator.clipboard.writeText(num);
            
            const copyBtn = document.querySelector('#wallet-display .btn-copy-va');
            copyBtn.innerText = 'Tersalin!';
            copyBtn.style.background = '#27ae60';
            copyBtn.style.color = '#fff';
            
            setTimeout(() => {
                copyBtn.innerText = 'Salin';
                copyBtn.style.background = 'transparent';
                copyBtn.style.color = '#27ae60';
            }, 2000);
        }

        function updateBank() {
            const selector = document.getElementById('bank-selector');
            const display = document.getElementById('bank-display');
            const nameEl = document.getElementById('bank-acc-name');
            const numEl = document.getElementById('bank-number');
            
            if (selector.value) {
                display.style.display = 'block';
                if (selector.value === 'BCA') {
                    nameEl.innerText = 'BCA - 1234567890';
                    numEl.innerText = '1234567890';
                } else if (selector.value === 'MANDIRI') {
                    nameEl.innerText = 'MANDIRI - 9876543210';
                    numEl.innerText = '9876543210';
                } else {
                    nameEl.innerText = 'BNI - 1122334455';
                    numEl.innerText = '1122334455';
                }
            }
        }

        function copyBank() {
            const num = document.getElementById('bank-number').innerText;
            navigator.clipboard.writeText(num);
            
            const copyBtn = document.querySelector('#bank-display .btn-copy-va');
            copyBtn.innerText = 'Tersalin!';
            copyBtn.style.background = '#3498db';
            copyBtn.style.color = '#fff';
            
            setTimeout(() => {
                copyBtn.innerText = 'Salin';
                copyBtn.style.background = 'transparent';
                copyBtn.style.color = '#3498db';
            }, 2000);
        }

        // Card number formatting
        const cn = document.getElementById('cardnum');
        if(cn) cn.addEventListener('input', e => {
            let v = e.target.value.replace(/\D/g,'').slice(0,16);
            e.target.value = v.replace(/(.{4})/g,'$1 ').trim();
        });

        // Promo Logic
        const promoInput = document.querySelector('.promo-box input');
        const promoBtn = document.querySelector('.btn-apply');
        let appliedPromo = null;

        if (promoBtn) {
            promoBtn.addEventListener('click', () => {
                const code = promoInput.value.toUpperCase();
                if (!code) return;

                promoBtn.disabled = true;
                promoBtn.innerText = '⏳';

                fetch('{{ route("promos.validate") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ code: code })
                })
                .then(res => res.json())
                .then(data => {
                    if (data.valid) {
                        appliedPromo = data;
                        applyDiscount();
                        alert('Promo berhasil digunakan!');
                    } else {
                        alert(data.message);
                    }
                })
                .catch(err => alert('Gagal memproses kode promo'))
                .finally(() => {
                    promoBtn.disabled = false;
                    promoBtn.innerText = 'Gunakan';
                });
            });
        }

        function applyDiscount() {
            if (!appliedPromo) return;

            const totalEl = document.querySelector('.summary-item.total .value');
            const summaryDetails = document.querySelector('.summary-details');
            const payBtn = document.getElementById('pay-btn');
            
            let currentTotal = parseInt(totalEl.innerText.replace(/\D/g, ''));
            let discount = 0;

            if (appliedPromo.type === 'percentage') {
                discount = currentTotal * (appliedPromo.reward_value / 100);
            } else {
                discount = appliedPromo.reward_value;
            }

            const newTotal = currentTotal - discount;

            // Add discount row to summary
            const discRow = document.createElement('div');
            discRow.className = 'summary-item discount';
            discRow.style.color = '#27ae60';
            discRow.style.fontWeight = '600';
            discRow.innerHTML = `
                <span class="label">Potongan Promo</span>
                <span class="value">- Rp ${parseInt(discount).toLocaleString()}</span>
            `;
            
            const totalRow = document.querySelector('.summary-item.total');
            summaryDetails.insertBefore(discRow, totalRow);

            // Update Total
            totalEl.innerText = 'Rp ' + parseInt(newTotal).toLocaleString();
            
            // Update Pay Button
            if (payBtn) {
                payBtn.innerText = 'BAYAR SEKARANG — Rp ' + parseInt(newTotal).toLocaleString();
            }

            // Update hidden field
            document.querySelector('input[name="total_price"]').value = newTotal;
            
            // Disable promo input
            promoInput.disabled = true;
            promoBtn.disabled = true;
            promoBtn.innerText = '✔️';
        }
    </script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>

