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
        //die('hola');
        $this->clase=Clase::findOrFail($claseId);
        $cursoId=$this->clase['curso_id'];
        $this->cursoId = $cursoId;
        // Obtener alumnos con el rol "Alumno" asociados al curso
        $this->cursoId = $cursoId;
        $this->curso = Curso::findOrFail($cursoId); // Guardar el curso completo

        // Cargar la relación con los alumnos
        $this->alumnos = $this->curso->alumnos;

       
        // Inicializar estado de asistencia
        foreach ($this->alumnos as $alumno) {
            $this->asistencias[$alumno->id] = 'ausente'; // Valor predeterminado
        }
    }

    public function guardarAsistencias()
    {
        foreach ($this->asistencias as $usuarioId => $estado) {
            Asistencia::create([
                'estado' => $estado,             // Estado de asistencia (ausente/presente)
                'clase_id' => null,             // Relaciona con la clase si aplica
                'curso_id' => $this->cursoId,   // ID del curso actual
                'usuario_id' => $usuarioId,     // ID del alumno
            ]);
        }

        // Mensaje de éxito
        session()->flash('message', 'Asistencias registradas correctamente.');
    }

    public function render()
    {
        return view('livewire.asistencias.create-asistencia', [
            'alumnos' => $this->alumnos,
        ]);
    }
}
