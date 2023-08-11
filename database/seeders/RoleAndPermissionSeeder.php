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
            'usuario-listar',
            'usuario-crear',
            'usuario-editar',
            'usuario-ver',
            'usuario-borrar',
            'rol-listar',
            'rol-crear',
            'rol-editar',
            'rol-ver',
            'rol-borrar',
            'permiso-listar',
            'permiso-crear',
            'permiso-editar',
            'permiso-ver',
            'permiso-borrar',
            'equipo-listar',
            'equipo-crear',
            'equipo-editar',
            'equipo-ver',
            'equipo-borrar',
            'jornada-listar',
            'jornada-crear',
            'jornada-editar',
            'jornada-ver',
            'jornada-borrar',
            'partido-listar',
            'partido-crear',
            'partido-editar',
            'partido-ver',
            'partido-borrar',
            'pronostico-listar',
            'pronostico-crear',
            'pronostico-editar',
            'pronostico-ver',
            'pronostico-borrar',
            'resultado-jornada-listar',
            'resultado-jornada-crear',
            'resultado-jornada-editar',
            'resultado-jornada-ver',
            'resultado-jornada-borrar',
            'resultado-general-listar',
            'resultado-general-crear',
            'resultado-general-editar',
            'resultado-general-ver',
            'resultado-general-borrar',
            'pago-listar',
            'pago-crear',
            'pago-editar',
            'pago-ver',
            'pago-borrar',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
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
