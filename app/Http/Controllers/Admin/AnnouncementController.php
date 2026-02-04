<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengumuman;
use App\Services\AnnouncementService;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    protected AnnouncementService $announcementService;

    public function __construct(AnnouncementService $announcementService)
    {
        $this->announcementService = $announcementService;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search', ''),
            'status' => $request->query('status', ''),
            'sort' => $request->query('sort', 'latest'),
        ];

        $pengumuman = $this->announcementService
            ->getAdminAnnouncements($filters, 10)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->view('admin.partials.content.announcement.ajax', compact('pengumuman'));
        }

        return view('admin.pages.content.announcement.index', compact('pengumuman', 'filters'));
    }

    public function create()
    {
        $defaultAuthor = auth()->user()->nama;
        return view('admin.pages.content.announcement.create', compact('defaultAuthor'));
    }

    public function store(Request $request)
    {
        $status = $request->input('status', 'draft');

        $rules = [
            'status' => 'required|in:publish,draft,nonaktif',
            'tags' => 'nullable|string',
            'image' => 'nullable|array|max:6',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:10240',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ];

        if ($status === 'draft') {
            $rules['title'] = 'nullable|string|max:255';
            $rules['content'] = 'nullable';
            $rules['author'] = 'nullable|string|max:100';
        } else {
            $rules['title'] = 'required|string|max:255';
            $rules['content'] = 'required';
            $rules['author'] = 'required|string|max:100';
        }

        $request->validate($rules, [
            'image.max' => 'Maksimal upload adalah 6 gambar sekaligus.',
            'title.required' => 'Judul pengumuman wajib diisi.',
            'content.required' => 'Isi pengumuman wajib diisi.',
            'author.required' => 'Penulis pengumuman wajib diisi.',
            'image.*.image' => 'File galeri harus berupa gambar.',
            'image.*.mimes' => 'Format gambar galeri harus jpeg, png, atau jpg.',
            'image.*.max' => 'Ukuran gambar galeri maksimal 10MB.',
            'attachment.mimes' => 'Format lampiran harus PDF, Word, Excel, atau PowerPoint.',
            'attachment.max' => 'Ukuran lampiran maksimal 10MB.',
            'status.in' => 'Status yang dipilih tidak valid.',
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
            $data = $this->prepareAnnouncementData($request, $status);

            if ($status === 'draft' && !$this->announcementService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            $this->announcementService->createAnnouncement($data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Pengumuman berhasil disimpan sebagai draft!'
                    : 'Pengumuman berhasil diterbitkan!'
            ]);

        } catch (\Exception $e) {
            \Log::error('ERROR FATAL SIMPAN PENGUMUMAN: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $pengumuman = $this->announcementService->getAnnouncementById($id);

        $tags = $pengumuman->tags
            ? array_values(array_filter(array_map('trim', explode(',', (string) $pengumuman->tags))))
            : [];

        $imagePaths = is_array($pengumuman->gambar)
            ? array_values(array_filter(array_map('trim', $pengumuman->gambar)))
            : [];

        $attachmentUrl = $pengumuman->lampiran ? asset('storage/' . $pengumuman->lampiran) : null;
        $attachmentName = $pengumuman->lampiran ? basename($pengumuman->lampiran) : null;

        return view('admin.pages.content.announcement.edit', compact('pengumuman', 'tags', 'imagePaths', 'attachmentUrl', 'attachmentName'));
    }

    public function update(Request $request, $id)
    {
        $pengumuman = $this->announcementService->getAnnouncementById($id);

        $status = $request->input('status', 'draft');

        $rules = [
            'status' => 'required|in:publish,draft,nonaktif',
            'tags' => 'nullable|string',
            'image' => 'nullable|array|max:6',
            'image.*' => 'image|mimes:jpeg,png,jpg|max:10240',
            'attachment' => 'nullable|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx|max:10240',
        ];

        if ($status === 'draft') {
            $rules['title'] = 'nullable|string|max:255';
            $rules['content'] = 'nullable';
            // Author tidak perlu divalidasi dari input karena diambil otomatis dari Auth
        } else {
            $rules['title'] = 'required|string|max:255';
            $rules['content'] = 'required';
            // Author tidak perlu divalidasi dari input
        }

        $request->validate($rules, [
            'image.max' => 'Maksimal file baru yang diunggah adalah 6 gambar.',
            'title.required' => 'Judul pengumuman wajib diisi.',
            'content.required' => 'Isi pengumuman wajib diisi.',
            'author.required' => 'Penulis pengumuman wajib diisi.',
            'image.*.image' => 'File galeri harus berupa gambar.',
            'image.*.mimes' => 'Format gambar galeri harus jpeg, png, atau jpg.',
            'image.*.max' => 'Ukuran gambar galeri maksimal 10MB.',
            'attachment.mimes' => 'Format lampiran harus PDF, Word, Excel, atau PowerPoint.',
            'attachment.max' => 'Ukuran lampiran maksimal 10MB.',
            'status.in' => 'Status yang dipilih tidak valid.',
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
            $data = $this->prepareAnnouncementData($request, $status);

            if ($status === 'draft' && !$this->announcementService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            $this->announcementService->updateAnnouncement($pengumuman, $data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Draft berhasil disimpan!'
                    : 'Pengumuman berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR UPDATE PENGUMUMAN: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $pengumuman = $this->announcementService->getAnnouncementById($id);
            $this->announcementService->deleteAnnouncement($pengumuman);

            return response()->json([
                'success' => true,
                'message' => 'Pengumuman berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR HAPUS PENGUMUMAN: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus pengumuman: ' . $e->getMessage()
            ], 500);
        }
    }

    private function prepareAnnouncementData(Request $request, string $status): array
    {
        $rawJudul = trim((string) $request->input('title', ''));
        $rawPenulis = trim((string) $request->input('author', ''));

        // Jika input author kosong, pakai nama user login. Jika ada isi, pakai isi tersebut.
        $penulis = $rawPenulis !== '' ? $rawPenulis : auth()->user()->nama;

        $judul = $rawJudul;
        $deskripsi = (string) $request->input('content', '');

        if ($status === 'draft' && $judul === '') {
            $judul = $this->announcementService->generateDraftTitle();
        }

        if ($status === 'draft' && trim(strip_tags($deskripsi)) === '') {
            $deskripsi = $this->announcementService->generateDraftDescription();
        }

        $data = [
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'status' => $status,
            'penulis' => $penulis,
            'tags' => $request->input('tags'),
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

        // if ($request->hasFile('thumbnail')) {
        //     $data['thumbnail'] = $request->file('thumbnail');
        // }

        if ($request->hasFile('image')) {
            $files = $request->file('image');
            $data['images'] = is_array($files) ? $files : [$files];
        }

        if ($request->hasFile('attachment')) {
            $data['attachment'] = $request->file('attachment');
        }

        // Always capture existing images
        $data['existing_images'] = $request->input('image_existing', []);

        // Capture image order if present
        if ($request->has('image_order')) {
            $data['image_order'] = $request->input('image_order');
        }

        return $data;
    }
}
