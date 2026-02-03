<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KepalaMadrasah;
use App\Models\StrukturOrganisasi;
use App\Models\TentangSekolah;
use App\Models\VisiMisiTujuan;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class SchoolProfileController extends Controller
{
    public function about()
    {
        $about = TentangSekolah::query()->orderBy('id')->first();
        return view('admin.pages.profile.about', compact('about'));
    }

    public function updateAbout(Request $request)
    {
        try {
            $validated = $request->validate([
                'foto_sekolah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'deskripsi' => 'nullable|string',
                'sejarah' => 'nullable|string',
            ]);

            $about = TentangSekolah::query()->orderBy('id')->first() ?? new TentangSekolah();

            if ($request->hasFile('foto_sekolah')) {
                $newPath = $this->storeImage('foto_sekolah', $request->file('foto_sekolah'), 'profil/foto-sekolah', 'foto_sekolah_');
                $this->deletePublicFileIfExists($about->foto);
                $about->foto = $newPath;
            } elseif ($request->input('foto_sekolah_remove') === '1') {
                $this->deletePublicFileIfExists($about->foto);
                $about->foto = null;
            }

            $about->deskripsi = $validated['deskripsi'] ?? null;
            $about->sejarah = $validated['sejarah'] ?? null;
            $about->save();

            TentangSekolah::query()->where('id', '!=', $about->id)->delete();

            return redirect()->route('admin.profil.about')->with('success', 'Tentang Sekolah berhasil disimpan.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function vision()
    {
        $vision = VisiMisiTujuan::query()->orderBy('id')->first();
        return view('admin.pages.profile.vision', compact('vision'));
    }

    public function updateVision(Request $request)
    {
        $validated = $request->validate([
            'visi' => 'nullable|string',
            'misi' => 'nullable|string',
            'tujuan' => 'nullable|string',
        ]);

        $vision = VisiMisiTujuan::query()->orderBy('id')->first() ?? new VisiMisiTujuan();
        $vision->fill([
            'visi' => $validated['visi'] ?? null,
            'misi' => $validated['misi'] ?? null,
            'tujuan' => $validated['tujuan'] ?? null,
        ]);
        $vision->save();

        VisiMisiTujuan::query()->where('id', '!=', $vision->id)->delete();

        return redirect()->route('admin.profil.vision')->with('success', 'Visi, Misi, Tujuan berhasil disimpan.');
    }

    public function greeting()
    {
        $greeting = KepalaMadrasah::query()->orderBy('id')->first();
        return view('admin.pages.profile.greeting', compact('greeting'));
    }

    public function updateGreeting(Request $request)
    {
        try {
            $validated = $request->validate([
                'foto_kepala_madrasah' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
                'nama' => 'nullable|string|max:255',
                'sambutan' => 'nullable|string',
            ]);

            $greeting = KepalaMadrasah::query()->orderBy('id')->first() ?? new KepalaMadrasah();

            if ($request->hasFile('foto_kepala_madrasah')) {
                $newPath = $this->storeImage('foto_kepala_madrasah', $request->file('foto_kepala_madrasah'), 'profil/kepala-madrasah', 'kepala_madrasah_');
                $this->deletePublicFileIfExists($greeting->foto);
                $greeting->foto = $newPath;
            } elseif ($request->input('foto_kepala_madrasah_remove') === '1') {
                $this->deletePublicFileIfExists($greeting->foto);
                $greeting->foto = null;
            }

            $greeting->nama = $validated['nama'] ?? null;
            $greeting->sambutan = $validated['sambutan'] ?? null;
            $greeting->save();

            KepalaMadrasah::query()->where('id', '!=', $greeting->id)->delete();

            return redirect()->route('admin.profil.greeting')->with('success', 'Kepala Madrasah berhasil disimpan.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function organization()
    {
        $organization = StrukturOrganisasi::query()->orderBy('id')->first();
        return view('admin.pages.profile.organization', compact('organization'));
    }

    public function updateOrganization(Request $request)
    {
        try {
            $request->validate([
                'struktur_organisasi' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            ]);

            $organization = StrukturOrganisasi::query()->orderBy('id')->first() ?? new StrukturOrganisasi();

            if ($request->hasFile('struktur_organisasi')) {
                $newPath = $this->storeImage('struktur_organisasi', $request->file('struktur_organisasi'), 'profil/struktur-organisasi', 'struktur_');
                $this->deletePublicFileIfExists($organization->struktur);
                $organization->struktur = $newPath;
            } elseif ($request->input('struktur_organisasi_remove') === '1') {
                $this->deletePublicFileIfExists($organization->struktur);
                $organization->struktur = null;
            }

            $organization->save();

            StrukturOrganisasi::query()->where('id', '!=', $organization->id)->delete();

            return redirect()->route('admin.profil.organization')->with('success', 'Struktur Organisasi berhasil disimpan.');
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    private function storeImage(string $fieldName, UploadedFile $file, string $directory, string $prefix): string
    {
        $realPath = $file->getRealPath();
        $fallbackPath = $_FILES[$fieldName]['tmp_name'] ?? null;
        $sourcePath = $realPath ?: $fallbackPath;

        if (empty($sourcePath) || !file_exists($sourcePath)) {
            throw new \RuntimeException('Gagal memproses file: File sementara tidak ditemukan.');
        }

        $filename = uniqid($prefix) . '.' . $file->getClientOriginalExtension();
        $path = trim($directory, '/') . '/' . $filename;

        $contents = file_get_contents($sourcePath);
        if ($contents === false) {
            throw new \RuntimeException('Gagal membaca file upload.');
        }

        $stored = Storage::disk('public')->put($path, $contents);
        if (!$stored) {
            throw new \RuntimeException('Gagal menyimpan file ke storage.');
        }

        return $path;
    }

    private function deletePublicFileIfExists(?string $path): void
    {
        if (!$path) {
            return;
        }

        if (Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }
}
