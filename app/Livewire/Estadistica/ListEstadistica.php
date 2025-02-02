<?php

namespace App\Livewire\Estadistica;

use Livewire\Component;
use App\Models\Curso;
use App\Models\Asistencia;
use App\Models\Clase;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class ListEstadistica extends Component
{
    public $asistenciasPorDia = [];
    public $asistenciasPorClase = [];
    public $cursoSeleccionado = null;  // Para filtrar por curso

    public function mount()
    {
        $this->cargarDatos();
    }

    public function cargarDatos()
    {
        // Asistencias por día (Gráfico de líneas) filtrado por curso si se selecciona uno
        $query = Asistencia::select(
                DB::raw('DATE(clases.fecha_clase) as fecha'),
                DB::raw('COUNT(asistencias.id) as cantidad')
            )
            ->join('clases', 'asistencias.clase_id', '=', 'clases.id');
        
        // Filtrar por curso si se selecciona uno
        if ($this->cursoSeleccionado) {
            $query->where('clases.curso_id', $this->cursoSeleccionado);
        }

        $this->asistenciasPorDia = $query
            ->groupBy('fecha')
            ->orderBy('fecha')
            ->get()
            ->toArray();

        // Histograma de asistencias por clase, filtrado por curso
        $queryClase = Clase::select(
                'clases.id',
                'clases.fecha_clase',
                DB::raw('COUNT(asistencias.id) as cantidad_asistencias')
            )
            ->leftJoin('asistencias', 'clases.id', '=', 'asistencias.clase_id');
        
        // Filtrar por curso si se selecciona uno
        if ($this->cursoSeleccionado) {
            $queryClase->where('clases.curso_id', $this->cursoSeleccionado);
        }

        $this->asistenciasPorClase = $queryClase
            ->groupBy('clases.id', 'clases.fecha_clase')
            ->orderBy('clases.fecha_clase')
            ->get()
            ->toArray();
    }

    public function render()
    {
        $cursos = Curso::all(); // Obtener todos los cursos disponibles para el filtro

        return view('livewire.estadistica.list-estadistica', [
            'cursos' => $cursos
        ]);
    }
}