<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaSosial extends Model
{
    protected $table = 'media_sosial';

    protected $fillable = [
        'facebook',
        'instagram',
        'youtube',
        'x',
        'tiktok',
    ];

    public $timestamps = false;
}

