<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Umkm;
use App\Models\Product;

class AdminController extends Controller
{
    /**
     * 🔍 Menampilkan daftar pengajuan UMKM yang belum disetujui
     */
    public function viewUmkmRequests()
    {
        $pendingUsers = User::where('role', 'pending')->get();
        return view('admin.daftarrequests', compact('pendingUsers'));
    }

  public function dashboard()
    {
        $totalUmkm = Umkm::count();
        // $pendingUmkm = Umkm::where('status', 'pending')->count();
        // $activeUmkm = Umkm::where('status', 'approved')->count();
        // $rejectedProducts = Product::where('status', 'rejected')->count();
        
        // // Get recent UMKMs for the table (limit to 5)
        // $recentUmkms = Umkm::orderBy('created_at', 'desc')
        //                     ->take(5)
        //                     ->get();
        
        return view('admin.dashboard', compact(
            'totalUmkm'
        ));
    }

    /**
     * ✅ Menyetujui pengajuan UMKM
     */
    public function approveUmkm($id)
    {
    $user = User::findOrFail($id);

    // Cari UMKM terkait user ini
    $umkm = Umkm::where('user_id', $user->id)->first();

    if (!$umkm) {
        return redirect()->route('admin.umkm_requests')->with('error', 'Data UMKM tidak ditemukan.');
    }

    // Setujui pengajuan UMKM
    $umkm->is_approved = true;
    $umkm->save();

    // Ubah peran user
    $user->update(['role' => 'umkm']);

    return redirect()->route('admin.umkm_requests')->with('success', 'UMKM berhasil disetujui.');
    }

    public function showUmkmDetail($id)
    {
    $user = User::with('umkm')->findOrFail($id); // pastikan relasi 'umkm' ada di model User
    return view('admin.umkmdetail', compact('user'));
    }

    public function showImportForm()
    {
    return view('admin.importumkm');
    }

    public function rejectUmkm($id)
    {
        $user = User::findOrFail($id);

        // Hapus user yang mengajukan permohonan
        $user->delete();

        return redirect()->route('admin.umkm_requests')->with('error', 'Pengajuan UMKM ditolak dan dihapus.');
    }

   public function listApprovedUmkms()
    {
        $umkms = Umkm::where('is_approved', true)->get(); // Ambil UMKM yang disetujui
        return view('admin.daftarumkm', compact('umkms'));
    }

}
