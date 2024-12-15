<?php

namespace App\Livewire\Cursos;

use App\Models\Curso;
use App\Models\User;
use Livewire\Component;

class CreateMatriculacion extends Component
{
    public $cursoId; // El ID del curso
    public $alumnos; // Todos los alumnos disponibles para matricular
    public $alumnos_matricular; // Lista de alumnos a matricular (objetos completos)

    public function mount($cursoId)
    {
        // Cargar el curso con el ID proporcionado
        $this->cursoId = Curso::findOrFail($cursoId);

        // Obtener los alumnos con el rol de 'Alumno'
        $this->alumnos = User::role('Alumno')->get();

        // Inicializar la lista de alumnos a matricular
        $this->alumnos_matricular = [];
    }

    /**
     * Agregar un alumno a la lista de alumnos a matricular.
     */
    public function addToList($newId)
    {
        $alumno = User::find($newId);
        
        // Verificar si el alumno ya está matriculado en otro curso
        $yaMatriculado = $alumno->cursos()->exists();
        if ($yaMatriculado) {
            session()->flash('error', "El alumno {$alumno->name} {$alumno->apellido} ya está matriculado en otro curso.");
            return;
        }

        // Evitar duplicados en la lista de alumnos a matricular
        if ($alumno && !in_array($alumno->id, array_column($this->alumnos_matricular, 'id'))) {
            $this->alumnos_matricular[] = $alumno->toArray(); // Almacenar el objeto del alumno como array
        }
    }

    /**
     * Eliminar un alumno de la lista de alumnos a matricular.
     */
    public function deleteToList($idToRemove)
    {
        $this->alumnos_matricular = array_filter($this->alumnos_matricular, function ($alumno) use ($idToRemove) {
            return $alumno['id'] !== $idToRemove;
        });

        // Reindexar los índices del array
        $this->alumnos_matricular = array_values($this->alumnos_matricular);
    }

    /**
     * Matricular a los alumnos seleccionados en el curso.
     */
    public function matricularAlumnos()
    {
        foreach ($this->alumnos_matricular as $alumno) {
            $user = User::find($alumno['id']);
            
            // Verificar nuevamente si el alumno ya está matriculado
            $yaMatriculado = $user->cursos()->exists();
            if ($yaMatriculado) {
                session()->flash('error', "El alumno {$user->name} {$user->apellido} ya está matriculado en otro curso.");
                continue;
            }

            // Matricular al alumno en el curso actual
            $this->cursoId->alumnos()->syncWithoutDetaching([$alumno['id']]);
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
