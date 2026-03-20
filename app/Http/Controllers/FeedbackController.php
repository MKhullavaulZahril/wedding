<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FeedbackController extends Controller
{
    public function rating()
    {
        return view('rating');
    }

    public function saran()
    {
        return view('saran');
    }

    public function storeSaran(Request $request)
    {
        // Validasi input
        $request->validate([
            'saran' => 'required|string|max:1000',
            'title' => 'required|string|max:200',
            'category' => 'required|string',
        ]);

        // Simpan ke Firebase Realtime Database
        try {
            $database = Firebase::database();
            $database->getReference('saran')->push([
                'nama' => auth()->user()->name ?? 'Guest',
                'judul' => $request->title,
                'kategori' => $request->category,
                'pesan' => $request->saran,
                'created_at' => now()->toDateTimeString(),
                'user_id' => auth()->id() ?? null
            ]);

            return redirect()->route('home')->with('success', 'Terima kasih! Saran Anda telah kami terima di Firebase.');
        } catch (\Exception $e) {
            \Log::error('Firebase Error: ' . $e->getMessage());
            return redirect()->route('home')->with('error', 'Maaf, gagal mengirim saran ke Firebase.');
        }
    }
}

