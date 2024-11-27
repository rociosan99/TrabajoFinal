<?php

namespace App\Http\Controllers\Clases;


use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Clases;

class ClasesController extends Controller
{
    // ClasesController.php
    public function clases_index()
    {   
        return view("vistas_estaticas.clases.clases-index");
    }

    public function clases_create()
    {
        return view("vistas_estaticas.clases.clases-create");
    }


}
