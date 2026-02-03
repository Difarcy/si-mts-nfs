<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    protected $table = 'video';
    public $timestamps = false;

    protected $fillable = [
        'judul',
        'link',
        'deskripsi',
        'status',
        'tanggal_publikasi',
    ];

    protected $casts = [
        'tanggal_publikasi' => 'datetime',
    ];

    public function getYoutubeIdAttribute()
    {
        $url = trim((string) ($this->link ?? ''));
        if ($url === '')
            return null;

        if (preg_match('~youtu\.be/([A-Za-z0-9_-]{6,})~', $url, $m)) {
            return $m[1];
        }

        if (preg_match('~youtube\.com/(?:watch\?v=|embed/|shorts/)([A-Za-z0-9_-]{6,})~', $url, $m)) {
            return $m[1];
        }

        $parts = parse_url($url);
        if (!is_array($parts))
            return null;

        if (!empty($parts['query'])) {
            parse_str($parts['query'], $query);
            $v = $query['v'] ?? null;
            if (is_string($v) && $v !== '')
                return $v;
        }

        return null;
    }

    public function getYoutubeThumbnailUrlAttribute()
    {
        $id = $this->youtube_id;
        if (!$id)
            return null;

        return "https://img.youtube.com/vi/{$id}/hqdefault.jpg";
    }
}
