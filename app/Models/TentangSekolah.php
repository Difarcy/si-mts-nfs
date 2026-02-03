<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TentangSekolah extends Model
{
    protected $table = 'tentang_sekolah';

    protected $fillable = [
        'foto',
        'deskripsi',
        'sejarah',
    ];

    public $timestamps = false;
}

