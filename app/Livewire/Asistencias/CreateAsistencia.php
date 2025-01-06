<?php

namespace App\Livewire\Asistencias;

use Livewire\Component;
use App\Models\Curso;
use App\Models\User;
use App\Models\Asistencia;

class CreateAsistencia extends Component
{
    public $cursoId; // ID del curso actual
    public $alumnos; // Lista de alumnos matriculados
    public $asistencias = []; // Registro temporal de asistencias para cada alumno

    public function mount($cursoId)
    {
        // Cargar el curso y sus alumnos
        $curso = Curso::with('alumnos')->findOrFail($cursoId);
        $this->cursoId = $cursoId;
        $this->alumnos = $curso->alumnos;

        // Inicializar las asistencias como "presente" para todos los alumnos
        foreach ($this->alumnos as $alumno) {
            $this->asistencias[$alumno->id] = 'presente'; // valores posibles: 'presente', 'ausente'
        }
    }

    public function saveAsistencias()
    {
        foreach ($this->asistencias as $alumnoId => $estado) {
            Asistencia::create([
                'user_id' => $alumnoId,
                'curso_id' => $this->cursoId,
                'estado' => $estado, // Estado de la asistencia
                'fecha' => now(),    // Registrar la fecha actual
            ]);
        }

        session()->flash('message', 'Asistencias registradas exitosamente.');
        return redirect()->route('cursos-cursos-index'); // Cambiar según tu ruta principal
    }

    public function render()
    {
        return view('livewire.asistencias.create-asistencia', [
            'alumnos' => $this->alumnos,
        ]);
    }
}
