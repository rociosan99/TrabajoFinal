<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Home extends Component
{
    public $user; // Nombre cambiado a $user para que coincida con lo que usarás en la vista

    public function mount()
    {
        $this->user = Auth::user()->name; // Asignamos el nombre del usuario autenticado
    }

    public function render()
    {
        return view('livewire.home.home'); // Asegúrate de que esta ruta sea correcta
    }
}
