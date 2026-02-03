<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BannerPromosi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class PromotionBannerController extends Controller
{
    public function index()
    {
        $bannerPromosi = BannerPromosi::first();
        return view('admin.pages.settings.promotion-banner', compact('bannerPromosi'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'banner_promosi' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);

            if (!$request->hasFile('banner_promosi')) {
                return response()->json([
                    'success' => false,
                    'message' => 'File banner promosi tidak ditemukan',
                ], 400);
            }

            $file = $request->file('banner_promosi');

            if (!$file->isValid()) {
                return response()->json([
                    'success' => false,
                    'message' => 'File banner promosi tidak valid (Error Code: ' . $file->getError() . ')',
                ], 400);
            }

            $realPath = $file->getRealPath();
            $fallbackPath = $_FILES['banner_promosi']['tmp_name'] ?? null;
            $sourcePath = $realPath ?: $fallbackPath;

            if (empty($sourcePath) || !file_exists($sourcePath)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memproses file: File sementara tidak ditemukan.',
                ], 400);
            }

            $banner = BannerPromosi::first();
            $oldPath = $banner ? $banner->path : null;

            $filename = uniqid('banner_promosi_') . '.' . $file->getClientOriginalExtension();

            $contents = file_get_contents($sourcePath);
            if ($contents === false) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal membaca file upload.',
                ], 500);
            }

            $path = 'banner-promosi/' . $filename;
            $stored = Storage::disk('public')->put($path, $contents);

            if (!$stored) {
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan file banner promosi',
                ], 500);
            }

            if ($banner) {
                $banner->update(['path' => $path]);
            } else {
                BannerPromosi::create(['path' => $path]);
            }

            $webPath = '/storage/' . $path;

            return response()->json([
                'success' => true,
                'message' => 'Banner promosi berhasil diperbarui',
                'path' => $webPath,
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all()),
            ], 422);
        } catch (\Exception $e) {
            Log::error('PROMOTION BANNER ERROR: ' . $e->getMessage());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
