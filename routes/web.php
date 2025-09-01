<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Berita\BeritaController;
use App\Http\Controllers\Berita\KategoriController;
use App\Http\Controllers\Berita\TagController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\UserController;

Route::view('/profil', 'profil');


Route::get('/', [HomePageController::class, 'index'])->name('index');
Route::get('/berita/{slug}', [HomePageController::class, 'showBerita'])->name('berita.show');
Route::get('/kategori/list', [KategoriController::class, 'list'])->name('kategori.list');

// Log-in
Route::get('/login', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'store']);

// Register
Route::get('/register', [RegisterController::class, 'showRegister'])->name('register.showForm');
Route::post('/register', [RegisterController::class, 'store'])->name('register.log');

Route::middleware(['auth'])->group(function () {
    // Logout
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // Berita Route
    Route::get('admin/berita/dashboard', [DashboardController::class, 'data'])->name('berita.dashboard');

    Route::get('admin/berita/create', [BeritaController::class, 'showFormCreate'])->name('berita.formCreate');
    Route::post('admin/berita/create', [BeritaController::class, 'createData'])->name('berita.create');

    Route::get('admin/berita/edit/{id}', [BeritaController::class, 'showFormEdit'])->name('berita.formEdit');
    Route::put('admin/berita/{id}', [BeritaController::class, 'updateData'])->name('berita.update');

    Route::delete('admin/berita/{id}', [BeritaController::class, 'deleteData'])->name('berita.deleteData');
    // Berita Route End

    // Kategori
    Route::resource('kategori', KategoriController::class);
    Route::get('kategori/{kategori}/tags', [KategoriController::class, 'getTags']);

    // Tag
    Route::resource('tags', TagController::class);
});
