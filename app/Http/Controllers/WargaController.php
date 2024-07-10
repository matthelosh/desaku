<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Rt;
use App\Models\Rw;
use App\Models\Warga;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        try {
            return Inertia::render('Belakang/Warga', [
                'wargas' => Warga::with('rt', 'rw', 'dusun')->get()
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function alamat()
    {
        try {
            return response()->json([
                'alamat' => [
                    'dusuns' => Dusun::all(),
                    'rws' => Rw::all(),
                    'rts' => Rt::all()
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
