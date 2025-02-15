<?php

namespace App\Livewire\Cursos;

use App\Models\Curso;
use App\Models\User;
use Livewire\Component;
use Carbon\Carbon;

class CreateMatriculacion extends Component
{
    public $cursoId; 
    public $alumnos; 
    public $alumnos_matricular; 
    public $search = ''; // Nueva propiedad para la búsqueda
    public $showModal = false; // Variable para mostrar el modal

    public function mount($cursoId)
    {
        $this->cursoId = Curso::findOrFail($cursoId);
        $this->loadAvailableAlumnos();
        $this->alumnos_matricular = [];
    }

    public function loadAvailableAlumnos()
    {
        $this->alumnos = User::role('Alumno')
            ->whereDoesntHave('cursos') // Alumnos que NO están matriculados en ningún curso
            ->when($this->search, function ($query) {
                $query->where('name', 'like', '%' . $this->search . '%');
            })
            ->get();
    }

    public function buscarAlumnos()
    {
        $this->loadAvailableAlumnos();
    }

    public function addToList($newId)
    {
        $alumno = User::find($newId);
        
        // Verifica si el alumno ya está matriculado en algún curso
        $yaMatriculado = $alumno->cursos()->exists();
        if ($yaMatriculado) {
            session()->flash('error', "El alumno {$alumno->name} {$alumno->apellido} ya está matriculado en otro curso.");
            return;
        }

        // Verifica si el alumno ya ha terminado su periodo en el curso actual
        $ultimoCurso = $alumno->cursos()->latest()->first();
        if ($ultimoCurso) {
            $fechaActual = Carbon::now();
            if ($ultimoCurso->fecha_fin && $ultimoCurso->fecha_fin > $fechaActual) {
                session()->flash('error', "El alumno {$alumno->name} {$alumno->apellido} aún no ha terminado el curso actual.");
                return;
            }
        }

        // Evita duplicar alumnos en la lista de "alumnos a matricular"
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
            
            // Verifica si el alumno ya está matriculado en otro curso
            $yaMatriculado = $user->cursos()->exists();
            if ($yaMatriculado) {
                session()->flash('error', "El alumno {$user->name} {$user->apellido} ya está matriculado.");
                return;
            }
            $user->cursos()->attach($this->cursoId);
        }

        session()->flash('success', 'Alumnos matriculados con éxito.');
        return redirect()->route('cursos-cursos-index');
    }

    public function showAddAlumnosModal()
    {
        // Aquí podrías abrir un modal si lo deseas
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.cursos.create-matriculacion');
    }
}