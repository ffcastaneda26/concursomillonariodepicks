<?php

namespace Database\Seeders;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['name' => 'equipos']);
        Permission::create(['name' => 'jornadas']);
        Permission::create(['name' => 'partidos']);
        Permission::create(['name' => 'pronosticos']);
        Permission::create(['name' => 'resultados-actualizar']);
        Permission::create(['name' => 'resultados-consultar']);
        Permission::create(['name' => 'posiciones-jornada']);
        Permission::create(['name' => 'posiciones-general']);
        // create permissions
        $permissions = [

        ];

        if(count($permissions)){
            foreach ($permissions as $permission) {
                Permission::create(['name' => $permission]);
            }
        }


        // Super Admin con todos los permisos
        $role = Role::create(['name' => 'Admin'])->givePermissionTo(Permission::all());
        $role = Role::create(['name' => 'participante'])
                ->givePermissionTo(['pronosticos', 'resultados-consultar','posiciones-jornada','posiciones-general']);

        // or may be done by chaining
        $role = Role::create(['name' => 'moderador'])
                ->givePermissionTo(['partidos','pronosticos', 'resultados-consultar','posiciones-jornada','posiciones-general']);

    }
}
