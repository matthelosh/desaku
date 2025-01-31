<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
use Illuminate\Http\Request;

class JabatanController extends Controller
{
    public function store(Request $request)
    {
        try {
            $jabatan = Jabatan::updateOrCreate(
                [
                    'id' => $request->id ?? null,
                ],
                [
                    'nama' => $request->nama,
                    'deskripsi' => $request->deskripsi,
                ]
            );
            return back()->with('message', 'Data Jabatan Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
    public function destroy(Jabatan $jabatan, $id)
    {
        try {
            $jabatan::destroy($id);
            return back()->with('message', 'Data Jabatan Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
