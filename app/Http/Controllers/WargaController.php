<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        try {
            if (!$request->query('lembagaId')) {
                return Inertia::render('Belakang/Warga', [
                    'wargas' => Warga::with('rt', 'rw', 'dusun')->get()
                ]);
            } else {
                $lembagaId = $request->query('lembagaId');
                $wargas = Warga::whereDoesntHave('lembaga', function ($q) use ($lembagaId) {
                    $q->where('lembagas.id', $lembagaId);
                })->with('rt.rw.dusun')->get();

                return response()->json(['wargas' => $wargas]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function store(Request $request)
    {
        try {
            // dd($request->all());
            $file = $request->file('fileFoto') ?? null;
            $data = $request->data;
            if ($file !== null) {
                $name = $data['nik'] . '.' . $file->getClientOriginalExtension();
                $store = Storage::putFileAs('public/warga/foto', $file, $name);
                $foto = Storage::url($store);
            }

            Warga::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'kk_id' => $data['kk_id'],
                    'nik' => $data['nik'],
                    'nama' => $data['nama'],
                    'jk' => $data['jk'],
                    'tempat_lahir' => $data['tempat_lahir'],
                    'tanggal_lahir' => $data['tanggal_lahir'],
                    'agama' => $data['agama'],
                    'rt_id' => $data['rt_id'],
                    'rw_id' => $data['rw_id'],
                    'dusun_id' => $data['dusun_id'],
                    'pendidikan' => $data['pendidikan'],
                    'pekerjaan' => $data['pekerjaan'],
                    'ayah' => $data['ayah'] ?? null,
                    'ibu' => $data['ibu'],
                    'foto' => $foto ?? null
                ]
            );
            return back()->with('message', 'Data Warga Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Warga $warga, $id)
    {
        try {
            $warga->destroy($id);
            return back()->with('message', 'Data Warga Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function alamat()
    {
        try {
            return response()->json([
                'rts' => Rt::with('rw', 'dusun')->get()
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
