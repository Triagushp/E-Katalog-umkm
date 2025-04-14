<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Umkm;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan profil user yang sedang login
     */
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Update profil user
     */
    public function profileUpdate(Request $request)
    {
        $user = User::findOrFail(Auth::id());

        // Validasi input
        $request->validate([
            'name'    => 'required|string|max:255',
            'phone'   => 'nullable|string|max:15',
            'address' => 'nullable|string|max:255',
        ]);

        // Perbarui data user secara eksplisit
        $user->name    = $request->name;
        $user->phone   = $request->phone;
        $user->address = $request->address;
        $user->save(); // Simpan perubahan

        return redirect()->route('profile')->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Menampilkan formulir pengajuan UMKM
     */
    public function showApplyUmkmForm()
    {
        return view('umkm.apply'); // Pastikan ada file umkm/apply.blade.php
    }

    /**
     * Proses pengajuan user menjadi UMKM
     */
    public function applyUmkm(Request $request)
    {
        // Validasi input dari form pengajuan UMKM
        $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'address'     => 'required|string|max:255',
            'phone'       => 'required|string|max:15',
            'instagram'   => 'required|url',
            'whatsapp'    => 'required|url',
            'latitude'    => 'required|numeric',
            'longitude'   => 'required|numeric',
        ]);

        $user = User::findOrFail(Auth::id());

        // Cek apakah user sudah menjadi UMKM atau pengajuan masih pending
        if ($user->role === 'umkm') {
            return response()->json(['message' => 'Anda sudah menjadi UMKM!'], 400);
        }

        if ($user->role === 'pending') {
            return response()->json(['message' => 'Pengajuan UMKM Anda sedang diproses!'], 400);
        }

        // Buat entri baru di tabel UMKM
        $umkm = Umkm::create([
            'name'        => $request->name,
            'description' => $request->description,
            'address'     => $request->address,
            'phone'       => $request->phone,
            'user_id'     => $user->id,
            'instagram'   => $request->instagram,
            'whatsapp'    => $request->whatsapp,
            'latitude'    => $request->latitude,
            'longitude'   => $request->longitude,
        ]);

        // Perbarui status user menjadi pending
        $user->role = 'pending';
        $user->save();

        return redirect()->route('umkm.submitted');
    }
}
