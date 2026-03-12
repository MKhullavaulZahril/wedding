<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('edit-profile');
    }

    public function update(Request $request)
    {
        $user = Auth::user();
        
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name'  => 'nullable|string|max:255',
            'email'      => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'current_password' => 'nullable|required_with:new_password',
            'new_password'     => 'nullable|min:8|confirmed',
            'profile_photo'    => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120',
        ]);

        // Handle Profile Photo Upload
        if ($request->hasFile('profile_photo')) {
            $file = $request->file('profile_photo');
            $filename = time() . '_' . $user->id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/profiles'), $filename);
            
            // Delete old photo if exists
            if ($user->profile_photo && file_exists(public_path($user->profile_photo))) {
                @unlink(public_path($user->profile_photo));
            }
            
            $user->profile_photo = 'images/profiles/' . $filename;
        }

        // Verifikasi Password Saat Ini jika ingin ganti password
        if ($request->new_password) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini tidak cocok.']);
            }
            $user->password = Hash::make($request->new_password);
        }

        $fullName = trim($request->first_name . ' ' . $request->last_name);
        $user->name = $fullName;
        $user->email = $request->email;
        $user->save();

        return redirect()->route('dashboard')->with('success', 'Profil Anda telah berhasil diperbarui!');
    }
}
