<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Cursos\CursoController;
use App\Http\Controllers\Examenes\ExamenController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\RoleRedirectController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Clases\ClasesController;
use App\Http\Controllers\JustificacionInasistenciaController;
use App\Http\Livewire\Cursos\EditCurso;
use Carbon\Carbon;
use App\Http\Controllers\ClaseController;
use App\Http\Controllers\Asistencia\AsistenciaController;
use App\Http\Controllers\Comunicado\ComunicadoController;
use App\Http\Controllers\Estadistica\EstadisticaController;

// Ruta para la página de inicio
Route::get('/', function () {
    return view('welcome');
});

// Rutas personalizadas de autenticación
Route::get('login', [AuthenticatedSessionController::class, 'create'])->name('login');
Route::post('login', [AuthenticatedSessionController::class, 'store']);
Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

// Rutas protegidas
Route::middleware(['auth:sanctum', 'verified'])->group(function () {

    Route::get('/dashboard', [RoleRedirectController::class, 'redirectToDashboard'])->name('dashboard');

    // Redirección de acuerdo con el rol del usuario después de iniciar sesión
    Route::get('/admin/dashboard', function () {
        return view('auth.admin.dashboard'); // Vista del Admin
    })->name('admin.dashboard');

    Route::get('/profesor/dashboard', function () {
        return view('auth.profesor.dashboard'); // Vista del Profesor
    })->name('profesor.dashboard');

    Route::get('/alumno/dashboard', function () {
        return view('auth.alumno.dashboard'); // Vista del Alumno
    })->name('alumno.dashboard');
});



// Rutas para roles
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get("users/roles", [UserController::class, "roles_index"])->name("users-roles-index");
    Route::get("users/roles/create", [UserController::class, "roles_create"])->name("users-roles-create");
});

// Rutas para usuarios
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get("users/users", [UserController::class, "users_index"])->name("users-users-index");
    Route::get("users/users/create", [UserController::class, "users_create"])->name("users-users-create");
    Route::get("users/users/edit/{id}", [UserController::class, "users_edit"])->name("users-users-edit");
});

// Rutas para cursos
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get("cursos/cursos", [CursoController::class, "cursos_index"])->name("cursos-cursos-index");
    Route::get("cursos/cursos/create", [CursoController::class, "cursos_create"])->name("cursos-cursos-create");
    Route::get('cursos/cursos/edit/{cursoId}', [CursoController::class, 'cursos_edit'])->name('cursos-cursos-edit');
    Route::get('cursos/cursos/matriculacion/{cursoId}', [CursoController::class, 'create_matriculacion'])->name('cursos-cursos-matriculacion');
    Route::get('cursos/cursos/alumnos/{cursoId}', [CursoController::class, 'list_alumnos'])->name('cursos-cursos-alumnos');

});
// Rutas para examenes
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('examenes/examenes', [ExamenController::class, 'examenes_index'])->name('examenes-examenes-index');
    Route::get('examenes/examenes/create', [ExamenController::class, 'examenes_create'])->name('examenes-examenes-create');
});

//rutas para clases
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('clases/clases/{cursoId}', [ClasesController::class, 'clases_index'])->name('clases-clases-index');

});

//rutas para asistencia
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('asistencia/asistencia/{claseId}', [AsistenciaController::class, 'asistencias_create'])->name('asistencias-asistencias-create');
});

//rutas para comunicados
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
    Route::get('comunicados/comunicados', [ComunicadoController::class, 'comunicados_index'])->name('comunicados-comunicados-index');
    Route::get('comunicados/comunicados/{id_comunicacion}', [ComunicadoController::class, 'comunicados_read'])->name('comunicados-comunicados-read');
  
});

//rutas para estadisticas
Route::middleware(['auth:sanctum', 'verified'])->group(function () {
        Route::get('estadistica/estadistica', [EstadisticaController::class,'estadistica_index'])->name('estadistica-estadistica-index');
        Route::get('estadistica/estadistica/api', [EstadisticaController::class,'estadistica_api'])->name('estadistica-estadistica-api');
});



