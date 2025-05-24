<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Umkm;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan profil user yang sedang login.
     *
     * @return \Illuminate\View\View
     */
    public function profile()
    {
        $user = Auth::user();
        return view('profile', compact('user'));
    }

    /**
     * Update profil user.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
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
     * Menampilkan formulir pengajuan UMKM.
     *
     * @return \Illuminate\View\View
     */
    public function showApplyUmkmForm()
    {
        $kategori = Kategori::all(); // ambil semua data kategori
            return view('umkm.apply', compact('kategori'));
        // return view('umkm.apply'); // Pastikan ada file umkm/apply.blade.php
    }

    /**
     * Proses pengajuan user menjadi UMKM.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function applyUmkm(Request $request)
    {
    // Validasi input dari form pengajuan UMKM
    $request->validate([
        'name'        => 'required|string|max:255',
        'deskripsi'   => 'nullable|string',
        'alamat'      => 'required|string|max:255',
        'no_hp'       => 'required|string|max:15',
        'kategori_id' => 'required|exists:kategori,id',
        'instagram'   => 'nullable|string|max:255',
        'whatsapp'    => 'nullable|string|max:255',
        'nama_akun'   => 'nullable|string|max:255',
        'no_rekening' => 'nullable|string|max:255',
        'nama_bank'   => 'nullable|string|max:255',
        'photos'      => 'nullable|array|max:5',
        'photos.*'    => 'image|mimes:jpeg,png,jpg,gif|max:2048'
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
        'user_id'     => $user->id,
        'name'        => $request->name,
        'deskripsi'   => $request->deskripsi,
        'alamat'      => $request->alamat,
        'no_hp'       => $request->no_hp,
        'kategori_id' => $request->kategori_id,
        'instagram'   => $request->instagram,
        'whatsapp'    => $request->whatsapp,
        'nama_akun'   => $request->nama_akun,
        'no_rekening' => $request->no_rekening,
        'nama_bank'   => $request->nama_bank,
        'is_approved' => 0, // default belum disetujui
    ]);

    if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $photoPath = $photo->store('umkm_foto', 'public');
        
                $umkm->photos()->create([
                    'file_path' => $photoPath,
                ]);
            }
        }

    // Perbarui status user menjadi pending
    $user->role = 'pending';
    $user->save();

    return redirect()->route('umkm.submitted')->with('success', 'Pengajuan UMKM berhasil dikirim!');
    }

}
