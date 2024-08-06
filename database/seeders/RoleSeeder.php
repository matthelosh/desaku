<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = Permission::all();
        $role_names = ['admin', 'kades', 'carik','ops', 'rt', 'warga'];

        for ($r = 0; $r < count($role_names); $r++) {
            $role = Role::create(['name' => $role_names[$r]]);
        }

        $roles = Role::all();
        foreach($roles as $role) {
            switch($role->name) {
                case "admin":
                    $role->givePermissionTo($permissions->pluck('name'));
                    break;
                case "ops":
                    $role->givePermissionTo($permissions->pluck('name'));
                    break;
                case "carik":
                    $role->syncPermissions(['read_user', 'read_lembaga', 'read_warga', 'read_produk', 'read_business', 'read_wisata']);
                    break;
                case "rt":
                    $role->syncPermissions(['read_user', 'update_user', 'create_warga', 'read_warga', 'update_warga', 'delete_warga']);
                    break;
                case "warga":
                    $role->syncPermissions(['read_user', 'update_user', 'read_warga']);
                    break;

            }
        }
    }
}
