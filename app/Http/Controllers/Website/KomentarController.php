<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Komentar;
use Illuminate\Http\Request;

class KomentarController extends Controller
{
    public function store(Request $request, string $type, int $id)
    {
        try {
            $allowedTypes = ['news', 'article', 'announcement', 'agenda', 'achievement'];
            if (!in_array($type, $allowedTypes, true)) {
                abort(404);
            }

            $validated = $request->validateWithBag('comment', [
                'nama' => 'required|string|max:100',
                'email' => 'required|email|max:120',
                'isi' => 'required|string|max:2000',
                'thread_id' => 'nullable|integer|exists:komentar,id',
                'parent_id' => 'nullable|integer|exists:komentar,id',
            ]);

            $parentId = $validated['parent_id'] ?? null;
            $threadId = $validated['thread_id'] ?? null;

            if ($parentId && !$threadId) {
                $parent = Komentar::find($parentId);
                $threadId = $parent?->thread_id;
            }

            $comment = Komentar::create([
                'konten_tipe' => $type,
                'konten_id' => $id,
                'nama' => $validated['nama'],
                'email' => $validated['email'],
                'isi' => $validated['isi'],
                'status' => 'pending',
                'tanggal' => now(),
                'thread_id' => $threadId,
                'parent_id' => $parentId,
            ]);

            if (!$comment->thread_id) {
                $comment->update(['thread_id' => $comment->id]);
            }

            $message = 'Pesan berhasil dikirim. Komentar menunggu persetujuan admin.';
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $message,
                ]);
            }

            return redirect()->back()->with('success', $message);
        } catch (\Illuminate\Validation\ValidationException $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => $e->validator->errors()->first(),
                    'errors' => $e->validator->errors(),
                ], 422);
            }
            throw $e;
        }
    }

    public function like(Request $request, $id)
    {
        try {
            $comment = Komentar::findOrFail($id);
            $liked = false;

            if (\Illuminate\Support\Facades\Auth::check()) {
                // --- ADMIN LOGIC ---
                $userId = \Illuminate\Support\Facades\Auth::id();
                
                $existingLike = \Illuminate\Support\Facades\DB::table('komentar_like')
                    ->where('komentar_id', $id)
                    ->where('user_id', $userId)
                    ->first();

                if ($existingLike) {
                    // Unlike
                    \Illuminate\Support\Facades\DB::table('komentar_like')
                        ->where('id', $existingLike->id)
                        ->delete();
                    $liked = false;
                } else {
                    // Like
                    \Illuminate\Support\Facades\DB::table('komentar_like')->insert([
                        'komentar_id' => $id,
                        'user_id' => $userId,
                    ]);
                    $liked = true;
                }
            } else {
                // --- GUEST LOGIC ---
                $sessionId = $request->session()->getId();
                $ip = $request->ip();
                $userAgent = $request->userAgent();
                
                // Unique identifier for device: Session ID + IP + User Agent
                $deviceIdentifier = hash('sha256', $sessionId . $ip . $userAgent);

                // Check if this device already liked this comment
                $existingLike = \Illuminate\Support\Facades\DB::table('komentar_like_publik')
                    ->where('komentar_id', $id)
                    ->where('device_id', $deviceIdentifier)
                    ->first();

                if ($existingLike) {
                    // Unlike
                    \Illuminate\Support\Facades\DB::table('komentar_like_publik')
                        ->where('id', $existingLike->id)
                        ->delete();
                    $liked = false;
                } else {
                    // Like
                    \Illuminate\Support\Facades\DB::table('komentar_like_publik')->insert([
                        'komentar_id' => $id,
                        'device_id' => $deviceIdentifier,
                        'ip_address' => $ip,
                        'user_agent' => $userAgent,
                    ]);
                    $liked = true;
                }
            }

            // Ambil total suka (Admin + Publik)
            // Refresh to ensure we get the latest counts
            $totalLikes = $comment->total_likes;

            return response()->json([
                'success' => true,
                'liked' => $liked,
                'count' => $totalLikes
            ]);

        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Terjadi kesalahan'], 500);
        }
    }
}
