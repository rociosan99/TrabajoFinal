<?php

namespace App\Http\Controllers\Asistencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function list_asistencia(){

         return view('vistas_estaticas.asistencias.list-asistencia');
    }
}
