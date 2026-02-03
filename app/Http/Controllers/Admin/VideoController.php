<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Video;
use Illuminate\Http\Request;
use App\Services\VideoService;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Schema;

class VideoController extends Controller
{
    protected $videoService;

    public function __construct(VideoService $videoService)
    {
        $this->videoService = $videoService;
    }

    /**
     * Tampilkan halaman daftar video
     */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'status', 'sort']);
        $filters['sort'] = $filters['sort'] ?? 'latest';

        if (!Schema::hasTable('video')) {
            $videos = new LengthAwarePaginator([], 0, 15, 1, [
                'path' => $request->url(),
                'query' => $request->query(),
            ]);
        } else {
            $videos = $this->videoService->getAdminVideos($filters, 15)->withQueryString();
        }

        if ($request->ajax()) {
            return view('admin.partials.media.video.ajax', compact('videos'));
        }

        return view('admin.pages.media.video.index', compact('videos', 'filters'));
    }

    /**
     * Tampilkan halaman tambah video
     */
    public function create()
    {
        return view('admin.pages.media.video.create');
    }

    /**
     * Tampilkan halaman edit video
     */
    public function edit($id)
    {
        $video = Video::findOrFail($id);

        return view('admin.pages.media.video.edit', compact('video'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'youtube_url' => 'required|string|max:2048',
                'description' => 'nullable|string',
                'status' => 'required|in:publish,draft',
            ]);

            $tanggalPublikasi = null;
            if ($validated['status'] === 'publish') {
                $tanggalPublikasi = now();
            }

            Video::create([
                'judul' => $validated['title'],
                'link' => $validated['youtube_url'],
                'deskripsi' => $validated['description'] ?? null,
                'status' => $validated['status'],
                'tanggal_publikasi' => $tanggalPublikasi,
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => $validated['status'] === 'publish'
                        ? 'Video berhasil diterbitkan!'
                        : 'Video berhasil disimpan sebagai draft!'
                ]);
            }

            return redirect()
                ->route('admin.media.video.index')
                ->with('success', $validated['status'] === 'publish'
                    ? 'Video berhasil diterbitkan!'
                    : 'Video berhasil disimpan sebagai draft!');
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

    public function update(Request $request, $id)
    {
        try {
            $video = Video::findOrFail($id);

            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'youtube_url' => 'required|string|max:2048',
                'description' => 'nullable|string',
                'status' => 'required|in:publish,draft,nonaktif',
            ]);

            $tanggalPublikasi = $video->tanggal_publikasi;
            if ($validated['status'] === 'publish' && !$tanggalPublikasi) {
                $tanggalPublikasi = now();
            }
            if ($validated['status'] !== 'publish') {
                $tanggalPublikasi = null;
            }

            $video->update([
                'judul' => $validated['title'],
                'link' => $validated['youtube_url'],
                'deskripsi' => $validated['description'] ?? null,
                'status' => $validated['status'],
                'tanggal_publikasi' => $tanggalPublikasi,
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Video berhasil diperbarui!'
                ]);
            }

            return redirect()
                ->route('admin.media.video.edit', $video->id)
                ->with('success', 'Video berhasil diperbarui!');

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

    public function destroy($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return response()->json([
            'success' => true,
            'message' => 'Video berhasil dihapus!',
        ]);
    }
}
