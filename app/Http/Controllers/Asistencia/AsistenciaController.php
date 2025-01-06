<?php

namespace App\Http\Controllers\Asistencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Asistencia;
use App\Models\Curso;


class AsistenciaController extends Controller
{
    public function asistencias_create($cursoId)
    {
        // Ajusta el nombre de la vista para que coincida con el archivo
        return view('vistas_estaticas.asistencias.create-asistencia', compact('cursoId'));
    }
}
