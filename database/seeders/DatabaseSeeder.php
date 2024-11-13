<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            'name'=>'Administrador',
            'guard_name'=>'web',
            'created_at'=>now(),
        ]);

        DB::table('roles')->insert([
            'name'=>'Profesor',
            'guard_name'=>'web',
            'created_at'=>now(),
        ]);

        DB::table('roles')->insert([
            'name'=>'Alumno',
            'guard_name'=>'web',
            'created_at'=>now(),
        ]);

        $usuario = User::create([
            'name'=> 'Claudia',
            'apellido'=>'Sainz',
            'dni'=>'35789623',
            'fecha_nac'=> now(),
            'email'=>'clau@gmail.com',
            'password'=> bcrypt('12345678'),
        ]);

        $usuario->assignRole('Administrador');

        $profesor= User::create([
            'name'=> 'Maria',
            'apellido'=>'Diaz',
            'dni'=>'40235569',
            'fecha_nac'=> now(),
            'email'=>'maria@gmail.com',
            'password'=> bcrypt('12345678'),
        ]);

        $profesor->assignRole('Profesor');

        $alumno = User::create([
            'name'=> 'Jose',
            'apellido'=>'Martinez',
            'dni'=>'43369857',
            'fecha_nac'=> now(),
            'email'=>'jose@gmail.com',
            'password'=> bcrypt('12345678'),
        ]);

        $alumno->assignRole('Alumno');

    }
}