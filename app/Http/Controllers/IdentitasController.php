<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class IdentitasController extends Controller
{
    public function home(Request $request)
    {
        try {
            return Inertia::render('Belakang/Identitas');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
