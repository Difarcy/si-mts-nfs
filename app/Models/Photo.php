<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $table = 'foto';
    public $timestamps = false;

    protected $fillable = [
        'gambar',
        'tanggal_publikasi',
        'urutan',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];
}
