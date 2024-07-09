<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Services\AgendaService;
use App\Services\PamongService;
use App\Services\PostService;
use App\Services\ProdukService;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

class FrontController extends Controller
{
    public function home(
        Request $request,
        PostService $postService,
        ProdukService $produkService,
        AgendaService $agendaService,
        PamongService $pamongService
    ) {
        try {
            return Inertia::render('Welcome', [
                'canLogin' => Route::has('login'),
                'canRegister' => Route::has('register'),
                'products' => $produkService->home($request),
                'agendas' => $agendaService->home($request),
                'posts' => $postService->home($request),
                'infos' => $postService->infos($request),
                'pamongs' => $pamongService->home($request),
                'laravelVersion' => Application::VERSION,
                'phpVersion' => PHP_VERSION,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function profil(Request $request)
    {
        try {
            return Inertia::render('Depan/Profil/Index', [
                'posts' => Post::whereType('page')->get()
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function profilePage(Request $request, $category_id)
    {
        try {
            return Inertia::render('Depan/Profil/Read', [
                'post' => Post::whereType('page')->whereCategoryId($category_id)->first(),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function berita(Request $request)
    {
        try {
            return Inertia::render('Depan/Berita', [
                'posts' => Post::all()
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function readPost(Request $request, $slug)
    {
        try {
            $post = Post::whereSlug($slug)->first();

            return Inertia::render('Depan/ReadPost', [
                'post' => $post,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
