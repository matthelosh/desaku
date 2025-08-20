<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Rt;

class UserController extends Controller
{
    public function store(UserRequest $request)
    {
        try {
            $user = User::updateOrCreate(
                [
                    'id' => $request['id'] ?? null,
                ],
                [
                    'name' => $request['name'],
                    'email' => $request['email'],
                    'password' => Hash::make($request['password']),
                    'warga_id' => $request['warga_id'] ?? \null,
                ]
            );

            $user->assignRole($request['role']);

            return back()->with('message', 'Pengguna Disimpan');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function createUserRT() {
        try {
            $rts = Rt::whereDoesntHave('user')->with('rw')->get();
            foreach($rts as $rt)
            {
                $name = strtolower(str_replace(' ', '', $rt->nama)) . strtolower(str_replace(' ', '', $rt->rw->nama));
                $user = User::updateOrCreate(
                    [
                        'name' => $name,
                    ],
                    [
                        'email' => $name . '@samar.desa.id',
                        'password' => Hash::make(strtolower(str_replace(' ', '', $rt->nama))),
                        'warga_id' => $rt->ketua_id ?? null,
                    ]
                )->assignRole('rt');
                $rt->user_id = $user->id;
                $rt->save();
            }

            return back()->with('message', 'Pengguna RT berhasil dibuat');
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function destroy(User $user, $id)
    {
        try {
            $user::destroy($id);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
