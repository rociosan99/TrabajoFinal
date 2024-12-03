<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class JustificacionInasistenciaController extends Controller
{
    public function justificacion()
    {
        return view("vistas_estaticas.justificacion");
    }
}
