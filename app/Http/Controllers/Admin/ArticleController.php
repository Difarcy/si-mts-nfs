<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artikel;
use App\Services\ArticleService;
use Illuminate\Http\Request;

/**
 * ArticleController
 * 
 * Mengelola fitur Artikel di halaman Admin.
 * Menangani CRUD (Create, Read, Update, Delete) serta validasi input
 * untuk artikel, termasuk upload gambar dan status publikasi.
 */
class ArticleController extends Controller
{
    protected ArticleService $articleService;

    public function __construct(ArticleService $articleService)
    {
        $this->articleService = $articleService;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search', ''),
            'status' => $request->query('status', ''),
            'sort' => $request->query('sort', 'latest'),
        ];

        $artikel = $this->articleService
            ->getAdminArticles($filters, 15)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->view('admin.partials.content.article.ajax', compact('artikel'));
        }

        return view('admin.pages.content.article.index', compact('artikel', 'filters'));
    }

    public function create()
    {
        $defaultAuthor = auth()->user()->nama;
        return view('admin.pages.content.article.create', compact('defaultAuthor'));
    }

    public function edit($id)
    {
        $artikel = $this->articleService->getArticleById($id);

        if ($artikel->tanggal_publikasi && now()->lt($artikel->tanggal_publikasi)) {
            return redirect()->route('admin.konten.artikel.index');
        }

        $tags = $artikel->tags
            ? array_values(array_filter(array_map('trim', explode(',', $artikel->tags))))
            : [];

        $thumbnailUrl = $artikel->thumbnail ? asset('storage/' . $artikel->thumbnail) : null;
        $imagePaths = is_array($artikel->gambar)
            ? array_values(array_filter(array_map('trim', $artikel->gambar)))
            : [];

        return view('admin.pages.content.article.edit', compact('artikel', 'tags', 'thumbnailUrl', 'imagePaths'));
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
            $data = $this->prepareArticleData($request, $status);

            // Validate draft content
            if ($status === 'draft' && !$this->articleService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            // Create article
            $this->articleService->createArticle($data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Artikel berhasil disimpan sebagai draft!'
                    : 'Artikel berhasil diterbitkan!'
            ]);

        } catch (\Exception $e) {
            \Log::error('ERROR FATAL SIMPAN ARTIKEL: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $artikel = $this->articleService->getArticleById($id);

        if ($artikel->tanggal_publikasi && now()->lt($artikel->tanggal_publikasi)) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak bisa diubah sebelum waktu publish.'
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
            if (!$artikel->thumbnail || $thumbnailWillBeRemoved) {
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
            $data = $this->prepareArticleData($request, $status, $artikel);

            // Validate draft content
            if ($status === 'draft' && !$this->articleService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            // Update article
            $this->articleService->updateArticle($artikel, $data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Draft berhasil disimpan!'
                    : 'Artikel berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR UPDATE ARTIKEL: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $artikel = $this->articleService->getArticleById($id);
            $this->articleService->deleteArticle($artikel);

            return response()->json([
                'success' => true,
                'message' => 'Artikel berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR HAPUS ARTIKEL: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus artikel: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Prepare article data from request
     */
    private function prepareArticleData(Request $request, string $status, ?Artikel $article = null): array
    {
        $rawJudul = trim((string) $request->input('title', ''));
        $rawPenulis = trim((string) $request->input('author', ''));
        $rawTags = trim((string) $request->input('tags', ''));

        $judul = $rawJudul;
        $deskripsi = (string) $request->input('content', '');
        // Jika input author kosong, pakai nama user login.
        $penulis = $rawPenulis !== '' ? $rawPenulis : auth()->user()->nama;

        if ($status === 'draft' && $judul === '') {
            $judul = $this->articleService->generateDraftTitle();
        }

        if ($status === 'draft' && trim(strip_tags($deskripsi)) === '') {
            $deskripsi = $this->articleService->generateDraftDescription();
        }

        $data = [
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'status' => $status,
            'penulis' => $penulis,
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

        // Always capture existing images
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
