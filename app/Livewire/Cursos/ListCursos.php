<?php

namespace App\Livewire\Cursos;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Curso;

class ListCursos extends Component
{
    use WithPagination;

    public $search = ''; // Variable para la búsqueda

    // Propiedades para editar el curso
    public $editingCurso = null;
    public $nombre;
    public $dia;
    public $horario;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;

    // Propiedad para identificar si estamos agregando o editando
    public $isAddingCurso = false;

    // Inicializar los cursos con paginación y búsqueda
    public function mount()
    {
        $this->cursos = Curso::with('horariosCurso')->paginate(10);
    }

    // Método para actualizar la búsqueda
    public function updatingSearch()
    {
        $this->resetPage(); // Restablecer a la primera página cuando cambia la búsqueda
    }

    // 🔍 **Método para buscar los cursos (usado por el botón de la lupa)**
    public function buscarCursos()
    {
        // Este método no necesita hacer nada más porque la búsqueda ya está conectada con la propiedad $search
        $this->render();
    }

    public function startEdit($id)
    {
        $curso = Curso::find($id);
        if ($curso) {
            $this->editingCurso = $curso;
            $this->nombre = $curso->nombre;
            $this->fecha_inicio = $curso->fecha_inicio;
            $this->fecha_fin = $curso->fecha_fin;
            $this->descripcion = $curso->descripcion;
            $this->isAddingCurso = false;
            $this->dia = $curso->horariosCurso->pluck('dia_semana')->toArray();
            $this->horario = $curso->horariosCurso->map(function ($horario) {
                return $horario->hora_inicio . ' - ' . $horario->hora_fin;
            })->toArray();
        } else {
            $this->resetForm();
        }
    }

    public function deleteCurso($id)
    {
        $curso = Curso::find($id);
        if ($curso) {
            $curso->delete();
            $this->cursos = Curso::with('horariosCurso')->paginate(10);
        }
    }

    public function saveEdit()
    {
        if ($this->editingCurso) {
            $this->editingCurso->update([
                'nombre' => $this->nombre,
                'fecha_inicio' => $this->fecha_inicio,
                'fecha_fin' => $this->fecha_fin,
                'descripcion' => $this->descripcion,
            ]);

            $this->editingCurso->horariosCurso()->delete();

            foreach ($this->dia as $index => $dia) {
                $this->editingCurso->horariosCurso()->create([
                    'dia_semana' => $dia,
                    'hora_inicio' => explode(' - ', $this->horario[$index])[0],
                    'hora_fin' => explode(' - ', $this->horario[$index])[1],
                ]);
            }

            $this->cursos = Curso::with('horariosCurso')->paginate(10);
            $this->resetForm();
        }
    }

    public function resetForm()
    {
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
        $cursos = Curso::with('horariosCurso')
                        ->where('nombre', 'like', '%' . $this->search . '%')
                        ->paginate(10);

        return view('livewire.cursos.list-cursos', compact('cursos'));
    }
}
