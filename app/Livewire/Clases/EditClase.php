<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use App\Models\Clase;
use App\Models\Curso; // Asegúrate de importar el modelo de Curso
use Carbon\Carbon;

class EditClase extends Component
{
    public $fecha_clase;
    public $hora_inicio;
    public $hora_fin;
    public $curso_id;
    public $clase;
    public $cursos; // Variable para los cursos disponibles
    public $editingClase = false;

    public function mount($id)
    {
        // Cargar la clase específica
        $this->clase = Clase::findOrFail($id);

        // Inicializar las variables con los valores actuales de la clase
        $this->fecha_clase = Carbon::createFromFormat('Y-m-d', $this->clase->fecha_clase)->format('Y-m-d'); // Cambiar a Y-m-d para el input de tipo date
        $this->hora_inicio = $this->clase->hora_inicio;
        $this->hora_fin = $this->clase->hora_fin;
        $this->curso_id = $this->clase->curso_id;

        // Cargar todos los cursos disponibles
        $this->cursos = Curso::all(); 

        // Activar el estado de edición para que el modal se muestre
        $this->editingClase = true;
    }

    public function updateClase()
    {
        // Validar los datos del formulario
        $this->validate([
            'fecha_clase' => 'required|date', // Validar que sea una fecha válida
            'hora_inicio' => 'required|date_format:H:i',
            'hora_fin' => 'required|date_format:H:i|after:hora_inicio',
            'curso_id' => 'required|exists:cursos,id',
        ]);

        // Actualizar la clase
        $this->clase->update([
            'fecha_clase' => Carbon::createFromFormat('Y-m-d', $this->fecha_clase)->format('Y-m-d'), // No es necesario convertirla a Y-m-d, ya está en ese formato
            'hora_inicio' => $this->hora_inicio,
            'hora_fin' => $this->hora_fin,
            'curso_id' => $this->curso_id,
        ]);

        // Mostrar mensaje de éxito y redirigir
        session()->flash('message', 'Clase actualizada correctamente.');
        return redirect()->route('clases-clases-index');
    }

    public function resetForm()
    {
        // Restablecer valores y cerrar el modal
        $this->fecha_clase = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->curso_id = '';
        $this->editingClase = false;
    }

    public function render()
    {
        return view('livewire.clases.edit-clase');
    }
}
