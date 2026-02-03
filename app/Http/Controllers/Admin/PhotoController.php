<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\PhotoService;

class PhotoController extends Controller
{
    protected $photoService;

    public function __construct(PhotoService $photoService)
    {
        $this->photoService = $photoService;
    }

    public function index(Request $request)
    {
        $requestedPerPage = (int) $request->query('per_page', 15);
        $perPage = $requestedPerPage === 16 ? 16 : 15;

        $photos = $this->photoService->getAdminPhotos($request->all(), $perPage);
        $photos->appends($request->except('page'));

        if ($request->ajax()) {
            return view('admin.partials.media.photo.ajax', compact('photos'));
        }

        return view('admin.pages.media.photo.index', compact('photos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'files' => 'required|array|max:16',
            'files.*' => 'image|mimes:jpeg,png,jpg|max:10240',
        ]);

        try {
            $createdPhotos = $this->photoService->createPhotos([
                'images' => $request->file('files'),
                'tanggal_publikasi' => now(),
            ]);

            if (count($createdPhotos) === 0) {
                return back()->with('error', 'Tidak ada foto yang berhasil diunggah. Pastikan format dan ukuran file sesuai.');
            }

            return redirect()->route('admin.media.foto.index')
                ->with('success', count($createdPhotos) . ' foto berhasil diunggah');
        } catch (\Throwable $e) {
            return back()->with('error', 'Gagal mengupload foto: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            $this->photoService->deletePhoto($id);
            return response()->json([
                'success' => true,
                'message' => 'Foto berhasil dihapus'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal menghapus foto'
            ], 500);
        }
    }

    public function updateOrder(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return response()->json(['success' => false, 'message' => 'Tidak ada ID yang diberikan'], 400);
        }

        $success = $this->photoService->updateOrder($ids);

        if ($success) {
            return response()->json(['success' => true, 'message' => 'Urutan berhasil diperbarui']);
        }

        return response()->json(['success' => false, 'message' => 'Gagal memperbarui urutan'], 500);
    }
}
