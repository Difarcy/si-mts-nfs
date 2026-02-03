<?php

namespace App\Services;

use App\Models\Artikel;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class ArticleService
{
    private const CACHE_TTL = 3600; // 1 jam

    public function getAdminArticles(array $filters = [], int $perPage = 15)
    {
        $query = Artikel::query();

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
     * Get single article by ID
     */
    public function getArticleById(int $id): Artikel
    {
        return Cache::remember('article.' . $id, self::CACHE_TTL, function () use ($id) {
            return Artikel::findOrFail($id);
        });
    }

    /**
     * Create new article
     */
    public function createArticle(array $data): Artikel
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
                        // Map: filename -> uploaded_path
                        $newImagesMap = [];
                        foreach ($uploadedPaths as $path) {
                            $filename = basename($path);
                            // The filename format is: time_index_originalName.ext
                            // We need to match it back to the original filename provided in "new:filename"
                            // But wait, the "new:filename" in JS is just the client-side filename.
                            // The stored filename has a timestamp prefix.
                            // However, we can use the $index from the loop in handleMultipleImageUpload
                            // But handleMultipleImageUpload returns a flat array of paths.

                            // Re-strategy: We need to rely on the fact that handleMultipleImageUpload processes files 
                            // in the same order as they are in the array.
                            // BUT, the $order array has mixed "new" and "existing".
                            // The "new" items in $order rely on filename.

                            // Better approach:
                            // The JS sends "new:filename".
                            // We need to map client-side filename to the server-side path.
                            // We can parse the stored path to get the original filename back?
                            // Stored: time_index_originalName.ext
                            // This is risky if multiple files have same name.

                            // Let's refine handleMultipleImageUpload to return [ 'original_name' => 'path' ]?
                            // No, duplicate names are possible.

                            // Let's use the $index.
                            // The input.files array in JS is synced to the DOM order of NEW files.
                            // So $data['images'] received by PHP is ALREADY sorted for new files relative to each other.
                            // The only issue is mixing with existing files.

                            // So:
                            // 1. $uploadedPaths contains new files in their relative order.
                            // 2. We iterate $order.
                            // 3. If "existing:", take from existing.
                            // 4. If "new:", take the NEXT item from $uploadedPaths.

                            // This assumes "new:" items in $order appear in the same relative order as $uploadedPaths.
                            // Since upload-sortable.js syncs input.files to match DOM order, this assumption holds!
                        }

                        $newImageIndex = 0;
                        foreach ($order as $item) {
                            if (str_starts_with($item, 'existing:')) {
                                // For create, there shouldn't be existing images usually, but if there are (re-submit?):
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

                        // Append any remaining new images (just in case)
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

            // Create article
            $article = Artikel::create($data);

            // Clear cache
            $this->clearArticleCache();

            return $article;
        });
    }

    /**
     * Update existing article
     */
    public function updateArticle(Artikel $article, array $data): Artikel
    {
        return DB::transaction(function () use ($article, $data) {
            // Handle thumbnail update
            if (isset($data['thumbnail']) && $data['thumbnail'] instanceof UploadedFile) {
                $this->deleteThumbnail($article);
                $data['thumbnail'] = $this->handleThumbnailUpload($data['thumbnail']);
            } elseif (isset($data['thumbnail_remove']) && $data['thumbnail_remove'] === '1') {
                $this->deleteThumbnail($article);
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
                                // Verify this existing image was actually kept (present in existing_images array)
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

                        // Append remaining new images
                        while (isset($uploadedPaths[$newImageIndex])) {
                            $finalImages[] = $uploadedPaths[$newImageIndex];
                            $newImageIndex++;
                        }

                        // Handle deleted existing images logic (implicit: if not in order/existingImages, it's gone)
                        // But wait, we need to delete images that were REMOVED.
                        // The original logic was:
                        // $this->deleteRemovedImages($article, $data['existing_images']);
                        // We still need to do this.
                        $this->deleteRemovedImages($article, $existingImages);

                    } else {
                        // Fallback if JSON parse fails
                        $this->deleteRemovedImages($article, $existingImages);
                        $finalImages = array_merge($existingImages, $uploadedPaths);
                    }
                } else {
                    // Fallback if no order input
                    $this->deleteRemovedImages($article, $existingImages);
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

            // Update article
            $article->update($data);

            // Clear cache
            $this->clearArticleCache($article->id);

            return $article;
        });
    }

    /**
     * Delete article
     */
    public function deleteArticle(Artikel $article): bool
    {
        return DB::transaction(function () use ($article) {
            // Delete thumbnail
            $this->deleteThumbnail($article);

            // Delete all images
            $this->deleteAllImages($article);

            // Delete article
            $deleted = $article->delete();

            // Clear cache
            $this->clearArticleCache($article->id);

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
        $path = 'artikel/thumbnails/' . $filename;

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
                $path = 'artikel/images/' . $filename;

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

    /**
     * Delete thumbnail
     */
    private function deleteThumbnail(Artikel $article): void
    {
        if ($article->thumbnail && Storage::disk('public')->exists($article->thumbnail)) {
            Storage::disk('public')->delete($article->thumbnail);
        }
    }

    /**
     * Delete all images
     */
    private function deleteAllImages(Artikel $article): void
    {
        if ($article->gambar && is_array($article->gambar)) {
            foreach ($article->gambar as $imagePath) {
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }
    }

    /**
     * Delete removed images
     */
    private function deleteRemovedImages(Artikel $article, array $keptImages): void
    {
        $currentImages = is_array($article->gambar) ? $article->gambar : [];
        $removedImages = array_diff($currentImages, $keptImages);

        foreach ($removedImages as $imagePath) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }

    /**
     * Clear article cache
     */
    private function clearArticleCache(?int $articleId = null): void
    {
        if ($articleId) {
            Cache::forget('article.' . $articleId);
        }

        // Clear paginated cache
        Cache::forget('article.all.15');
        Cache::forget('article.published.15');

        // Clear all paginated cache patterns
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget('article.all.' . $i);
            Cache::forget('article.published.' . $i);
        }

        // Clear widget cache
        Cache::forget('widget.latest_articles');
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
