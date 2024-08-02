<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Wisata;
use App\Services\AgendaService;
use App\Services\PamongService;
use App\Services\PostService;
use App\Services\ProdukService;
use App\Services\WisataService;
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
        PamongService $pamongService,
        WisataService $wisataService
    ) {
        try {
            return
                Inertia::render(
                    'Welcome',
                    [
                        'canLogin' => Route::has('login'),
                        'canRegister' => Route::has('register'),
                        'products' => $produkService->home($request),
                        'agendas' => $agendaService->home($request),
                        'posts' => $postService->home($request),
                        'infos' => $postService->infos($request),
                        'pamongs' => $pamongService->home($request),
                        'wisatas' => $wisataService->home($request),
                        'laravelVersion' => Application::VERSION,
                        'phpVersion' => PHP_VERSION,
                    ]
                )
                    ->withViewData(
                        [
                            'meta' => [
                                'title' => 'Pemerintah Desa Samar Tulungagung',
                                'description' => 'Website Resmi Pemerintah Desa Samar Tulungagung',
                                'image' => asset('img/kantor.jpg'),
                            ]
                        ]
                    );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function profil(Request $request)
    {
        try {
            return
                Inertia::render(
                    'Depan/Profil/Index',
                    [
                        'posts' => Post::whereType('page')
                            ->get(),
                    ]
                );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function profilePage(Request $request, $category_id)
    {
        try {
            return Inertia::render(
                'Depan/Profil/Read',
                [
                    'post' => Post::whereType('page')
                        ->whereCategoryId($category_id)
                        ->first(),
                ]
            )->withViewData(
                [
                    'meta' => [
                        'title' => "Profil Desa Samar",
                        'description' => 'Profil Desa Samar',
                        'image' => \asset('img/balai.jpg'),
                        'url' => $request->url(),
                    ]
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function berita(Request $request)
    {
        try {
            return Inertia::render(
                'Depan/Berita',
                [
                    'posts' => Post::whereCategoryId('Berita')
                        ->get()
                ]
            )->withViewData(
                [
                    'meta' => [
                        'title' => "Kabar Desa Samar",
                        'description' => 'Daftar Kabar Desa Samar',
                        'image' => \asset('img/balai.jpg'),
                        'url' => $request->url(),
                    ]
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function beritaByCategory(Request $request, $category)
    {
        try {
            return Inertia::render(
                'Depan/Berita',
                [
                    'posts' => Post::whereCategoryId(ucfirst($category))
                        ->get()
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function info(Request $request)
    {
        try {
            return Inertia::render(
                'Depan/Berita',
                [
                    'posts' => Post::where('category_id', 'Info')
                        ->get()
                ]
            )->withViewData(
                [
                    'meta' => [
                        'title' => "Pengumuman Desa Samar",
                        'description' => 'Daftar Pengumuman Desa Samar',
                        'image' => \asset('img/balai.jpg'),
                        'url' => $request->url(),
                    ]
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /** $slug is the post slug
     * Return single page of post
     * $lug slug column of post
     *
     * @return Inertia
     **/
    public function readPost(Request $request, $slug)
    {
        try {
            $post = Post::whereSlug($slug)->with('author')->first();
            $others = Post::whereType('post')
                ->whereCategoryId($post->category_id)
                ->whereNot('id', $post->id)
                ->with('author')
                ->orderBy('updated_at', 'DESC')
                ->limit(5)
                ->get();

            return Inertia::render(
                'Depan/ReadPost',
                [
                    'post' => $post,
                    'others' => $others,
                ]
            )->withViewData(
                [
                    'meta' => [
                        'title' => $post->title,
                        'description' => \substr($post->content, 0, 200),
                        'image' => $post->cover,
                        'url' => $request->url(),
                    ]
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
