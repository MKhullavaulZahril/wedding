<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
            $googleUser = Socialite::driver('google')->user();
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
     * Login logic using MySQL.
     */
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('dashboard'));
        }

        return back()->withErrors([
            'email' => 'Kredensial yang diberikan tidak cocok dengan catatan kami.',
        ])->onlyInput('email');
    }

    public function showRegister()
    {
        return view('register');
    }

    /**
     * Register logic: Save to MySQL.
     */
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);

        return redirect()->intended(route('dashboard'))->with('success', 'Akun berhasil dibuat!');
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
