<?php

namespace App\Livewire\Comunicados;

use Livewire\Component;
use App\Models\Comunicacion;
use Carbon\Carbon;

class ReadComunicados extends Component
{
    public $mensaje;  
    public $id_comunicacion;  

    // Método para enviar el mensaje
    public function enviarMensaje()
    {
        // Buscar el comunicado y actualizar la respuesta
        $comunicacion = Comunicacion::find($this->id_comunicacion);
        
        if ($comunicacion) {
            $comunicacion->respuesta = $this->mensaje;  
            $comunicacion->fecha_respuesta = now();  
        }

        // Mensaje de éxito
        session()->flash('mensaje_enviado', 'Tu mensaje ha sido enviado correctamente.');

        // Limpiar el campo después de enviar el mensaje
        $this->reset('mensaje');
    }

    public function render()
    {
        return view('livewire.comunicados.read-comunicados');
    }
}