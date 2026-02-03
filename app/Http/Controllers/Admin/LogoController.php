<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LogoController extends Controller
{
    public function index()
    {
        $logo = Logo::first();
        return view('admin.pages.settings.logo', compact('logo'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('START: Logo Upload Request');

            $request->validate([
                'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);

            if (!$request->hasFile('logo')) {
                Log::error('No file logo in request');
                return back()->with('error', 'File logo tidak ditemukan');
            }

            $file = $request->file('logo');
            Log::info('File detected: ' . $file->getClientOriginalName());
            
            // Debugging path issues
            $realPath = $file->getRealPath();
            Log::info('File real path: ' . ($realPath ?: 'EMPTY'));
            
            // Check global $_FILES as fallback
            $fallbackPath = $_FILES['logo']['tmp_name'] ?? null;
            Log::info('Global $_FILES tmp_name: ' . ($fallbackPath ?: 'EMPTY'));

            if (!$file->isValid()) {
                Log::error('File is not valid. Error code: ' . $file->getError());
                return response()->json([
                    'success' => false,
                    'message' => 'File logo tidak valid (Error Code: ' . $file->getError() . ')'
                ], 400);
            }

            // Determine valid source path
            $sourcePath = $realPath ?: $fallbackPath;

            if (empty($sourcePath) || !file_exists($sourcePath)) {
                Log::error('Source file not found at path: ' . ($sourcePath ?: 'EMPTY'));
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal memproses file: File sementara tidak ditemukan.'
                ], 400);
            }

            // Simpan path lama
            $logo = Logo::first();
            $oldPath = $logo ? $logo->path : null;

            // MANUAL GENERATE FILENAME & PATH
            $filename = uniqid('logo_') . '.' . $file->getClientOriginalExtension();
            
            // Try to store using Storage facade directly with stream if standard storeAs fails
            try {
                // Option 1: Standard storeAs (might fail if realPath is empty in object)
                // $path = $file->storeAs('logos', $filename, 'public');
                
                // Option 2: Manual Storage::put with file contents (more robust for temp path issues)
                $contents = file_get_contents($sourcePath);
                if ($contents === false) {
                    throw new \Exception("Failed to read source file");
                }
                
                $path = 'logos/' . $filename;
                $stored = Storage::disk('public')->put($path, $contents);
                
                if (!$stored) {
                    throw new \Exception("Storage::put returned false");
                }
                
                Log::info('New path stored: ' . $path);
            } catch (\Exception $e) {
                Log::error('Storage error: ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan file ke storage: ' . $e->getMessage()
                ], 500);
            }

            if (!$path || empty(trim($path))) {
                Log::error('Failed to store file, path is empty');
                return response()->json([
                    'success' => false,
                    'message' => 'Gagal menyimpan file logo'
                ], 500);
            }

            // Update Database
            if ($logo) {
                $logo->update(['path' => $path]);
            } else {
                Logo::create(['path' => $path]);
            }
            
            // Clear cache
            \Illuminate\Support\Facades\Cache::forget('global.logo');
            
            Log::info('Database updated with path: ' . $path);

            // SKIP OLD FILE DELETION FOR NOW - ISOLATE THE PROBLEM
            // if ($oldPath && !empty(trim($oldPath)) && !str_contains($oldPath, 'images/logo/logo.png')) {
            //     try {
            //         Storage::disk('public')->delete($oldPath);
            //     } catch (\Exception $e) {
            //         Log::warning('Delete old file failed: ' . $e->getMessage());
            //     }
            // }

            Log::info('Sending success response');

            $webPath = '/storage/' . $path;

            return response()->json([
                'success' => true,
                'message' => 'Logo berhasil diperbarui',
                'path' => $webPath
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation Error: ' . implode(', ', $e->validator->errors()->all()));
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all())
            ], 422);
        } catch (\Exception $e) {
            Log::error('CRITICAL LOGO ERROR: ' . $e->getMessage());
            Log::error($e->getTraceAsString());

            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
