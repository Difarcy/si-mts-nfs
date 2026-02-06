<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Services\AgendaService;
use Illuminate\Http\Request;

/**
 * AgendaController
 * 
 * Mengelola fitur Agenda di halaman Admin.
 * Menangani CRUD (Create, Read, Update, Delete) serta validasi input
 * untuk agenda, termasuk upload lampiran dan pengaturan waktu acara.
 */
class AgendaController extends Controller
{
    protected AgendaService $agendaService;

    public function __construct(AgendaService $agendaService)
    {
        $this->agendaService = $agendaService;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search', ''),
            'status' => $request->query('status', ''),
            'sort' => $request->query('sort', 'latest'),
        ];

        $agenda = $this->agendaService
            ->getAdminAgendas($filters, 10)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->view('admin.partials.content.agenda.ajax', compact('agenda'));
        }

        return view('admin.pages.content.agenda.index', compact('agenda', 'filters'));
    }

    public function create()
    {
        $defaultAuthor = auth()->user()->nama;
        return view('admin.pages.content.agenda.create', compact('defaultAuthor'));
    }

    public function store(Request $request)
    {
        $status = $request->input('status', 'draft');

        $rules = [
            'status' => 'required|in:publish,draft',
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
            $rules['location'] = 'required|string|max:255';
            $rules['start_date'] = 'required|date';
            $rules['start_time'] = 'required';
        }

        $request->validate($rules, [
            'image.max' => 'Maksimal upload adalah 6 gambar sekaligus.',
            'title.required' => 'Judul agenda wajib diisi.',
            'content.required' => 'Deskripsi agenda wajib diisi.',
            'author.required' => 'Penyelenggara wajib diisi.',
            'location.required' => 'Lokasi kegiatan wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_time.required' => 'Waktu mulai wajib diisi.',
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
            $data = $this->prepareAgendaData($request, $status);

            if ($status === 'draft' && !$this->agendaService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            $this->agendaService->createAgenda($data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Agenda berhasil disimpan sebagai draft!'
                    : 'Agenda berhasil diterbitkan!'
            ]);

        } catch (\Exception $e) {
            \Log::error('ERROR FATAL SIMPAN AGENDA: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $agenda = $this->agendaService->getAgendaById($id);

        $tags = $agenda->tags
            ? array_values(array_filter(array_map('trim', explode(',', (string) $agenda->tags))))
            : [];

        $imagePaths = is_array($agenda->gambar)
            ? array_values(array_filter(array_map('trim', $agenda->gambar)))
            : [];

        $attachmentUrl = $agenda->lampiran ? asset('storage/' . $agenda->lampiran) : null;
        $attachmentName = $agenda->lampiran ? basename($agenda->lampiran) : null;

        return view('admin.pages.content.agenda.edit', compact('agenda', 'tags', 'imagePaths', 'attachmentUrl', 'attachmentName'));
    }

    public function update(Request $request, $id)
    {
        $agenda = $this->agendaService->getAgendaById($id);

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
            // Author tidak perlu divalidasi dari input
        } else {
            $rules['title'] = 'required|string|max:255';
            $rules['content'] = 'required';
            // Author tidak perlu divalidasi dari input
            $rules['location'] = 'required|string|max:255';
            $rules['start_date'] = 'required|date';
            $rules['start_time'] = 'required';
        }

        $request->validate($rules, [
            'image.max' => 'Maksimal file baru yang diunggah adalah 6 gambar.',
            'title.required' => 'Judul agenda wajib diisi.',
            'content.required' => 'Deskripsi agenda wajib diisi.',
            'author.required' => 'Penyelenggara wajib diisi.',
            'location.required' => 'Lokasi kegiatan wajib diisi.',
            'start_date.required' => 'Tanggal mulai wajib diisi.',
            'start_time.required' => 'Waktu mulai wajib diisi.',
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
            $data = $this->prepareAgendaData($request, $status);

            if ($status === 'draft' && !$this->agendaService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            $this->agendaService->updateAgenda($agenda, $data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Draft berhasil disimpan!'
                    : 'Agenda berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR UPDATE AGENDA: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $agenda = $this->agendaService->getAgendaById($id);
            $this->agendaService->deleteAgenda($agenda);

            return response()->json([
                'success' => true,
                'message' => 'Agenda berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR HAPUS AGENDA: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus agenda: ' . $e->getMessage()
            ], 500);
        }
    }

    private function prepareAgendaData(Request $request, string $status): array
    {
        $rawJudul = trim((string) $request->input('title', ''));
        $rawPenulis = trim((string) $request->input('author', ''));

        // Jika input author kosong, pakai nama user login.
        $penulis = $rawPenulis !== '' ? $rawPenulis : auth()->user()->nama;

        $judul = $rawJudul;
        $deskripsi = (string) $request->input('content', '');

        if ($status === 'draft' && $judul === '') {
            $judul = $this->agendaService->generateDraftTitle();
        }

        if ($status === 'draft' && trim(strip_tags($deskripsi)) === '') {
            $deskripsi = $this->agendaService->generateDraftDescription();
        }

        $data = [
            'judul' => $judul,
            'deskripsi' => $deskripsi,
            'status' => $status,
            'penulis' => $penulis,
            'tags' => $request->input('tags'),
            'lokasi' => $request->input('location'),
            'tanggal_mulai' => $request->input('start_date'),
            'tanggal_selesai' => $request->input('end_date'),
            'waktu_mulai' => $request->input('start_time'),
            'waktu_selesai' => $request->input('end_time'),
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
