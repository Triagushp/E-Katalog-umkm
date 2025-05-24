<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Umkm;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UmkmController extends Controller
{
    // Menampilkan semua UMKM (JSON response)
    public function index()
    {
        return response()->json(Umkm::all());
    }

    // Menampilkan halaman Toko Saya
    public function showStore()
    {
        $umkm = auth()->user()->umkm; // Ambil UMKM yang terkait dengan user yang sedang login
        return view('umkm.toko', compact('umkm'));
    }

    // Menampilkan halaman Edit UMKM
    public function edit()
    {
        $umkm = auth()->user()->umkm; // Ambil UMKM yang terkait dengan user yang sedang login
        return view('umkm.edittoko', compact('umkm'));
    }

    // Mengupdate data UMKM
    public function update(Request $request)
{
    $umkm = Auth::user()->umkm;

    // Pastikan UMKM ditemukan
    if (!$umkm) {
        return redirect()->back()->with('error', 'UMKM tidak ditemukan.');
    }

    // Validasi input
    $request->validate([
        'name' => 'required|string|max:255',
        'alamat' => 'required|string|max:255',
        'no_hp' => 'required|string|max:20',
        'instagram' => 'nullable|string|max:255',
        'whatsapp' => 'nullable|string|max:20',
        'kategori' => 'nullable|string|max:100',
        'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'deskripsi' => 'required|string',
        'nama_akun' => 'nullable|string|max:255',
        'no_rekening' => 'nullable|string|max:100',
        'nama_bank' => 'nullable|string|max:255',
    ]);

    // Pastikan nama input diubah agar sesuai dengan nama kolom database
    $data = $request->only([
        'name', 'alamat', 'no_hp', 'instagram', 'whatsapp',
        'kategori', 'deskripsi', 'nama_akun', 'no_rekening', 'nama_bank'
    ]);

    // Proses upload gambar baru
    if ($request->hasFile('photo')) {
        // Hapus foto lama jika ada
        if ($umkm->photo && Storage::disk('public')->exists('photos/' . $umkm->photo)) {
            Storage::disk('public')->delete('photos/' . $umkm->photo);
        }

        $photoPath = $request->file('photo')->store('photos', 'public');
        $data['photo'] = basename($photoPath);
    }

    // Simpan perubahan
    $umkm->update([
        'name' => $data['name'],
        'alamat' => $data['alamat'],
        'no_hp' => $data['no_hp'],
        'instagram' => $data['instagram'],
        'whatsapp' => $data['whatsapp'],
        'kategori' => $data['kategori'],
        'deskripsi' => $data['deskripsi'],
        'nama_akun' => $data['nama_akun'],
        'no_rekening' => $data['no_rekening'],
        'nama_bank' => $data['nama_bank'],
        'photo' => $data['photo'] ?? $umkm->photo, // Hanya update foto jika ada
    ]);

    return redirect()->route('umkm.edit')->with('success', 'Profil UMKM berhasil diperbarui!');
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
