<?php

namespace App\Services;

use App\Models\Berita;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class NewsService
{
    private const CACHE_TTL = 3600; // 1 jam
    private const MAX_HIGHLIGHT = 5;

    public function getAdminNews(array $filters = [], int $perPage = 15)
    {
        $query = Berita::query();

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
            $query->orderBy('id', 'asc');
        } elseif ($sort === 'az') {
            $query->orderBy('judul', 'asc');
        } elseif ($sort === 'za') {
            $query->orderBy('judul', 'desc');
        } else {
            $query->orderBy('id', 'desc');
        }

        return $query->paginate($perPage);
    }

    /**
     * Get published news only
     */
    public function getPublishedNews(int $perPage = 10)
    {
        return Cache::remember('news.published.' . $perPage, self::CACHE_TTL, function () use ($perPage) {
            return Berita::where('status', 'publish')
                ->where(function ($query) {
                    $query->whereNull('tanggal_publikasi')
                        ->orWhere('tanggal_publikasi', '<=', now());
                })
                ->orderBy('tanggal_publikasi', 'desc')
                ->paginate($perPage);
        });
    }

    /**
     * Get single news by ID
     */
    public function getNewsById(int $id): Berita
    {
        return Cache::remember('news.' . $id, self::CACHE_TTL, function () use ($id) {
            return Berita::findOrFail($id);
        });
    }

    /**
     * Create new news
     */
    public function createNews(array $data): Berita
    {
        return DB::transaction(function () use ($data) {
            // Handle thumbnail upload
            if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
                $data['thumbnail'] = $this->handleThumbnailUpload($data['thumbnail']);
            }

            // Handle multiple images upload with Order
            $finalImages = [];
            if (isset($data['images']) && is_array($data['images'])) {
                // Upload all new files first
                $uploadedPaths = $this->handleMultipleImageUpload($data['images']);

                // If order input exists, sort them
                if (isset($data['image_order']) && !empty($data['image_order'])) {
                    $order = json_decode($data['image_order'], true);
                    if (is_array($order)) {
                        $newImageIndex = 0;
                        foreach ($order as $item) {
                            if (str_starts_with($item, 'existing:')) {
                                $path = substr($item, 9);
                                if (isset($data['existing_images']) && in_array($path, $data['existing_images'])) {
                                    $finalImages[] = $path;
                                }
                            } elseif (str_starts_with($item, 'new:')) {
                                if (isset($uploadedPaths[$newImageIndex])) {
                                    $finalImages[] = $uploadedPaths[$newImageIndex];
                                    $newImageIndex++;
                                }
                            }
                        }

                        // Append any remaining new images
                        while (isset($uploadedPaths[$newImageIndex])) {
                            $finalImages[] = $uploadedPaths[$newImageIndex];
                            $newImageIndex++;
                        }
                    } else {
                        $finalImages = $uploadedPaths;
                    }
                } else {
                    $finalImages = $uploadedPaths;
                }
            } else {
                $finalImages = [];
            }

            $data['gambar'] = $finalImages;

            // Process tags
            $data['tags'] = $this->processTags($data['tags'] ?? '');

            // Set publish date
            $data['tanggal_publikasi'] = $this->determinePublishDate($data);

            // Create news
            $news = Berita::create($data);

            if ($news->status === 'publish' && $news->is_highlight) {
                $this->enforceHighlightLimit();
            }

            // Clear cache
            $this->clearNewsCache();

            return $news;
        });
    }

    /**
     * Update existing news
     */
    public function updateNews(Berita $news, array $data): Berita
    {
        return DB::transaction(function () use ($news, $data) {
            // Handle thumbnail update
            if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
                $this->deleteThumbnail($news);
                $data['thumbnail'] = $this->handleThumbnailUpload($data['thumbnail']);
            } elseif (isset($data['thumbnail_remove']) && $data['thumbnail_remove'] === '1') {
                $this->deleteThumbnail($news);
                $data['thumbnail'] = null;
            }

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

                        $this->deleteRemovedImages($news, $existingImages);

                    } else {
                        $this->deleteRemovedImages($news, $existingImages);
                        $finalImages = array_merge($existingImages, $uploadedPaths);
                    }
                } else {
                    $this->deleteRemovedImages($news, $existingImages);
                    $finalImages = array_merge($existingImages, $uploadedPaths);
                }

                $data['gambar'] = $finalImages;
            }

            // Process tags
            $data['tags'] = $this->processTags($data['tags'] ?? '');

            // Update publish date if needed
            if (isset($data['status']) && $data['status'] === 'publish') {
                $data['tanggal_publikasi'] = $this->determinePublishDate($data);
            }

            // Update news
            $news->update($data);

            $resultStatus = $data['status'] ?? $news->status;
            $resultHighlight = array_key_exists('is_highlight', $data) ? (bool) $data['is_highlight'] : (bool) $news->is_highlight;

            if ($resultStatus === 'publish' && $resultHighlight) {
                $this->enforceHighlightLimit();
            }

            // Clear cache
            $this->clearNewsCache($news->id);

            return $news;
        });
    }

    /**
     * Delete news
     */
    public function deleteNews(Berita $news): bool
    {
        return DB::transaction(function () use ($news) {
            // Delete thumbnail
            $this->deleteThumbnail($news);

            // Delete all images
            $this->deleteAllImages($news);

            // Delete news
            $deleted = $news->delete();

            // Clear cache
            $this->clearNewsCache($news->id);

            return $deleted;
        });
    }

    /**
     * Handle thumbnail upload without compression
     */
    private function handleThumbnailUpload(UploadedFile $file): string
    {
        $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $filename = time() . '_thumb_' . $baseName . '.' . $file->getClientOriginalExtension();
        $path = 'berita/thumbnails/' . $filename;

        // Ensure file is valid before storing
        if (!$file->isValid()) {
            throw new \Exception('File upload failed or invalid file.');
        }

        // Use getPathname() and file_get_contents/stream to avoid getRealPath() issues on some envs
        Storage::disk('public')->put($path, file_get_contents($file->getPathname()));

        return $path;
    }

    /**
     * Handle multiple image upload without compression
     */
    private function handleMultipleImageUpload(array $files): array
    {
        $images = [];

        foreach ($files as $index => $file) {
            if ($file instanceof UploadedFile) {
                // Ensure file is valid before storing
                if (!$file->isValid()) {
                    continue;
                }

                $baseName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
                $filename = time() . '_' . $index . '_' . $baseName . '.' . $file->getClientOriginalExtension();
                $path = 'berita/images/' . $filename;

                Storage::disk('public')->put($path, file_get_contents($file->getPathname()));
                $images[] = $path;
            }
        }

        return $images;
    }

    /**
     * Process tags string
     */
    private function processTags(string $tags): string
    {
        $tagsList = array_values(array_filter(array_map('trim', explode(',', $tags))));

        if (count($tagsList) > 10) {
            $tagsList = array_slice($tagsList, 0, 10);
        }

        return implode(',', $tagsList);
    }

    /**
     * Determine publish date
     */
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

    private function enforceHighlightLimit(): void
    {
        $highlightIds = Berita::where('status', 'publish')
            ->where('is_highlight', true)
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->orderByRaw('tanggal_publikasi is null asc')
            ->orderBy('tanggal_publikasi', 'desc')
            ->orderBy('id', 'desc')
            ->lockForUpdate()
            ->pluck('id');

        if ($highlightIds->count() <= self::MAX_HIGHLIGHT) {
            return;
        }

        $idsToUnhighlight = $highlightIds
            ->slice(self::MAX_HIGHLIGHT)
            ->values()
            ->all();

        Berita::whereIn('id', $idsToUnhighlight)->update(['is_highlight' => false]);

        foreach ($idsToUnhighlight as $id) {
            Cache::forget('news.' . $id);
        }
    }

    /**
     * Delete thumbnail
     */
    private function deleteThumbnail(Berita $news): void
    {
        if ($news->thumbnail && Storage::disk('public')->exists($news->thumbnail)) {
            Storage::disk('public')->delete($news->thumbnail);
        }
    }

    /**
     * Delete all images
     */
    private function deleteAllImages(Berita $news): void
    {
        if ($news->gambar && is_array($news->gambar)) {
            foreach ($news->gambar as $imagePath) {
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }
    }

    /**
     * Delete removed images
     */
    private function deleteRemovedImages(Berita $news, array $keptImages): void
    {
        $currentImages = is_array($news->gambar) ? $news->gambar : [];
        $removedImages = array_diff($currentImages, $keptImages);

        foreach ($removedImages as $imagePath) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }

    /**
     * Clear news cache
     */
    private function clearNewsCache(?int $newsId = null): void
    {
        if ($newsId) {
            Cache::forget('news.' . $newsId);
        }

        // Clear paginated cache
        Cache::forget('news.all.15');
        Cache::forget('news.published.15');

        // Clear all paginated cache patterns
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget('news.all.' . $i);
            Cache::forget('news.published.' . $i);
        }

        // Clear widget cache
        Cache::forget('widget.latest_news');
    }

    /**
     * Generate draft title
     */
    public function generateDraftTitle(): string
    {
        return 'Draft ' . now()->format('Y-m-d H:i');
    }

    /**
     * Generate default draft description
     */
    public function generateDraftDescription(): string
    {
        return 'Draft belum memiliki deskripsi.';
    }

    /**
     * Validate draft content
     */
    public function validateDraftContent(array $data): bool
    {
        $rawJudul = trim((string) ($data['title'] ?? ''));
        $rawDeskripsiText = trim(strip_tags((string) ($data['content'] ?? '')));
        $rawPenulis = trim((string) ($data['author'] ?? ''));
        $rawTags = trim((string) ($data['tags'] ?? ''));
        $hasNewMedia = isset($data['thumbnail']) || isset($data['images']);

        return !($rawJudul === '' && $rawDeskripsiText === '' && $rawPenulis === '' && $rawTags === '' && !$hasNewMedia);
    }
}
