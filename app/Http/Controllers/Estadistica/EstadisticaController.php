<?php

namespace App\Http\Controllers\Estadistica;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Livewire\Component;
use App\Models\Curso;
use App\Models\Asistencia;
use App\Models\Clase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;


class EstadisticaController extends Controller
{

    public function estadistica_index()
    {
        return view('vistas_estaticas.estadistica.list-estadistica'); // Ajusta el nombre si es diferente
    }
    public function estadistica_api(Request $request)
    {
        $idCurso = $request->input('id');

        $query = Clase::select(
            DB::raw('DATE(clases.fecha_clase) as fecha'),
            DB::raw('COUNT(asistencias.id) as cantidad')
        )->leftjoin('asistencias', 'asistencias.clase_id', '=', 'clases.id');

        // Asistencia por día
        $query
            ->groupBy('fecha')
            ->orderBy('fecha', 'desc')
            ->limit(30)
            ->whereDate('clases.fecha_clase','<=',now());


        if (!empty($idCurso)) {
            $query->where('clases.curso_id', $idCurso);
        }

        $asistenciaPorDia = $query->get()->toArray();

        $respuesta = array_reverse($asistenciaPorDia);

        echo json_encode($respuesta);
    }
}
