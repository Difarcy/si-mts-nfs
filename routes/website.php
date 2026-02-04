<?php

/**
 * ============================================
 * WEBSITE ROUTES - Halaman Publik
 * ============================================
 */

use Illuminate\Support\Facades\Route;
use App\Models\Berita;
use App\Models\Artikel;
use App\Models\Photo;
use App\Http\Controllers\Website\KomentarController;
use App\Http\Controllers\Website\ChatbotController;

// Homepage
Route::get('/', function () {
    try {
        // Hero Section Data
        $hero = \App\Models\Hero::first();

        // Widget Kepala Madrasah (Sidebar)
        $kepalaMadrasah = \App\Models\KepalaMadrasah::query()->orderBy('id')->first();

        // Banner Promosi
        $bannerPromosi = \App\Models\BannerPromosi::first();
        $promosiBannerPath = $bannerPromosi ? $bannerPromosi->path : null;

        // Banner Slide
        $banners = \App\Models\Banner::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->get();

        // Berita Highlight (yang dicentang "Jadikan Highlight")
        $highlightNews = \App\Models\Berita::where('status', 'publish')
            ->where('is_highlight', true)
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->latest('id')
            ->take(5)
            ->get();

        // Berita Terbaru untuk section lain
        $latestNews = \App\Models\Berita::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->latest('id')
            ->take(4)
            ->get();

        // Artikel Terbaru untuk section Latest Articles
        $latestArticles = \App\Models\Artikel::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->latest('id')
            ->take(4)
            ->get();

        // Prestasi Siswa Terbaru
        $prestasiSiswa = \App\Models\PrestasiSiswa::where('status', 'publish')
            ->orderBy('tanggal', 'desc')
            ->take(4)
            ->get();

        // Foto Kegiatan Terbaru (12 foto untuk 2 baris scrolling)
        $fotoKegiatan = \App\Models\Photo::orderBy('tanggal_publikasi', 'desc')->take(12)->get();

        // Video Kegiatan Terbaru
        $videoKegiatan = \App\Models\Video::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->latest('id')
            ->take(6)
            ->get();

        // Ticker Items (2 Berita, 1 Artikel, 1 Pengumuman, 1 Agenda)
        $tickerNews = \App\Models\Berita::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
            })
            ->latest('tanggal_publikasi')
            ->take(2)
            ->get()
            ->map(fn($item) => $item->judul);

        $tickerArticles = \App\Models\Artikel::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
            })
            ->latest('tanggal_publikasi')
            ->take(1)
            ->get()
            ->map(fn($item) => $item->judul);

        $tickerAnnouncements = \App\Models\Pengumuman::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
            })
            ->latest('tanggal_publikasi')
            ->take(1)
            ->get()
            ->map(fn($item) => $item->judul);

        $tickerAgendas = \App\Models\Agenda::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
            })
            ->latest('tanggal_publikasi')
            ->take(1)
            ->get()
            ->map(fn($item) => $item->judul);

        $tickerItems = $tickerNews->concat($tickerArticles)->concat($tickerAnnouncements)->concat($tickerAgendas);

        return view('website.pages.home.index', compact('hero', 'kepalaMadrasah', 'promosiBannerPath', 'banners', 'latestNews', 'highlightNews', 'latestArticles', 'fotoKegiatan', 'videoKegiatan', 'prestasiSiswa', 'tickerItems'));
    } catch (\Exception $e) {
        // Fallback jika database belum siap (misal saat fresh deploy sebelum migrate)
        // Log::error('Homepage Error: ' . $e->getMessage());
        return view('website.pages.home.index', [
            'hero' => null,
            'kepalaMadrasah' => null,
            'promosiBannerPath' => null,
            'banners' => collect(),
            'latestNews' => collect(),
            'highlightNews' => collect(),
            'latestArticles' => collect(),
            'fotoKegiatan' => collect(),
            'videoKegiatan' => collect(),
            'prestasiSiswa' => collect(),
            'tickerItems' => collect(),
        ]);
    }
})->name('web.home');

// Halaman Profil
Route::get('/about', function () {
    $tentangSekolah = \App\Models\TentangSekolah::query()->orderBy('id')->first();
    return view('website.pages.profile.about.index', compact('tentangSekolah'));
})->name('web.about');

Route::get('/vision', function () {
    $visiMisiTujuan = \App\Models\VisiMisiTujuan::query()->orderBy('id')->first();
    return view('website.pages.profile.vision.index', compact('visiMisiTujuan'));
})->name('web.vision');

Route::get('/greeting', function () {
    $kepalaMadrasah = \App\Models\KepalaMadrasah::query()->orderBy('id')->first();
    return view('website.pages.profile.greeting.index', compact('kepalaMadrasah'));
})->name('web.greeting');

Route::get('/organization', function () {
    $strukturOrganisasi = \App\Models\StrukturOrganisasi::query()->orderBy('id')->first();
    $kepalaMadrasah = \App\Models\KepalaMadrasah::query()->orderBy('id')->first();
    return view('website.pages.profile.organization.index', compact('strukturOrganisasi', 'kepalaMadrasah'));
})->name('web.organization');

Route::get('/achievement', function () {
    $achievements = \App\Models\PrestasiSiswa::where('status', 'publish')
        ->orderBy('tanggal', 'desc')
        ->paginate(10);
    return view('website.pages.profile.achievement.index', compact('achievements'));
})->name('web.achievement');

Route::get('/achievement/{prestasiSiswa}', function (\App\Models\PrestasiSiswa $prestasiSiswa) {
    if ($prestasiSiswa->status !== 'publish')
        abort(404);

    $news = \App\Models\Berita::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'news';
            return $item;
        });

    $articles = \App\Models\Artikel::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'article';
            return $item;
        });

    $relatedPosts = $news->concat($articles)->shuffle()->take(3);

    $comments = \App\Models\Komentar::where('konten_tipe', 'achievement')
        ->where('konten_id', $prestasiSiswa->id)
        ->forWebsite()
        ->get();

    \App\Models\Komentar::appendIsLikedStatus($comments);

    return view('website.pages.profile.achievement.detail', ['item' => $prestasiSiswa, 'relatedPosts' => $relatedPosts, 'comments' => $comments]);
})->name('web.achievement.detail');

Route::get('/tags/achievement/{tag}', function (string $tag) {
    $decodedTag = urldecode($tag);

    $posts = \App\Models\PrestasiSiswa::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->whereNotNull('tags')
        ->where('tags', 'like', '%' . $decodedTag . '%')
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.tags.achievement.index', compact('decodedTag', 'posts'));
})->name('web.tags.achievement');

// Halaman Informasi
Route::get('/news', function () {
    $newsPosts = \App\Models\Berita::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.information.news.index', compact('newsPosts'));
})->name('web.news');

Route::get('/news/{berita}', function (Berita $berita) {
    if ($berita->status !== 'publish')
        abort(404);
    if ($berita->tanggal_publikasi && $berita->tanggal_publikasi->isFuture())
        abort(404);

    $post = $berita;
    $news = Berita::where('status', 'publish')
        ->whereKeyNot($berita->id)
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'news';
            return $item;
        });

    $articles = Artikel::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'article';
            return $item;
        });

    $relatedPosts = $news->concat($articles)->shuffle()->take(3);

    $comments = \App\Models\Komentar::where('konten_tipe', 'news')
        ->where('konten_id', $post->id)
        ->forWebsite()
        ->get();

    \App\Models\Komentar::appendIsLikedStatus($comments);

    return view('website.pages.information.news.detail', compact('post', 'relatedPosts', 'comments'));
})->name('web.news.detail');

Route::get('/tags/news/{tag}', function (string $tag) {
    $decodedTag = urldecode($tag);

    $posts = Berita::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->whereNotNull('tags')
        ->where('tags', 'like', '%' . $decodedTag . '%')
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.tags.news.index', compact('decodedTag', 'posts'));
})->name('web.tags.news');

Route::get('/search', function () {
    $q = trim((string) request('q', ''));

    $newsResults = collect();
    $articleResults = collect();
    $announcementResults = collect();
    $agendaResults = collect();

    if ($q !== '') {
        $newsResults = Berita::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->where(function ($query) use ($q) {
                $query->where('judul', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%")
                    ->orWhere('tags', 'like', "%{$q}%");
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->latest('id')
            ->take(20)
            ->get();

        $articleResults = Artikel::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->where(function ($query) use ($q) {
                $query->where('judul', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%")
                    ->orWhere('tags', 'like', "%{$q}%");
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->latest('id')
            ->take(20)
            ->get();

        $announcementResults = \App\Models\Pengumuman::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->where(function ($query) use ($q) {
                $query->where('judul', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%")
                    ->orWhere('tags', 'like', "%{$q}%");
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->latest('id')
            ->take(20)
            ->get();

        $agendaResults = \App\Models\Agenda::where('status', 'publish')
            ->where(function ($query) {
                $query->whereNull('tanggal_publikasi')
                    ->orWhere('tanggal_publikasi', '<=', now());
            })
            ->where(function ($query) use ($q) {
                $query->where('judul', 'like', "%{$q}%")
                    ->orWhere('deskripsi', 'like', "%{$q}%")
                    ->orWhere('lokasi', 'like', "%{$q}%")
                    ->orWhere('tags', 'like', "%{$q}%");
            })
            ->orderBy('tanggal_publikasi', 'desc')
            ->latest('id')
            ->take(20)
            ->get();
    }

    return view('website.pages.search.index', compact('q', 'newsResults', 'articleResults', 'announcementResults', 'agendaResults'));
})->name('web.search');

Route::get('/article', function () {
    $posts = \App\Models\Artikel::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.information.article.index', compact('posts'));
})->name('web.article');

Route::get('/article/{artikel}', function (Artikel $artikel) {
    if ($artikel->status !== 'publish')
        abort(404);
    if ($artikel->tanggal_publikasi && $artikel->tanggal_publikasi->isFuture())
        abort(404);

    $post = $artikel;
    $news = \App\Models\Berita::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'news';
            return $item;
        });

    $articles = \App\Models\Artikel::where('status', 'publish')
        ->whereKeyNot($artikel->id)
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'article';
            return $item;
        });

    $relatedPosts = $news->concat($articles)->shuffle()->take(3);

    $comments = \App\Models\Komentar::where('konten_tipe', 'article')
        ->where('konten_id', $post->id)
        ->forWebsite()
        ->get();

    \App\Models\Komentar::appendIsLikedStatus($comments);

    return view('website.pages.information.article.detail', compact('post', 'relatedPosts', 'comments'));
})->name('web.article.detail');

Route::get('/tags/article/{tag}', function (string $tag) {
    $decodedTag = urldecode($tag);

    $posts = Artikel::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->whereNotNull('tags')
        ->where('tags', 'like', '%' . $decodedTag . '%')
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.tags.article.index', compact('decodedTag', 'posts'));
})->name('web.tags.article');

Route::get('/announcement', function () {
    $pengumuman = \App\Models\Pengumuman::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.information.announcement.index', compact('pengumuman'));
})->name('web.announcement');

Route::get('/announcement/{pengumuman}', function (\App\Models\Pengumuman $pengumuman) {
    if ($pengumuman->status !== 'publish')
        abort(404);
    if ($pengumuman->tanggal_publikasi && $pengumuman->tanggal_publikasi->isFuture())
        abort(404);

    $post = $pengumuman;
    $news = \App\Models\Berita::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'news';
            return $item;
        });

    $articles = \App\Models\Artikel::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'article';
            return $item;
        });

    $relatedPosts = $news->concat($articles)->shuffle()->take(3);

    $comments = \App\Models\Komentar::where('konten_tipe', 'announcement')
        ->where('konten_id', $post->id)
        ->forWebsite()
        ->get();

    \App\Models\Komentar::appendIsLikedStatus($comments);

    return view('website.pages.information.announcement.detail', compact('post', 'relatedPosts', 'comments'));
})->name('web.announcement.detail');

Route::get('/tags/announcement/{tag}', function (string $tag) {
    $decodedTag = urldecode($tag);

    $posts = \App\Models\Pengumuman::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->whereNotNull('tags')
        ->where('tags', 'like', '%' . $decodedTag . '%')
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.tags.announcement.index', compact('decodedTag', 'posts'));
})->name('web.tags.announcement');

Route::get('/agenda', function () {
    $agendas = \App\Models\Agenda::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.information.agenda.index', compact('agendas'));
})->name('web.agenda');

Route::get('/agenda/{agenda}', function (\App\Models\Agenda $agenda) {
    if ($agenda->status !== 'publish')
        abort(404);
    if ($agenda->tanggal_publikasi && $agenda->tanggal_publikasi->isFuture())
        abort(404);

    $post = $agenda;
    $news = \App\Models\Berita::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'news';
            return $item;
        });

    $articles = \App\Models\Artikel::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')->orWhere('tanggal_publikasi', '<=', now());
        })
        ->latest('tanggal_publikasi')
        ->take(3)
        ->get()
        ->map(function ($item) {
            $item->post_type = 'article';
            return $item;
        });

    $relatedPosts = $news->concat($articles)->shuffle()->take(3);

    $comments = \App\Models\Komentar::where('konten_tipe', 'agenda')
        ->where('konten_id', $post->id)
        ->forWebsite()
        ->get();

    \App\Models\Komentar::appendIsLikedStatus($comments);

    return view('website.pages.information.agenda.detail', compact('post', 'relatedPosts', 'comments'));
})->name('web.agenda.detail');

Route::get('/tags/agenda/{tag}', function (string $tag) {
    $decodedTag = urldecode($tag);

    $posts = \App\Models\Agenda::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->whereNotNull('tags')
        ->where('tags', 'like', '%' . $decodedTag . '%')
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);

    return view('website.pages.tags.agenda.index', compact('decodedTag', 'posts'));
})->name('web.tags.agenda');

// Halaman Galeri
Route::get('/foto', function () {
    $photos = Photo::orderBy('urutan', 'asc')
        ->orderBy('tanggal_publikasi', 'desc')
        ->orderBy('id', 'desc')
        ->paginate(20);

    if (request()->ajax()) {
        return view('website.pages.gallery.foto.partial-list', compact('photos'));
    }

    return view('website.pages.gallery.foto.index', compact('photos'));
})->name('web.foto');

Route::get('/video', function () {
    $videos = \App\Models\Video::where('status', 'publish')
        ->where(function ($query) {
            $query->whereNull('tanggal_publikasi')
                ->orWhere('tanggal_publikasi', '<=', now());
        })
        ->orderBy('tanggal_publikasi', 'desc')
        ->latest('id')
        ->paginate(15);
    return view('website.pages.gallery.video.index', compact('videos'));
})->name('web.video');

// Halaman SPMB/PPDB
Route::get('/spmb', function () {
    $spmb = \App\Models\SpmbPpdb::query()->orderBy('id')->first();
    $prestasiSiswa = \App\Models\PrestasiSiswa::where('status', 'publish')
        ->orderBy('tanggal', 'desc')
        ->latest('id')
        ->take(3)
        ->get();

    return view('website.pages.spmb.index', compact('prestasiSiswa', 'spmb'));
})->name('web.spmb');

// Halaman Kontak
Route::get('/contact', function () {
    return view('website.pages.contact.index');
})->name('web.contact');

Route::post('/contact', [\App\Http\Controllers\Website\ContactController::class, 'store'])->name('web.contact.store');

Route::post('/komentar/{type}/{id}', [KomentarController::class, 'store'])
    ->whereIn('type', ['news', 'article', 'announcement', 'agenda', 'achievement'])
    ->whereNumber('id')
    ->name('web.komentar.store');

Route::post('/komentar/{id}/like', [KomentarController::class, 'like'])
    ->whereNumber('id')
    ->name('web.komentar.like');

Route::post('/chatbot', [ChatbotController::class, 'send'])
    ->middleware('throttle:30,1')
    ->name('web.chatbot.send');
