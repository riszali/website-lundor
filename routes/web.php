<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;

// ==========================================
// 1. PUBLIC ROUTES (HALAMAN DEPAN)
// ==========================================
Route::get('/', function () { return view('pages.home'); });
Route::get('/web-development', function () { return view('pages.web-development'); });
Route::get('/social-media', function () { return view('pages.social-media'); });
Route::get('/uiux-design', function () { return view('pages.uiux-design'); });
Route::get('/animation', function () { return view('pages.animation'); });
Route::get('/about', function () { return view('pages.about'); });
Route::get('/contact', function () { return view('pages.contact'); });
Route::get('/portfolio', function () { return view('pages.portfolio'); });

// ==========================================
// 2. AUTHENTICATION ROUTES (SISTEM LOGIN)
// ==========================================
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ==========================================
// 3. AGENCY PIPELINE ROUTES (DASHBOARD SYSTEM)
// ==========================================
Route::middleware(['auth'])->group(function () {
    
    // --- A. ADMIN / PROJECT MANAGER ---
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('dashboard');
        
        Route::post('/user/create', [DashboardController::class, 'createUser'])->name('user.create');
        Route::post('/blog/create', [DashboardController::class, 'createBlog'])->name('blog.create');
        Route::post('/request/{id}/approve', [DashboardController::class, 'approveRequest'])->name('request.approve');
        Route::post('/task/assign', [DashboardController::class, 'assignTask'])->name('task.assign');
        Route::post('/asset/{id}/review', [DashboardController::class, 'reviewAsset'])->name('asset.review');
        Route::post('/chat/send', [DashboardController::class, 'sendChat'])->name('chat.send');
    });

    // --- B. CLIENT / PARTNER ---
    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'client'])->name('dashboard');
        
        Route::post('/project/request', [DashboardController::class, 'requestProject'])->name('project.request');
        Route::post('/asset/{id}/feedback', [DashboardController::class, 'assetFeedback'])->name('asset.feedback');
        Route::post('/chat/send', [DashboardController::class, 'sendChat'])->name('chat.send');
    });

    // --- C. EDITOR / ARTIST ---
    Route::prefix('editor')->name('editor.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'editor'])->name('dashboard');
        
        Route::get('/task/{id}', [DashboardController::class, 'viewTask'])->name('task.view');
        Route::patch('/task/{id}/status', [DashboardController::class, 'updateTask'])->name('task.update');
        Route::post('/task/{id}/upload', [DashboardController::class, 'uploadAsset'])->name('asset.upload');
        Route::post('/chat/send', [DashboardController::class, 'sendChat'])->name('chat.send');
    });

});