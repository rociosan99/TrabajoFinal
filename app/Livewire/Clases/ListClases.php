<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use App\Models\Clase;
use Carbon\Carbon; // Importamos Carbon

class ListClases extends Component
{
    public $clases;
    public $editingClase = null;
    public $fecha_clase;
    public $hora_inicio;
    public $hora_fin;
    public $curso_id;

    // Propiedad para identificar si estamos agregando o editando
    public $isAddingClase = false;

    public function mount()
    {
        // Cargar todas las clases al inicio
        $this->clases = Clase::all();
    }

    public function startEdit($id)
    {
        // Iniciar el proceso de edición
        $clase = Clase::find($id);
        if ($clase) {
            $this->editingClase = $clase;
            $this->fecha_clase = Carbon::parse($clase->fecha_clase)->format('d/m/Y');
            $this->hora_inicio = $clase->hora_inicio;
            $this->hora_fin = $clase->hora_fin;
            $this->curso_id = $clase->curso_id;
            $this->isAddingClase = false;
        } else {
            $this->resetForm();
        }
    }

    public function deleteClase($id)
    {
        // Eliminar clase de la base de datos y actualizar la lista
        $clase = Clase::find($id);
        if ($clase) {
            $clase->delete();
            $this->clases = Clase::all();
        }
    }

    public function resetForm()
    {
        // Resetear todos los campos y el estado de la vista
        $this->editingClase = null;
        $this->fecha_clase = '';
        $this->hora_inicio = '';
        $this->hora_fin = '';
        $this->curso_id = '';
        $this->isAddingClase = false;
    }

    public function render()
    {
        return view('livewire.clases.list-clases', [
            'clases' => $this->clases,
        ]);
    }
}
