<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Wedding Organizations</title>
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
                <h2 class="panel-tagline">Wujudkan Hari<br>yang <em>Sempurna</em></h2>
                <p class="panel-desc">Temukan vendor pernikahan terbaik<br>untuk momen tak terlupakan Anda</p>
                <div class="panel-dots">
                    <span></span><span></span><span></span>
                </div>
            </div>
        </div>

        <div class="resizer" id="resizer">
            <div class="resizer-handle"></div>
        </div>

        <div class="panel-right">


            @if (session('success'))
                <div class="alert alert-success">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/><polyline points="22 4 12 14.01 9 11.01"/></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if (session('status'))
                <div class="alert alert-info">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="16" x2="12" y2="12"/><line x1="12" y1="8" x2="12.01" y2="8"/></svg>
                    <span>{{ session('status') }}</span>
                </div>
            @endif

            @if ($errors->any())
                <div class="alert alert-danger">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    <div>@foreach ($errors->all() as $error)<p style="margin:0">{{ $error }}</p>@endforeach</div>
                </div>
            @endif

            <div class="form-heading">
                <h1 class="form-title">Selamat<br><em>Datang</em></h1>
                <p class="form-subtitle">Masuk ke akun Anda untuk melanjutkan<br>perjalanan menemukan vendor impian.</p>
            </div>

            <form action="{{ route('login', ['redirect_to' => request()->query('redirect_to')]) }}" method="POST" id="loginForm">
                @csrf

                <div class="field">
                    <label class="field-label">Alamat Email</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <polyline points="22,6 12,13 2,6"/>
                        </svg>
                        <input type="email" id="email" name="email" placeholder="" value="" required autofocus autocomplete="off">
                    </div>
                </div>

                <div class="field">
                    <label class="field-label">Kata Sandi</label>
                    <div class="input-wrap">
                        <svg class="input-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="11" width="18" height="11" rx="2"/>
                            <path d="M7 11V7a5 5 0 0110 0v4"/>
                        </svg>
                        <input type="password" id="password" name="password" placeholder="" required autocomplete="new-password">
                        <span class="toggle-pw" onclick="togglePw('password', this)">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/>
                                <circle cx="12" cy="12" r="3"/>
                            </svg>
                        </span>
                    </div>
                </div>

                <div class="form-options">
                    <label class="check-label">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>
                        <span>Ingat Saya</span>
                    </label>
                    <a href="{{ route('forgot-password') }}" class="link-forgot">Lupa kata sandi?</a>
                </div>

                <button type="submit" class="btn-submit">
                    <span>Masuk Sekarang</span>
                </button>

                <div class="divider"><span>atau lanjutkan dengan</span></div>

                <a href="{{ route('auth.google') }}" class="btn-google" id="googleBtn">
                    <svg viewBox="0 0 48 48">
                        <path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/>
                        <path fill="#4285F4" d="M46.64 24.55c0-1.65-.15-3.23-.42-4.75H24v9.01h12.73c-.55 2.85-2.18 5.27-4.62 6.91l7.33 5.69C43.71 37.28 46.64 31.59 46.64 24.55z"/>
                        <path fill="#FBBC05" d="M10.54 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24s.92 7.54 2.56 10.78l7.98-6.19z"/>
                        <path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.33-5.69c-2.1 1.41-4.79 2.25-8.56 2.25-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/>
                    </svg>
                    Masuk dengan Google
                </a>

                <p class="form-footer">Belum punya akun? <a href="{{ route('register', ['redirect_to' => request()->query('redirect_to')]) }}">Daftar sekarang</a></p>
            </form>

        </div>
    </div>

    <script>
        // Force clear inputs on load (fight browser autofill)
        window.addEventListener('load', () => {
            setTimeout(() => {
                const emailInp = document.getElementById('email');
                const passInp = document.getElementById('password');
                if (emailInp) emailInp.value = '';
                if (passInp) passInp.value = '';
            }, 100);
        });

        const overlay = document.getElementById('loadingOverlay');

        document.getElementById('loginForm').addEventListener('submit', () => {
            overlay.classList.add('active');
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
