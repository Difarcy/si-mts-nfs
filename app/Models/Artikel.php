<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Artikel extends Model
{
    protected $table = 'artikel';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'thumbnail',
        'gambar',
        'deskripsi',
        'status',
        'penulis',
        'tanggal_publikasi',
        'tags',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'gambar' => 'array',
    ];
}

