<?php

namespace App\Livewire\Examenes;

use Livewire\Component;
use App\Models\Examen;
use App\Models\Curso;

class CreateExam extends Component
{
    public $tema;
    public $fecha;
    public $curso_id; // Atributo para el curso seleccionado
    public $cursos; // Atributo para los cursos disponibles

    // Definir reglas de validación
    protected $rules = [
        'tema' => 'required|string|max:255',
        'fecha' => 'required|date|after:today', // Asegura que la fecha sea futura
        'curso_id' => 'required|exists:cursos,id', // Validación para el curso
    ];

    // Método mount para cargar los cursos
    public function mount()
    {
        // Cargar todos los cursos
        $this->cursos = Curso::all(); 
    }

    // Método para guardar el examen
    public function save()
    {
        $this->validate();

        // Crear un nuevo examen
        Examen::create([
            'tema' => $this->tema,
            'fecha_examen' => $this->fecha,
            'curso_id' => $this->curso_id, // Asignar el curso seleccionado
        ]);

        session()->flash('message', 'Examen creado con éxito.');
        
        // Redirigir a la lista de exámenes después de guardar
        return redirect()->route('examenes-examenes-index');
    }

    // Método render para mostrar la vista
    public function render()
    {
        return view('livewire.examenes.create-exam');
    }
}
