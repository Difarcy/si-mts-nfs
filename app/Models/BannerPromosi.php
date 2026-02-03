<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BannerPromosi extends Model
{
    protected $table = 'banner_promosi';

    protected $fillable = ['path'];

    public $timestamps = false;
}

