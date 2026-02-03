<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Kontak;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class KontakController extends Controller
{
    public function index()
    {
        $kontak = Kontak::first();
        return view('admin.pages.settings.contact', compact('kontak'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'whatsapp' => ['nullable', 'string', 'max:20', 'regex:/^\d+$/'],
                'telepon' => ['nullable', 'string', 'max:20', 'regex:/^\d+$/'],
                'email' => 'nullable|email|max:255',
                'koordinat' => ['nullable', 'string', 'max:100', 'regex:/^-?\d+(?:\.\d+)?,\s*-?\d+(?:\.\d+)?$/'],
                'alamat' => 'nullable|string',
                'deskripsi' => 'nullable|string',
            ]);

            $data = [
                'whatsapp' => $request->input('whatsapp'),
                'telepon' => $request->input('telepon'),
                'email' => $request->input('email'),
                'koordinat' => $request->input('koordinat'),
                'alamat' => $request->input('alamat'),
                'deskripsi' => $request->input('deskripsi'),
            ];

            $kontak = Kontak::first();
            if ($kontak) {
                $kontak->update($data);
            } else {
                Kontak::create($data);
            }

            // Clear cache
            \Illuminate\Support\Facades\Cache::forget('global.kontak');

            return response()->json([
                'success' => true,
                'message' => 'Pengaturan kontak berhasil diperbarui!'
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all()),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Kontak Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage(),
            ], 500);
        }
    }
}
