<?php

namespace App\Livewire\Comunicados;

use Livewire\Component;
use App\Models\Comunicacion;

class ReadComunicados extends Component
{
    public $mensaje;  // El mensaje que se va a enviar.

    // Método para enviar el mensaje
    public function enviarMensaje()
    {
        // Aquí puedes agregar la lógica para almacenar el mensaje o enviarlo.
        // Por ejemplo, guardar en la base de datos o enviar un correo.

        session()->flash('mensaje_enviado', 'Tu mensaje ha sido enviado correctamente.');
        $this->reset('mensaje');  // Limpia el campo después de enviar el mensaje.
    }

    public function render()
    {
        return view('livewire.comunicados.read-comunicados');
    }
}
