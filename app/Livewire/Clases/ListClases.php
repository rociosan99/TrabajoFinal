<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use App\Models\Clase;
use App\Models\Curso;

class ListClases extends Component
{
    public $curso_id;
    public $clases;
    public $alumnos = [];
    public $selectedClaseId;
    public $showModal = false; // Variable para controlar el modal

    public function mount($curso_id)
    {
        $this->curso_id = $curso_id;
        //die($curso_id);
        $this->loadClases();
    }

    public function loadClases()
    {
        $this->clases = Clase::where('curso_id', $this->curso_id)->get();
    }

    public function loadAlumnos($claseId)
    {
        $this->selectedClaseId = $claseId;
        $clase = Clase::find($claseId);

        if ($clase) {
            $this->alumnos = $clase->curso->alumnos;
        } else {
            $this->alumnos = [];
        }

        $this->showModal = true; // Mostrar el modal al cargar los alumnos
    }

    public function closeModal()
    {
        $this->showModal = false; // Cerrar el modal
    }

    public function render()
    {
        return view('livewire.clases.list-clases', [
            'clases' => $this->clases,
        ]);
    }
}
