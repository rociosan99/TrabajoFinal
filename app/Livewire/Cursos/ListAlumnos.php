<?php

namespace App\Livewire\Cursos;

use App\Models\Curso;
use Livewire\Component;

class ListAlumnos extends Component
{
    public $cursoId;
    public $alumnos;
    public $curso; 

    public function mount($cursoId)
    {
        $this->cursoId = $cursoId;
        $this->curso = Curso::findOrFail($cursoId); // Guardar el curso completo

        // Cargar la relación con los alumnos
        $this->alumnos = $this->curso->alumnos;
    }
    public function render()
    {
        return view('livewire.cursos.list-alumnos', [
            'alumnos' => $this->alumnos
        ]);
    }
}

