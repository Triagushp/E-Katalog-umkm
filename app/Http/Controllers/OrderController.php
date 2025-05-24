<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class OrderController extends Controller
{
    public function uploadBukti(Request $request, $id)
    {
        $request->validate([
            'bukti_pembayaran' => 'required|image|max:2048'
        ]);

        $order = Order::findOrFail($id);

        // Simpan gambar
        $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

        // Update data order
        $order->bukti_pembayaran = $path;
        $order->status = 'menunggu_konfirmasi';
        $order->save();

        return back()->with('success', 'Bukti pembayaran berhasil diupload.');
    }

    public function index()
    {
        $orders = Order::with('umkm')->whereIn('status', ['menunggu_konfirmasi'])->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function verifikasi(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'dibayar';
        $order->save();

        return back()->with('success', 'Pesanan telah dikonfirmasi sebagai dibayar.');
    }

    public function checkoutStore(Request $request)
{
    $umkmId = $request->input('umkm_id');
    $storeItems = json_decode($request->input('store_items'), true);
    
    if (empty($storeItems)) {
        return redirect()->back()->with('error', 'Tidak ada produk yang dipilih');
    }
    
    // Ambil informasi UMKM
    $umkm = \App\Models\Umkm::findOrFail($umkmId);
    
    // Buat order baru
    $order = new Order();
    $order->user_id = auth()->id();
    $order->umkm_id = $umkmId;
    $order->total_amount = 0; // akan dihitung
    $order->status = 'menunggu_pembayaran';
    $order->save();
    
    // Hitung total dan tambahkan item ke order
    $totalAmount = 0;
    foreach ($storeItems as $item) {
        $cartItem = \App\Models\Cart::findOrFail($item['id']);
        $product = $cartItem->product;
        
        // Tambahkan ke order detail
        $orderDetail = new Order();
        $orderDetail->order_id = $order->id;
        $orderDetail->product_id = $product->id;
        $orderDetail->quantity = $item['quantity'];
        $orderDetail->price = $product->price;
        $orderDetail->subtotal = $product->price * $item['quantity'];
        $orderDetail->save();
        
        // Tambahkan ke total
        $totalAmount += $orderDetail->subtotal;
        
        // Hapus item dari keranjang
        $cartItem->delete();
    }
    
    // Update total order
    $order->total_amount = $totalAmount;
    $order->save();
    
    return redirect()->route('orders.show', $order->id)->with('success', 'Checkout berhasil, silakan lakukan pembayaran.');
}
}
