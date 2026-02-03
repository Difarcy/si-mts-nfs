<?php

/**
 * ============================================
 * WEB ROUTES - Main Entry Point
 * ============================================
 * File ini adalah entry point utama untuk semua routes
 * Routes dipisah berdasarkan kategori untuk kemudahan maintenance
 */

use Illuminate\Support\Facades\Route;

// =====================
// WEBSITE ROUTES
// Halaman publik yang bisa diakses semua orang
// =====================
require __DIR__ . '/website.php';

// =====================
// AUTH ROUTES
// Login, logout, dan autentikasi
// =====================
require __DIR__ . '/auth.php';

// =====================
// ADMIN ROUTES
// Panel admin (protected dengan middleware auth)
// =====================
require __DIR__ . '/admin.php';

// SEMENTARA: Route untuk menjalankan migrasi via browser
// Hapus bagian ini setelah migrasi berhasil dijalankan!
Route::get('/setup-db-migrasi-rahasia-123', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate:fresh', [
            '--seed' => true,
            '--force' => true
        ]);
        return 'Migrasi & Seed BERHASIL! Database sudah siap. Silakan coba login admin.';
    } catch (\Exception $e) {
        return 'Migrasi GAGAL: ' . $e->getMessage();
    }
});

// =====================
// API ROUTES (OPTIONAL)
// Uncomment jika menggunakan API
// =====================
// require __DIR__.'/api.php';