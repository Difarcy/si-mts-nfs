<?php

namespace App\Services;

use App\Models\Photo;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PhotoService
{
    public function getAdminPhotos($filters = [], $perPage = 15)
    {
        $query = Photo::query();
        $query->orderBy('urutan', 'asc')
            ->orderBy('tanggal_publikasi', 'desc')
            ->orderBy('id', 'desc');

        return $query->paginate($perPage);
    }

    public function createPhotos(array $data)
    {
        $photos = [];
        $images = $data['images'] ?? [];

        // Ensure it's an array for iteration
        if (!is_array($images)) {
            $images = $images ? [$images] : [];
        }

        $tanggal_publikasi = $data['tanggal_publikasi'] ?? now();
        $nextOrder = (int) (Photo::max('urutan') ?? 0);

        foreach ($images as $image) {
            // Log for debugging
            if (!($image instanceof \Illuminate\Http\UploadedFile)) {
                \Log::warning('PhotoService: Object is not an instance of UploadedFile');
                continue;
            }

            if (!$image->isValid()) {
                \Log::error('PhotoService: Uploaded file is not valid', [
                    'name' => $image->getClientOriginalName(),
                    'error' => $image->getErrorMessage()
                ]);
                continue;
            }

            $stream = null;

            try {
                $fileName = $image->hashName();
                $path = 'media/foto/'.$fileName;

                $sourcePath = $image->getPathname();
                if (!$sourcePath) {
                    throw new \RuntimeException('Uploaded file temporary path is empty.');
                }

                $stream = fopen($sourcePath, 'r');
                if (!is_resource($stream)) {
                    throw new \RuntimeException('Failed to open uploaded file stream.');
                }

                $stored = Storage::disk('public')->put($path, $stream);
                if (!$stored) {
                    throw new \RuntimeException('Failed to store uploaded file.');
                }

                $nextOrder++;

                $photos[] = Photo::create([
                    'gambar' => $path,
                    'tanggal_publikasi' => $tanggal_publikasi,
                    'urutan' => $nextOrder,
                ]);
            } catch (\Throwable $e) {
                \Log::error('PhotoService: Failed to store or create photo record', [
                    'name' => $image->getClientOriginalName(),
                    'message' => $e->getMessage(),
                ]);
            } finally {
                if (is_resource($stream)) {
                    fclose($stream);
                }
            }
        }

        return $photos;
    }

    public function deletePhoto($id)
    {
        $photo = Photo::findOrFail($id);
        if ($photo->gambar) {
            Storage::disk('public')->delete($photo->gambar);
        }
        return $photo->delete();
    }

    public function updateOrder(array $ids): bool
    {
        try {
            $ids = array_values(array_unique(array_map('intval', $ids)));
            if (count($ids) === 0) {
                return true;
            }

            $cases = [];
            $bindings = [];

            foreach ($ids as $index => $id) {
                $cases[] = 'when ? then ?';
                $bindings[] = $id;
                $bindings[] = $index;
            }

            $inPlaceholders = implode(',', array_fill(0, count($ids), '?'));
            $bindings = array_merge($bindings, $ids);

            DB::transaction(function () use ($cases, $bindings, $inPlaceholders) {
                $caseSql = implode(' ', $cases);
                DB::update(
                    "update `foto` set `urutan` = case `id` {$caseSql} end where `id` in ({$inPlaceholders})",
                    $bindings
                );
            });

            return true;
        } catch (\Exception $e) {
            \Log::error('PhotoService: Failed to update photo order', ['message' => $e->getMessage()]);
            return false;
        }
    }
}
