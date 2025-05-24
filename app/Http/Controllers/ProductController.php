<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{
    public function dashboard()
    {
    $umkm = auth()->user()->umkm;

    // Ambil produk milik UMKM yang sedang login
    $products = $umkm->products()->withCount('orders')->get();

    // Contoh data dummy untuk keperluan visualisasi (ganti sesuai data aslimu)
    $totalPenjualan = 1000000; // Total penjualan 7 hari terakhir
    $totalKunjungan = 250; // Total kunjungan
    $trendingProducts = $umkm->products()->orderByDesc('views')->limit(5)->get();

    return view('umkm.dashboard', compact(
        'products', 
        'totalPenjualan', 
        'totalKunjungan',
        'trendingProducts'
    ));
    }

    // 📄 Tampilkan Produk
    public function show($productId)
    {
        // Memuat data produk beserta ratingnya
        $product = Product::with('ratings')->find($productId);

        // Jika produk tidak ditemukan
        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
        }

        // Menghitung rata-rata rating
        $averageRating = $product->average_rating;

        return view('products.show', compact('product', 'averageRating'));
    }


     public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('products.edit', compact('product'));
    }

    // 💾 Menyimpan Perubahan Produk
   public function update(Request $request, $id)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $product = Product::findOrFail($id);

    // Cek apakah produk milik UMKM yang sedang login
    if ($product->umkm_id !== Auth::user()->umkm->id) {
        return redirect()->route('products.index')->with('error', 'Anda tidak memiliki izin untuk mengupdate produk ini.');
    }

    // Ambil data produk yang akan diupdate
    $data = $request->only(['name', 'description', 'price']);

    // Jika ada gambar baru
    if ($request->hasFile('image')) {
        // Hapus gambar lama jika ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Simpan gambar baru
        $data['image'] = $request->file('image')->store('products', 'public');
    }

    // Update produk
    $product->update($data);

    return redirect()->route('products.index')->with('success', 'Produk berhasil diperbarui!');
}


    // 🛍️ Simpan Produk Baru
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if (!$user->umkm) {
            return back()->withErrors(['message' => 'Anda belum memiliki UMKM!']);
        }

        $imagePath = $request->file('image')->store('products', 'public');

        $product = $user->umkm->products()->create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
        ]);

        return redirect()->route('products.index')->with('success', 'Produk berhasil ditambahkan!');
    }

    // 📌 Tampilkan Semua Produk UMKM
    public function index()
    {
        $user = auth()->user();

        if (!$user->umkm) {
            return back()->withErrors(['message' => 'Anda belum menjadi UMKM!']);
        }

        $products = $user->umkm->products;

        return view('products.index', compact('products'));
    }

    public function create()
    {
    return view('products.create');
    }
    // ❌ Hapus Produk
    public function destroy($id)
    {
        $product = Product::findOrFail($id);

        if ($product->umkm_id !== Auth::user()->umkm->id) {
            return redirect()->route('products.index')->with('error', 'Anda tidak memiliki izin untuk menghapus produk ini.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produk berhasil dihapus!');
    }

    

public function landingPage()
{
    $products = Product::all();
    // return view('productlanding', compact('products'));
    // $categories = DB::table('umkms')->select('kategori_id')->distinct()->get();
    $kategoriDigunakan = DB::table('umkms')->pluck('kategori_id')->unique();
    $kategori = Kategori::whereIn('id', $kategoriDigunakan)->get();

    // return view('productlanding', compact('products', 'categories'));

    return view('productlanding', compact('products', 'kategori'));
}
public function getProductDetail($productId) {
    $product = Product::with('ratings.user')->find($productId);
    return response()->json([
        'ratings' => $product->ratings,
    ]);
}

public function detail($productId)
{
    $product = Product::with('ratings.user')->find($productId);

    if (!$product) {
        abort(404, 'Produk tidak ditemukan.');
    }

    $averageRating = $product->average_rating;

    return view('detailproduct', compact('product', 'averageRating'));
}


}

