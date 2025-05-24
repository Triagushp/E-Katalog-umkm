<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Cart;

class CartController extends Controller
{
    public function add(Request $request)
{
    $request->validate([
        'product_id' => 'required|exists:products,id',
        'quantity' => 'required|integer|min:1'
    ]);

    $quantity = $request->quantity ?? 1;

        // Cek apakah produk sudah ada di keranjang user
        $cart = Cart::where('user_id', auth()->id())
                    ->where('product_id', $request->product_id)
                    ->first();

        if ($cart) {
            // Jika sudah ada, tambahkan quantity
            $cart->quantity += $quantity;
            $cart->save();
        } else {
            // Jika belum ada, buat baru
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $request->product_id,
                'quantity' => $quantity
            ]);
        }

    // Cart::updateOrCreate(
    //     [
    //         'user_id' => auth()->id(),
    //         'product_id' => $request->product_id
    //     ],
    //     [
    //         'quantity' => DB::raw('quantity + 1')
    //     ]
    // );

    return response()->json(['message' => 'Produk ditambahkan ke keranjang']);
}

public function index()
    {
        $items = Cart::with('product')
            ->where('user_id', auth()->id())
            ->get();

        return view('cart.index', compact('items'));
    }

public function count()
    {
        $count = Cart::where('user_id', auth()->id())->count();
        return response()->json(['count' => $count]);
    }

public function remove($id)
    {
        // Contoh hapus item dari cart
        $cartItem = Cart::findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'Item berhasil dihapus dari keranjang.');
    }
}

