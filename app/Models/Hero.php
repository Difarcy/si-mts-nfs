<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Hero extends Model
{
    protected $table = 'hero';
    
    public $timestamps = false;

    protected $fillable = [
        'tagline',
        'judul',
        'deskripsi',
        'button_text',
        'button_url',
        'show_logo',
        'show_tagline',
        'show_judul',
        'show_deskripsi',
        'show_button',
    ];

    protected $casts = [
        'show_logo' => 'boolean',
        'show_tagline' => 'boolean',
        'show_judul' => 'boolean',
        'show_deskripsi' => 'boolean',
        'show_button' => 'boolean',
    ];
}
