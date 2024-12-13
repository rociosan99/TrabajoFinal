<?php

namespace App\Http\Controllers\Clases;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clase;
use App\Models\Curso;

class ClasesController extends Controller
{
    public function clases_index($cursoId)
    {
        $curso = Curso::with('clases')->where('id', $cursoId)->firstOrFail();
        
        return view("vistas_estaticas.clases.clases-index", compact('curso')); 
    }



}
