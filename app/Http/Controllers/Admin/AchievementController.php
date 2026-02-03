<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PrestasiSiswa;
use App\Services\AchievementService;
use Illuminate\Http\Request;

class AchievementController extends Controller
{
    protected AchievementService $achievementService;

    public function __construct(AchievementService $achievementService)
    {
        $this->achievementService = $achievementService;
    }

    public function index(Request $request)
    {
        $filters = [
            'search' => $request->query('search', ''),
            'status' => $request->query('status', ''),
            'sort' => $request->query('sort', 'latest'),
        ];

        $prestasi = $this->achievementService
            ->getAdminAchievements($filters, 10)
            ->withQueryString();

        if ($request->ajax()) {
            return response()->view('admin.partials.content.achievements.ajax', compact('prestasi'));
        }

        return view('admin.pages.content.achievements.index', compact('prestasi', 'filters'));
    }

    public function create()
    {
        $defaultAuthor = auth()->user()->nama;
        return view('admin.pages.content.achievements.create', compact('defaultAuthor'));
    }

    public function store(Request $request)
    {
        $status = $request->input('status', 'draft');

        $rules = [
            'status' => 'required|in:publish,draft,nonaktif',
            'tags' => 'nullable|string',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'certificate' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ];

        if ($status === 'draft') {
            $rules['content'] = 'nullable';
            $rules['author'] = 'nullable|string|max:100';
        } else {
            $rules['content'] = 'required';
            $rules['author'] = 'required|string|max:100';
            $rules['competition_name'] = 'required|string|max:255';
            $rules['student_name'] = 'required|string|max:255';
            $rules['class'] = 'required|string|max:50';
            $rules['level'] = 'required|string';
            $rules['type'] = 'required|string';
            $rules['rank'] = 'required|string';
            $rules['achievement_date'] = 'required|date';

            // Required files for publish
            $rules['student_photo'] = 'required|image|mimes:jpeg,png,jpg|max:10240';
        }

        $request->validate($rules);

        try {
            $data = $this->prepareAchievementData($request, $status);

            if ($status === 'draft' && !$this->achievementService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            $this->achievementService->createAchievement($data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Prestasi berhasil disimpan sebagai draft!'
                    : 'Prestasi berhasil diterbitkan!'
            ]);

        } catch (\Exception $e) {
            \Log::error('ERROR FATAL SIMPAN PRESTASI: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {
        $prestasiSiswa = $this->achievementService->getAchievementById($id);

        $tags = $prestasiSiswa->tags
            ? array_values(array_filter(array_map('trim', explode(',', (string) $prestasiSiswa->tags))))
            : [];

        $studentPhotoUrl = $prestasiSiswa->foto_siswa ? asset('storage/' . $prestasiSiswa->foto_siswa) : null;
        $certificateUrl = $prestasiSiswa->sertifikat ? asset('storage/' . $prestasiSiswa->sertifikat) : null;

        return view('admin.pages.content.achievements.edit', compact('prestasiSiswa', 'tags', 'studentPhotoUrl', 'certificateUrl'));
    }

    public function update(Request $request, $id)
    {
        $prestasi = $this->achievementService->getAchievementById($id);

        $status = $request->input('status', 'draft');

        $rules = [
            'status' => 'required|in:publish,draft,nonaktif',
            'tags' => 'nullable|string',
            'student_photo' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'certificate' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
        ];

        if ($status === 'draft') {
            $rules['content'] = 'nullable';
            // Author tidak perlu divalidasi dari input
        } else {
            $rules['content'] = 'required';
            // Author tidak perlu divalidasi dari input
            $rules['competition_name'] = 'required|string|max:255';
            $rules['student_name'] = 'required|string|max:255';
            $rules['class'] = 'required|string|max:50';
            $rules['level'] = 'required|string';
            $rules['type'] = 'required|string';
            $rules['rank'] = 'required|string';
            $rules['achievement_date'] = 'required|date';

            // Check if photo removed or not present
            $photoWillBeRemoved = $request->input('student_photo_remove') === '1' && !$request->hasFile('student_photo');
            if (!$prestasi->foto_siswa || $photoWillBeRemoved) {
                $rules['student_photo'] = 'required|image|mimes:jpeg,png,jpg|max:10240';
            }
        }

        $request->validate($rules);

        try {
            $data = $this->prepareAchievementData($request, $status);

            if ($status === 'draft' && !$this->achievementService->validateDraftContent($data)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Isi minimal 1 input atau upload minimal 1 gambar untuk menyimpan draft.'
                ], 422);
            }

            $this->achievementService->updateAchievement($prestasi, $data);

            return response()->json([
                'success' => true,
                'message' => $status === 'draft'
                    ? 'Draft berhasil disimpan!'
                    : 'Prestasi berhasil diperbarui!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR UPDATE PRESTASI: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal: ' . $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $prestasi = $this->achievementService->getAchievementById($id);
            $this->achievementService->deleteAchievement($prestasi);

            return response()->json([
                'success' => true,
                'message' => 'Prestasi berhasil dihapus!'
            ]);
        } catch (\Exception $e) {
            \Log::error('ERROR HAPUS PRESTASI: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus prestasi: ' . $e->getMessage()
            ], 500);
        }
    }

    private function prepareAchievementData(Request $request, string $status): array
    {
        $rawPenulis = trim((string) $request->input('author', ''));
        // Jika input author kosong, pakai nama user login.
        $penulis = $rawPenulis !== '' ? $rawPenulis : auth()->user()->nama;

        $deskripsi = (string) $request->input('content', '');

        if ($status === 'draft' && trim(strip_tags($deskripsi)) === '') {
            $deskripsi = $this->achievementService->generateDraftDescription();
        }

        $data = [
            'deskripsi' => $deskripsi,
            'status' => $status,
            'penulis' => $penulis,
            'tags' => $request->input('tags'),
            'nama_lomba' => $request->input('competition_name'),
            'nama_siswa' => $request->input('student_name'),
            'kelas' => $request->input('class'),
            'tingkat' => $request->input('level'),
            'jenis' => $request->input('type'),
            'penyelenggara' => $request->input('organizer'),
            'peringkat' => $request->input('rank'), // Pastikan ini sesuai kolom db
            // 'juara_ke' => $request->input('rank'), // Hapus jika tidak ada kolom ini
            'tanggal' => $request->input('achievement_date'),
            'tanggal_publikasi' => now(), // Tambahkan tanggal publikasi default saat create
        ];

        if ($request->hasFile('student_photo')) {
            $data['student_photo'] = $request->file('student_photo');
        }

        if ($request->has('student_photo_remove')) {
            $data['student_photo_remove'] = $request->input('student_photo_remove');
        }

        if ($request->hasFile('certificate')) {
            $data['certificate'] = $request->file('certificate');
        }

        if ($request->has('certificate_remove')) {
            $data['certificate_remove'] = $request->input('certificate_remove');
        }

        return $data;
    }
}
