<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VisiMisiTujuan extends Model
{
    protected $table = 'visi_misi_tujuan';

    protected $fillable = [
        'visi',
        'misi',
        'tujuan',
    ];

    public $timestamps = false;
}

