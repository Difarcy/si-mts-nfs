<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KepalaMadrasah extends Model
{
    protected $table = 'kepala_madrasah';

    protected $fillable = [
        'foto',
        'nama',
        'sambutan',
    ];

    public $timestamps = false;
}

