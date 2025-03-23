<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Umkm extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'address',
        'phone',
        'is_approved' // Status UMKM apakah sudah disetujui atau belum
    ];

    // Relasi ke User (Setiap UMKM dimiliki oleh satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Produk (Setiap UMKM punya banyak produk)
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
