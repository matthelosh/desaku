<?php

namespace App\Http\Controllers;

use App\Models\Business;
use App\Models\Produk;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProdukController extends Controller
{
    public function home(Request $request)
    {
        try {
            return Inertia::render('Belakang/Produk', [
                'businesses' => Business::all(),
                'products' => Produk::with('produsen')->get(),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request['data'];
            Business::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'nama' => $data['nama'],
                    'jenis' => $data['jenis'],
                    'skala' => $data['skala'],
                    'logo' => null,
                    'pemilik' => $data['pemilik'],
                    'online_store' => $data['online_store'],
                    'alamat' => $data['alamat'],
                    'kontak' => $data['kontak'],
                    'deskripsi' => $data['deskripsi'],
                ]
            );
            return \back()->with('message', 'Data Usaha disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Business $business, $id)
    {
        try {
            $business->destroy($id);
            return \back()->with('message', 'Data Usaha dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
