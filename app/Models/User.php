<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Auth\Passwords\CanResetPassword;

class User extends Authenticatable
{
    use HasFactory, Notifiable;
    use Notifiable, CanResetPassword;
    /**
     * Kolom yang dapat diisi (mass assignment)
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',    // Bisa 'admin', 'umkm', atau 'user'
        'phone',
        'address',
    ];

    /**
     * Kolom yang disembunyikan saat serialisasi
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Kolom yang harus di-cast ke tipe data tertentu
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Relasi ke tabel UMKM (User bisa memiliki satu UMKM)
     */
    public function umkm()
    {
        return $this->hasOne(Umkm::class);
    }

    /**
     * Relasi ke tabel Rating (User bisa memberikan banyak rating)
     */
    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    /**
     * Update profil user dengan data yang diberikan
     */
    public function updateProfile(array $data)
    {
        return $this->update([
            'name'    => $data['name'] ?? $this->name,
            'phone'   => $data['phone'] ?? $this->phone,
            'address' => $data['address'] ?? $this->address,
        ]);
    }
}
