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
        'no_hp',
        'alamat',
        'deskripsi',
        'kategori_id',
        'instagram',
        'whatsapp',
        'nama_akun',
        'no_rekening',
        'nama_bank',
        'status',
    ];

    /**
     * Relasi ke User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
    return $this->hasMany(Product::class);
    }

    /**
     * Relasi ke Foto UMKM (jika ada tabel photos)
     */
    public function photos()
    {
        return $this->hasMany(umkmfoto::class);
    }

    /**
     * Scope untuk UMKM yang disetujui admin
     */
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    /**
     * Scope untuk UMKM yang masih menunggu persetujuan
     */
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');
    }
}
