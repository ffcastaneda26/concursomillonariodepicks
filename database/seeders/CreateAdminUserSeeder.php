<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'first_name' => 'Administrador',
            'last_name' => 'General',
            'email' => 'admin@caudillos.com',
            'password' => bcrypt('admincaudillos'),
            ]);

            $user->assignRole('Admin');
    }
}
