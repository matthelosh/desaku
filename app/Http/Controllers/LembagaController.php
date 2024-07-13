<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Lembaga;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LembagaController extends Controller
{
    public function index(Request $request)
    {
        try {
            return Inertia::render('Belakang/Lembaga', [
                'data' => [
                    'dusuns' => Dusun::with('rws.rts.wargas')->get(),
                    'lembagas' => Lembaga::with('members.rt.rw.dusun')->get(),
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function  store(Request $request)
    {
        try {
            $data = $request->data;
            Lembaga::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'kode' => $data['kode'],
                    'nama' => $data['nama'],
                    'tipe' => $data['tipe'],
                    'deskripsi' => $data['deskripsi'],
                    'is_active' => true,
                ]
            );
            return back()->with('message', 'Lembag Disimpan');
        } catch (\Throwable $th) {
            return back()->withErrors('errors', $th->getMessage());
        }
    }

    public function attachMember(Request $request, $id)
    {
        try {
            $lembaga = Lembaga::find($id);
            // dd($sync_data);
            $lembaga->members()->attach($request->data['wargaId'], ['jabatan' => $request->data['jabatan']]);
            return response()->json(['message' => 'Anggota ditambahkan']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function detachhMember(Request $request, $id)
    {
        try {
            $lembaga = Lembaga::find($id);
            // dd($sync_data);
            $lembaga->members()->detach($request->data['wargaId']);
            return response()->json(['message' => 'Anggota dihapus']);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Lembaga $lembaga, $id)
    {
        try {
            $des = $lembaga::find($id);
            $des->members()->detach();
            $des->delete();
            return back()->with('message', 'Lembaga dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
