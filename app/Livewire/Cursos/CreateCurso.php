<?php

namespace App\Livewire\Cursos;

use Livewire\Component;
use App\Models\Curso;
use App\Models\User;
use App\Models\HorariosCurso;
use Illuminate\Support\Collection;

class CreateCurso extends Component
{
    public $dias_select=['lunes','martes','miercoles','jueves','viernes'];

    // Propiedades del formulario
    public $nombre;
    public Collection $dias;
    public $hora_inicio;
    public $hora_fin;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;
    public $profesor;

    //error dias
    public $dias_is_empty;

    public $misprofesores; // Almacena la lista de profesores

    public function mount()
    {
        $this->misprofesores = User::role('Profesor')->get(); // Traer profesores con rol específico

        //crear la estructura inicial del input de dias con horas
        $this->fill([
            'dias'=>collect([]),
        ]);

        $this->dias_is_empty = false;
    }

    //agregar dias al input
    public function addInput(){

        if (count($this->dias) < 5) {
            $this->dias->push([
                'dia'=> '',
                'hora_inicio'=>'',
                'hora_fin'=>'',
            ]); 

            return;
        } else {

            return;
        }
  
    }


    // Validaciones
    protected $rules = [
        'nombre' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'descripcion' => 'nullable|string|max:1000',
        'profesor' => 'required',
        'dias.*.dia'=>'required',
        'dias.*.hora_inicio' => 'required',
        'dias.*.hora_fin' =>'required',
    ];

    protected $messages=[
        'nombre.required' => 'el nombre es obligatorio',
        'hora_inicio.required' => 'la hora de inicio es requerida',
        'hora_fin.required' => 'la hora de din es requerida',
        'fecha_inicio.required' => 'la fecha de inicio es requerida',
        'fecha_fin.required' => 'la fecha de fin es requerida',
        'descripcion' => '',
        'profesor.required' => 'el profesor es requerido',
        'dias.*.dia.required'=>'debe elegir un dia',
        'dias.*.hora_inicio.required' => 'Debe elegir un horario de inicio',
        'dias.*.hora_fin.required' =>'Debe elegir un horario de fin',
    ];

    public function save()
    {
        if (count($this->dias) == 0){
            $this->dias_is_empty=true;
        } else {
            $this->dias_is_empty=false;
        }

        // Validar
        $validated = $this->validate();

        // Crear el curso
        $curso = Curso::create([
            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'descripcion' => $this->descripcion,
            'usuario_id' => $this->profesor,
        ]);

        // Crear los horarios asociados al curso
        foreach ($this->dia as $dia) {
            HorariosCurso::create([
                'id_curso' => $curso->id,
                'hora_inicio' => $this->hora_inicio,
                'hora_fin' => $this->hora_fin,
                'dia_semana' => $dia,
            ]);
        }

        // Redirección con mensaje de éxito
        session()->flash('message', 'Curso creado exitosamente.');
        return redirect()->route('cursos-cursos-index');
    }

    public function render()
    {
        return view('livewire.cursos.create-curso');
    }
}
