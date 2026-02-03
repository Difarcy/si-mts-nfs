<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Pesan;

class DashboardController extends Controller
{
    public function index()
    {
        // Optimasi: Gunakan cache untuk statistik (cache 5 menit)
        $stats = \Illuminate\Support\Facades\Cache::remember('dashboard.stats', 300, function () {
            return [
                'news_publish' => \App\Models\Berita::where('status', 'publish')->count(),
                'news_draft' => \App\Models\Berita::where('status', 'draft')->count(),
                'article_publish' => \App\Models\Artikel::where('status', 'publish')->count(),
                'article_draft' => \App\Models\Artikel::where('status', 'draft')->count(),
                'comments_pending' => \App\Models\Komentar::where('status', 'pending')->count(),
                'messages_new' => Pesan::where('status', 'unread')->count(),
            ];
        });

        $data = [
            'stats' => (object) $stats,
            'agenda' => \App\Models\Agenda::orderBy('tanggal_mulai', 'asc')->take(5)->get(),
            'pesan_terbaru' => Pesan::where('status', 'unread')->orderBy('tanggal', 'desc')->take(5)->get(),
            'komentar_terbaru' => \App\Models\Komentar::where('status', 'pending')->orderBy('tanggal', 'desc')->take(5)->get(),
        ];

        return view('admin.pages.dashboard.index', $data);
    }
}
