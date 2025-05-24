<?php
namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index()
    {
        $kategori = Kategori::all();
        return view('admin.kategori.index', compact('kategori'));
    }

    public function showApplyUmkmForm()
{
    $kategori = Kategori::all(); // ambil semua data kategori
    return view('umkm.apply', compact('kategori'));
}
    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|string|max:100|unique:kategori,nama_kategori',
        ]);

        Kategori::create(['nama_kategori' => $request->nama_kategori]);

        return redirect()->back()->with('success', 'Kategori berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        Kategori::destroy($id);
        return redirect()->back()->with('success', 'Kategori berhasil dihapus.');
    }
}