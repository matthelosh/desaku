<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Visitor;
use App\Models\Warga;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SettingController extends Controller
{
    public function home(Request $request)
    {
        try {
            $visitors = Visitor::all();
            return Inertia::render(
                'Belakang/Setting',
                [
                    'visitors'  => $visitors,
                    'users'     => User::with('warga')
                        ->with(
                            'roles.permissions'
                        )
                        ->paginate(20),
                    'roles' => Role::with('permissions')->get(),
                    'permissions' => Permission::all(),
                    'wargas' => Warga::all()
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
