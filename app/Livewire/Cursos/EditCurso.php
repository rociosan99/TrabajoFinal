<?php

namespace App\Livewire\Cursos;

use Livewire\Component;
use App\Models\Curso;
use App\Models\User;
use App\Models\HorariosCurso;
use Illuminate\Support\Collection;
use Carbon\Carbon;
use App\Models\Clase;

class EditCurso extends Component
{
    public $curso;
    public $dias_select = ['lunes', 'martes', 'miércoles', 'jueves', 'viernes'];
    
    public $nombre;
    public Collection $dias;
    public $fecha_inicio;
    public $fecha_fin;
    public $descripcion;
    public $profesor;

    public $dias_is_empty;
    public $misprofesores;

    public function mount(Curso $curso)
    {
        $this->curso = $curso;
        $this->misprofesores = User::role('Profesor')->get();
        $this->fill([
            'nombre' => $curso->nombre,
            'fecha_inicio' => $curso->fecha_inicio,
            'fecha_fin' => $curso->fecha_fin,
            'descripcion' => $curso->descripcion,
            'profesor' => $curso->usuario_id,
            'dias' => $curso->horarios ? collect($curso->horarios->map(function ($horario) {
                return [
                    'dia' => $horario->dia_semana,
                    'hora_inicio' => $horario->hora_inicio,
                    'hora_fin' => $horario->hora_fin,
                ];
            })) : collect([]),
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
        unset($this->dias[$key]);
    }

    protected $rules = [
        'nombre' => 'required|string|max:255',
        'fecha_inicio' => 'required|date',
        'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
        'descripcion' => 'nullable|string|max:1000',
        'profesor' => 'required',
        'dias.*.dia' => 'required',
        'dias.*.hora_inicio' => 'required|date_format:H:i',
        'dias.*.hora_fin' => 'required|date_format:H:i|after:dias.*.hora_inicio',
    ];

    public function update()
    {
        if (count($this->dias) == 0) {
            $this->dias_is_empty = true;
            return;
        }

        $this->dias_is_empty = false;
        $validated = $this->validate();
        
        $this->curso->update([
            'nombre' => $this->nombre,
            'fecha_inicio' => $this->fecha_inicio,
            'fecha_fin' => $this->fecha_fin,
            'descripcion' => $this->descripcion,
            'usuario_id' => $this->profesor,
        ]);

        $this->curso->profesores()->sync([$this->profesor]);
        HorariosCurso::where('id_curso', $this->curso->id)->delete();
        foreach ($this->dias as $dia) {
            HorariosCurso::create([
                'id_curso' => $this->curso->id,
                'hora_inicio' => $dia['hora_inicio'],
                'hora_fin' => $dia['hora_fin'],
                'dia_semana' => $dia['dia'],
            ]);
        }
        
        $this->actualizarClases();

        session()->flash('message', 'Curso actualizado exitosamente.');
        return redirect()->route('clases-clases-index', ['cursoId' => $this->curso->id]);
    }

    public function actualizarClases()
    {
        Clase::where('curso_id', $this->curso->id)->delete();
        $fechaActual = Carbon::parse($this->fecha_inicio);
        $fechaFin = Carbon::parse($this->fecha_fin);
        $diasSeleccionados = $this->dias->pluck('dia')->toArray();

        while ($fechaActual->lte($fechaFin)) {
            $diaDeLaSemana = strtolower($fechaActual->locale('es')->isoFormat('dddd'));
            if (in_array($diaDeLaSemana, $diasSeleccionados)) {
                $horario = $this->dias->firstWhere('dia', $diaDeLaSemana);
                Clase::create([
                    'curso_id' => $this->curso->id,
                    'fecha_clase' => $fechaActual->format('Y-m-d'),
                    'hora_inicio' => $horario['hora_inicio'],
                    'hora_fin' => $horario['hora_fin'],
                ]);
            }
            $fechaActual->addDay();
        }
    }

    public function render()
    {
        return view('livewire.cursos.edit-curso');
    }
}