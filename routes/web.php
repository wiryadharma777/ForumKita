<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', [PageController::class, 'index']);

    Route::post('/logout', [AuthController::class, 'logoutProcess']);

    Route::get('/buat-diskusi-baru', [PageController::class, 'buatDiskusiBaru']);

    Route::post('/buat-diskusi-baru', [PageController::class, 'buatDiskusiBaruProcess']);

    Route::get('/detail-diskusi/{id}', [PageController::class, 'detailDiskusi']);

    Route::get('/detail-diskusi/{id}/edit', [PageController::class, 'editDiskusi']);

    Route::post('/detail-diskusi/edit', [PageController::class, 'editDiskusiProcess']);

    Route::post('/detail-diskusi/delete', [PageController::class, 'deleteDiskusiProcess']);

    Route::post('/komentar', [PageController::class, 'komentarProcess']);

    Route::get('/search', [PageController::class, 'searchProcess'])->name('search');

    Route::post('/like', [PageController::class, 'likeProcess']);

    Route::get('/profile', [PageController::class, 'profile']);

    Route::post('/profile/process', [PageController::class, 'profileProcess']);

    Route::post('/reset-password/process', [AuthController::class, 'resetPasswordProcess']);

    Route::get('/dashboard', [PageController::class, 'dashboard']);

    Route::get('/users', [PageController::class, 'users']);

    Route::post('/users/activate-deactivate', [PageController::class, 'usersActivateDeactivate']);

    Route::get('/categories', [PageController::class, 'categories']);

    Route::get('/categories/{id}/edit', [PageController::class, 'editCategory']);

    Route::post('/categories/edit', [PageController::class, 'editCategoryProcess']);

    Route::post('/categories/delete', [PageController::class, 'deleteCategoryProcess']);

    Route::get('/categories/buat-kategori', [PageController::class, 'buatKategori']);

    Route::post('/categories/buat-kategori', [PageController::class, 'buatKategoriProcess']);
});


Route::middleware('guest')->group(function () {
    Route::get('/daftar', [AuthController::class, 'daftar']);
    
    Route::post('/daftar', [AuthController::class, 'daftarProcess']);
    
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    
    Route::post('/login', [AuthController::class, 'loginProcess']);
});
