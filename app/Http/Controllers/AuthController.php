<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class AuthController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Obtain the user information from Google and save to MySQL.
     */
    public function handleGoogleCallback()
    {
        try {
            // Fix lambat pada XAMPP Windows (Delay resolusi IPv6 Google API)
            // Memaksa Guzzle menggunakan IPv4
            $driver = Socialite::driver('google');
            $driver->setHttpClient(new \GuzzleHttp\Client([
                'curl' => [CURLOPT_IPRESOLVE => CURL_IPRESOLVE_V4],
                'verify' => false, // Hindari masalah sertifikat SSL di localhost
            ]));

            $googleUser = $driver->user();
            $email = $googleUser->getEmail();
            
            $user = User::updateOrCreate(
                ['email' => $email],
                [
                    'name' => $googleUser->getName(),
                    'google_id' => $googleUser->getId(),
                    'password' => Hash::make(Str::random(16)),
                ]
            );

            Auth::login($user);

            // Sync Role from Firebase RTDB (Optimized via UID)
            try {
                $firebaseAuth = app('firebase.auth');
                $database = app('firebase.database');
                
                // 1. Get UID from Firebase Auth
                $fbAuthUser = $firebaseAuth->getUserByEmail($user->email);
                $uid = $fbAuthUser->uid;

                // 2. Fetch role directly using UID
                $role = $database->getReference('users/' . $uid . '/role')->getValue();
                
                Log::info("Firebase Role Sync for {$user->email}: Found role '{$role}' for UID {$uid}");

                if ($role) {
                    $user->role = $role;
                    $user->save();
                    $user->refresh();
                }
            } catch (\Exception $e) {
                Log::error('Firebase Role Sync Error: ' . $e->getMessage());
            }

            return redirect()->route('dashboard.index');

        } catch (\Exception $e) {
            return redirect()->route('login')->withErrors(['email' => 'Gagal login menggunakan Google. ' . $e->getMessage()]);
        }
    }

    public function showLogin()
    {
        return view('login');
    }

    /**
     * Login logic using Firebase Auth.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Login langsung via MySQL — cepat tanpa round-trip ke Firebase
        // (Registrasi tetap menyimpan ke Firebase + MySQL)
        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();

            // Sync Role from Firebase RTDB (Optimized via UID)
            try {
                $firebaseAuth = app('firebase.auth');
                $database = app('firebase.database');
                
                // 1. Get UID from Firebase Auth
                $fbAuthUser = $firebaseAuth->getUserByEmail($user->email);
                $uid = $fbAuthUser->uid;

                // 2. Fetch role directly using UID
                $role = $database->getReference('users/' . $uid . '/role')->getValue();
                
                Log::info("Firebase Role Sync (Manual) for {$user->email}: Found role '{$role}' for UID {$uid}");

                if ($role) {
                    $user->role = $role;
                    $user->save();
                    $user->refresh();
                }
            } catch (\Exception $e) {
                Log::error('Firebase Role Sync Error: ' . $e->getMessage());
            }
            
            return redirect()->route('dashboard.index');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi yang Anda masukkan tidak sesuai.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('register');
    }

    /**
     * Register logic: Save to Firebase Auth, RTDB, and MySQL.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'string', 'in:user'], // Hanya izinkan role 'user' dari pendaftaran langsung
        ]);

        try {
            $auth = app('firebase.auth');
            $database = app('firebase.database');

            // 1. Create User in Firebase Auth
            $userProperties = [
                'email' => $data['email'],
                'password' => $data['password'],
                'displayName' => $data['name'],
            ];
            $createdUser = $auth->createUser($userProperties);
            $uid = $createdUser->uid;

            // 2. Save Additional Data to Firebase RTDB
            $database->getReference('users/' . $uid)->set([
                'name' => $data['name'],
                'email' => $data['email'],
                'created_at' => now()->toDateTimeString(),
                'role' => $data['role']
            ]);

            // 3. Save to MySQL (Synchronized)
            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role' => $data['role'],
            ]);

            Auth::login($user);

            return redirect()->route('dashboard.index')->with('success', 'Akun berhasil dibuat!');

        } catch (\Exception $e) {
            return back()->withErrors(['email' => 'Gagal mendaftar ke Firebase: ' . $e->getMessage()])->withInput();
        }
    }

    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('landing');
    }
}

