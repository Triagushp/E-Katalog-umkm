<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // 🛍️ Menampilkan Form Tambah Produk
    public function create()
    {
        return view('products.create');
    }

    // 🛍️ Menyimpan Produk Baru
    public function store(Request $request)
    {
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    } else {
        $imagePath = null;
    }

    $user = Auth::user();

    // Pastikan pengguna memiliki UMKM sebelum menambahkan produk
    if (!$user->umkm) {
        return back()->withErrors(['message' => 'Anda belum memiliki UMKM!']);
    }

    // Simpan produk dengan ID UMKM terkait
    $product = $user->umkm->products()->create([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $imagePath,
    ]);

    return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 📌 Menampilkan Produk UMKM yang Login
    public function index()
    {
        $user = auth()->user();

    // Pastikan user punya UMKM sebelum mengambil produk
        if (!$user->umkm) {
            return back()->withErrors(['message' => 'Anda belum memiliki UMKM!']);
    }

        $products = $user->umkm->products; 
        return view('products.index', compact('products'));
    }


    // ❌ Menghapus Produk (Hanya Pemilik Produk)
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Pastikan hanya pemilik UMKM yang bisa menghapus
        if ($product->umkm_id !== Auth::user()->umkm->id) {
            return redirect()->route('products.index')->with('error', 'Anda tidak memiliki izin untuk menghapus produk ini.');
        }

        // Hapus produk
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }
}
