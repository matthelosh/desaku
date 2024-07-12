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
}
