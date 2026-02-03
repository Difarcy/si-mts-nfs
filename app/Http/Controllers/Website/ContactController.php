<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Pesan;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:35',
                'email' => 'required|email|max:30',
                'phone' => 'required|string|max:15',
                'subject' => 'required|string|max:255',
                'message' => 'required|string',
            ]);

            Pesan::create([
                'nama' => $validated['name'],
                'email' => $validated['email'],
                'telepon' => $validated['phone'],
                'subject' => $validated['subject'],
                'pesan' => $validated['message'],
                'tanggal' => now(),
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Pesan Anda telah berhasil dikirim!'
                ]);
            }

            return redirect()->back()->with('success', 'Pesan Anda telah berhasil dikirim!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }
            throw $e;
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
            throw $e;
        }
    }
}
