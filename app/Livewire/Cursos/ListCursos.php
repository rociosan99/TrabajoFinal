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
    public $nivel;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;

    // Propiedad para identificar si estamos agregando o editando
    public $isAddingCurso = false;

    public function mount()
    {
        // Cargar todos los cursos al inicio
        $this->cursos = Curso::all();
    }

    public function startEdit($id)
    {
        // Iniciar el proceso de edición
        $curso = Curso::find($id);
        if ($curso) {
            $this->editingCurso = $curso;
            $this->nombre = $curso->nombre;
            $this->dia = $curso->dia;
            $this->horario = $curso->horario;
            $this->nivel = $curso->nivel;
            $this->fecha_inicio = $curso->fecha_inicio;
            $this->fecha_fin = $curso->fecha_fin;
            $this->descripcion = $curso->descripcion;
            $this->isAddingCurso = false;
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
            $this->cursos = Curso::all();
        }
    }

    public function resetForm()
    {
        // Resetear todos los campos y el estado de la vista
        $this->editingCurso = null;
        $this->nombre = '';
        $this->dia = '';
        $this->horario = '';
        $this->nivel = '';
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
