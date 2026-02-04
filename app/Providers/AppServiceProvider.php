<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // --- AUTO-FIX STORAGE LINK (Cloud/Deployment Helper) ---
        // Checks if public/storage symlink is missing and creates it automatically.
        // This avoids the need to run "php artisan storage:link" manually after deployment.
        if (!app()->runningInConsole()) {
            $target = storage_path('app/public');
            $link = public_path('storage');

            if (!file_exists($link)) {
                try {
                    // Ensure target directory exists
                    if (!is_dir($target)) {
                        mkdir($target, 0755, true);
                    }
                    // Create symlink
                    symlink($target, $link);
                } catch (\Exception $e) {
                    // Silent fail or log if needed
                    // Log::warning('Auto-symlink failed: ' . $e->getMessage());
                }
            }
        }

        // Dynamically register components for website and admin to follow the 2-folder rule
        $this->registerComponents('website');
        $this->registerComponents('admin');

        // View Composers for Website Widgets (with cache)
        view()->composer('website.components.content.*', function ($view) {
            // Skip jika berjalan di console (build process)
            if (app()->runningInConsole()) {
                return;
            }

            try {
                // Latest News (cached for 60 minutes)
                $view->with('latestNewsWidget', Cache::remember('widget.latest_news', 3600, function () {
                    return \App\Models\Berita::where('status', 'publish')
                        ->where(function ($query) {
                            $query->whereNull('tanggal_publikasi')
                                ->orWhere('tanggal_publikasi', '<=', now());
                        })
                        ->orderBy('tanggal_publikasi', 'desc')
                        ->latest('id')
                        ->take(5)
                        ->get();
                }));

                // Latest Articles (cached for 60 minutes)
                $view->with('latestArticlesWidget', Cache::remember('widget.latest_articles', 3600, function () {
                    return \App\Models\Artikel::where('status', 'publish')
                        ->where(function ($query) {
                            $query->whereNull('tanggal_publikasi')
                                ->orWhere('tanggal_publikasi', '<=', now());
                        })
                        ->orderBy('tanggal_publikasi', 'desc')
                        ->latest('id')
                        ->take(5)
                        ->get();
                }));

                // Latest Announcements (infoTerkini) (cached for 60 minutes)
                $view->with('infoTerkiniWidget', Cache::remember('widget.latest_announcements', 3600, function () {
                    return \App\Models\Pengumuman::where('status', 'publish')
                        ->where(function ($query) {
                            $query->whereNull('tanggal_publikasi')
                                ->orWhere('tanggal_publikasi', '<=', now());
                        })
                        ->orderBy('tanggal_publikasi', 'desc')
                        ->latest('id')
                        ->take(5)
                        ->get();
                }));

                // Latest Agendas (agendaTerbaru) (cached for 60 minutes)
                $view->with('agendaTerbaruWidget', Cache::remember('widget.latest_agendas', 3600, function () {
                    return \App\Models\Agenda::where('status', 'publish')
                        ->where(function ($query) {
                            $query->whereNull('tanggal_publikasi')
                                ->orWhere('tanggal_publikasi', '<=', now());
                        })
                        ->orderBy('tanggal_publikasi', 'desc')
                        ->latest('id')
                        ->take(5)
                        ->get();
                }));
            } catch (\Exception $e) {
                // Fail-safe: jika database belum siap, return collection kosong
                // Log::error('Widget View Composer Error: ' . $e->getMessage());
                $view->with('latestNewsWidget', collect());
                $view->with('latestArticlesWidget', collect());
                $view->with('infoTerkiniWidget', collect());
                $view->with('agendaTerbaruWidget', collect());
            }
        });

        // Global Logo (cached for 60 minutes)
        view()->composer('*', function ($view) {
            try {
                if (app()->runningInConsole()) {
                     $view->with('websiteLogo', url('images/logo/logo.png'));
                     $view->with('mediaSosial', null);
                     $view->with('socialLinks', []);
                     return;
                }
                
                $logoData = Cache::remember('global.logo', 3600, function () {
                    $logo = \App\Models\Logo::first();
                    $logoUrl = url('images/logo/logo.png'); // default

                    if ($logo && $logo->path && is_string($logo->path) && !empty(trim($logo->path))) {
                        if (str_starts_with($logo->path, 'images/')) {
                            $logoUrl = url($logo->path);
                        } else {
                            // Pastikan path storage bersih
                            $cleanPath = ltrim($logo->path, '/');
                            $logoUrl = url('storage/' . $cleanPath);
                        }
                    }

                    return $logoUrl;
                });

                $view->with('websiteLogo', $logoData);

                $socialData = Cache::remember('global.social_media', 3600, function () {
                    $mediaSosial = \App\Models\MediaSosial::first();

                    $cleanLink = function ($link) {
                        if (empty($link) || trim($link) === '' || trim($link) === '#') {
                            return null;
                        }
                        return $link;
                    };

                    return [
                        'mediaSosial' => $mediaSosial,
                        'socialLinks' => [
                            'facebook' => $cleanLink($mediaSosial?->facebook),
                            'instagram' => $cleanLink($mediaSosial?->instagram),
                            'x' => $cleanLink($mediaSosial?->x),
                            'twitter' => $cleanLink($mediaSosial?->x),
                            'youtube' => $cleanLink($mediaSosial?->youtube),
                            'tiktok' => $cleanLink($mediaSosial?->tiktok),
                        ],
                    ];
                });

                $view->with('mediaSosial', $socialData['mediaSosial']);
                $view->with('socialLinks', $socialData['socialLinks']);
            } catch (\Exception $e) {
                // Fail-safe: jika terjadi error apapun, gunakan logo default
                // Log::error('Logo View Composer Error: ' . $e->getMessage()); // Suppress log agar tidak spam saat build
                $view->with('websiteLogo', url('images/logo/logo.png'));
                $view->with('mediaSosial', null);
                $view->with('socialLinks', [
                    'facebook' => null,
                    'instagram' => null,
                    'x' => null,
                    'twitter' => null,
                    'youtube' => null,
                    'tiktok' => null,
                ]);
            }
        });

        // Global Kontak (Footer & Contact Page) (cached for 60 minutes)
        view()->composer([
            'website.components.layout.topbar',
            'website.components.layout.footer',
            'website.pages.contact.index',
            'website.pages.spmb.*',
        ], function ($view) {
            // Skip jika berjalan di console (build process)
            if (app()->runningInConsole()) {
                return;
            }

            try {
                $kontak = Cache::remember('global.kontak', 3600, function () {
                    return \App\Models\Kontak::first();
                });
                $view->with('kontak', $kontak);
            } catch (\Exception $e) {
                // Log::error('Kontak View Composer Error: ' . $e->getMessage());
                $view->with('kontak', null);
            }
        });
    }

    /**
     * Helper to register components from a specific module folder
     */
    protected function registerComponents(string $module): void
    {
        $path = resource_path("views/{$module}/components");
        if (!is_dir($path))
            return;

        $buildMap = function () use ($path, $module) {
            $map = [];
            $files = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($path));

            foreach ($files as $file) {
                if (!$file->isFile() || !str_ends_with($file->getFilename(), '.blade.php')) {
                    continue;
                }

                $filePath = $file->getPathname();
                $relativePart = substr($filePath, strlen($path) + 1);
                $componentName = str_replace('.blade.php', '', $relativePart);
                $componentDots = str_replace([DIRECTORY_SEPARATOR, '/'], '.', $componentName);
                $viewPath = "{$module}.components.{$componentDots}";

                $map["{$module}.{$componentDots}"] = $viewPath;
                $map["{$module}.components.{$componentDots}"] = $viewPath;
            }

            return $map;
        };

        if (app()->environment('local')) {
            $components = $buildMap();
        } else {
            try {
                $cacheKey = "blade.components.map.{$module}";
                $components = Cache::rememberForever($cacheKey, $buildMap);
            } catch (\Exception $e) {
                // Fallback: jika cache/database belum siap (misal saat build/deploy),
                // jalankan buildMap secara langsung tanpa error.
                $components = $buildMap();
            }
        }

        foreach ($components as $tag => $viewPath) {
            Blade::component($viewPath, $tag);
        }
    }
}
