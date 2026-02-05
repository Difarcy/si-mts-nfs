<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\DeletesRelatedKomentar;

class Berita extends Model
{
    use DeletesRelatedKomentar;

    public const KOMENTAR_KONTEN_TIPE = 'news';

    // Nama tabel di database
    protected $table = 'berita';

    // Matikan timestamps karena kita sudah menghapusnya di migration
    public $timestamps = false;

    // Kolom yang boleh diisi secara massal
    protected $fillable = [
        'judul',
        'thumbnail',
        'gambar',
        'deskripsi',
        'status',
        'penulis',
        'tanggal_publikasi',
        'is_highlight',
        'tags',
    ];

    // Casting data agar tipe datanya sesuai saat dipanggil
    protected $casts = [
        'is_highlight' => 'boolean',
        'tanggal_publikasi' => 'datetime',
        'gambar' => 'array',
    ];
}
