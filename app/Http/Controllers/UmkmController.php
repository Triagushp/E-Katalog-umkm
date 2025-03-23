<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use Illuminate\Support\Facades\Auth;

class UmkmController extends Controller
{
    // Menampilkan semua UMKM (JSON response)
    public function index()
    {
        return response()->json(Umkm::all());
    }

    // Menampilkan detail UMKM berdasarkan ID
    public function show($id)
    {
        $umkm = Umkm::with('products')->findOrFail($id);
        return response()->json($umkm);
    }

    // Menghapus UMKM (hanya admin yang bisa)
    public function destroy($id)
    {
        $umkm = Umkm::findOrFail($id);
        $this->authorize('delete', $umkm);
        $umkm->delete();
        return response()->json(['message' => 'UMKM berhasil dihapus!']);
    }

    // Menampilkan daftar pengajuan UMKM
    public function requests()
    {
        $umkmRequests = Umkm::where('status', 'pending')->get();
        return view('admin.umkm.requests', compact('umkmRequests'));
    }

    // Menyetujui pengajuan UMKM
    public function approve($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->update(['status' => 'approved']);
        return redirect()->route('admin.umkm.requests')->with('success', 'UMKM disetujui.');
    }

    // Menolak pengajuan UMKM dan menghapusnya
    public function reject($id)
    {
        $umkm = Umkm::findOrFail($id);
        $umkm->delete();
        return redirect()->route('admin.umkm.requests')->with('error', 'UMKM ditolak.');
    }
}
