<?php

namespace App\Livewire\Profesor;

use Livewire\Component;
use App\Models\Clase;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfesorDashboard extends Component
{
    public $clasesHoy;

    public function mount()
    {
        $hoy = Carbon::today(); // Obtiene la fecha actual
        $profesor = Auth::user();

        if ($profesor->hasRole('Profesor')) {
            $this->clasesHoy = Clase::with('curso') // Cargar la relación con el curso
                ->where('fecha_clase', '=', $hoy->toDateString())
                ->whereHas('curso.profesores', function ($query) use ($profesor) {
                    $query->where('user_id', $profesor->id); // Verificar si el curso está asignado al profesor
                })
                ->get();
        } else {
            $this->clasesHoy = collect(); // Si no es profesor, no muestra nada
        }
    }

    public function render()
    {
        return view('livewire.profesor.profesor-dashboard');
    }
}
