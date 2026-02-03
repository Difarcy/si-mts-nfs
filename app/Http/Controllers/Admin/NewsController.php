<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use App\Services\NewsService;
use Illuminate\Http\Request;

/**
 * NewsController
 * 
 * Mengelola fitur Berita di halaman Admin.
 * Menangani CRUD (Create, Read, Update, Delete) serta validasi input
 * untuk berita, termasuk upload gambar dan status publikasi.
 */
class NewsController extends Controller
{
    protected NewsService $newsService;

    public function __construct(NewsService $newsService)
    {
        $this->newsService = $newsService;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search', ''),
            'status' => $request->query('status', ''),
            'sort' => $request->query('sort', 'latest'),
        ];

        $berita = $this->newsService
            ->getAdminNews($filters, 15)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->view('admin.partials.content.news.ajax', compact('berita'));
        }

        return view('admin.pages.content.news.index', compact('berita', 'filters'));
    }

    public function create()
    {
        $defaultAuthor = auth()->user()->nama;
        return view('admin.pages.content.news.create', compact('defaultAuthor'));
    }

    public function edit($id)
    {
        $berita = $this->newsService->getNewsById($id);

        if ($berita->tanggal_publikasi && now()->lt($berita->tanggal_publikasi)) {
            return redirect()->route('admin.konten.berita.index');
        }

        $tags = $berita->tags
            ? array_values(array_filter(array_map('trim', explode(',', $berita->tags))))
            : [];

        $thumbnailUrl = $berita->thumbnail ? asset('storage/' . $berita->thumbnail) : null;
        $imagePaths = is_array($berita->gambar)
            ? array_values(array_filter(array_map('trim', $berita->gambar)))
            : [];

        return view('admin.pages.content.news.edit', compact('berita', 'tags', 'thumbnailUrl', 'imagePaths'));
    }

    public function store(Request $request)
    {
        $status = $request->input('status', 'draft');

        $rules = [
            'status' => 'required|in:publish,draft,nonaktif',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'image' => 'nullable|array|max:6',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:10240',
        ];

        if ($status === 'draft') {
            $rules['title'] = 'nullable|string|max:255';
            $rules['content'] = 'nullable';
            $rules['author'] = 'nullable|string|max:100';
        } else {
            $rules['title'] = 'required|string|max:255';
            $rules['content'] = 'required';
            $rules['author'] = 'required|string|max:100';
            $rules['thumbnail'] = 'required|image|mimes:jpeg,png,jpg|max:10240';
        }

        $request->validate($rules, [
            'image.max' => 'Maksimal upload adalah 6 gambar sekaligus.',
        ]);

        // Validasi tambahan: Foto harus genap jika > 1, max 6
        $newCount = $request->hasFile('image') ? count($request->file('image')) : 0;
        if ($newCount > 6) {
            return response()->json([
                'success' => false,
                'message' => 'Total gambar tidak boleh lebih dari 6.'
            ], 422);
        }
        if ($newCount > 1 && $newCount % 2 !== 0) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah gambar harus genap (2, 4, atau 6). Jika hanya 1 gambar diperbolehkan.'
            ], 422);
        }

        try {
            // Prepare data for service
            $data = $this->prepareNewsData($request, $status);

            // Validate draft content
            if ($status === 'draft' && !$this->newsService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            // Create news
            $this->newsService->createNews($data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Berita berhasil disimpan sebagai draft!'
                    : 'Berita berhasil diterbitkan!'
            ]);

        } catch (\Exception $e) {
            \Log::error('ERROR FATAL SIMPAN BERITA: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $berita = $this->newsService->getNewsById($id);

        if ($berita->tanggal_publikasi && now()->lt($berita->tanggal_publikasi)) {
            return response()->json([
                'success' => false,
                'message' => 'Berita tidak bisa diubah sebelum waktu publish.'
            ], 403);
        }

        $status = $request->input('status', 'draft');

        $rules = [
            'status' => 'required|in:publish,draft,nonaktif',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'image' => 'nullable|array|max:6',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:10240',
        ];

        if ($status === 'draft') {
            $rules['title'] = 'nullable|string|max:255';
            $rules['content'] = 'nullable';
            $rules['author'] = 'nullable|string|max:100';
        } else {
            $rules['title'] = 'required|string|max:255';
            $rules['content'] = 'required';
            $rules['author'] = 'required|string|max:100';
            $thumbnailWillBeRemoved = $request->input('thumbnail_remove') === '1' && !$request->hasFile('thumbnail');
            if (!$berita->thumbnail || $thumbnailWillBeRemoved) {
                $rules['thumbnail'] = 'required|image|mimes:jpeg,png,jpg|max:10240';
            }
        }

        $request->validate($rules, [
            'image.max' => 'Maksimal file baru yang diunggah adalah 6 gambar.',
        ]);

        // Validasi tambahan: Total gambar (Existing + Baru) tidak boleh > 6
        $existingCount = count($request->input('image_existing', []));
        $newCount = $request->hasFile('image') ? count($request->file('image')) : 0;
        $totalCount = $existingCount + $newCount;

        if ($totalCount > 6) {
            return response()->json([
                'success' => false,
                'message' => 'Total gambar tidak boleh lebih dari 6. Saat ini ada ' . $existingCount . ' gambar tetap dan Anda mencoba menambah ' . $newCount . ' gambar lagi.'
            ], 422);
        }

        if ($totalCount > 1 && $totalCount % 2 !== 0) {
            return response()->json([
                'success' => false,
                'message' => 'Jumlah gambar (Lama + Baru) harus genap (2, 4, atau 6). Saat ini totalnya ' . $totalCount . ' gambar. Silakan kurangi atau tambah gambar.'
            ], 422);
        }

        try {
            // Prepare data for service
            $data = $this->prepareNewsData($request, $status, $berita);

            // Validate draft content
            if ($status === 'draft' && !$this->newsService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            // Update news
            $this->newsService->updateNews($berita, $data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Draft berhasil disimpan!'
                    : 'Berita berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR UPDATE BERITA: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $berita = $this->newsService->getNewsById($id);
            $this->newsService->deleteNews($berita);

            return response()->json([
                'success' => true,
                'message' => 'Berita berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR HAPUS BERITA: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus berita: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Prepare news data from request
     */
    private function prepareNewsData(Request $request, string $status, ?Berita $news = null): array
    {
        $rawJudul = trim((string) $request->input('title', ''));
        $rawPenulis = trim((string) $request->input('author', ''));
        $rawTags = trim((string) $request->input('tags', ''));

        $judul = $rawJudul;
        $deskripsi = (string) $request->input('content', '');
        $penulis = $rawPenulis !== '' ? $rawPenulis : auth()->user()->nama;

        if ($status === 'draft' && $judul === '') {
            $judul = $this->newsService->generateDraftTitle();
        }

        if ($status === 'draft' && trim(strip_tags($deskripsi)) === '') {
            $deskripsi = $this->newsService->generateDraftDescription();
        }

        $data = [
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'status' => $status,
            'penulis' => $penulis,
            'is_highlight' => $request->has('is_highlight'),
            'tags' => $rawTags,
        ];

        if ($status === 'publish') {
            if ($request->has('is_scheduled') && $request->filled('published_date')) {
                $time = $request->input('published_time') ?: '00:00';
                $data['tanggal_publikasi'] = $request->input('published_date') . ' ' . $time;
            } else {
                $data['tanggal_publikasi'] = now();
            }
        } else {
            $data['tanggal_publikasi'] = null;
        }

        // Handle file uploads
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail');
        }

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $data['images'] = is_array($files) ? $files : [$files];
        }

        // Always capture existing images to handle deletions correctly
        $data['existing_images'] = $request->input('image_existing', []);

        // Capture image order if present
        if ($request->has('image_order')) {
            $data['image_order'] = $request->input('image_order');
        }

        if ($request->has('thumbnail_remove')) {
            $data['thumbnail_remove'] = $request->input('thumbnail_remove');
        }

        return $data;
    }
}
