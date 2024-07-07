<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::prefix('')->group(function () {
    Route::get('/', [FrontController::class, 'home'])->name('front.home');

    Route::prefix('berita')->group(function () {
        Route::get('/', [FrontController::class, 'berita'])->name('post');
        Route::get('/{slug}', [FrontController::class, 'readPost'])->name('post.read');
    });

    Route::prefix('pamong')->group(function () {
        Route::get('/', [PamongController::class, 'home'])->name('front.pamong');
        Route::get('/detail/{nik}', [PamongController::class, 'detail'])->name('front.pamong.detail');
    });

    Route::prefix('agenda')->group(function () {
        Route::post('/vcalendar', [AgendaController::class, 'vcalendar'])->name('front.vcalendar');
    });
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
