<?php

namespace App\Http\Controllers;

use App\Models\Identitas;
use Illuminate\Http\Request;
use Inertia\Inertia;

class IdentitasController extends Controller
{
    public function home(Request $request)
    {
        try {
            return Inertia::render('Belakang/Identitas', [
                'identitas' => Identitas::first(),
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
