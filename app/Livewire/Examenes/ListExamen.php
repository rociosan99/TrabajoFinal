<?php

namespace App\Livewire\Examenes;

use Livewire\Component;
use App\Models\Examen;

class ListExamen extends Component
{
    public $examenes;
    public $isEditing=false;

    public function mount()
    {
        $this->examenes = Examen::all();  // Esto obtiene todos los registros de la tabla 'examenes'
    }

    public function render()
    {
        return view('livewire.examenes.list-examen');
    }
}