<?php

namespace App\Livewire\Cursos;

use Livewire\Component;
use App\Models\Curso;

class ListCursos extends Component
{
    public $cursos;
    public $editingCurso = null;
    public $nombre;
    public $dia;
    public $horario;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;

    // Propiedad para identificar si estamos agregando o editando
    public $isAddingCurso = false;

    public function mount()
    {
        // Cargar todos los cursos al inicio
        $this->cursos = Curso::with('horariosCurso')->get(); // Cargar los horarios con los cursos
    }

    public function startEdit($id)
    {
        // Iniciar el proceso de edición
        $curso = Curso::find($id);
        if ($curso) {
            $this->editingCurso = $curso;
            $this->nombre = $curso->nombre;
            $this->fecha_inicio = $curso->fecha_inicio;
            $this->fecha_fin = $curso->fecha_fin;
            $this->descripcion = $curso->descripcion;
            $this->isAddingCurso = false;
            // Asignar días y horarios para mostrar en el formulario
            $this->dia = $curso->horariosCurso->pluck('dia_semana')->toArray(); // Obtener los días
            $this->horario = $curso->horariosCurso->map(function ($horario) {
                return $horario->hora_inicio . ' - ' . $horario->hora_fin;
            })->toArray(); // Obtener los horarios
        } else {
            $this->resetForm();
        }
    }

    public function deleteCurso($id)
    {
        // Eliminar curso de la base de datos y actualizar la lista
        $curso = Curso::find($id);
        if ($curso) {
            $curso->delete();
            $this->cursos = Curso::with('horariosCurso')->get(); // Actualizar lista
        }
    }

    public function saveEdit()
    {
        // Guardar cambios en el curso
        if ($this->editingCurso) {
            // Actualizar el curso con los nuevos datos
            $this->editingCurso->update([
                'nombre' => $this->nombre,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'descripcion' => $this->descripcion,
            ]);

            // Eliminar los horarios existentes y agregar los nuevos
            $this->editingCurso->horariosCurso()->delete(); // Eliminar horarios anteriores

            // Guardar los nuevos horarios
            foreach ($this->dia as $index => $dia) {
                $this->editingCurso->horariosCurso()->create([
                    'dia_semana' => $dia,
                    'hora_inicio' => explode(' - ', $this->horario[$index])[0],
                    'hora_fin' => explode(' - ', $this->horario[$index])[1],
                ]);
            }

            // Actualizar la lista de cursos
            $this->cursos = Curso::with('horariosCurso')->get(); // Recargar cursos con los horarios actualizados

            // Resetear el formulario y el estado
            $this->resetForm();
        }
    }

    public function resetForm()
    {
        // Resetear todos los campos y el estado de la vista
        $this->editingCurso = null;
        $this->nombre = '';
        $this->dia = '';
        $this->horario = '';
        $this->fecha_inicio = '';
        $this->fecha_fin = '';
        $this->descripcion = '';
        $this->isAddingCurso = false;
    }

    public function render()
    {
        return view('livewire.cursos.list-cursos');
    }
}
