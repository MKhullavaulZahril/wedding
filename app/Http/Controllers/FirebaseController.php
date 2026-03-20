<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Kreait\Laravel\Firebase\Facades\Firebase;

class FirebaseController extends Controller
{
    public function index()
    {
        $database = Firebase::database();
        
        // Simpan data tes
        $newPost = $database
            ->getReference('test/posts')
            ->push([
                'title' => 'Laravel Firebase Test',
                'body' => 'Berhasil terhubung ke Realtime Database!',
                'timestamp' => now()->toDateTimeString()
            ]);

        // Baca data kembali
        $reference = $database->getReference('test/posts');
        $value = $reference->getValue();

        return response()->json([
            'message' => 'Koneksi Firebase Berhasil!',
            'data_tersimpan' => $newPost->getValue(),
            'semua_data' => $value
        ]);
    }
}

