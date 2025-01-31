<?php

namespace App\Livewire\Asistencias;

use Livewire\Component;
use App\Models\User;
use App\Models\Asistencia;
use App\Models\Curso;
use App\Models\Clase;
use App\Models\Comunicacion;
use Carbon\Carbon;


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
        $alumnosAusentes = [];
        $claseId = $this->clase->id;
        foreach ($this->asistencias as $usuarioId => $presente) {
            $estado = $presente ? 'presente' : 'ausente';

            Asistencia::updateOrCreate(
                ['usuario_id' => $usuarioId, 'clase_id' => $claseId],
                ['estado' => $estado]
            );
            if ($estado == 'ausente') {
                $alumnosAusentes[] = $usuarioId;
            }
        }

        $mesActual = date('m');

        foreach ($alumnosAusentes as $alumnoAusente) {
            // Obtener el ID del curso de la clase
            $unCurso = Clase::select('curso_id')->where('id', $claseId)->first();
            if (!$unCurso) {
                continue; // Si no encuentra la clase, pasa al siguiente alumno
            }
            $cursoId = $unCurso->curso_id;
        
            // Contar inasistencias en el mes
            $inasistencias = Asistencia::join('clases', 'clases.id', '=', 'asistencias.clase_id')
                ->where('clases.curso_id', $cursoId)
                ->where('asistencias.usuario_id', $alumnoAusente)
                ->where('asistencias.estado', 'ausente')
                ->whereMonth('asistencias.created_at', $mesActual)
                ->count();
        
                $comunicacion = Comunicacion::create([
                    "receptor_id" => $alumnoAusente,
                    'id_clase' => $claseId,
                    'titulo' => "Alerta de inasistencia",
                    'cuerpo' => "¡Hola! Desde ClassAdmin notamos que no pudiste asistir a dos clases en este mes en el curso UN CURSO GENERICO. Por favor acércate para regularizar tu situación. Entra a este link si querés comunicarte con nosotros: CANELO"
                ]);
                
                $rutaRespuesta = route('comunicados-comunicados-read', ['id_comunicacion' => $comunicacion->id_comunicacion]);
                $comunicacion->update(['cuerpo' => str_replace('CANELO', $rutaRespuesta, $comunicacion->cuerpo)]);
                
                // Redirigir después de crear la comunicación
                return redirect()->route('clases-clases-index', ['cursoId' => $this->cursoId]);
            }
    }

    public function render()
    {
        return view('livewire.asistencias.create-asistencia', [
            'alumnos' => $this->alumnos,
        ]);
    }
}
