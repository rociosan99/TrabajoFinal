<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;

class ListUsers extends Component
{
    public $users = [];  // Solo los datos de los usuarios
    public $pagination = [];  // Información de la paginación
    public $editingUser = null;
    public $name;
    public $email;
    public $isAddingUser = false;
    public $roleFilter = '';  // Propiedad para el filtro de rol
    public $search = '';  // Para realizar una búsqueda por nombre

    // Método mount para cargar los usuarios
    public function mount()
    {
        $this->loadUsers();
    }

    // Método para cargar los usuarios paginados
    public function loadUsers()
    {
        $query = User::query();

        if ($this->roleFilter) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', $this->roleFilter);
            });
        }

        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Cargar los datos de los usuarios y la información de la paginación
        $paginator = $query->paginate(10);
        $this->users = $paginator->items();  // Solo los usuarios
        $this->pagination = [
            'current_page' => $paginator->currentPage(),
            'last_page' => $paginator->lastPage(),
            'per_page' => $paginator->perPage(),
            'total' => $paginator->total(),
        ];
    }

    // Método que se ejecuta cuando se cambia el filtro de rol
    public function updatedRoleFilter()
    {
        $this->resetPage();  // Resetear la página de la paginación
        $this->loadUsers();
    }

    // Método para aplicar el filtro por rol
    public function updatedSearch()
    {
        $this->resetPage();  // Resetear la página de la paginación
        $this->loadUsers();
    }

    // Método para editar un usuario
    public function startEdit($id)
    {
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

    // Método para eliminar un usuario
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            $this->loadUsers();  // Recargar la lista de usuarios
        }
    }

    // Resetear el formulario
    public function resetForm()
    {
        $this->editingUser = null;
        $this->name = '';
        $this->email = '';
        $this->isAddingUser = false;
    }

    public function render()
    {
        $roles = Role::all();  // Obtener todos los roles disponibles para el filtro

        return view('livewire.users.list-users', compact('roles'));
    }
}
