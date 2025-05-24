<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'umkm_id',
        'user_id',
        'status',
        'bukti_pembayaran',
        // tambahkan field lain sesuai kebutuhan
    ];

    // Relasi ke UMKM
    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }

    // Relasi ke User (Pembeli)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Akses URL bukti pembayaran
    public function getBuktiPembayaranUrlAttribute()
    {
        return $this->bukti_pembayaran
            ? asset('storage/' . $this->bukti_pembayaran)
            : null;
    }
}
