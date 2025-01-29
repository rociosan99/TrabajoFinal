<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Curso;
use App\Models\User; 

class AdminDashboard extends Component
{
    
    public $totalCursos;
    public $totalProfesores;
    

    public function mount()
    {
       
        $this->totalCursos = Curso::count(); // Contar cursos
        $this->totalProfesores = User::role('Profesor')->count(); // Contar profesores

    }

    public function render()
    {
        return view('livewire.admin.admin-dashboard');
    }
}
