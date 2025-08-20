<?php

namespace App\Http\Controllers;

use App\Models\Jabatan;
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
            return Inertia::render(
                'Belakang/Setting',
                [
                    // Mengambil semua data pengunjung bisa sangat lambat jika tabelnya besar.
                    // Jika hanya butuh jumlahnya, gunakan Visitor::count().
                    // 'visitors'  => Visitor::count(),
                    'users'     => User::with('warga')
                        ->with(
                            'roles.permissions'
                        )
                        ->paginate(15),
                    'roles' => Role::with('permissions')->get(),
                    'permissions' => Permission::all(),
                    // Mengambil semua data warga bisa menyebabkan masalah performa.
                    // Sebaiknya ambil hanya kolom yang diperlukan, misalnya untuk dropdown.
                    // 'wargas' => Warga::select('id', 'nik', 'nama')->get(),
                    'jabatans' => Jabatan::all(),
                ]
            );
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
