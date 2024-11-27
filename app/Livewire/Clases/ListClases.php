<?php

namespace App\Livewire\Clases;

use App\Models\Clase;
use Livewire\Component;
use Carbon\Carbon; // Importamos Carbon

class ListClases extends Component
{
    // Definir las variables públicas para que estén disponibles en la vista
    public $clases;

    // Si tienes un estado de edición o alguna otra variable
    public $editingClase = false;
    public $clase_id, $nombre, $dia, $horario, $nivel, $fecha_inicio, $fecha_fin, $descripcion;

    public function mount()
    {
        // Cargar todas las clases al inicializar el componente
        $this->clases = Clase::all();

        // Formatear las fechas de cada clase usando Carbon
        foreach ($this->clases as $clase) {
            $clase->fecha_inicio = Carbon::parse($clase->fecha_inicio)->format('d/m/Y'); // Formato de fecha deseado
            $clase->fecha_fin = Carbon::parse($clase->fecha_fin)->format('d/m/Y'); // Formato de fecha deseado
        }
    }

    // Método para eliminar una clase
    public function deleteClase($id)
    {
        // Buscar la clase por ID y eliminarla
        $clase = Clase::find($id);
        if ($clase) {
            $clase->delete();
        }

        // Actualizar la lista de clases
        $this->clases = Clase::all();

        // Formatear nuevamente las fechas después de la eliminación
        foreach ($this->clases as $clase) {
            $clase->fecha_inicio = Carbon::parse($clase->fecha_inicio)->format('d/m/Y');
            $clase->fecha_fin = Carbon::parse($clase->fecha_fin)->format('d/m/Y');
        }
    }

    // Método para editar una clase (puedes expandirlo según tu lógica)
    public function editClase($id)
    {
        $clase = Clase::find($id);
        if ($clase) {
            // Cargar los datos de la clase en las variables del componente
            $this->clase_id = $clase->id;
            $this->nombre = $clase->nombre;
            $this->dia = $clase->dia;
            $this->horario = $clase->horario;
            $this->fecha_inicio = $clase->fecha_inicio;
            $this->fecha_fin = $clase->fecha_fin;
            $this->descripcion = $clase->descripcion;
            $this->editingClase = true;

            // Convertir las fechas a un formato adecuado para el formulario
            $this->fecha_inicio = Carbon::parse($this->fecha_inicio)->format('d/m/Y');
            $this->fecha_fin = Carbon::parse($this->fecha_fin)->format('d/m/Y');
        }
    }

    // Método para guardar los cambios de una clase (actualización)
    public function updateClase()
    {
        $clase = Clase::find($this->clase_id);
        if ($clase) {
            // Actualizar los datos de la clase
            $clase->nombre = $this->nombre;
            $clase->dia = $this->dia;
            $clase->horario = $this->horario;
            $clase->nivel = $this->nivel;
            // Convertir las fechas antes de guardarlas
            $clase->fecha_inicio = Carbon::parse($this->fecha_inicio)->format('Y-m-d'); // Formato para la base de datos
            $clase->fecha_fin = Carbon::parse($this->fecha_fin)->format('Y-m-d'); // Formato para la base de datos
            $clase->descripcion = $this->descripcion;
            $clase->save();

            // Actualizar la lista de clases
            $this->clases = Clase::all();

            // Formatear nuevamente las fechas después de la actualización
            foreach ($this->clases as $clase) {
                $clase->fecha_inicio = Carbon::parse($clase->fecha_inicio)->format('d/m/Y');
                $clase->fecha_fin = Carbon::parse($clase->fecha_fin)->format('d/m/Y');
            }

            // Resetear el estado de edición
            $this->resetForm();
        }
    }

    // Método para resetear el formulario de edición
    public function resetForm()
    {
        $this->clase_id = null;
        $this->nombre = '';
        $this->dia = '';
        $this->horario = '';
        $this->nivel = '';
        $this->fecha_inicio = null;
        $this->fecha_fin = null;
        $this->descripcion = '';
        $this->editingClase = false;
    }

    public function render()
    {
        return view('livewire.clases.list-clases');
    }
}
