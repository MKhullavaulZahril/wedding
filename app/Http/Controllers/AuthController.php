<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Services\FirebaseService;

class AuthController extends Controller
{
    protected $firebase;

    public function __construct(FirebaseService $firebase)
    {
        $this->firebase = $firebase;
    }

    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and sync to Firebase.
     */
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $email = $googleUser->getEmail();
            
            // ── Check Firebase with Filtered Query (Efficient) ──
            $firebaseUsers = $this->firebase->getDataFiltered('users', 'email', $email, 1);
            $firebaseUser = !empty($firebaseUsers) ? reset($firebaseUsers) : null;

            if ($firebaseUser) {
                // User exists in Firebase, sync to MySQL and login
                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => $firebaseUser['name'] ?? $googleUser->getName(),
                        'google_id' => $firebaseUser['google_id'] ?? $googleUser->getId(),
                    ]
                );
                
                // Update Firebase if google_id was missing
                if (empty($firebaseUser['google_id'])) {
                    $this->firebase->updateData("users/{$user->id}", ['google_id' => $googleUser->getId()]);
                }
            } else {
                // Create in MySQL first to get ID
                $user = User::updateOrCreate(
                    ['email' => $email],
                    [
                        'name' => $googleUser->getName(),
                        'google_id' => $googleUser->getId(),
                        'password' => Hash::make(Str::random(16)),
                    ]
                );

                // Sync to Firebase
                $this->firebase->setData("users/{$user->id}", [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->google_id,
                    'created_at' => (string) $user->created_at,
                ]);
            }

            Auth::login($user);
            return redirect()->intended(route('dashboard'));

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Gagal login menggunakan Google. ' . $e->getMessage()]);
        }
    }

    public function showLogin()
    {
        return view('login');
    }

    /**
     * Login logic using Firebase verification.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // ── 1. Cari User di Firebase dengan Filtered Query ──
        $firebaseUsers = $this->firebase->getDataFiltered('users', 'email', $request->email, 1);
        $firebaseUser = !empty($firebaseUsers) ? reset($firebaseUsers) : null;

        if (!$firebaseUser) {
            return back()->withErrors(['email' => 'Email tidak terdaftar di sistem kami.'])->onlyInput('email');
        }

        // ── 2. Verifikasi Password ──
        // FirebaseUser menyimpan password hash yang disinkronkan dari MySQL sebelumnya
        if (Hash::check($request->password, $firebaseUser['password'] ?? '')) {
            // ── 3. Sinkronkan ke Lokal untuk Manajemen Sesi Laravel ──
            // Kita butuh model User lokal agar Laravel Auth guard bekerja
            $user = User::updateOrCreate(
                ['email' => $request->email],
                [
                    'name' => $firebaseUser['name'],
                    'password' => $firebaseUser['password'], // Simpan hash yang sama
                ]
            );

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();
            
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Password yang Anda masukkan salah.',
        ])->onlyInput('email');
    }

    /**
     * Handle AJAX login from Firebase Popup (Google).
     */
    public function firebaseLogin(Request $request)
    {
        $email = $request->email;
        $name = $request->name;
        $google_id = $request->google_id;
        $redirectTo = $request->redirect_to;

        // Sync or Create user
        $user = User::updateOrCreate(
            ['email' => $email],
            [
                'name' => $name,
                'google_id' => $google_id,
            ]
        );

        // Sync to Firebase if needed
        $this->firebase->updateData("users/{$user->id}", [
            'id' => $user->id,
            'name' => $name,
            'email' => $email,
            'google_id' => $google_id
        ]);

        Auth::login($user, true);

        // Calculate redirect
        $redirectUrl = $redirectTo ?: session()->get('url.intended', route('dashboard'));
        
        return response()->json([
            'status' => 'success',
            'redirect' => $redirectUrl
        ]);
    }

    public function showRegister()
    {
        return view('register');
    }

    /**
     * Register logic: Save to Firebase + Sync to Local.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        // Cek apakah email sudah ada di Firebase dengan Filtered Query
        $firebaseUsers = $this->firebase->getDataFiltered('users', 'email', $data['email'], 1);
        if (!empty($firebaseUsers)) {
            return back()->withErrors(['email' => 'Email ini sudah terdaftar.'])->withInput();
        }

        $passwordHash = Hash::make($data['password']);

        // ── 1. Simpan ke Lokal (SQLite/MySQL) ──
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $passwordHash,
        ]);

        // ── 2. Simpan ke Firebase ──
        $this->firebase->setData("users/{$user->id}", [
            'id' => $user->id,
            'name' => $user['name'],
            'email' => $user['email'],
            'password' => $passwordHash, // Hash disimpan di Firebase untuk verifikasi login cloud
            'created_at' => (string) $user->created_at,
        ]);

        Auth::login($user);

        return redirect()->intended(route('dashboard'))->with('success', 'Akun berhasil dibuat dan tersimpan di Cloud!');
    }

    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('dashboard');
    }
}
