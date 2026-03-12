<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk — Wedding Organizations</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global-layout.css') }}">
</head>
<body>

<div class="bg-layer"></div>

<div class="card">
    <div class="brand-name">Wedding <em>Organizations</em></div>

    <div class="card-title">Sign In</div>
    <div class="card-sub">Silakan masuk ke akun Anda untuk melanjutkan pencarian vendor impian.</div>

    <form action="{{ route('login', ['redirect_to' => request()->query('redirect_to')]) }}" method="POST">
        @csrf
        <div class="field">
            <label>Alamat Email</label>
            <div class="input-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><polyline points="22,6 12,13 2,6"/></svg>
                <input type="email" name="email" placeholder="email@contoh.com" required autofocus>
            </div>
        </div>

        <div class="field">
            <label>Kata Sandi</label>
            <div class="input-wrap">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                <input type="password" id="password" name="password" placeholder="••••••••" required>
                <span class="password-toggle" onclick="togglePassword('password')">
                    <svg id="eye-password" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" /><circle cx="12" cy="12" r="3" /></svg>
                </span>
            </div>
        </div>

        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 10px;">
            <div class="remember-wrap">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember">Ingatkan Saya</label>
            </div>
            <a href="{{ route('forgot-password') }}" style="color: #c0435f; font-size: 0.8rem; text-decoration: none; font-weight: 500;">Lupa Password?</a>
        </div>

        <button type="submit" class="btn-main">Masuk Sekarang</button>
        
        <div class="divider">
            <span>atau masuk dengan</span>
        </div>

        <a href="javascript:void(0)" onclick="loginWithGoogle()" class="btn-google">
            <svg viewBox="0 0 48 48"><path fill="#EA4335" d="M24 9.5c3.54 0 6.71 1.22 9.21 3.6l6.85-6.85C35.9 2.38 30.47 0 24 0 14.62 0 6.51 5.38 2.56 13.22l7.98 6.19C12.43 13.72 17.74 9.5 24 9.5z"/><path fill="#4285F4" d="M46.64 24.55c0-1.65-.15-3.23-.42-4.75H24v9.01h12.73c-.55 2.85-2.18 5.27-4.62 6.91l7.33 5.69C43.71 37.28 46.64 31.59 46.64 24.55z"/><path fill="#FBBC05" d="M10.54 28.59c-.48-1.45-.76-2.99-.76-4.59s.27-3.14.76-4.59l-7.98-6.19C.92 16.46 0 20.12 0 24s.92 7.54 2.56 10.78l7.98-6.19z"/><path fill="#34A853" d="M24 48c6.48 0 11.93-2.13 15.89-5.81l-7.33-5.69c-2.1 1.41-4.79 2.25-8.56 2.25-6.26 0-11.57-4.22-13.47-9.91l-7.98 6.19C6.51 42.62 14.62 48 24 48z"/><path fill="none" d="M0 0h48v48H0z"/></svg>
            Google
        </a>
        
        <a href="{{ route('register', ['redirect_to' => request()->query('redirect_to')]) }}" class="back-link">Belum punya akun? <span>Daftar sekarang</span></a>
    </form>
</div>

<div id="loadingOverlay" class="loading-overlay">
    <div class="loading-spinner"></div>
    <div class="loading-text">Sedang memproses...</div>
</div>

<script>
    const overlay = document.getElementById('loadingOverlay');

    function showLoading() {
        overlay.classList.add('active');
    }

    // Handle normal form submit loading
    document.querySelector('form').addEventListener('submit', function() {
        showLoading();
    });

    // Provide a way for Google button to show loading too
    document.querySelector('.btn-google').addEventListener('click', function() {
        showLoading();
    });

    function togglePassword(inputId) {
        const passwordInput = document.getElementById(inputId);
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
    }
    window.togglePassword = togglePassword;
</script>
</body>
</html>
