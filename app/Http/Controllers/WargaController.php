<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Jabatan;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class WargaController extends Controller
{
    public function home(Request $request)
    {
        try {
            // dd($request->query('lembagaId'));
            $isRt = $request->user()->hasRole('rt');
            $rt = $isRt ? Rt::where('nama', $request->user()->name)->first() : null;
            if (!$request->query('lembagaId')) {
                if ($request->query('q')) {
                    $wargas = Warga::where('nama', 'LIKE', '%' . $request->query('q') . '%')
                        ->with('rt', 'rw', 'dusun', 'jabatan')
                        ->where('rt_id', 'LIKE', $isRt ? $rt->id : '%')
                        ->paginate(20);
                } else {
                    $wargas = Warga::with('rt', 'rw', 'dusun', 'jabatan')
                        ->where('rt_id', 'LIKE', $isRt ? $rt->id : '%')
                        ->paginate(20);
                }
                return Inertia::render(
                    'Belakang/Warga',
                    [
                        'wargas' => $wargas,
                    ]
                );
            } else {
                $lembagaId = $request->query('lembagaId');
                $wargas = Warga::whereDoesntHave(
                    'lembaga',
                    function ($q) use ($lembagaId) {
                        $q->where('lembagas.id', $lembagaId);
                    }
                )
                    ->where('rt_id', 'LIKE', $isRt ? $rt->id : '%')
                    ->with('rt.rw.dusun')
                    ->get();

                return response()->json(['wargas' => $wargas]);
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function index()
    {
        $wargas =  Warga::get();

        return response()->json(
            [
                'datas' => [
                    'wargas' => $wargas,
                    'jabatans' => Jabatan::all()
                ]
            ]
        );
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
                    'pendidikan' => $data['pendidikan'],
                    'pekerjaan' => $data['pekerjaan'],
                    'ayah' => $data['ayah'] ?? null,
                    'ibu' => $data['ibu'] ?? null,
                    'foto' => $foto ?? null
                ]
            );
            return back()->with('message', 'Data Warga Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function impor(Request $request)
    {
        try {
            // dd($request->all());
            $datas = $request->datas;
            foreach ($datas as $data) {
                Warga::updateOrCreate(
                    [
                        'nik' => $data['nik'],
                    ],
                    [
                        'kk_id' => $data['kk_id'],
                        'nama' => $data['nama'],
                        'jk' => $data['jk'],
                        'tempat_lahir' => $data['tempat_lahir'],
                        'tanggal_lahir' => Carbon::parseFromLocale($data['tanggal_lahir'])->addDays(1)->format('Y-m-d'),
                        'agama' => $data['agama'],
                        'rt_id' => $data['rt_id'],
                        'pendidikan' => $data['pendidikan'],
                        'pekerjaan' => $data['pekerjaan'],
                        'ayah' => $data['ayah'] ?? null,
                        'ibu' => $data['ibu'] ?? null,
                    ]
                );
            }
            return back()->with('message', 'Data Warga Diimpor');
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
            return response()->json(
                [
                    'rts' => Rt::with('rw', 'dusun')->get()
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
