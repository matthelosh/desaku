<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Wisata;
use Illuminate\Support\Facades\Storage;

class WisataController extends Controller
{
    public function home(Request $request)
    {
        return
            Inertia::render(
                "Depan/Wisata/Index",
                [
                    "wisatas" => Wisata::all()
                ]
            );
    }

    public function dashboard(Request $request)
    {
        return Inertia::render(
            'Belakang/Wisata',
            [
                'wisatas' => Wisata::all()
            ]
        );
    }

    public function detail(Request $request, $id)
    {
        $wisata = Wisata::findOrFail($id);

        return $wisata;
    }

    public function store(Request $request)
    {
        $data = $request->data;
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $store = Storage::putFileAS(
                'public/wisata',
                $file,
                str_replace(
                    " ",
                    "_",
                    $data['nama']
                ) . '.' . $file->extension()
            );

            $foto = Storage::url($store);
        }
        $store = Wisata::updateOrCreate(
            [
                'id' => $data['id'] ?? null,
            ],
            [
                'nama' => $data['nama'],
                'foto'  => $foto ?? null,
                'lokasi' => $data['lokasi'],
                'kategori' => $data['kategori'],
                'pengelola' => $data['pengelola'],
                'harga_tiket' => $data['harga_tiket'],
                'buka' => $data['buka'],
                'tutup' => $data['tutup'],
                'is_active' => true,
            ]
        );

        return back()->with('message', 'Data Wisata disimpan');

    }

    public function destroy(Wisata $wisata, $id)
    {
        $wisata::destroy($id);
        return back()->with('message', 'Data Wisata dihapus');
    }
}
