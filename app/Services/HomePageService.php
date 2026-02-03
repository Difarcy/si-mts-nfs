<?php

namespace App\Services;

use App\Models\Berita;
use App\Models\Artikel;
use App\Models\PrestasiSiswa;
use App\Models\Photo;
use App\Models\Video;
use App\Models\Hero;
use App\Models\BannerPromosi;
use App\Models\Banner;
use App\Models\Pengumuman;
use App\Models\Agenda;
use Illuminate\Support\Facades\Cache;

class HomePageService
{
    /**
     * Cache duration dalam menit
     * Sesuaikan dengan kebutuhan - semakin lama cache, semakin cepat loading
     */
    const CACHE_DURATION = 5; // 5 menit

    /**
     * Get all homepage data dengan caching
     */
    public function getHomePageData()
    {
        return Cache::remember('homepage_data', self::CACHE_DURATION * 60, function () {
            return [
                'hero' => $this->getHero(),
                'promosiBannerPath' => $this->getPromoBannerPath(),
                'banners' => $this->getBanners(),
                'highlightNews' => $this->getHighlightNews(),
                'latestNews' => $this->getLatestNews(),
                'latestArticles' => $this->getLatestArticles(),
                'prestasiSiswa' => $this->getPrestasiSiswa(),
                'fotoKegiatan' => $this->getFotoKegiatan(),
                'videoKegiatan' => $this->getVideoKegiatan(),
                'tickerItems' => $this->getTickerItems(),
            ];
        });
    }

    /**
     * Get Hero Section
     */
    private function getHero()
    {
        return Hero::first();
    }

    /**
     * Get Banner Promosi Path
     */
    private function getPromoBannerPath()
    {
        $bannerPromosi = BannerPromosi::first();
        return $bannerPromosi ? $bannerPromosi->path : null;
    }

    /**
     * Get Active Banners
     */
    private function getBanners()
    {
        return Banner::where('is_active', true)
            ->orderBy('urutan', 'asc')
            ->get();
    }

    /**
     * Get Berita Highlight (yang dicentang "Jadikan Highlight")
     */
    private function getHighlightNews()
    {
        return Berita::published()
            ->highlight()
            ->latestPublished()
            ->take(5)
            ->get();
    }

    /**
     * Get Berita Terbaru
     */
    private function getLatestNews()
    {
        return Berita::published()
            ->latestPublished()
            ->take(4)
            ->get();
    }

    /**
     * Get Artikel Terbaru
     */
    private function getLatestArticles()
    {
        return Artikel::published()
            ->latestPublished()
            ->take(4)
            ->get();
    }

    /**
     * Get Prestasi Siswa Terbaru
     */
    private function getPrestasiSiswa()
    {
        return PrestasiSiswa::published()
            ->orderBy('tanggal', 'desc')
            ->take(4)
            ->get();
    }

    /**
     * Get Foto Kegiatan Terbaru
     */
    private function getFotoKegiatan()
    {
        return Photo::orderBy('tanggal_publikasi', 'desc')
            ->take(12)
            ->get();
    }

    /**
     * Get Video Kegiatan Terbaru
     */
    private function getVideoKegiatan()
    {
        return Video::published()
            ->latestPublished()
            ->take(6)
            ->get();
    }

    /**
     * Get Ticker Items (News, Articles, Announcements, Agendas)
     */
    private function getTickerItems()
    {
        $tickerNews = Berita::published()
            ->latest('tanggal_publikasi')
            ->take(2)
            ->pluck('judul');

        $tickerArticles = Artikel::published()
            ->latest('tanggal_publikasi')
            ->take(1)
            ->pluck('judul');

        $tickerAnnouncements = Pengumuman::published()
            ->latest('tanggal_publikasi')
            ->take(1)
            ->pluck('judul');

        $tickerAgendas = Agenda::published()
            ->latest('tanggal_publikasi')
            ->take(1)
            ->pluck('judul');

        return $tickerNews->concat($tickerArticles)
            ->concat($tickerAnnouncements)
            ->concat($tickerAgendas);
    }

    /**
     * Clear homepage cache
     * Panggil method ini setiap kali ada perubahan data
     */
    public static function clearCache()
    {
        Cache::forget('homepage_data');
    }
}
