<?php
namespace App\Http\Controllers;

use App\Models\Umkm;
use Illuminate\Http\Request;

class TokoController extends Controller
{
    public function show($id)
    {
        $toko = Umkm::with('products')->findOrFail($id); // pastikan relasi products sudah dibuat
        return view('toko.show', compact('toko'));
    }
}
