<?php

namespace App\Livewire\Profesor;

use Livewire\Component;
use App\Models\Clase;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class ProfesorDashboard extends Component
{
    public $clasesHoy;


    public function mount()
    {
        $hoy = Carbon::today(); // Obtiene la fecha actual
        
        $profesor = Auth::user();
        //die($hoy->toDateString());


        if ($profesor->hasRole('Profesor')) {
            $this->clasesHoy = Clase::with('curso')// Cargar la relación con el curso
                //->whereDate('fecha_clase', $hoy) // Filtrar por el día de hoy
                //->whereBetween('fecha_clase', [$hoy->toDateString(), $hoy->toDateString()])
                //->where('fecha_clase', '<=', $hoy->toDateString())
                ->where('fecha_clase', '=', $hoy->toDateString())
                //->where('fecha_clase', '=', "2025-01-02")
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

