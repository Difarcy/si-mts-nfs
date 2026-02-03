<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Komentar extends Model
{
    protected $table = 'komentar';
    protected $guarded = ['id'];
    public $timestamps = false;

    protected $casts = [
        'tanggal' => 'datetime',
        'is_read' => 'boolean',
    ];

    protected $appends = ['total_likes'];

    public function getTotalLikesAttribute(): int
    {
        $adminLikes = $this->liked_by_admins_count ?? $this->likedByAdmins()->count();
        $publicLikes = $this->liked_by_public_count ?? $this->likedByPublic()->count();
        return (int) ($adminLikes + $publicLikes);
    }

    public function threadRoot(): BelongsTo
    {
        return $this->belongsTo(self::class, 'thread_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    public function threadReplies(): HasMany
    {
        return $this->hasMany(self::class, 'thread_id', 'id')
            ->whereColumn('id', '!=', 'thread_id');
    }

    public function likedByAdmins(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'komentar_like', 'komentar_id', 'user_id');
    }

    public function likedByPublic(): HasMany
    {
        return $this->hasMany(KomentarLikePublik::class, 'komentar_id');
    }

    public function scopeForWebsite($query)
    {
        return $query->where('status', 'approved')
            ->withCount(['likedByAdmins', 'likedByPublic'])
            ->orderBy('tanggal', 'asc');
    }
}
