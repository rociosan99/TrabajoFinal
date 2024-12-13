<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use App\Models\Clase;
use App\Models\Curso;
use App\Jobs\PlanificarClasesJob;
use Carbon\Carbon;


class CreateClase extends Component
{
    // Propiedades del formulario
    public $fecha_clase;
    public $hora_inicio;
    public $hora_fin;
    public $curso_id;

    public $cursos;

    public $dias = []; // Propiedad para manejar los días del curso

    public function mount()
    {
        $this->cursos = Curso::all(); // Cargar todos los cursos
    }

    // Validaciones de los campos
    protected $rules = [
        'fecha_clase' => 'required|date', // Asegurarse de que sea una fecha válida
        'hora_inicio' => 'required|date_format:H:i', // Validación para la hora
        'hora_fin' => 'required|date_format:H:i|after:hora_inicio', // Validación para hora_fin
        'curso_id' => 'required|exists:cursos,id',
        'dias' => 'required|array|min:1', // Asegurarse de que haya al menos un día seleccionado
        'dias.*.dia' => 'required|string|in:lunes,martes,miércoles,jueves,viernes,sábado,domingo',
        'dias.*.hora_inicio' => 'required|date_format:H:i',
        'dias.*.hora_fin' => 'required|date_format:H:i|after:dias.*.hora_inicio',
    ];

    // Guardar clase manual o generar automáticamente
    public function save()
    {
        // Validar los campos antes de procesar
        $this->validate();

        if ($this->fecha_clase) {
            // Creación manual de una clase
            $fecha_clase_formatted = Carbon::parse($this->fecha_clase)->format('Y-m-d');

            Clase::create([
                'fecha_clase' => $fecha_clase_formatted,
                'hora_inicio' => $this->hora_inicio,
                'hora_fin' => $this->hora_fin,
                'curso_id' => $this->curso_id,
            ]);

            session()->flash('message', 'Clase creada manualmente con éxito.');
        } else {
            // Generación automática de clases
            $curso = Curso::find($this->curso_id);

            if ($curso) {
                // Despachar el Job para generar las clases
                PlanificarClasesJob::dispatch($curso, $this->dias);

                session()->flash('message', 'Clases generadas automáticamente con éxito.');
            } else {
                session()->flash('error', 'El curso seleccionado no existe.');
            }
        }

        // Redirigir al índice de clases
        return redirect()->route('clases-clases-index');
    }

    public function render()
    {
        return view('livewire.clases.create-clase', [
            'cursos' => $this->cursos,
        ]);
    }
}
