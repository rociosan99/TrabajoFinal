<?php

namespace App\Http\Controllers\Comunicado;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Comunicacion;

class ComunicadoController extends Controller
{
    
    public function comunicados_index()
    {
       
        return view("vistas_estaticas.comunicados.list-comunicado");
    }

    public function comunicados_read($id_comunicacion)
    {
        // Buscar el comunicado por ID
        $comunicacion = Comunicacion::findOrFail($id_comunicacion);

        // Retornar la vista con los datos del comunicado
        return view('vistas_estaticas.comunicados.read-comunicado', compact('comunicacion'));
    }
}
