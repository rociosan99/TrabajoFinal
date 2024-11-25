<?php

namespace App\Livewire\Cursos;

use Livewire\Component;
use App\Models\Curso; // Asegúrate de que el modelo de Curso esté correctamente importado
use App\Models\User;

class CreateCurso extends Component
{
    // Definir las propiedades que se usan en el formulario
    public $nombre;
    public $dia;
    public $horario;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;
    public $profesor;

    public $misprofesores;//almacenamiento de profesores

    public function mount(){
        $this->misprofesores = User::role('Profesor')->get(); 

        //dd($this->misprofesores);
    }//me trae el rol de profesor

    // Validaciones para los campos del formulario
    protected $rules = [
        'nombre' => 'required|string|max:255',
        'dia' => 'required|string|max:255',
        'horario' => 'required|date_format:H:i',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after:fecha_inicio', // Asegura que fecha_fin sea después de fecha_inicio
        'descripcion' => 'nullable|string|max:1000', // Descripción es opcional
        'profesor' => 'required',
    ];

    // Método para guardar el curso
    public function save()
    {
        // Validar los datos
        $this->validate();

        // Convertir el horario al formato correcto (HH:MM:SS) si es necesario
        if ($this->horario) {
            // Si el horario tiene formato de hora con punto como '13.30', lo convertimos
            $this->horario = str_replace('.', ':', $this->horario) . ":00";
        }

        // Crear el curso en la base de datos
        Curso::create([
            'nombre' => $this->nombre,
            'dia' => $this->dia,
            'horario' => $this->horario,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'descripcion' => $this->descripcion,
            'usuario_id' => $this->profesor,
            
        ]);

        // Mensaje de éxito
        session()->flash('message', 'Curso creado exitosamente!');

        // Redirigir al usuario a la página principal de cursos
        return redirect()->route('cursos-cursos-index');
    }

    public function render()
    {
        return view('livewire.cursos.create-curso');
    }
}

