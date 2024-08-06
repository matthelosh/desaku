<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name' => 'lina',
            'email' => 'lina.safitri.samar@desa.mail.go.id',
            'password' => Hash::make('123')
        ]);

        $user->assignRole('ops');
    }
}
