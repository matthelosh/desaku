<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = ['create_user','read_user', 'update_user', 'delete_user', 'create_perangkat', 'read_perangkat','update_perangkat', 'delete_perangkat', 'create_post', 'read_post', 'update_post', 'delete_post', 'create_produk','read_produk', 'update_produk','delete_produk','create_wisata', 'read_wisata','update_wisata','delete_wisata', 'create_business', 'read_business', 'update_business', 'delete_business', 'create_warga','read_warga', 'update_warga', 'delete_warga', 'create_lembaga','read_lembaga','update_lembaga', 'delete_lembaga', 'create_backup', 'read_backup', 'update_backup', 'delete_backup'];
        for ($p = 0;$p < count($permissions); $p++) {
            Permission::create(['name' => $permissions[$p]]);
        }
    }
}
