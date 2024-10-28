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

    public function mount()
    {
        $this->users = User::all();
    }

    public function startEdit($id)
    {
        $user = User::find($id);
        if ($user) {
            $this->editingUser = $user;
            $this->name = $user->name;
            $this->email = $user->email;
        } else {
            $this->resetForm();
        }
    }

    public function updateUser()
    {
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
    }

    public function addUser()
    {
        // Validación de datos
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email',
        ]);

        // Creación del usuario
        User::create([
            'name' => $this->name,
            'email' => $this->email,
        ]);

        // Actualizar la lista de usuarios
        $this->users = User::all();

        // Resetear el formulario
        $this->resetForm();
    }

    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->users = User::all();
        }
    }

    public function resetForm()
    {
        $this->editingUser = null;
        $this->name = '';
        $this->email = '';
    }

    public function render()
    {
        return view('livewire.users.list-users');
    }
}
