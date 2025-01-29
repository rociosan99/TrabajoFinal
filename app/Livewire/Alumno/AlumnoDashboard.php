<?php

namespace App\Livewire\Alumno;

use Livewire\Component;
use App\Models\Curso;
use App\Models\Asistencia;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AlumnoDashboard extends Component
{
    public $cursos; // Cursos asignados al alumno

    public function mount()
    {
        $alumno = Auth::user(); // Obtener el usuario logueado (alumno)

        // Filtrar los cursos donde el alumno está inscrito
        $this->cursos = $alumno->cursos; // Asumiendo que tienes una relación 'cursos' en el modelo User
    }

    public function render()
    {
        return view('livewire.alumno.alumno-dashboard', [
            'cursos' => $this->cursos,
        ]);
    }
}
