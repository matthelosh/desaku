<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Post;
use App\Models\Produk;
use App\Models\Warga;
use App\Models\Wisata;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Rt;
class DashboardController extends Controller
{
    public function home(Request $request)
    {
        try {
            if ($request->user()->hasRole('rt')) {

                $rt = Rt::where('user_id', $request->user()->id)->first();
                // Eager load relationships untuk mencegah N+1 dan gunakan count untuk ringkasan
                $datas = [
                    'posts' => Post::whereCategoryId('Berita')->where('rt_id', $rt->id)->with('author')->latest()->limit(5)->get(),
                    'infos' => Post::whereCategoryId('Info')->where('rt_id', $rt->id)->with('author')->latest()->limit(5)->get(),
                    'produks' => Produk::where('rt_id', $rt->id)->count(),
                    'wisatas' => Wisata::where('rt_id', $rt->id)->count(),
                    'wargas' => Warga::where('rt_id', $rt->id)->count(),
                    'businesses' => Business::where('rt_id', $rt->id)->count(),
                ];
            } else {
                // Mengambil semua data dari beberapa tabel sekaligus bisa sangat membebani server.
                // Sebaiknya gunakan `count()` untuk data yang hanya perlu ditampilkan jumlahnya.
                // Gunakan `with()` (eager loading) untuk mencegah N+1 query.
                $datas = [
                    // Ambil 5 post terbaru dan eager load author untuk menghindari N+1
                    'posts' => Post::whereCategoryId('Berita')->with('author')->latest()->limit(5)->get(),
                    'infos' => Post::whereCategoryId('Info')->with('author')->latest()->limit(5)->get(),
                    'produks' => Produk::count(),
                    'wisatas' => Wisata::count(),
                    'wargas' => Warga::count(),
                    'businesses' => Business::count(),
                ];
            }
            return Inertia::render('Dashboard', [
                'data' => $datas,
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
