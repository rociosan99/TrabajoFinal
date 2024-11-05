<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User; // Asegúrate de que esta línea esté presente
use App\Models\Users; // Esta línea podría ser innecesaria si tienes un modelo de nombre 'User'

class CreateUser extends Component
{
    public $name;
    public $apellido;
    public $dni;
    public $fecha_nac;
    public $email;
    public $password;
    

    public function save()
    {   
        // Validación de datos
        $this->validate([
            'name' => 'required|string|max:255',
            'apellido' => 'required|string|max:255',
            'dni'=> 'required',
            'fecha_nac'=>'required|date',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|string|min:8',
        ], [
            'name.required' => 'el :attribute es obligatorio',
        ], [
            'name'=>'nombre',
        ]);

        // Creación del usuario
        //dd($this->name, $this->email, $this->password);
        $usuario = User::create([
            'name' => $this->name,
            'apellido'=>$this->apellido,
            'dni'=>$this->dni,
            'fecha_nac'=>$this->fecha_nac,
            'email' => $this->email,
            'password' => bcrypt($this->password),
        ]);

        $usuario->assignRole('Profesor');


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
