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

// =====================
// API ROUTES (OPTIONAL)
// Uncomment jika menggunakan API
// =====================
// require __DIR__.'/api.php';
