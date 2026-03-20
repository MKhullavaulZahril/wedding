<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi — Wedding Organizations</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth_premium.css') }}">
    <style>
        /* Panel Transition Styles */
        .auth-panel { display: none; width: 100%; animation: fadeUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
        .auth-panel.active { display: block; }
        
        .otp-group { display: flex; gap: 12px; justify-content: center; margin-bottom: 32px; }
        .otp-input {
            width: 60px; height: 72px;
            background: var(--ivory);
            border: 1px solid var(--border);
            border-radius: 12px;
            font-family: 'Jost', sans-serif;
            font-size: 1.8rem;
            font-weight: 500;
            text-align: center;
            color: var(--ink);
            transition: all 0.3s ease;
        }
        .otp-input:focus { border-color: var(--gold); background: #fff; box-shadow: 0 8px 20px rgba(201,169,110,0.12); outline: none; }
        
        .success-seal {
            width: 80px; height: 80px;
            background: #F4FBF6;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
            color: #6EA87A;
            border: 1px solid rgba(110,168,122,0.15);
        }
    </style>
</head>
<body>

    <div class="loading-overlay" id="loadingOverlay">
        <div class="loading-spinner"></div>
        <p class="loading-text">Memproses…</p>
    </div>

    <div class="layout">

        <div class="panel-left">
            <div class="panel-left-bg"></div>
            <div class="panel-left-overlay"></div>
            <div class="panel-left-content">
                <div class="brand">
                    <div class="brand-mark">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20.42 4.58a5 5 0 0 1 0 7.07l-7.07 7.07a1 1 0 0 1-1.41 0L4.86 11.65a5 5 0 1 1 7.07-7.07l.35.35.35-.35a5 5 0 0 1 7.07 0z"/>
                        </svg>
                        <span class="brand-name">Wedding Organizations</span>
                    </div>
                </div>
                <h2 class="panel-tagline">Kembali ke<br><em>Rencana</em> Anda</h2>
                <p class="panel-desc">Kami akan membantu memulihkan akses akun Anda<br>agar persiapan hari bahagia tetap berjalan lancar.</p>
                <div class="panel-dots">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>

        <div class="resizer" id="resizer">
            <div class="resizer-handle"></div>
        </div>

        <div class="panel-right">

            <!-- Step 1: Email Request -->
            <div class="auth-panel active" id="p1">
                <div class="form-heading">
                    <h1 class="form-title">Lupa<br><em>Password?</em></h1>
                    <p class="form-subtitle">Masukkan email Anda dan kami akan mengirimkan<br>kode verifikasi untuk mereset password.</p>
                </div>
                
                <div class="field">
                    <label class="field-label">Alamat Email</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <input type="email" id="emailInput" placeholder="email@contoh.com" required autofocus>
                    </div>
                </div>

                <button type="button" class="btn-submit" onclick="goStep(2)">
                    <span>Kirim Kode Verifikasi</span>
                </button>

                <p class="form-footer">Ingat password? <a href="{{ route('login') }}">Masuk sekarang</a></p>
            </div>

            <!-- Step 2: OTP Entry -->
            <div class="auth-panel" id="p2">
                <div class="form-heading">
                    <h1 class="form-title">Verifikasi<br><em>Email</em></h1>
                    <p class="form-subtitle">Kode 4 digit telah dikirim ke <br><strong id="emailShow" style="color:var(--gold)">email@contoh.com</strong></p>
                </div>

                <div class="otp-group">
                    <input class="otp-input" maxlength="1" oninput="otpNext(this,0)">
                    <input class="otp-input" maxlength="1" oninput="otpNext(this,1)">
                    <input class="otp-input" maxlength="1" oninput="otpNext(this,2)">
                    <input class="otp-input" maxlength="1" oninput="otpNext(this,3)">
                </div>

                <button type="button" class="btn-submit" onclick="goStep(3)">
                    <span>Verifikasi Kode</span>
                </button>

                <div class="divider"><span>tidak menerima kode?</span></div>
                <button type="button" class="btn-google" style="border:none; background:none; text-decoration:underline;" onclick="alert('Kode dikirim ulang!')">Kirim Ulang</button>

                <p class="form-footer"><a href="#" onclick="goStep(1)">← Ganti email</a></p>
            </div>

            <!-- Step 3: New Password -->
            <div class="auth-panel" id="p3">
                <div class="form-heading">
                    <h1 class="form-title">Buat<br><em>Password</em> Baru</h1>
                    <p class="form-subtitle">Buat password baru yang kuat untuk akun Anda.</p>
                </div>

                <div class="field">
                    <label class="field-label">Password Baru</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                        <input type="password" id="password" placeholder="Min. 8 karakter" required oninput="checkStrength(this.value)">
                        <span class="toggle-pw" onclick="togglePw('password', this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                        </span>
                    </div>
                    <div class="pw-strength">
                        <div class="pw-bar" id="bar1"></div>
                        <div class="pw-bar" id="bar2"></div>
                        <div class="pw-bar" id="bar3"></div>
                        <div class="pw-bar" id="bar4"></div>
                        <span class="pw-hint" id="pwHint"></span>
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Konfirmasi Password Baru</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                        <input type="password" id="password_confirmation" placeholder="Ulangi password baru" required>
                    </div>
                </div>

                <button type="button" class="btn-submit" onclick="goStep(4)">
                    <span>Reset Password Sekarang</span>
                </button>
            </div>

            <!-- Step 4: Success -->
            <div class="auth-panel" id="p4">
                <div style="text-align:center; padding: 40px 0;">
                    <div class="success-seal">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:32px; height:32px;">
                            <polyline points="20 6 9 17 4 12"/>
                        </svg>
                    </div>
                    <div class="form-heading">
                        <h1 class="form-title">Password<br><em>Berhasil</em> Direset</h1>
                        <p class="form-subtitle">Password Anda telah diperbarui. Silakan login<br>kembali dengan password baru Anda.</p>
                    </div>
                    <button type="button" class="btn-submit" onclick="window.location.href='{{ route('login') }}'">
                        <span>Masuk Sekarang</span>
                    </button>
                </div>
            </div>

        </div>
    </div>

    <script>
        function goStep(n) {
            if(n===2) { 
                document.getElementById('emailShow').textContent = document.getElementById('emailInput').value || 'email@contoh.com'; 
            }
            document.querySelectorAll('.auth-panel').forEach(p => p.classList.remove('active'));
            document.getElementById('p'+n).classList.add('active');
        }

        function otpNext(el, idx) {
            const inputs = document.querySelectorAll('.otp-input');
            if(el.value && idx < 3) inputs[idx+1].focus();
        }

        function togglePw(id, btn) {
            const inp = document.getElementById(id);
            const isText = inp.type === 'text';
            inp.type = isText ? 'password' : 'text';
            btn.querySelector('svg').innerHTML = isText
                ? '<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>'
                : '<path d="M17.94 17.94A10.07 10.07 0 0 1 12 20c-7 0-11-8-11-8a18.45 18.45 0 0 1 5.06-5.94M9.9 4.24A9.12 9.12 0 0 1 12 4c7 0 11 8 11 8a18.5 18.5 0 0 1-2.16 3.19m-6.72-1.07a3 3 0 1 1-4.24-4.24"/><line x1="1" y1="1" x2="23" y2="23"/>';
        }

        function checkStrength(val) {
            const bars = ['bar1','bar2','bar3','bar4'].map(id => document.getElementById(id));
            const hint = document.getElementById('pwHint');
            let score = 0;
            if (val.length >= 8) score++;
            if (/[A-Z]/.test(val)) score++;
            if (/[0-9]/.test(val)) score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const cls = score <= 1 ? 'weak' : score <= 2 ? 'medium' : 'strong';
            const labels = ['', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];

            bars.forEach((b, i) => {
                b.className = 'pw-bar';
                if (val.length > 0 && i < score) b.classList.add(cls);
            });
            hint.textContent = val.length ? (labels[score] || 'Sangat Kuat') : '';
        }

        const resizer  = document.getElementById('resizer');
        const layout   = document.querySelector('.layout');
        let isResizing = false;

        resizer.addEventListener('mousedown', (e) => {
            isResizing = true;
            resizer.classList.add('active');
            layout.classList.add('resizing');
            e.preventDefault();
        });

        document.addEventListener('mousemove', (e) => {
            if (!isResizing) return;
            let width = window.innerWidth - e.clientX;
            width = Math.min(Math.max(width, 400), window.innerWidth * 0.78);
            document.documentElement.style.setProperty('--panel-width', `${width}px`);
        });

        document.addEventListener('mouseup', () => {
            if (!isResizing) return;
            isResizing = false;
            resizer.classList.remove('active');
            layout.classList.remove('resizing');
        });
    </script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>

