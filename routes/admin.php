<?php

/**
 * ============================================
 * ADMIN ROUTES - Panel Admin (Protected)
 * ============================================
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\LogoController;
use App\Http\Controllers\Admin\KontakController;
use App\Http\Controllers\Admin\MediaSosialController;
use App\Http\Controllers\Admin\SpmbPpdbController;
use App\Http\Controllers\Admin\PhotoController;
use App\Http\Controllers\Admin\VideoController;
use App\Http\Controllers\Admin\InboxController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\HelpController;
use App\Http\Controllers\Admin\SchoolProfileController;

// ========================================
// PUBLIC ACCESS TO PDF PREVIEWER (Used by Website & Admin)
// ========================================
Route::get('/pdf-preview', function () {
    return view('admin.pages.utilities.pdf-preview');
})->name('admin.pdf-preview');

Route::get('/serve-pdf', function () {
    $path = request()->get('path');
    if (!$path)
        abort(404, 'File path not provided');
    
    // Security: Sanitize path to prevent directory traversal
    $path = str_replace(['storage/', 'public/'], '', $path);
    $path = ltrim($path, '/');
    
    // Prevent directory traversal attacks
    if (str_contains($path, '..') || str_contains($path, '\\')) {
        abort(403, 'Invalid file path');
    }
    
    $fullPath = storage_path('app/public/' . $path);
    
    // Ensure file exists and is within allowed directory
    if (!file_exists($fullPath) || !is_file($fullPath)) {
        abort(404, 'File not found');
    }
    
    // Ensure file is within storage/app/public directory
    $realPath = realpath($fullPath);
    $allowedPath = realpath(storage_path('app/public'));
    if (!$realPath || !str_starts_with($realPath, $allowedPath)) {
        abort(403, 'Access denied');
    }
    
    // Verify it's a PDF file
    $mimeType = mime_content_type($realPath);
    if ($mimeType !== 'application/pdf') {
        abort(403, 'Invalid file type');
    }

    return response()->file($realPath, [
        'Content-Type' => 'application/pdf',
        'Content-Disposition' => 'inline; filename="' . basename($realPath) . '"',
    ]);
})->name('admin.serve-pdf');

Route::middleware(['auth', 'admin.idle'])->prefix('admin')->name('admin.')->group(function () {
    // ========================================
    // DASHBOARD
    // ========================================
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // ========================================
    // KONTEN
    // ========================================
    Route::prefix('konten')->name('konten.')->group(function () {
        // News
        Route::get('/berita', [App\Http\Controllers\Admin\NewsController::class, 'index'])->name('berita.index');
        Route::get('/berita/create', [App\Http\Controllers\Admin\NewsController::class, 'create'])->name('berita.create');
        Route::post('/berita/create', [App\Http\Controllers\Admin\NewsController::class, 'store'])->name('berita.store');
        Route::get('/berita/{id}/edit', [App\Http\Controllers\Admin\NewsController::class, 'edit'])->name('berita.edit');
        Route::put('/berita/{id}', [App\Http\Controllers\Admin\NewsController::class, 'update'])->name('berita.update');
        Route::delete('/berita/{id}', [App\Http\Controllers\Admin\NewsController::class, 'destroy'])->name('berita.destroy');

        Route::get('/artikel', [App\Http\Controllers\Admin\ArticleController::class, 'index'])->name('artikel.index');
        Route::get('/artikel/create', [App\Http\Controllers\Admin\ArticleController::class, 'create'])->name('artikel.create');
        Route::post('/artikel/create', [App\Http\Controllers\Admin\ArticleController::class, 'store'])->name('artikel.store');
        Route::get('/artikel/{id}/edit', [App\Http\Controllers\Admin\ArticleController::class, 'edit'])->name('artikel.edit');
        Route::put('/artikel/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'update'])->name('artikel.update');
        Route::delete('/artikel/{id}', [App\Http\Controllers\Admin\ArticleController::class, 'destroy'])->name('artikel.destroy');

        Route::get('/pengumuman', [App\Http\Controllers\Admin\AnnouncementController::class, 'index'])->name('pengumuman.index');
        Route::get('/pengumuman/create', [App\Http\Controllers\Admin\AnnouncementController::class, 'create'])->name('pengumuman.create');
        Route::post('/pengumuman/create', [App\Http\Controllers\Admin\AnnouncementController::class, 'store'])->name('pengumuman.store');
        Route::get('/pengumuman/{id}/edit', [App\Http\Controllers\Admin\AnnouncementController::class, 'edit'])->name('pengumuman.edit');
        Route::put('/pengumuman/{id}', [App\Http\Controllers\Admin\AnnouncementController::class, 'update'])->name('pengumuman.update');
        Route::delete('/pengumuman/{id}', [App\Http\Controllers\Admin\AnnouncementController::class, 'destroy'])->name('pengumuman.destroy');

        Route::get('/agenda', [App\Http\Controllers\Admin\AgendaController::class, 'index'])->name('agenda.index');
        Route::get('/agenda/create', [App\Http\Controllers\Admin\AgendaController::class, 'create'])->name('agenda.create');
        Route::post('/agenda/create', [App\Http\Controllers\Admin\AgendaController::class, 'store'])->name('agenda.store');
        Route::get('/agenda/{id}/edit', [App\Http\Controllers\Admin\AgendaController::class, 'edit'])->name('agenda.edit');
        Route::put('/agenda/{id}', [App\Http\Controllers\Admin\AgendaController::class, 'update'])->name('agenda.update');
        Route::delete('/agenda/{id}', [App\Http\Controllers\Admin\AgendaController::class, 'destroy'])->name('agenda.destroy');

        Route::get('/prestasi-siswa', [App\Http\Controllers\Admin\AchievementController::class, 'index'])->name('prestasi-siswa.index');
        Route::get('/prestasi-siswa/create', [App\Http\Controllers\Admin\AchievementController::class, 'create'])->name('prestasi-siswa.create');
        Route::post('/prestasi-siswa/create', [App\Http\Controllers\Admin\AchievementController::class, 'store'])->name('prestasi-siswa.store');
        Route::get('/prestasi-siswa/{id}/edit', [App\Http\Controllers\Admin\AchievementController::class, 'edit'])->name('prestasi-siswa.edit');
        Route::put('/prestasi-siswa/{id}', [App\Http\Controllers\Admin\AchievementController::class, 'update'])->name('prestasi-siswa.update');
        Route::delete('/prestasi-siswa/{id}', [App\Http\Controllers\Admin\AchievementController::class, 'destroy'])->name('prestasi-siswa.destroy');
    });

    Route::get('/spmb', [SpmbPpdbController::class, 'index'])->name('spmb.index');
    Route::post('/spmb', [SpmbPpdbController::class, 'update'])->name('spmb.update');

    Route::prefix('profil')->name('profil.')->group(function () {
        Route::get('/tentang-sekolah', [SchoolProfileController::class, 'about'])->name('about');
        Route::post('/tentang-sekolah', [SchoolProfileController::class, 'updateAbout'])->name('about.update');

        Route::get('/visi-misi-tujuan', [SchoolProfileController::class, 'vision'])->name('vision');
        Route::post('/visi-misi-tujuan', [SchoolProfileController::class, 'updateVision'])->name('vision.update');

        Route::get('/kepala-madrasah', [SchoolProfileController::class, 'greeting'])->name('greeting');
        Route::post('/kepala-madrasah', [SchoolProfileController::class, 'updateGreeting'])->name('greeting.update');

        Route::get('/struktur-organisasi', [SchoolProfileController::class, 'organization'])->name('organization');
        Route::post('/struktur-organisasi', [SchoolProfileController::class, 'updateOrganization'])->name('organization.update');
    });

    // ========================================
    // INTERAKSI
    // ========================================
    Route::prefix('interaksi')->name('interaksi.')->group(function () {
        Route::get('/pesan-masuk', [InboxController::class, 'index'])->name('pesan-masuk.index');
        Route::get('/pesan-masuk/{id}', [InboxController::class, 'show'])->name('pesan-masuk.show');
        Route::delete('/pesan-masuk/{id}', [InboxController::class, 'destroy'])->name('pesan-masuk.destroy');
        Route::put('/pesan-masuk/{id}/read', [InboxController::class, 'markAsRead'])->name('pesan-masuk.mark-read');
        Route::put('/pesan-masuk/{id}/unread', [InboxController::class, 'markAsUnread'])->name('pesan-masuk.mark-unread');
        Route::put('/pesan-masuk/mark-all-read', [InboxController::class, 'markAllRead'])->name('pesan-masuk.mark-all-read');

        // Bulk Actions
        Route::post('/pesan-masuk/bulk-delete', [InboxController::class, 'bulkDestroy'])->name('pesan-masuk.bulk-destroy');
        Route::post('/pesan-masuk/bulk-status', [InboxController::class, 'bulkStatus'])->name('pesan-masuk.bulk-status');

        Route::get('/komentar', [CommentController::class, 'index'])->name('komentar.index');
        Route::get('/komentar/{id}', [CommentController::class, 'show'])->name('komentar.show');
        Route::post('/komentar/{id}/reply', [CommentController::class, 'reply'])->name('komentar.reply');
        Route::put('/komentar/{id}/like', [CommentController::class, 'toggleLike'])->name('komentar.like');
        Route::delete('/komentar/{id}', [CommentController::class, 'destroy'])->name('komentar.destroy');

        Route::put('/komentar/{id}/read', [CommentController::class, 'markAsRead'])->name('komentar.mark-read');
        Route::put('/komentar/{id}/unread', [CommentController::class, 'markAsUnread'])->name('komentar.mark-unread');

        Route::put('/komentar/{id}/approved', [CommentController::class, 'markAsApproved'])->name('komentar.mark-approved');
        Route::put('/komentar/{id}/pending', [CommentController::class, 'markAsPending'])->name('komentar.mark-pending');

        Route::post('/komentar/bulk-read', [CommentController::class, 'bulkRead'])->name('komentar.bulk-read');
        Route::put('/komentar/mark-all-read', [CommentController::class, 'markAllRead'])->name('komentar.mark-all-read');
        Route::put('/komentar/approve-all', [CommentController::class, 'approveAll'])->name('komentar.approve-all');

        Route::post('/komentar/bulk-delete', [CommentController::class, 'bulkDestroy'])->name('komentar.bulk-destroy');
        Route::post('/komentar/bulk-status', [CommentController::class, 'bulkStatus'])->name('komentar.bulk-status');
    });

    // ========================================
    // MEDIA
    // ========================================
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/foto', [PhotoController::class, 'index'])->name('foto.index');
        Route::post('/foto', [PhotoController::class, 'store'])->name('foto.store');
        Route::post('/foto/sort', [PhotoController::class, 'updateOrder'])->name('foto.sort');
        Route::delete('/foto/{id}', [PhotoController::class, 'destroy'])->name('foto.destroy');
        Route::get('/video', [VideoController::class, 'index'])->name('video.index');
        Route::get('/video/create', [VideoController::class, 'create'])->name('video.create');
        Route::post('/video', [VideoController::class, 'store'])->name('video.store');
        Route::get('/video/{id}/edit', [VideoController::class, 'edit'])->name('video.edit');
        Route::put('/video/{id}', [VideoController::class, 'update'])->name('video.update');
        Route::delete('/video/{id}', [VideoController::class, 'destroy'])->name('video.destroy');
    });

    // ========================================
    // SETTING & HELP
    // ========================================
    // ========================================
    // SETTING
    // ========================================
    Route::prefix('pengaturan')->name('pengaturan.')->group(function () {
        Route::get('/logo', [LogoController::class, 'index'])->name('logo');
        Route::post('/logo', [LogoController::class, 'store'])->name('logo.update');
        Route::get('/banner', [App\Http\Controllers\Admin\BannerController::class, 'index'])->name('banner.index');
        Route::post('/banner', [App\Http\Controllers\Admin\BannerController::class, 'store'])->name('banner.store');
        Route::get('/hero', [App\Http\Controllers\Admin\HeroController::class, 'index'])->name('hero');
        Route::post('/hero', [App\Http\Controllers\Admin\HeroController::class, 'update'])->name('hero.update');
        Route::get('/promotion-banner', [App\Http\Controllers\Admin\PromotionBannerController::class, 'index'])->name('promotion-banner');
        Route::post('/promotion-banner', [App\Http\Controllers\Admin\PromotionBannerController::class, 'store'])->name('promotion-banner.update');
        Route::get('/kontak', [KontakController::class, 'index'])->name('kontak');
        Route::post('/kontak', [KontakController::class, 'update'])->name('kontak.update');
        Route::get('/social-media', [MediaSosialController::class, 'index'])->name('social-media');
        Route::post('/social-media', [MediaSosialController::class, 'update'])->name('social-media.update');
    });

    // ========================================
    // ACCOUNT & HELP
    // ========================================
    Route::view('/bantuan', 'admin.pages.help.index')->name('bantuan.index');
    Route::view('/ubah-username', 'admin.pages.account.change-username')->name('ubah-username.index');
    Route::post('/ubah-username', [AuthController::class, 'updateUsername'])->name('ubah-username.update');
    Route::view('/ubah-password', 'admin.pages.account.change-password')->name('ubah-password.index');
    Route::post('/ubah-password', [AuthController::class, 'updatePassword'])->name('ubah-password.update');

    // ========================================
    // LOGOUT
    // ========================================
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Redirect root admin to dashboard
Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'admin.idle']);
