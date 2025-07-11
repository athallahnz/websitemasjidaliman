<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    public function run()
    {
        $user = User::create([
            'name' => 'Athallah N Z',
            'email' => 'admin@example.com',
            'password' => Hash::make('password123'),
        ]);

        // Assign role admin
        $user->assignRole('admin');
    }
}
