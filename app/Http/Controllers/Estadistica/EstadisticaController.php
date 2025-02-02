<?php

namespace App\Http\Controllers\Estadistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EstadisticaController extends Controller
{

    public function estadistica_index()
    {
        return view('vistas_estaticas.estadistica.list-estadistica'); // Ajusta el nombre si es diferente
    }
}

