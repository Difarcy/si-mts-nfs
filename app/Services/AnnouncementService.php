<?php

namespace App\Services;

use App\Models\Pengumuman;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AnnouncementService
{
    private const CACHE_TTL = 3600; // 1 jam

    public function getAdminAnnouncements(array $filters = [], int $perPage = 15)
    {
        $query = Pengumuman::query();

        $search = isset($filters['search']) ? trim((string) $filters['search']) : '';
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $like = '%' . $search . '%';
                $q->where('judul', 'like', $like)
                    ->orWhere('deskripsi', 'like', $like)
                    ->orWhere('penulis', 'like', $like)
                    ->orWhere('tags', 'like', $like);
            });
        }

        $status = isset($filters['status']) ? strtolower(trim((string) $filters['status'])) : '';
        if (in_array($status, ['publish', 'draft', 'nonaktif'], true)) {
            $query->where('status', $status);
        }

        $sort = isset($filters['sort']) ? strtolower(trim((string) $filters['sort'])) : '';
        if ($sort === 'oldest') {
            $query->orderBy('tanggal_publikasi', 'asc')->orderBy('id', 'asc');
        } elseif ($sort === 'az') {
            $query->orderBy('judul', 'asc');
        } elseif ($sort === 'za') {
            $query->orderBy('judul', 'desc');
        } else {
            $query->orderBy('tanggal_publikasi', 'desc')->orderBy('id', 'desc');
        }

        return $query->paginate($perPage);
    }

    public function getAnnouncementById(int $id): Pengumuman
    {
        return Cache::remember('announcement.' . $id, self::CACHE_TTL, function () use ($id) {
            return Pengumuman::findOrFail($id);
        });
    }

    public function createAnnouncement(array $data): Pengumuman
    {
        return DB::transaction(function () use ($data) {
            // Handle thumbnail upload (REMOVED - Pengumuman does not use thumbnail)
            // if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            //     $data['thumbnail'] = $this->handleThumbnailUpload($data['thumbnail']);
            // }

            if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {
                $data['lampiran'] = $this->handleAttachmentUpload($data['attachment']);
                unset($data['attachment']);
            }

            // Handle multiple images upload
            $finalImages = [];
            if (isset($data['images']) && is_array($data['images'])) {
                $uploadedPaths = $this->handleMultipleImageUpload($data['images']);
                $finalImages = $uploadedPaths;
            }

            $data['gambar'] = $finalImages;

            $data['tags'] = $this->processTags($data['tags'] ?? null);

            // Set publish date
            $data['tanggal_publikasi'] = $this->determinePublishDate($data);

            // Create announcement
            $announcement = Pengumuman::create($data);

            // Clear cache
            $this->clearAnnouncementCache();

            return $announcement;
        });
    }

    public function updateAnnouncement(Pengumuman $announcement, array $data): Pengumuman
    {
        return DB::transaction(function () use ($announcement, $data) {
            // Handle thumbnail update (REMOVED - Pengumuman does not use thumbnail)
            // if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
            //     $this->deleteThumbnail($announcement);
            //     $data['thumbnail'] = $this->handleThumbnailUpload($data['thumbnail']);
            // } elseif (isset($data['thumbnail_remove']) && $data['thumbnail_remove'] === '1') {
            //     $this->deleteThumbnail($announcement);
            //     $data['thumbnail'] = null;
            // }

            // Handle images update with Order
            if (isset($data['images']) || isset($data['existing_images'])) {
                $existingImages = $data['existing_images'] ?? [];
                $uploadedPaths = [];

                if (isset($data['images']) && is_array($data['images'])) {
                    $uploadedPaths = $this->handleMultipleImageUpload($data['images']);
                }

                $finalImages = [];

                if (isset($data['image_order']) && !empty($data['image_order'])) {
                    $order = json_decode($data['image_order'], true);

                    if (is_array($order)) {
                        $newImageIndex = 0;

                        foreach ($order as $item) {
                            if (str_starts_with($item, 'existing:')) {
                                $path = substr($item, 9);
                                if (in_array($path, $existingImages)) {
                                    $finalImages[] = $path;
                                }
                            } elseif (str_starts_with($item, 'new:')) {
                                if (isset($uploadedPaths[$newImageIndex])) {
                                    $finalImages[] = $uploadedPaths[$newImageIndex];
                                    $newImageIndex++;
                                }
                            }
                        }

                        while (isset($uploadedPaths[$newImageIndex])) {
                            $finalImages[] = $uploadedPaths[$newImageIndex];
                            $newImageIndex++;
                        }

                        $this->deleteRemovedImages($announcement, $existingImages);

                    } else {
                        $this->deleteRemovedImages($announcement, $existingImages);
                        $finalImages = array_merge($existingImages, $uploadedPaths);
                    }
                } else {
                    $this->deleteRemovedImages($announcement, $existingImages);
                    $finalImages = array_merge($existingImages, $uploadedPaths);
                }

                $data['gambar'] = $finalImages;
            }

            if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {
                $this->deleteAttachment($announcement);
                $data['lampiran'] = $this->handleAttachmentUpload($data['attachment']);
                unset($data['attachment']);
            }

            if (array_key_exists('tags', $data)) {
                $data['tags'] = $this->processTags($data['tags']);
            }

            // Update publish date if needed
            if (isset($data['status']) && $data['status'] === 'publish') {
                $data['tanggal_publikasi'] = $this->determinePublishDate($data);
            }

            // Update announcement
            $announcement->update($data);

            // Clear cache
            $this->clearAnnouncementCache($announcement->id);

            return $announcement;
        });
    }

    public function deleteAnnouncement(Pengumuman $announcement): bool
    {
        return DB::transaction(function () use ($announcement) {
            // Delete thumbnail (REMOVED)
            // $this->deleteThumbnail($announcement);

            $this->deleteAttachment($announcement);

            // Delete all images
            $this->deleteAllImages($announcement);

            // Delete announcement
            $deleted = $announcement->delete();

            // Clear cache
            $this->clearAnnouncementCache($announcement->id);

            return $deleted;
        });
    }

    private function handleThumbnailUpload(UploadedFile $file): string
    {
        $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = time() . '_thumb_' . $baseName . '.' . $file->getClientOriginalExtension();
        $path = 'pengumuman/thumbnails/' . $filename;

        if (!$file->isValid()) {
            throw new \Exception('File upload failed or invalid file.');
        }

        Storage::disk('public')->put($path, file_get_contents($file->getPathname()));

        return $path;
    }

    private function handleMultipleImageUpload(array $files): array
    {
        $images = [];

        foreach ($files as $index => $file) {
            if ($file instanceof UploadedFile) {
                if (!$file->isValid())
                    continue;

                $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = time() . '_' . $index . '_' . $baseName . '.' . $file->getClientOriginalExtension();
                $path = 'pengumuman/images/' . $filename;

                Storage::disk('public')->put($path, file_get_contents($file->getPathname()));
                $images[] = $path;
            }
        }

        return $images;
    }

    private function handleAttachmentUpload(UploadedFile $file): string
    {
        $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = time() . '_file_' . $baseName . '.' . $file->getClientOriginalExtension();
        $path = 'pengumuman/files/' . $filename;

        if (!$file->isValid()) {
            throw new \Exception('File upload failed or invalid file.');
        }

        Storage::disk('public')->put($path, file_get_contents($file->getPathname()));

        return $path;
    }

    private function determinePublishDate(array $data): ?string
    {
        if (array_key_exists('tanggal_publikasi', $data)) {
            $value = $data['tanggal_publikasi'];
            if ($value instanceof \DateTimeInterface) {
                return $value->format('Y-m-d H:i:s');
            }
            if (is_string($value) && trim($value) !== '') {
                return $value;
            }
            if ($value === null) {
                return null;
            }
        }

        if (isset($data['status']) && $data['status'] === 'publish') {
            if (isset($data['is_scheduled']) && isset($data['published_date'])) {
                $time = $data['published_time'] ?? '00:00';
                return $data['published_date'] . ' ' . $time;
            } else {
                return now()->format('Y-m-d H:i:s');
            }
        }

        return null;
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

    private function deleteThumbnail(Pengumuman $announcement): void
    {
        if ($announcement->thumbnail && Storage::disk('public')->exists($announcement->thumbnail)) {
            Storage::disk('public')->delete($announcement->thumbnail);
        }
    }

    private function deleteAttachment(Pengumuman $announcement): void
    {
        if ($announcement->lampiran && Storage::disk('public')->exists($announcement->lampiran)) {
            Storage::disk('public')->delete($announcement->lampiran);
        }
    }

    private function deleteAllImages(Pengumuman $announcement): void
    {
        if ($announcement->gambar && is_array($announcement->gambar)) {
            foreach ($announcement->gambar as $imagePath) {
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }
    }

    private function deleteRemovedImages(Pengumuman $announcement, array $keptImages): void
    {
        $currentImages = is_array($announcement->gambar) ? $announcement->gambar : [];
        $removedImages = array_diff($currentImages, $keptImages);

        foreach ($removedImages as $imagePath) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }

    private function clearAnnouncementCache(?int $id = null): void
    {
        if ($id) {
            Cache::forget('announcement.' . $id);
        }

        Cache::forget('announcement.all.15');
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget('announcement.all.' . $i);
        }

        // Clear widget cache
        Cache::forget('widget.latest_announcements');
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
        $rawJudul = trim((string) ($data['judul'] ?? ''));
        $rawDeskripsiText = trim(strip_tags((string) ($data['deskripsi'] ?? '')));
        // $rawPenulis tidak perlu divalidasi manual karena diambil dari auth()->id()
        $hasNewMedia = isset($data['thumbnail']) || isset($data['images']) || isset($data['attachment']);

        return !($rawJudul === '' && $rawDeskripsiText === '' && !$hasNewMedia);
    }
}
