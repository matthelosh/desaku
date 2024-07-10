<?php

namespace App\Http\Controllers;

use App\Models\Dusun;
use App\Models\Rt;
use App\Models\Rw;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LembagaController extends Controller
{
    public function index(Request $request)
    {
        try {
            return Inertia::render('Belakang/Lembaga', [
                'data' => [
                    'dusuns' => Dusun::with('rws')->get(),
                    'rws' => Rw::with('rts')->get(),
                    'rts' => Rt::with('wargas')->get()
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
