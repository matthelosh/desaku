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
            Produk::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'business_id' => $data['business_id'],
                    'sku' => $data['sku'],
                    'nama' => $data['nama'],
                    'jenis' => $data['jenis'],
                    'foto' => null,
                    'satuan' => $data['satuan'],
                    'berat' => $data['berat'],
                    'link' => $data['link'],
                    'deskripsi' => $data['deskripsi'],
                    'harga' => $data['harga'],
                ]
            );
            return \back()->with('message', 'Data Produk disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Produk $produk, $id)
    {
        try {
            $produk->destroy($id);
            return \back()->with('message', 'Data Produk dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
