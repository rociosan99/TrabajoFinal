<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use App\Models\Clase;
use App\Models\Curso;
use Carbon\Carbon;  // Importamos Carbon

class CreateClase extends Component
{
    // Propiedades del formulario
    public $fecha_clase;
    public $hora_inicio;
    public $hora_fin;
    public $curso_id;

    public $cursos;

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
    ];

    // Guardar la clase
    public function save()
    {
        // Validar los campos antes de guardarlos
        $this->validate();

        // Convertir la fecha para asegurarnos de que esté en el formato adecuado con Carbon
        $fecha_clase_formatted = Carbon::parse($this->fecha_clase)->format('Y-m-d'); // Aseguramos que la fecha esté en el formato correcto para la base de datos

        // Guardar la clase en la base de datos
        Clase::create([
            'fecha_clase' => $fecha_clase_formatted, // Guardamos la fecha con Carbon
            'hora_inicio' => $this->hora_inicio, // Guardamos la hora de inicio
            'hora_fin' => $this->hora_fin, // Guardamos la hora de fin
            'curso_id' => $this->curso_id, // Guardamos el ID del curso
        ]);

        // Mensaje de éxito
        session()->flash('message', 'Clase creada exitosamente!');

        // Redirigir al índice de clases
        return redirect()->route('clases-clases-index');
    }

    public function render()
    {
        return view('livewire.clases.create-clase');
    }
}
