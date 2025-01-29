<?php

namespace App\Livewire\Asistencias;

use Livewire\Component;
use App\Models\User;
use App\Models\Asistencia;
use App\Models\Curso;
use App\Models\Clase;

class CreateAsistencia extends Component
{
    public $cursoId; // ID del curso actual
    public $alumnos; // Lista de alumnos asociados al curso
    public $asistencias = []; // Estado de asistencia para cada alumno
    public $curso;
    public $clase;

    public function mount($claseId)
    {
        // Buscar la clase y obtener el curso relacionado
        $this->clase = Clase::findOrFail($claseId);
        $this->cursoId = $this->clase->curso_id;

        // Cargar el curso y los alumnos asociados
        $this->curso = Curso::findOrFail($this->cursoId);
        $this->alumnos = $this->curso->alumnos;

        // Inicializar estado de asistencia
        foreach ($this->alumnos as $alumno) {
            $this->asistencias[$alumno->id] = false; // Estado predeterminado: ausente
        }
    }

    public function guardarAsistencias()
    {
        //echo var_dump($this->asistencias);
        //die();
        foreach ($this->asistencias as $usuarioId => $presente) {
            // Determinar el estado basado en el checkbox
            $estado = $presente ? 'presente' : 'ausente';

            // Crear el registro de asistencia
            Asistencia::crearAsistencia($usuarioId, $this->clase->id, $estado);
        }

        // Mensaje de éxito
        session()->flash('message', 'Asistencias registradas correctamente.');
        return redirect()->route('clases-clases-index', ['cursoId' => $this->cursoId]);

        // Reiniciar asistencias después de guardar
        foreach ($this->alumnos as $alumno) {
            $this->asistencias[$alumno->id] = false; // Restablecer a "ausente"
        }
    }

    public function render()
    {
        return view('livewire.asistencias.create-asistencia', [
            'alumnos' => $this->alumnos,
        ]);
    }
}
