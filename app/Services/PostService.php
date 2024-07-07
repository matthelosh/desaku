<?php

namespace App\Services;

use App\Models\Post;

class PostService
{
    public function home($request)
    {
        $queries = $request->query();
        if (count($queries) < 1) {
            $posts = Post::orderBy('updated_at', 'DESC')->limit(5)->get();
        }
        return $posts;
    }
    public function infos($request)
    {
        $queries = $request->query();
        if (count($queries) < 1) {
            $posts = Post::whereCategoryId('Info')->orderBy('updated_at', 'DESC')->limit(5)->get();
        }
        return $posts;
    }
}
