<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'      => 'Administrador Geberal',
            'alias'     => 'AdminGral',
            'email'     => 'admin@nacinonfl.com',
            'password'  => bcrypt('adminnacionnfl'),
            'active'    => 1,
            ]);

            $user->assignRole('Admin');
    }
}
