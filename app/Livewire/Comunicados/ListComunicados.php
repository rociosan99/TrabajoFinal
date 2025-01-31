<?php

namespace App\Livewire\Comunicados;

use Livewire\Component;
use App\Models\Comunicacion;

class ListComunicados extends Component
{
    public $modalAbierto = false;
    public $respuesta = '';
    public $id_comunicacion; 
    public $comunicadoSeleccionado; 

    public function render()
    {
        // Cambié la relación 'usuario' a 'receptor' en el with()
        $comunicados = Comunicacion::with('receptor')->get();

        return view('livewire.comunicados.list-comunicados', compact('comunicados'));
    }

    // Abrir el modal y cargar el comunicado seleccionado
    public function abrirModal($id_comunicacion)
    {
        $this->modalAbierto = true;
        $this->id_comunicacion = $id_comunicacion;

        // Obtener el comunicado completo con la relación de 'receptor'
        $this->comunicadoSeleccionado = Comunicacion::with('receptor')->find($id_comunicacion);
    }

    // Cerrar el modal
    public function cerrarModal()
    {
        $this->modalAbierto = false;
    }

    // Guardar la respuesta
    public function guardarRespuesta()
    {
        $comunicado = Comunicacion::find($this->id_comunicacion);
        $comunicado->respuesta = $this->respuesta;
        $comunicado->save();
    
        $this->cerrarModal();
        session()->flash('message', 'Respuesta enviada correctamente');
    }
    
}
