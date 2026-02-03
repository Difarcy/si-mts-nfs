<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pesan extends Model
{
    protected $table = 'pesan_masuk';
    public $timestamps = false;

    protected $fillable = [
        'nama',
        'email',
        'telepon',
        'subject',
        'pesan',
        'tanggal',
        'status',
    ];

    protected $casts = [
        'tanggal' => 'datetime',
    ];
}
