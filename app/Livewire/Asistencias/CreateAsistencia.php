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

        // Cargar asistencias previas y establecer el estado inicial
        foreach ($this->alumnos as $alumno) {
            $asistencia = Asistencia::where('usuario_id', $alumno->id)
                                    ->where('clase_id', $this->clase->id)
                                    ->first();
            
            $this->asistencias[$alumno->id] = $asistencia ? ($asistencia->estado === 'presente') : false;
        }
    }

    public function guardarAsistencias()
    {
        foreach ($this->asistencias as $usuarioId => $presente) {
            $estado = $presente ? 'presente' : 'ausente';
            
            Asistencia::updateOrCreate(
                ['usuario_id' => $usuarioId, 'clase_id' => $this->clase->id],
                ['estado' => $estado]
            );
        }

        // Mensaje de éxito
        session()->flash('message', 'Asistencias registradas correctamente.');
        return redirect()->route('clases-clases-index', ['cursoId' => $this->cursoId]);
    }

    public function render()
    {
        return view('livewire.asistencias.create-asistencia', [
            'alumnos' => $this->alumnos,
        ]);
    }
}
