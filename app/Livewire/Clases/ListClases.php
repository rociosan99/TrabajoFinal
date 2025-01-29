<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use App\Models\Clase;
use App\Models\Curso;

class ListClases extends Component
{
    public $curso_id;
    public $clases;
    public $dictado = ""; // Para manejar si la clase se dictó
    public $observacion; // Motivo de no dictar clase
    public $selectedClaseId; // Clase seleccionada para actualizar
    public $alumnos = [];

    public function mount($curso_id)
    {
        $this->curso_id = $curso_id;
        $this->loadClases();
    }

    public function loadClases()
    {
        $this->clases = Clase::where('curso_id', $this->curso_id)->get();
    }

    public function guardarMotivo()
    {
        if (empty($this->observacion)) {
            session()->flash('error', 'El motivo no puede estar vacío.');
            return;
        }

        // Guardar el motivo en la base de datos
        $clase = Clase::find($this->selectedClaseId);

        if (!$clase) {
            session()->flash('error', 'Clase no encontrada.');
            return;
        }

        $clase->observacion = $this->observacion;
        $clase->save();

        session()->flash('success', 'Motivo guardado correctamente.');

        // Resetear campos y recargar datos
        $this->reset('observacion');
        $this->dictado = null;
        $this->loadClases(); // Asegúrate de que este método exista en tu componente
    }

    public function render()
    {
        return view('livewire.clases.list-clases', [
            'clases' => $this->clases,
        ]);
    }
}
