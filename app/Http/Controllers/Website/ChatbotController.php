<?php

namespace App\Http\Controllers\Website;

use App\Models\KepalaMadrasah;
use App\Models\Kontak;
use App\Models\SpmbPpdb;
use App\Models\VisiMisiTujuan;
use App\Models\TentangSekolah;
use App\Models\MediaSosial;
use App\Models\Berita;
use App\Models\Agenda;
use App\Models\PrestasiSiswa;
use App\Models\Pengumuman;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

use App\Models\Hero;
use App\Models\Artikel;

class ChatbotController
{
    public function send(Request $request)
    {
        $validated = $request->validate([
            'message' => ['required', 'string', 'max:2000'],
            'messages' => ['nullable', 'array'],
            'messages.*.role' => ['required_with:messages', 'in:user,assistant'],
            'messages.*.content' => ['required_with:messages', 'string', 'max:2000'],
        ]);

        $deepseekKey = (string) config('services.deepseek.key', '');
        $openAiKey = (string) config('services.openai.key', '');

        // Fallback untuk environment variable langsung
        if (empty($deepseekKey)) {
            $deepseekKey = env('DEEPSEEK_API_KEY', '');
        }
        if (empty($openAiKey)) {
            $openAiKey = env('OPENAI_API_KEY', '');
        }

        $provider = $deepseekKey !== '' ? 'deepseek' : 'openai';
        $apiKey = $provider === 'deepseek' ? $deepseekKey : $openAiKey;

        if ($apiKey === '') {
            return response()->json([
                'reply' => 'Maaf, fitur AI untuk Nafa belum diaktifkan. Silakan konfigurasi DEEPSEEK_API_KEY atau OPENAI_API_KEY terlebih dahulu.',
            ], 503);
        }

        $officialData = $this->buildOfficialData();

        $systemPrompt = "Kamu adalah Nafa, asisten virtual MTs Nurul Falaah Soreang.
Jawablah dengan gaya bahasa yang natural, baku, dan sopan selayaknya manusia (customer service sekolah), bukan robot.
HINDARI penggunaan format Markdown seperti huruf tebal (**teks**) atau miring (*teks*) serta hindari daftar bernomor/bullet (contoh: 1., 2., 3. atau -). Gunakan paragraf pendek dan kalimat yang rapi.

WAKTU SERVER SAAT INI: " . now()->locale('id')->isoFormat('dddd, D MMMM Y HH:mm') . " WIB

DATA RESMI (ambil dari database website):
" . $officialData . "

INFORMASI UMUM (Informasi Statis yang tampil di halaman SPMB di website):
- Jalur Pendaftaran:
  Gelombang I: Jalur Unggulan & Prestasi
  Gelombang II: Jalur Reguler

- Syarat Pendaftaran SPMB:
  1. Mengisi formulir pendaftaran
  2. Fotokopi Ijazah SD/MI (3 lembar)
  3. Fotokopi Kartu Keluarga (3 lembar)
  4. Fotokopi KTP Orang Tua (3 lembar)
  5. Fotokopi Akta Kelahiran (3 lembar)
  6. Fotokopi Kartu NISN (3 lembar)
  7. Surat Kelulusan dan SKKB asli
  8. Fotokopi Kartu KIP (3 lembar, jika punya)
  9. Surat Keterangan Tidak Mampu (jika ada)
  10. Pas foto ukuran 2x3 dan 3x4 (masing-masing 3 lembar)

- Informasi Pendaftaran:
  Saat ini pendaftaran dilakukan secara langsung (offline). Silakan datang ke sekretariat pendaftaran di sekolah dengan membawa persyaratan lengkap.

- Keunggulan Sekolah:
  Aktivitas interaktif, tenaga pengajar kompeten, pendidikan adab & karakter, kurikulum terpadu, fasilitas memadai, lingkungan strategis.

- Fasilitas Sekolah:
  Bangunan milik sendiri, laboratorium komputer, masjid sekolah, gedung aula, perpustakaan, lapangan olahraga.

- Ekstrakurikuler:
  Pramuka, BTQ & Tahfidz, voli & futsal, hadroh & rebana, seni tilawah, pencak silat.

- Jam Operasional Sekolah:
  Senin - Sabtu: 07.00 - 14.30 WIB

ATURAN PENTING:
- Gunakan DATA RESMI sebagai prioritas utama. Jika data di sana kosong, baru gunakan INFORMASI UMUM.
- Jika ditanya Berita, Artikel, Pengumuman, Agenda, atau Prestasi, cek dulu di DATA RESMI bagian 'Berita Terbaru', 'Agenda Mendatang', dll. Jika tidak ada data di sana, JANGAN MENGARANG judul berita. Katakan dengan sopan bahwa \"belum ada informasi terkini terkait hal tersebut di website kami\".
- Jika datanya ADA (misal ada Berita Terbaru atau Artikel Terbaru), jawab dengan format: \"Halo! Berdasarkan informasi terbaru di website kami, ada berita/artikel mengenai '[JUDUL]'. Untuk detail lengkapnya, Anda bisa mengunjungi website resmi sekolah di " . (string) config('app.url') . " .\"
- Jika ditanya tentang tanggal atau waktu hari ini, jawab langsung dan gunakan WAKTU SERVER SAAT INI sebagai acuan. Hindari frasa \"tercatat\" atau kalimat teknis.
- Jika ditanya Berita Unggulan, gunakan bagian \"Berita Unggulan\". Jika tidak ada bagian itu, sampaikan belum ada berita unggulan di website kami.
- Jika ditanya konten yang sedang ramai/viral/populer, gunakan bagian \"Konten Paling Ramai (Komentar/Suka)\" dan sebutkan Top 3 beserta jumlah komentar dan suka. Jika tidak ada bagian itu, sampaikan bahwa data interaksi (komentar/suka) belum tersedia di website kami.
- Jika ditanya video, gunakan bagian \"Video Terbaru\". Jika tidak ada bagian itu, sampaikan belum ada video terbaru di website kami.
- Jika ditanya tentang STRUKTUR ORGANISASI, jawab dengan sopan bahwa \"informasi struktur organisasi dapat dilihat secara lengkap pada menu Profil di website sekolah\", karena data tersebut berbentuk bagan/gambar yang tidak bisa saya baca.
- JANGAN PERNAH menyebutkan kata \"database\", \"data resmi\", \"system\", atau hal teknis lainnya kepada pengguna. Gunakan istilah seperti \"informasi sekolah\" atau \"website resmi\".
- Jika ditanya hal teknis yang tidak ada di data (seperti 'siapa guru matematika kelas 7'), arahkan untuk menghubungi kontak sekolah.
- Jawablah dengan paragraf pendek yang nyaman dibaca tanpa format bold/italic.";

        $history = collect(Arr::get($validated, 'messages', []))
            ->map(fn($m) => ['role' => $m['role'], 'content' => $m['content']])
            ->take(12)
            ->values()
            ->all();

        $chatMessages = array_merge([
            ['role' => 'system', 'content' => $systemPrompt],
        ], $history, [
            ['role' => 'user', 'content' => $validated['message']],
        ]);

        $model = $provider === 'deepseek'
            ? (string) config('services.deepseek.model', 'deepseek-chat')
            : (string) config('services.openai.model', 'gpt-4o-mini');

        $endpoint = 'https://api.openai.com/v1/chat/completions';
        if ($provider === 'deepseek') {
            $baseUrl = rtrim((string) config('services.deepseek.base_url', 'https://api.deepseek.com'), '/');
            $endpoint = str_ends_with($baseUrl, '/v1')
                ? $baseUrl . '/chat/completions'
                : $baseUrl . '/v1/chat/completions';
        }

        $response = Http::withToken($apiKey)
            ->acceptJson()
            ->asJson()
            ->timeout(30)
            ->post($endpoint, [
                'model' => $model,
                'messages' => $chatMessages,
                'temperature' => 0.3,
            ]);

        if (!$response->successful()) {
            return response()->json([
                'reply' => 'Maaf, Nafa sedang bermasalah. Coba lagi sebentar ya.',
            ], 502);
        }

        $reply = (string) data_get($response->json(), 'choices.0.message.content', '');
        $reply = trim($reply);

        if ($reply === '') {
            return response()->json([
                'reply' => 'Maaf, saya belum bisa menjawab saat ini. Coba ulangi pertanyaannya ya.',
            ], 502);
        }

        return response()->json([
            'reply' => $reply,
        ]);
    }

    private function buildOfficialData(): string
    {
        $lines = [];

        $lines[] = 'Nama asisten: Nafa';
        $lines[] = 'Website: ' . (string) config('app.url');

        try {
            $hero = Hero::query()->orderBy('id')->first();
            if ($hero) {
                if (!empty($hero->tagline)) $lines[] = 'Tagline Sekolah: ' . trim($hero->tagline);
                if (!empty($hero->judul)) $lines[] = 'Judul Banner Utama: ' . trim($hero->judul);
                if (!empty($hero->deskripsi)) $lines[] = 'Deskripsi Utama: ' . trim($hero->deskripsi);
            }
        } catch (\Throwable) {
        }

        try {
            $kontak = Kontak::query()->orderBy('id')->first();
            if ($kontak) {
                if (!empty($kontak->alamat)) $lines[] = 'Alamat sekolah: ' . trim((string) $kontak->alamat);
                if (!empty($kontak->telepon)) $lines[] = 'Telepon: ' . trim((string) $kontak->telepon);
                if (!empty($kontak->whatsapp)) $lines[] = 'WhatsApp: ' . trim((string) $kontak->whatsapp);
                if (!empty($kontak->email)) $lines[] = 'Email: ' . trim((string) $kontak->email);
                if (!empty($kontak->koordinat)) $lines[] = 'Koordinat (lat,long): ' . trim((string) $kontak->koordinat);
            }
        } catch (\Throwable) {
        }

        try {
            $spmb = SpmbPpdb::query()->orderBy('id')->first();
            if ($spmb) {
                $tahun = trim((string) ($spmb->tahun ?? ''));
                $status = trim((string) ($spmb->status ?? ''));
                $kuota = $spmb->kuota;
                $biaya = $spmb->biaya;

                if ($tahun !== '') $lines[] = 'SPMB tahun: ' . $tahun;
                if ($status !== '') $lines[] = 'Status SPMB: ' . $status;
                if (!is_null($kuota)) $lines[] = 'Kuota SPMB: ' . (int) $kuota;

                if (is_null($biaya) || (int) $biaya === 0) {
                    $lines[] = 'Biaya masuk SPMB: Gratis';
                } else {
                    $lines[] = 'Biaya masuk SPMB: Rp ' . number_format((int) $biaya, 0, ',', '.');
                }

                // Jadwal Pendaftaran (Gelombang 1 & 2)
                $jadwal = [];
                // Gelombang 1
                if (!empty($spmb->g1t1nm)) $jadwal[] = "{$spmb->g1t1nm}: " . ($spmb->g1t1st ?? '-') . " s/d " . ($spmb->g1t1en ?? '-');
                if (!empty($spmb->g1t2nm)) $jadwal[] = "{$spmb->g1t2nm}: " . ($spmb->g1t2st ?? '-') . " s/d " . ($spmb->g1t2en ?? '-');
                if (!empty($spmb->g1t3nm)) $jadwal[] = "{$spmb->g1t3nm}: " . ($spmb->g1t3st ?? '-') . " s/d " . ($spmb->g1t3en ?? '-');
                if (!empty($spmb->g1t4nm)) $jadwal[] = "{$spmb->g1t4nm}: " . ($spmb->g1t4st ?? '-') . " s/d " . ($spmb->g1t4en ?? '-');
                if (!empty($spmb->g1t5nm)) $jadwal[] = "{$spmb->g1t5nm}: " . ($spmb->g1t5st ?? '-') . " s/d " . ($spmb->g1t5en ?? '-');

                // Gelombang 2
                if (!empty($spmb->g2t1nm)) $jadwal[] = "{$spmb->g2t1nm}: " . ($spmb->g2t1st ?? '-') . " s/d " . ($spmb->g2t1en ?? '-');
                if (!empty($spmb->g2t2nm)) $jadwal[] = "{$spmb->g2t2nm}: " . ($spmb->g2t2st ?? '-') . " s/d " . ($spmb->g2t2en ?? '-');
                if (!empty($spmb->g2t3nm)) $jadwal[] = "{$spmb->g2t3nm}: " . ($spmb->g2t3st ?? '-') . " s/d " . ($spmb->g2t3en ?? '-');
                if (!empty($spmb->g2t4nm)) $jadwal[] = "{$spmb->g2t4nm}: " . ($spmb->g2t4st ?? '-') . " s/d " . ($spmb->g2t4en ?? '-');
                if (!empty($spmb->g2t5nm)) $jadwal[] = "{$spmb->g2t5nm}: " . ($spmb->g2t5st ?? '-') . " s/d " . ($spmb->g2t5en ?? '-');

                if (!empty($jadwal)) {
                    $lines[] = "Jadwal Pendaftaran:\n  - " . implode("\n  - ", $jadwal);
                }
            }
        } catch (\Throwable) {
        }

        try {
            $kepala = KepalaMadrasah::query()->orderBy('id')->first();
            if ($kepala) {
                if (!empty($kepala->nama)) $lines[] = 'Kepala Madrasah: ' . trim((string) $kepala->nama);
                if (!empty($kepala->sambutan)) $lines[] = 'Sambutan Kepala Madrasah: ' . strip_tags($kepala->sambutan);
            }
        } catch (\Throwable) {
        }

        try {
            $visiMisi = VisiMisiTujuan::query()->orderBy('id')->first();
            if ($visiMisi) {
                if (!empty($visiMisi->visi)) $lines[] = 'Visi Sekolah: ' . strip_tags($visiMisi->visi);
                if (!empty($visiMisi->misi)) $lines[] = 'Misi Sekolah: ' . strip_tags($visiMisi->misi);
                if (!empty($visiMisi->tujuan)) $lines[] = 'Tujuan Sekolah: ' . strip_tags($visiMisi->tujuan);
            }
        } catch (\Throwable) {
        }

        try {
            $tentang = TentangSekolah::query()->orderBy('id')->first();
            if ($tentang) {
                if (!empty($tentang->deskripsi)) $lines[] = 'Tentang Sekolah: ' . strip_tags($tentang->deskripsi);
                if (!empty($tentang->sejarah)) $lines[] = 'Sejarah Sekolah: ' . strip_tags($tentang->sejarah);
            }
        } catch (\Throwable) {
        }

        try {
            $sosmed = MediaSosial::query()->orderBy('id')->first();
            if ($sosmed) {
                $sosmedList = [];
                if (!empty($sosmed->facebook)) $sosmedList[] = 'Facebook: ' . $sosmed->facebook;
                if (!empty($sosmed->instagram)) $sosmedList[] = 'Instagram: ' . $sosmed->instagram;
                if (!empty($sosmed->youtube)) $sosmedList[] = 'YouTube: ' . $sosmed->youtube;
                if (!empty($sosmed->tiktok)) $sosmedList[] = 'TikTok: ' . $sosmed->tiktok;
                
                if (!empty($sosmedList)) {
                    $lines[] = 'Media Sosial: ' . implode(', ', $sosmedList);
                }
            }
        } catch (\Throwable) {
        }

        // Info Terbaru (Ringkasan)
        try {
            $highlightNews = Berita::where('status', 'publish')
                ->where('is_highlight', true)
                ->latest('tanggal_publikasi')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    $tgl = $item->tanggal_publikasi ? $item->tanggal_publikasi->format('d M Y') : '-';
                    return "{$item->judul} ({$tgl})";
                })
                ->toArray();

            if (!empty($highlightNews)) {
                $lines[] = 'Berita Unggulan: ' . implode('; ', $highlightNews);
            }
        } catch (\Throwable) {
        }

        try {
            $latestPengumuman = Pengumuman::where('status', 'publish')
                ->latest('tanggal_publikasi')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    $tgl = $item->tanggal_publikasi ? $item->tanggal_publikasi->format('d M Y') : '-';
                    $ringkas = \Illuminate\Support\Str::of((string) ($item->deskripsi ?? ''))
                        ->stripTags()
                        ->replaceMatches('/\s+/', ' ')
                        ->trim();
                    $ringkas = $ringkas !== '' ? (string) \Illuminate\Support\Str::limit((string) $ringkas, 220) : '';
                    return $ringkas !== ''
                        ? "{$item->judul} ({$tgl}) - {$ringkas}"
                        : "{$item->judul} ({$tgl})";
                })
                ->toArray();

            if (!empty($latestPengumuman)) {
                $lines[] = 'Pengumuman Terbaru: ' . implode('; ', $latestPengumuman);
            }
        } catch (\Throwable) {
        }

        try {
            $latestArtikel = Artikel::where('status', 'publish')
                ->latest('tanggal_publikasi')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    $tgl = $item->tanggal_publikasi ? $item->tanggal_publikasi->format('d M Y') : '-';
                    $ringkas = \Illuminate\Support\Str::of((string) ($item->deskripsi ?? ''))
                        ->stripTags()
                        ->replaceMatches('/\s+/', ' ')
                        ->trim();
                    $ringkas = $ringkas !== '' ? (string) \Illuminate\Support\Str::limit((string) $ringkas, 220) : '';
                    return $ringkas !== ''
                        ? "{$item->judul} ({$tgl}) - {$ringkas}"
                        : "{$item->judul} ({$tgl})";
                })
                ->toArray();

            if (!empty($latestArtikel)) {
                $lines[] = 'Artikel Terbaru: ' . implode('; ', $latestArtikel);
            }
        } catch (\Throwable) {
        }

        try {
            $latestNews = Berita::where('status', 'publish')
                ->latest('tanggal_publikasi')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    $tgl = $item->tanggal_publikasi ? $item->tanggal_publikasi->format('d M Y') : '-';
                    $ringkas = \Illuminate\Support\Str::of((string) ($item->deskripsi ?? ''))
                        ->stripTags()
                        ->replaceMatches('/\s+/', ' ')
                        ->trim();
                    $ringkas = $ringkas !== '' ? (string) \Illuminate\Support\Str::limit((string) $ringkas, 220) : '';
                    return $ringkas !== ''
                        ? "{$item->judul} ({$tgl}) - {$ringkas}"
                        : "{$item->judul} ({$tgl})";
                })
                ->toArray();

            if (!empty($latestNews)) {
                $lines[] = 'Berita Terbaru: ' . implode('; ', $latestNews);
            }
        } catch (\Throwable) {
        }

        try {
            $latestAgenda = Agenda::where('status', 'publish')->where('tanggal_selesai', '>=', now())->orderBy('tanggal_mulai', 'asc')->take(3)->get();
            if ($latestAgenda->isNotEmpty()) {
                $agendaList = $latestAgenda->map(function($a) {
                    $tglMulai = $a->tanggal_mulai ? $a->tanggal_mulai->format('d M Y') : '-';
                    $tglSelesai = $a->tanggal_selesai ? $a->tanggal_selesai->format('d M Y') : '';
                    $tanggal = $tglSelesai !== '' && $tglSelesai !== $tglMulai ? "{$tglMulai} s/d {$tglSelesai}" : $tglMulai;

                    $jamMulai = $a->waktu_mulai ? substr((string) $a->waktu_mulai, 0, 5) : '';
                    $jamSelesai = $a->waktu_selesai ? substr((string) $a->waktu_selesai, 0, 5) : '';
                    $waktu = $jamMulai !== '' ? ($jamSelesai !== '' ? "{$jamMulai}-{$jamSelesai} WIB" : "{$jamMulai} WIB") : '';

                    $lokasi = trim((string) ($a->lokasi ?? ''));

                    $ringkas = \Illuminate\Support\Str::of((string) ($a->deskripsi ?? ''))
                        ->stripTags()
                        ->replaceMatches('/\s+/', ' ')
                        ->trim();
                    $ringkas = $ringkas !== '' ? (string) \Illuminate\Support\Str::limit((string) $ringkas, 200) : '';

                    $parts = [trim((string) $a->judul), "({$tanggal})"];
                    if ($waktu !== '') $parts[] = $waktu;
                    if ($lokasi !== '') $parts[] = 'Lokasi: ' . $lokasi;
                    $text = implode(' ', $parts);
                    return $ringkas !== '' ? $text . ' - ' . $ringkas : $text;
                })->toArray();
                $lines[] = 'Agenda Mendatang: ' . implode('; ', $agendaList);
            }
        } catch (\Throwable) {
        }

        try {
            $latestPrestasi = PrestasiSiswa::where('status', 'publish')
                ->latest('tanggal')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    $tgl = $item->tanggal ? \Carbon\Carbon::parse($item->tanggal)->format('d M Y') : '-';
                    $namaSiswa = trim((string) ($item->nama_siswa ?? ''));
                    $peringkat = trim((string) ($item->peringkat ?? ''));

                    $ringkas = \Illuminate\Support\Str::of((string) ($item->deskripsi ?? ''))
                        ->stripTags()
                        ->replaceMatches('/\s+/', ' ')
                        ->trim();
                    $ringkas = $ringkas !== '' ? (string) \Illuminate\Support\Str::limit((string) $ringkas, 200) : '';

                    $base = trim((string) ($item->nama_lomba ?? ''));
                    if ($namaSiswa !== '') $base .= " - {$namaSiswa}";
                    if ($peringkat !== '') $base .= " - {$peringkat}";
                    $base .= " ({$tgl})";

                    return $ringkas !== '' ? $base . ' - ' . $ringkas : $base;
                })
                ->toArray();

            if (!empty($latestPrestasi)) {
                $lines[] = 'Prestasi Siswa Terbaru: ' . implode('; ', $latestPrestasi);
            }
        } catch (\Throwable) {
        }

        try {
            $latestVideo = Video::where('status', 'publish')
                ->latest('tanggal_publikasi')
                ->take(3)
                ->get()
                ->map(function ($item) {
                    $tgl = $item->tanggal_publikasi ? $item->tanggal_publikasi->format('d M Y') : '-';
                    $link = trim((string) ($item->link ?? ''));
                    return $link !== ''
                        ? "{$item->judul} ({$tgl}) - {$link}"
                        : "{$item->judul} ({$tgl})";
                })
                ->toArray();

            if (!empty($latestVideo)) {
                $lines[] = 'Video Terbaru: ' . implode('; ', $latestVideo);
            }
        } catch (\Throwable) {
        }

        try {
            $popular = DB::table('komentar as k')
                ->leftJoin('komentar_like_publik as klp', 'klp.komentar_id', '=', 'k.id')
                ->leftJoin('komentar_like as kla', 'kla.komentar_id', '=', 'k.id')
                ->where('k.status', 'approved')
                ->groupBy('k.konten_tipe', 'k.konten_id')
                ->selectRaw('k.konten_tipe, k.konten_id')
                ->selectRaw('COUNT(DISTINCT k.id) as komentar_count')
                ->selectRaw('COUNT(DISTINCT klp.id) as like_public_count')
                ->selectRaw('COUNT(DISTINCT kla.id) as like_admin_count')
                ->orderByRaw('(COUNT(DISTINCT k.id) + COUNT(DISTINCT klp.id) + COUNT(DISTINCT kla.id)) DESC')
                ->limit(3)
                ->get();

            if ($popular->isNotEmpty()) {
                $popularText = $popular
                    ->map(function ($row) {
                        $type = (string) $row->konten_tipe;
                        $id = (int) $row->konten_id;
                        $komentarCount = (int) $row->komentar_count;
                        $likeCount = (int) $row->like_public_count + (int) $row->like_admin_count;

                        $label = null;
                        $title = null;
                        if ($type === 'news') {
                            $label = 'Berita';
                            $title = Berita::find($id)?->judul;
                        } elseif ($type === 'article') {
                            $label = 'Artikel';
                            $title = Artikel::find($id)?->judul;
                        } elseif ($type === 'announcement') {
                            $label = 'Pengumuman';
                            $title = Pengumuman::find($id)?->judul;
                        } elseif ($type === 'agenda') {
                            $label = 'Agenda';
                            $title = Agenda::find($id)?->judul;
                        } elseif ($type === 'achievement') {
                            $label = 'Prestasi Siswa';
                            $title = PrestasiSiswa::find($id)?->nama_lomba;
                        }

                        if (!$label || !$title) {
                            return null;
                        }

                        return "{$label}: {$title} (Komentar: {$komentarCount}, Suka: {$likeCount})";
                    })
                    ->filter()
                    ->values()
                    ->all();

                if (count($popularText) > 0) {
                    $numbered = collect($popularText)
                        ->values()
                        ->map(fn($text, $i) => ($i + 1) . ') ' . $text)
                        ->implode("\n  ");
                    $lines[] = "Konten Paling Ramai (Komentar/Suka):\n  " . $numbered;
                }
            }
        } catch (\Throwable) {
        }

        if (count($lines) === 0) {
            return '- (data tidak tersedia)';
        }

        return collect($lines)->map(fn($line) => '- ' . $line)->implode("\n");
    }
}
