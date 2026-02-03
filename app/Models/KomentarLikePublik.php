<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KomentarLikePublik extends Model
{
    protected $table = 'komentar_like_publik';
    protected $guarded = ['id'];
    public $timestamps = false;
}
