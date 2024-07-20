<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use Illuminate\Http\Request;

class DusunController extends Controller
{

    // public function index(Request $request)
    // {
    //     try {
    //         return \response()->json(['dusuns' =>])
    //     } catch (\Throwable $th) {
    //         throw $th;
    //     }
    // }

    public function store(Request $request)
    {
        try {
            $data = $request->data;
            Dusun::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'nama' => $data['nama'],
                    'ketua_id' => $data['ketua_id'],
                    'deskripsi' => $data['deskripsi']
                ]
            );
            return \back()->with('message', 'Dusun Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }


    public function destroy(Dusun $dusun, $id)
    {
        try {
            $dusun::destroy($id);
            return back()->with('message', 'Dusun dihaus');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
