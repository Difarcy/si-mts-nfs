<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SpmbPpdb extends Model
{
    protected $table = 'spmb_ppdb';

    protected $fillable = [
        'status',
        'tahun',
        'kuota',
        'biaya',
        'g1t1nm', 'g1t1st', 'g1t1en',
        'g1t2nm', 'g1t2st', 'g1t2en',
        'g1t3nm', 'g1t3st', 'g1t3en',
        'g1t4nm', 'g1t4st', 'g1t4en',
        'g1t5nm', 'g1t5st', 'g1t5en',
        'g2t1nm', 'g2t1st', 'g2t1en',
        'g2t2nm', 'g2t2st', 'g2t2en',
        'g2t3nm', 'g2t3st', 'g2t3en',
        'g2t4nm', 'g2t4st', 'g2t4en',
        'g2t5nm', 'g2t5st', 'g2t5en',
    ];

    public $timestamps = false;
}

