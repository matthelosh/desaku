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
        Route::get('/{category_id}', [FrontController::class, 'beritaByCategory'])->name('post.category');
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

    Route::prefix("produk")->group(function () {
        Route::get('/', [ProdukController::class, 'home'])->name('front.produk');
    });
    Route::prefix("wisata")->group(function () {
        Route::get('/', [ProdukController::class, 'home'])->name('front.wisata');
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
            Route::post("/store", [LembagaController::class, 'store'])->name('dashboard.lembaga.store');
            Route::delete("/{id}", [LembagaController::class, 'destroy'])->name('dashboard.lembaga.destroy');
            Route::post("/{id}/warga/attach", [LembagaController::class, 'attachMember'])->name('dashboard.lembaga.member.attach');
            Route::post("/{id}/warga/detach", [LembagaController::class, 'detachhMember'])->name('dashboard.lembaga.member.detach');
        });

        Route::prefix('teritorial')->group(function () {
            Route::prefix('dusun')->group(function () {
                Route::post('/store', [DusunController::class, 'store'])->name('dashboard.dusun.store');
                Route::delete('/{id}', [DusunController::class, 'destroy'])->name('dashboard.dusun.destroy');
            });
            Route::prefix('rw')->group(function () {
                Route::post('/store', [RwController::class, 'store'])->name('dashboard.rw.store');
                Route::delete('/{id}', [RwController::class, 'destroy'])->name('dashboard.rw.destroy');
            });
            Route::prefix('rt')->group(function () {
                Route::post('/store', [RtController::class, 'store'])->name('dashboard.rt.store');
                Route::delete('/{id}', [RtController::class, 'destroy'])->name('dashboard.rt.destroy');
            });
        });

        Route::prefix('perangkat')->group(function () {
            Route::get("/", [PamongController::class, 'index'])->name('dashboard.pamong');
        });
        Route::prefix('warga')->group(function () {
            Route::get("/", [WargaController::class, 'home'])->name('dashboard.warga');
            Route::post("/", [WargaController::class, 'index'])->name('dashboard.warga.index');
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
