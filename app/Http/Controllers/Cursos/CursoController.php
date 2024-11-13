<?php

namespace App\Http\Controllers\Cursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

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
}
    

