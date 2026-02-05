<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\DeletesRelatedKomentar;

class Agenda extends Model
{
    use DeletesRelatedKomentar;

    public const KOMENTAR_KONTEN_TIPE = 'agenda';

    protected $table = 'agenda';

    public $timestamps = false;

    protected $fillable = [
        'judul',
        'gambar',
        'lampiran',
        'deskripsi',
        'tags',
        'status',
        'penulis',
        'lokasi',
        'tanggal_publikasi',
        'tanggal_mulai',
        'tanggal_selesai',
        'waktu_mulai',
        'waktu_selesai',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'gambar' => 'array',
    ];
}
