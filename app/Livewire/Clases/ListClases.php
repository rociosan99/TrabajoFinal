<?php

namespace App\Livewire\Clases;

use Livewire\Component;
use App\Models\Clase;
use Carbon\Carbon;
use App\Models\Curso;

class ListClases extends Component
{
    public $curso_id;
    public $clases; // Esta variable pública se usará en la vista

    /**
     * Método que se ejecuta al inicializar el componente
     */
    public function mount($curso_id)
    {
        $this->curso_id = $curso_id;
        $this->loadClases(); // Llamamos a un método para cargar las clases
    }

    /**
     * Método que carga las clases relacionadas al curso
     */
    public function loadClases()
    {
        $this->clases = Clase::where('curso_id', $this->curso_id)->get(); // Cargamos las clases por curso
    }

    public function render()
    {
        return view('livewire.clases.list-clases');
    }
}
