<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'stock',
        'image',
        'umkm_id',
    ];

    public function getImageUrlAttribute()
    {
    if ($this->image && file_exists(public_path('storage/' . $this->image))) {
        return asset('storage/' . $this->image);
    }

    return asset('images/default-product.jpg');
    }

    // Relasi ke UMKM (Produk dimiliki oleh satu UMKM)
    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    // Relasi ke Rating (Satu produk bisa punya banyak rating)
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    // Menghitung rata-rata rating produk
    public function averageRating()
    {
        return $this->ratings()->avg('rating');
    }
}
