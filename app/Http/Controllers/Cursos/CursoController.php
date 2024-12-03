<?php

namespace App\Http\Controllers\Cursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Curso;



class CursoController extends Controller
{
    public function cursos_index(){
        return view("vistas_estaticas.cursos.cursos-index");
    }

    public function cursos_create(){
        return view("vistas_estaticas.cursos.cursos-create");
    }

    public function cursos_edit($id){
        return view ("vistas_estaticas.cursos.cursos-edit",["id"=>$id]);
    }

    // Método para la vista de matriculación
    public function create_matriculacion($cursoId)
    {
        return view("vistas_estaticas.cursos.matriculacion-create", ["cursoId" => $cursoId]);
   
    }

    

}