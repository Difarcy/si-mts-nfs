<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Concerns\DeletesRelatedKomentar;

class PrestasiSiswa extends Model
{
    use DeletesRelatedKomentar;

    public const KOMENTAR_KONTEN_TIPE = 'achievement';

    protected $table = 'prestasi_siswa';
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'tanggal' => 'date',
        'tanggal_publikasi' => 'datetime',
    ];
}
