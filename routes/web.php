<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('')->group(function () {
    Route::get('/', [FrontController::class, 'home'])->name('front.home');

    Route::prefix('profil')->group(function () {
        Route::get('/', [FrontController::class, 'profil'])->name('front.profil');
        Route::get('/{category_id}', [FrontController::class, 'profilePage'])->name('front.profil.page');
    });

    Route::prefix('berita')->group(function () {
        Route::get('/', [FrontController::class, 'berita'])->name('post');
        Route::get('/{slug}', [FrontController::class, 'readPost'])->name('post.read');
    });
    Route::prefix('info')->group(function () {
        Route::get('/', [FrontController::class, 'info'])->name('info');
        Route::get('/{slug}', [FrontController::class, 'readPost'])->name('info.read');
    });

    Route::prefix('pamong')->group(function () {
        Route::get('/', [PamongController::class, 'home'])->name('front.pamong');
        Route::get('/detail/{nik}', [PamongController::class, 'detail'])->name('front.pamong.detail');
    });

    Route::prefix('agenda')->group(function () {
        Route::post('/vcalendar', [AgendaController::class, 'vcalendar'])->name('front.vcalendar');
        Route::delete('/{id}', [AgendaController::class, 'destroy'])->name('dashboard.agenda.destroy');
        Route::post('/store', [AgendaController::class, 'store'])->name('dashboard.agenda.store');
    });
});



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('dashboard')->group(function () {
        Route::get('/', [DashboardController::class, 'home'])->name('dashboard');

        Route::prefix('identitas')->group(function () {
            Route::get("/", [IdentitasController::class, 'home'])->name('dashboard.identitas');
        });
        Route::prefix('lembaga')->group(function () {
            Route::get("/", [LembagaController::class, 'index'])->name('dashboard.lembaga');
        });

        Route::prefix('perangkat')->group(function () {
            Route::get("/", [PamongController::class, 'index'])->name('dashboard.pamong');
        });
        Route::prefix('warga')->group(function () {
            Route::get("/", [WargaController::class, 'index'])->name('dashboard.warga');
            Route::post("/store", [WargaController::class, 'store'])->name('dashboard.warga.store');
            Route::get('/alamat', [WargaController::class, 'alamat'])->name('dashboard.warga.alamat');
            Route::delete("/{id}", [WargaController::class, 'destroy'])->name('dashboard.warga.destroy');
        });
        Route::prefix('agenda')->group(function () {
            Route::get("/", [AgendaController::class, 'index'])->name('dashboard.agenda');
        });



        Route::prefix('berita')->group(function () {
            Route::get("/", [PostController::class, 'index'])->name('dashboard.post');
            Route::post('/store', [PostController::class, 'store'])->name('dashboard.post.store');
            Route::delete('/{id}', [PostController::class, 'destroy'])->name('dashboard.post.destroy');
            Route::post('/image/upload', [PostController::class, 'uploadImage'])->name('dashboard.post.image.upload');
            Route::post('/category/index', [PostController::class, 'kategori'])->name('dashboard.post.category.index');
        });
        Route::prefix('usaha')->group(function () {
            Route::get("/", [BusinessController::class, 'home'])->name('dashboard.bisnis');
            Route::post("/store", [BusinessController::class, 'store'])->name('dashboard.bisnis.store');
            Route::delete("/{id}", [BusinessController::class, 'destroy'])->name('dashboard.bisnis.destroy');
        });
        Route::prefix('produk')->group(function () {
            Route::get("/", [ProdukController::class, 'home'])->name('dashboard.produk');
            Route::post("/store", [ProdukController::class, 'store'])->name('dashboard.produk.store');
            Route::delete("/{id}", [ProdukController::class, 'destroy'])->name('dashboard.produk.destroy');
        });
        Route::prefix('wisata')->group(function () {
            Route::get("/", [ProdukController::class, 'home'])->name('dashboard.wisata');
        });
    })->middleware(['auth', 'verified']);
});

require __DIR__ . '/auth.php';
