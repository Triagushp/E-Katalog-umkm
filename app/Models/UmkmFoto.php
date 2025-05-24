<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UmkmFoto extends Model
{
    use HasFactory;

    protected $fillable = [
        'umkm_id',
        'file_path',
    ];

    protected $table = 'umkm_foto'; 

    public function umkm()
    {
        return $this->belongsTo(Umkm::class);
    }
}
