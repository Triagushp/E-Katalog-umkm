<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Umkm;

class AdminController extends Controller
{
    /**
     * 🔍 Menampilkan daftar pengajuan UMKM yang belum disetujui
     */
    public function viewUmkmRequests()
    {
        $pendingUsers = User::where('role', 'pending')->get();
        return view('requests', compact('pendingUsers'));
    }


    /**
     * ✅ Menyetujui pengajuan UMKM
     */
public function approveUmkm($id)
{
    $user = User::findOrFail($id);

    // Buat UMKM dengan semua field yang diperlukan
    $umkm = Umkm::create([
        'user_id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'address' => $user->address ?? 'Alamat belum diisi', // Pastikan address diisi
        'phone' => $user->phone ?? 'Nomor belum diisi',
        'is_approved' => true
    ]);

    // Ubah role user jadi 'umkm'
        $user->update(['role' => 'umkm']);

        return redirect()->route('admin.umkm_requests')->with('success', 'UMKM berhasil disetujui.');
    }


    /**
     * ❌ Menolak pengajuan UMKM
     */
    public function rejectUmkm($id)
    {
        $user = User::findOrFail($id);

        // Hapus user yang mengajukan permohonan
        $user->delete();

        return redirect()->route('admin.umkm_requests')->with('error', 'Pengajuan UMKM ditolak dan dihapus.');
    }

    /**
     * 📜 Menampilkan daftar UMKM yang sudah disetujui
     */
   public function listApprovedUmkms()
    {
        $umkms = Umkm::where('is_approved', true)->get(); // Ambil UMKM yang disetujui
        return view('admin.umkm', compact('umkms'));
    }

}
