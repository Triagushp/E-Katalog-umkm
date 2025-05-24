<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\TokoController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\EventController;

// 🏠 Halaman Beranda (Bisa Diakses Semua)
Route::get('/', [LandingPageController::class, 'index'])->name('landing');
// Route::get('/productlanding', function () {
//     return view('productlanding');
// });

Route::get('/home', function () {
    return view('home');
});

Route::get('/productlanding', [ProductController::class, 'landingPage']);
Route::get('/home', [LandingPageController::class, 'index'])->name('homelanding');
Route::get('/contact', [ContactController::class, 'contactpage']);
Route::post('/contact', [ContactController::class, 'sendEmail'])->name('contact.send');
Route::get('/toko/{id}', [TokoController::class, 'show'])->name('toko.show');
Route::post('/rating', [RatingController::class, 'store'])->middleware('auth');
Route::get('/product/{id}/detail', [ProductController::class, 'getProductDetail']);
Route::get('/product/{id}', [ProductController::class, 'detail'])->name('detailproduct');
// Tambahkan ke routes/web.php jika belum ada
Route::post('/checkout/store', [OrderController::class, 'checkoutStore'])->name('checkout.store');
// Route::post('/checkout/store', 'CheckoutController@checkoutStore')->name('checkout.store');



Route::middleware(['auth'])->group(function () {
    Route::post('/cart', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::get('/cart-count', [CartController::class, 'count'])->name('cart.count');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

});




// 🏠 Dashboard (Menyesuaikan Peran)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'umkm') {
            return view('umkm.dashboard');
        } else {
            return view('dashboard.user');
        }
    })->name('dashboard');
});

// 🔑 Authentication Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('register', 'register')->name('register');
    Route::post('register', 'registerSave')->name('register.save');

    Route::get('login', 'login')->name('login');
    Route::post('login', 'loginAction')->name('login.action');

    Route::post('logout', 'logout')->middleware('auth')->name('logout');
});

// 🛍️ Produk Routes (Bisa Diakses Semua Pengguna)
Route::middleware(['auth'])->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
});

Route::middleware(['auth', 'role:umkm'])->prefix('umkm')->name('umkm.')->group(function () {
    Route::get('/toko', [UmkmController::class, 'showStore'])->name('toko'); // Halaman Toko Saya
    Route::get('/edit', [UmkmController::class, 'edit'])->name('edit'); // Halaman Edit UMKM
    Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Daftar Produk
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Halaman Tambah Produk
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Simpan Produk
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show'); // Detail Produk
    Route::get('/products/{id}/edit', [ProductController::class, 'edit'])->name('products.edit'); // Halaman Edit Produk
    Route::put('/products/{id}', [ProductController::class, 'update'])->name('products.update'); // Update Produk
    Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('products.destroy'); // Hapus Produk
});


// 🎭 Halaman Profil & Pengajuan UMKM
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::put('/profile', [UserController::class, 'profileUpdate'])->name('profile.update');
    Route::get('/apply-umkm', [UserController::class, 'showApplyUmkmForm'])->name('apply.umkm.form');
    Route::post('/apply-umkm', [UserController::class, 'applyUmkm'])->name('apply.umkm');
});

Route::get('/umkm/submitted', function () {
    return view('umkm.submitted'); // Pastikan file ini ada di resources/views/umkm/
})->name('umkm.submitted');

// ⭐ Memberikan Rating Produk (Hanya User Biasa)
// Route::middleware(['auth', 'role:user'])->group(function () {
//     Route::post('/products/{id}/rate', [RatingController::class, 'store'])->name('rate.product');
// });

// 👑 ADMIN: Kelola UMKM
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/umkm_requests', [AdminController::class, 'viewUmkmRequests'])->name('umkm_requests');
    Route::put('/approve-umkm/{id}', [AdminController::class, 'approveUmkm'])->name('approve_umkm');
    Route::delete('/reject-umkm/{id}', [AdminController::class, 'rejectUmkm'])->name('reject_umkm');
    Route::get('/approved-umkms', [AdminController::class, 'listApprovedUmkms'])->name('approved_umkms');
    Route::get('/umkm/{id}', [AdminController::class, 'showUmkmDetail'])->name('show_umkm_detail');
    Route::get('/import-umkm', [AdminController::class, 'showImportForm'])->name('umkm.import');
    Route::post('/import-umkm', [AdminController::class, 'import'])->name('import_umkm');
    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori_index');
    Route::post('/kategori', [KategoriController::class, 'store'])->name('kategori_store');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori_destroy');
    Route::get('/events', [EventController::class, 'index'])->name('events_index');
    Route::get('/events/create', [EventController::class, 'create'])->name('events_create');
    Route::post('/events', [EventController::class, 'store'])->name('events_store');
});

