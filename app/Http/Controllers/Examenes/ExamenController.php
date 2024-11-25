<?php

namespace App\Http\Controllers\Examenes;  // Asegúrate de que el namespace esté correctamente especificado

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Examen;

class ExamenController extends Controller
{
    public function examenes_index()
    {
       
        return view("vistas_estaticas.examenes.examenes-index");
    }

    public function examenes_create()
    {
        return view("vistas_estaticas.examenes.examenes-create");
    }
}
