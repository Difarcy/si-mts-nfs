<?php

namespace App\Models\Concerns;

use App\Models\Komentar;
use Illuminate\Support\Facades\DB;

trait DeletesRelatedKomentar
{
    protected static function bootDeletesRelatedKomentar(): void
    {
        static::deleting(function ($model) {
            $type = defined(static::class . '::KOMENTAR_KONTEN_TIPE') ? static::KOMENTAR_KONTEN_TIPE : null;
            if (!$type) {
                return;
            }

            $kontenId = $model->getKey();
            if (!$kontenId) {
                return;
            }

            Komentar::query()
                ->select('id')
                ->where('konten_tipe', $type)
                ->where('konten_id', $kontenId)
                ->orderBy('id')
                ->chunkById(500, function ($rows) {
                    $ids = $rows->pluck('id')->all();
                    if (count($ids) === 0) {
                        return;
                    }

                    DB::table('komentar_like')->whereIn('komentar_id', $ids)->delete();
                    DB::table('komentar_like_publik')->whereIn('komentar_id', $ids)->delete();
                });

            Komentar::query()
                ->where('konten_tipe', $type)
                ->where('konten_id', $kontenId)
                ->delete();
        });
    }
}

