<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Produk;
use App\Models\Warga;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public function home(Request $request)
    {
        try {
            $datas = [
                'posts' => Post::whereCategoryId('Berita')->get(),
                'infos' => Post::whereCategoryId('Info')->get(),
                'produks' => Produk::all(),
                'wisatas' => Wisata::all(),
                'wargas' => Warga::with('keluarga', 'rt', 'rw', 'dusun')->get(),
            ];
            return Inertia::render('Dashboard', [
                'data' => $datas,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
