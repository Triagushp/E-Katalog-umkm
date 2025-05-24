<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'judul', 'deskripsi', 'tgl_mulai', 'tgl_berakhir', 'image', 'contact'
    ];
}


