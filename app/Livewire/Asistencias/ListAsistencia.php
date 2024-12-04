<?php

namespace App\Livewire\Asistencias;

use Livewire\Component;
use App\Models\Asistencia; // Asegúrate de usar el modelo correcto

class ListAsistencia extends Component
{
    public $asistencias; // Declarar la propiedad para las asistencias

    public function mount()
    {
        // Cargar las asistencias desde la base de datos
        $this->asistencias = Asistencia::all(); // Puedes modificar la consulta si es necesario
    }

    public function render()
    {
        // Pasar las asistencias a la vista
        return view('livewire.asistencias.list-asistencia');
    }
}
