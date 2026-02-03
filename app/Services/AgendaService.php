<?php

namespace App\Services;

use App\Models\Agenda;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;

class AgendaService
{
    private const CACHE_TTL = 3600; // 1 jam

    public function getAdminAgendas(array $filters = [], int $perPage = 15)
    {
        $query = Agenda::query();

        $search = isset($filters['search']) ? trim((string) $filters['search']) : '';
        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $like = '%' . $search . '%';
                $q->where('judul', 'like', $like)
                    ->orWhere('deskripsi', 'like', $like)
                    ->orWhere('penulis', 'like', $like)
                    ->orWhere('lokasi', 'like', $like)
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

    public function getAgendaById(int $id): Agenda
    {
        return Cache::remember('agenda.' . $id, self::CACHE_TTL, function () use ($id) {
            return Agenda::findOrFail($id);
        });
    }

    public function createAgenda(array $data): Agenda
    {
        return DB::transaction(function () use ($data) {
            // Handle multiple images upload
            $finalImages = [];
            if (isset($data['images']) && is_array($data['images'])) {
                $uploadedPaths = $this->handleMultipleImageUpload($data['images']);
                $finalImages = $uploadedPaths;
            }
            $data['gambar'] = $finalImages;

            if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {
                $data['lampiran'] = $this->handleAttachmentUpload($data['attachment']);
                unset($data['attachment']);
            }

            $data['tags'] = $this->processTags($data['tags'] ?? null);

            $agenda = Agenda::create($data);

            $this->clearAgendaCache();

            return $agenda;
        });
    }

    public function updateAgenda(Agenda $agenda, array $data): Agenda
    {
        return DB::transaction(function () use ($agenda, $data) {
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

                        $this->deleteRemovedImages($agenda, $existingImages);

                    } else {
                        $this->deleteRemovedImages($agenda, $existingImages);
                        $finalImages = array_merge($existingImages, $uploadedPaths);
                    }
                } else {
                    $this->deleteRemovedImages($agenda, $existingImages);
                    $finalImages = array_merge($existingImages, $uploadedPaths);
                }

                $data['gambar'] = $finalImages;
            }

            if (isset($data['attachment']) && $data['attachment'] instanceof UploadedFile) {
                $this->deleteAttachment($agenda);
                $data['lampiran'] = $this->handleAttachmentUpload($data['attachment']);
                unset($data['attachment']);
            }

            if (array_key_exists('tags', $data)) {
                $data['tags'] = $this->processTags($data['tags']);
            }

            $agenda->update($data);

            $this->clearAgendaCache($agenda->id);

            return $agenda;
        });
    }

    public function deleteAgenda(Agenda $agenda): bool
    {
        return DB::transaction(function () use ($agenda) {
            $this->deleteAllImages($agenda);
            $this->deleteAttachment($agenda);

            $deleted = $agenda->delete();

            $this->clearAgendaCache($agenda->id);

            return $deleted;
        });
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
                $path = 'agenda/images/' . $filename;

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
        $path = 'agenda/files/' . $filename;

        if (!$file->isValid()) {
            throw new \Exception('File upload failed or invalid file.');
        }

        Storage::disk('public')->put($path, file_get_contents($file->getPathname()));

        return $path;
    }

    private function deleteAllImages(Agenda $agenda): void
    {
        if ($agenda->gambar && is_array($agenda->gambar)) {
            foreach ($agenda->gambar as $imagePath) {
                if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                    Storage::disk('public')->delete($imagePath);
                }
            }
        }
    }

    private function deleteRemovedImages(Agenda $agenda, array $keptImages): void
    {
        $currentImages = is_array($agenda->gambar) ? $agenda->gambar : [];
        $removedImages = array_diff($currentImages, $keptImages);

        foreach ($removedImages as $imagePath) {
            if ($imagePath && Storage::disk('public')->exists($imagePath)) {
                Storage::disk('public')->delete($imagePath);
            }
        }
    }

    private function deleteAttachment(Agenda $agenda): void
    {
        if ($agenda->lampiran && Storage::disk('public')->exists($agenda->lampiran)) {
            Storage::disk('public')->delete($agenda->lampiran);
        }
    }

    private function clearAgendaCache(?int $id = null): void
    {
        if ($id) {
            Cache::forget('agenda.' . $id);
        }

        Cache::forget('agenda.all.15');
        for ($i = 1; $i <= 20; $i++) {
            Cache::forget('agenda.all.' . $i);
        }

        // Clear widget cache
        Cache::forget('widget.latest_agendas');
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
        $rawJudul = trim((string) ($data['judul'] ?? ''));
        $rawDeskripsiText = trim(strip_tags((string) ($data['deskripsi'] ?? '')));
        $rawPenulis = trim((string) ($data['penulis'] ?? ''));
        $hasNewMedia = isset($data['image']);

        return !($rawJudul === '' && $rawDeskripsiText === '' && $rawPenulis === '' && !$hasNewMedia);
    }
}
