<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\DeletesRelatedKomentar;

class Artikel extends Model
{
    use DeletesRelatedKomentar;

    public const KOMENTAR_KONTEN_TIPE = 'article';

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
