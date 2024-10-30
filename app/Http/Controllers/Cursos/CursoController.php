<?php

namespace App\Http\Controllers\Cursos;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function cursos_index(){
        return view("vistas_estaticas.cursos.cursos-index");
    }
    
}
