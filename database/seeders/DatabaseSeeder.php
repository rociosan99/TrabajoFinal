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

        $usuario = User::create([
            'name'=> 'Claudia',
            'apellido'=>'Sainz',
            'dni'=>'35789623',
            'fecha_nac'=> now(),
            'email'=>'clau@gmail.com',
            'password'=> bcrypt('12345678'),
        ]);

        $usuario->assignRole('Administrador');


    }
}
