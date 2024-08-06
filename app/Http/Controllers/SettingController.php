<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Inertia\Inertia;

class SettingController extends Controller
{
    public function home(Request $request)
    {
        try {
            $visitors = Visitor::all();
            return Inertia::render(
                'Belakang/Setting',
                [
                        'visitors' => $visitors,
                        'users' => User::with('warga')->paginate(20)
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
