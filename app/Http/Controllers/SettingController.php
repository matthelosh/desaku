<?php

namespace App\Http\Controllers;

use App\Models\Visitor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function home(Request $request)
    {
        try {
            $visitors = Visitor::all();
            return Inertia::render('Belakang/Setting', [
                'data' => [
                    'visitors' => $visitors
                ]
            ]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
