<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selesaikan Pesanan Keranjang — Wedding Organizations</title>
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
    <style>
        .cart-items-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 10px;
        }
        .cart-checkout-item {
            display: flex;
            gap: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 16px;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }
        .cart-checkout-item:hover {
            box-shadow: var(--shadow-soft);
            border-color: var(--primary-light);
            transform: translateY(-2px);
        }
        .item-thumb-link {
            flex-shrink: 0;
            width: 110px;
            height: 110px;
            border-radius: 12px;
            overflow: hidden;
        }
        .item-thumb {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .item-details {
            flex: 1;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .item-type-tag {
            display: inline-block;
            font-size: 0.65rem;
            font-weight: 700;
            color: var(--primary);
            text-transform: uppercase;
            letter-spacing: 1px;
            margin-bottom: 6px;
            background: var(--primary-light);
            padding: 2px 8px;
            border-radius: 4px;
            width: fit-content;
        }
        .item-name-checkout {
            font-family: 'Playfair Display', serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin: 0 0 5px 0;
            color: var(--text-main);
            line-height: 1.3;
        }
        .item-price-checkout {
            font-size: 0.95rem;
            font-weight: 600;
            color: var(--primary);
            margin-top: 2px;
        }
        .item-location-checkout {
            font-size: 0.8rem;
            color: var(--text-muted);
            display: flex;
            align-items: center;
            gap: 4px;
            margin-top: 5px;
        }
        .item-location-checkout svg {
            width: 12px;
            opacity: 0.6;
        }
        
        /* Summary Box refinements */
        .summary-mini-card {
            background: #fffafa;
            border: 1px solid var(--primary-light);
            border-radius: 15px;
            padding: 20px;
            margin-top: 25px;
        }
        .summary-total-large {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px dashed var(--primary-light);
        }
        .total-label {
            font-weight: 600;
            color: var(--text-main);
        }
        .total-amount {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary);
        }

        /* Ensure side panel and float cart are hidden to avoid design breakage */
        #cartPanel, #cartFloatBtn, .cart-overlay {
            display: none !important;
        }

        /* Premium Spinner */
        .loading-spinner-premium {
            width: 40px;
            height: 40px;
            border: 2px solid var(--primary-light);
            border-top: 2px solid var(--primary);
            border-radius: 50%;
            animation: premiumSpin 0.8s cubic-bezier(0.5, 0.1, 0.4, 0.9) infinite;
            margin: 0 auto;
        }
        @keyframes premiumSpin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        @keyframes spin { to { transform: rotate(360deg); } }

        /* Sticky Panel Logic */
        main {
            align-items: flex-start; /* Prevent grid children from stretching to full height */
        }
        article.panel {
            position: sticky;
            top: 100px;
            max-height: calc(100vh - 120px);
            overflow-y: auto;
            scrollbar-width: none; /* Hide scrollbar for cleaner look */
        }
        article.panel::-webkit-scrollbar {
            display: none;
        }

        @media (max-width: 850px) {
            article.panel {
                position: static;
                max-height: none;
            }
        }
    </style>
</head>
<body>

    <div class="sticky-top">
        <header class="header-bg">
            <div class="top-nav">
                <div class="nav-left">
                    <a href="javascript:history.back()" class="back-button" title="Kembali">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>
                    </a>
                </div>
                <div class="nav-brand">Wedding <em>Organizations</em></div>
                <div style="width: 40px;"></div>
            </div>
        </header>

        <div class="summary-bar">
            <div class="search-pills-row">
                <div class="pill-display">🛒 Konfirmasi Keranjang Impian</div>
                <div class="pill-display" id="total-items-pill">0 Item</div>
            </div>
        </div>
    </div>

    <main>
        <!-- LEFT PANEL: Items Overview -->
        <article class="panel">
            <div class="section-title">📦 Item Dalam Keranjang</div>
            <div id="cart-items-container" class="cart-items-list">
                <div id="cart-loading" style="text-align: center; padding: 60px 20px;">
                    <div class="loading-spinner-premium"></div>
                    <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 20px;">Menyelaraskan keranjang impian Anda...</p>
                </div>
                <div id="cart-empty-state" style="display:none; text-align: center; padding: 40px 20px;">
                    <img src="{{ asset('brain/32604c8c-42c5-498b-8790-ae4a010cfe6a/wedding_empty_cart_illustration_1773374405026.png') }}" 
                         alt="Empty Cart" style="width: 100%; max-width: 280px; margin-bottom: 25px; opacity: 0.9;">
                    <h3 style="font-family: 'Playfair Display', serif; font-size: 1.4rem; color: var(--text-main); margin-bottom: 10px;">Keranjang Masih Kosong</h3>
                    <p style="color: var(--text-muted); font-size: 0.85rem; line-height: 1.6; margin-bottom: 25px;">
                        Jelajahi kembali koleksi venue dan vendor kami untuk menemukan yang sempurna bagi hari bahagia Anda.
                    </p>
                    <a href="{{ route('venues.index') }}" class="btn-apply" style="padding: 12px 30px; text-decoration: none; display: inline-block;">Jelajahi Sekarang</a>
                </div>
            </div>

            <div id="summary-section" class="summary-mini-card" style="display:none;">
                <div class="summary-item">
                    <span class="label">Subtotal Item</span>
                    <span class="value" id="summary-subtotal">IDR 0</span>
                </div>
                <div class="summary-item">
                    <span class="label">Biaya Layanan</span>
                    <span class="value">IDR 50.000</span>
                </div>
                <div class="summary-item">
                    <span class="label">Pajak (11%)</span>
                    <span class="value" id="summary-tax">IDR 0</span>
                </div>
                <div class="summary-total-large">
                    <span class="total-label">Total Pembayaran</span>
                    <span class="total-amount" id="summary-total">IDR 0</span>
                </div>
            </div>
        </article>

        <!-- RIGHT PANEL: Guest Data & Payment -->
        <section class="panel">
            <form id="checkout-form" action="{{ route('checkout.pay') }}" method="POST">
                @csrf
                <div id="cart-hidden-inputs"></div>

                <div class="section-title">1. Data Pemesan</div>
                <div class="guest-form">
                    <div class="form-row">
                        <div class="input-group">
                            <label class="input-label">NAMA LENGKAP</label>
                            <input type="text" name="guest_name" class="modern-input" placeholder="Nama sesuai KTP" value="{{ auth()->user()->name }}" required>
                        </div>
                        <div class="input-group">
                            <label class="input-label">EMAIL</label>
                            <input type="email" name="guest_email" class="modern-input" value="{{ auth()->user()->email }}" readonly style="background: #f9f9f9; cursor: not-allowed;">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="input-label">NOMOR TELEPON</label>
                        <input type="tel" name="guest_phone" class="modern-input" placeholder="08xxxxxxxxxx" required>
                    </div>
                    <div class="input-group">
                        <label class="input-label">ALAMAT LENGKAP</label>
                        <textarea name="guest_address" class="modern-input" placeholder="Alamat rumah atau lokasi pengiriman..." style="min-height: 60px; resize: vertical; padding-top: 12px;" required></textarea>
                    </div>
                    <div class="input-group">
                        <label class="input-label">CATATAN TAMBAHAN (OPSIONAL)</label>
                        <textarea name="notes" class="modern-input" placeholder="Permintaan khusus atau pesan tambahan..." style="min-height: 80px; resize: vertical; padding-top: 12px;"></textarea>
                    </div>
                </div>

                <div class="section-title">2. Metode Pembayaran</div>
                <div class="payment-methods">
                    <button type="button" class="method-btn active" onclick="setTab(this, 'card')">💳 Kartu</button>
                    <button type="button" class="method-btn" onclick="setTab(this, 'upi')">🏛️ VA</button>
                    <button type="button" class="method-btn" onclick="setTab(this, 'wallet')">📱 E-Wallet</button>
                    <button type="button" class="method-btn" onclick="setTab(this, 'bank')">📤 Transfer</button>
                </div>

                <!-- Payment details sections same as before but inside the grid -->
                <!-- Reuse all payment form sections from previous implementation... -->
                <div id="form-card">
                    <!-- ... Card Inputs ... -->
                    <div class="input-group">
                        <label class="input-label">NAMA DI KARTU</label>
                        <input type="text" class="modern-input" placeholder="Contoh: John Doe">
                    </div>
                    <div class="input-group">
                        <label class="input-label">NOMOR KARTU</label>
                        <input type="text" id="cardnum" class="modern-input" placeholder="0000 0000 0000 0000">
                    </div>
                    <div class="form-row">
                        <div class="input-group">
                            <label class="input-label">BERLAKU HINGGA</label>
                            <input type="text" class="modern-input" placeholder="MM/YY">
                        </div>
                        <div class="input-group">
                            <label class="input-label">CVV</label>
                            <input type="password" class="modern-input" placeholder="***">
                        </div>
                    </div>
                    <div class="input-group">
                        <label class="input-label">NOMOR TELEPON (OTP)</label>
                        <div style="display: flex; gap: 10px;">
                            <input type="tel" id="otp_phone_input" class="modern-input" placeholder="08xx..." style="flex: 1;">
                            <button type="button" class="btn-apply" id="btn-send-otp" onclick="sendOTP()" style="white-space: nowrap; background: var(--primary); color: #fff;">Dapatkan OTP</button>
                        </div>
                    </div>
                    <div id="otp-section" style="display:none; margin-top: 10px;">
                        <div class="input-group">
                            <label class="input-label" style="color: var(--primary);">KODE OTP</label>
                            <input type="text" id="otp_input" class="modern-input" placeholder="XXXXXX" maxlength="6" style="text-align: center; font-weight: 700;">
                            <p id="otp-status" style="font-size: 0.75rem; color: #27ae60; margin-top: 8px;"></p>
                        </div>
                    </div>
                </div>

                <div id="form-upi" style="display:none;">
                    <div class="input-group">
                        <label class="input-label">PILIH BANK VA</label>
                        <select class="modern-input" id="va-selector" onchange="updateVA()">
                            <option value="" disabled selected>-- Pilih Bank --</option>
                            <option value="BCA">BCA Virtual Account</option>
                            <option value="MANDIRI">Mandiri Virtual Account</option>
                            <option value="BNI">BNI Virtual Account</option>
                        </select>
                    </div>
                    <div id="va-display" class="va-premium-box" style="display:none;">
                        <div class="va-header">
                            <span id="va-bank-name">BANK</span>
                            <span class="va-tag">VIRTUAL ACCOUNT</span>
                        </div>
                        <div class="va-number-row">
                            <code id="va-number">8800000000000000</code>
                            <button type="button" class="btn-copy-va" onclick="copyVA()">Salin</button>
                        </div>
                    </div>
                </div>

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
                    <div id="wallet-display" class="va-premium-box" style="display:none; border-color: #27ae60; background: #f6fff9;">
                        <div class="va-header"><span id="wallet-name" style="color: #27ae60;">E-WALLET</span><span class="va-tag" style="background: #e6f9ed; color: #27ae60;">PAYMENT ID</span></div>
                        <div class="va-number-row" style="border-color: #e6f9ed;"><code id="wallet-number" style="color: #27ae60;">08xx xxxx xxxx</code><button type="button" class="btn-copy-va" style="color: #27ae60; border-color: #27ae60;" onclick="copyWallet()">Salin</button></div>
                    </div>
                </div>

                <div id="form-bank" style="display:none;">
                    <div class="input-group">
                        <label class="input-label">BANK TUJUAN</label>
                        <select name="bank_name" class="modern-input" id="bank-selector" onchange="updateBank()">
                            <option value="" disabled selected>-- Pilih Bank --</option>
                            <option value="BCA">BCA (Bank Central Asia)</option>
                            <option value="MANDIRI">Mandiri</option>
                            <option value="BNI">BNI (Bank Negara Indonesia)</option>
                        </select>
                    </div>
                    <div id="bank-display" class="va-premium-box" style="display:none; border-color: #3498db; background: #f0f7ff;">
                        <div class="va-header"><span id="bank-acc-name" style="color: #3498db;">BANK ACCOUNT</span><span class="va-tag" style="background: #e1effe; color: #3498db;">TRANSFER MANUAL</span></div>
                        <div class="va-number-row" style="border-color: #e1effe;"><code id="bank-number" style="color: #3498db;">0000000000</code><button type="button" class="btn-copy-va" style="color: #3498db; border-color: #3498db;" onclick="copyBank()">Salin</button></div>
                    </div>
                </div>

                <div class="terms-check">
                    <label>
                        <input type="checkbox" id="terms" required checked> 
                        Saya menyetujui <a href="#">Syarat & Ketentuan</a>.
                    </label>
                </div>

                <button type="button" class="pay-now-btn" id="pay-btn" onclick="handlePay()">
                    BAYAR SEKARANG — <span id="btn-total-label">IDR 0</span>
                </button>
            </form>
        </section>
    </main>

    <script src="{{ asset('js/cart.js') }}"></script>
    <script>
        let isOtpSent = false;
        let activePaymentTab = 'card';

        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(loadCartItems, 500); // Small delay for premium feel
        });

        function loadCartItems() {
            const cart = getCart();
            const container = document.getElementById('cart-items-container');
            const hiddenInputs = document.getElementById('cart-hidden-inputs');
            const loading = document.getElementById('cart-loading');
            const emptyState = document.getElementById('cart-empty-state');
            const summarySection = document.getElementById('summary-section');
            
            loading.style.display = 'none';

            if (cart.length === 0) {
                emptyState.style.display = 'block';
                summarySection.style.display = 'none';
                document.getElementById('pay-btn').disabled = true;
                document.getElementById('pay-btn').style.opacity = '0.5';
                return;
            }

            emptyState.style.display = 'none';
            summarySection.style.display = 'block';
            document.getElementById('total-items-pill').innerText = cart.length + ' Item';

            let subtotal = 0;
            let itemsHtml = '';
            hiddenInputs.innerHTML = '';

            cart.forEach((item, index) => {
                const priceMatch = item.price.match(/[\d.]+/);
                const priceValue = priceMatch ? parseInt(priceMatch[0].replace(/\./g, '')) : 0;
                subtotal += priceValue;

                itemsHtml += `
                    <div class="cart-checkout-item">
                        <div class="item-thumb-link">
                            <img src="${item.image}" class="item-thumb" alt="${item.name}" onerror="this.src='https://via.placeholder.com/150?text=No+Image'">
                        </div>
                        <div class="item-details">
                            <div class="item-type-tag">${item.type === 'venue' ? '🏛 Venue' : '🌸 Vendor'}</div>
                            <h3 class="item-name-checkout">${item.name}</h3>
                            <div class="item-price-checkout">${item.price}</div>
                            <div class="item-location-checkout">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                ${item.location}
                            </div>
                        </div>
                    </div>
                `;

                hiddenInputs.innerHTML += `
                    <input type="hidden" name="cart_items[${index}][id]" value="${item.id}">
                    <input type="hidden" name="cart_items[${index}][type]" value="${item.type}">
                    <input type="hidden" name="cart_items[${index}][name]" value="${item.name}">
                    <input type="hidden" name="cart_items[${index}][image]" value="${item.image}">
                    <input type="hidden" name="cart_items[${index}][location]" value="${item.location}">
                    <input type="hidden" name="cart_items[${index}][price_numeric]" value="${priceValue}">
                `;
            });

            // Set the final HTML with a single wrapper
            container.innerHTML = `<div class="cart-items-list">${itemsHtml}</div>`;

            const serviceFee = 50000;
            const tax = Math.round(subtotal * 0.11);
            const total = subtotal + serviceFee + tax;

            document.getElementById('summary-subtotal').innerText = 'IDR ' + subtotal.toLocaleString('id-ID');
            document.getElementById('summary-tax').innerText = 'IDR ' + tax.toLocaleString('id-ID');
            document.getElementById('summary-total').innerText = 'IDR ' + total.toLocaleString('id-ID');
            document.getElementById('btn-total-label').innerText = 'IDR ' + total.toLocaleString('id-ID');
        }

        // Form Helpers
        function setTab(btn, form) {
            activePaymentTab = form;
            document.querySelectorAll('.method-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            ['card','upi', 'wallet', 'bank'].forEach(f => {
                const el = document.getElementById('form-' + f);
                if(el) el.style.display = (f === form ? 'block' : 'none');
            });
        }

        function handlePay() {
            if(!document.getElementById('terms').checked) { 
                woShowNotification('error', 'Ketentuan', 'Silakan setujui Syarat & Ketentuan.'); 
                return; 
            }

            // Simplified OTP Validation
            if (activePaymentTab === 'card') {
                if (!isOtpSent) {
                    woShowNotification('error', 'OTP Diperlukan', 'Silakan klik "Dapatkan OTP" terlebih dahulu.');
                    return;
                }
                const otpInput = document.getElementById('otp_input').value;
                if (otpInput.length < 6) {
                    woShowNotification('error', 'OTP Tidak Valid', 'Silakan masukkan 6 digit kode OTP.');
                    return;
                }
            }

            const btn = document.getElementById('pay-btn');
            btn.innerHTML = '🛡️ Memproses Pesanan...';
            btn.disabled = true;
            setTimeout(() => { clearCart(); document.getElementById('checkout-form').submit(); }, 1500);
        }

        function sendOTP() {
            const p = document.getElementById('otp_phone_input').value;
            if(p.length < 10) { 
                woShowNotification('error', 'Gagal', 'Nomor telepon tidak valid.');
                return; 
            }
            
            // Generate simple random OTP for simulation
            const mockOTP = Math.floor(100000 + Math.random() * 900000);
            isOtpSent = true;
            
            document.getElementById('otp-section').style.display = 'block';
            document.getElementById('otp-status').innerHTML = 'OTP dikirim ke <b>' + p + '</b>';
            
            // Show the "received" OTP in a notification so the user can use it
            setTimeout(() => {
                woShowNotification('success', 'SMS Masuk', 'Kode OTP Anda adalah: <b>' + mockOTP + '</b>');
                document.getElementById('otp_input').value = mockOTP; // Auto-fill for convenience in simulation
                woShowNotification('info', 'Tips', 'Kode otomatis terisi. Klik Bayar Sekarang untuk konfirmasi.');
            }, 1000);
        }

        // verifyOTP removed and integrated into handlePay

        function updateVA() {
            const v = document.getElementById('va-selector').value;
            const d = document.getElementById('va-display');
            if(v) {
                d.style.display = 'block';
                document.getElementById('va-bank-name').innerText = v;
                document.getElementById('va-number').innerText = (v === 'BCA' ? '8800' : '8900') + Math.floor(Math.random()*100000000);
            }
        }
        
        function updateWallet() {
            const s = document.querySelector('input[name="wallet"]:checked');
            if(s) {
                document.getElementById('wallet-display').style.display = 'block';
                document.getElementById('wallet-name').innerText = s.value.toUpperCase();
                document.getElementById('wallet-number').innerText = '08' + Math.floor(Math.random()*1000000000);
            }
        }

        function updateBank() {
            const s = document.getElementById('bank-selector').value;
            if(s) {
                document.getElementById('bank-display').style.display = 'block';
                document.getElementById('bank-acc-name').innerText = s + ' - Wedding Org';
                document.getElementById('bank-number').innerText = Math.floor(Math.random()*10000000000);
            }
        }

        function copyVA() { alert("VA Berhasil Disalin"); }
        function copyWallet() { alert("ID Pembayaran Disalin"); }
        function copyBank() { alert("Nomor Rekening Disalin"); }
    </script>
</body>
</html>
