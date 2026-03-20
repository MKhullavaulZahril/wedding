<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Tampilkan halaman utama untuk pengguna (user).
     */
    public function index()
    {
        // Jika admin mengakses /dashboard, arahkan ke panel admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return view('home');
    }
}
