<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Cursos\CursoController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
//rutas para roles
Route::get("users/roles",[UserController::class,"roles_index"])->name("users-roles-index");
Route::get("users/roles/create",[UserController::class,"roles_create"])->name("users-roles-create");

//rutas para usuarios
Route::get("users/users",[UserController::class,"users_index"])->name("users-users-index");
Route::get("users/users/create",[UserController::class,"users_create"])->name("users-users-create");
Route::get("users/users/edit/{id}",[UserController::class,"users_edit"])->name("users-users-edit");

// rutas para cursos
Route::get("cursos/cursos",[CursoController::class,"cursos_index"])->name("cursos-cursos-index");