<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar — Wedding Organizations</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;0,500;0,600;1,300;1,400;1,500&family=Jost:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth_premium.css') }}">
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
                <p class="panel-tagline">Mulai <em>Perjalanan</em><br>Bahagia Anda</p>
                <p class="panel-desc">Daftarkan diri untuk mengelola pesanan<br>dan temukan vendor pernikahan impian</p>
                <div class="panel-dots">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>

        <div class="resizer" id="resizer">
            <div class="resizer-handle"></div>
        </div>

        <div class="panel-right">


            @if ($errors->any())
                <div class="alert alert-danger">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <div>@foreach ($errors->all() as $error)<p style="margin:0">{{ $error }}</p>@endforeach</div>
                </div>
            @endif

            <div class="form-heading" style="text-align:center;">
                <h1 class="form-title">Daftar <em>Akun</em><br>Baru</h1>
                <p class="form-subtitle">Lengkapi detail di bawah untuk mulai<br>merencanakan pernikahan impian Anda.</p>
            </div>

            <form action="{{ route('register', ['redirect_to' => request()->query('redirect_to')]) }}" method="POST" id="registerForm">
                @csrf

                <div class="field">
                    <label class="field-label">Nama Lengkap</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                        <input type="text" name="name" placeholder="Nama lengkap Anda" value="{{ old('name') }}" required autofocus autocomplete="name">
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Alamat Email</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <input type="email" name="email" placeholder="email@contoh.com" value="{{ old('email') }}" required autocomplete="email">
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Daftar Sebagai</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/></svg>
                        </svg>
                        <select name="role" id="roleSelect" required style="width:100%; height:100%; background:transparent; border:none; outline:none; font-family:inherit; color:var(--text); padding-left:40px; cursor:pointer; -webkit-appearance:none;">
                            <option value="user" {{ old('role') == 'user' ? 'selected' : '' }}>User (Pengguna Umum)</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin (Pengelola Website)</option>
                        </select>
                    </div>
                </div>

                <!-- Field No HP (Hanya untuk Admin) -->
                <div class="field" id="phoneField" style="display:none;">
                    <label class="field-label">Nomor WhatsApp</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l2.28-2.28a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                        </svg>
                        <input type="text" id="phone" name="phone" placeholder="Contoh: 081234567890">
                    </div>
                    <p style="font-size:0.75rem; color:var(--gold-deep); margin-top:8px;">* Pendaftaran Admin dilakukan melalui verifikasi WhatsApp manual.</p>
                </div>

                <div id="passwordArea">
                    <div class="field">
                        <label class="field-label">Kata Sandi</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2"/>
                                <path d="M7 11V7a5 5 0 0110 0v4"/>
                            </svg>
                            <input type="password" id="password" name="password" placeholder="Min. 8 karakter" autocomplete="new-password" oninput="checkStrength(this.value)">
                            <span class="toggle-pw" onclick="togglePw('password', this)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
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
                        <label class="field-label">Konfirmasi Kata Sandi</label>
                        <div class="input-wrap">
                            <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <rect x="3" y="11" width="18" height="11" rx="2"/>
                                <path d="M7 11V7a5 5 0 0110 0v4"/>
                            </svg>
                            <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" autocomplete="new-password">
                            <span class="toggle-pw" onclick="togglePw('password_confirmation', this)">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                    <circle cx="12" cy="12" r="3"/>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn">
                    <span>Buat Akun Sekarang</span>
                </button>

                <div class="divider"><span>atau daftar dengan</span></div>

                <a href="{{ route('auth.google') }}" class="btn-google" id="googleBtn">
                    <svg viewBox="0 0 48 48">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                        <path fill="#4285F4" d="M46.64 24.55c0-1.65-.15-3.23-.42-4.75H24v9.01h12.73c-.55 2.85-2.18 5.27-4.62 6.91l7.33 5.69C43.71 37.28 46.64 31.59 46.64 24.55z"/>
                        <path fill="#FBBC05" d="M10.54 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24s.92 7.54 2.56 10.78l7.98-6.19z"/>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.33-5.69c-2.1 1.41-4.79 2.25-8.56 2.25-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    </svg>
                    Daftar dengan Google
                </a>

                <p class="form-footer">Sudah punya akun? <a href="{{ route('login', ['redirect_to' => request()->query('redirect_to')]) }}">Masuk sekarang</a></p>
            </form>

        </div>
    </div>

    <script>
        const overlay = document.getElementById('loadingOverlay');
        const roleSelect = document.getElementById('roleSelect');
        const phoneField = document.getElementById('phoneField');
        const passwordArea = document.getElementById('passwordArea');
        const submitBtn = document.getElementById('submitBtn');
        const registerForm = document.getElementById('registerForm');

        roleSelect.addEventListener('change', () => {
            if (roleSelect.value === 'admin') {
                phoneField.style.display = 'block';
                passwordArea.style.display = 'none';
                document.getElementById('password').required = false;
                document.getElementById('password_confirmation').required = false;
                document.getElementById('phone').required = true;
                submitBtn.querySelector('span').textContent = 'Kirim Pengajuan WhatsApp';
            } else {
                phoneField.style.display = 'none';
                passwordArea.style.display = 'block';
                document.getElementById('password').required = true;
                document.getElementById('password_confirmation').required = true;
                document.getElementById('phone').required = false;
                submitBtn.querySelector('span').textContent = 'Buat Akun Sekarang';
            }
        });

        registerForm.addEventListener('submit', (e) => {
            if (roleSelect.value === 'admin') {
                e.preventDefault();
                const name  = document.getElementsByName('name')[0].value;
                const email = document.getElementsByName('email')[0].value;
                const phone = document.getElementById('phone').value;

                const message = `Halo Admin Wedding Org, perkenalkan saya ${name}.%0A%0A` +
                                `Saya ingin mendaftar sebagai Admin Website.%0AData diri saya:%0A` +
                                `- Email: ${email}%0A` +
                                `- No. WhatsApp: ${phone}%0A%0A` +
                                `Mohon bantuannya untuk proses verifikasi. Terima kasih.`;
                
                // Gunakan nomor tujuan pendaftaran admin
                const waNumber = "6288989337729"; 
                window.open(`https://wa.me/${waNumber}?text=${message}`, '_blank');
            } else {
                overlay.classList.add('active');
            }
        });

        document.getElementById('googleBtn').addEventListener('click', () => {
            overlay.classList.add('active');
        });

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
            if (val.length >= 8)         score++;
            if (/[A-Z]/.test(val))       score++;
            if (/[0-9]/.test(val))       score++;
            if (/[^A-Za-z0-9]/.test(val)) score++;

            const cls    = score <= 1 ? 'weak' : score <= 2 ? 'medium' : 'strong';
            const labels = ['', 'Lemah', 'Sedang', 'Kuat', 'Sangat Kuat'];

            bars.forEach((b, i) => {
                b.className = 'pw-bar';
                if (i < score) b.classList.add(cls);
            });

            hint.textContent = val.length ? (labels[score] || 'Kuat') : '';
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
