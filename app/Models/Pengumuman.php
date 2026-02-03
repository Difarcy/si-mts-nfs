<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'gambar',
        'lampiran',
        'deskripsi',
        'tags',
        'status',
        'penulis',
        'tanggal_publikasi',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'gambar' => 'array',
    ];
}
