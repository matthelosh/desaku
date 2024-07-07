<?php

namespace App\Http\Controllers;

use App\Services\PostService;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PostController extends Controller
{
    public function home(Request $request, PostService $postService)
    {
        try {
            $posts = $postService->home($request);

            return Inertia::render('');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
