<?php

namespace App\Http\Controllers\Clases;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clases;
use App\Models\Clase;

class ClasesController extends Controller
{
    
    public function clases_index()
    {
  
    return view("vistas_estaticas.clases.clases-index");
    }

    public function clases_create()
    {
        return view("vistas_estaticas.clases.clases-create");
    }

    public function clases_edit($id)
    {
        return view('vistas_estaticas.clases.clases-edit',["id"=>$id]);
    }

}
