<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->truncateTables([
            'positions',
            'picks',
            'user_roles',
            'role_permissions',
            'user_permissions',
            'users',
            'roles',
            'permissions',
        ]);

        $this->call([
            RoleAndPermissionSeeder::class,
            CreateAdminUserSeeder::class,
        ]);

        // Crea usuarios ficticios
        $count_users = 10;
        if($count_users){
            User::factory()
            ->count($count_users)
            ->create([
                'adult'  => 1,
                'paid'  => 1,
                'active' => 1
            ]);

            $users = User::where('id','>',1)->orderBy('id')->get();
            foreach( $users as $user){
                $user->assignRole(env('ROLE_TO_PARTICIPANT','participante'));
            }

        }

    }

    protected function truncateTables(array $tables) {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0;'); // Desactivamos la revisión de claves foráneas
        foreach ($tables as $table) {
            DB::table($table)->truncate();
        }
        DB::statement('SET FOREIGN_KEY_CHECKS = 1;'); // Desactivamos la revisión de claves foráneas
    }
}
