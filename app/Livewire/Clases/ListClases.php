<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use App\Models\Clase;
use Carbon\Carbon;
use App\Models\Curso;


class ListClases extends Component
{
    public $clases;
    public $editingClase = null;
    public $fecha_clase;
    public $hora_inicio;
    public $hora_fin;
    public $curso_id;
    public $isAddingClase = false;

    // Métodos para calcular la cantidad de clases
    public function calcularCantidadDias($fecha_inicio, $fecha_fin, $dia_semana)
    {
        $contador = 0;
        $fecha_actual = $fecha_inicio->copy();

        while ($fecha_actual <= $fecha_fin) {
            if ($fecha_actual->translatedFormat('l') === ucfirst($dia_semana)) {
                $contador++;
            }

            $fecha_actual->addDay();
        }

        return $contador;
    }

    public function mount()
    {
        $this->clases = Clase::all();
    }

    public function startEdit($id)
    {
        $clase = Clase::find($id);
        if ($clase) {
            $this->editingClase = $clase;
            $this->fecha_clase = Carbon::parse($clase->fecha_clase)->format('d/m/Y');
            $this->hora_inicio = $clase->hora_inicio;
            $this->hora_fin = $clase->hora_fin;
            $this->curso_id = $clase->curso_id;
            $this->isAddingClase = false;
        } else {
            $this->resetForm();
        }
    }

    public function addClase()
    {
        // Obtener el curso y sus fechas de inicio y fin
        $curso = Curso::find($this->curso_id);
        if (!$curso) {
            return;
        }

        $fecha_inicio = Carbon::parse($curso->fecha_inicio);
        $fecha_fin = Carbon::parse($curso->fecha_fin);
        
        // Suponemos que el horario de la clase es algo como: "Lunes", "Martes", etc.
        $dia_semana = Carbon::parse($this->fecha_clase)->locale('es')->isoFormat('dddd'); // Día de la clase
        $cantidad_dias = $this->calcularCantidadDias($fecha_inicio, $fecha_fin, $dia_semana);

        // Agregar la clase al curso con la cantidad de días calculada
        Clase::create([
            'fecha_clase' => Carbon::parse($this->fecha_clase),
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'curso_id' => $this->curso_id,
            'cantidad' => $cantidad_dias,
        ]);

        // Emitir evento para actualizar el componente ListCursos
        $this->emit('claseAdded', $this->curso_id, $this->fecha_clase, $this->hora_inicio, $this->hora_fin);

        $this->resetForm();
    }

    public function resetForm()
    {
        $this->fecha_clase = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->curso_id = null;
    }

    public function render()
    {
        return view('livewire.clases.list-clases', [
            'clases' => $this->clases,
        ]);
    }
}
