<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    // 📊 Dashboard UMKM
    public function dashboard()
    {
        $user = auth()->user();

        // Pastikan user sudah punya UMKM
        if (!$user->umkm) {
            return redirect()->route('products.index')->withErrors(['message' => 'Anda belum memiliki UMKM.']);
        }

        // Ambil semua produk milik UMKM ini
        $products = $user->umkm->products()->withCount('orders')->get();

        // Hitung total penjualan dari semua produk
        $totalPenjualan = $products->sum(function($product) {
            return $product->orders_count * $product->price;
        });

        // Dummy data untuk kunjungan dan grafik (bisa kamu ganti dengan yang real)
        $totalKunjungan = 150;

        $salesData = [100000, 200000, 150000, 300000, 400000, 250000, 350000];
        $salesLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];

        $visitData = [20, 30, 25, 50, 40, 35, 60];
        $visitLabels = $salesLabels;

        // Ambil 5 produk terlaris
        $trendingProducts = $products->sortByDesc('orders_count')->take(5);

        return view('umkm.dashboard', compact(
            'products',
            'trendingProducts',
            'totalPenjualan',
            'totalKunjungan',
            'salesData',
            'salesLabels',
            'visitData',
            'visitLabels'
        ));
    }

    // 📄 Tampilkan Produk
    public function show($id)
    {
        $product = Product::with('ratings.user')->findOrFail($id);
        $averageRating = $product->ratings->avg('rating');

        return view('products.show', compact('product', 'averageRating'));
    }

    // 🛍️ Form Tambah Produk
    public function create()
    {
        return view('products.create');
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
}
