<?php

/**
 * ============================================
 * AUTH ROUTES - Login & Logout
 * ============================================
 */

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;

// Guest only routes
Route::middleware(['guest'])->group(function () {
    // Login page
    Route::get('/auth', [AuthController::class, 'login'])->name('login');

    // Login authentication
    Route::post('/auth/authenticate', [AuthController::class, 'authenticate'])->name('auth.authenticate');
});

// Logout (Authenticated only)
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');