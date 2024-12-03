<?php

namespace App\Livewire\Cursos;

use App\Models\Curso;
use App\Models\User;
use Livewire\Component;

class CreateMatriculacion extends Component
{
    public $cursoId;
    public $alumnos;
    public $alumnos_matricular;

    public function mount($cursoId)
    {
        $this->cursoId = Curso::findOrFail($cursoId);
        $this->alumnos = User::role('Alumno')->get();
        $this->alumnos_matricular = [];
    }

    public function addToList($newId)
    {
        if (!in_array($newId, $this->alumnos_matricular)) {
            $this->alumnos_matricular[] = $newId;
        }
    }

    public function deleteToList($idToRemove)
    {
        $key = array_search($idToRemove, $this->alumnos_matricular);

        if ($key !== false) {
            unset($this->alumnos_matricular[$key]);
        }

        $this->alumnos_matricular = array_values($this->alumnos_matricular);
    }

    public function matricularAlumnos()
    {
        
        //$this->cursoId = $this->cursoId->id;
        //$curso = Curso::findOrFail($this->cursoId);

        foreach ($this->alumnos_matricular as $alumnoId) {
            $alumno = User::find($alumnoId);
            if ($alumno) {
                // Suponiendo que el curso tiene una relación 'alumnos'
                $this->cursoId->alumnos()->syncWithoutDetaching([$alumnoId]);
            }
        }
        // Limpiar la lista después de matricular
        $this->alumnos_matricular = [];
       
        return redirect()->route('cursos-cursos-index');
    }

    public function render()
    {
        return view('livewire.cursos.create-matriculacion');
    }
}
