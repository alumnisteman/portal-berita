<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\LoadMoreController;
use App\Http\Controllers\BookmarkSyncController;
use App\Http\Controllers\Admin\IklanController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\BeritaController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/post/{berita}', [NewsController::class, 'show'])->name('news.show');

Route::get('/bookmarks', function () {
    return view('bookmarks');
})->name('bookmarks');

Route::get('/load-more', [LoadMoreController::class, 'index'])->name('news.loadMore');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/bookmarks/sync', [BookmarkSyncController::class, 'sync'])->name('bookmarks.sync');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Admin Routes
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('berita', BeritaController::class)->parameters(['berita' => 'berita']);
        Route::resource('iklan', IklanController::class);
    });
});

require __DIR__.'/auth.php';


