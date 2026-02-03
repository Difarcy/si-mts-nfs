<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('urutan')->get();
        // Extract paths for the view
        $existingImages = $banners->pluck('path')->toArray();
        return view('admin.pages.settings.banner', compact('banners', 'existingImages'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('START: Banner Update Request');

            // 1. Validasi Input
            $request->validate([
                'banner' => 'nullable|array|max:6',
                'banner.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
                'banner_order' => 'nullable|string',
            ], [
                'banner.max' => 'Maksimal upload 6 gambar sekaligus.',
                'banner.*.image' => 'File harus berupa gambar.',
                'banner.*.mimes' => 'Format gambar harus jpeg, png, jpg, atau gif.',
                'banner.*.max' => 'Ukuran gambar maksimal 10MB.',
            ]);

            // 2. Tentukan gambar yang akan disimpan (Existing vs New)
            $existingImages = $request->input('banner_existing', []); // Array path lama
            $newFiles = $request->file('banner', []); // Array file baru
            $uploadedPaths = [];

            // 3. Proses Upload Gambar Baru (Manual Fallback Logic seperti Logo)
            foreach ($newFiles as $index => $file) {
                if (!$file->isValid()) continue;

                // Fallback check path
                $realPath = $file->getRealPath();
                $fallbackPath = $_FILES['banner']['tmp_name'][$index] ?? null;
                $sourcePath = $realPath ?: $fallbackPath;

                if (empty($sourcePath) || !file_exists($sourcePath)) {
                    Log::error("Source file not found for index $index");
                    continue;
                }

                $filename = uniqid('banner_') . '.' . $file->getClientOriginalExtension();
                
                try {
                    $contents = file_get_contents($sourcePath);
                    if ($contents !== false) {
                        $path = 'banners/' . $filename;
                        if (Storage::disk('public')->put($path, $contents)) {
                            $uploadedPaths[] = $path;
                        }
                    }
                } catch (\Exception $e) {
                    Log::error("Failed to store banner $index: " . $e->getMessage());
                }
            }

            // 4. Urutkan Gambar berdasarkan input hidden 'banner_order'
            // Format order: JSON array of strings like "existing:path/to/img.jpg" or "new:temp_id"
            // ATAU comma separated string jika JS mengirim format sederhana (tergantung implementasi frontend)
            
            $finalPaths = [];
            $orderInput = $request->input('banner_order');
            
            Log::info('Banner Order Input: ' . $orderInput);

            if (!empty($orderInput)) {
                // Coba decode sebagai JSON
                $order = json_decode($orderInput, true);
                
                // Jika gagal decode (bukan JSON valid), coba anggap sebagai comma separated string
                if (json_last_error() !== JSON_ERROR_NONE) {
                    $order = explode(',', $orderInput);
                }

                if (is_array($order)) {
                    $newImageIndex = 0;
                    foreach ($order as $item) {
                        $item = trim($item);
                        if (str_starts_with($item, 'existing:')) {
                            $path = substr($item, 9);
                            // Validasi path ada di existingImages
                            if (in_array($path, $existingImages)) {
                                $finalPaths[] = $path;
                            }
                        } elseif (str_starts_with($item, 'new:')) {
                            if (isset($uploadedPaths[$newImageIndex])) {
                                $finalPaths[] = $uploadedPaths[$newImageIndex];
                                $newImageIndex++;
                            }
                        }
                    }
                    // Append sisa gambar baru jika ada yang terlewat (safety net)
                    while (isset($uploadedPaths[$newImageIndex])) {
                        $finalPaths[] = $uploadedPaths[$newImageIndex];
                        $newImageIndex++;
                    }
                } else {
                    // Fallback jika format tidak dikenali
                    $finalPaths = array_merge($existingImages, $uploadedPaths);
                }
            } else {
                // Fallback jika tidak ada order input
                // Urutan: Existing dulu, lalu New
                $finalPaths = array_merge($existingImages, $uploadedPaths);
            }

            // 5. Validasi Total Gambar (Max 6)
            if (count($finalPaths) > 6) {
                return response()->json([
                    'success' => false,
                    'message' => 'Total gambar banner tidak boleh lebih dari 6.'
                ], 422);
            }

            // 6. Sinkronisasi Database
            DB::transaction(function () use ($finalPaths) {
                // Hapus banner yang tidak ada di finalPaths
                $currentBanners = Banner::pluck('path')->toArray();
                $toDelete = array_diff($currentBanners, $finalPaths);

                // Hapus file fisik
                foreach ($toDelete as $path) {
                    if (Storage::disk('public')->exists($path)) {
                        Storage::disk('public')->delete($path);
                    }
                }
                
                // Hapus data DB
                Banner::whereIn('path', $toDelete)->delete();

                // Update/Create data baru dengan urutan
                foreach ($finalPaths as $index => $path) {
                    Banner::updateOrCreate(
                        ['path' => $path],
                        ['urutan' => $index + 1, 'is_active' => true]
                    );
                }
            });

            return response()->json([
                'success' => true,
                'message' => 'Banner berhasil diperbarui',
                'redirect' => route('admin.pengaturan.banner.index')
            ]);

        } catch (\Exception $e) {
            Log::error('Banner Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
