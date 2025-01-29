<?php

namespace App\Livewire\Roles;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class ListRoles extends Component
{
    public $roles;
    public $roleId;
    public $name;
    public $search = ''; // Campo de búsqueda por nombre de rol
    public $isEditing = false;

    protected $rules = [
        'name' => 'required|string|max:255',
    ];

    public function mount()
    {
        $this->roles = Role::all();
    }

    public function startEdit($roleId)
    {
        $role = Role::find($roleId);
        $this->roleId = $role->id;
        $this->name = $role->name;
        $this->isEditing = true;
    }

    public function updateRole()
    {
        $this->validate();

        $role = Role::find($this->roleId);
        $role->update(['name' => $this->name]);

        session()->flash('message', 'Role updated successfully.');
        $this->resetForm();
        $this->loadRoles();
    }

    public function deleteRole($roleId)
    {
        Role::find($roleId)->delete();

        session()->flash('message', 'Role deleted successfully.');
        $this->loadRoles();
    }

    public function loadRoles()
    {
        if ($this->search) {
            $this->roles = Role::where('name', 'like', '%' . $this->search . '%')->get();
        } else {
            $this->roles = Role::all();
        }
    }

    public function resetForm()
    {
        $this->roleId = null;
        $this->name = '';
        $this->isEditing = false;
    }

    public function render()
    {
        return view('livewire.roles.list-roles');
    }
}
