<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Wedding Organizations</title>
    <link rel="stylesheet" href="{{ asset('css/edit-profile.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global-layout.css') }}">
</head>
<body>
    <nav class="navbar">
        <a href="{{ route('dashboard') }}" class="back-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" width="16" height="16">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Kembali
        </a>
        <div class="brand-name">Wedding <em>Organizations</em></div>
    </nav>

    <div class="container">
        @if($errors->any())
            <div style="background: #fdf2f2; color: #c0445e; padding: 15px; border-radius: 12px; margin-bottom: 20px; font-size: 0.85rem; border: 1px solid #fbd5d5;">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="card photo-card">
                <div class="avatar-wrap" onclick="document.getElementById('profile_photo').click()" style="cursor: pointer;">
                    <div class="avatar" id="avatarPreview" style="overflow: hidden; display: flex; align-items: center; justify-content: center; background: #fdf2f2; color: #c0445e; font-size: 2rem; font-weight: bold;">
                        @if(Auth::user()->profile_photo)
                            <img src="{{ asset(Auth::user()->profile_photo) }}" style="width:100%; height:100%; object-fit:cover;">
                        @else
                            {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                        @endif
                    </div>
                    <div class="edit-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M12 20h9"></path>
                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                        </svg>
                    </div>
                </div>
                <div class="photo-info">
                    <h3>Foto Profil</h3>
                    <p>Format JPG, PNG. Maksimal 5MB</p>
                    <input type="file" id="profile_photo" name="profile_photo" accept="image/png, image/jpeg, image/jpg" style="display: none;">
                    <button type="button" class="btn-outline" onclick="document.getElementById('profile_photo').click()">UNGGAH FOTO</button>
                </div>
            </div>
            <div class="card form-card">
                <div class="section-title">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </div>
                    Informasi Pribadi
                </div>

                @php
                    $parts = explode(' ', Auth::user()->name);
                    $firstName = $parts[0] ?? '';
                    $lastName = isset($parts[1]) ? implode(' ', array_slice($parts, 1)) : '';
                @endphp

                <div class="row">
                    <div class="col field">
                        <label>Nama Depan</label>
                        <input type="text" name="first_name" value="{{ old('first_name', $firstName) }}">
                    </div>
                    <div class="col field">
                        <label>Nama Belakang</label>
                        <input type="text" name="last_name" value="{{ old('last_name', $lastName) }}">
                    </div>
                </div>
                <div class="row">
                    <div class="col field">
                        <label>Alamat Email</label>
                        <div style="display: flex; flex-direction: column; gap: 8px;">
                            <input type="email" name="email" value="{{ old('email', Auth::user()->email) }}" {{ Auth::user()->google_id ? 'readonly style=background:#f9f9f9;cursor:not-allowed;' : '' }}>
                            @if(Auth::user()->google_id)
                                <div class="google-badge" style="display: inline-flex; align-items: center; gap: 8px; background: #f0f7ff; color: #0061f2; padding: 6px 12px; border-radius: 20px; font-size: 0.7rem; font-weight: 600; border: 1px solid #cce3ff; width: fit-content; margin-top: 4px;">
                                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                        <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                        <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                                        <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                                    </svg>
                                    Terhubung dengan Google
                                </div>
                                <p style="font-size: 0.65rem; color: #888; margin-top: 2px;">Email dikelola oleh Google karena ini adalah akun Google yang terhubung.</p>
                            @endif
                        </div>
                    </div>
                </div>
                
                <div class="field" style="margin-top: 10px;">
                    <label>Jenis Kelamin</label>
                    <div class="radio-group">
                        <label class="radio-box">
                            <input type="radio" name="gender" value="pria" checked>
                            <span class="radio-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="10" cy="14" r="5"></circle>
                                    <line x1="14" y1="10" x2="21" y2="3"></line>
                                    <polyline points="15 3 21 3 21 9"></polyline>
                                </svg>
                                Pria
                            </span>
                        </label>
                        <label class="radio-box">
                            <input type="radio" name="gender" value="wanita">
                            <span class="radio-label">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="10" r="5"></circle>
                                    <line x1="12" y1="15" x2="12" y2="21"></line>
                                    <line x1="9" y1="18" x2="15" y2="18"></line>
                                </svg>
                                Wanita
                            </span>
                        </label>
                        <label class="radio-box">
                            <input type="radio" name="gender" value="lainnya">
                            <span class="radio-label">
                                <span style="font-size:10px;">○</span>
                                Lainnya
                            </span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Password Card -->
            <div class="card form-card">
                <div class="section-title">
                    <div class="section-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="3" y="11" width="18" height="11" rx="2" ry="2"></rect>
                            <path d="M7 11V7a5 5 0 0 1 10 0v4"></path>
                        </svg>
                    </div>
                    Keamanan Akun
                </div>
                
                <div class="row">
                    <div class="col field">
                        <label>Password Saat Ini</label>
                        <div class="password-wrap">
                            <input type="password" id="current_password" name="current_password" placeholder="••••••••">
                            <span class="password-toggle" onclick="togglePassword('current_password')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col field">
                        <label>Password Baru</label>
                        <div class="password-wrap">
                            <input type="password" id="new_password" name="new_password" placeholder="Minimal 8 karakter">
                            <span class="password-toggle" onclick="togglePassword('new_password')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="col field">
                        <label>Konfirmasi Password</label>
                        <div class="password-wrap">
                            <input type="password" id="new_password_confirmation" name="new_password_confirmation" placeholder="Ulangi password baru">
                            <span class="password-toggle" onclick="togglePassword('new_password_confirmation')">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" width="16" height="16">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <circle cx="12" cy="12" r="3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="action-bar" style="margin-bottom: 40px;">
                <a href="{{ route('dashboard') }}" class="btn-cancel" style="display:inline-flex; align-items:center; text-decoration:none;">Batal</a>
                <button type="submit" class="btn-save">SIMPAN PERUBAHAN</button>
            </div>
        </form>
    </div>

    <script>
        // Preview Image Photo
        document.getElementById('profile_photo').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const avatarDiv = document.getElementById('avatarPreview');
                    avatarDiv.innerHTML = `<img src="${e.target.result}" style="width:100%; height:100%; object-fit:cover;">`;
                }
                reader.readAsDataURL(file);
            }
        });

        function togglePassword(inputId) {
            const passwordInput = document.getElementById(inputId);
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            // Opsi untuk bisa mengganti icon mata tercoret jika diinginkan nantinya:
            // const iconSVG = passwordInput.nextElementSibling.querySelector('svg');
        }
    </script>
    <!-- Performance Optimization: Instant.page -->
    <script src="//instant.page/5.2.0" type="module" integrity="sha384-jnZyxPjiipSbmfOOiyv9D41tqtGj73T9MToG+8m/N8eO0vHnF+mX402p99xUqS7B"></script>
    <script src="//instant.page/5.2.0" type="module"></script>
</body>
</html>
