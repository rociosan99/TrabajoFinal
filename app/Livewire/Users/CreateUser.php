<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User; // Asegúrate de que esta línea esté presente
use App\Models\Users; // Esta línea podría ser innecesaria si tienes un modelo de nombre 'User'

class CreateUser extends Component
{
    public $name;
    public $email;
    public $password;
    

    public function save()
    {   
        // Validación de datos
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ]);

        // Creación del usuario
        //dd($this->name, $this->email, $this->password);
        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        // Limpiar los campos del formulario
        $this->reset();

        // Redireccionar a la ruta deseada
        $this->redirectRoute('users-users-index');
    }

    public function render()
    {
        return view('livewire.users.create-user');
    }
}
