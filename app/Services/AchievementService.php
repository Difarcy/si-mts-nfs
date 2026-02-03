<?php

namespace App\Services;

use App\Models\PrestasiSiswa;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AchievementService
{
    private const CACHE_TTL = 3600; // 1 jam

    public function getAdminAchievements(array $filters = [], int $perPage = 15)
    {
        $query = PrestasiSiswa::query();

        $search = isset($filters['search']) ? trim((string) $filters['search']) : '';
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $like = '%' . $search . '%';
                $q->where('nama_siswa', 'like', $like)
                    ->orWhere('nama_lomba', 'like', $like)
                    ->orWhere('tags', 'like', $like);
            });
        }

        $status = isset($filters['status']) ? strtolower(trim((string) $filters['status'])) : '';
        if (in_array($status, ['publish', 'draft', 'nonaktif'], true)) {
            $query->where('status', $status);
        }

        $sort = isset($filters['sort']) ? strtolower(trim((string) $filters['sort'])) : '';
        if ($sort === 'oldest') {
            $query->orderBy('tanggal', 'asc');
        } elseif ($sort === 'az') {
            $query->orderBy('nama_siswa', 'asc');
        } elseif ($sort === 'za') {
            $query->orderBy('nama_siswa', 'desc');
        } else {
            $query->orderBy('tanggal', 'desc');
        }

        return $query->paginate($perPage);
    }

    public function getAchievementById(int $id): PrestasiSiswa
    {
        return Cache::remember('achievement.' . $id, self::CACHE_TTL, function () use ($id) {
            return PrestasiSiswa::findOrFail($id);
        });
    }

    public function createAchievement(array $data): PrestasiSiswa
    {
        return DB::transaction(function () use ($data) {
            $data['tags'] = $this->processTags($data['tags'] ?? null);

            if (isset($data['student_photo']) && $data['student_photo'] instanceof UploadedFile) {
                $data['foto_siswa'] = $this->handleFileUpload($data['student_photo'], 'student_photo');
            }
            unset($data['student_photo']);

            if (isset($data['certificate']) && $data['certificate'] instanceof UploadedFile) {
                $data['sertifikat'] = $this->handleFileUpload($data['certificate'], 'certificate');
            }
            unset($data['certificate']);

            $achievement = PrestasiSiswa::create($data);

            $this->clearAchievementCache();

            return $achievement;
        });
    }

    public function updateAchievement(PrestasiSiswa $achievement, array $data): PrestasiSiswa
    {
        return DB::transaction(function () use ($achievement, $data) {
            if (array_key_exists('tags', $data)) {
                $data['tags'] = $this->processTags($data['tags']);
            }

            if (isset($data['student_photo']) && $data['student_photo'] instanceof UploadedFile) {
                $this->deleteFile($achievement->foto_siswa);
                $data['foto_siswa'] = $this->handleFileUpload($data['student_photo'], 'student_photo');
            } elseif (isset($data['student_photo_remove']) && $data['student_photo_remove'] === '1') {
                $this->deleteFile($achievement->foto_siswa);
                $data['foto_siswa'] = null;
            }
            unset($data['student_photo']);

            if (isset($data['certificate']) && $data['certificate'] instanceof UploadedFile) {
                $this->deleteFile($achievement->sertifikat);
                $data['sertifikat'] = $this->handleFileUpload($data['certificate'], 'certificate');
            } elseif (isset($data['certificate_remove']) && $data['certificate_remove'] === '1') {
                $this->deleteFile($achievement->sertifikat);
                $data['sertifikat'] = null;
            }
            unset($data['certificate']);

            $achievement->update($data);

            $this->clearAchievementCache($achievement->id);

            return $achievement;
        });
    }

    public function deleteAchievement(PrestasiSiswa $achievement): bool
    {
        return DB::transaction(function () use ($achievement) {
            $this->deleteFile($achievement->foto_siswa);
            $this->deleteFile($achievement->sertifikat);

            $deleted = $achievement->delete();

            $this->clearAchievementCache($achievement->id);

            return $deleted;
        });
    }

    private function handleFileUpload(UploadedFile $file, string $type): string
    {
        $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = time() . '_' . $type . '_' . $baseName . '.' . $file->getClientOriginalExtension();
        $path = 'prestasi-siswa/' . ($type === 'student_photo' ? 'photos' : 'certificates') . '/' . $filename;

        if (!$file->isValid()) {
            throw new \Exception('File upload failed or invalid file.');
        }

        Storage::disk('public')->put($path, file_get_contents($file->getPathname()));

        return $path;
    }

    private function deleteFile(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    private function clearAchievementCache(?int $id = null): void
    {
        if ($id) {
            Cache::forget('achievement.' . $id);
        }

        Cache::forget('achievement.all.15');
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget('achievement.all.' . $i);
        }
    }

    private function processTags($tags): ?string
    {
        if ($tags === null) {
            return null;
        }

        $raw = trim((string) $tags);
        if ($raw === '') {
            return null;
        }

        $items = array_map('trim', explode(',', $raw));
        $items = array_filter($items, fn ($t) => $t !== '');

        $items = array_values($items);
        if (count($items) > 10) {
            $items = array_slice($items, 0, 10);
        }

        $result = implode(',', $items);
        return $result === '' ? null : $result;
    }

    public function generateDraftTitle(): string
    {
        return 'Draft ' . now()->format('Y-m-d H:i');
    }

    public function generateDraftDescription(): string
    {
        return 'Draft belum memiliki deskripsi.';
    }

    public function validateDraftContent(array $data): bool
    {
        $rawNamaSiswa = trim((string) ($data['nama_siswa'] ?? ''));
        $rawNamaLomba = trim((string) ($data['nama_lomba'] ?? ''));
        $rawDeskripsiText = trim(strip_tags((string) ($data['deskripsi'] ?? '')));
        $rawPenulis = trim((string) ($data['penulis'] ?? ''));
        $hasNewMedia = isset($data['student_photo']) || isset($data['certificate']);

        return !($rawNamaSiswa === '' && $rawNamaLomba === '' && $rawDeskripsiText === '' && $rawPenulis === '' && !$hasNewMedia);
    }
}
