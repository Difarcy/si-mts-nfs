<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MediaSosial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MediaSosialController extends Controller
{
    public function index()
    {
        $mediaSosial = MediaSosial::first();
        return view('admin.pages.settings.social-media', compact('mediaSosial'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'facebook' => 'nullable|url|max:255',
                'instagram' => 'nullable|url|max:255',
                'youtube' => 'nullable|url|max:255',
                'x' => 'nullable|url|max:255',
                'tiktok' => 'nullable|url|max:255',
            ]);

            $data = [
                'facebook' => $request->input('facebook'),
                'instagram' => $request->input('instagram'),
                'youtube' => $request->input('youtube'),
                'x' => $request->input('x'),
                'tiktok' => $request->input('tiktok'),
            ];

            $mediaSosial = MediaSosial::first();
            if ($mediaSosial) {
                $mediaSosial->update($data);
            } else {
                MediaSosial::create($data);
            }

            // Clear cache
            \Illuminate\Support\Facades\Cache::forget('global.social_media');

            return response()->json([
                'success' => true,
                'message' => 'Media sosial berhasil diperbarui!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all()),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Media Sosial Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}

