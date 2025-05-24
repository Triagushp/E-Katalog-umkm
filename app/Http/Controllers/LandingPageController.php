<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Umkm;


class LandingPageController extends Controller
{
    public function index()
    {
        // Ambil semua kategori unik dari tabel umkms
        // $categories = Umkm::select('kategori')->distinct()->get();

        // Ambil produk terbaru
        $products = Product::with('umkm')->latest()->limit(8)->get();

        return view('home', compact('products'));
    }
}
