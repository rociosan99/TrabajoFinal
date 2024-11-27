<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Crear roles
        $adminRole = Role::firstOrCreate(['name' => 'Administrador', 'guard_name' => 'web']);
        $profesorRole = Role::firstOrCreate(['name' => 'Profesor', 'guard_name' => 'web']);
        $alumnoRole = Role::firstOrCreate(['name' => 'Alumno', 'guard_name' => 'web']);

        // Crear permisos basados en módulos
        $permissions = [
            'ver_modulo_cursos',   // Permiso para ver módulo de cursos
            'ver_modulo_examenes', // Permiso para ver módulo de exámenes
            'ver_modulo_usuarios', // Permiso para ver módulo de usuarios
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Asignar permisos a roles
        $adminRole->givePermissionTo($permissions); // Admin tiene todos los permisos
        $profesorRole->givePermissionTo(['ver_modulo_cursos', 'ver_modulo_examenes']);
        $alumnoRole->givePermissionTo(['ver_modulo_cursos']);

        // Crear usuarios
        $usuario = User::firstOrCreate([
            'email' => 'clau@gmail.com',
        ], [
            'name' => 'Claudia',
            'apellido' => 'Sainz',
            'dni' => '35789623',
            'fecha_nac' => now(),
            'password' => bcrypt('12345678'),
        ]);
        $usuario->assignRole($adminRole);

        $profesor = User::firstOrCreate([
            'email' => 'maria@gmail.com',
        ], [
            'name' => 'Maria',
            'apellido' => 'Diaz',
            'dni' => '40235569',
            'fecha_nac' => now(),
            'password' => bcrypt('12345678'),
        ]);
        $profesor->assignRole($profesorRole);

        $alumno = User::firstOrCreate([
            'email' => 'jose@gmail.com',
        ], [
            'name' => 'Jose',
            'apellido' => 'Martinez',
            'dni' => '43369857',
            'fecha_nac' => now(),
            'password' => bcrypt('12345678'),
        ]);
        $alumno->assignRole($alumnoRole);
    }
}


