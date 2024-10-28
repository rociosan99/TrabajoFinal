<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;

class ListUsers extends Component
{
    public $users;
    public $editingUser = null;
    public $name;
    public $email;
    public $creatingUser;
    
    // Propiedad para identificar si estamos agregando o editando
    public $isAddingUser = false;

    public function mount()
    {
        // Cargar todos los usuarios al inicio
        $this->users = User::all();
    }

    public function startEdit($id)
    {
        // Iniciar el proceso de edición
        $user = User::find($id);
        if ($user) {
            $this->editingUser = $user;
            $this->name = $user->name;
            $this->email = $user->email;
            $this->isAddingUser = false;
        } else {
            $this->resetForm();
        }
    }
    /*
    public function updateUser()
    {
        // Validación y actualización del usuario
        if ($this->editingUser) {
            $this->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255|unique:users,email,' . $this->editingUser->id,
            ]);

            $this->editingUser->update([
                'name' => $this->name,
                'email' => $this->email,
            ]);

            $this->resetForm();
            $this->users = User::all();
        }
    }*/

    /*
    public function addUser()
    {
        // Validación de datos para agregar un nuevo usuario
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        // Crear el nuevo usuario
        User::create([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Actualizar la lista de usuarios y resetear el formulario
        $this->users = User::all();
        $this->resetForm();
    }*/

    public function deleteUser($id)
    {
        // Eliminar usuario de la base de datos y actualizar la lista
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->users = User::all();
        }
    }

    public function resetForm()
    {
        // Resetear todos los campos y el estado de la vista
        $this->editingUser = null;
        $this->name = '';
        $this->email = '';
        $this->isAddingUser = false;
    }

    public function render()
    {
        return view('livewire.users.list-users');
    }
}
