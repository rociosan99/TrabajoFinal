<?php

namespace App\Livewire\Cursos;

use Livewire\Component;
use App\Models\Curso;
use App\Models\User;
use App\Models\HorariosCurso;
use App\Models\Clase;
use Illuminate\Support\Collection;
use Carbon\Carbon;

class CreateCurso extends Component
{
    public $dias_select = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes'];

    // Propiedades del formulario
    public $nombre;
    public Collection $dias;
    public $hora_inicio;
    public $hora_fin;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;
    public $profesor; // Se usará para asignar el profesor seleccionado

    // Control de errores
    public $dias_is_empty;

    public $misprofesores; // Almacena la lista de profesores

    public function mount()
    {
        // Obtener lista de profesores con rol "Profesor"
        $this->misprofesores = User::role('Profesor')->get();

        // Crear la estructura inicial del input de días con horas
        $this->fill([
            'dias' => collect([]),
        ]);

        $this->dias_is_empty = false;
    }

    public function addInput()
    {
        if (count($this->dias) < 5) {
            $this->dias->push([
                'dia' => '',
                'hora_inicio' => '',
                'hora_fin' => '',
            ]);
        }
    }

    public function removeInput($key)
    {
        // Eliminar el día de la semana específico
        unset($this->dias[$key]);
    }

    // Validaciones
    protected $rules = [
        'nombre' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'descripcion' => 'nullable|string|max:1000',
        'profesor' => 'required', // Validación para el profesor seleccionado
        'dias.*.dia' => 'required',
        'dias.*.hora_inicio' => 'required|date_format:H:i',
        'dias.*.hora_fin' => 'required|date_format:H:i|after:dias.*.hora_inicio',
    ];

    protected $messages = [
        'nombre.required' => 'El nombre es obligatorio',
        'hora_inicio.required' => 'La hora de inicio es requerida',
        'hora_fin.required' => 'La hora de fin es requerida',
        'fecha_inicio.required' => 'La fecha de inicio es requerida',
        'fecha_fin.required' => 'La fecha de fin es requerida',
        'profesor.required' => 'El profesor es requerido', // Mensaje para el profesor
        'dias.*.dia.required' => 'Debe elegir un día',
        'dias.*.hora_inicio.required' => 'Debe elegir un horario de inicio',
        'dias.*.hora_fin.required' => 'Debe elegir un horario de fin',
        'dias.*.hora_fin.after' => 'La hora de fin debe ser posterior a la hora de inicio',
    ];

    public function save()
{
    if (count($this->dias) == 0) {
        $this->dias_is_empty = true;
        return;
    }

    $this->dias_is_empty = false;

    // Validar
    $validated = $this->validate();

    // Crear el curso
    $curso = Curso::create([
        'nombre' => $this->nombre,
        'fecha_inicio' => $this->fecha_inicio,
        'fecha_fin' => $this->fecha_fin,
        'descripcion' => $this->descripcion,
        'usuario_id' => $this->profesor,  // Asignar el valor del profesor seleccionado
    ]);

    // **Asignar el profesor al curso** (si es necesario)
    $curso->profesores()->attach($this->profesor); // Relación muchos a muchos

    // Crear los horarios asociados al curso
    foreach ($this->dias as $dia) {
        HorariosCurso::create([
            'id_curso' => $curso->id,
            'hora_inicio' => $dia['hora_inicio'],
            'hora_fin' => $dia['hora_fin'],
            'dia_semana' => $dia['dia'],
        ]);
    }

    // Crear las clases automáticamente
    $this->crearClases($curso);

    // Redirección con mensaje de éxito
    session()->flash('message', 'Curso creado exitosamente.');
    return redirect()->route('clases-clases-index', ['cursoId' => $curso->id]);
}


    // Método para crear las clases de acuerdo a los horarios
    public function crearClases($curso)
    {
        $fechaActual = Carbon::parse($this->fecha_inicio);
        $fechaFin = Carbon::parse($this->fecha_fin);
        $diasSeleccionados = $this->dias->pluck('dia')->toArray();

        // Recorremos todas las fechas entre la fecha de inicio y fin
        while ($fechaActual->lte($fechaFin)) {
            $diaDeLaSemana = strtolower($fechaActual->locale('es')->isoFormat('dddd'));
            
            // Comprobamos si el día de la semana actual está en los días seleccionados
            if (in_array($diaDeLaSemana, $diasSeleccionados)) {
                // Obtenemos el horario correspondiente para ese día
                $horario = $this->dias->firstWhere('dia', $diaDeLaSemana);

                // Creamos una clase para ese día
                Clase::create([
                    'curso_id' => $curso->id,
                    'fecha_clase' => $fechaActual->format('Y-m-d'),
                    'hora_inicio' => $horario['hora_inicio'],
                    'hora_fin' => $horario['hora_fin'],
                ]);
            }

            // Pasamos al siguiente día
            $fechaActual->addDay();
        }
    }

    public function render()
    {
        return view('livewire.cursos.create-curso');
    }
}
