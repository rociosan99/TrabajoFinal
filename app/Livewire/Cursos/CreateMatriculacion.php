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
    public $search = ''; // Nueva propiedad para la búsqueda

    public function mount($cursoId)
    {
        $this->cursoId = Curso::findOrFail($cursoId);
        $this->alumnos = User::role('Alumno')->get();
        $this->alumnos_matricular = [];
    }

    public function buscarAlumnos()
    {
        // Filtrar alumnos por nombre (usando like para buscar coincidencias parciales)
        $this->alumnos = User::role('Alumno')
            ->where('name', 'like', '%' . $this->search . '%')
            ->get();
    }

    public function addToList($newId)
    {
        $alumno = User::find($newId);
        
        $yaMatriculado = $alumno->cursos()->exists();
        if ($yaMatriculado) {
            session()->flash('error', "El alumno {$alumno->name} {$alumno->apellido} ya está matriculado en otro curso.");
            return;
        }

        if ($alumno && !in_array($alumno->id, array_column($this->alumnos_matricular, 'id'))) {
            $this->alumnos_matricular[] = $alumno->toArray(); 
        }
    }

    public function deleteToList($idToRemove)
    {
        $this->alumnos_matricular = array_filter($this->alumnos_matricular, function ($alumno) use ($idToRemove) {
            return $alumno['id'] !== $idToRemove;
        });

        $this->alumnos_matricular = array_values($this->alumnos_matricular);
    }

    public function matricularAlumnos()
    {
        foreach ($this->alumnos_matricular as $alumno) {
            $user = User::find($alumno['id']);
            
            $yaMatriculado = $user->cursos()->exists();
            if ($yaMatriculado) {
                session()->flash('error', "El alumno {$user->name} {$user->apellido} ya está matriculado en otro curso.");
                continue;
            }

            $this->cursoId->alumnos()->syncWithoutDetaching([$alumno['id']]);
        }

        $this->alumnos_matricular = [];
        return redirect()->route('cursos-cursos-index');
    }

    public function render()
    {
        return view('livewire.cursos.create-matriculacion');
    }
}
