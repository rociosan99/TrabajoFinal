<?php

namespace App\Http\Controllers\Cursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function cursos_index(){
        // Obtener los cursos junto con sus horarios
        $cursos = Curso::with('horariosCurso')->get();
        
        return view("vistas_estaticas.cursos.cursos-index", compact('cursos'));
    }

    public function cursos_create(){
        return view("vistas_estaticas.cursos.cursos-create");
    }

    public function cursos_edit($cursoId)
    {
        return view("vistas_estaticas.cursos.cursos-edit", ["cursoId" => $cursoId]);
    }


    public function create_matriculacion($cursoId)
    {
        return view("vistas_estaticas.cursos.create-matriculacion", ["cursoId" => $cursoId]);
    }


    public function list_alumnos($cursoId)
    {
        return view('vistas_estaticas.cursos.alumnos-list', ['cursoId' => $cursoId]);
    }
}
