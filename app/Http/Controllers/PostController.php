<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Services\PostService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Illuminate\Support\Str;

class PostController extends Controller
{
    public function home(Request $request, PostService $postService)
    {
        try {
            $posts = $postService->home($request);

            return Inertia::render('');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function index(Request $request)
    {
        try {
            $posts = Post::whereType('post')->with('author')->orderBy('updated_at', 'DESC')->get();

            return Inertia::render('Belakang/Post', [
                'data' => [
                    'posts' => $posts,
                ],
            ]);
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function uploadImage(Request $request)
    {
        try {
            return response()->json(['url' => 'https://loremflickr.com/320/240']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function kategori(Request $request)
    {
        try {
            return response()->json(['categories' => Category::all()]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        $data = $request->data;
        // dd($data);
        try {
            if ($request->file('fileCover')) {
                $file = $request->file('fileCover');

                $name = Str::ulid(\now());
                $ext = $file->getClientOriginalExtension();

                $store = Storage::putFileAs('public/post/img/', $file, $name . '.' . $ext);

                $cover = Storage::url($store);
            }

            Post::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'title' => $data['title'],
                    'category_id' => $data['category_id'],
                    'type' => $data['type'],
                    'slug' => \strtolower(\str_replace(" ", "-", $data['title'])),
                    'cover'  => $cover ?? null,
                    'content'  => $data['content'],
                    'user_id' => $request->user()->id,
                    'status' => 'publish'
                ]
            );

            return back()->with('message', 'Tulisan disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Post $post, $id)
    {
        try {
            $delete = Post::destroy($id);

            return back()->with('message', 'Tulisan dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
