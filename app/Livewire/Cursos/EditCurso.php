<?php

namespace App\Livewire\Cursos;

use Livewire\Component;
use App\Models\Curso;



class EditCurso extends Component
{
    public $nombre;
    public $descripcion;
    public $curso;

    // El método mount recibe el ID del curso y carga los datos
    public function mount($id)
    {
        $this->curso = Curso::findOrFail($id);
        $this->nombre = $this->curso->nombre;
        $this->descripcion = $this->curso->descripcion;
    }

    // El método para editar el curso
    public function edit()
    {
        // Validación de los campos del formulario
        $this->validate([
            'nombre' => 'required',
            'descripcion' => 'required',
        ]);

        // Actualización del curso en la base de datos
        $this->curso->update([
            'nombre' => $this->nombre,
            'descripcion' => $this->descripcion,
        ]);

        // Mensaje de éxito y redirección
        session()->flash('message', 'Curso actualizado correctamente.');
        return redirect()->route('cursos-cursos.index'); // Redirigir a la lista de cursos
    }
    public function render()
    {
        return view('livewire.cursos.edit-curso');
    }
}

