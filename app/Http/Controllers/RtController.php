<?php

namespace App\Http\Controllers;

use App\Models\Rt;
use Illuminate\Http\Request;

class RtController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->data;
            Rt::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'nama' => $data['nama'],
                    'ketua_id' => $data['ketua_id'],
                    'rw_id' => $data['rw_id']
                ]
            );
            return \back()->with('message', 'RT Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Rt $rt, $id)
    {
        try {
            $rt::destroy($id);
            return back()->with('message', 'RT dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
