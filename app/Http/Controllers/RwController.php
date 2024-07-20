<?php

namespace App\Http\Controllers;

use App\Models\Rw;
use Illuminate\Http\Request;

class RwController extends Controller
{
    public function store(Request $request)
    {
        try {
            $data = $request->data;
            Rw::updateOrCreate(
                [
                    'id' => $data['id'] ?? null,
                ],
                [
                    'nama' => $data['nama'],
                    'ketua_id' => $data['ketua_id'],
                    'dusun_id' => $data['dusun_id']
                ]
            );
            return \back()->with('message', 'RW Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(Rw $rw, $id)
    {
        try {
            $rw::destroy($id);
            return back()->with('message', 'Rw dihapus');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
