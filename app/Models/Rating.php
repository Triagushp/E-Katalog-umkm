<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'rating',
        'review',
    ];

    // Relasi ke User (Rating diberikan oleh satu user)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relasi ke Produk (Rating diberikan ke satu produk)
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
