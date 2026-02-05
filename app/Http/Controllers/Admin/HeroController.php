<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Hero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;

class HeroController extends Controller
{
    public function index()
    {
        // Get hero data, or create default if not exists
        $hero = Hero::firstOrNew([], [
            'show_logo' => true,
            'show_tagline' => true,
            'show_judul' => true,
            'show_deskripsi' => true,
            'show_button' => true,
        ]);
        
        return view('admin.pages.settings.hero', compact('hero'));
    }

    public function update(Request $request)
    {
        try {
            $request->validate([
                'tagline' => 'nullable|string|max:255',
                'judul' => 'nullable|string|max:255',
                'deskripsi' => [
                    'nullable',
                    'string',
                    function ($attribute, $value, $fail) {
                        $v = trim((string) $value);
                        if ($v === '') {
                            return;
                        }

                        $lines = preg_split("/\r\n|\r|\n/", $v);
                        if (count($lines) > 3) {
                            $fail('Moto / Slogan maksimal 3 baris.');
                        }

                        $normalized = preg_replace('/\s+/', ' ', $v);
                        $sentences = preg_split('/[.!?]+/', $normalized, -1, PREG_SPLIT_NO_EMPTY);
                        $sentences = array_values(array_filter(array_map('trim', $sentences)));

                        if (count($sentences) > 2) {
                            $fail('Moto / Slogan maksimal 2 kalimat.');
                        }
                    },
                ],
                'button_text' => 'nullable|string|max:100',
                'button_url' => 'nullable|string|max:255',
            ]);

            // Checkboxes: if not present in request, it means unchecked (false)
            $data = [
                'tagline' => $request->input('tagline'),
                'judul' => $request->input('judul'),
                'deskripsi' => $request->input('deskripsi'),
                'button_text' => $request->input('button_text'),
                'button_url' => $request->input('button_url'),
                'show_logo' => $request->has('show_logo'),
                'show_tagline' => $request->has('show_tagline'),
                'show_judul' => $request->has('show_judul'),
                'show_deskripsi' => $request->has('show_deskripsi'),
                'show_button' => $request->has('show_button'),
            ];

            $hero = Hero::first();
            
            if ($hero) {
                $hero->update($data);
            } else {
                Hero::create($data);
            }

            return response()->json([
                'success' => true,
                'message' => 'Pengaturan Hero berhasil diperbarui!'
            ]);
        } catch (ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validasi gagal: ' . implode(', ', $e->validator->errors()->all()),
            ], 422);
        } catch (\Exception $e) {
            Log::error('Hero Update Error: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }
}
