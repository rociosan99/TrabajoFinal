<?php

namespace App\Livewire\Users;

use Livewire\Component;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Livewire\WithPagination;

class ListUsers extends Component
{
    use WithPagination;

    public $search = '';      // Para la búsqueda por nombre
    public $roleFilter = '';  // Filtro por rol
    public $roles = [];       // Roles disponibles

    protected $queryString = ['search', 'roleFilter']; // Persistencia de filtros

    // Método mount para cargar los roles disponibles
    public function mount()
    {
        $this->roles = Role::all();
    }

    // Método render para mostrar los usuarios paginados
    public function render()
    {
        $query = User::query();

        // Filtro por rol
        if ($this->roleFilter) {
            $query->whereHas('roles', function ($q) {
                $q->where('name', $this->roleFilter);
            });
        }

        // Filtro por búsqueda de nombre
        if ($this->search) {
            $query->where('name', 'like', '%' . $this->search . '%');
        }

        // Paginación de usuarios
        $users = $query->paginate(10);

        return view('livewire.users.list-users', [
            'users' => $users,
        ]);
    }

    // Método para eliminar un usuario
    public function deleteUser($id)
    {
        $user = User::find($id);
        if ($user) {
            $user->delete();
            session()->flash('message', 'Usuario eliminado correctamente.');
        }
    }
}