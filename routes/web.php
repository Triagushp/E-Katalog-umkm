<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;

// 🏠 Halaman Beranda (Bisa Diakses Semua)
Route::get('/', [ProductController::class, 'index'])->name('home');

// 🏠 Dashboard (Menyesuaikan Peran)
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        $user = Auth::user();
        if ($user->role === 'admin') {
            return view('admin.dashboard');
        } elseif ($user->role === 'umkm') {
            return view('dashboard.umkm');
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

// 🛍️ Produk Routes (Hanya UMKM yang Bisa Mengelola)
Route::middleware(['auth', 'role:umkm'])->prefix('umkm')->name('umkm.')->group(function () {
    Route::get('/products', [ProductController::class, 'index'])->name('products.index'); // Daftar Produk
    Route::get('/dashboard', [ProductController::class, 'dashboard'])->name('umkm.dashboard');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create'); // Halaman Tambah Produk
    Route::post('/products', [ProductController::class, 'store'])->name('products.store'); // Simpan Produk
    Route::get('products/{id}', [ProductController::class, 'show'])->name('products.show');
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
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::post('/products/{id}/rate', [RatingController::class, 'store'])->name('rate.product');
});

// 👑 ADMIN: Kelola UMKM
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/umkm_requests', [AdminController::class, 'viewUmkmRequests'])->name('umkm_requests');
    Route::put('/approve-umkm/{id}', [AdminController::class, 'approveUmkm'])->name('approve_umkm');
    Route::delete('/reject-umkm/{id}', [AdminController::class, 'rejectUmkm'])->name('reject_umkm');
    Route::get('/approved-umkms', [AdminController::class, 'listApprovedUmkms'])->name('approved_umkms');
});
