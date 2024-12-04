<?php

namespace App\Livewire\Cursos;

use Livewire\Component;
use App\Models\Curso;
use App\Models\User;

class EditCurso extends Component
{
    // Propiedades del formulario
    public $nombre;
    public $dia = [];
    public $hora_inicio;
    public $hora_fin;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;
    public $profesor;
    public $misprofesores;
    public $curso;

    // El método mount recibe el ID del curso y carga los datos
    public function mount($cursoId)
    {
    // Buscar el curso por su ID
    $this->curso = Curso::findOrFail($cursoId);

    // Cargar los datos del curso en las variables
    $this->nombre = $this->curso->nombre;
    $this->dia = $this->curso->dia ? (array) $this->curso->dia : []; // Asegúrate de que sea un arreglo
    $this->hora_inicio = $this->curso->hora_inicio;
    $this->hora_fin = $this->curso->hora_fin;
    $this->fecha_inicio = $this->curso->fecha_inicio;
    $this->fecha_fin = $this->curso->fecha_fin;
    $this->descripcion = $this->curso->descripcion;
    $this->profesor = $this->curso->profesor_id;

    // Traer la lista de profesores
    $this->misprofesores = User::role('Profesor')->get();
    }


    // Método para editar el curso
    public function edit()
    {
        // Validación de los campos del formulario
        $this->validate([
            'nombre' => 'required',
            'dia' => 'required|array|min:1',
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'descripcion' => 'nullable|string|max:255',
            'profesor' => 'required|exists:users,id', // Validar que el profesor exista
        ]);

        // Actualización del curso en la base de datos
        $this->curso->update([
            'nombre' => $this->nombre,
            'dia' => $this->dia,
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'descripcion' => $this->descripcion,
            'profesor_id' => $this->profesor,
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
