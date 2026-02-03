<?php

namespace App\Services;

use App\Models\Video;

class VideoService
{
    public function getAdminVideos($filters = [], $perPage = 15)
    {
        $query = Video::query();

        $search = trim((string) ($filters['search'] ?? ''));
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('judul', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%")
                    ->orWhere('link', 'like', "%{$search}%");
            });
        }

        $status = $filters['status'] ?? null;
        if (in_array($status, ['publish', 'draft', 'nonaktif'], true)) {
            $query->where('status', $status);
        }

        $sort = $filters['sort'] ?? 'latest';
        switch ($sort) {
            case 'oldest':
                $query->orderBy('tanggal_publikasi', 'asc')->orderBy('id', 'asc');
                break;
            case 'az':
                $query->orderBy('judul', 'asc')->orderBy('id', 'desc');
                break;
            case 'za':
                $query->orderBy('judul', 'desc')->orderBy('id', 'desc');
                break;
            default:
                $query->orderBy('tanggal_publikasi', 'desc')->orderBy('id', 'desc');
                break;
        }

        return $query->paginate($perPage);
    }
}

