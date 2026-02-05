<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\DeletesRelatedKomentar;

class Pengumuman extends Model
{
    use DeletesRelatedKomentar;

    public const KOMENTAR_KONTEN_TIPE = 'announcement';

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
